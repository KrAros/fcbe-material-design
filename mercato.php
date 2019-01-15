<?php
	##################################################################################
	#    FANTACALCIOBAZAR EVOLUTION
	#    Copyright (C) 2003 - 2010 by Antonello Onida
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
	##################################################################################
	require_once("./controlla_pass.php");
	include("./header.php");
	if ($_SESSION['valido'] == "SI" and $_SESSION['utente'] != $admin_user) {
		#require("./menu.php");
		if(!$_GET['vedi_operazioni']) $vedi_operazioni = "SI";
		
		####################àà	
		echo $acapo."<script type='text/javascript'>
		function CreaOrario() {
		nd = new Date;
		ore = nd.getHours(); min = nd.getMinutes(); sec = nd.getSeconds();
		g = nd.getDate(); m = nd.getMonth()+1; a = nd.getFullYear();
		if (sec < 10) sec0 = '0'; else sec0 = '';
		if (min < 10) min0 = '0'; else min0 = '';
		if (ore < 10) ore0 = '0'; else ore0 = '';
		DinOrario = ore0 + ore + ':' + min0 + min + ':' + sec0 + sec;
		DinData = g +'/'+ m +'/'+ a
		valore = DinOrario
		if (document.getElementById){
		document.getElementById('orario').innerHTML=valore;
		}
		valore = DinData
		if (document.getElementById){
		document.getElementById('data').innerHTML=valore;
		}
		setTimeout('CreaOrario()', 1000)
		}
		window.onload = CreaOrario;
		</script>".$acapo;
		
		$np = 0; $nd = 0; $nc = 0; $nf = 0; $na = 0;
		$calciatori = @file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
		$num_calciatori = count($calciatori);
		for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
			$dati_calciatori[$num1] = explode(",", $calciatori[$num1]);
		}
		
		if ($ordinamento) {
			if ($verso == "asc") {
				function cmp1 ($a, $b) {
					global $ordinamento;
					return strcmp($a[$ordinamento], $b[$ordinamento]);
				}
			}
			else {
				function cmp1 ($a, $b) {
					global $ordinamento;
					return strcmp($b[$ordinamento], $a[$ordinamento]);
				}
			}
			usort($dati_calciatori, "cmp1");
		}
		
		$tab_comprati = "<tr>
		<td class='testa'>Num.</td>
		<td class='testa'>Nome</td>
		<td class='testa'>Ruolo</td>
		<td class='testa'>Costo</td>
		<td class='testa'>Proprietario</td>
		<td class='testa'>Tempo rimasto</td>
		<td class='testa'>&nbsp;</td></tr>";
		
		$soldi_spesi = 0;
		$num_calciatori_posseduti = 0;
		$adesso = mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"));
		
		for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
			$vecchio_proprietario = "";
			$nuovo_costo = "";
			$dati_calciatore = $dati_calciatori[$num1];
			
			if (count($dati_calciatore) >= 6) {
				$numero = $dati_calciatore[0];
				$nome = stripslashes($dati_calciatore[1]);
				$ruolo = $dati_calciatore[2];
				$costo = $dati_calciatore[3];
				$proprietario = $dati_calciatore[4];
				if ($_SESSION['utente'] == $proprietario) {
					$soldi_spesi = $soldi_spesi + $dati_calciatore[3];
					$num_calciatori_posseduti++;
					if ($ruolo == "P") $np++;
					else if ($ruolo == "D") $nd++;
					else if ($ruolo == "C") $nc++;
					else if ($ruolo == "F") $nf++;
					else if ($ruolo == "A") $na++;
				} # fine if ($proprietario == $_SESSION['utente'])
				
				$tempo_off = $dati_calciatore[5];
				$anno_off = substr($tempo_off,0,4);
				$mese_off = intval(substr($tempo_off,4,2));
				$giorno_off = substr($tempo_off,6,2);
				$ora_off = substr($tempo_off,8,2);
				$minuto_off = substr($tempo_off,10,2);
				$secondo_off = substr($tempo_off,12,2);
				$sec_restanti = mktime($ora_off,$minuto_off,0,$mese_off,$giorno_off,$anno_off) - $adesso;
				
				
				if ($sec_restanti < 1 OR ($stato_mercato != "I" and $stato_mercato != "P")) {
					$tempo_restante = "Comprato";
					$offri = "Nessuna opzione";
					
					if ($_SESSION['utente'] == $proprietario and $mercato_libero != "SI" and $stato_mercato == "B") $offri = "<a href='busta_vendi_subito.php?num_calciatore=$numero' class='user'>svincola</a>";
					if ($_SESSION['utente'] != $proprietario and $mercato_libero != "SI" and $stato_mercato == "B") $offri = "<a href='busta_offerta.php?num_calciatore=$numero&amp;altro_utente=$proprietario' class='user'>offerta</a>";
					if ($_SESSION['utente'] == $proprietario and $mercato_libero != "SI" and $stato_mercato != "I" and $stato_mercato != "C") $offri = "<a href='vendi.php?num_calciatore=$numero' class='user'>vendi</a>";
					if ($_SESSION['utente'] != $proprietario and $mercato_libero != "SI" and $stato_mercato != "I" and $stato_mercato != "C") $offri = "<a href='scambia.php?num_calciatore=$numero&amp;altro_utente=$proprietario' class='user'>scambia</a>";
					if ($_SESSION['utente'] != $proprietario and $mercato_libero == "SI" and $stato_mercato == "I") $offri = "<a href='compra.php?num_calciatore=$numero' class='user'>compra</a>";
					if ($_SESSION['utente'] == $proprietario and $mercato_libero == "SI" and $stato_mercato != "I") $offri = "<a href='cambi.php?num_calciatore=$numero' class='user'>cambi</a>";
					elseif ($_SESSION['utente'] == $proprietario and $mercato_libero == "SI" and $stato_mercato == "I") $offri = "<a href='vedi_vendi_subito.php?num_calciatore=$numero' class='user'>vendi ora</a>";
					
					if ($chiusura_giornata == 1) $offri = "<font color='red' size='-2'>Giornata chiusa!</font>";
					
					if ($num1 % 2) $colore=$colore_riga_alt;
					else $colore="#FFFFFF";
					
					$tab_comprati .= "<tr bgcolor=$colore><td align=center>$numero</td>
					<td align='left'>$nome</td>
					<td align='center'>$ruolo</td>
					<td align='center'>$costo</td>
					<td align='center'>$proprietario</td>
					<td align='center'>$tempo_restante</td>
					<td align='center'>$offri</td></tr>";
				} # fine if ($sec_restanti < 0)
				else {
					$tempo_restante = "";
					$giorni=floor($sec_restanti/86400);
					$secondi_resto=$sec_restanti-($giorni*86400); 
					$ore=floor($secondi_resto/3600);
					$secondi_resto=$sec_restanti-($giorni*86400)-($ore*3600);
					$minuti= floor($secondi_resto/60);
					$secondi_resto = $sec_restanti-($giorni*86400)-($ore*3600)-$minuti*60;
					
					if ($giorni > 0) {
						if ($giorni > 1) $tempo_restante .= $giorni." giorni";
						else $tempo_restante .= $giorni." giorno";
					}
					
					if ($ore > 0) {
						if ($tempo_restante != "") $tempo_restante .= ", ";
						if ($ore > 1) $tempo_restante .= $ore." ore";
						else $tempo_restante .= $ore." ora";
					}
					
					if ($minuti > 0) {
						if ($tempo_restante != "") $tempo_restante .= ", ";
						if ($minuti > 1) $tempo_restante .= $minuti." minuti";
						else $tempo_restante .= $minuti." minuto";
					}
					
					if ($giorni == 0 AND $ore == 0 AND $minuti == 0 AND $secondi_resto > 0) $tempo_restante .= $secondi_resto." secondi";
					unset($giorni,$ore,$minuti,$secondi_resto);
					
					if ($_SESSION['utente'] != $proprietario AND $mercato_libero != "SI" AND $stato_mercato == "B") $offri = "<a href='busta_offerta.php?num_calciatore=$numero' class='user'>offri</a>";
					elseif ($_SESSION['utente'] != $proprietario and $mercato_libero != "SI") $offri = "<a href='offerta.php?num_calciatore=$numero' class='user'>rilancia</a>";
					else $offri = "Attendere";
					
					$vecchio_proprietario = $dati_calciatore[6];
					$nuovo_costo = $dati_calciatore[8];
					
					if ($vecchio_proprietario) { $proprietario_mostra = "$proprietario <font size='-2'>(offerta precedente di $vecchio_proprietario)</font>"; }
					else { $proprietario_mostra = $proprietario; }
					
					if ($nuovo_costo) { $costo_mostra = $nuovo_costo; }
					else { $costo_mostra = $costo; }
					
					if ($num1 % 2) $color=$colore_riga_alt;
					else $color="#FFFFFF";
					
					
					if ($risparmia_risorse=="NO") { 
						$tempo=$anno_off.", ".$mese_off."-1, ".$giorno_off.", ".$ora_off.", ".$minuto_off.", ".$secondo_off; #formato 2012, 8-1, 02, 13, 14
						countdown($numero,$tempo);
					$ris="<div id='$numero'></div>";}
					else $ris="$tempo_restante";
					
					$tab_comprati .= "<tr bgcolor='$color'>
					<td align='center'>$numero</td>
					<td>$nome</td>
					<td align='center'>$ruolo</td>
					<td align='center'>$costo_mostra</td>
					<td align='center'>$proprietario_mostra</td>
					<td align='center'>$ris</td>
					<td align='center'>$offri</td></tr>";
				} # fine else if ($sec_restanti < 0)
				
			} # fine if (count($dati_calciatore) >= 6)
			
		} # fine for $num1
		
		$num_calciatori_comprabili = $max_calciatori - $num_calciatori_posseduti;
		
		$file = file($percorso_cartella_dati."/utenti_".$_SESSION["torneo"].".php");
		@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$_SESSION['uid']]);
		
		$surplus = INTVAL($ocrediti);
		$variazioni = INTVAL($ovariazioni);
		$cambi_effettuati = INTVAL($ocambi);
		$soldi_spendibili = $soldi_iniziali + $ocrediti + $ovariazioni - $soldi_spesi;
		$valore_squadra = $soldi_spesi;
		$valuta_saldo = $valuta_saldo + $surplus;
		$spesa_totale = $soldi_spesi - $variazioni;
		
		/*
			echo "surplus: $surplus<br />
			variazioni: $variazioni<br />
			cambi_effettuati: $cambi_effettuati<br />
			soldi_spendibili: $soldi_spendibili<br />
			valore_squadra: $valore_squadra<br />
			soldi_spesi: $soldi_spesi;<br />
			valuta_saldo: $valuta_saldo<br />
			spesa_totale: $spesa_totale";
		*/
		
		###################
		# Controlla squadra
		
		$xsquadra_ok = "NO";
		if ($num_calciatori_comprabili <= 0 or $soldi_spendibili <= 0) { $offribile = "NO"; }
		
		if ($max_calciatori != $num_calciatori_posseduti) {
			$num_calciatori_comprabili = $max_calciatori - $num_calciatori_posseduti;
			$schema_giocatori = "$np$nd$nc$nf$na";
			$verifica_sg = "";
			$num_giocons = count($composizione_squadra);
			for ($num1 = 0 ; $num1 < $num_giocons ; $num1++) {
				$verifica_sg .= "$composizione_squadra[$num1]<br />";
				if ($composizione_squadra[$num1] == $schema_giocatori) { $xsquadra_ok = "SI"; }
			} # fine for $num1
			
			if ($xsquadra_ok != "SI") {
				$inserire = "NO";
				$xsquadra_ok = "NO";
				$controlla_squadra = "";
				if ($np == substr($verifica_sg,0,1))  $controlla_squadra .= "<td class='mdl-data-table__cell--non-numeric' style='width: 25%;'><p class='ruolotab'>Portieri</p><b><p class='numtab'>$np / ".substr($verifica_sg,0,1)."</b></p><center><p class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' style='background-color: #4caf50;color: white;'>Al completo</p></center></td>";
				elseif ($np > substr($verifica_sg,0,1)) $controlla_squadra .= "<td class='mdl-data-table__cell--non-numeric'><p class='ruolotab'>Portieri:</p> <p class='numtab'><font color='red'><b>$np</b></font> / ".substr($verifica_sg,0,1)." </p><center><p class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' style='background-color: #f44336;color: white;'>Vendere esubero</p></center></td>";
				elseif ($np < substr($verifica_sg,0,1)) $controlla_squadra .= "<td class='mdl-data-table__cell--non-numeric' style='width: 25%;'><p class='ruolotab'>Portieri</p><p class='numtab'>$np / ".substr($verifica_sg,0,1)." </p><center><a class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored' href='tab_calciatori.php?ruolo_guarda=P&amp;xsquadra_ok=NO&amp;mercato_libero=$mercato_libero' class='user'>acquista</a></center></td>";
				
				if ($nd == substr($verifica_sg,1,1))  $controlla_squadra .= "<td class='mdl-data-table__cell--non-numeric' style='width: 25%;'><p class='ruolotab'>Difensori</p><b><p class='numtab'>$nd / ".substr($verifica_sg,1,1)."</b></p><center><p class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' style='background-color: #4caf50;color: white;'>Al completo</p></center></td>";
				elseif ($nd > substr($verifica_sg,1,1)) $controlla_squadra .= "<td class='mdl-data-table__cell--non-numeric'><p class='ruolotab'>Difensori:</p> <p class='numtab'><font color='red'><b>$np</b></font> / ".substr($verifica_sg,1,1)." </p><center><p class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' style='background-color: #f44336;color: white;'>Vendere esubero</p></center></td>";
				elseif ($nd < substr($verifica_sg,1,1)) $controlla_squadra .= "<td class='mdl-data-table__cell--non-numeric' style='width: 25%;'><p class='ruolotab'>Difensori</p><p class='numtab'> $nd / ".substr($verifica_sg,1,1)."</p><center><a class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored' href='tab_calciatori.php?ruolo_guarda=D&amp;xsquadra_ok=NO&amp;mercato_libero=$mercato_libero' class='user'>acquista</a></center></td>";
				
				if ($nc == substr($verifica_sg,2,1))  $controlla_squadra .= "<td class='mdl-data-table__cell--non-numeric' style='width: 25%;'><p class='ruolotab'>Centrocampisti</p><b><p class='numtab'>$nc / ".substr($verifica_sg,2,1)."</b></p><center><p class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' style='background-color: #4caf50;color: white;'>Al completo</p></center></td>";
				elseif ($nc > substr($verifica_sg,2,1)) $controlla_squadra .= "<td class='mdl-data-table__cell--non-numeric'><p class='ruolotab'>Centrocampisti:</p> <p class='numtab'><font color='red'><b>$np</b></font> / ".substr($verifica_sg,2,1)." </p><center><p class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' style='background-color: #f44336;color: white;'>Vendere esubero</p></center></td>";
				elseif ($nc < substr($verifica_sg,2,1)) $controlla_squadra .= "<td class='mdl-data-table__cell--non-numeric' style='width: 25%;'><p class='ruolotab'>Centrocampisti</p><p class='numtab'>$nc / ".substr($verifica_sg,2,1)."</p><center><a class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored' href='tab_calciatori.php?ruolo_guarda=C&amp;xsquadra_ok=NO&amp;mercato_libero=$mercato_libero' class='user'>acquista</a></center></td>";
				
				if ($considera_fantasisti_come == "F") {
					if ($nf == substr($verifica_sg,3,1))  $controlla_squadra .= "<td class='mdl-data-table__cell--non-numeric' style='width: 25%;'><p class='ruolotab'>Fantasisti</p><b><p class='numtab'>$nf / ".substr($verifica_sg,3,1)."</b></p><center><p class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' style='background-color: #4caf50;color: white;'>Al completo</p></center></td>";
					elseif ($nf > substr($verifica_sg,3,1)) $controlla_squadra .= "<td class='mdl-data-table__cell--non-numeric'><p class='ruolotab'>Fantasisti:</p> <p class='numtab'><font color='red'><b>$np</b></font> / ".substr($verifica_sg,3,1)." </p><center><p class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' style='background-color: #f44336;color: white;'>Vendere esubero</p></center></td>";
					elseif ($nf < substr($verifica_sg,3,1)) $controlla_squadra .= "<td class='mdl-data-table__cell--non-numeric' style='width: 25%;'><p class='ruolotab'>Fantasisti</p><p class='numtab'>$nf / ".substr($verifica_sg,3,1)."</p><center><a class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored' href='tab_calciatori.php?ruolo_guarda=F&amp;xsquadra_ok=NO&amp;mercato_libero=$mercato_libero' class='user'>acquista</a></center></td>";
				}
				
				if ($na == substr($verifica_sg,4,1)) $controlla_squadra .= "<td class='mdl-data-table__cell--non-numeric' style='width: 25%;'><p class='ruolotab'>Attaccanti</p><b><p class='numtab'>$na / ".substr($verifica_sg,4,1)."</b></p><center><p class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' style='background-color: #4caf50;color: white;'>Al completo</p></center></td>";
				elseif ($na > substr($verifica_sg,4,1)) $controlla_squadra .= "<td class='mdl-data-table__cell--non-numeric'><p class='ruolotab'>Attaccanti:</p> <p class='numtab'><font color='red'><b>$np</b></font> / ".substr($verifica_sg,4,1)." </p><center><p class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' style='background-color: #f44336;color: white;'>Vendere esubero</p></center></td>";
				elseif ($na < substr($verifica_sg,4,1)) $controlla_squadra .= "<td class='mdl-data-table__cell--non-numeric' style='width: 25%;'><p class='ruolotab'>Attaccanti</p><p class='numtab'>$na / ".substr($verifica_sg,4,1)."</p><center><a class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored' href='tab_calciatori.php?ruolo_guarda=A&amp;xsquadra_ok=NO&amp;mercato_libero=$mercato_libero' class='user'>acquista</a></center></td>";
			} # fine if $xsquadra_ok
			
			if (@is_file($percorso_cartella_dati."/editoriale.txt"))	$linee_editoriale = @file($percorso_cartella_dati."/editoriale.txt");
			else $linee_editoriale = "";
			
			$num_linee_editoriale = count($linee_editoriale);
			$messaggio_editoriale = "";
			
			for ($num1 = 0 ; $num1 < $num_linee_editoriale; $num1++) $messaggio_editoriale .= $linee_editoriale[$num1];
			
			########################
			#### Layout mercato ####
			#### Squadra da formare		
			echo '<div class="container" style="width: 85%;margin-top: -10px;">
			<div class="mdl-cell mdl-cell--12-col">
			<div class="demo-card-wide mdl-card mdl-shadow--2dp">
			<div class="mdl-card__title"></div>  
			<div class="mdl-card__supporting-text" style="width: 97.5%;">';		
			if (trim($messaggi[2]) != "") echo "".html_entity_decode($messaggi[2])."";  
			echo'</div>  
			<div class="mdl-card__actions mdl-card--border">    
			<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="./a_modUtente.php">      
			Benvenuto '.$_SESSION['utente'].': visualizza il tuo profilo    
			</a>  
			</div>
			</div>
			</div>';
			
			require ("./widget.php");
			
			$data_busta_chiusa = @join('', @file("./dati/data_buste_".$_SESSION['torneo']."_0.txt"));
			$giornobuste = "$data_busta_chiusa[6]$data_busta_chiusa[7]/$data_busta_chiusa[4]$data_busta_chiusa[5]";
			$orabuste = "$data_busta_chiusa[8]$data_busta_chiusa[9]:$data_busta_chiusa[10]$data_busta_chiusa[11]";
			
			
			if ($mercato_libero == "NO" and $stato_mercato == "I") echo "L'asta ha un periodo di attesa di giorni <b><font color='red'>$aspetta_giorni</font></b>, ore <b><font color='red'>$aspetta_ore</font></b> e minuti <b><font color='red'>$aspetta_minuti</font></b>.<br />";
			
			echo "<div class='mdl-cell mdl-cell--9-col'>
			<table class='mdl-data-table mdl-shadow--2dp' style='width:100%'  cellpadding='10' cellspacing='0'>
			<caption>GESTIONE CAMPIONATO</caption>
			<tr>
			<td>
			<div class='mdl-grid'>";
			if ($mercato_libero == "NO" and $stato_mercato == "B") echo "<div class='mdl-cell mdl-cell--12-col'><div class='evidenziato'>Il termine per completare le offerte nelle buste &egrave; il <b>$giornobuste</b> alle ore <b>$orabuste</b></div></div>";
			if ($mercato_libero == "NO" and $stato_mercato == "I") echo "<div class='mdl-cell mdl-cell--12-col'><div class='evidenziato'>L'asta ha un periodo di attesa di giorni <b><font color='red'>$aspetta_giorni</font></b>, ore <b><font color='red'>$aspetta_ore</font></b> e minuti <b><font color='red'>$aspetta_minuti</font></b>.</div></div>";
			echo"<div class='mdl-cell mdl-cell--4-col'>
			<div class='demo-card-event-indigo mdl-card mdl-shadow--2dp'>
			<div class='mdl-card__title mdl-card--expand'>
			<p style='text-align: left;'>
			Benvenuto <b>".$_SESSION['utente']."</b>!<br />La tua rosa non &egrave; ancora completa.<br>Devi acquistare i calciatori indicati sotto<br>e poi potrai schierare la formazione.
			</p>            
			</div>           
			<div class='mdl-card__actions mdl-card--border''>    
			<p class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect'>        
			Informazioni utili                
			</p>            
			<div class='mdl-layout-spacer'></div>
			<i class='material-icons'>info</i>            
			</div>        
			</div>
			</div>		
			<div class='mdl-cell mdl-cell--4-col'>		    
			<div class='demo-card-event-cyan mdl-card mdl-shadow--2dp'>                
			<div class='mdl-card__title mdl-card--expand'>		            
			<p style='text-align: left;'>                        
			<b>Torneo:</b> $otdenom<br />";						
			if ($mercato_libero == "SI") echo "<b>Modalit&agrave;:</b> Magic Cup<br />";          
			elseif ($mercato_libero == "NO") echo "<b>Modalit&agrave;:</b> Asta Pubblica<br />";	
			
			if ($stato_mercato == "I") echo " <b>Fase iniziale</b><br />";				    
			elseif ($stato_mercato == "C") echo " <b>Stato mercato:</b> Chiuso<br />";			
			elseif ($stato_mercato == "S") echo " <b>Stato mercato:</b> Sospeso<br />";			
			elseif ($stato_mercato == "P") echo " <b>Stato mercato:</b> Asta Perenne<br />";		
			elseif ($stato_mercato == "B") echo " <b>Stato mercato:</b> Buste Chiuse<br />";			
			elseif ($stato_mercato == "A") echo " <b>Stato mercato:</b> Aperto<br />";				    
			elseif ($stato_mercato == "R") echo " <b>Stato mercato:</b> Riparazione<br />";					
			
			if ($stato_mercato == "I" OR $stato_mercato == "B" OR $stato_mercato == "R") echo "<b>Lista calciatori:</b> " . date ("d-m-Y, H:i:s", filemtime($percorso_cartella_dati."/calciatori.txt"))."<br />";           
			echo "</p>             
			</div>          
			<div class='mdl-card__actions mdl-card--border''>     
			<p class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect'>                  
			Informazioni torneo                
			</p>            
			<div class='mdl-layout-spacer'></div>                
			<i class='material-icons'>info</i>            
			</div>        
			</div>
			</div>		
			<div class='mdl-cell mdl-cell--4-col'>		    
			<div class='demo-card-event-teal mdl-card mdl-shadow--2dp'>                
			<div class='mdl-card__title mdl-card--expand'>		           
			<p style='text-align: left;'>";					    
			ultimi10();                    
			echo "</p>                
			</div>            
			<div class='mdl-card__actions mdl-card--border''>           
			<a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' href='messaggi.php'>           
			Ultimi messaggi            
			</a>          
			<div class='mdl-layout-spacer'></div>   
			<i class='material-icons'>message</i>     
			</div>      
			</div>
			</div>
			</div>		
			<div class='mdl-grid'>
			<div class='mdl-cell mdl-cell--12-col'>	
			<table class='mdl-data-table mdl-js-data-table mdl-shadow--2dp' style='width:100%' cellpadding='10' cellspacing='0'>	
			<caption>ACQUISTO GIOCATORI</caption>	
			<tr>	
			<td class='mdl-data-table__cell--non-numeric' colspan='2'><center><b>Crediti disponibili:</b> $soldi_spendibili</center></td>	
			<td class='mdl-data-table__cell--non-numeric' colspan='2'><center><b>Giocatori da acquistare:</b> $num_calciatori_comprabili</center></td>	
			</tr>	
			<tr>	
			$controlla_squadra	
			</tr>			
			</table>	
			</div>
			</div>
			</td>
			</tr>		
			</table>
			<br>		        
			</div>";
			
		} # fine if ($max_calciatori != $num_calciatori_posseduti)
		
		else {
			########################
			#### Layout mercato ####
			#### Squadra formata
			
			
			for ($num1 = 0 ; $num1 < $num_linee_editoriale; $num1++) $messaggio_editoriale .= $linee_editoriale[$num1];
			
			echo '<div class="container" style="width: 85%;margin-top: -10px;">
			<div class="card-panel">
			<div class="row">
			<div class="card medium">
			<div class="card-image">
			<img src="immagini/parterre3_1.jpg">
			</div>
			<div class="card-content">';
			if (trim($messaggi[2]) != "") echo "".html_entity_decode($messaggi[2])."";
			echo'</div>
			<div class="card-action">
			<a href="./a_modUtente.php">
			Benvenuto '.$_SESSION['utente'].': visualizza il tuo profilo
			</a>
			</div>
			</div>
			</div>
			
			<div class="row">';
			require ("./widget.php");
			
			$data_busta_chiusa = @join('', @file("./dati/data_buste_".$_SESSION['torneo']."_0.txt"));
			$giornobuste = "$data_busta_chiusa[6]$data_busta_chiusa[7]/$data_busta_chiusa[4]$data_busta_chiusa[5]";
			$orabuste = "$data_busta_chiusa[8]$data_busta_chiusa[9]:$data_busta_chiusa[10]$data_busta_chiusa[11]";
			
			
			if ($mercato_libero == "NO" and $stato_mercato == "I") echo "L'asta ha un periodo di attesa di giorni <b><font color='red'>$aspetta_giorni</font></b>, ore <b><font color='red'>$aspetta_ore</font></b> e minuti <b><font color='red'>$aspetta_minuti</font></b>.<br />";
			
			echo '<div class="col m9">';
			
			if ($mercato_libero == "NO" and $stato_mercato == "B") echo "<div class='mdl-cell mdl-cell--12-col'><div class='evidenziato'>Il termine per completare le offerte nelle buste &egrave; il <b>$giornobuste</b> alle ore <b>$orabuste</b></div></div>";
			if ($mercato_libero == "NO" and $stato_mercato == "I") echo "<div class='mdl-cell mdl-cell--12-col'><div class='evidenziato'>L'asta ha un periodo di attesa di giorni <b><font color='red'>$aspetta_giorni</font></b>, ore <b><font color='red'>$aspetta_ore</font></b> e minuti <b><font color='red'>$aspetta_minuti</font></b>.</div></div>";
			$dati_squadra = @file($percorso_cartella_dati."/squadra_".$_SESSION['utente']);
			$numtitolari = explode(",", $dati_squadra[1]);
			$numtitolari = count ($numtitolari)-1;
			$numpanchinari = explode(",", $dati_squadra[2]);
			$numpanchinari = count ($numpanchinari)-1;
			
			echo "<div class='row'><div class='col m4'>
			<div class='card blue'>
			<div class='card-content white-text'>
			<p style='text-align: left;'>
			Ciao <b>".$_SESSION['utente']."</b>, la tua rosa &egrave; completa.<br><br>Crediti residui: <b>$soldi_spendibili</b><br />Titolari schierati: <b>$numtitolari</b> <br />Panchinari schierati: <b>$numpanchinari</b>
			</p>
			</div>
			<div class='card-action white-text'>
			<span>INFORMAZIONI UTILI <i class='material-icons right'>info</i></span>
			</div>
			</div>
			</div>
			<div class='col m4'>
			<div class='card cyan'>
			<div class='card-content white-text'>
			<p style='text-align: left;'>
			<b>Torneo:</b> $otdenom<br />";
			if ($mercato_libero == "SI") echo "<b>Modalit&agrave;:</b> Magic Cup<br />";
			elseif ($mercato_libero == "NO") echo "<b>Modalit&agrave;:</b> Asta Pubblica<br />";
			
			if ($stato_mercato == "I") echo " <b>Fase iniziale</b><br />";
			elseif ($stato_mercato == "C") echo " <b>Stato mercato:</b> Chiuso<br />";
			elseif ($stato_mercato == "S") echo " <b>Stato mercato:</b> Sospeso<br />";
			elseif ($stato_mercato == "P") echo " <b>Stato mercato:</b> Asta Perenne<br />";
			elseif ($stato_mercato == "B") echo " <b>Stato mercato:</b> Buste Chiuse<br />";
			elseif ($stato_mercato == "A") echo " <b>Stato mercato:</b> Aperto<br />";
			elseif ($stato_mercato == "R") echo " <b>Stato mercato:</b> Riparazione<br />";
			
			if ($stato_mercato == "I" OR $stato_mercato == "B" OR $stato_mercato == "R") echo "<b>Lista calciatori:</b> " . date ("d-m-Y, H:i:s", filemtime($percorso_cartella_dati."/calciatori.txt"))."<br />";
			echo "</p>
			</div>
			<div class='card-action white-text'>
			<span>INFORMAZIONI TORNEO <i class='material-icons right'>info</i></span>
			</div>
			</div>
			</div>
			<div class='col m4'>
			<div class='card teal'>
			<div class='card-content white-text'>
			<p style='text-align: left;'>";
			ultimi10();
			echo "</p>
			</div>
			<div class='card-action white-text'>
			<a href='messaggi.php'>ULTIMI MESSAGGI <i class='material-icons right'>message</i></a>
			</div>
			</div>
			</div>
			</div>
			<div class='row'>
			<div class='col m6'>";
			if ($stato_mercato != "I" and $stato_mercato != "B" and $vedi_campetto == "SI") {
				echo "<div class='card light-blue darken-4'>
				<div class='card-content'>
				<img class='campettohome' src='./fantacampo.php?orientamento_campetto=0&amp;riduci=88&amp;iutente=$outente' alt='La tua squadra in campo' />
				</div>
				<div class='card-action white-text'>
				<span>LA TUA FORMAZIONE <i class='material-icons right'>info</i></span>
				</div>
				</div>"; 
			}
			echo"</div>
			</div>"; #div row
		} # fine else
		
		###########################################################
		
		for ($num1 = 1; $num1 < 40 ; $num1++) {
			if (strlen($num1) == 1) $num1 = "0".$num1;
			$giornata_controlla = "giornata$num1";
			if (!@is_file($percorso_cartella_dati."/".$giornata_controlla."_".$_SESSION['torneo']."_".$_SESSION['serie'])) break;
			else $giornata_ultima = $num1;
		} # fine for $num1
		
		if (!$giornata or $giornata > $giornata_ultima) $giornata = "$giornata_ultima";
		
		$tab_formazioni = "<tr>";
		$num_colonne = 0;
		$num2 = 0;
		$leggendo_formazioni = "SI";
		$leggendo_punteggi = "NO";
		$leggendo_voti = "NO";
		$leggendo_scontri = "NO";
		$voti_esistenti = "NO";
		
		if ($giornata_ultima) $file_giornata = @file($percorso_cartella_dati."/giornata".$giornata."_".$_SESSION['torneo']."_".$_SESSION['serie']);
		$num_linee_file_giornata = count($file_giornata);
		for($num1 = 0 ; $num1 < $num_linee_file_giornata; $num1++) {
			$linea = togli_acapo($file_giornata[$num1]);
			if ($linea == "#@& fine formazioni #@&") $leggendo_formazioni = "NO";
			if ($leggendo_formazioni == "SI") {
				if ($linea == "#@& formazione #@&") $giocatore = "";
				if ($giocatore) {
					${$formazione}[$num2] = $file_giornata[$num1];
					$num2++;
				} # fine if ($giocatore)
				if ($aggiorna_giocatore) {
					$giocatore = $linea;
					$formazione = "formazione_$giocatore";
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
			if ($leggendo_modificatore == "SI") {
				$modificatore[$num2] = $linea;
				$num2++;
			} # fine if ($leggendo_modificatore == "SI")
			if ($linea == "#@& modificatore #@&") {
				$leggendo_modificatore = "SI";
				$modificatore_esistenti = "SI";
				$num2 = 0;
			} # fine if ($linea == "#@& modificatore #@&")
			
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
			
			if ($linea == "#@& fine scontri #@&") $leggendo_scontri = "NO";
			if ($leggendo_scontri == "SI") {
				$scontri[$num2] = $linea;
				$num2++;
			} # fine if ($leggendo_scontri == "SI")
			if ($linea == "#@& scontri #@&") {
				$leggendo_scontri = "SI";
				$scontri_esistenti = "SI";
				$num2 = 0;
			} # fine if ($linea == "#@& scontri #@&")
		} # fine for $num1
		
		$file = file($percorso_cartella_dati."/utenti_".$_SESSION["torneo"].".php");
		$num_giocatori = 0;
		$linee1 =count($file);
		for($num1 = 1; $num1 < $linee1; $num1++){
			$num_giocatori++;
		}
		
		for ($num1 = 1 ; $num1 < $num_giocatori+1; $num1++) {
			@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$num1]);
			
			$nome_posizione[$num1] = $outente;
			$soprannome_squadra = $osquadra;
			
			if ($soprannome_squadra) {
				$nome_squadra_memo[$outente] = $soprannome_squadra;
				$soprannome_squadra = "<b>".$soprannome_squadra."</b>";
			} # fine if ($soprannome_squadra)
			else {
				$soprannome_squadra = "Squadra";
				$nome_squadra_memo[$osquadra] = $osquadra;
			} # fine else if ($soprannome_squadra)
			
			if ($num_colonne >= 2) {
				$tab_formazioni .= "</tr><tr>";
				$num_colonne = 0;
			} # fine if ($num_colonne >= 2)
			$num_colonne++;
			$tab_formazioni .= "<td valign='top'><h4>$soprannome_squadra di $giocatore</h4>";
			$formazione = "formazione_$giocatore";
			$formazione = $$formazione;
			$num_linee_formazione = count($formazione);
			for ($num2 = 0 ; $num2 < $num_linee_formazione; $num2++) {
				# $formazione[$num2] = ereg_replace(" ","_",$formazione[$num2]);
				$tab_formazioni .= $formazione[$num2]."<br />";
			} # fine for $num2
			$tab_formazioni .= "</td>";
			
		} # fine for $num1
		
		for ($num1 = $num_colonne ; $num1 < 2; $num1++) $tab_formazioni .= "<td>&nbsp;</td>";
		$tab_formazioni .= "</tr>";
		
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
		
		if ($tipo_campionato == "S") {
					
			echo "<div class='row'><div class='col m6'>
			<div class='card cyan darken-4 white-text'>
			<div class='card-content'>
			<table cellpadding='5' border='0'>";
			echo "<thead>
			<tr>
			<th class='center'>Ultima Giornata</th>
			<th class='center'>Risultato</th>
			</tr>
			</thead>";
			$partite = "";
			$marcotori = "";
			$num_scontri = count($scontri);
			for ($num1 = 0 ; $num1 < $num_scontri ; $num1++) {
				$dati_scontri = explode("##@@&&", $scontri[$num1]);
				echo "<tr><td class='center'>".$nome_squadra_memo[$dati_scontri[0]]." - ".$nome_squadra_memo[$dati_scontri[1]]."</td>
				<td class='center'>".$dati_scontri[2]." - ".$dati_scontri[3]."</td></tr>";
			} # fine for $num1
			echo "</table>
			</div>
			<div class='card-action white-text'>
			<span>DETTAGLI GIORNATA <i class='material-icons right'>info</i></span>
			</div>
			</div>
			</div>
			
			<div class='col m6'>
			<div class='card cyan darken-4 white-text'>
			<div class='card-content'>
			<table cellpadding='5' border='0'>";
			echo "<thead>
			<tr>
			<th class='center' colspan='2'>Prossima Giornata</th>
			</tr>
			</thead>";
			
			$file_scontri = file($percorso_cartella_scontri."/squadre".$num_giocatori);
			$num_linee_file_scontri = count($file_scontri);
			$finito_scontri = "NO";
			$conta_cicli_while = 0;
			$num_giornata_campionato = 0;
			$giornata_scritta = $g_inizio_camp - 2;
			$num_cella = 1;
			while ($finito_scontri != "SI") {
				$inizio_campionato = "";
				$campionato_in_corso = "";
				$inizio_giornata = "";
				$giornata_in_corso = "";
				for ($num2 = 0 ; $num2 < $num_linee_file_scontri; $num2++) {
					$linea_file_scontri = trim(togli_acapo($file_scontri[$num2]));
					if ($campionato_in_corso == "SI") {
						if ($linea_file_scontri == "</campionato>") break;
						
						if ($linea_file_scontri == "</giornata>") {
							$giornata_in_corso = "NO";
							if ($giornata_scritta <= $g_fine_camp) {
								
								if ($num_cella == 2) {
									$num_cella = 0;
								} # fine if ($num_cella == 4)
								$num_cella++;
							} # fine if ($giornata_scritta < $g_fine_camp)
						} # fine if ($linea_file_scontri == "</giornata>")
						
						if ($giornata_in_corso == "SI") {
							$partita = explode("-",$linea_file_scontri);
							$squadra1 = $nome_posizione[$partita[0]];
							$squadra2 = $nome_posizione[$partita[1]];
							echo "<tr><td class='center' ><a href='giornate.php?opzione=2&amp;nome_squadra=$squadra1' class='user'>".$nome_squadra_memo[$squadra1]."</a> - <a href='giornate.php?opzione=2&amp;nome_squadra=$squadra2' class='user'>".$nome_squadra_memo[$squadra2]."</a></td><td class='center' width='35%'>".$gol[$num_giornata_campionato][$squadra1]." - ".$gol[$num_giornata_campionato][$squadra2]."</td></tr>".$acapo;
						} # fine if ($campionato_in_corso == "SI")
						
						if ($inizio_giornata == "SI") {
							$inizio_giornata = "";
							$giornata_scritta++;
							$num_giornata_campionato++;
							if ($linea_file_scontri > $ultima_giornata) $ultima_giornata = $linea_file_scontri;
							if ($giornata_scritta <= $g_fine_camp) {
								if ($num_cella == 1)
								$giornata_in_corso = "SI";
							} # fine if ($giornata_scritta < $g_fine_camp)
						} # fine if ($inizio_giornata == "SI")
						if ($linea_file_scontri == "<giornata>") $inizio_giornata = "SI";
						
					} # fine if ($campionato_in_corso == "SI")
					
					if ($inizio_campionato == "SI") {
						$inizio_campionato = "";
						if  ($linea_file_scontri == $num_giocatori) $campionato_in_corso = "SI";
					} # fine if ($inizio_campionato)
					if ($linea_file_scontri == "<campionato>") $inizio_campionato = "SI";
				} # fine for $num2
				
				if ($giornata_scritta >= $g_fine_camp) $finito_scontri = "SI";
				$conta_cicli_while++;
				if ($conta_cicli_while >= 50) $finito_scontri = "SI";
			} # fine while ($finito_scontri != "SI")
			if ($num_cella != 1)
			
			
			echo "</table>
			</div>
			<div class='card-action white-text'>
			<span>DETTAGLI GIORNATA <i class='material-icons right'>info</i></span>
			</div>
			</div>
			</div>
			</div>"; #row
			
		} # fine if ($tipo_campionato == "S")
		
		###############################################
		
		if ($voti_esistenti == "SI") {
			echo "<div class='row'>
			<div class='col m12'>
			<div class='card cyan darken-4 white-text'>
			<div class='card-content'>
			<table cellpadding='5' border='0'>
			<thead>
			<tr>
			<th class='center'>Punteggi</th>
			<th class='center'>Punti</th>
			<th class='center'>Classifica</th>
			</tr>
			</thead>
			<tr><td class='center'>";
			$num_voti = count($voti);
			
			for ($num1 = 0 ; $num1 < $num_voti ; $num1++) {
				$dati_voti = explode("##@@&&", $voti[$num1]);
				settype($dati_voti[1],"double");
				echo $dati_voti[0].": ".$dati_voti[1]."<br />";
				$voto[$dati_voti[0]] = $dati_voti[1];
			} # fine for $num1
			echo "</td>";
			
			$tipo_campionato = "";
			
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
				
				echo "<td class='center'>";
				$num_punteggi = count($punteggi);
				for ($num1 = 0 ; $num1 < $num_punteggi ; $num1++) {
					$dati_punteggio = explode("##@@&&", $punteggi[$num1]);
					settype($dati_punteggio[1],"double");
					echo $dati_punteggio[0].": ".$dati_punteggio[1]."<br />";
					$punti[$dati_punteggio[0]] = $dati_punteggio[1];
				} # fine for $num1
				
				# calcolo la classifica fino a questa giornata
				
				for ($num1 = $g_inizio_campionato; $num1 < $num_giornata ; $num1++) {
					if (strlen($num1) == 1) $num1 = "0".$num1;
					$giornata_punti = "giornata$num1";
					if (@is_file($percorso_cartella_dati."/".$giornata_punti."_".$_SESSION['torneo']."_".$_SESSION['serie'])) {
						$file_giornata_p = @file($percorso_cartella_dati."/".$giornata_punti."_".$_SESSION['torneo']."_".$_SESSION['serie']);
						$num_linee_file_giornata_p = count($file_giornata_p);
						$leggendo_punteggi = "NO";
						$punteggi_esistenti_p = "NO";
						for($num2 = 0 ; $num2 <= $num_linee_file_giornata_p; $num2++) {
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
							for ($num2 = 0 ; $num2 <= $num_punteggi_p ; $num2++) {
								$dati_punteggio = explode("##@@&&", $punteggi_p[$num2]);
								settype($dati_punteggio[1],"double");
								$punti[$dati_punteggio[0]] = ($punti[$dati_punteggio[0]] + $dati_punteggio[1]);
							} # fine for $num2
						} # fine if ($punteggi_esistenti_p == "SI")
					} # fine if (@is_file("$percorso_cartella_dati/$giornata_punti"))
				} # fine for $num1
				
				echo "</td><td class='center'>";
				
				arsort ($punti);
				reset ($punti);
				$posclas = 0;
				while (list ($key, $val) = each ($punti)) {
					$posclas++;
					if ($nome_squadra_memo[$key]!="") echo "$posclas)&nbsp;".$nome_squadra_memo[$key].": $val<br/>";
					else $posclas = $posclas-1;
				} # fine while
				echo '</table></div></div></div></div>';
			} # fine if ($tipo_campionato != "N")
		} # fine if ($voti_esistenti == "SI")
		###########################################################
		
		##############################
		if ($vedi_operazioni == "SI" AND ($mercato_libero == "NO" AND $stato_mercato != "B" OR $ordinamento)) {
			echo "<br /><br /><table summary='mercato' width='100%' cellspacing='1' cellpadding='2' align='center' bgcolor='$sfondo_tab'>
			<caption>Operazioni di mercato effettuate</caption>
			<tr><td align='center' height='20' colspan='7'>Ordinamento per -
			<a href='mercato.php?ordinamento=1&amp;verso=asc' class='user'>nome</a> -
			<a href='mercato.php?ordinamento=2' class='user'>ruolo</a> -
			<a href='mercato.php?ordinamento=4' class='user'>proprietario</a> -
			<a href='mercato.php?ordinamento=5&amp;verso=asc' class='user'>scadenza</a>
			-";
			if($ordinamento) {
				echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='mercato.php?ordinamento=$ordinamento&amp;verso=asc' class='user'><font size='-2'>ascendente</font></a> - <a href='mercato.php?ordinamento=$ordinamento&amp;verso=disc' class='user'><font size='-2'>discendente</font></a>";
			}
			echo "</td></tr>$tab_comprati";
		}
		else 	echo "</table>";
		if ($max_calciatori == $num_calciatori_posseduti) {
			echo"</div>
			</td>
			</tr>
			</table>
			<br>
		</div></div></div>"; }
	} # fine if ($_SESSION['valido'] == "SI" and $_SESSION['utente'] != $admin_user) {
	else header("location: logout.php?logout=2");
	include("./footer.php");
?>