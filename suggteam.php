<?php
	##################################################################################
	#    FANTACALCIOBAZAR EVOLUTION
	#    Copyright (C) 2003 by Antonello Onida (fantacalcio@sassarionline.net)
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
	#
	# 05-08-2004 angelo@dabrosca.net :
	#    Visualizza la best team delle ultime n giornate (Per adesso $range fisso a 5)
	#    Vengono considerati solo i giocatori che nelle ultime n giornate hanno giocato
	#    un numero di partite maggiore uguale a $range%2
	#
	# 04-09-2004 angelo@dabrosca.net ;
	#    inserita variabile in dati.php --> $separatore_campi_mercato = ","; <--
	#
	#
	##################################################################################
	require_once("./controlla_pass.php");
	include("./header.php");
	
	if ($_SESSION['valido'] == "SI") {
		
		for ($num1 = 1 ; $num1 < 40 ; $num1++) {
			if (strlen($num1) == 1) $num1 = "0".$num1;
			$giornata_controlla = "giornata$num1";
			if (!@is_file($percorso_cartella_dati."/".$giornata_controlla."_".$_SESSION['torneo']."_".$_SESSION['serie'])) break;
			else $giornata_ultima = $num1;
		} # fine for $num1
		
		$ultima_giornata = $giornata_ultima;
		/* Calcolo il numero minimo di partite_disputate per prendere in considerazione il giocatore   */
		
		if (!$range) $range=5;
		
		$partite_minime_per_range = $range/3;
		
		if ($range%2) $partite_minime_per_range = round($partite_minime_per_range,0);
		
		$fine_range = $ultima_giornata;
		if ($ultima_giornata > $range){
			$inizio_range = $ultima_giornata - $range +1;
		}
		else {
			$inizio_range = 1 ;
		}
		
		if (strlen($inizio_range) == 1) $inizio_range = "0".$inizio_range;
		
		#######################################
		
		$vedi_squadra = $_SESSION['utente'];
		echo '<div class="container" style="width: 85%;margin-top: -10px;">
	<div class="card-panel">
    	<div class="row">';
			
			require ("./widget.php");
			echo'<div class="col m9">';
				echo"<div class='bread'><a href='./mercato.php'>Gestione</a> / Forma Squadra</div><br>
				<div class='card'>
				    <div class='card-content'>
				        <span class='card-title'>Formazione consigliata<span style='font-size: 13px;'> - Calciatori migliori nelle ultime $range giornate</span></span>
			 	        <hr>";
		echo "<br/><table width='100%' cellpadding='5'  align='center' bgcolor='$sfondo_tab'>
		<tr><td><center><br/>Giornate in esame --> $inizio_range - $fine_range<br/>
		<h3>Modulo selezionato: $dif - $cen - $att</h3>
		<table width='100%' cellpadding='2' align='center'>
		<tr><td class='testa'>Num.</td>
		<td class='testa'>Nome</td>
		<td class='testa'>Ruolo</td>
		<td class='testa'>Partite</td>
		<td class='testa'>Media</td>
		<td class='testa'>MediaFC</td>
		<td class='testa'>Gol</td>
		<td class='testa'>Assist</td>
		<td class='testa'>Rigori</td>
		<td class='testa'>Gialli</td>
		<td class='testa'>Rossi</td>
		</tr>";
		
		#######################################
		$voti = file($percorso_cartella_voti."/voti".$ultima_giornata.".txt");
		$num_voti = count($voti);
		
		#Aggiunte
		$cerca_squadra = @file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
		$num_cer_squ = count($cerca_squadra);
		
		#echo "<pre>";
		#print_r ($cerca_squadra);
		array_multisort ($cerca_squadra,SORT_ASC, SORT_STRING);
		#print_r ($cerca_squadra);
		#echo "</pre>";
		
		$partite_giocate = 0;
		$somma_voti_tot = 0;
		$somma_voti_giornale = 0;
		
		for ($knum1 = 0 ; $knum1 < $num_cer_squ; $knum1++) {
			$dati_calciatore = explode(",", $cerca_squadra[$knum1]);
			
			$numero = $dati_calciatore[0];
			$numero = trim($numero);
			$num_calciatore = $numero;
			$nome = $dati_calciatore[1];
			$nome = trim($nome);
			$nome = preg_replace("#\"#","",$nome);
			$s_ruolo = $dati_calciatore[2];
			$s_ruolo = trim($s_ruolo);
			$ruolo = $s_ruolo;
			$valore = $dati_calciatore[3];
			$valore = trim($valore);
			$xsquadra = $dati_calciatore[4];
			$xsquadra = trim($xsquadra);
			$xsquadra = preg_replace("#\"#","",$xsquadra);
			
			if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
			if ($s_ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
			if ($s_ruolo == $simbolo_portiere_file_calciatori) $ruolo = "P";
			if ($s_ruolo == $simbolo_difensore_file_calciatori) $ruolo = "D";
			if ($s_ruolo == $simbolo_centrocampista_file_calciatori) $ruolo = "C";
			if ($s_ruolo == $simbolo_attaccante_file_calciatori) $ruolo = "A";
			
			if ($xsquadra == $vedi_squadra) {
				for ($num1 = $inizio_range; $num1 <= $fine_range; $num1++) {
					if (strlen($num1) == 1) $num1 = "0".$num1;
					
					if ($voti = @file("$percorso_cartella_voti/voti$num1.txt")) {
						$num_voti = count($voti);
						$calciatori = @file("$percorso_cartella_dati/calciatori.txt");
						$num_calciatori = count($calciatori);
						for ($num2 = 0 ; $num2 < $num_voti ; $num2++) {
							$dati_voto = explode($separatore_campi_file_voti, $voti[$num2]);
							$num_calciatore_voto = $dati_voto[($num_colonna_numcalciatore_file_voti-1)];
							$num_calciatore_voto = ($num_calciatore_voto);
							
							if ($num_calciatore == $num_calciatore_voto) {
								$voto_tot = $dati_voto[($num_colonna_vototot_file_voti-1)];
								$voto_tot = ($voto_tot);
								$voto_tot = str_replace($separatore_campi_file_calciatori,".",$voto_tot);
								$voto_giornale = $dati_voto[($num_colonna_votogiornale_file_voti-1)];
								$voto_giornale = ($voto_giornale);
								$voto_giornale = str_replace($separatore_campi_file_calciatori,".",$voto_giornale);
								if ($voto_tot != 0 or $voto_giornale != 0) {
									$partite_giocate++;
									$somma_voti_tot = $somma_voti_tot + $voto_tot;
									$somma_voti_giornale = $somma_voti_giornale + $voto_giornale;
								} # fine if ($voto_tot != 0 or $voto_giornale != 0)
								
								if ($statistiche == "SI") {
									$stat_codice = $dati_voto[($ncs_codice -1)];
									$stat_giornata = $dati_voto[($ncs_giornata -1)];
									$stat_nome = $dati_voto[($ncs_nome -1)];
									$stat_nome = preg_replace("#\"#","",$stat_nome);
									$stat_squadra = $dati_voto[($ncs_squadra -1)];
									$stat_squadra = preg_replace("#\"#","",$stat_squadra);
									$stat_attivo = $dati_voto[($ncs_attivo -1)];
									$stat_ruolo = $dati_voto[($ncs_ruolo -1)];
									$stat_presenza = $dati_voto[($ncs_presenza -1)]; $totpresenze = $totpresenze + $stat_presenza;
									$stat_votofc = $dati_voto[($ncs_votofc -1)]; $totvotfc = $totvotfc + $stat_votofc;
									$stat_mininf25 = $dati_voto[($ncs_mininf25 -1)]; $totmininf25 = $totmininf25 + $stat_mininf25;
									$stat_minsup25 = $dati_voto[($ncs_minsup25 -1)]; $totminsup25 = $totminsup25 + $stat_minsup25;
									$stat_voto = $dati_voto[($ncs_voto -1)]; $totvot = $totvot + $stat_voto;
									$stat_golsegnati = $dati_voto[($ncs_golsegnati -1)]; $totgol = $totgol + $stat_golsegnati;
									$stat_golsubiti = $dati_voto[($ncs_golsubiti -1)]; $totgolsub = $totgolsub + $stat_golsubiti;
									$stat_golvittoria = $dati_voto[($ncs_golvittoria -1)]; $totgolvit = $totgolvit + $stat_golvittoria;
									$stat_golpareggio = $dati_voto[($ncs_golpareggio -1)]; $totgolpar = $totgolpar + $stat_golpareggio;
									$stat_assist = $dati_voto[($ncs_assist -1)]; $totass = $totass + $stat_assist;
									$stat_ammonizione = $dati_voto[($ncs_ammonizione -1)]; $totamm = $totamm + $stat_ammonizione;
									$stat_espulsione = $dati_voto[($ncs_espulsione -1)]; $totesp = $totesp + $stat_espulsione;
									$stat_rigoretirato = $dati_voto[($ncs_rigoretirato -1)]; $totrigt = $totrigt + $stat_rigoretirato;
									$stat_rigoresubito = $dati_voto[($ncs_rigoresubito -1)]; $totrigs = $totrigs + $stat_rigoresubito;
									$stat_rigoreparato = $dati_voto[($ncs_rigoreparato -1)]; $totrigp = $totrigp + $stat_rigoreparato;
									$stat_rigoresbagliato = $dati_voto[($ncs_rigoresbagliato -1)]; $totrigsb = $totrigsb + $stat_rigoresbagliato;
									$stat_autogol = $dati_voto[($ncs_autogol -1)]; $totaut = $totaut + $stat_autogol;
									$stat_subentrato = $dati_voto[($ncs_entrato -1)];
									$stat_titolare = $dati_voto[($ncs_titolare -1)]; $tottit = $tottit + $stat_titolare;
									$stat_valore = $dati_voto[($ncs_valore -1)];
									$tot_golsegnati = $tot_golsegnati + $stat_golsegnati;
									$tot_golsubiti = $tot_golsubiti + $stat_golsubiti;
								}  # Fine if ($statistiche == "SI") 
								
								break;
							} # fine if ($num_calciatore == $num_calciatore_voto)
							$ultima_giornata = $num1;
						} # fine for ($num2 = 0 ; $num2 < $num_voti ; $num2++) {
					} # fine if ($voti = @file("$percorso_cartella_voti/voti$num1.txt"))
				} # fine for $num1 Cicla sulle giornate
				
				if ($partite_giocate != 0) {
					$media_giornale = round(($somma_voti_giornale /$partite_giocate),2);
					$media_punti = round(($somma_voti_tot / $partite_giocate),2);
				} # fine if ($partite_giocate != 0)
				else {
					$media_giornale = 0;
					$media_punti = 0;
				} # fine else if ($partite_giocate != 0)
				
				$calciatori = @file($percorso_cartella_dati."/calciatori.txt");
				$num_calciatori = count($calciatori);
				for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
					$dati_calciatore = explode($separatore_campi_file_calciatori, $calciatori[$num1]);
					$numero = $dati_calciatore[($num_colonna_numcalciatore_file_calciatori-1)];
					$numero = ($numero);
					if ($num_calciatore == $numero) {
						$nome = $dati_calciatore[($num_colonna_nome_file_calciatori-1)];
						$nome = ($nome);
						$nome = preg_replace("#\"#","",$nome);
						if ($num_colonna_squadra_file_calciatori != 0) {
							$xsquadra = $dati_calciatore[($num_colonna_squadra_file_calciatori-1)];
							$xsquadra = ($xsquadra);
							$xsquadra = preg_replace("#\"#","",$xsquadra);
						} # fine if ($num_colonna_squadra_file_calciatori != 0)
						$s_ruolo = $dati_calciatore[($num_colonna_ruolo_file_calciatori-1)];
						$s_ruolo = ($s_ruolo);
						$ruolo = $s_ruolo;
						
						if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
						if ($s_ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
						if ($s_ruolo == $simbolo_portiere_file_calciatori) $ruolo = "P";
						if ($s_ruolo == $simbolo_difensore_file_calciatori) $ruolo = "D";
						if ($s_ruolo == $simbolo_centrocampista_file_calciatori) $ruolo = "C";
					if ($s_ruolo == $simbolo_attaccante_file_calciatori) $ruolo = "A";
					break;
					} # fine if ($num_calciatore == $numero)
					} # fine for $num1
					
					if ($statistiche == "SI") {
					if ($stat_attivo == 0) $mess = "<b><font color=red>Non disponibile</font></b>";
					else $mess = "In attività";
					
					if ($stat_ruolo == 0) $st_ruolo = "Portiere" ;
					if ($stat_ruolo == 1) $st_ruolo = "Difensore";
					if ($stat_ruolo == 2) $st_ruolo = "Centrocampista";
					if ($stat_ruolo == 3) $st_ruolo = "Attaccante";
					#if ($stat_ruolo == 3) $st_ruolo = "Fantasista";
					
					if ($ruolo == "P" and $totpresenze >= $partite_minime_per_range){
					$portieri[]=array($nome,$totpresenze,$media_giornale,$tot_golsegnati,$stat_ammonizione,$stat_espulsione,$media_punti+10,$totass,$numero);
					}
					if ($ruolo == "D" and $totpresenze >= $partite_minime_per_range){
					$difensori[]=array($nome,$totpresenze,$media_giornale,$tot_golsegnati,$stat_ammonizione,$stat_espulsione,$media_punti+10,$totass,$numero);
					}
					
					if ($ruolo == "C" and $totpresenze >= $partite_minime_per_range){
					$centrocampisti[]=array($nome,$totpresenze,$media_giornale,$tot_golsegnati,$stat_ammonizione,$stat_espulsione,$media_punti+10,$totass,$numero);
					}
					
					if ($ruolo == "A" and $totpresenze >= $partite_minime_per_range){
					$attaccanti[]=array($nome,$totpresenze,$media_giornale,$tot_golsegnati,$stat_ammonizione,$stat_espulsione,$media_punti+10,$totass,$numero);
					}
					
					if ($ruolo == "F" and $totpresenze >= $partite_minime_per_range){
					$fantasisti[]=array($nome,$totpresenze,$media_giornale,$tot_golsegnati,$stat_ammonizione,$stat_espulsione,$media_punti+10,$totass,$numero);
					}
					
					} #Fine  if ($xsquadra==$vedi_squadra) {
					
					$stat_presenza=0;
					$totpresenze=0;
					$stat_votofc=0;
					$totvotfc=0;
					$stat_voto=0;
					$totvot=0;
					$stat_golsegnati=0;
					$tot_golsegnati=0;
					$stat_golsubiti=0;
					$tot_golsubiti=0;
					$stat_golvittoria=0;
					$totgolvit=0;
					$stat_golpareggio=0;
					$totgolpar=0;
					$stat_assist=0;
					$totass=0;
					$stat_ammonizione=0;
					$totamm=0;
					$stat_espulsione=0;
					$totesp=0;
					$stat_rigoretirato=0;
					$totrigt=0;
					$stat_rigoresubito=0;
					$totrigs=0;
					$stat_rigoreparato=0;
					$totrigp=0;
					$stat_rigoresbagliato=0;
					$totrigsb=0;
					$stat_autogol=0;
					$totaut=0;
					$partite_giocate=0;
					$media_giornale=0;
					$media_punti=0;
					$partite_giocate = 0;
					$somma_voti_tot = 0;
					$somma_voti_giornale = 0;
					
					} # fine for $Knum1
					
					} # fine if ($statistiche == "SI")
					
					$ordinamento = 6;
					
					function cmp1 ($a, $b) {
					global $ordinamento;
					return strcmp($b[$ordinamento], $a[$ordinamento]);
					}
					
					usort($portieri, "cmp1");
					usort($difensori, "cmp1");
					usort($centrocampisti, "cmp1");
					usort($attaccanti, "cmp1");
					
					#Crea tabella
					if ($ruolo == "P") $tot_golsegnati = $tot_golsubiti;
					
					$color="white";
					$nome = $portieri[0][0];
					$totpresenze = $portieri[0][1];
					$media_giornale = $portieri[0][2];
					$tot_golsegnati = $portieri[0][3];
					$stat_ammonizioni = $portieri[0][4];
					$stat_espulsione = $portieri[0][5];
					$media_punti = $portieri[0][6]-10;
					$totass = $portieri[0][7];
					$numero = $portieri[0][8];
					
					echo "<tr bgcolor = '$color'>";
					echo "<td><a href='stat_calciatore.php?num_calciatore=$numero&ruolo_guarda=$ruolo_guarda' class='user'>$numero</a></td>
					<td align='left'>$nome</td>
					<td align='center'>P</td>
					<td align='center'>$totpresenze</td>
					<td align='center'>$media_giornale</td>
					<td align='center'>$media_punti</td>
					<td align='center'>$tot_golsegnati</td>
					<td align='center'>$totass</td>
					<td align='center'>$stat_rigoretirato</td>
					<td align='center'>$stat_ammonizione</td>
					<td align='center'>$stat_espulsione</td>
					</tr>";
					
					
					
					for ($i=0; $i<$dif; $i++) {
					
					$color="#cccccc";
					
					$nome = $difensori[$i][0];
					$totpresenze = $difensori[$i][1];
					$media_giornale = $difensori[$i][2];
					$tot_golsegnati = $difensori[$i][3];
					$stat_ammonizioni = $difensori[$i][4];
					$stat_espulsione = $difensori[$i][5];
					$media_punti = $difensori[$i][6]-10;
					$totass = $difensori[$i][7];
					$numero = $difensori[$i][8];
					
					echo "<tr bgcolor = '$color'>";
					echo "<td><a href='stat_calciatore.php?num_calciatore=$numero&ruolo_guarda=$ruolo_guarda' class='user'>$numero</a></td>
					<td align='left'>$nome</td>
					<td align='center'>D</td>
					<td align='center'>$totpresenze</td>
					<td align='center'>$media_giornale</td>
					<td align='center'>$media_punti</td>
					<td align='center'>$tot_golsegnati</td>
					<td align='center'>$totass</td>
					<td align='center'>$stat_rigoretirato</td>
					<td align='center'>$stat_ammonizione</td>
					<td align='center'>$stat_espulsione</td>
					</tr>";
					}
					
					for ($i=0; $i<$cen; $i++) {
					
					$color="white";
					
					$nome = $centrocampisti[$i][0];
					$totpresenze = $centrocampisti[$i][1];
					$media_giornale = $centrocampisti[$i][2];
					$tot_golsegnati = $centrocampisti[$i][3];
					$stat_ammonizioni = $centrocampisti[$i][4];
					$stat_espulsione = $centrocampisti[$i][5];
					$media_punti = $centrocampisti[$i][6]-10;
					$totass = $centrocampisti[$i][7];
					$numero = $centrocampisti[$i][8];
					
					echo "<tr bgcolor = '$color'>";
					echo "<td><a href='stat_calciatore.php?num_calciatore=$numero&ruolo_guarda=$ruolo_guarda' class='user'>$numero</a></td>
					<td align='left'>$nome</td>
					<td align='center'>C</td>
					<td align='center'>$totpresenze</td>
					<td align='center'>$media_giornale</td>
					<td align='center'>$media_punti</td>
					<td align='center'>$tot_golsegnati</td>
					<td align='center'>$totass</td>
					<td align='center'>$stat_rigoretirato</td>
					<td align='center'>$stat_ammonizione</td>
					<td align='center'>$stat_espulsione</td>
					</tr>";
					
					}
					
					for ($i=0; $i<$att; $i++) {
					
					$color="#cccccc";
					
					$nome = $attaccanti[$i][0];
					$totpresenze = $attaccanti[$i][1];
					$media_giornale = $attaccanti[$i][2];
					$tot_golsegnati = $attaccanti[$i][3];
					$stat_ammonizioni = $attaccanti[$i][4];
					$stat_espulsione = $attaccanti[$i][5];
					$media_punti = $attaccanti[$i][6]-10;
					$totass = $attaccanti[$i][7];
					$numero = $attaccanti[$i][8];
					
					echo "<tr bgcolor = '$color'>";
					echo "<td><a href='stat_calciatore.php?num_calciatore=$numero&ruolo_guarda=$ruolo_guarda' class='user'>$numero</a></td>
					<td align='left'>$nome</td>
					<td align='center'>A</td>
					<td align='center'>$totpresenze</td>
					<td align='center'>$media_giornale</td>
					<td align='center'>$media_punti</td>
					<td align='center'>$tot_golsegnati</td>
					<td align='center'>$totass</td>
					<td align='center'>$stat_rigoretirato</td>
					<td align='center'>$stat_ammonizione</td>
					<td align='center'>$stat_espulsione</td>
					</tr>";
					};
					
					echo "</table>";
					echo "<br/><br/><br/><table width='70%' class='border' border='0' cellspacing='0' cellpadding='20' align='center' bgcolor='#FFFFFF'><tr>
					<td align='center' valign='middle'><b>
					Visualizza la miglior formazione</b><br/><br/>Cambia il modulo: ";
					
					echo "<a href='./suggteam.php?dif=3&amp;cen=5&amp;att=2'><b>3 - 5 - 2</b></a> /
					<a href='./suggteam.php?dif=3&amp;cen=4&amp;att=3'><b>3 - 4 - 3</b></a> /
					<a href='./suggteam.php?dif=4&amp;cen=3&amp;att=3'><b>4 - 3 - 3</b></a> /
					<a href='./suggteam.php?dif=4&amp;cen=4&amp;att=2'><b>4 - 4 - 2</b></a> /
					<a href='./suggteam.php?dif=4&amp;cen=5&amp;att=1'><b>4 - 5 - 1</b></a> /
					<a href='./suggteam.php?dif=5&amp;cen=4&amp;att=1'><b>5 - 4 - 1</b></a><br/><br/><br/><br/>";
					
					echo "<form method='post' action='./suggteam.php'>
					<input type='hidden' name='dif' value='$dif'>
					<input type='hidden' name='cen' value='$cen'>
					<input type='hidden' name='att' value='$att'>
					
					<input type='submit' value='Seleziona'> intervallo <select name='range' onChange='submit()'>";
					
					for ($num1 = "02" ; $num1 < 50 ; $num1++) {
					if (strlen($num1) == 1) $num1 = "0".$num1;
					$controlla_giornata = "giornata$num1";
					if (@is_file("$percorso_cartella_dati/voti$num1.txt")) echo "<option value='$num1' selected>$num1</option>";
					else break;
					} # fine for $num1
					
					echo "</select></form><br/>tra le giornate per la generazione delle statistiche.";
					echo "<br/></td></tr></table><br/><br/>";
					echo "</td></tr></table>";
					} # fine if ($_SESSION['valido'] == "SI") {
					else echo"<meta http-equiv='refresh' content='0; url=logout.php'>";
					
					include("./footer.php");
					?>							