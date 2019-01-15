<?php
	##################################################################################
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
	##################################################################################
	require_once("./controlla_pass.php");
	
	if (!$itorneo) header("Location: ./a_torneo.php");
	
	include("./header.php");
	
	if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] == 5) {
		
		
		unset ($tabella_msg);
		
		if ($messgestutente) {
			require_once ("./inc/avvisi.php");
			$tabella_msg = "<br /><div class='evidenziato'>&nbsp;$avviso[$messgestutente]&nbsp;</div>";
		} # fine if ($messgestutente)
		
		$tornei = @file($percorso_cartella_dati."/tornei.php");
		@list($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $otquotacassa, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza) = explode(",", $tornei[$itorneo]);
		if ($otmercato_libero == "SI") $mess1 = "Il torneo si volge a <b>mercato libero</b>: significa che tutti i giocatori possono acquistare qualsiasi calciatore, indipendentemente dal fatto che quest'ultimo possa essere stato acquistato da altri partecipanti.<br> In tutta la stagione sar&agrave; possibile cambiare <b>$otnumero_cambi_max</b> calciatori, escluse le operazioni effettuate nelle eventuali giornate di riparazione.";
		elseif ($otmercato_libero == "NO") $mess1 = "Il torneo si volge con una <b>asta iniziale</b>, durante la quale vendono assegnati i calciatori al maggior offerente.";
		else $mess1 = "<div class='evidenziato'>ERRORE: il tipo di mercato non &egrave; valido.</div>";
		if ($ottipo_calcolo == "S") {$tipocalcolo = "scontri diretti";}
		elseif ($ottipo_calcolo == "P") {$tipocalcolo = "somma del punteggio";}
		elseif ($ottipo_calcolo == "V") {$tipocalcolo = "somma dei voti";}
		if ($otstato == "I") {$tipomercato = "<b>fase iniziale</b>: la classica situazione prima dell'inizio ufficiale del campionato.";}
		elseif ($otstato == "A") {$tipomercato = "<b>aperto</b>: tutte le operazioni di calciomercato sono consentite.";}
		elseif ($otstato == "P") {$tipomercato = "<b>asta perenne</b>: tutte le operazioni di calciomercato sono consentite, su base d'asta.";}
		elseif ($otstato == "S") {$tipomercato = "<b>sospeso</b>: le operazioni sono bloccate, sono consentiti soltanto i rilanci e la vendita immediata di calciatori.";}
		elseif ($otstato == "C") {$tipomercato = "<b>chiuso</b>: non &egrave; consentita nessuna operazione di mercato.";}
		elseif ($otstato == "R") {$tipomercato = "<b>riparazione</b>: rappresenta la fase successiva al termine dell'asta nella quale si rettificano e completano le squadre.";}
		elseif ($otstato == "B") {$tipomercato = "<b>buste chiuse</b>: fase iniziale dell'asta, all'interno della quale è possibile fare offerte nascoste per i giocatori.";}
		$mess2 = "La modalit&agrave; di calcolo dei risultati &egrave; <b>$tipocalcolo</b>.";
		$mess3 = "Lo stato del mercato &egrave; impostato su $tipomercato";
		if (file_exists($percorso_cartella_dati."/mercato_".$otid."_".$otserie.".txt")) $dati_mercato = @file($percorso_cartella_dati."/mercato_".$otid."_".$otserie.".txt");
		else unset($dati_mercato);
		
		$num_calciatori = @count($dati_mercato);
		
		if(isset($dati_mercato)){
			$a_mercato = array();
			$ugg = ultima_giornata_giocata();
			
			if ($ugg >= 1) {
				$cerca = @file("$prima_parte_pos_file_voti$ugg$seconda_parte_pos_file_voti");
				
				foreach($cerca AS $dva){
					$d = explode("|",trim($dva));
					$idva = trim($d[0]); 							# numero calciatore
					$nva = trim($d[$ncs_valore-1]); 	# valore aggiornato
					$a_fvm[$idva] = $nva; 	
				}
				unset ($cerca,$d,$dva);
			}
			
			foreach($dati_mercato AS $dati){
				$d=explode(",",trim($dati));
				$a_mercato[trim($d[4])]['num'][]=trim($d[0]); 		# numero calciatore
				$a_mercato[trim($d[4])]['nome'][]=trim($d[1]); 		# nome
				$a_mercato[trim($d[4])]['ruolo'][]=trim($d[2]);		# ruolo
				$a_mercato[trim($d[4])]['val'][]=trim($d[3]);			# valutazione
				$a_mercato[trim($d[4])]['valagg'][]=$a_fvm[trim($d[0])];	# valore aggiornato
			}
			unset ($d,$dati);
			ksort($a_mercato);
		}
		
		$dati_utenti = @file($percorso_cartella_dati."/utenti_".$itorneo.".php");
		
		if (isset($dati_utenti)) {
			$dati_utenti = array_slice($dati_utenti,1);
			$a_utenti = array();
			foreach($dati_utenti AS $dati){	
				$d=explode("<del>",trim($dati));
				$a_utenti[trim($d[0])][]=trim($d[2]); 							# permessi
				$a_utenti[trim($d[0])][]=trim($d[3]); 							# email
				$a_utenti[trim($d[0])][]=trim($d[4]); 							# sito
				$a_utenti[trim($d[0])][]=trim($d[5]); 							# nome squadra
				$a_utenti[trim($d[0])][]=trim($d[6]); 							# id torneo
				$a_utenti[trim($d[0])][]=trim($d[7]); 							# id serie
				$a_utenti[trim($d[0])][]=trim($d[8]); 							# citt…
				$a_utenti[trim($d[0])][]=trim($d[9]); 							# crediti
				$a_utenti[trim($d[0])][]=trim($d[10]); 							# variazioni
				$a_utenti[trim($d[0])][]=trim($d[11]); 							# cambi
				$a_utenti[trim($d[0])][]=@count($a_mercato[trim($d[0])]['num']); 		# calciatori acquistati
				$a_utenti[trim($d[0])][]=@array_sum($a_mercato[trim($d[0])]['val']); 	# valutazione squadra
				$a_utenti[trim($d[0])][]=@array_sum($a_mercato[trim($d[0])]['valagg']); 	# valutazione squadra aggiornata	
				$a_utenti[trim($d[0])][]=$otcrediti_iniziali - (@array_sum($a_mercato[trim($d[0])]['val'])-$d[10]);
			}
		}
		/*echo "<pre style='text-align: left'>";
			print_r($a_utenti);
		echo"</pre>";*/
		
		###############################
		##### Layout tabella principale
		
		echo '<div class="container" style="width: 85%;margin-top: -10px;">
		<div class="card-panel">
		<div class="row">';
		require ("./a_widget.php");
		echo "<div class='col m9'>
		<div class='bread'><a href='./mercato.php'>Gestione</a> / Torneo $otdenom</div>
		<div class='card'>
		<div class='card-content'>
		<span class='card-title'>$otdenom<span style='font-size: 13px;'> - Gestione del torneo</span></span>
		<hr>
		<div class='card light-blue lighten-3'>
		<div class='card-content'>
		<span class='card-title center '>Riepilogo informazioni</span>";
		$totuser = count($a_utenti);
		if ($totuser == 1) { echo "C'&egrave; <b>1</b> giocatore registrato.<br/>"; }	
		else { echo "Ci sono <b>".count($a_utenti)."</b> giocatori registrati.<br/>"; }
		echo "$mess1<br/>
		$mess2<br/>
		</div>
		</div>
		
		<div class='row'>
		<div class='col m3'>
		<div class='card indigo center'>
		<div class='card-content'>
		<img src='immagini/user.png' alt='Utenti' width='48' height='48' />
		</div>
		<div class='card-action'>
		<a href='a_gestione_tornei.php?itorneo=$itorneo&amp;opzione=1'>Utenti iscritti</a>
		</div>
		</div>
		</div>
		
		<div class='col m3'>
		<div class='card indigo center'>
		<div class='card-content'>
		<img src='immagini/reg.png' alt='Registro Mercato' width='48' height='48' />
		</div>
		<div class='card-action'>
		<a href='a_gestione_tornei.php?itorneo=$itorneo&amp;opzione=2'>Registro mercato</a>
		</div>
		</div>
		</div>
		
		<div class='col m3'>
		<div class='card indigo center'>
		<div class='card-content'>
		<img src='immagini/shield.png' alt='Squadre' width='48' height='48' />
		</div>
		<div class='card-action'>
		<a href='a_gestione_tornei.php?itorneo=$itorneo&amp;opzione=3'>Rose squadre</a>
		</div>
		</div>
		</div>
		
		<div class='col m3'>
		<div class='card indigo center'>
		<div class='card-content'>
		<img src='immagini/calendar.png' alt='Utenti' width='48' height='48' />
		</div>
		<div class='card-action'>
		<a href='a_gestione_tornei.php?itorneo=$itorneo&amp;opzione=4'>Calendario</a>
		</div>
		</div>
		</div>
		</div>";
		
		if ($otquotacassa > 0 and $otstato == "B") $colm = "m4";
		elseif ($otquotacassa > 0 and $otstato != "B") $colm = "m6";
		elseif ($otquotacassa == 0 and $otstato == "B") $colm = "m6";
		else $colm = "m12";
		
		echo "<div class='row'>
		<div class='col $colm'>
		<div class='card indigo darken-4 center'>
		<div class='card-content'>
		<img src='immagini/notepad.png' alt='Utenti' width='48' height='48' />
		</div>
		<div class='card-action white-text'>
		Modifica manuale (<a href='./a_edita_file.php?mod_file=".$percorso_cartella_dati."/utenti_".$itorneo.".php'><b>U</b></a> -
		<a href='./a_edita_file.php?mod_file=".$percorso_cartella_dati."/mercato_".$itorneo."_0.txt'><b>M</b></a> -
		<a href='./a_edita_file.php?mod_file=".$percorso_cartella_dati."/registro_mercato_".$itorneo."_0.txt'><b>R</b></a> -
		<a href='./a_edita_file.php?mod_file=".$percorso_cartella_dati."/log".$itorneo.".txt'><b>L</b></a>)
		</div>
		</div>
		</div>";
		
		if ($otquotacassa > 0) {
			
			echo "<div class='col $colm'>
			<div class='card indigo darken-4 center'>
			<div class='card-content'>
			<img src='immagini/money.png' alt='Utenti' width='48' height='48' />
			</div>
			<div class='card-action'>
			<a href='a_gestione_tornei.php?itorneo=$itorneo&amp;opzione=5'>Cassa</a>
			</div>
			</div>
			</div>";
			
		}
		
		if ($otstato == "B") {
			
			echo "<div class='col $colm'>
			<div class='card indigo darken-4 center'>
			<div class='card-content'>
			<img src='immagini/mail.png' alt='Utenti' width='48' height='48' />
			</div>
			<div class='card-action'>
			<a href='a_gestione_tornei.php?itorneo=$itorneo&amp;opzione=6'>Buste</a>
			</div>
			</div>
			</div>";
			
		}
		
		echo"</div>";
		
		unset ($d,$dati);
		
		if ($opzione == 1){
			$file = @file($percorso_cartella_dati."/utenti_".$itorneo.".php");
			$linee = count($file);
			echo "<div class='row'>
			<div class='col m12'>
			<div class='card indigo lighten-5 centered'>
			<div class='card-content'>
			<span class='card-title center'>Utenti iscritti al torneo <b>$otdenom</b></span>
			
			<table width='100%' cellpadding='1' cellspacing='0' >
			<tr>
			<th >&nbsp;</th>
			<th scope='col'>Nome utente</th>
			<th scope='col'>Squadra</th>
			<th scope='col'>Valori</th>
			<th scope='col'>Crediti</th>
			<th scope='col'>Cambi</th>
			<th scope='col'>Azioni</th>
			<th scope='col'>Email</th>
			</tr>";
			
			for($num1 = 1 ; $num1 < $linee; $num1++) {
				@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg, $otitolari, $opanchina, $onome, $ocognome, $ocassa, $otemp4, $otemp5, $otemp6, $otemp7, $otemp8, $otemp9, $otemp0) = explode("<del>", trim($file[$num1]));
				if ($ourl and $ourl != "http://") $link_sito = "&nbsp;&nbsp;&nbsp;(<a href='$ourl' target='_blank'>Sito web</a>)"; else unset($link_sito);
				if ($ocitta == "") $ocitta = "Non specificata";
				
				if (isset($a_mercato)){
					foreach($a_mercato AS $dati){
						$i_squadra .= "(".$dati[$outente]['nome'].")&nbsp;".$dati[$outente]['nome']."<br/>";
					}
				}
				
				if (file_exists($percorso_cartella_dati."/squadra_$outente")) $ums = "<br />- modifica formazione: " . date ("d-m-Y H:i:s.", filemtime($percorso_cartella_dati."/squadra_".$outente));
				else $ums = "&nbsp;";
				
				echo "<tr align='center' valign='middle' bgcolor='$colore'>
				<td align='center'>$num1</td>
				<td align='left'><a href='a_modUtente.php?cambia=$num1&amp;itorneo=$itorneo' class='info'>".htmlentities($outente, ENT_QUOTES)."<span class='infobox'><u><b>Info ".htmlentities($outente, ENT_QUOTES)."</b></u><br/>- Permessi: $opermessi<br/>- Torneo: $otdenom<br/>- Serie: $oserie<br/>- Citt&agrave;: $ocitta<br/>- Registrato il $oreg $ums</span></a></td>
				<td align='center'>$osquadra (".$a_utenti[$outente][10].") $link_sito</td>
				<td align='center'>".$a_utenti[$outente][11]." - ".$a_utenti[$outente][12]." - $ovariazioni</td>
				<td align='center'>".$a_utenti[$outente][13]."</td>
				<td align='center'>$ocambi</td>
				<td align='center'><img src='./immagini/no.png' style='vertical-align: middle' alt='Cancella utente' />&nbsp;&nbsp;<a href='a_eliUtente.php?del=$num1&amp;itorneo=$itorneo&amp;gt=1&amp;oemail=$oemail'> Cancella</a></td>
				<td align='center'><img src='./immagini/email.png' style='vertical-align: middle' alt='Invia mail' />&nbsp;&nbsp;<a href='mailto:$oemail?subject=Comunicazione da Fantacalciobazar'>Invia mail</a></td>
				</tr>";
			}
			echo "</table>
			</div>
			</div>
			</div>
			</div>";
		}
		###################
		elseif ($opzione == 2){
			$filei = @file($percorso_cartella_dati."/utenti_".$itorneo.".php");
			$linee = count($filei);
			
			for($num1 = 1 ; $num1 < $linee; $num1++) {
				@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg, $otitolari, $opanchina, $onome, $ocognome, $ocassa, $otemp4, $otemp5, $otemp6, $otemp7, $otemp8, $otemp9, $otemp0) = explode("<del>", $filei[$num1]);
				$ssquadra[$outente] = $osquadra;
			}
			
			$messaggi = @file($percorso_cartella_dati."/registro_mercato_".$itorneo."_0.txt");
			$num_messaggi = @count($messaggi);
			$num_iniziale = 0;
			
			for ($num1 = $num_iniziale; $num1 < $num_messaggi; $num1++) {
				$messaggio = explode("#@?",$messaggi[$num1]);
				$nome = stripslashes($messaggio[0]);
				$data = stripslashes($messaggio[1]);
				$testo_messaggio = stripslashes($messaggio[2]);
				$soprannome = $ssquadra[$nome];
				
				if (substr("$messaggi[$num1]",0,13) == "Radio mercato" and $stato_mercato != "I") $messmerc .= "$nome<br/>";
				else $messmerc .= "Nessun operazione effettuata.";
				
			} # fine for $num1
			echo "<div class='row'>
			<div class='col m12'>
			<div class='card indigo lighten-5 centered'>
			<div class='card-content'>
			<span class='card-title center'>Registro mercato</span>
			<table width='100%' cellpadding='1' cellspacing='0' >
			<tr>
			<td>
			$messmerc
			</td>
			</tr>
			</table>
			</div>
			</div>
			</div>
			</div>";
		}
		#######################
		elseif ($opzione == 3){
			
			$nome_squadra = "tutti";
			$file = @file($percorso_cartella_dati."/utenti_".$itorneo.".php");
			$linee = count($file);
			
			for($num1 = 1 ; $num1 < $linee; $num1++) {
				@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg, $otitolari, $opanchina, $onome, $ocognome, $ocassa, $otemp4, $otemp5, $otemp6, $otemp7, $otemp8, $otemp9, $otemp0) = explode("<del>", $file[$num1]);
				
				$contatore_calciatori = 0;
				$soldi_spesi = 0;
				$num_calciatori_posseduti = 0;
				$np = 0; $nd = 0; $nc = 0; $nf = 0; $na = 0;
				$calciatori = @file($percorso_cartella_dati."/mercato_".$itorneo."_0.txt");
				$np = 0; $nd = 0; $nc = 0; $nf = 0; $na = 0;
				$num_calciatori = @count($calciatori);
				for ($num2 = 0 ; $num2 < $num_calciatori ; $num2++) {
					$dati_calciatore = explode(",", $calciatori[$num2]);
					$numero = $dati_calciatore[0];
					$ruolo = $dati_calciatore[2];
					$proprietario = $dati_calciatore[4];
					
					if ($proprietario == $outente) {
						$soldi_spesi = $soldi_spesi + $dati_calciatore[3];
						
						$num_calciatori_posseduti++;
						if ($ruolo == "P") $np++;
						else if ($ruolo == "D") $nd++;
						else if ($ruolo == "C") $nc++;
						else if ($ruolo == "F") $nf++;
						else if ($ruolo == "A") $na++;
						
						$nome = stripslashes($dati_calciatore[1]);
						$ruolo = $dati_calciatore[2];
						$costo = $dati_calciatore[3];
						$tempo_off = $dati_calciatore[5];
						$anno_off = substr($tempo_off,0,4);
						$mese_off = intval(substr($tempo_off,4,2));
						$giorno_off = substr($tempo_off,6,2);
						$ora_off = substr($tempo_off,8,2);
						$minuto_off = substr($tempo_off,10,2);
						$adesso = mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"));
						$sec_restanti = mktime($ora_off,$minuto_off,0,$mese_off,$giorno_off,$anno_off) - $adesso;
						$lista_calciatori[$contatore_calciatori] = $numero;
						$contatore_calciatori++;
						$nome_linea = "linea_comprato_$ruolo";
						${$nome_linea}[$numero] = "<tr><td align='center'>$numero</td><td>$nome</td><td align='center'>$ruolo</td><td align='center'>$costo</td></tr>";
					} # fine if ($proprietario == $outente)
				} # fine for $num2
				
				#########################################################
				$tab_centro = "<table width='100%' border='0' cellspacing='1' cellpadding='2' align='center'><tr>
				<td class='testa'>Num.</td>
				<td class='testa'>Nome giocatore</td>
				<td class='testa'>Ruolo</td>
				<td class='testa'>Costo</td>";
				$colspan = 5;
				$tab_centro .= "</tr>
				<tr><td align='center' colspan='$colspan'><B>Titolari</B></td></tr>";
				
				$dati_squadra = @file($percorso_cartella_dati."/squadra_".$outente);
				$titolari = explode(",", $dati_squadra[1]);
				
				# tabella dei titolari
				$num_titolari = count($titolari);
				$num_pos = 1;
				
				for ($num2 = 0 ; $num2 < $num_titolari ; $num2++) {
					$numero_titolare = $titolari[$num2];
					if ($linea_comprato_P[$numero_titolare]) {
						$num_pos++;
						$tab_titolari_P .= $linea_comprato_P[$numero_titolare];
						$inserito[$numero_titolare] = "SI";
					} # fine if ($linea_comprato_P[$numero_titolare])
					if ($linea_comprato_D[$numero_titolare]) {
						$num_pos++;
						$tab_titolari_D .= $linea_comprato_D[$numero_titolare];
						$inserito[$numero_titolare] = "SI";
					} # fine if ($linea_comprato_D[$numero_titolare])
					if ($linea_comprato_C[$numero_titolare]) {
						$num_pos++;
						$tab_titolari_C .= $linea_comprato_C[$numero_titolare];
						$inserito[$numero_titolare] = "SI";
					} # fine if ($linea_comprato_C[$numero_titolare])
					if ($linea_comprato_F[$numero_titolare]) {
						$num_pos++;
						$tab_titolari_F .= $linea_comprato_F[$numero_titolare];
						$inserito[$numero_titolare] = "SI";
					} # fine if ($linea_comprato_F[$numero_titolare])
					if ($linea_comprato_A[$numero_titolare]) {
						$num_pos++;
						$tab_titolari_A .= $linea_comprato_A[$numero_titolare];
						$inserito[$numero_titolare] = "SI";
					} # fine if ($linea_comprato_A[$numero_titolare])
				} # fine for $num2
				$tab_centro .= $tab_titolari_P.$tab_titolari_D.$tab_titolari_C.$tab_titolari_F.$tab_titolari_A;
				
				# Tabella dei panchinari
				$tab_centro .= "<tr bgcolor='$colore'><td align='center' colspan='$colspan'><B>In panchina</B></td></tr>";
				$panchinari = explode(",", $dati_squadra[2]);
				$num_panchinari = count($panchinari);
				for ($num2 = 0 ; $num2 < $num_panchinari ; $num2++) {
					$numero_panchinaro = $panchinari[$num2];
					$num_in_panchina = $num2 + 1;
					if ($linea_comprato_P[$numero_panchinaro]) {
						$linea_comprato_P[$numero_panchinaro] = preg_replace("#value='panchinaro'#","value='panchinaro' checked",$linea_comprato_P[$numero_panchinaro]);
						$linea_comprato_P[$numero_panchinaro] = preg_replace("#option value='$num_in_panchina'#","option value='$num_in_panchina' selected",$linea_comprato_P[$numero_panchinaro]);
						$linea_comprato_P[$numero_panchinaro] = preg_replace("#<tr bgcolor='$colore'><td>&nbsp;</td>#","<tr bgcolor='$colore'><td align='center'>$num_pos</td>",$linea_comprato_P[$numero_panchinaro]);
						$num_pos++;
						$tab_panchinari .= $linea_comprato_P[$numero_panchinaro];
						$inserito[$numero_panchinaro] = "SI";
					} # fine if ($linea_comprato_P[$numero_panchinaro])
					if ($linea_comprato_D[$numero_panchinaro]) {
						$linea_comprato_D[$numero_panchinaro] = preg_replace("#value='panchinaro'#","value='panchinaro' checked",$linea_comprato_D[$numero_panchinaro]);
						$linea_comprato_D[$numero_panchinaro] = preg_replace("#option value='$num_in_panchina'#","option value='$num_in_panchina' selected",$linea_comprato_D[$numero_panchinaro]);
						$linea_comprato_D[$numero_panchinaro] = preg_replace("#<tr bgcolor='$colore'><td>&nbsp;</td>#","<tr bgcolor='$colore'><td align='center'>$num_pos</td>",$linea_comprato_D[$numero_panchinaro]);
						$num_pos++;
						$tab_panchinari .= $linea_comprato_D[$numero_panchinaro];
						$inserito[$numero_panchinaro] = "SI";
					} # fine if ($linea_comprato_D[$numero_panchinaro])
					if ($linea_comprato_C[$numero_panchinaro]) {
						$linea_comprato_C[$numero_panchinaro] = preg_replace("#value='panchinaro'#","value='panchinaro' checked",$linea_comprato_C[$numero_panchinaro]);
						$linea_comprato_C[$numero_panchinaro] = preg_replace("#option value='$num_in_panchina'#","option value='$num_in_panchina' selected",$linea_comprato_C[$numero_panchinaro]);
						$linea_comprato_C[$numero_panchinaro] = preg_replace("#<tr bgcolor='$colore'><td>&nbsp;</td>#","<tr bgcolor='$colore'><td align='center'>$num_pos</td>",$linea_comprato_C[$numero_panchinaro]);
						$num_pos++;
						$tab_panchinari .= $linea_comprato_C[$numero_panchinaro];
						$inserito[$numero_panchinaro] = "SI";
					} # fine if ($linea_comprato_C[$numero_panchinaro])
					if ($linea_comprato_F[$numero_panchinaro]) {
						$linea_comprato_F[$numero_panchinaro] = preg_replace("#value='panchinaro'#","value='panchinaro' checked",$linea_comprato_F[$numero_panchinaro]);
						$linea_comprato_F[$numero_panchinaro] = preg_replace("#option value='$num_in_panchina'#","option value='$num_in_panchina' selected",$linea_comprato_F[$numero_panchinaro]);
						$linea_comprato_F[$numero_panchinaro] = preg_replace("#<tr bgcolor='$colore'><td>&nbsp;</td>#","<tr bgcolor='$colore'><td align='center'>$num_pos</td>",$linea_comprato_F[$numero_panchinaro]);
						$num_pos++;
						$tab_panchinari .= $linea_comprato_F[$numero_panchinaro];
						$inserito[$numero_panchinaro] = "SI";
					} # fine if ($linea_comprato_F[$numero_panchinaro])
					if ($linea_comprato_A[$numero_panchinaro]) {
						$linea_comprato_A[$numero_panchinaro] = preg_replace("#value='panchinaro'#","value='panchinaro' checked",$linea_comprato_A[$numero_panchinaro]);
						$linea_comprato_A[$numero_panchinaro] = preg_replace("#option value='$num_in_panchina'#","option value='$num_in_panchina' selected",$linea_comprato_A[$numero_panchinaro]);
						$linea_comprato_A[$numero_panchinaro] = preg_replace("#<tr bgcolor='$colore'><td>&nbsp;</td>#","<tr bgcolor='$colore'><td align='center'>$num_pos</td>",$linea_comprato_A[$numero_panchinaro]);
						$num_pos++;
						$tab_panchinari .= $linea_comprato_A[$numero_panchinaro];
						$inserito[$numero_panchinaro] = "SI";
					} # fine if ($linea_comprato_A[$numero_panchinaro])
				} # fine for $num2
				#echo $tab_panchinari_P.$tab_panchinari_D.$tab_panchinari_C.$tab_panchinari_A;
				$tab_centro .= $tab_panchinari;
				
				# Tabella degli esclusi
				$tab_centro .= "<tr bgcolor='$colore'><td align='center' colspan='$colspan'><B>Tribuna</B></td></tr>";
				$num_calciatori = @count($lista_calciatori);
				for ($num2 = 0 ; $num2 < $num_calciatori ; $num2++) {
					$numero_fuori = $lista_calciatori[$num2];
					if ($inserito[$numero_fuori] != "SI") {
						if ($linea_comprato_P[$numero_fuori]) {
							$linea_comprato_P[$numero_fuori] = preg_replace("#value='fuori'#","value='fuori' checked",$linea_comprato_P[$numero_fuori]);
							$tab_fuori_P .= $linea_comprato_P[$numero_fuori];
							$inserito[$numero_fuori] = "SI";
						} # fine if ($linea_comprato_P[$numero_fuori])
						if ($linea_comprato_D[$numero_fuori]) {
							$linea_comprato_D[$numero_fuori] = preg_replace("#value='fuori'#","value='fuori' checked",$linea_comprato_D[$numero_fuori]);
							$tab_fuori_D .= $linea_comprato_D[$numero_fuori];
							$inserito[$numero_fuori] = "SI";
						} # fine if ($linea_comprato_D[$numero_fuori])
						if ($linea_comprato_C[$numero_fuori]) {
							$linea_comprato_C[$numero_fuori] = preg_replace("#value='fuori'#","value='fuori' checked",$linea_comprato_C[$numero_fuori]);
							$tab_fuori_C .= $linea_comprato_C[$numero_fuori];
							$inserito[$numero_fuori] = "SI";
						} # fine if ($linea_comprato_C[$numero_fuori])
						if ($linea_comprato_F[$numero_fuori]) {
							$linea_comprato_F[$numero_fuori] = preg_replace("#value='fuori'#","value='fuori' checked",$linea_comprato_F[$numero_fuori]);
							$tab_fuori_F .= $linea_comprato_F[$numero_fuori];
							$inserito[$numero_fuori] = "SI";
						} # fine if ($linea_comprato_F[$numero_fuori])
						if ($linea_comprato_A[$numero_fuori]) {
							$linea_comprato_A[$numero_fuori] = preg_replace("#value='fuori'#","value='fuori' checked",$linea_comprato_A[$numero_fuori]);
							$tab_fuori_A .= $linea_comprato_A[$numero_fuori];
							$inserito[$numero_fuori] = "SI";
						} # fine if ($linea_comprato_A[$numero_fuori])
					} # fine if ($inserito[$num_fuori] != "SI")
				} # fine for $num2
				$tab_centro .= $tab_fuori_P.$tab_fuori_D.$tab_fuori_C.$tab_fuori_F.$tab_fuori_A;
				########################
				# Layout pagina
				
				$titolo = "<font size=+2><u>";
				if ($osquadra) $titolo .= "$osquadra";
				else $titolo .=  "Squadra";
				$titolo .= " di $outente</u></font>";
				$titolo .= "<br /><br />Presidente: <b>$outente</b>";
				if ($ocitta) $titolo .= "<br />Citt&agrave;: <b>$ocitta</b>";
				if ($ourl and $ourl != "http://") $titolo .= "<br />Sito Web: <b>$ourl</b>";
				$titolo .= "<br />Email: <b>$oemail</b>";
				$titolo .= "<br />Data iscrizione: $oreg";
				
				echo "<div class='row'>
				<div class='col m12'>
				<div class='card indigo lighten-5 centered'>
				<div class='card-content'>
				<span class='card-title center'>$titolo</span>
				
				<table width='100%' cellpadding='1' cellspacing='0' >
				<tr>
				<td valign='top'>
				$tab_centro</table>
				</td>
				</tr>
				</table>
				</div>
				</div>
				</div>
				</div>";
				unset ($titolo, $tab_centro);
				
				########################
				
				echo "<br/><hr width='95%' />";
			} # fine for $num1
			
		}
		#######################
		elseif ($opzione == 4){
			$mercato_libero = $otmercato_libero; 					# Gestione giocatori in multipropriet… - SI O NO (NO esegue l'asta)
			$range_campionato = "1-$otgiornate_totali";
			$campionato[$range_campionato] = $ottipo_calcolo;
			#$campionato["7-8"] = "N";
			$diff_num_giornata_file = $otritardo_torneo;      		# differenza tra il n° della giornata del file e quello del torneo di fantacalciobazar
			$stato_mercato = $otstato; 							# Valore importantissimo per il corretto funzionamento.
			$soldi_iniziali = $otcrediti_iniziali;					# Soldi iniziali di ogni giocatore
			$max_calciatori = $otnumcalciatori; 					# Numero massimo di calciatori che si possono possedere
			$tipo_messaggeria = $temp1;								# 0=pubblica 1=privata
			$composizione_squadra = explode("-",$otcomposizione_squadra); # $composizione_squadra = array("38806","38725","38815","38716");
			$numero_cambi_max = $otnumero_cambi_max; 				# in mercato libero &egrave; il massimo dei cambi consentiti
			$rip_cambi_numero = $otrip_cambi_numero; 				# cambi consentiti nel mercato di riparazione - Impostare a 0 per disabilitare il mercato di riparazione
			$rip_cambi_giornate = explode("-",$otrip_cambi_giornate); 	# giornate dopo le quali si effettua il mercato di riparazione
			$rip_cambi_durata = $otrip_cambi_durata; 				# durata del mercato di riparazione - Impostare a 1 per applicare il regolamento gazzetta 2005-2006 - 0 per applicare il reolamento 2004-2005
			$modificatore_difesa = $otmodificatore_difesa; 			# impostazione per il calcolo del punteggio con modificatore solo per campionato libero
			$schemi = explode("-",$otschemi); 						# Gli schemi di gioco utilizzabili. Gli schemi a 5 numeri servono solo se si usano i fantasisti. Si possono aggiungere o togliere schemi.
			$max_in_panchina = $otmax_in_panchina;					# Numero di calciatori in panchina e quanti ne possono entrare. Si possono fare sostituzioni per ruolo (il calciatore entra se un'altro del suo ruolo non ha giocato) o per schema (il calciatore entra se entrando lo schema che si forma &egrave; tra quelli consentiti). Se sia per ruolo che per schema sono a SI si sostituisce prima per ruolo.
			$panchina_fissa = $otpanchina_fissa;					# impostare a "SI" per avere la panchina (1222 come PDCA) altrimenti "NO" (le maiuscole contano!)
			$max_entrate_dalla_panchina = $otmax_entrate_dalla_panchina;
			$sostituisci_per_ruolo = $otsostituisci_per_ruolo;		# impostare a "SI" o "NO" (le maiuscole contano!)
			$sostituisci_per_schema = $otsostituisci_per_schema; 		# in aggiunta a $sostituisci_per_ruolo se insufficiente effettua la sostituzione per schema
			$sostituisci_fantasisti_come_centrocampisti = $otsostituisci_fantasisti_come_centrocampisti; # impostare a "SI" o "NO", usato solo con sostituzioni per ruolo, massimo 1 fantasista
			$aspetta_giorni = $otaspetta_giorni;
			$aspetta_ore = $otaspetta_ore;
			$aspetta_minuti = $otaspetta_minuti;
			$num_calciatori_scambiabili = $otnum_calciatori_scambiabili; 	# Numero di calciatori inseribili in una offerta di scambio (0 per disabilitare gli scambi) e possibilit… di inserire anche soldi nello scambio. Questa variabile si usa solo nella modalit… $mercato_libero = "NO"
			$scambio_con_soldi = $otscambio_con_soldi;				# impostare a "SI" o "NO" (le maiuscole contano!)
			$vendi_costo = $otvendi_costo;
			$percentuale_vendita = $otpercentuale_vendita; 			# Percentuale del costo pagato a cui si può rivendere subito il calciatore
			
			# Dati per i campionati a scontri diretti. Servono solo se si &egrave; impostato un campionato a "S".
			$soglia_voti_primo_gol = $otsoglia_voti_primo_gol;
			$incremento_voti_gol_successivi = $otincremento_voti_gol_successivi;
			$voti_bonus_in_casa = $otvoti_bonus_in_casa;
			$punti_partita_vinta = $otpunti_partita_vinta;
			$punti_partita_pareggiata = $otpunti_partita_pareggiata;
			$punti_partita_persa = $otpunti_partita_persa;
			$differenza_punti_a_parita_gol = $otdifferenza_punti_a_parita_gol; 			#	a parit… di gol se una delle due squadre ha uno scarto di punti maggiore o uguale a quello impostato prende un ulteriore gol, impostare a zero per disabilitare
			$differenza_punti_zero_a_zero = $otdifferenza_punti_zero_a_zero; 			#	come sopra ma scatta solo sullo 0-0, impostare a zero per disabilitare
			
			# Numero minimo di calciatori che devono essere titolari in formazione per ottenere punti (sono compresi anche quelli che non giocano). Non impostare a più di 11.
			$min_num_titolari_in_formazione = $otmin_num_titolari_in_formazione;
			
			$punti_pareggio = $otpunti_pareggio;			# impostare a "M" per la media, "A" per i punti della posizione più alta o "B" per quelli della più bassa
			$punti_posizione = array();
			$punti_posizione = explode ("-",$otpunti_pos);	# punti assegnati al primo di giornata
			#################################################################################################
			
			echo "<div class='row'>
			<div class='col m12'>
			<div class='card indigo lighten-5 centered'>
			<div class='card-content'>
			<span class='card-title center'>$titolo</span>
			<div style='background-color: $sfondo_tab; margin-top:5px; margin-bottom:5px; padding: 5px; border: 1px solid $sfondo_tab2'>Giornate giocate:&nbsp;";
			
			for($num1 = 1 ; $num1 < 40 ; $num1++) {
				if (strlen($num1) == 1) $num1 = "0".$num1;
				$giornata_controlla = "giornata$num1";
				if (!@is_file($percorso_cartella_dati."/".$giornata_controlla."_".$itorneo."_0")) break;
				else {
					echo "<a href='a_gestione_tornei.php?itorneo=$itorneo&amp;opzione=$opzione&amp;giornata=$num1'>&nbsp;$num1&nbsp;</a>&nbsp;";
					$giornata_ultima = $num1;
				}
			} # fine for $num1
			echo "</div>";
			
			if (!$giornata or $giornata > $giornata_ultima) $giornata = "$giornata_ultima";
			
			$tab_formazioni = "<tr>";
			$num_colonne = 0;
			$num2 = 0;
			$leggendo_formazioni = "SI";
			$leggendo_punteggi = "NO";
			$leggendo_voti = "NO";
			$leggendo_scontri = "NO";
			$voti_esistenti = "NO";
			
			if ($giornata_ultima) $file_giornata = @file($percorso_cartella_dati."/giornata".$giornata."_".$itorneo."_0");
			$num_linee_file_giornata = @count($file_giornata);
			
			for($num1 = 0 ; $num1 < $num_linee_file_giornata; $num1++) {
				$linea = trim($file_giornata[$num1]);
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
			
			$file = @file($percorso_cartella_dati."/utenti_".$itorneo.".php");
			$linee = count($file);
			for ($num1 = 1 ; $num1 < $linee; $num1++) {
				@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg, $otitolari, $opanchina, $onome, $ocognome, $ocassa, $otemp4, $otemp5, $otemp6, $otemp7, $otemp8, $otemp9, $otemp0) = explode("<del>", $file[$num1]);
				if ($opermessi != -1){
					$nome_posizione[$num1] = $outente;
					$soprannome_squadra = $osquadra;
					
					if ($soprannome_squadra) {
						$nome_squadra_memo[$outente] = $soprannome_squadra;
						$soprannome_squadra = "<b>".$soprannome_squadra."</b>";
					} # fine if ($soprannome_squadra)
					else {
						$soprannome_squadra = "Squadra";
						$nome_squadra_memo[$outente] = $outente;
					} # fine else if ($soprannome_squadra)
					
					if ($num_colonne >= 2) {
						$tab_formazioni .= "</tr><tr>";
						$num_colonne = 0;
					} # fine if ($num_colonne >= 2)
					$num_colonne++;
					$tab_formazioni .= "<td align='left' valign='top'>
					<table width='100%' cellpadding='3' cellspacing='1' bgcolor='$sfondo_tab' align='center' style='border: 1px solid'>
					<caption>$soprannome_squadra di $outente</caption>
					<tr><td><font size='-2'><u>Calciatore</u></font></td><td align='center'><font size='-2'>Fanta<br/>voto</font></td><td align='center'><font size='-2'>Voto<br/>giornale</font></td></tr>";
					$formazione = "formazione_$outente";
					$formazione = $$formazione;
					$num_linee_formazione = @count($formazione);
					
					for ($num2 = 0 ; $num2 < $num_linee_formazione; $num2++) {
						$riga_calciatore = explode(",", $formazione[$num2]);
						$nome_calciatore = stripslashes($riga_calciatore[1]);
						if ($num2 % 2) $colore="#FFFFFF"; else $colore = $colore_riga_alt;
						$tab_formazioni .= "<tr bgcolor='$colore'><td>".$riga_calciatore[2]."&nbsp;&nbsp;&nbsp;$nome_calciatore</td><td align='center'>".$riga_calciatore[3]."</td><td align='center'>".$riga_calciatore[4]."</td></tr>";
					} # fine for $num2
					$tab_formazioni .= "</table></td>";
				}
			} # fine for $num1
			
			for($num1 = $num_colonne ; $num1 < 2; $num1++) $tab_formazioni .= "<td>&nbsp;</td>";
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
				echo "<br/><table style='background-color: $sfondo_tab; margin-top:5px; margin-bottom:5px; padding: 5px; border: 1px solid $sfondo_tab2' width='80%' align='center'>";
				echo "<tr><td width='50%' align='center'><b>Partite</b></td><td><b>Risultato</b></td></tr>";
				$partite = "";
				$marcotori = "";
				$num_scontri = count($scontri);
				for ($num1 = 0 ; $num1 < $num_scontri ; $num1++) {
					$dati_scontri = explode("##@@&&", $scontri[$num1]);
					echo "<tr><td align='center'>".$nome_squadra_memo[$dati_scontri[0]]." - ".$nome_squadra_memo[$dati_scontri[1]]."</td>
					<td align='left'>".$dati_scontri[2]." - ".$dati_scontri[3]."</td></tr>";
				} # fine for $num1
				echo "</table><br/>";
			} # fine if ($tipo_campionato == "S")
			
			###############################################
			
			if ($voti_esistenti == "SI") {
				$giorn_ata = substr($giornata,-2);
				echo "<br/><table cellpadding='10' style='background-color: $sfondo_tab; margin-top:5px; margin-bottom:5px; border: 1px solid $sfondo_tab2' align='center'>
				<tr><td align='left' valign='top'><b><u>Voti della giornata $giorn_ata</u></b>:<br/>";
				$num_voti = count($voti);
				for ($num1 = 0 ; $num1 < $num_voti ; $num1++) {
					$dati_voti = explode("##@@&&", $voti[$num1]);
					settype($dati_voti[1],"double");
					$voto[$dati_voti[0]] = $dati_voti[1];
				} # fine for $num1
				arsort ($voto);
				reset ($voto);
				while (list ($key, $val) = each ($voto)) {
					echo $nome_squadra_memo[$key].": $val<br/>";
				} # fine while
				echo "</td>";
				
				if ($modificatore_difesa == "SI") {
					echo "<td align='left' valign='top'><u><b>Modificatore difesa</b></u><br/>";
					$num_mod = count($modificatore);
					for ($num1 = 0 ; $num1 < $num_mod ; $num1++) {
						$dati_mod = explode("##@@&&", $modificatore[$num1]);
						settype($dati_mod[1],"double");
						echo $dati_mod[0].": ".$dati_mod[1]."<br/>";
						$mod[$dati_mod[0]] = $dati_mod[1];
					} # fine for $num1
					echo "</td>";
				} # fine if modificatore difesa
				
				if ($tipo_campionato == "P") {
					echo "<td align='left' valign='top'><b><u>Punteggio</u></b><br/>";
					$num_punteggi = count($punteggi);
					for ($num1 = 0 ; $num1 < $num_punteggi ; $num1++) {
						$dati_punteggi = explode("##@@&&", $punteggi[$num1]);
						settype($dati_punteggi[1],"double");
						$punteggio[$dati_punteggi[0]] = $dati_punteggi[1];
					} # fine for $num1
					arsort ($punteggio);
					reset ($punteggio);
					while (list ($key, $val) = each ($punteggio)) {
						echo "$val<br/>";
					} # fine while
					echo "</td>";
				} # fine if ($tipo_campionato == "P")
				
				# calcolo la classifica fino a questa giornata
				if ($tipo_campionato != "N") {
					$punti = "";
					for ($num1 = $g_inizio_campionato ; $num1 <= $num_giornata ; $num1++) {
						if (strlen($num1) == 1) $num1 = "0".$num1;
						$giornata_punti = "giornata$num1";
						if (@is_file($percorso_cartella_dati."/".$giornata_punti."_".$itorneo."_0")) {
							$file_giornata_p = @file($percorso_cartella_dati."/".$giornata_punti."_".$itorneo."_0");
							$num_linee_file_giornata_p = count($file_giornata_p);
							$leggendo_punteggi = "NO";
							$punteggi_esistenti_p = "NO";
							for($num2 = 0 ; $num2 < $num_linee_file_giornata_p; $num2++) {
								$linea = trim($file_giornata_p[$num2]);
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
					
					echo "<td align='left'>&nbsp;&nbsp;</td><td align='left'><font color='red'><b><u>Classifica alla giornata $num_giornata_campionato</u></b>:</font><br/>";
					arsort ($punti);
					reset ($punti);
					$posclas = 0;
					while (list ($key, $val) = each ($punti)) {
						$posclas++;
						echo "$posclas)&nbsp;".$nome_squadra_memo[$key].": $val<br/>";
					} # fine while
					echo "</td>";
				} # fine if ($tipo_campionato != "N")
				echo "</tr></table><br/>";
			} # fine if ($voti_esistenti == "SI")
			
			echo "<table align='center' width='100%' bgcolor='$sfondo_tab' border='1' cellpadding='0' cellspacing='0'>
			<caption>Giornata $giornata</caption>
			$tab_formazioni</table></div>
			</div>
			</div>
			</div>";
		}
		elseif ($opzione == 5){
			$file = @file($percorso_cartella_dati."/utenti_".$itorneo.".php");
			$linee = count($file);
			echo "<div class='row'>
			<div class='col m12'>
			<div class='card indigo lighten-5 centered'>
			<div class='card-content'>
			<span class='card-title center'>Cassa utenti iscritti al torneo <b>$otdenom</b></span>
			<table cellpadding='1' cellspacing='0'>
			<th>&nbsp;</th>
			<th scope='col'>Nome utente</th>
			<th scope='col'>Squadra</th>
			<th scope='col'>Quota</th>
			<th scope='col'>Versato</th>
			<th scope='col'>Diff &#177;</th>
			<th scope='col'>Email</th>
			</tr>";
			
			for($num1 = 1 ; $num1 < $linee; $num1++) {
				@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg, $otitolari, $opanchina, $onome, $ocognome, $ocassa, $otemp4, $otemp5, $otemp6, $otemp7, $otemp8, $otemp9, $otemp0) = explode("<del>", trim($file[$num1]));
				#if ($ourl and $ourl != "http://") $link_sito = "&nbsp;&nbsp;&nbsp;(<a href='$ourl' target='_blank'>Sito web</a>)"; else unset($link_sito);
					
					if ($ocitta == "") $ocitta = "Non specificata";
					
					echo "<tr align='center' valign='middle' bgcolor='$colore'>
					<td align='center'>$num1</td>
					<td align='left'><a href='a_modUtente.php?cambia=$num1&amp;itorneo=$itorneo' class='info'>".htmlentities($outente, ENT_QUOTES)."<span class='infobox'><u><b>Info ".htmlentities($outente, ENT_QUOTES)."</b></u><br/>- Permessi: $opermessi<br/>- Torneo: $otdenom<br/>- Serie: $oserie<br/>- Citt&agrave;: $ocitta<br/>- Registrato il $oreg $ums</span></a></td>
					<td align='center'>$osquadra (".$a_utenti[$outente][10].") $link_sito</td>
					<td align='center'>$otquotacassa</td>
					<td align='center'>".$ocassa."</td>
					<td align='center'>".($ocassa-$otquotacassa)."</td>	
					<td align='center'><img src='./immagini/email.png' style='vertical-align: middle' alt='Invia mail' />&nbsp;&nbsp;<a href='mailto:$oemail?subject=Comunicazione da Fantacalciobazar'>Invia mail</a></td>
					</tr>";
				}
				echo "</table></div>
				</div>
				</div>
				</div>";
			}
			elseif ($opzione == 6){
				
				echo "<div style='text-align:center; background-color: $sfondo_tab; margin-top:5px; margin-bottom:5px; padding: 5px; border: 1px solid $sfondo_tab2'><a href='a_gestione_tornei.php?itorneo=$itorneo&amp;buste=1'><b>A</b>pri Buste</a> - <a href='./a_gestione_tornei.php?itorneo=$itorneo&amp;buste=2'><b>V</b>edi Buste Aperte</a> - <a href='./a_gestione_tornei.php?itorneo=$itorneo&amp;buste=3'><b>I</b>mposta Data Chiusura Buste</a>  - <a href='./a_gestione_tornei.php?itorneo=$itorneo&amp;buste=4'><b>M</b>anuale Utilizzo Buste</a><br />";
				
			}
			elseif ($buste == 1){
				
				if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] == 5)  {
					
					
					
					// Variabili da impostare
					$filename = "$percorso_cartella_dati/mercato_".$itorneo."_0.txt"; // Path completo del file
					$sep = ","; // Separatore tra elementi della stessa riga
					$index_date = 5; // Posizione della data in una riga (parte da 0)  
					$index_value = 3; // Posizione dell'importo della busta in una riga (parte da 0)
					$index_proprietario = 4; //Posizione del nome del proprietario (parte da 0)
					$index_name = 1; // Posizione del nome ina una riga (parte da 0) 
					$index_id = 0; //posizione dell'ID dell'oggetto
					$data_buste_chiuse = @join ('', file ("$percorso_cartella_dati/data_buste_".$itorneo."_0.txt"));
					$data_busta_precedente = @join('', @file("./dati/data_buste_precedente_".$itorneo."_0.txt"));
					//
					$lista_offerte_identiche = array();
					$lista_calciatori = array();
					$box_data->data = "";
					$box_data->valore = 0;
					
					$fd = @fopen($filename, "r");
					
					if ($fd === false ) {
						echo "File mercato non esistente!";
						include("./footer.php");
						exit;
					}
					
					$file_messaggi = fopen("$percorso_cartella_dati/registro_mercato_".$itorneo."_0.txt","ab+");
					
					// Ciclo sulle righe
					while ( !feof ( $fd ) )
					{
						// Legge la riga corrente
						$line = fgets ( $fd );
						
						// Splitta la riga in un array a seconda del separatore
						$list_line_data = explode ( $sep, $line );
						
						// Estrae i dati interessanti
						$cur_date = $list_line_data[$index_date];
						$cur_value = $list_line_data[$index_value];
						$cur_id = $list_line_data[$index_id];
						$proprietario_attuale = $list_line_data[4];
						$messaggio = "\r\nRadio mercato: ".date("d/m/Y H:i")." - ".$proprietario_attuale." ha ";   
						flock($file_messaggi,LOCK_EX);
						
						$busta_vecchia = 0 ;
						if ($cur_date == $data_busta_precedente ) $busta_vecchia = 1 ;
						if (isset ($lista_calciatori[$cur_id])) {
							if ($cur_value > $lista_calciatori[$cur_id][$index_value])	{
								$proprietario_pre = $lista_calciatori[$cur_id][$index_proprietario];  
								$lista_calciatori[$cur_id] = $list_line_data;
								
								if ($busta_vecchia == 0) {
									
									flock($file_messaggi,LOCK_EX);
									fwrite($file_messaggi,$messaggio." acquisito ".$lista_calciatori[$cur_id][$index_name]." per ".$lista_calciatori[$cur_id][$index_value]." FantaMilioni superando l'offerta di ".$proprietario_pre."\n");
									flock($file_messaggi,LOCK_UN);
								}
								
							}
							elseif ($cur_value == $lista_calciatori[$cur_id][$index_value]) {
								$lista_offerte_identiche[$cur_id]['offerta'] = $cur_value;
								if ($busta_vecchia == 0) {
									flock($file_messaggi,LOCK_EX);
									fwrite($file_messaggi,$messaggio." offerto ".$lista_calciatori[$cur_id][$index_value]." FantaMilioni per ".$lista_calciatori[$cur_id][$index_name]." parità con ".$lista_calciatori[$cur_id][$index_proprietario] ." [Giocatore reinserito nel mercato]\n" );
									flock($file_messaggi,LOCK_UN);
								}
								unset($lista_calciatori[$cur_id]);
							}
							else continue;
						}
						//else $lista_calciatori[$cur_id] = $list_line_data;
						elseif (isset($lista_offerte_identiche[$cur_id]) and $cur_value > $lista_offerte_identiche[$cur_id]['offerta'] )  {
							$lista_calciatori[$cur_id] = $list_line_data;
							$lista_offerte_identiche[$cur_id]['offerta'] = $cur_value;
							fwrite($file_messaggi,"".$messaggio." ha superato con ".$lista_calciatori[$cur_id][$index_value]." FantaMilioni l'offerta dei precedenti offerenti per il giocatore ".$lista_calciatori[$cur_id][$index_name]."");
						}
						elseif (isset ($lista_offerte_identiche[$cur_id]) and $cur_value <= $lista_offerte_identiche[$cur_id]['offerta'] ) continue;
						elseif (!isset ($lista_offerte_identiche[$cur_id])) {
							$lista_calciatori[$cur_id] = $list_line_data;
							if ($busta_vecchia == 0) {            
								flock($file_messaggi,LOCK_EX);
								fwrite($file_messaggi,$messaggio." acquisito ".$lista_calciatori[$cur_id][$index_name]." per ".$lista_calciatori[$cur_id][$index_value]." FantaMilioni\n");
								flock($file_messaggi,LOCK_UN);
							}
						}
						
					}
					fclose($file_messaggi);
					$fd = fopen ("$percorso_cartella_dati/buste_aperte_".$itorneo."_0.txt" , "w" );
					foreach ($lista_calciatori as $line) {
						$line[5] = $data_buste_chiuse."\n";
						fwrite ($fd,implode($sep,$line));
					}
					fclose ($fd);
					
					############## Copia di mercato.txt in buste_chiuse.txt
					
					$newfile = "$percorso_cartella_dati/buste_chiuse_".$itorneo."_0.txt";
					$aperte = "$percorso_cartella_dati/buste_aperte_".$itorneo."_0.txt";
					copy($filename, $newfile);
					unlink($filename);
					copy($aperte, $filename);
					$file_data_buste = fopen($percorso_cartella_dati."/data_buste_precedente_".$itorneo."_0.txt" , "w");
					flock($file_data_buste,LOCK_EX);
					fwrite($file_data_buste, $data_buste_chiuse);
					flock($file_data_buste,LOCK_UN);
					fclose ($file_data_buste);
					#########################################################
					
					echo "<div style='text-align:center; background-color: $sfondo_tab; margin-top:5px; margin-bottom:5px; padding: 5px; border: 1px solid $sfondo_tab2'><a href='a_gestione_tornei.php?itorneo=$itorneo&amp;buste=1'><b>A</b>pri Buste</a> - <a href='./a_gestione_tornei.php?itorneo=$itorneo&amp;buste=2'><b>V</b>edi Buste Aperte</a> - <a href='./a_gestione_tornei.php?itorneo=$itorneo&amp;buste=3'><b>I</b>mposta Data Chiusura Buste</a> <br />
					<br /><center><b>Le buste sono state aperte.<br />
					Se hai bisogno di fare un altro giro di buste chiuse, devi controllare
					che l'ultima riga del file mercato_".$itorneo."._0txt sia cos&igrave;:\",".$data_buste_chiuse."\"<br />
					Se non &egrave; cos&igrave; aggiungila alla fine del file</b></center><br /></div>\n";
					
				} # fine if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] == 5)
			} # fine $buste = 1
			
			elseif ($buste == 2){
				
				if ($_SESSION['permessi'] == 5) {
					
					echo "<div style='text-align:center; background-color: $sfondo_tab; margin-top:5px; margin-bottom:5px; padding: 5px; border: 1px solid $sfondo_tab2'><a href='a_gestione_tornei.php?itorneo=$itorneo&amp;buste=1'><b>A</b>pri Buste</a> - <a href='./a_gestione_tornei.php?itorneo=$itorneo&amp;buste=2'><b>V</b>edi Buste Aperte</a> - <a href='./a_gestione_tornei.php?itorneo=$itorneo&amp;buste=3'><b>I</b>mposta Data Chiusura Buste</a>  - <a href='./a_gestione_tornei.php?itorneo=$itorneo&amp;buste=4'><b>M</b>anuale Utilizzo Buste</a><br /></div>";
					
					$nome_squadra = "tutti";
					$file = @file($percorso_cartella_dati."/utenti_".$itorneo.".php");
					$linee = count($file);
					
					for($num1 = 1 ; $num1 < $linee; $num1++) {
						@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg, $otitolari, $opanchina, $onome, $ocognome, $ocassa, $otemp4, $otemp5, $otemp6, $otemp7, $otemp8, $otemp9, $otemp0) = explode("<del>", $file[$num1]);
						
						if ($num1 % 2) $colore="white"; else $colore=$colore_riga_alt;
						
						$contatore_calciatori = 0;
						$lista_calciatori = "";
						$soldi_spesi = 0;
						$num_calciatori_posseduti = 0;
						$np = 0; $nd = 0; $nc = 0; $nf = 0; $na = 0;
						$calciatori = @file($percorso_cartella_dati."/mercato_".$itorneo."_0.txt");
						$np = 0; $nd = 0; $nc = 0; $nf = 0; $na = 0;
						$num_calciatori = count($calciatori);
						for ($num2 = 0 ; $num2 < $num_calciatori ; $num2++) {
							$dati_calciatore = explode(",", $calciatori[$num2]);
							$numero = $dati_calciatore[0];
							$ruolo = $dati_calciatore[2];
							$proprietario = $dati_calciatore[4];
							
							if ($proprietario == $outente) {
								$soldi_spesi = $soldi_spesi + $dati_calciatore[3];
								
								$num_calciatori_posseduti++;
								if ($ruolo == "P") $np++;
								else if ($ruolo == "D") $nd++;
								else if ($ruolo == "C") $nc++;
								else if ($ruolo == "F") $nf++;
								else if ($ruolo == "A") $na++;
								
								$nome = stripslashes($dati_calciatore[1]);
								$ruolo = $dati_calciatore[2];
								$costo = $dati_calciatore[3];
								$tempo_off = $dati_calciatore[5];
								$anno_off = substr($tempo_off,0,4);
								$mese_off = substr($tempo_off,4,2);
								$giorno_off = substr($tempo_off,6,2);
								$ora_off = substr($tempo_off,8,2);
								$minuto_off = substr($tempo_off,10,2);
								$adesso = mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"));
								$sec_restanti = mktime($ora_off,$minuto_off,0,$mese_off,$giorno_off,$anno_off) - $adesso;
								$lista_calciatori[$contatore_calciatori] = $numero;
								$contatore_calciatori++;
								$nome_linea = "linea_comprato_$ruolo";
								${$nome_linea}[$numero] = "<tr><td align='center'>$numero</td><td>$nome</td><td align='center'>$ruolo</td><td align='center'>$costo</td></tr>";
							} # fine if ($proprietario == $outente)
						} # fine for $num2
						
						#########################################################
						$tab_centro = "<table width='100%' border='0' cellspacing='1' cellpadding='2' align='center'><tr>
						<td class='testa'>Num.</td>
						<td class='testa'>Nome giocatore</td>
						<td class='testa'>Ruolo</td>
						<td class='testa'>Costo</td>";
						$colspan = 5;
						$tab_centro .= "</tr>
						<tr><td align='center' colspan='$colspan'><B>Titolari</B></td></tr>";
						
						$dati_squadra = @file($percorso_cartella_dati."/squadra_".$outente);
						$titolari = explode(",", $dati_squadra[1]);
						
						# tabella dei titolari
						$num_titolari = count($titolari);
						$tab_titolari_P = "";
						$tab_titolari_D = "";
						$tab_titolari_C = "";
						$tab_titolari_F = "";
						$tab_titolari_A = "";
						$inserito = "";
						$num_pos = 1;
						
						for ($num2 = 0 ; $num2 < $num_titolari ; $num2++) {
							$numero_titolare = $titolari[$num2];
							if ($linea_comprato_P[$numero_titolare]) {
								$num_pos++;
								$tab_titolari_P .= $linea_comprato_P[$numero_titolare];
								$inserito[$numero_titolare] = "SI";
							} # fine if ($linea_comprato_P[$numero_titolare])
							if ($linea_comprato_D[$numero_titolare]) {
								$num_pos++;
								$tab_titolari_D .= $linea_comprato_D[$numero_titolare];
								$inserito[$numero_titolare] = "SI";
							} # fine if ($linea_comprato_D[$numero_titolare])
							if ($linea_comprato_C[$numero_titolare]) {
								$num_pos++;
								$tab_titolari_C .= $linea_comprato_C[$numero_titolare];
								$inserito[$numero_titolare] = "SI";
							} # fine if ($linea_comprato_C[$numero_titolare])
							if ($linea_comprato_F[$numero_titolare]) {
								$num_pos++;
								$tab_titolari_F .= $linea_comprato_F[$numero_titolare];
								$inserito[$numero_titolare] = "SI";
							} # fine if ($linea_comprato_F[$numero_titolare])
							if ($linea_comprato_A[$numero_titolare]) {
								$num_pos++;
								$tab_titolari_A .= $linea_comprato_A[$numero_titolare];
								$inserito[$numero_titolare] = "SI";
							} # fine if ($linea_comprato_A[$numero_titolare])
						} # fine for $num2
						$tab_centro .= $tab_titolari_P.$tab_titolari_D.$tab_titolari_C.$tab_titolari_F.$tab_titolari_A;
						
						# Tabella dei panchinari
						$tab_centro .= "<tr bgcolor='$colore'><td align='center' colspan='$colspan'><B>In panchina</B></td></tr>";
						$panchinari = explode(",", $dati_squadra[2]);
						$num_panchinari = count($panchinari);
						$tab_panchinari_P = "";
						$tab_panchinari_D = "";
						$tab_panchinari_C = "";
						$tab_panchinari_F = "";
						$tab_panchinari_A = "";
						$tab_panchinari = "";
						for ($num2 = 0 ; $num2 < $num_panchinari ; $num2++) {
							$numero_panchinaro = $panchinari[$num2];
							$num_in_panchina = $num2 + 1;
							if ($linea_comprato_P[$numero_panchinaro]) {
								$linea_comprato_P[$numero_panchinaro] = preg_replace("#value='panchinaro'","value='panchinaro' checked",$linea_comprato_P[$numero_panchinaro]);
								$linea_comprato_P[$numero_panchinaro] = preg_replace("#option value='$num_in_panchina'","option value='$num_in_panchina' selected",$linea_comprato_P[$numero_panchinaro]);
								$linea_comprato_P[$numero_panchinaro] = preg_replace("#<tr bgcolor='$colore'><td>&nbsp;</td>","<tr bgcolor='$colore'><td align='center'>$num_pos</td>",$linea_comprato_P[$numero_panchinaro]);
								$num_pos++;
								$tab_panchinari .= $linea_comprato_P[$numero_panchinaro];
								$inserito[$numero_panchinaro] = "SI";
							} # fine if ($linea_comprato_P[$numero_panchinaro])
							if ($linea_comprato_D[$numero_panchinaro]) {
								$linea_comprato_D[$numero_panchinaro] = preg_replace("#value='panchinaro'","value='panchinaro' checked",$linea_comprato_D[$numero_panchinaro]);
								$linea_comprato_D[$numero_panchinaro] = preg_replace("#option value='$num_in_panchina'","option value='$num_in_panchina' selected",$linea_comprato_D[$numero_panchinaro]);
								$linea_comprato_D[$numero_panchinaro] = preg_replace("#<tr bgcolor='$colore'><td>&nbsp;</td>","<tr bgcolor='$colore'><td align='center'>$num_pos</td>",$linea_comprato_D[$numero_panchinaro]);
								$num_pos++;
								$tab_panchinari .= $linea_comprato_D[$numero_panchinaro];
								$inserito[$numero_panchinaro] = "SI";
							} # fine if ($linea_comprato_D[$numero_panchinaro])
							if ($linea_comprato_C[$numero_panchinaro]) {
								$linea_comprato_C[$numero_panchinaro] = preg_replace("#value='panchinaro'","value='panchinaro' checked",$linea_comprato_C[$numero_panchinaro]);
								$linea_comprato_C[$numero_panchinaro] = preg_replace("#option value='$num_in_panchina'","option value='$num_in_panchina' selected",$linea_comprato_C[$numero_panchinaro]);
								$linea_comprato_C[$numero_panchinaro] = preg_replace("#<tr bgcolor='$colore'><td>&nbsp;</td>","<tr bgcolor='$colore'><td align='center'>$num_pos</td>",$linea_comprato_C[$numero_panchinaro]);
								$num_pos++;
								$tab_panchinari .= $linea_comprato_C[$numero_panchinaro];
								$inserito[$numero_panchinaro] = "SI";
							} # fine if ($linea_comprato_C[$numero_panchinaro])
							if ($linea_comprato_F[$numero_panchinaro]) {
								$linea_comprato_F[$numero_panchinaro] = preg_replace("#value='panchinaro'","value='panchinaro' checked",$linea_comprato_F[$numero_panchinaro]);
								$linea_comprato_F[$numero_panchinaro] = preg_replace("#option value='$num_in_panchina'","option value='$num_in_panchina' selected",$linea_comprato_F[$numero_panchinaro]);
								$linea_comprato_F[$numero_panchinaro] = preg_replace("#<tr bgcolor='$colore'><td>&nbsp;</td>","<tr bgcolor='$colore'><td align='center'>$num_pos</td>",$linea_comprato_F[$numero_panchinaro]);
								$num_pos++;
								$tab_panchinari .= $linea_comprato_F[$numero_panchinaro];
								$inserito[$numero_panchinaro] = "SI";
							} # fine if ($linea_comprato_F[$numero_panchinaro])
							if ($linea_comprato_A[$numero_panchinaro]) {
								$linea_comprato_A[$numero_panchinaro] = preg_replace("#value='panchinaro'","value='panchinaro' checked",$linea_comprato_A[$numero_panchinaro]);
								$linea_comprato_A[$numero_panchinaro] = preg_replace("#option value='$num_in_panchina'","option value='$num_in_panchina' selected",$linea_comprato_A[$numero_panchinaro]);
								$linea_comprato_A[$numero_panchinaro] = preg_replace("#<tr bgcolor='$colore'><td>&nbsp;</td>","<tr bgcolor='$colore'><td align='center'>$num_pos</td>",$linea_comprato_A[$numero_panchinaro]);
								$num_pos++;
								$tab_panchinari .= $linea_comprato_A[$numero_panchinaro];
								$inserito[$numero_panchinaro] = "SI";
							} # fine if ($linea_comprato_A[$numero_panchinaro])
						} # fine for $num2
						#echo $tab_panchinari_P.$tab_panchinari_D.$tab_panchinari_C.$tab_panchinari_A;
						$tab_centro .= $tab_panchinari;
						
						# Tabella degli esclusi
						$tab_centro .= "<tr bgcolor='$colore'><td align='center' colspan='$colspan'><B>Tribuna</B></td></tr>";
						$tab_fuori_P = "";
						$tab_fuori_D = "";
						$tab_fuori_C = "";
						$tab_fuori_F = "";
						$tab_fuori_A = "";
						$num_calciatori = count($lista_calciatori);
						for ($num2 = 0 ; $num2 < $num_calciatori ; $num2++) {
							$numero_fuori = $lista_calciatori[$num2];
							if ($inserito[$numero_fuori] != "SI") {
								if ($linea_comprato_P[$numero_fuori]) {
									$linea_comprato_P[$numero_fuori] = preg_replace("#value='fuori'","value='fuori' checked",$linea_comprato_P[$numero_fuori]);
									$tab_fuori_P .= $linea_comprato_P[$numero_fuori];
									$inserito[$numero_fuori] = "SI";
								} # fine if ($linea_comprato_P[$numero_fuori])
								if ($linea_comprato_D[$numero_fuori]) {
									$linea_comprato_D[$numero_fuori] = preg_replace("#value='fuori'","value='fuori' checked",$linea_comprato_D[$numero_fuori]);
									$tab_fuori_D .= $linea_comprato_D[$numero_fuori];
									$inserito[$numero_fuori] = "SI";
								} # fine if ($linea_comprato_D[$numero_fuori])
								if ($linea_comprato_C[$numero_fuori]) {
									$linea_comprato_C[$numero_fuori] = preg_replace("#value='fuori'","value='fuori' checked",$linea_comprato_C[$numero_fuori]);
									$tab_fuori_C .= $linea_comprato_C[$numero_fuori];
									$inserito[$numero_fuori] = "SI";
								} # fine if ($linea_comprato_C[$numero_fuori])
								if ($linea_comprato_F[$numero_fuori]) {
									$linea_comprato_F[$numero_fuori] = preg_replace("#value='fuori'","value='fuori' checked",$linea_comprato_F[$numero_fuori]);
									$tab_fuori_F .= $linea_comprato_F[$numero_fuori];
									$inserito[$numero_fuori] = "SI";
								} # fine if ($linea_comprato_F[$numero_fuori])
								if ($linea_comprato_A[$numero_fuori]) {
									$linea_comprato_A[$numero_fuori] = preg_replace("#value='fuori'","value='fuori' checked",$linea_comprato_A[$numero_fuori]);
									$tab_fuori_A .= $linea_comprato_A[$numero_fuori];
									$inserito[$numero_fuori] = "SI";
								} # fine if ($linea_comprato_A[$numero_fuori])
							} # fine if ($inserito[$num_fuori] != "SI")
						} # fine for $num2
						$tab_centro .= $tab_fuori_P.$tab_fuori_D.$tab_fuori_C.$tab_fuori_F.$tab_fuori_A;
						########################
						# Layout pagina
						
						$titolo = "<font size=+2><u>";
						if ($osquadra) $titolo .= "$osquadra";
						else $titolo .=  "Squadra";
						$titolo .= " di $outente</u></font>";
						$titolo .= "<br /><br />Presidente: <b>$outente</b>";
						if ($ocitt…) $titolo .= "<br />Citt…: <b>$ocitt…</b>";
						if ($ourl and $ourl != "http://") $titolo .= "<br />Sito Web: <b>$ourl</b>";
						$titolo .= "<br />Email: <b>$oemail</b>";
						$titolo .= "<br />Data iscrizione: $oreg";
						
						echo "<table width='100%'  bgcolor='$sfondo_tab' cellpadding='2' align='center'>
						<caption>$titolo</caption><tr><td valign='top'>
						$tab_centro</table></td></tr></table>";
						unset ($titolo, $tab_centro);
						
						########################
						
						echo "<br/><hr width='95%' />";
						
					} # fine for $num1
				} # fine permessi admin
			} # fine $buste = 2
			
			elseif ($buste == 3) {
				
				$a = @join('', @file("./dati/data_buste_".$itorneo."_0.txt"));
				
				
				echo "<div style='text-align:center; background-color: $sfondo_tab; margin-top:5px; margin-bottom:5px; padding: 5px; border: 1px solid $sfondo_tab2'><a href='a_gestione_tornei.php?itorneo=$itorneo&amp;buste=1'><b>A</b>pri Buste</a> - <a href='./a_gestione_tornei.php?itorneo=$itorneo&amp;buste=2'><b>V</b>edi Buste Aperte</a> - <a href='./a_gestione_tornei.php?itorneo=$itorneo&amp;buste=3'><b>I</b>mposta Data Chiusura Buste</a>  - <a href='./a_gestione_tornei.php?itorneo=$itorneo&amp;buste=4'><b>M</b>anuale Utilizzo Buste</a><br />
				<br />Data chiusura buste<br /><br />
				<form name='buste' method='post' action='a_gestione_tornei.php?itorneo=$itorneo&amp;buste=3'>
				<input name='data_busta_chiusa' type='text' size='15' maxlength='12' value='$a'/> -- Impostare sull'esempio 200908072100, ovvero chiusura valida per le 21:00 del 7 Agosto del 2009
				<br /><br /><input type='submit' name='Submit' value='Conferma data' /></form>
				</div>";
				
				$data_busta_chiusa = $_POST['data_busta_chiusa'];
				if ($data_busta_chiusa != null ) {
					$var=fopen("./dati/data_buste_".$itorneo."_0.txt","w+");
					fwrite($var, "$data_busta_chiusa");
					fclose($var);
				} # fine if ($data_busta_chiusa != null )
			} # fine $buste = 3
			
			elseif ($buste == 4) {
				
				echo "<div style='text-align:center; background-color: $sfondo_tab; margin-top:5px; margin-bottom:5px; padding: 5px; border: 1px solid $sfondo_tab2'><a href='a_gestione_tornei.php?itorneo=$itorneo&amp;buste=1'><b>A</b>pri Buste</a> - <a href='./a_gestione_tornei.php?itorneo=$itorneo&amp;buste=2'><b>V</b>edi Buste Aperte</a> - <a href='./a_gestione_tornei.php?itorneo=$itorneo&amp;buste=3'><b>I</b>mposta Data Chiusura Buste</a>  - <a href='./a_gestione_tornei.php?itorneo=$itorneo&amp;buste=4'><b>M</b>anuale Utilizzo Buste</a><br /><br />
				
				<b>Come preparare le variabili per l'asta a buste chiuse:</b><br /><br />
				
				1) Per prima cosa inserire la variabile di chiusura di buste tramite il form. (data_busta_chiusa)<br /><br />
				
				2) Settare in questo modo le altre variabili del torneo:<br /><br />
				
				- Vendi Costo = SI<br />
				- Percentuale vendita = 100<br /><br />
				<b>Aprire le buste</b><br /><br />
				Quando si decide di aprire le buste bisogna entrare come admin e lanciare il link 'Apri BSuste'.<br />
				Appena cliccato questo link vedrete un messaggio che vi dice che la busta &egrave; stata aperta ma che se volete fare un altro giro di buste chiuse dovete modificare a mano la data di offerta in mercato.txt con quella della variabile data_busta_chiusa<br />
				A questo punto decidete voi se cambiare lo stato del mercato e tutte le altre variabili a vostro piacimento oppure continuare un'altra busta chiusa. Nel caso si deci di farlo dovete solo modificare la variabile data_busta_chiusa in un tempo futuro.
				</div>";
			}
			echo"
			</div></div></div></div></div></div></div>";  //CHIUDONO CARD INIZIALE
		} # fine if ($_SESSION["utente"]
		else header("Location: ./logout.php");
		include("./footer.php");
	?>										