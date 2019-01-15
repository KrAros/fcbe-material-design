<?php
	##################################################################################
	#    FANTACALCIOBAZAR EVOLUTION
	#    Copyright (C) 2003-2009 by Antonello Onida
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
	
	ob_start();
	require_once("./controlla_pass.php");
	include("./header.php");
	$debub = 0;
	
	if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] >= 4) {
		//if ($_SESSION['permessi'] == 4) require ("./menu.php");
		//if ($_SESSION['permessi'] == 5) require ("./a_menu.php");
		
		#################################################################################################
		### Carica dati tornei
		
		$tornei = @file($percorso_cartella_dati."/tornei.php");
		$num_tornei = count($tornei);
		
		for($num1 = 1 ; $num1 < $num_tornei; $num1++) {
			if ($debug == 1) echo "$num1 / $num_tornei<br/>";
			
			@list($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza) = explode(",", $tornei[$num1]);
			$mercato_libero = $otmercato_libero;
			$range_campionato = "1-$otgiornate_totali";
			$campionato[$range_campionato] = $ottipo_calcolo;
			#$campionato["7-8"] = "N";
			$stato_mercato = $otstato;
			$max_in_panchina = $otmax_in_panchina;
			$min_num_titolari_in_formazione = $otmin_num_titolari_in_formazione;
			
			#################################################################################################
			
			$file = file($percorso_cartella_dati."/utenti_".$otid.".php");
			$linee = count($file);
			
			$num_giocatori = 0;
			
			$num_giornata = INTVAL($giornata) - INTVAL($otritardo_torneo);
			if (INTVAL($num_giornata) <= 0) $num_giornata = 0;
			if (strlen($giornata) == 1) $giornata = "0".$giornata;
			
			for($num2 = 1 ; $num2 < $linee; $num2++) {
				@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$num2]);
				if ($opermessi != -1 AND $otorneo == $otid AND $oserie == $otserie) $num_giocatori++;
			}
			
			if (@is_file($percorso_cartella_dati."/giornata".$giornata."_".$otid."_".$otserie)) {
				$creare = "NO";
				$errore[] = "La giornata <b>$giornata</b> del torneo <b>$otdenom</b> &egrave; gia stata creata!";
			}
			
			if ($num_giornata < 1) {
				$creare = "NO";
				$inizio_torneo = $otritardo_torneo+1;
				$errore[] = "Il torneo inizia alla giornata $inizio_torneo!";
			}
			
			if ($stato_mercato == "I" OR $stato_mercato == "R" OR $stato_mercato == "B") {
				$creare = "NO";
				$errore[] = "Lo stato mercato del torneo &egrave; ancora in fase iniziale, di riparazione o di buste chiuse!";
			}
			
			$num_campionati = count($campionato);
			reset($campionato);
			
			for($num3 = 0 ; $num3 < $num_campionati; $num3++) {
				$key_campionato = key($campionato);
				$giornate_campionato = explode("-",$key_campionato);
				
				if ($num_giornata <= $giornate_campionato[1] and $num_giornata >= $giornate_campionato[0]) {
					$num_giornata_campionato = $num_giornata - $giornate_campionato[0] + 1;
					$tipo_campionato = $campionato[$key_campionato];
				} # fine if ($num_giornata <= $giornate_campionato[1] and...
				next($campionato);
			} # fine for $num3
			
			if (!$tipo_campionato) $tipo_campionato = "N";
			
			$attiva_scontri_diretti = "NO";
			#echo $num_giornata_campionato;
			if ($tipo_campionato == "S") {
				if ($num_giocatori == 4 or $num_giocatori == 6 or $num_giocatori == 8 or $num_giocatori == 10 or $num_giocatori == 12 or $num_giocatori == 14 or $num_giocatori == 16 or $num_giocatori == 18 or $num_giocatori == 20) {
					$attiva_scontri_diretti = "SI";
				} # fine if ($num_giocatori == 4 or...
				else {
					$errore[] = "Per attivare gli scontri diretti il numero di partecipanti deve essere di 4, 6, 8, 10, 12, 14, 16, 18 o 20.";
					$creare = "NO";
				} # fine else if ($num_giocatori == 4 or...
			} # fine if ($tipo_campionato == "S")
			
			if ($num_giocatori < 1) {
				$creare = "NO";
				$errore[] = "Ancora non ci sono giocatori iscritti!";
			}
			
			echo "<center><h3>Verifica <u>$otdenom</u> $otid/".($num_tornei-1)."</h3>";
			#echo "$otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos<hr/>";
			echo "Giornata: $num_giornata ($giornata)<br/>
			Stato mercato: $otstato<br/>
			Numero giocatori: $num_giocatori<br/>
			Numero giornate: $otgiornate_totali<br/>
			Ritardo inizio: $otritardo_torneo<br/>
			Tipo campionato: $tipo_campionato<br/>
			Attiva SD: $attiva_scontri_diretti</center>";
			
			if ($creare != "NO") {
				
				for($num4 = 1 ; $num4 < $linee; $num4++) {
					@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$num4]);
					
					if ($opermessi != -1 AND $otorneo == $otid AND $oserie == $otserie) {
						$giocatore_numero[$num4] = $outente;
						$dati_squadra = @file($percorso_cartella_dati."/squadra_".$outente);
						$titolari_veri = "";
						$num_titolari_veri = 0;
						$panchinari_veri = "";
						$num_panchinari_veri = 0;
						$titolari = explode(",", $dati_squadra[1]);
						$num_titolari = count($titolari);
						$panchinari = explode(",", $dati_squadra[2]);
						$num_panchinari = count($panchinari);
						
						#############################################################
						$calciatori = file($percorso_cartella_dati."/mercato_".$otid."_".$otserie.".txt");
						$num_calciatori = count($calciatori);
						
						for($num5 = 0 ; $num5 < $num_calciatori ; $num5++) {
							$dati_calciatore = explode(",", $calciatori[$num5]);
							$numero = $dati_calciatore[0];
							$tempo_off = $dati_calciatore[5];
							$anno_off = intval(substr($tempo_off,0,4));
							$mese_off = intval(substr($tempo_off,4,2));
							$giorno_off = substr($tempo_off,6,2);
							$ora_off = substr($tempo_off,8,2);
							$minuto_off = substr($tempo_off,10,2);
							$adesso = mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"));
							$sec_restanti = mktime($ora_off,$minuto_off,0,$mese_off,$giorno_off,$anno_off) - $adesso;
							
							if ($dati_calciatore[4] == $outente and ($sec_restanti <= 0 or $mercato_libero == "SI")) {
								$proprietario[$numero] = $dati_calciatore[4];
								$ruolo[$numero] = $dati_calciatore[2];
								$nome[$numero] = $dati_calciatore[1];
								#$nome[$numero] = htmlentities ($dati_calciatore[1], ENT_QUOTES);
								#echo "$numero ".$dati_calciatore[2]." ".$dati_calciatore[1]."<br>";
							} # fine if
						} # fine for $num5
						unset ($calciatori, $dati_calciatore);
						#############################################################
						
						for($num6 = 0 ; $num6 < $num_titolari; $num6++) {
							$numero_titolare = $titolari[$num6];
							$nome_titolare = $nome[$numero_titolare];
							$ruolo_titolare = $ruolo[$numero_titolare];
							if ($proprietario[$numero_titolare] == $outente) {
								$titolari_veri .= "$numero_titolare,$nome_titolare,$ruolo_titolare\r\n";
								$num_titolari_veri++;
							} # fine if ($proprietario[$numero_titolare] == $outente)
						} # fine for $num6
						
						for($num7 = 0 ; $num7 < $num_panchinari; $num7++) {
							$numero_panchinaro = $panchinari[$num7];
							$nome_panchinaro = $nome[$numero_panchinaro];
							$ruolo_panchinaro = $ruolo[$numero_panchinaro];
							if ($proprietario[$numero_panchinaro] == $outente) {
								$panchinari_veri .= "$numero_panchinaro,$nome_panchinaro,$ruolo_panchinaro\r\n";
								$num_panchinari_veri++;
							} # fine if ($proprietario[$numero_panchinari] == $outente)
						} # fine for $num7
						
						if ($num_titolari_veri < $min_num_titolari_in_formazione) {
							$titolari_veri = "";
							$panchinari_veri = "";
						} # fine if ($num_titolari_veri < $min_num_titolari_in_formazione)
						
						if ($num_panchinari_veri > $max_in_panchina) $panchinari_veri = "";
						$formazioni .= "#@& formazione #@&\r\n".$outente."\r\n".$titolari_veri."\r\n".$panchinari_veri."\r\n";
					} # fine if (permessi = -1)
				} # fine for $num4
				unset ($titolari,$panchinari);
				
				if ($attiva_scontri_diretti == "SI") {
					$file_scontri = file($percorso_cartella_scontri."/squadre".$num_giocatori);
					$num_linee_file_scontri = count($file_scontri);
					$finito_scontri = "NO";
					$conta_cicli_while = 0;
					while ($finito_scontri != "SI") {
						$ultima_giornata = 0;
						$inizio_campionato = "";
						$campionato_in_corso = "";
						$inizio_giornata = "";
						$giornata_in_corso = "";
						$scontri_diretti = "#@& scontri #@&\r\n";
						for($num8 = 0 ; $num8 < $num_linee_file_scontri; $num8++) {
							$linea_file_scontri = togli_acapo(trim($file_scontri[$num8]));
							if ($campionato_in_corso == "SI") {
								if ($linea_file_scontri == "</campionato>") break;
								
								if ($giornata_in_corso == "SI") {
									if ($linea_file_scontri == "</giornata>") break;
									
									$partita = explode("-",$linea_file_scontri);
									#print_r ($partita);
									
									$xsquadra1 = $giocatore_numero[$partita[0]]; # echo $xsquadra1;
									$xsquadra2 = $giocatore_numero[$partita[1]]; # echo " - $xsquadra2<br/><br/>";
									$scontri_diretti .= $xsquadra1."##@@&&".$xsquadra2."\r\n";
									
								} # fine if ($giornata_in_corso == "SI")
								
								if ($inizio_giornata == "SI") {
									$inizio_giornata = "";
									if ($linea_file_scontri > $ultima_giornata) $ultima_giornata = $linea_file_scontri;
									if ($linea_file_scontri == $num_giornata_campionato) $giornata_in_corso = "SI";
								} # fine if ($inizio_giornata)
								
								if ($linea_file_scontri == "<giornata>") $inizio_giornata = "SI";
							} # fine if ($campionato_in_corso == "SI")
							
							if ($inizio_campionato == "SI") {
								$inizio_campionato = "";
								if  ($linea_file_scontri == $num_giocatori) $campionato_in_corso = "SI";
							} # fine if ($inizio_campionato)
							
							if ($linea_file_scontri == "<campionato>") $inizio_campionato = "SI";
						} # fine for $num8
						
						$scontri_diretti .= "#@& fine scontri #@&\r\n";
						if ($giornata_in_corso == "SI" or !$ultima_giornata or $ultima_giornata == 0) $finito_scontri = "SI";
						else {
							$verifica_num = preg_replace("#[0-9]#","",$ultima_giornata);
							if ($verifica_num != "") $finito_scontri = "SI";
							elseif ($num_giornata_campionato%$ultima_giornata == 0) $num_giornata_campionato = $ultima_giornata;
							else $num_giornata_campionato = $num_giornata_campionato - (floor($num_giornata_campionato/$ultima_giornata)*$ultima_giornata);
						} # fine else if ($giornata_in_corso == "SI" or ...)
						$conta_cicli_while++;
						if ($conta_cicli_while >= 50) $finito_scontri = "SI";
					} # fine while ($finito_scontri != "SI")
				} # fine if ($attiva_scontri_diretti == "SI")
				
				$tgiornata = intval($giornata) - $otritardo_torneo;
				if (strlen($tgiornata) == 1) $tgiornata = "0".$tgiornata;
				$filegiornata = fopen($percorso_cartella_dati."/giornata".$tgiornata."_".$otid."_".$otserie,"wb+");
				flock ($filegiornata,LOCK_EX);
				fwrite($filegiornata,"#@& formazioni #@&\r\n$formazioni#@& fine formazioni #@&\r\n\r\n");
				if ($attiva_scontri_diretti == "SI") {
					fwrite($filegiornata,$scontri_diretti);
				} # fine if ($attiva_scontri_diretti == "SI")
				flock ($filegiornata,LOCK_UN);
				fclose($filegiornata);
				
				### Crea file di sicurezza ###
				$filegiornata = fopen($percorso_cartella_dati."/giornata".$tgiornata."_".$otid."_".$otserie."_iniziale","wb+");
				flock ($filegiornata,LOCK_EX);
				fwrite($filegiornata,"#@& formazioni #@&\r\n$formazioni#@& fine formazioni #@&\r\n\r\n");
				if ($attiva_scontri_diretti == "SI") {
					fwrite($filegiornata,$scontri_diretti);
				} # fine if ($attiva_scontri_diretti == "SI")
				flock ($filegiornata,LOCK_UN);
				fclose($filegiornata);
				
				#echo "<pre>$formazioni</pre><br/><pre>$scontri_diretti</pre><br/>";
				unset ($formazioni, $scontri_diretti);
				
				echo "<center>Giornata <b>$giornata $otid $otserie</b> creata!</center><br/>";
			} # fine if ($creare != "NO")
			else {
				$messaggi_errore = implode ("<br />",$errore);
				echo "<div class='evidenziato'><b><u>SEGNALAZIONI</u></b><br/>$messaggi_errore</div>";
				unset ($errore);
			}
			
			##################################################################################
			#    Script per la chiusura automatica della giornata
			#    Riapertura giornata
			##################################################################################
			if ($creare != "NO") {
				$fileu = file($percorso_cartella_dati."/utenti_".$otid.".php");
				$lineeu = count($fileu);
				for($numu = 1 ; $numu < $lineeu; $numu++) {
					@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $fileu[$numu]);
					if (@is_file($percorso_cartella_dati."/scambi_$otorneo_$oserie.txt")) unlink ($percorso_cartella_dati."/scambi_$otorneo_$oserie.txt");
					if ($otrip_cambi_durata == 0) {
						if (@is_file($percorso_cartella_dati."/cambi_".$outente)) unlink ($percorso_cartella_dati."/cambi_".$outente);
						if (@is_file($percorso_cartella_dati."/cce_$otorneo_$oserie.txt")) unlink ($percorso_cartella_dati."/cce_$otorneo_$oserie.txt");
						} # if ($otrip_cambi_durata == 0)
						elseif ($otrip_cambi_durata == 1) {
							$numgiorip = count($otrip_cambi_giornate);
							for ($numu2 = 0 ; $numu2 < $numgiorip ; $numu2++) {
								if (($num_giornata+$otrip_cambi_durata) == $otrip_cambi_giornate[$numu2]) {
									if (@is_file($percorso_cartella_dati."/cambi_".$outente)) unlink ($percorso_cartella_dati."/cambi_".$outente);
									if (@is_file($percorso_cartella_dati."/cambi_tra_".$outente)) unlink ($percorso_cartella_dati."/cambi_tra_".$outente);
									if (@is_file($percorso_cartella_dati."/cce_$otorneo_$oserie.txt")) unlink ($percorso_cartella_dati."/cce_$otorneo_$oserie.txt");
								}
							} # fine for $numu2
						} #fine elseif
					} # fine for $numu1
				}
				###################################################################
				
				unset ($num_giocatori, $num_giornata, $otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $mercato_libero, $campionato, $stato_mercato, $max_in_panchina, $min_num_titolari_in_formazione, $creare);
			} # fine for $tornei
			
			if (@is_file($percorso_cartella_dati."/chiusura_giornata.txt")) unlink ($percorso_cartella_dati."/chiusura_giornata.txt");
			if ($creare!="NO"){
				echo "<center><br/><b>Apertura automatica giornata</b>";
				$data_chigio = @file($percorso_cartella_dati."/data_chigio.txt");
				$ac = substr($data_chigio[0],0,4);
				$mc = substr($data_chigio[0],4,2);
				$gc = substr($data_chigio[0],6,2);
				$orac = substr($data_chigio[0],8,2); if (!$orac) $orac = "14";
				$minc = substr($data_chigio[0],10,2); if (!$minc) $minc = "00";
				
				if (!$ac OR !$mc OR ! $gc OR !$orac OR !$minc) $prossima_settimana  = mktime (0,0,0,date("m"),date("d")+7,date("Y"));
				else $prossima_settimana  = mktime (0,0,0,$mc,$gc+7,$ac);
				
				$prossima_chiusura = date ("Ymd",$prossima_settimana)."$orac$minc";
				
				$file_dati = fopen($percorso_cartella_dati."/data_chigio.txt","wb+");
				flock($file_dati,LOCK_EX);
				fwrite($file_dati, $prossima_chiusura);
				flock($file_dati,LOCK_UN);
				fclose($file_dati);
				
				$data_chigio = @file($percorso_cartella_dati."/data_chigio.txt");
				$ac = substr($data_chigio[0],0,4);
				$mc = substr($data_chigio[0],4,2);
				$gc = substr($data_chigio[0],6,2);
				$orac = substr($data_chigio[0],8,2); if (!$orac) $orac = "14";
				$minc = substr($data_chigio[0],10,2); if (!$minc) $minc = "00";
				
				echo "<br/><font class='evidenziato'>&Eacute; stata impostata una chiusura operazioni per il <b>$gc.$mc.$ac</b> alle <b>$orac:$minc</b>.</font><br /></center>";
				header( "refresh:3;url=./a_giornata.php?num_giornata=$giornata");
				unset($prossima_chiusura,$prossima_settimana);
				
				#######backup######
				echo "<br/>";
				include("./a_b2mail.php");
			}
			$tabella_giornate = "<br/><table summary='Tabella giornate' style='width: 100%; margin: 3px; padding:5px; background-color:transparent'>
			<caption>GIORNATE</caption><tr><td align='center'>";
			
			$tornei = @file($percorso_cartella_dati."/tornei.php");
			$num_tornei = count($tornei);
			@list($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza) = explode(",", $tornei[$num1]);
			
			$num1 = 1;
			while ($num1 <= 38) {
				if (strlen($num1) == 1) $num1 = "0".$num1;
				if ($num1 == 11 OR $num1 == 21 OR $num1 == 31) $tabella_giornate .= "<br/><br/>";
				
				$giornatax = "giornata$num1";
				
				for($num0 = 1; $num0 < $num_tornei; $num0++) {
					if (@is_file($percorso_cartella_dati."/".$giornatax."_".$num0."_0") AND $num1 >= $prossima) {
						$tabella_giornate .= "<a href='a_giornata.php?num_giornata=$num1' class='evidenziato'>&nbsp;$num1&nbsp;</a>&nbsp;&nbsp;&nbsp;";
						if($num1 >= $prossima) $prossima = $num1+1;
					} # fine if (is_file($giornata))
				} # fine for $num0
				$num1++;
			} # fine for $num1
			
			if ($prossima < 1) $prossima = 1;
			if (strlen($prossima) == 1) $prossima = "0".$prossima;
			
			$tabella_giornate .= "<hr noshade />
			<form method='post' action='./a_crea_giornata.php'>
			<input type='hidden' name='giornata' value='$prossima' />
			<input type='submit' name='crea_giornata' value='Crea la giornata $prossima' />
			</form></td></tr></table>";
		} # fine elseif ($_SESSION")
		else header("location: logout.php?logout=2");
		include("./footer.php");
	?>				