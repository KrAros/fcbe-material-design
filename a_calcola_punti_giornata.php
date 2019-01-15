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
include("./header.php");
$DEBUG = "NO";

if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] >= 4) {
	if ($_SESSION['permessi'] == 4) require ("./menu.php");
	if ($_SESSION['permessi'] == 5) require ("./a_menu.php");

	if ($DEBUG == "SI") {
		echo "<h1><center>DEBUG ATTIVATO</center></h1><br />";
	}

	#################################################################################################
	### Carica dati tornei

	$tornei = @file($percorso_cartella_dati."/tornei.php");
	$num_tornei = count($tornei);

	for($num = 1 ; $num < $num_tornei; $num++) {
		unset ($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $continuare, $errore, $errori, $voti, $schema_attuale, $mercato_libero, $campionato, $diff_num_giornata_file, $stato_mercato, $soldi_iniziali, $composizione_squadra, $numero_cambi_max, $rip_cambi_numero, $rip_cambi_giornate, $rip_cambi_durata, $modificatore_difesa, $schemi, $max_in_panchina, $panchina_fissa, $max_entrate_dalla_panchina, $sostituisci_per_ruolo, $sostituisci_per_schema, $sostituisci_fantasisti_come_centrocampisti, $aspetta_giorni, $aspetta_ore, $aspetta_minuti, $num_calciatori_scambiabili, $scambio_con_soldi, $vendi_costo, $percentuale_vendita, $soglia_voti_primo_gol, $incremento_voti_gol_successivi, $voti_bonus_in_casa, $punti_partita_vinta, $punti_partita_pareggiata, $punti_partita_persa, $differenza_punti_a_parita_gol, $differenza_punti_zero_a_zero, $min_num_titolari_in_formazione, $punti_pareggio, $punti_posizione, $formazione,$num_giornata_voti);

		@list($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza) = explode(",", $tornei[$num]);

		$mercato_libero = $otmercato_libero; 					# Gestione giocatori in multiproprietà - SI O NO (NO esegue l'asta)
		$range_campionato = "1-$otgiornate_totali";
		$campionato[$range_campionato] = $ottipo_calcolo;
		#$campionato["7-8"] = "N";
		$diff_num_giornata_file = $otritardo_torneo;      		# differenza tra il n° della giornata del file e quello del torneo di fantacalciobazar
		$stato_mercato = $otstato; 							# Valore importantissimo per il corretto funzionamento.
		$soldi_iniziali = $otcrediti_iniziali;					# Soldi iniziali di ogni giocatore
		$max_calciatori = $otnumcalciatori; 					# Numero massimo di calciatori che si possono possedere
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
		$num_calciatori_scambiabili = $otnum_calciatori_scambiabili; 	# Numero di calciatori inseribili in una offerta di scambio (0 per disabilitare gli scambi) e possibilità di inserire anche soldi nello scambio. Questa variabile si usa solo nella modalità $mercato_libero = "NO"
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
		$differenza_punti_a_parita_gol = $otdifferenza_punti_a_parita_gol; 			#	a parità di gol se una delle due squadre ha uno scarto di punti maggiore o uguale a quello impostato prende un ulteriore gol, impostare a zero per disabilitare
		$differenza_punti_zero_a_zero = $otdifferenza_punti_zero_a_zero; 			#	come sopra ma scatta solo sullo 0-0, impostare a zero per disabilitare

		# Numero minimo di calciatori che devono essere titolari in formazione per ottenere punti (sono compresi anche quelli che non giocano). Non impostare a più di 11.
		$min_num_titolari_in_formazione = $otmin_num_titolari_in_formazione;

		$punti_pareggio = $otpunti_pareggio;			# impostare a "M" per la media, "A" per i punti della posizione più alta o "B" per quelli della più bassa
		$punti_posizione = array();
		$punti_posizione = explode ("-",$otpunti_pos);	# punti assegnati al primo di giornata

		#################################################################################################

		$giornata = intval($num_giornata);
		$tgiornata = intval($giornata) - intval($otritardo_torneo);
		$num_giornata_voti = intval($giornata);
		if (strlen($giornata) == 1) $giornata = "0".$giornata;
		if (strlen($tgiornata) == 1) $tgiornata = "0".$tgiornata;
		if (strlen($num_giornata_voti) == 1) $num_giornata_voti = "0".$num_giornata_voti;

		$voto_tot = array();
		$voto_giornale = array();
		$punti_tot = array();
		$voti_tot = array();
		$num2 = 0;
		$continuare = "";

		echo "<table width='100%' bgcolor='$sfondo_tab'><caption>$otdenom - Calcolo voti giornata $num_giornata (File voti: $num_giornata_voti)</caption><tr><td>";

		if(!is_file($percorso_cartella_dati."/giornata".$tgiornata."_".$otid."_".$otserie)){
			$continuare = "NO";
			$errore[]="Il file giornata relativo non &egrave; presente! ".$percorso_cartella_dati."/giornata".$tgiornata."_".$otid."_".$otserie;
		}

		# vedo il tipo e la giornata di campionato
		$num_campionati = count($campionato);
		reset($campionato);

		for($num1 = 0; $num1 < $num_campionati; $num1++) {
			$key_campionato = key($campionato);
			$giornate_campionato = explode("-",$key_campionato);

			if ($num_giornata <= $giornate_campionato[1] and $num_giornata >= $giornate_campionato[0]) {
				$num_giornata_campionato = $num_giornata - $giornate_campionato[0] + 1;
				$tipo_campionato = $campionato[$key_campionato];
				break;
			} # fine if ($num_giornata <= $giornate_campionato[1] and...

			next($campionato);
		} # fine for $num1

		if (!$tipo_campionato) $tipo_campionato = "N";

		# prendo i voti dal file
		if (@is_file("$percorso_cartella_voti/voti$num_giornata_voti.txt")) $voti = @file("$percorso_cartella_voti/voti$num_giornata_voti.txt");
		else {
			echo "<h1>File voti $percorso_cartella_voti/voti$num_giornata_voti.txt non creato</h1>";
		}
		$num_voti = count($voti);

		$dati_voto = array();

		if ($DEBUG == "SI") {
			print_r ($voti);
			echo $percorso_cartella_voti."/voti".$num_giornata_voti.".txt $num_voti<hr>";
		}

		for($num1 = 0 ; $num1 < $num_voti ; $num1++) {
			$dati_voto = explode($separatore_campi_file_voti, $voti[$num1]);
			$num_calciatore = $dati_voto[($num_colonna_numcalciatore_file_voti-1)];
			$num_calciatore = togli_acapo($num_calciatore);
			$voto_tot[$num_calciatore] = $dati_voto[($num_colonna_vototot_file_voti-1)];
			$voto_tot[$num_calciatore] = togli_acapo($voto_tot[$num_calciatore]);
			$voto_tot[$num_calciatore] = str_replace(",",".",$voto_tot[$num_calciatore]);
			$voto_tot[$num_calciatore] = round($voto_tot[$num_calciatore],1);
			$voto_giornale[$num_calciatore] = $dati_voto[($num_colonna_votogiornale_file_voti-1)];
			$voto_giornale[$num_calciatore] = togli_acapo($voto_giornale[$num_calciatore]);
			$voto_giornale[$num_calciatore] = round($voto_giornale[$num_calciatore],1);
			$presenza[$num_calciatore] = $dati_voto[($ncs_presenza-1)];
			$entrato[$num_calciatore] = $dati_voto[($ncs_entrato-1)];
			$giocasv[$num_calciatore] = $dati_voto[($ncs_sv-1)];
			$giocano25[$num_calciatore] = $dati_voto[($ncs_mininf25-1)];
			$giocasi25[$num_calciatore] = $dati_voto[($ncs_minsup25-1)];
			
			if ($DEBUG == "SI") echo	"$num_giornata_voti $num_calciatore - FV = $voto_tot[$num_calciatore] V = $voto_giornale[$num_calciatore] Presenza = $presenza[$num_calciatore] Entrato = $entrato[$num_calciatore] <br />";

			# giocatore SV con voto giornale = 0 - sei d'ufficio
			if (intval($voto_giornale[$num_calciatore]) == 0 AND INTVAL($giocasv[$num_calciatore]) == 1) $voto_giornale[$num_calciatore] = 6; 

			# partita rinviata - sei d'ufficio
			if (intval($voto_tot[$num_calciatore]) == 6 AND intval($voto_giornale[$num_calciatore]) == 0 AND INTVAL($presenza[$num_calciatore]) == 1 AND INTVAL($entrato[$num_calciatore]) == 0) $voto_giornale[$num_calciatore] = 6;

			# 
			#if (round($voto_tot[$num_calciatore],1) == 0 AND round($voto_giornale[$num_calciatore],1) >= 0 AND INTVAL($presenza[$num_calciatore]) == 1 AND INTVAL($entrato[$num_calciatore]) == 1) $voto_tot[$num_calciatore] = 6;

		} # fine for $num1

		# leggo le informazioni già presenti in $giornata
		$file_giornata = @file($percorso_cartella_dati."/giornata".$tgiornata."_".$otid."_".$otserie);
		$num_linee_file_giornata = count($file_giornata);

		$num_partite = 0;
		$partite = "";

		for($num1 = 0; $num1 < $num_linee_file_giornata; $num1++) {
			$linea = togli_acapo($file_giornata[$num1]);
			# leggo le formazioni

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

			if ($linea == "#@& formazioni #@&") $leggendo_formazioni = "SI";

			# leggo gli scontri (solo per campionati a scontri diretti)

			if ($linea == "#@& fine scontri #@&") $leggendo_scontri = "NO";

			if ($leggendo_scontri == "SI") {
				$partite[$num_partite] = $linea;
				$num_partite++;
			} # fine if ($leggendo_scontri == "SI")

			if ($linea == "#@& scontri #@&") $leggendo_scontri = "SI";

			# non continuo se ci sono già i voti

			if ($linea == "#@& voti #@&"){
				$continuare = "NO";
				$errore[]="Sono già presenti dei voti per questa giornata!";
			}
		} # fine for $num1

		if ($continuare != "NO") {

			$file = file($percorso_cartella_dati."/utenti_".$otid.".php");
			$linee = count($file);

			for($num1 = 1 ; $num1 < $linee; $num1++) {
				@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$num1]);
				if ($opermessi >= 0) {

					$sostituisci_P = 0;
					$sostituisci_D = 0;
					$sostituisci_C = 0;
					$sostituisci_F = 0;
					$sostituisci_A = 0;
					$voti_tot[$outente] = 0;
					$schema_attuale = "00000";
					$num_sostituisci = 0;
					$formazione = "formazione_".$outente;
					#$formazione = $formazione;
					$num_linee_formazione = count($$formazione);

					# punteggio dei titolari

					for ($num2 = 0 ; $num2 < $num_linee_formazione; $num2++) {

						if ($DEBUG == "SI") echo ${$formazione}[$num2]."<br>";

						if (!${$formazione}[$num2]) break;

						if (togli_acapo(${$formazione}[$num2]) == "") break;

						$dati_calciatore = explode(",", ${$formazione}[$num2]);
						$num_calciatore = $dati_calciatore[0];
						$ruolo_calc = $dati_calciatore[2];
						$ruolo_calc = togli_acapo($ruolo_calc);

						if ($voto_tot[$num_calciatore] == 0 AND $voto_giornale[$num_calciatore] == 0) {
							$nome_sostituisci = "sostituisci_$ruolo_calc";
							$$nome_sostituisci++;
							$num_sostituisci++;
						} # fine if ($voto_tot[$num_calciatore] == 0 and...
						else {
							if ($DEBUG == "SI") echo  "T: ".$voti_tot[$outente]." = ".$voti_tot[$outente]." + ". $voto_tot[$num_calciatore]."<br />";
							$nome_calc = str_replace('&#039;','\'',htmlentities ($dati_calciatore[1], ENT_QUOTES));
							${$formazione}[$num2] = ereg_replace("$nome_calc","<b>$nome_calc</b>",${$formazione}[$num2]);
							${$formazione}[$num2] = togli_acapo(${$formazione}[$num2]);
							${$formazione}[$num2] .= ",".$voto_tot[$num_calciatore].",".$voto_giornale[$num_calciatore]."\r\n";
							$voti_tot[$outente] = $voti_tot[$outente] + $voto_tot[$num_calciatore];
							if ($ruolo_calc == "P") $pos_ruolo = 0;
							if ($ruolo_calc == "D") $pos_ruolo = 1;
							if ($ruolo_calc == "C") $pos_ruolo = 2;
							if ($ruolo_calc == "F") $pos_ruolo = 3;
							if ($ruolo_calc == "A") $pos_ruolo = 4;
							$num_ruolo_attuale = substr($schema_attuale,$pos_ruolo,1);
							$num_ruolo_attuale++;
							$schema_attuale = substr_replace($schema_attuale,$num_ruolo_attuale,$pos_ruolo,1);
						} # fine else if ($voto_tot[$num_calciatore] == 0 and...
					} # fine for $num2

					# punteggio dei panchinari
					$entrati_dalla_panchina = 0;
					$calciatore_entrato = "";
					$linea_inizio_panchina = $num2+1;

					# Se si effettuano sostituzioni per ruoli
					if ($sostituisci_per_ruolo == "SI") {

						for($num2 = $linea_inizio_panchina; $num2 < $num_linee_formazione; $num2++) {
							if ($DEBUG == "SI") echo ${$formazione}[$num2]."<br>";
							if (!${$formazione}[$num2]) break;

							if (togli_acapo(${$formazione}[$num2]) == "") break;

							$dati_calciatore = explode(",", ${$formazione}[$num2]);
							$num_calciatore = $dati_calciatore[0];

							if ($voto_tot[$num_calciatore] != 0 OR $voto_giornale[$num_calciatore] != 0) {
								$ruolo_calc = $dati_calciatore[2];
								$ruolo_calc = togli_acapo($ruolo_calc);
								$nome_sostituisci = "sostituisci_$ruolo_calc";
								${$formazione}[$num2] = togli_acapo(${$formazione}[$num2]);
								${$formazione}[$num2] .= ",".$voto_tot[$num_calciatore].",".$voto_giornale[$num_calciatore]."\r\n";
								if ($$nome_sostituisci >= 1 and $entrati_dalla_panchina < $max_entrate_dalla_panchina) {
									if ($DEBUG == "SI") echo "P: ".$voti_tot[$outente]." = ".$voti_tot[$outente]." + ". $voto_tot[$num_calciatore]."<br/>";
									$nome_calc = str_replace('&#039;','\'',htmlentities ($dati_calciatore[1], ENT_QUOTES));
									${$formazione}[$num2] = ereg_replace("$nome_calc","<b>$nome_calc</b>",${$formazione}[$num2]);
									$voti_tot[$outente] = $voti_tot[$outente] + $voto_tot[$num_calciatore];
									$$nome_sostituisci = $$nome_sostituisci - 1;
									$entrati_dalla_panchina++;
									$calciatore_entrato[$num_calciatore] = "SI";

									if ($ruolo_calc == "P") $pos_ruolo = 0;
									if ($ruolo_calc == "D") $pos_ruolo = 1;
									if ($ruolo_calc == "C") $pos_ruolo = 2;
									if ($ruolo_calc == "F") $pos_ruolo = 3;
									if ($ruolo_calc == "A") $pos_ruolo = 4;

									$num_ruolo_attuale = substr($schema_attuale,$pos_ruolo,1);
									$num_ruolo_attuale++;
									$schema_attuale = substr_replace($schema_attuale,$num_ruolo_attuale,$pos_ruolo,1);
								} # fine if ($$nome_sostituisci >= 1 and $entrati_dalla_panchina < $max_entrate_dalla_panchina)
							} # fine if ($voto_tot[$num_calciatore] != 0 or...
						} # fine for $num2

						# Se devo considerare i fantasisti equivalenti a centrocampisti nelle sostituzioni

						if ($sostituisci_fantasisti_come_centrocampisti == "SI") {

							$sostituisci_CF = $sostituisci_C + $sostituisci_F;

							for($num2 = $linea_inizio_panchina ; $num2 < $num_linee_formazione; $num2++) {
								if ($sostituisci_CF < 1 or $entrati_dalla_panchina >= $max_entrate_dalla_panchina) break;
								if (!${$formazione}[$num2]) break;
								if (togli_acapo(${$formazione}[$num2]) == "") break;
								$dati_calciatore = explode(",", ${$formazione}[$num2]);
								$num_calciatore = $dati_calciatore[0];

								if ($calciatore_entrato[$num_calciatore] != "SI") {

									if ($voto_tot[$num_calciatore] != 0 or $voto_giornale[$num_calciatore] != 0) {
										$ruolo_calc = $dati_calciatore[2];
										$ruolo_calc = togli_acapo($ruolo_calc);
										$num_fantasisti_attuali = substr($schema_attuale,3,1);

										if (($ruolo_calc == "F" and $num_fantasisti_attuali < 1) or $ruolo_calc == "C") {
											$nome_calc = $dati_calciatore[1];
											$nome_calc = str_replace('&#039;','\'',htmlentities ($dati_calciatore[1], ENT_QUOTES));
											${$formazione}[$num2] = ereg_replace("$nome_calc","<b>$nome_calc</b>",${$formazione}[$num2]);
											$voti_tot[$outente] = $voti_tot[$outente] + $voto_tot[$num_calciatore];
											$sostituisci_CF = $sostituisci_CF - 1;
											$entrati_dalla_panchina++;
											$calciatore_entrato[$num_calciatore] = "SI";

											if ($ruolo_calc == "C") $pos_ruolo = 2;
											if ($ruolo_calc == "F") $pos_ruolo = 3;

											$num_ruolo_attuale = substr($schema_attuale,$pos_ruolo,1);
											$num_ruolo_attuale++;
											$schema_attuale = substr_replace($schema_attuale,$num_ruolo_attuale,$pos_ruolo,1);
										} # fine if (($ruolo_calc == "F" and $num_fantasisti_attuali < 1) or $ruolo_calc == "C")
									} # fine if ($voto_tot[$num_calciatore] != 0 or $voto_giornale[$num_calciatore] != 0)
								} # fine if ($calciatore_entrato[$num_calciatore] != "SI")
							} # fine for $num2
						} # fine if ($sostituisci_fantasisti_come_centrocampisti == "SI")
					} # fine if ($sostituisci_per_ruolo == "SI")

					# Se si effuttuano sostituzioni compatibili con gli schemi permessi
					if ($sostituisci_per_schema == "SI") {
						for($num2 = $linea_inizio_panchina ; $num2 < $num_linee_formazione; $num2++) {

							if ($entrati_dalla_panchina >= $num_sostituisci or $entrati_dalla_panchina >= $max_entrate_dalla_panchina) break;
							if (!${$formazione}[$num2]) break;
							if (togli_acapo(${$formazione}[$num2]) == "") break;

							$dati_calciatore = explode(",", ${$formazione}[$num2]);
							$num_calciatore = $dati_calciatore[0];

							if ($calciatore_entrato[$num_calciatore] != "SI") {

								if ($voto_tot[$num_calciatore] != 0 or $voto_giornale[$num_calciatore] != 0) {
									$ruolo_calc = $dati_calciatore[2];
									$ruolo_calc = togli_acapo($ruolo_calc);

									if ($sostituisci_per_ruolo != "SI") {
										${$formazione}[$num2] = togli_acapo(${$formazione}[$num2]);
										${$formazione}[$num2] .= ",".$voto_tot[$num_calciatore].",".$voto_giornale[$num_calciatore]."\r\n";
										
										
									} # fine if ($sostituisci_per_ruolo != "SI")

									if ($ruolo_calc == "P") $pos_ruolo = 0;
									if ($ruolo_calc == "D") $pos_ruolo = 1;
									if ($ruolo_calc == "C") $pos_ruolo = 2;
									if ($ruolo_calc == "F") $pos_ruolo = 3;
									if ($ruolo_calc == "A") $pos_ruolo = 4;

									$num_ruolo_attuale = substr($schema_attuale,$pos_ruolo,1);
									$num_ruolo_attuale++;
									$schema_prova = substr_replace($schema_attuale,$num_ruolo_attuale,$pos_ruolo,1);
									$schema_valido = "NO";
									$num_schemi = count($schemi);

									for($num3 = 0 ; $num3 < $num_schemi ; $num3++) {
										$schema = $schemi[$num3];

										if (strlen($schema) == 4) $schema = substr_replace($schema,"0",3,0);

										$trovato = "SI";

										for($num4 = 0 ; $num4 <= 4 ; $num4++) {
											if (substr($schema_prova,$num4,1) > substr($schema,$num4,1)) $trovato ="NO";
										} # fine for $num4

										if ($trovato == "SI") {
											$schema_valido = "SI";
											break;
										} # fine if  ($trovato == "SI")
									} # fine for $num3

									if ($schema_valido == "SI") {
										$nome_calc = str_replace('&#039;','\'',htmlentities ($dati_calciatore[1], ENT_QUOTES));
										${$formazione}[$num2] = ereg_replace("$nome_calc","<b>$nome_calc</b>",${$formazione}[$num2]);
										$voti_tot[$outente] = $voti_tot[$outente] + $voto_tot[$num_calciatore];
										$entrati_dalla_panchina++;
										$num_ruolo_attuale = substr($schema_attuale,$pos_ruolo,1);
										$num_ruolo_attuale++;
										$schema_attuale = substr_replace($schema_attuale,$num_ruolo_attuale,$pos_ruolo,1);
									} # fine if ($schema_valido == "SI")
								} # fine if ($voto_tot[$num_calciatore] != 0 or...
							} # fine if ($calciatore_entrato[$num_calciatore] != "SI")
						} # fine for $num2
					} # fine if ($sostituisci_per_schema == "SI")
					echo "<b>$outente</b>: ".$voti_tot[$outente]." ($schema_attuale)<br/>";
				} # fine if $permessi >=0
			} # fine for $num1
			echo "<hr/>";

			###############
			# modificatore difesa

			if ($modificatore_difesa == "SI") {

				for($num1 = 1 ; $num1 < $linee; $num1++) {
					@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$num1]);
					if ($opermessi >= 0) {
						$num_mod_dif = 0;
						$ver_cal_mod_dif = 0;
						$voti_val_mod_dif = 0;
						$voti_val_portiere = 0;
						$portiere_entra = 0;
						$conta_voti = 0;
						echo "<h4>Verifica calcolo modificatore $outente</h4><br/>";
						$formazione = "formazione_".$outente;
						$formazione = $$formazione;
						$num_linee_formaz = count($formazione);
						$vvmd = array();
						for($num2 = 0 ; $num2 < $num_linee_formaz ; $num2++) {
							$ver_cal_mod_dif = explode(",", $formazione[$num2]);
							$gio_entrato = substr($ver_cal_mod_dif[1],0,3);

							if ($gio_entrato == "<B>" OR $gio_entrato == "<b>") $gio_entr_val = "Entrato";

							if ($ver_cal_mod_dif[2] == "P" AND $gio_entr_val == "Entrato") {
								echo "Portiere: $gio_entr_val - <font color=red>$ver_cal_mod_dif[0] - $ver_cal_mod_dif[1] - $ver_cal_mod_dif[2] - $ver_cal_mod_dif[3] - $ver_cal_mod_dif[4]</font><br/>";
								$voti_val_portiere = $ver_cal_mod_dif[4];
								$portiere_entra = 1;
							}
							elseif ($ver_cal_mod_dif[2] == "D" and $gio_entr_val == "Entrato") {
								$num_mod_dif++;
								echo "Difensore: $gio_entr_val - <font color=red>$ver_cal_mod_dif[0] - $ver_cal_mod_dif[1] - $ver_cal_mod_dif[2] - $ver_cal_mod_dif[3] - $ver_cal_mod_dif[4]</font><br/>";
								$vvmd[$conta_voti] = $ver_cal_mod_dif[4];
								$conta_voti++;
							}
							#else echo "Altri calciatori: <font color=green>$ver_cal_mod_dif[0] - $ver_cal_mod_dif[1] - $ver_cal_mod_dif[2] - $ver_cal_mod_dif[3]</font><br/>";

							$gio_entr_val = "";
						} # fine for $num2

						if ($voti_val_portiere != 0 AND $portiere_entra == 1) {
							if ($num_mod_dif >= 4) {
								$media_migliori = 0;
								$array_voti = array($vvmd[0],$vvmd[1],$vvmd[2],$vvmd[3],$vvmd[4]);

								sort ($array_voti,SORT_NUMERIC); reset ($array_voti);

								$somma_voti_md = $array_voti[4] + $array_voti[3] + $array_voti[2] + $voti_val_portiere;

								$media_voti = $somma_voti_md/4;

								if ($media_voti >=7) $modificatore[$outente] = 6;
								elseif ($media_voti >= 6.5 and $media_voti < 7) $modificatore[$outente] = 3;
								elseif ($media_voti >= 6 and $media_voti < 6.5) $modificatore[$outente] = 1;
								else $modificatore[$outente] = 0;

								echo "Numero difensori validi: <b>$num_mod_dif </b> - Totale voti $outente: $voti_tot[$outente] - Somma voti difensori: $somma_voti_md - Media voti: $media_voti - Modificatore difesa: $modificatore[$outente] ";
								$voti_tot[$outente] = $voti_tot[$outente] + $modificatore[$outente];
								echo "- <b>Somma voti totale: $voti_tot[$outente]</b><br/><br/>";
							} # fine if mod == 4
						} # if portiere != 0
					} # if $opermessi
				} # fine for $num1
				echo "<hr/>";
			} # fine modificatore difesa

			###############
			# riscrivo le formazioni con i voti e i punteggi alla fine
			/*
			$filegiornata = fopen($percorso_cartella_dati."/giornata".$tgiornata."_".$otid."_".$otserie,"wb+");
			flock($filegiornata,LOCK_EX);
			rewind($filegiornata);
			*/
			$nuovo_filegiornata = "";
			$num_giocatori = 0;
			for($num1 = 1 ; $num1 < $linee; $num1++) {
				@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$num1]);
				if ($opermessi >= 0){
					$num_giocatori++;

					$nuovo_filegiornata .= "#@& formazione #@&\r\n".$outente."\r\n";
					$formazione = "formazione_$outente";
					$formazione = $$formazione;
					$num_linee_formazione = count($formazione);
					for($num2 = 0 ; $num2 < $num_linee_formazione ; $num2++) {
						$nuovo_filegiornata .= $formazione[$num2];
					} # fine for $num2
				} # fine
			} # fine for $num1

			$nuovo_filegiornata .= "#@& fine formazioni #@&\r\n\r\n";
			$nuovo_filegiornata .= "#@& voti #@&\r\n";

			for($num1 = 1 ; $num1 < $linee; $num1++) {
				@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$num1]);
				if ($opermessi >= 0) $nuovo_filegiornata .= $outente."##@@&&".$voti_tot[$outente]."\r\n";
			} # fine for $num1
			$nuovo_filegiornata .= "#@& fine voti #@&\r\n\r\n";

			if ($modificatore_difesa == "SI") {
				$nuovo_filegiornata .= "#@& modificatore #@&\r\n";

				for($num1 = 1 ; $num1 < $linee; $num1++) {
					@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$num1]);
					if ($opermessi >= 0) $nuovo_filegiornata .= $outente."##@@&&".$modificatore[$outente]."\r\n";
				} # fine for $num1
				$nuovo_filegiornata .= "#@& fine modificatore #@&\r\n\r\n";
			} # fine scrittura modificatore

			if ($tipo_campionato == "V") {
				$nuovo_filegiornata .= "#@& punteggi #@&\r\n";
				for($num1 = 1 ; $num1 < $linee; $num1++) {
					@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$num1]);
					if ($opermessi >= 0)$nuovo_filegiornata .= $outente."##@@&&".$voti_tot[$outente]."\r\n";
				} # fine for $num1
				$nuovo_filegiornata .= "#@& fine punteggi #@&\r\n\r\n";
			} # fine if ($tipo_campionato == "V")

			if ($tipo_campionato == "P") {
				arsort ($voti_tot);
				reset ($voti_tot);
				$posizione = "";
				$num1 = 1;
				while (list ($key, $val) = each ($voti_tot)) {
					$posizione[$num1] = $key;
					$voti_posizione[$num1] = $val;
					echo $voti_posizione[$num1]." = $val<br>";
					$num1++;
				} # fine while (list ($key, $val) = each ($voti_tot))

				for($num1 = 1 ; $num1 <= $num_giocatori; $num1++) {
					$pos_alta = $num1;
					$pos_bassa = $num1;
					$num_posizioni_pari = 1;
					$fatto = "NO";
					while ($fatto != "SI") {
						if ($voti_posizione[$pos_bassa+1] == $voti_posizione[$pos_bassa] and $pos_bassa < $num_giocatori) {
							$pos_bassa++;
							$num_posizioni_pari++;
						} # fine if ($voti_posizione[$pos_bassa+1] == $voti_posizione[$pos_bassa] and ...
						else $fatto = "SI";
					} # fine while ($fatto != "SI")

					if ($punti_pareggio == "A") {
						$verifica_num = ereg_replace("[0-9]","",$punti_posizione[$pos_alta-1]);
						if ($verifica_num != "" or $punti_posizione[$pos_alta-1] == "") $punti_assegnati = 0;
						else {
							$num2 = $pos_alta;
							$diff = 1;
							$punti_set = 0;
							for($num2; $num2 <= $num_giocatori; $num2++) {
								if ($voti_posizione[$pos_alta - $diff] == $voti_posizione[$pos_alta]){
									$punti_assegnati = $punti_posizione[$pos_alta - $diff];
									$punti_set = 1;
								}
								else {
									if ($punti_set==0) $punti_assegnati = $punti_posizione[$pos_alta];
								}
								$diff++;
							}
						}
					} # fine if ($punti_pareggio == "A")

					elseif ($punti_pareggio == "B") {
						$verifica_num = ereg_replace("[0-9]","",$punti_posizione[$pos_bassa-1]);
						if ($verifica_num != "" or $punti_posizione[$pos_bassa-1] == "") $punti_assegnati = 0;
						else $punti_assegnati = $punti_posizione[$pos_bassa-1];
					} # fine if ($punti_pareggio == "B")

					else {
						# $punti_pareggio == "M"
						$punti_assegnati = 0;
						for($num2 = $pos_alta-1 ; $num2 <= $pos_bassa-1; $num2++) {
							$verifica_num = ereg_replace("[0-9]","",$punti_posizione[$num2]);
							if ($verifica_num != "" or $punti_posizione[$num2] == "") $punti_somma = 0;
							else $punti_somma = $punti_posizione[$num2];
							$punti_assegnati = $punti_assegnati + $punti_somma;
						} # fine for $num2
						$punti_assegnati = round(($punti_assegnati/$num_posizioni_pari), 1);
					} # fine else ($punti_pareggio == "A")

					for($num2 = $pos_alta ; $num2 <= $pos_bassa; $num2++) {
						$punti_tot[$posizione[$num2]] = $punti_assegnati;
					} # fine for $num2
					$num2 = $num2 + $num_posizioni_pari - 1;
				} # fine for $num1

				$nuovo_filegiornata .= "#@& punteggi #@&\r\n";
				for($num1 = 1 ; $num1 < $linee; $num1++) {
					@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$num1]);
					if ($opermessi >= 0) $nuovo_filegiornata .= $outente."##@@&&".$punti_tot[$outente]."\r\n";
				} # fine for $num1
				$nuovo_filegiornata .= "#@& fine punteggi #@&\r\n";
			} # fine if ($tipo_campionato == "P")

			if ($tipo_campionato == "S") {
				$scontri_diretti = "#@& scontri #@&\r\n";
				for($num1 = 0 ; $num1 < $num_partite; $num1++) {
					$partita = $partite[$num1];
					$partita = explode("##@@&&",$partita);
					$gol1 = floor(($voti_tot[$partita[0]] - $soglia_voti_primo_gol + $voti_bonus_in_casa) / $incremento_voti_gol_successivi) + 1;

					if ($gol1 < 0) $gol1 = 0;

					$gol2 = floor(($voti_tot[$partita[1]] - $soglia_voti_primo_gol) / $incremento_voti_gol_successivi) + 1;

					if ($gol2 < 0) $gol2 = 0;

					if ($gol1 == $gol2 && $gol1 > 0 && $differenza_punti_a_parita_gol > 0){
						if($voti_tot[$partita[0]] >= $voti_tot[$partita[1]]+$differenza_punti_a_parita_gol) $gol1 = $gol1+1;
						else if($voti_tot[$partita[1]] >= $voti_tot[$partita[0]]+$differenza_punti_a_parita_gol) $gol2 = $gol2+1;
					}

					if ($gol1 == 0 && $gol2 == 0 && $differenza_punti_zero_a_zero > 0){
						if($voti_tot[$partita[0]] >= $voti_tot[$partita[1]]+$differenza_punti_zero_a_zero) $gol1 = $gol1+1;
						else if($voti_tot[$partita[1]] >= $voti_tot[$partita[0]]+$differenza_punti_zero_a_zero) $gol2 = $gol2+1;
					}

					$scontri_diretti .= $partita[0]."##@@&&".$partita[1]."##@@&&".$gol1."##@@&&".$gol2.$acapo;

					if ($gol1 > $gol2) {
						$punti_tot[$partita[0]] = $punti_partita_vinta;
						$punti_tot[$partita[1]] = $punti_partita_persa;
					} # fine if ($gol1 > $gol2)
					if ($gol1 == $gol2) {
						$punti_tot[$partita[0]] = $punti_partita_pareggiata;
						$punti_tot[$partita[1]] = $punti_partita_pareggiata;
					} # fine if ($gol1 == $gol2)
					if ($gol1 < $gol2) {
						$punti_tot[$partita[0]] = $punti_partita_persa;
						$punti_tot[$partita[1]] = $punti_partita_vinta;
					} # fine if ($gol1 < $gol2)
				} # fine for $num1
				$scontri_diretti .= "#@& fine scontri #@&\r\n\r\n";
				$nuovo_filegiornata .= $scontri_diretti;
				$nuovo_filegiornata .= "#@& punteggi #@&\r\n";
				for($num1 = 1 ; $num1 < $linee; $num1++) {
					@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$num1]);
					if ($opermessi >= 0) $nuovo_filegiornata .= $outente."##@@&&".$punti_tot[$outente]."\r\n";
				} # fine for $num1
				$nuovo_filegiornata .= "#@& fine punteggi #@&\r\n\r\n";
			} # fine if ($tipo_campionato == "S")

			if ($DEBUG == "SI") {
				echo "<pre>$nuovo_filegiornata</pre>";
			}
			else {
				$filegiornata = fopen($percorso_cartella_dati."/giornata".$tgiornata."_".$otid."_".$otserie,"wb+");
				flock($filegiornata,LOCK_EX);
				rewind($filegiornata);
				fwrite($filegiornata,$nuovo_filegiornata);
				flock($filegiornata,LOCK_UN);
				fclose($filegiornata);
				unset($filegiornata,$nuovo_filegiornata);
			}
			echo"</td></tr></table><br /><br />";
		} # fine if ($continuare != "NO")
		else {
			$errori = implode ("<br/>",$errore);
			echo "<b><font class='evidenziato'>$errori</font></b></td></tr></table><br /><br />";
		}
	} # fine for tornei
	echo "<br/><br/><form method='post' action='a_giornata.php'>
	<input type='hidden' name='num_giornata' value='$num_giornata' />
	<input type='hidden' name='giornata' value='$tgiornata' />
	<input type='submit' name='torna' value='Torna indietro' />
	</form><br/><br/>";
} # fine if ($pass_admin_errata == "NO")
else header("location: logout.php?logout=2");

include("./footer.php");
?>