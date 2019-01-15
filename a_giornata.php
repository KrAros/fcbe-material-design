<?php
	##################################################################################
	#    FANTACALCIOBAZAR EVOLUTION
	#    Copyright (C) 2003-2008 by Antonello Onida
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
	
	if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] >= 4) {
		//if ($_SESSION['permessi'] == 4) require ("./menu.php");
		//if ($_SESSION['permessi'] == 5) require ("./a_menu.php");
		
		if (!$num_giornata){
			echo "<center><h3>Nessuna giornata selezionata</h3>";
			header("location: ./a_gestione.php?messgestutente=63");
			exit;
		}
		
		if ($copia_file_voti and $posizione_file) {
			$voti_file = @file($posizione_file);
			
			if (@is_file($percorso_cartella_voti."/voti".$giornata.".txt")) {
				echo "<center><h4>File già esistente, non copiato.</h4></center>";
				$copiare = "NO";
			} # fine if (@is_file("$percorso_cartella_dati/voti$giornata.txt"))
			
			if (!$voti_file) {
				echo "<center><h4>File non trovato.</h4></center>";
				$copiare = "NO";
			} # fine if (!$voti_file)
			
			if ($copiare != "NO") {
				$num_voti = count($voti_file);
				$filevoti = fopen($percorso_cartella_voti."/voti".$giornata.".txt","w+");
				flock($filevoti,LOCK_EX);
				rewind($filevoti);
				
				for ($num1 = 0 ; $num1 < $num_voti ; $num1++) {
					fwrite($filevoti,$voti_file[$num1]);
				} # fine for $num1
				flock($filevoti,LOCK_UN);
				fclose($filevoti);
			} # fine if ($copiare != "NO")
		} # fine if ($copia_file_voti and $posizione_file)
		
		if ($ripristina_originale == "SI"){
			$filego=$percorso_cartella_dati."/giornata".$giornata."_".$n_torneo."_".$n_serie."_iniziale";
			$nuovofilego=$percorso_cartella_dati."/giornata".$giornata."_".$n_torneo."_".$n_serie;
			if (!copy($filego, $nuovofilego)) { echo "Copia di $filego non riuscita ...\n"; }
			$ripristina_originale == "NO";
		}
		
		if ($cancella_giornata == "SI"){
			$filego=$percorso_cartella_dati."/giornata".$giornata."_".$n_torneo."_".$n_serie;
			unlink($percorso_cartella_voti."/voti".$giornata.".txt");
			if (!unlink($filego)) { echo "Cancellazione di $filego non riuscita ...\n"; }
			$ripristina_originale == "NO";
		}
		
		#################################################################################################
		### Carica dati tornei
		
		$tornei = @file("$percorso_cartella_dati/tornei.php");
		$num_tornei = count($tornei);
		
		for ($num = 1 ; $num < $num_tornei; $num++) {
			unset($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $tipo_campionato, $campionato, $voti_esistenti, $dati_mod, $mod, $formazione, $punteggi, $modificatore);
			unset($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg);
			
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
			
			
			$giornata = INTVAL($num_giornata);
			$tgiornata = INTVAL($giornata) - INTVAL($otritardo_torneo);
			
			if (strlen($giornata) == 1) $giornata = "0".$giornata;
			if (strlen($tgiornata) == 1) $tgiornata = "0".$tgiornata;
			
			$tab_formazioni = "<tr>";
			$num_colonne = 0;
			$num2 = 0;
			$leggendo_formazioni = "SI";
			$leggendo_punteggi = "NO";
			$punteggi_esistenti = "NO";
			$file_giornata = @file($percorso_cartella_dati."/giornata".$tgiornata."_".$otid."_".$otserie);
			$num_linee_file_giornata = count($file_giornata);
			
			for($num1 = 0 ; $num1 < $num_linee_file_giornata; $num1++) {
				$linea = togli_acapo($file_giornata[$num1]);
				#echo $linea."<br/>";
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
			} # fine for $num1
			
			$fileu = file($percorso_cartella_dati."/utenti_".$otid.".php");
			$linee = count($fileu);
			
			for($num1 = 1 ; $num1 < $linee; $num1++) {
				@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $fileu[$num1]);
				
				if ($opermessi >= 0 AND $otorneo == $otid AND $oserie == $otserie) {
					
					if ($num_colonne >= 4) {
						$tab_formazioni .= "</tr><tr>";
						$num_colonne = 0;
					} # fine if ($num_colonne >= 3)
					
					$num_colonne++;
					$tab_formazioni .= "<td valign='top'><u>Squadra di <B>$outente</B> $opermessi</u><br/><br/>";
					$formazione = "formazione_$outente";
					$formazione = $$formazione;
					$num_linee_formazione = count($formazione);
					
					for ($num2 = 0 ; $num2 < $num_linee_formazione; $num2++) {
						#$formazione[$num2] = ereg_replace(" ","_",$formazione[$num2]);
						$tab_formazioni .= $formazione[$num2]."<br/>";
					} # fine for $num2
					
					$tab_formazioni .= "</td>";
					
				} # fine if ($otorneo == $otid AND $oserie == $otserie)
			} # fine for $num1
			
			for ($num1 = $num_colonne; $num1 < 2; $num1++) $tab_formazioni .= "<td>&nbsp;</td>";
			$tab_formazioni .= "</tr>";
			
			##################################
			##### Tabella calcoli corretti
			
			echo '<div class="container" style="width: 85%;margin-top: -10px;">
			<div class="card-panel">
			<div class="row">';
			require ("./a_widget.php");
			echo "<div class='col m9'>
			<div class='bread'><a href='./mercato.php'>Gestione</a> / Giornata $num_giornata</div>
			<div class='card'>
			<div class='card-content'>
			<span class='card-title'>Riepilogo giornata $num_giornata</span>";
			
			echo "<table summary='Calcoli' class='indigo lighten-5 centered' style='border-radius: 2px;' width='100%'>
			<thead><tr><th colspan='4'>Torneo: $otdenom (ID: $otid)</th></tr></thead>
			$tab_formazioni</table>";
			if (!is_file($percorso_cartella_dati."/giornata".$tgiornata."_".$otid."_".$otserie)) {
				$voti_esistenti = "NO";
				echo "File giornata non creato (".$percorso_cartella_dati."/giornata".$tgiornata."_".$otid."_".$otserie."), prego verificare le condizioni per confermare lo status attuale!";
			}
			
			if ($voti_esistenti == "SI") {
				echo "<br/><table summary='Calcoli' width='100%' class='indigo lighten-4 centered' style='border-radius: 2px;'>
				<thead><tr><th colspan='4'>Punteggi della $num_giornata giornata</th></tr></thead>
				<tr><td valign='top'>
				<u><b>Voti</b></u><br/>";
				$num_voti = count($voti);
				
				for ($num1 = 0; $num1 < $num_voti; $num1++) {
					$dati_voti = explode("##@@&&", $voti[$num1]);
					settype($dati_voti[0],"string");
					settype($dati_voti[1],"float");
					echo $dati_voti[0].": ".$dati_voti[1]."<br/>";
					$voto[$dati_voti[0]] = $dati_voti[1];
				} # fine for $num1
				echo "</td>";
				
				if ($modificatore_difesa == "SI") {
					echo "<td valign='top'><u><b>Modificatore difesa</b></u><br/>";
					$num_mod = count($modificatore);
					
					for ($num1 = 0 ; $num1 < $num_mod ; $num1++) {
						$dati_mod = explode("##@@&&", $modificatore[$num1]);
						settype($dati_mod[0],"string");
						settype($dati_mod[1],"float");
						echo $dati_mod[0].": ".$dati_mod[1]."<br/>";
						$mod[$dati_mod[0]] = $dati_mod[1];
					} # fine for $num1
					
					echo "</td>";
				} # fine if modificatore difesa
				
				$tipo_campionato = "";
				
				if (substr($num_giornata,0,1) == 0) $num_giornata = substr($num_giornata,1);
				
				$num_campionati = count($campionato);
				reset($campionato);
				
				for($num1 = 0; $num1 < $num_campionati; $num1++) {
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
					
					echo "<td valign='top'><b><u>Punteggi della $num_giornata giornata</u></b><br/>";
					$num_punteggi = count($punteggi);
					for ($num1 = 0 ; $num1 < $num_punteggi ; $num1++) {
						$dati_punteggio = explode("##@@&&", $punteggi[$num1]);
						settype($dati_punteggio[0],"string");
						settype($dati_punteggio[1],"float");
						echo $dati_punteggio[0].": ".$dati_punteggio[1]."<br/>";
						$punti[$dati_punteggio[0]] = $dati_punteggio[1];
					} # fine for $num1
					
					# calcolo la classifica fino a questa giornata
					for ($num1 = $g_inizio_campionato; $num1 < $num_giornata; $num1++) {
						if (strlen($num1) == 1) $num1 = "0".$num1;
						$giornata_punti = "giornata$num1";
						if (@is_file($percorso_cartella_dati."/".$giornata_punti."_".$otid."_".$otserie)) {
							$file_giornata_p = @file($percorso_cartella_dati."/".$giornata_punti."_".$otid."_".$otserie);
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
									settype($dati_punteggio[0],"string");
									settype($dati_punteggio[1],"float");
									$punti[$dati_punteggio[0]] = ($punti[$dati_punteggio[0]] + $dati_punteggio[1]);
								} # fine for $num2
							} # fine if ($punteggi_esistenti_p == "SI")
						} # fine if (@is_file("$percorso_cartella_dati/$giornata_punti"))
					} # fine for $num1
					
					echo "</td><td valign='top'><b><u>Classifica alla giornata $num_giornata_campionato</u></b><br/>";
					for($num1 = 1 ; $num1 < $linee; $num1++) {
						@list($ooutente, $oopass, $oopermessi, $ooemail, $oourl, $oosquadra, $ootorneo, $ooserie, $oocittà, $oocrediti, $oovariazioni, $oocambi, $ooreg) = explode("<del>", $fileu[$num1]);
						if($oopermessi >= 0) echo $ooutente.": ".$punti[$ooutente]."<br/>";
					} # fine for $num1
					
					echo "</td></tr><tr><td colspan='4' align='center' valign='top'>La giornata &egrave; stata chiusa e calcolata correttamente.<br>Di seguito puoi annullarne il calcolo dei punteggi in modo da poter effettuare qualche modifica oppure cancellarla completamente. <br><b>ATTENZIONE: la procedura &egrave; irreversibile.</b></td></tr>";
					
					if (@is_file($percorso_cartella_dati."/giornata".$tgiornata."_".$otorneo."_".$oserie."_iniziale"))
					echo "<tr><td colspan='2' style='width: 50%;'><form method='post' action='a_giornata.php'>
					<input type='hidden' name='num_giornata' value='$num_giornata' />
					<input type='hidden' name='giornata' value='$tgiornata' />
					<input type='hidden' name='n_torneo' value='$otorneo' />
					<input type='hidden' name='n_serie' value='$oserie' />
					<input type='hidden' name='ripristina_originale' value='SI' />
					<button type='submit' class='btn waves-effect waves-light yellow darken-4' name='calcola' value='Ripristina originale $tgiornata'/>Annulla il calcolo dei voti</button>
					</form></td>";
					
					if (@is_file($percorso_cartella_dati."/giornata".$tgiornata."_".$otorneo."_".$oserie))
					echo "<td colspan='2'><form method='post' action='a_giornata.php'>
					<input type='hidden' name='num_giornata' value='$num_giornata' />
					<input type='hidden' name='giornata' value='$tgiornata' />
					<input type='hidden' name='n_torneo' value='$otorneo' />
					<input type='hidden' name='n_serie' value='$oserie' />
					<input type='hidden' name='cancella_giornata' value='SI' />
					<button type='submit' class='btn waves-effect waves-light red' name='cancella' value='Cancella giornata $tgiornata'/>Cancella la giornata</button>
					</form>";
					
					echo "</td></tr></table><br/><br/>";
				} # fine if ($tipo_campionato != "N")
			} # fine if ($voti_esistenti == "SI")
			else {
				#echo "$giornata $otritardo_torneo - $num_giornata";
				
				if (intval($giornata) == intval($num_giornata) AND !@is_file($percorso_cartella_dati."/giornata".$tgiornata."_".$otorneo."_".$oserie))
				echo "<br/><br/><br/><form method='post' action='a_crea_giornata.php'>
				<input type='hidden' name='num_giornata' value='$num_giornata' />
				<input type='hidden' name='giornata' value='$giornata' />
				<input type='hidden' name='n_torneo' value='$otorneo' />
				<input type='hidden' name='n_serie' value='$oserie' />
				<input type='hidden' name='crea_giornata' value='SI' />
				<input type='submit' name='crea' value='Crea giornata $giornata ($num_giornata)' />
				</form>";
				elseif (intval($giornata) == intval($num_giornata) AND @is_file($percorso_cartella_voti."/voti".$giornata.".txt")) {
					echo "<br/><center><form method='post' action='a_calcola_punti_giornata.php'>
					<input type='hidden' name='num_giornata' value='$num_giornata' />
					<input type='hidden' name='giornata' value='$giornata' />
					<button type='submit' class='btn waves-effect waves-light green' name='calcola' value='Calcola i punteggi $num_giornata $giornata'/>Calcola i voti di giornata</button>
					</form></center>";
				} # fine if (@is_file("$percorso_cartella_dati/voti$giornata.txt"))
				
				else {
					if (intval($giornata) == intval($num_giornata) AND ($prima_parte_pos_file_voti or $num_giornata_file_voti == "SI")) {
						$posizione_file = $prima_parte_pos_file_voti;
						
						if ($num_giornata_file_voti == "SI") {
							$num_giornata_a = $giornata;
							
							if ($num_giornata_file_voti_doppio == "SI") {
								if (strlen($num_giornata_a) == 1) $num_giornata_a = "0".$num_giornata_a;
							} # fine if ($num_giornata_file_voti_doppio == "SI")
							
							$posizione_file .= "$num_giornata_a".$seconda_parte_pos_file_voti;
						} # fine if ($num_giornata_file_voti == "SI")
						
						echo "<br><center><form method='POST' action='a_giornata.php'>
						<input type='hidden' name='num_giornata' value='$num_giornata' />
						<input type='hidden' name='giornata' value='$giornata' />
						<button type='submit' class='btn waves-effect waves-light green' name='copia_file_voti' value='Copia i voti $giornata $num_giornata'/>Copia i voti di giornata</button>
						<input type='hidden' name='posizione_file' value='$posizione_file' size='65' />
						</form></center>";
					} # fine if ($prima_parte_pos_file_voti or...
					else echo "<center>Copia il file della giornata $giornata nella cartella <b>$uploaddir</b>.</center><br/>";
				} # fine else if (@is_file("$percorso_cartella_dati/voti$giornata.txt"))
			} # fine else if ($voti_esistenti == "SI"))
			
		} # fine for tornei
		echo '</div></div></div></div></div></div>';
	} # fine elseif ($_SESSION['utente'] == "admin")
	else header("location: logout.php?logout=2");
	include("footer.php");
?>			