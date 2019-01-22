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
	error_reporting(E_ALL);
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	if (stristr($_SERVER['SCRIPT_NAME'], "controlla_pass.php")) {
		header("Location: ./index.php");
		exit;
	}
	$scadenza_sessioni = 60*60*2;  		# secondi x minuti x ore
	session_set_cookie_params($scadenza_sessioni);
	session_start();
	#header ("cache-control: private");
	require_once("./dati/dati_gen.php");
	require_once("./inc/funzioni.php");
	require_once("./inc/funzioni_utente.php");
	$versione = "Versione 1.5";
	setlocale (LC_TIME, "it_IT");
	set_time_limit(90);
	//set_magic_quotes_runtime(0);
	$timeZone="Europe/Rome";
	putenv("TZ=".$timeZone);
	
	if (!get_magic_quotes_gpc()) { 
		$_GET    = array_map('addslashes', $_GET); 
		$_POST   = array_map('addslashes', $_POST); 
		$_COOKIE = array_map('addslashes', $_COOKIE); 
	}
	
	# nel caso fosse settato register_globals = Off
	reset($_POST);
	$conta=count($_POST);
	for($num1 = 0 ; $num1 < $conta; $num1++) {
		$var_POST = key($_POST);
		$$var_POST = $_POST[$var_POST];
		next($_POST);
	} # fine for $num1
	
	reset($_GET);
	$conta=count($_GET);
	for($num1 = 0 ; $num1 < $conta; $num1++) {
		$var_GET = key($_GET);
		$$var_GET = $_GET[$var_GET];
		next($_GET);
	} # fine for $num1
	
	if (strtoupper(substr(PHP_OS,0,3) == 'WIN')) {
		$acapo = "\r\n";
		} elseif (strtoupper(substr(PHP_OS,0,3) == 'MAC')) {
		$acapo = "\r";
		} else {
		$acapo = "\n";
	}
	
	###############################################
	# Controllo di accesso
	###############################################
	
	if ($_SESSION['valido'] != "SI" and $_SESSION['ec'] != "SI") {
		echo"<meta http-equiv='refresh' content='0; url=logout.php?logout=2'>";
		exit;
	}
	elseif ($_SESSION['valido'] == "SI" AND $_SESSION['csn'] == $_SERVER['SERVER_NAME']) {
		
		if($_SESSION['utente'] == $admin_user AND $_SESSION['pass'] == $admin_passW) {}
		elseif($_SESSION["admin"] == "SI"){
			if($_SESSION['utente'] != $admin_user OR $_SESSION['pass'] != $admin_pass) {
				echo"Hai modificato i dati di accesso di amministazione; per motivi di sicurezza verr&agrave; effettuato il logout.
				<meta http-equiv='refresh' content='3; url=logout.php?logout=3'>";
				exit;
			}
		}
		else {
			if ($manutenzione == "SI") {
				include("header.php");
				echo "<div style='text-align:center; padding:80px'><img border='1' src='./immagini/manutenzione.gif' alt='Sito in manutenzione' /><h1>In questo momento non &egrave; possibile accedere al gioco</h1>
				Ciao ".$_SESSION['utente'].", in questo momento non &egrave; possibile giocare a FantacalcioBazar, stiamo eseguendo una manutenzione e, per facilitare il lavoro ai tecnici, non diamo la possibilit&agrave; agli utenti di accedere al gioco e giocare.<br/><br/>
			Non &egrave; necessario segnalare al Team che il Server &egrave; chiuso, questo perch&eacute; la modalit&agrave; &egrave; attivata proprio dal Team stesso.<br/><br/>
			Ti chiediamo di avere un po di pazienza e di aspettare qualche minuto. Se la manutenzione dovesse durare pi&ugrave; ore (cosa molto rara), il Team segnaler&agrave; la manutenzione e fornir&agrave; tutte le informazioni in possesso.<br/><br/>
			FantacalcioBazar Team</div>";
			include("footer.php");
			exit;
			}
			$fileo = @file($percorso_cartella_dati."/utenti_".$_SESSION["torneo"].".php") or die("Impossibile caricare i dattagli degli utenti [RIF: ./dati/utenti.php](".$_SESSION["torneo"].")");
			@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $fileo[$_SESSION['uid']]);
			
			if ($_SESSION['utente'] != $outente OR $_SESSION['pass'] != $opass OR $_SESSION['torneo'] != $otorneo) {
			echo"<meta http-equiv='refresh' content='0; url=logout.php?logout=3'>";
			exit;
			}
			}
			}
			elseif ($_SESSION['ec'] != "SI") {
			pr($_SESSION);
			pr($_SERVER);
			die ("Esecuzione controlli accesso. Non possiedi i permessi adeguati! ".$_SESSION['csn']. " - ". $_SERVER[SERVER_NAME]);
			
			}
			######################################################################
			# Caricamento dati torneo
			
			if ($_SESSION['utente'] != $admin_user AND $_SESSION['valido'] == "SI") {
			
			$tornei = file($percorso_cartella_dati."/tornei.php");
			$linee_tornei = count($tornei);
			for ($num1 = 1 ; $num1 < $linee_tornei; $num1++) {
			@list($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $otmessaggi, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos) = explode(",", $tornei[$num1]);
			
			#echo "$otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $otmessaggi, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, XXX $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos<br/>"; 
			
			if ($_SESSION["torneo"] == $otid) break; 
			} # fine for $num$tornei = @file("$percorso_cartella_dati/tornei.php");
			$mercato_libero = $otmercato_libero; 					# Gestione giocatori in multipropriet… - SI O NO (NO esegue l'asta)
			$range_campionato = "1-$otgiornate_totali";
			$campionato[$range_campionato] = $ottipo_calcolo;
			#$campionato["7-8"] = "N";
			$diff_num_giornata_file = $otritardo_torneo;      		# differenza tra il n° della giornata del file e quello del torneo di fantacalciobazar
			$stato_mercato = $otstato; 							# Valore importantissimo per il corretto funzionamento.
			$soldi_iniziali = $otcrediti_iniziali;					# Soldi iniziali di ogni giocatore
			$max_calciatori = $otnumcalciatori; 					# Numero massimo di calciatori che si possono possedere
			$composizione_squadra = explode("-",$otcomposizione_squadra); # $composizione_squadra = array("38806","38725","38815","38716");
			$numero_cambi_max = $otnumero_cambi_max; 				# in mercato libero Š il massimo dei cambi consentiti
			$rip_cambi_numero = $otrip_cambi_numero; 				# cambi consentiti nel mercato di riparazione - Impostare a 0 per disabilitare il mercato di riparazione
			$rip_cambi_giornate = explode("-",$otrip_cambi_giornate); 	# giornate dopo le quali si effettua il mercato di riparazione
			$rip_cambi_durata = $otrip_cambi_durata; 				# durata del mercato di riparazione - Impostare a 1 per applicare il regolamento gazzetta 2005-2006 - 0 per applicare il reolamento 2004-2005
			$modificatore_difesa = $otmodificatore_difesa; 			# impostazione per il calcolo del punteggio con modificatore solo per campionato libero
			$schemi = explode("-",$otschemi); 						# Gli schemi di gioco utilizzabili. Gli schemi a 5 numeri servono solo se si usano i fantasisti. Si possono aggiungere o togliere schemi.
			$max_in_panchina = $otmax_in_panchina;					# Numero di calciatori in panchina e quanti ne possono entrare. Si possono fare sostituzioni per ruolo (il calciatore entra se un'altro del suo ruolo non ha giocato) o per schema (il calciatore entra se entrando lo schema che si forma Š tra quelli consentiti). Se sia per ruolo che per schema sono a SI si sostituisce prima per ruolo.
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
			$percentuale_vendita = $otpercentuale_vendita; 			# Percentuale del costo pagato a cui si pu• rivendere subito il calciatore
			
			# Dati per i campionati a scontri diretti. Servono solo se si Š impostato un campionato a "S".
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
			
			$punti_pareggio = $otpunti_pareggio;		# impostare a "M" per la media, "A" per i punti della posizione più alta o "B" per quelli della più bassa
			$punti_posizione[0] = "";
			$punti_posizione = explode ("-",$otpunti_pos);	# punti assegnati al primo di giornata
			
			###################################
			###                             ###
			### Controllo chiusura giornata ###
			###                             ###
			###################################
			
			$oggi = array();
			$oggi = getdate();
			
			$giorno = $oggi['mday'];
			if ($giorno < 10) {
			$giorno = "0$giorno";
			}
			$mese = $oggi['mon'];
			if ($mese < 10) {
			$mese = "0$mese";
			}
			$anno = $oggi['year'];
			$ora = $oggi['hours'];
			if ($ora < 10) {
			$ora = "0$ora";
			}
			$min = $oggi['minutes'];
			if ($min < 10) {
			$min = "0$min";
			}
			
			$data_attuale = "$anno$mese$giorno$ora$min";
			if (is_file($percorso_cartella_dati."/chiusura_giornata.txt")) $chiusura_giornata = INTVAL (@file($percorso_cartella_dati."/chiusura_giornata.txt"));
			
			if (is_file($percorso_cartella_dati."/data_chigio.txt")) $data_chigio = @file($percorso_cartella_dati."/data_chigio.txt");
			else $data_chigio[0] = $data_attuale;
			
			$ac = substr($data_chigio[0],0,4);
			$mc = substr($data_chigio[0],4,2);
			$gc = substr($data_chigio[0],6,2);
			$orac = substr($data_chigio[0],8,2);
			$minc = substr($data_chigio[0],10,2);
			
			$verdatachiusura = "$ac$mc$gc$orac$minc";
			$giorno_chiusura = date('w', strtotime("$mc/$gc/$ac"));
			if ($giorno_chiusura == 6)  $def_giorno = "Sabato";
			elseif ($giorno_chiusura == 5)  $def_giorno = "Venerd&igrave;";
			elseif ($giorno_chiusura == 4)  $def_giorno = "Gioved&igrave;";
			elseif ($giorno_chiusura == 3)  $def_giorno = "Mercoled&igrave;";
			elseif ($giorno_chiusura == 2)  $def_giorno = "Marted&igrave;";
			elseif ($giorno_chiusura == 1)  $def_giorno = "luned&igrave;";
			elseif ($giorno_chiusura == 0)  $def_giorno = "domenica";
			
			if ($data_attuale > $verdatachiusura) $mextex = "<font color='red'>Data attuale maggiore alla data di chiusura</font><br/>";
			elseif ($data_attuale < $verdatachiusura) $mextex = "Data attuale minore alla data di chiusura";
			elseif ($data_attuale = $verdatachiusura) $mextex = "Data attuale uguale alla data di chiusura";
			
			if ($chiusura_giornata == 0) $mess02 = "E' possibile modificare la formazione o cambiare i calciatori al prossimo <b>$def_giorno</b> entro le ore <b>$orac</b> e <b>$minc</b> minuti.";
			else $mess02 = "<b><font color=red>Giornata chiusa!</font></b><br/>Non &egrave; possibile modificare la formazione o effettuare azioni di mercato. Attendere l'aggiornamento delle quotazioni.<br/>";
			
			if ($data_attuale >= $verdatachiusura and $chiusura_giornata != 1) {
			$mess02 .= "<br/><b><font class='evidenziato'>Chiusura automatica giornata</font></b>";
			$file_dati = fopen($percorso_cartella_dati."/chiusura_giornata.txt","wb");
			flock($file_dati,LOCK_EX);
			fwrite($file_dati, "1");
			flock($file_dati,LOCK_UN);
			fclose($file_dati);
			}
			}
			?>			