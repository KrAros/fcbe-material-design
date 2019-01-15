<?php
############################################################################
#    FANTACALCIOBAZAR EVOLUTION
#    Copyright (C) 2003-2010 by Antonello Onida
#
#    This program is free software; you can redistribute it and/or modify
#    it under the terms of the GNU General Public License as published by
#    the Free Software Foundation; either version 2 of the License, or
#    (at your option) any later version.
#
#    This program is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU General Public License for more details.
#
#    You should have received a copy of the GNU General Public License
#    along with this program; if not, write to the Free Software
#    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#
##################################################################################
require_once("./controlla_pass.php");
include("./header.php");

if ($_SESSION['valido'] == "SI" or $escludi_controllo == "SI") {
	#require ("./menu.php");
	$chiusura_giornata = INTVAL(@file($percorso_cartella_dati."/chiusura_giornata.txt"));
	if(!$ordinamento)($ordinamento=1);
	$file_utenti = @file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
	$linee = count($file_utenti);
	$formazione = array();
	$voti = array();
	$punti = array();
	$gol = array();
	
	############################################
	# intestazione tabella classifica
	############################################
	for ($num1 = 1 ; $num1 < 40 ; $num1++) {
		if (strlen($num1) == 1) $num1 = "0".$num1;
		$giornata_controlla = "giornata$num1";
		if (!@is_file($percorso_cartella_dati."/".$giornata_controlla."_".$_SESSION['torneo']."_".$_SESSION['serie'])) break;
		else $giornata_ultima = $num1;
	} # fine for $num1
	
	$giornata = $giornata_ultima;
	$num_giornata = $giornata_ultima;
	
	if ($num1 % 2) $color=$colore_riga_alt;
	else $color="white";
	
	echo '<div class="container" style="width: 85%;margin-top: -10px;">
		<div class="card-panel">
		<div class="row">';
	
	require ("./widget.php");
	echo'<div class="col m9">';
	echo"<div class='bread'><a href='./mercato.php'>Gestione</a> / Classifica</div><br>";
	echo"
		<div class='card'>
		<div class='card-content'>
		<span class='card-title'>Classifica<span style='font-size: 13px;'> - Aggiornata alla giornata $num_giornata</span></span>
		<hr>
		<div class='row'>
		<table class='center'>
		<tr><td class='testa'>Squadra</td>
		<td class='testa'><a href='classifica.php?ordinamento=1' class='user1'>Punti</a></td>
		<td class='testa'>G</td>
		<td class='testa'>V</td>
		<td class='testa'>N</td>
		<td class='testa'>P</td>
		<td class='testa'>GC</td>
		<td class='testa'>VC</td>
		<td class='testa'>NC</td>
		<td class='testa'>PC</td>
		<td class='testa'>RFC</td>
		<td class='testa'>RSC</td>
		<td class='testa'>GF</td>
		<td class='testa'>VF</td>
		<td class='testa'>NF</td>
		<td class='testa'>PF</td>
		<td class='testa'>RFF</td>
		<td class='testa'>RSF</td>
		<td class='testa'><a href='classifica.php?ordinamento=4' class='user1'>RF</a></td>
		<td class='testa'><a href='classifica.php?ordinamento=5' class='user1'>RS</a></td>
		<td class='testa'><a href='classifica.php?ordinamento=6' class='user1'>DIFF</a></td>
		<td class='testa'><a href='classifica.php?ordinamento=7' class='user1'>TPF</a></td></tr>";
	
	$num_colonne = 0;
	$num2 = 0;
	$leggendo_formazioni = "SI";
	$leggendo_punteggi = "NO";
	$punteggi_esistenti = "NO";
	
	$file_giornata = @file($percorso_cartella_dati."/giornata".$giornata."_".$_SESSION['torneo']."_".$_SESSION['serie']);
	$num_linee_file_giornata = count($file_giornata);
	for($num1 = 0 ; $num1 < $num_linee_file_giornata; $num1++) {
		$linea = togli_acapo($file_giornata[$num1]);
		if ($linea == "#@& fine formazioni #@&") $leggendo_formazioni = "NO";
		if ($leggendo_formazioni == "SI") {
			if ($linea == "#@& formazione #@&") $outente = "";
			if ($outente) {
				${$formazione}[$num2] = $file_giornata[$num1];
				$num2++;
			} # fine if ($outente)
			if ($aggiorna_giocatore) {
				$outente = $linea;
				$formazione = "formazione_$outente";
				$num2 = 0;
				$aggiorna_giocatore = "";
			} # fine if ($aggiorna_giocatore)
			if ($linea == "#@& formazione #@&") $aggiorna_giocatore = "SI";
		} # fine if ($leggendo_formazioni == "SI")
		
		if ($linea == "#@& fine voti #@&") $leggendo_voti = "NO";
		if ($leggendo_voti == "SI") {
			$voti[$num2] = $linea;
			$num2++;
		} # fine if ($leggendo_voti == "SI")
		if ($linea == "#@& voti #@&") {
			$leggendo_voti = "SI";
			$voti_esistenti = "SI";
			$num2 = 0;
		} # fine if ($linea == "#@& voti #@&")
		
		if ($linea == "#@& fine modificatore #@&") $leggendo_modificatore = "NO";
		
		if ($linea == "#@& fine punteggi #@&") $leggendo_punteggi = "NO";
		if ($leggendo_punteggi == "SI") {
			$punteggi[$num2] = $linea;
			$num2++;
		} # fine if ($leggendo_punteggi == "SI")
		if ($linea == "#@& punteggi #@&") {
			$leggendo_punteggi = "SI";
			$punteggi_esistenti = "SI";
			$num2 = 0;
		} # fine if ($linea == "#@& punteggi #@&")
	} # fine for $num1
	
	if ($voti_esistenti == "SI") {
		
		$num_voti = count($voti);
		for ($num1 = 0 ; $num1 < $num_voti ; $num1++) {
			$dati_voti = explode("##@@&&", $voti[$num1]);
			settype($dati_voti[1],"double");
			$voto[$dati_voti[0]] = $dati_voti[1];
		} # fine for $num1
		
		$tipo_campionato = "";
		$num_giornata = str_replace("giornata","",$giornata);
		if (substr($num_giornata,0,1) == 0) $num_giornata = substr($num_giornata,1);
		$num_campionati = count($campionato);
		reset($campionato);
		for($num1 = 0 ; $num1 < $num_campionati; $num1++) {
			$key_campionato = key($campionato);
			$giornate_campionato = explode("-",$key_campionato);
			if ($num_giornata <= $giornate_campionato[1] and $num_giornata >= $giornate_campionato[0]) {
				$num_giornata_campionato = $num_giornata - $giornate_campionato[0] + 1;
				$tipo_campionato = $campionato[$key_campionato];
				$g_inizio_campionato = $giornate_campionato[0];
				break;
			} # fine if ($num_giornata <= $giornate_campionato[1] and...
					next($campionato);
				} # fine for $num1
				if (!$tipo_campionato) $tipo_campionato = "N";
		
		if ($tipo_campionato != "N") {
			
			$num_punteggi = count($punteggi);
			for ($num1 = 0 ; $num1 < $num_punteggi ; $num1++) {
				$dati_punteggio = explode("##@@&&", $punteggi[$num1]);
				settype($dati_punteggio[1],"double");
				$punti[$dati_punteggio[0]] = $dati_punteggio[1];
			} # fine for $num1
			
			####################################################
			# calcolo la classifica fino a questa giornata
			####################################################
			
			for ($num1 = $g_inizio_campionato ; $num1 < $num_giornata ; $num1++) {
				if (strlen($num1) == 1) $num1 = "0".$num1;
				$giornata_punti = "giornata$num1";
				if (@is_file($percorso_cartella_dati."/".$giornata_punti."_".$_SESSION['torneo']."_".$_SESSION['serie'])) {
					$file_giornata_p = @file($percorso_cartella_dati."/".$giornata_punti."_".$_SESSION['torneo']."_".$_SESSION['serie']);
					$num_linee_file_giornata_p = count($file_giornata_p);
					$leggendo_punteggi = "NO";
					$punteggi_esistenti_p = "NO";
					for($num2 = 0 ; $num2 < $num_linee_file_giornata_p; $num2++) {
						$linea = togli_acapo($file_giornata_p[$num2]);
						if ($linea == "#@& fine punteggi #@&") $leggendo_punteggi = "NO";
						if ($leggendo_punteggi == "SI") {
							$punteggi_p[$num3] = $file_giornata_p[$num2];
							$num3++;
						} # fine if ($leggendo_punteggi == "SI")
						if ($linea == "#@& punteggi #@&") {
							$leggendo_punteggi = "SI";
							$punteggi_esistenti_p = "SI";
							$num3 = 0;
						} # fine if ($leggendo_punteggi == "SI")
					} # fine for $num1
					if ($punteggi_esistenti_p == "SI") {
						$num_punteggi_p = count($punteggi_p);
						for ($num2 = 0 ; $num2 < $num_punteggi_p ; $num2++) {
							$dati_punteggio = explode("##@@&&", $punteggi_p[$num2]);
							settype($dati_punteggio[1],"double");
							$punti[$dati_punteggio[0]] = ($punti[$dati_punteggio[0]] + $dati_punteggio[1]);
						} # fine for $num2
					} # fine if ($punteggi_esistenti_p == "SI")
				} # fine if (@is_file("$percorso_cartella_dati/$giornata_punti"))
			} # fine for $num1
			
			#######################
			#  Calcolo voti
			######################
			
			$num_giornata = preg_replace("#giornata#","",$giornata);
			for ($num1 = $g_inizio_campionato ; $num1 < $num_giornata+1 ; $num1++) {
				if (strlen($num1) == 1) $num1 = "0".$num1;
				$giornata_punti = "giornata$num1";
				if (@is_file($percorso_cartella_dati."/".$giornata_punti."_".$_SESSION['torneo']."_".$_SESSION['serie'])) {
					$file_giornata_p = @file($percorso_cartella_dati."/".$giornata_punti."_".$_SESSION['torneo']."_".$_SESSION['serie']);
					$num_linee_file_giornata_p = count($file_giornata_p);
					$leggendo_voti = "NO";
					$voti_esistenti_p = "NO";
					for($num2 = 0 ; $num2 < $num_linee_file_giornata_p; $num2++) {
						$linea = togli_acapo($file_giornata_p[$num2]);
						if ($linea == "#@& fine voti #@&") $leggendo_voti = "NO";
						if ($leggendo_voti == "SI") {
							$voti_p[$num3] = $file_giornata_p[$num2];
							$num3++;
						} # fine if ($leggendo_voti == "SI")
						if ($linea == "#@& voti #@&") {
							$leggendo_voti = "SI";
							$voti_esistenti_p = "SI";
							$num3 = 0;
						} # fine if ($leggendo_voti == "SI")
					} # fine for $num1
					if ($voti_esistenti_p == "SI") {
						$num_voti_p = count($voti_p);
						for ($num2 = 0 ; $num2 < $num_voti_p ; $num2++) {
							$dati_voti = explode("##@@&&", $voti_p[$num2]);
							settype($dati_voti[1],"double");
							if ($dati_voti[1] > $magg) {
								$magg = $dati_voti[1];
								$gioc = $dati_voti[0];
								$gior = $num1;
							}
							$voti[$dati_voti[0]] = ($voti[$dati_voti[0]] + $dati_voti[1]);
						} # fine for $num2
					} # fine if ($voti_esistenti_p == "SI")
				} # fine if (@is_file("$percorso_cartella_dati/$giornata_punti"))
			} # fine for $num1
			
			#######################
			#  Calcolo gol
			######################
			
			$num_giornata = preg_replace("#giornata#","",$giornata);
			for ($num1 = $g_inizio_campionato ; $num1 < $num_giornata +1 ; $num1++) {
				if (strlen($num1) == 1) $num1 = "0".$num1;
				$giornata_punti = "giornata$num1";
				if (@is_file($percorso_cartella_dati."/".$giornata_punti."_".$_SESSION['torneo']."_".$_SESSION['serie'])) {
					$file_giornata_p = @file($percorso_cartella_dati."/".$giornata_punti."_".$_SESSION['torneo']."_".$_SESSION['serie']);
					$num_linee_file_giornata_p = count($file_giornata_p);
					$leggendo_gol = "NO";
					$gol_esistenti_p = "NO";
					for($num2 = 0 ; $num2 < $num_linee_file_giornata_p; $num2++) {
						$linea = togli_acapo($file_giornata_p[$num2]);
						if ($linea == "#@& fine scontri #@&") $leggendo_gol = "NO";
						if ($leggendo_gol == "SI") {
							$gol_p[$num3] = $file_giornata_p[$num2];
							$num3++;
						} # fine if ($leggendo_gol == "SI")
						if ($linea == "#@& scontri #@&") {
							$leggendo_gol = "SI";
							$gol_esistenti_p = "SI";
							$num3 = 0;
						} # fine if ($leggendo_gol == "SI")
					} # fine for $num1
					if ($gol_esistenti_p == "SI") {
						$num_gol_p = count($gol_p);
						for ($num2 = 0 ; $num2 < $num_gol_p ; $num2++) {
							$dati_gol = explode("##@@&&", $gol_p[$num2]);
							
							$GolF[$dati_gol[0]]=$GolF[$dati_gol[0]] + $dati_gol[2] ;
							$GolF[$dati_gol[1]]=$GolF[$dati_gol[1]] + $dati_gol[3] ;
							$GolS[$dati_gol[0]]=$GolS[$dati_gol[0]] + $dati_gol[3] ;
							$GolS[$dati_gol[1]]=$GolS[$dati_gol[1]] + $dati_gol[2] ;
							$GolFC[$dati_gol[0]]=$GolFC[$dati_gol[0]] + $dati_gol[2];
							$GolSC[$dati_gol[0]]=$GolSC[$dati_gol[0]] + $dati_gol[3];
							$GolFF[$dati_gol[1]]=$GolFF[$dati_gol[1]] + $dati_gol[3];
							$GolSF[$dati_gol[1]]=$GolSF[$dati_gol[1]] + $dati_gol[2];
							
							if ($dati_gol[2] - $dati_gol[3] > 0) {
								$VC[$dati_gol[0]] = $VC[$dati_gol[0]] + 1;
								$PF[$dati_gol[1]] = $PF[$dati_gol[1]] + 1;
							}; # FINE if ($$dati_gol[2] > $$dati_gol[3])
							
							if ($dati_gol[2] - $dati_gol[3] == 0) {
								$NC[$dati_gol[0]] = $NC[$dati_gol[0]] + 1;
								$NF[$dati_gol[1]] = $NF[$dati_gol[1]] + 1;
							}; # FINE if ($$dati_gol[2] > $$dati_gol[3]) {
								
								if ($dati_gol[2] - $dati_gol[3] < 0) {
									$PC[$dati_gol[0]] = $PC[$dati_gol[0]] + 1;
									$VF[$dati_gol[1]] = $VF[$dati_gol[1]] + 1;
									
								}; # FINE if ($$dati_gol[2] > $$dati_gol[3]) {
									
									settype($dati_gol[1],"double");
									
									$gol[$outente] = ($gol[$dati_gol[$outente]] + $dati_gol[1]);
									
								} # fine for $num2
							} # fine if ($gol_esistenti_p == "SI")
						} # fine if (@is_file("$percorso_cartella_dati/$giornata_punti"))
					} # fine for $num1
					
					#echo "</td><td>";
					$numconta=0;
					
					for($num1 = 1 ; $num1 < $linee; $num1++) {
						
						@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file_utenti[$num1]);
						
						$GF[$outente] = $VF[$outente] + $NF[$outente] + $PF[$outente];
						$GC[$outente] = $VC[$outente] + $NC[$outente] + $PC[$outente];
						$G[$outente] = $GC[$outente] + $GF[$outente];
						$V[$outente] = $VC[$outente] + $VF[$outente];
						$N[$outente] = $NC[$outente] + $NF[$outente];
						$P[$outente] = $PC[$outente] + $PF[$outente];
						
						if ($V[$outente] < 1) {
							$V[$outente] = 0;
						};
						
						if ($N[$outente] < 1) {
							$N[$outente] = 0;
						};
						
						if ($P[$outente] < 1) {
							$P[$outente] = 0;
						};
						
						if ($VF[$outente] < 1) {
							$VF[$outente] = 0;
						};
						
						if ($NF[$outente] < 1) {
							$NF[$outente] = 0;
						};
						
						if ($PF[$outente] < 1) {
							$PF[$outente] = 0;
						};
						
						if ($VC[$outente] < 1) {
							$VC[$outente] = 0;
						};
						
						if ($NC[$outente] < 1) {
							$NC[$outente] = 0;
						};
						
						if ($PC[$outente] < 1) {
							$PC[$outente] = 0;
						};
						
						$Diff[$outente] = $GolF[$outente] - $GolS[$outente];
						
						####################################################
						# nome squadra
						####################################################
						
						$team[$outente] = $osquadra;
						$classifica[$numconta]=array($team[$outente],$punti[$outente],$outente,$Tpf[$outente],$GolF[$outente] + 1000000,$GolS[$outente] + 1000000 ,$Diff[$outente] + 1000000,$voti[$outente]+1000000);
						$numconta++;
						
					} # fine for $num1
					
					function cmp1 ($a, $b) {
						global $ordinamento;
						# return strcmp($b[$ordinamento], $a[$ordinamento]);
						$c = floatval($a[$ordinamento]);
						$d = floatval($b[$ordinamento]);
						$e = floatval($a[6]);
						$f = floatval($b[6]);
						if ($c > $d) return -1;
						if ($c < $d) return 1;
						if ($c == $d){
							if ($e > $f) return -1 ;
							if ($e < $f) return 1;
							if ($e == $f) return 0;
						}
					}
					
					usort($classifica, "cmp1");
					
					# print_r ($classifica);
					
					$linee = count($classifica);
					
					for($num1 = 0 ; $num1 < $linee; $num1++) {
						
						$kgiocatore = $classifica[$num1][2];
						$ksquadra = $classifica[$num1][0];
						
						if (!$ksquadra) {$ksquadra = "<b>".$kgiocatore."</b>";} else $ksquadra = "<b>".$ksquadra."</b>&nbsp;di&nbsp;".$kgiocatore;
						
						$tabstat .= "<tr>
					<td align='left'>&nbsp;<a href='giornate.php?opzione=2&amp;nome_squadra=$kgiocatore'>$ksquadra</a></td>
					<td bgcolor='#D3D3D3' align='center'>&nbsp;$punti[$kgiocatore]</td>
					<td align='center'>&nbsp;$G[$kgiocatore]</td>
					<td align='center'>&nbsp;$V[$kgiocatore]</td>
					<td align='center'>&nbsp;$N[$kgiocatore]</td>
					<td align='center'>&nbsp;$P[$kgiocatore]</td>
					<td bgcolor='#F5DEB3' align='center'>&nbsp;$GC[$kgiocatore]</td>
					<td bgcolor='#F5DEB3' align='center'>&nbsp;$VC[$kgiocatore]</td>
					<td bgcolor='#F5DEB3' align='center'>&nbsp;$NC[$kgiocatore]</td>
					<td bgcolor='#F5DEB3' align='center'>&nbsp;$PC[$kgiocatore]</td>
					<td bgcolor='#AFEEEE' align='center'>&nbsp;$GolFC[$kgiocatore]</td>
					<td bgcolor='#AFEEEE' align='center'>&nbsp;$GolSC[$kgiocatore]</td>
					<td bgcolor='#F0E68C' align='center'>&nbsp;$GF[$kgiocatore]</td>
					<td bgcolor='#F0E68C' align='center'>&nbsp;$VF[$kgiocatore]</td>
					<td bgcolor='#F0E68C' align='center'>&nbsp;$NF[$kgiocatore]</td>
					<td bgcolor='#F0E68C' align='center'>&nbsp;$PF[$kgiocatore]</td>
					<td bgcolor='#B0E0E6' align='center'>&nbsp;$GolFF[$kgiocatore]</td>
					<td bgcolor='#B0E0E6' align='center'>&nbsp;$GolSF[$kgiocatore]</td>
					<td bgcolor='yellow' align='center'>&nbsp;$GolF[$kgiocatore]</td>
					<td bgcolor='red' align='center'>&nbsp;$GolS[$kgiocatore]</td>
					<td align='center'>&nbsp;$Diff[$kgiocatore]</td>
					<td bgcolor='#B0E0E6' align='center'><b>&nbsp;$voti[$kgiocatore]</b></td></tr>";
						
					} # fine for
					
				} # fine if ($tipo_campionato != "N")
				
			} # fine if ($voti_esistenti == "SI")
			
			else {
				if (@is_file($percorso_cartella_voti."/voti".$num_giornata.".txt")) {
					return;
				} # fine if (@is_file("$percorso_cartella_dati/voti$num_giornata.txt"))
				else {
					if ($prima_parte_pos_file_voti or $num_giornata_file_voti == "SI") {
						$posizione_file = $prima_parte_pos_file_voti;
						if ($num_giornata_file_voti == "SI") {
							$num_giornata = preg_replace("#giornata#","",$giornata);
							$num_giornata = $num_giornata + $diff_num_giornata_file;
							if ($num_giornata_file_voti_doppio == "SI") {
								if (strlen($num_giornata) == 1) $num_giornata = "0".$num_giornata;
							} # fine if ($num_giornata_file_voti_doppio == "SI")
							$posizione_file .= "$num_giornata".$seconda_parte_pos_file_voti;
						} # fine if ($num_giornata_file_voti == "SI")
						
					} # fine if ($prima_parte_pos_file_voti or...
							
						} # fine else if (@is_file("$percorso_cartella_dati/voti$num_giornata.txt"))
				
			} # fine else if ($voti_esistenti == "SI"))
			
			$tabstat .= "</table>";
			
			if ($gior > 0) {
				echo $tabstat;
				
				echo"
			<h5>Miglior punteggio fino ad ora: <u>$magg</u>, realizzato da <u>$gioc</u> alla giornata <u>$gior</u></h5>\n";
				
				echo "<p style='margin:10px; padding:10px; background-color: $sfondo_tab; width: 200px; border: 1px solid $stondo_tab3'>
			<b><u>Legenda</u></b><br />
			G: partite giocate<br />
			V: partite vinte<br />
			N: partite pareggiate<br />
			P: partite perse<br />
			GC: partite giocate in casa<br />
			VC: partite vinte in casa<br />
			NC: partite pareggiate in casa<br />
			PC: partite perse in casa<br />
			RFC: reti fatte in casa<br />
			RSC: reti subite in casa<br />
			GF: partite giocate fuori casa<br />
			VF: partite vinte fuori casa<br />
			NF: partite pareggiate fuori casa<br />
			PF: partite perse fuori casa<br />
			RFF: reti fatte fuori casa<br />
			RSF: reti subite fuori casa<br />
			RF: reti fatte<br />
			RS: reti subite<br />
			DIFF: differenza reti<br />
			TPF: totale punti fatti</p>";
			}
			else echo"<center><br /><br /><h2>Non sono stati effettuati ancora i calcoli!</h2>
		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></center>\n";
			
			echo"</div></div></div></div></div></div></div>";	
		} # fine elseif ($_SESSION['valido'] == "SI")
		else echo"<meta http-equiv='refresh' content='0; url=logout.php'>";
		
		include("./footer.php");
		?>	