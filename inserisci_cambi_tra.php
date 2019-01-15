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
#	ver 1.10
##################################################################################
require_once ("./controlla_pass.php");
include("./header.php");

if ($_SESSION['valido'] == "SI") {
	require ("./menu.php");
#$cambi_tra="SI";
	echo "<table bgcolor='$sfondo_tab' width='90%' align='center' class='border'>
	<caption>Inserimento cambi</caption><tr><td align='center'>";

	################################
	# Controlli cambi

	$inserire = "SI";		# NO per il debug

	$controlo_scrivi_file = "";
	$val_cess = 0; $conta_cp = 0; $conta_cd = 0; $conta_cc = 0; $conta_cf = 0; $conta_ca = 0;
	$val_acq = 0; $conta_ap = 0; $conta_ad = 0; $conta_ac = 0; $conta_af = 0; $conta_aa = 0;
	$costo_iniziale = 0;
	$costo_attuale = 0;

	$linee_cambi = @file($percorso_cartella_dati."/cambi_tra_".$_SESSION['utente']);
	$righe_cambi = count($linee_cambi);

	for ($num = 0 ; $num < $righe_cambi ; $num++) {

		$dati_cambi = explode(",", $linee_cambi[$num]);
		$cambi_numero = $dati_cambi[0];
		$cambi_numero = togli_acapo($cambi_numero);
		$cambi_nome = $dati_cambi[1];
		$cambi_nome = togli_acapo($cambi_nome);
		$cambi_ruolo = $dati_cambi[2];
		$cambi_ruolo = togli_acapo($cambi_ruolo);
		$cambi_costo = $dati_cambi[3];
		$cambi_costo = togli_acapo($cambi_costo);
		$cambi_valore = $dati_cambi[4];
		$cambi_valore = togli_acapo($cambi_valore);
		$cambi_status = $dati_cambi[5];
		$cambi_status = togli_acapo($cambi_status);

		if ($cambi_status == "0" and $cambi_ruolo == "P") {
			$conta_cp ++;
			$val_cess = $val_cess + $cambi_valore;
			$costo_iniziale = $costo_iniziale + $cambi_costo;
			$costo_attuale = $costo_attuale + $cambi_valore;
		} # fine if P

		if ($cambi_status == "0" and $cambi_ruolo == "D") {
			$conta_cd ++;
			$val_cess = $val_cess + $cambi_valore;
			$costo_iniziale = $costo_iniziale + $cambi_costo;
			$costo_attuale = $costo_attuale + $cambi_valore;
		} # fine if d

		if ($cambi_status == "0" and $cambi_ruolo == "C") {
			$conta_cc ++;
			$val_cess = $val_cess + $cambi_valore;
			$costo_iniziale = $costo_iniziale + $cambi_costo;
			$costo_attuale = $costo_attuale + $cambi_valore;
		} # fine if c

		if ($cambi_status == "0" and $cambi_ruolo == "F") {
			$conta_cf ++;
			$val_cess = $val_cess + $cambi_valore;
			$costo_iniziale = $costo_iniziale + $cambi_costo;
			$costo_attuale = $costo_attuale + $cambi_valore;
		} # fine if f

		if ($cambi_status == "0" and $cambi_ruolo == "A") {
			$conta_ca ++;
			$val_cess = $val_cess + $cambi_valore;
			$costo_iniziale = $costo_iniziale + $cambi_costo;
			$costo_attuale = $costo_attuale + $cambi_valore;
		} # fine if A

		if ($cambi_status == "1" and $cambi_ruolo == "P") {
			$conta_ap ++;
			$val_acq = $val_acq + $cambi_valore;
		} # fine if P

		if ($cambi_status == "1" and $cambi_ruolo == "D") {
			$conta_ad ++;
			$val_acq = $val_acq + $cambi_valore;
		} # fine if d

		if ($cambi_status == "1" and $cambi_ruolo == "C") {
			$conta_ac ++;
			$val_acq = $val_acq + $cambi_valore;
		} # fine if c

		if ($cambi_status == "1" and $cambi_ruolo == "F") {
			$conta_af ++;
			$val_acq = $val_acq + $cambi_valore;
		} # fine if f

		if ($cambi_status == "1" and $cambi_ruolo == "A") {
			$conta_aa ++;
			$val_acq = $val_acq + $cambi_valore;
		} # fine if A

	} # fine for

	### Verifica simmetria cambi

	if ($conta_cp != $conta_ap) {
		$inserire = "NO";
		$err1 = "Numero di portieri acquistato diverso da numero di portieri ceduto!";
	} # fine

	if ($conta_cd != $conta_ad) {
		$inserire = "NO";
		$err2 = "Numero di difensori acquistato diverso da numero di difensori ceduto!";
	} # fine

	if ($considera_fantasisti_come == "C") {
		if ($conta_cc + $conta_cf != $conta_ac + $conta_af) {
			$inserire = "NO";
			$err3 = "Numero di centrocampisti acquistato diverso da numero di centrocampisti ceduto!";
		}
	} # fine

	elseif ($considera_fantasisti_come == "A") {
		if ($conta_ca + $conta_cf != $conta_aa + $conta_af) {
			$inserire = "NO";
			$err5 = "Numero di attaccanti acquistato diverso da numero di attaccanti ceduto!";
		}
	} # fine

	elseif ($considera_fantasisti_come == "F") {
		$conta_acfa = $conta_af + $conta_ac + $conta_aa;
		$conta_ccfa = $conta_cf + $conta_cc + $conta_ca;

		if ($conta_acfa != $conta_ccfa or $conta_cf > 2 or $conta_af > 2) {
			$inserire = "NO";
			$err4 = "Numero di giocatori acquistati o venduti non corretto o non ammesso!";
		}
		if ($conta_cc != $conta_ac) {
			$inserire = "NO";
			$err3 = "Numero di centrocampisti acquistato diverso da numero di centrocampisti ceduto!";
		} # fine
		if ($conta_cf != $conta_af) {
			$inserire = "NO";
			$err4 = "Numero di fantasisti acquistato diverso da numero di fantasisti ceduto!";
		} # fine
		if ($conta_ca != $conta_aa) {
			$inserire = "NO";
			$err5 = "Numero di attaccanti acquistato diverso da numero di attacanti ceduto!";
		} # fine

	} # fine elseif

	else {
		$inserire = "NO";
		$err6 = "ERRORE GENERICO! Contattare webmaster!";
	} # fine else

	$numtot_acq = $conta_ap + $conta_ad + $conta_ac + $conta_af + $conta_aa;
	$numtot_ces = $conta_cp + $conta_cd + $conta_cc + $conta_cf + $conta_ca;

	if ($numtot_acq == 0 or $numtot_ces == 0) {
		$inserire = "NO";
		$errore4 = "Cambi totali acquisti o vendite non inseriti.";
	}
	if ($numtot_acq != $numtot_ces) {
		$inserire = "NO";
		$errore4 = "Differenza tra calciatori scelti e calciatori da svincolare.";
	}

	$fileo = file("$percorso_cartella_dati/utenti_".$_SESSION['torneo'].".php");
	list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $fileo[$_SESSION['uid']]);

	$surplus = INTVAL($ocrediti);
	$variazioni = INTVAL($ovariazioni);
	$cambi = INTVAL($ocambi);

	$cambi_residui = $numero_cambi_max - $cambi + $cambi_extra;

	if ($numtot_acq != $numtot_ces or $numtot_ces != $numtot_acq) {
		$inserire = "NO";
		$errore1 = "Differenza numero totale di cambi.";
	}
	else $cambi_proposti = $numtot_ces;
	
	if ($cambi_tra =="SI") $mes_tra=" - Traferito";
	else {
	$mes_tra="";
	#if ($cambi_proposti > $cambi_residui) {
	#	$inserire = "NO";
	#	$errore2 = "Non hai cambi sufficienti:<br/>
	#	---- Cambi totali: <b>$numero_cambi_max</b><br/>
	#	---- Cambi effettuati: <b>$cambi</b><br/>
	#	---- Cambi possibili: <b>$cambi_residui</b><br/>";
	}
	#}

	$soldi_spendibili = $soldi_iniziali + $surplus + $variazioni - $soldi_spesi + $val_cess + $val_acq;
	$totspese = $variazioni + $soldi_spesi;

	if ($inserire == "NO") echo "Soldi iniziali: $soldi_iniziali<br/>
	Surplus: $surplus<br/>
	Variazioni: $variazioni<br/>
	Soldi spesi: $soldi_spesi<br/>
	Valore cessioni: $val_cess<br/>
	Valore acquisti: $val_acq";
	
	if ($soldi_spendibili < 0) {
		$inserire = "NO";
		$errore3 = "<b><u>Non hai disponibilit&agrave; economiche sufficienti</u></b><br/>
		<table><tr><td>Budget iniziale:</td><td align='right'><b>$soldi_iniziali</b></td></tr>
		<tr><td>FantaEuro spesi in campagna acquisti iniziale:</td><td align='right'><b>$soldi_spesi</b></td></tr>
		<tr><td>Variazioni mercato:</td><td align='right'><b>$surplus</b></td></tr>
		<tr><td>Rivalutazione/svalutazione giocatori in cambi:</td><td align='right'><b>$variazioni</b></td></tr>
		<tr><td>Totale valutazione acquisti:</td><td align='right'><b>$val_acq</b></td></tr>
		<tr><td>Totale valutazione cessioni:</td><td align='right'><b>$val_cess</b></td></tr>
		<tr><td>Differenza:</td><td align='right'><b>$soldi_spendibili</b></td></tr></table>";
	}
	if ($inserire == "SI") {

		################################
		# Scrittura file mercato.txt
		# - Eliminazione cessioni

		$scrivi_file = "";
		$linee_mercato = file("$percorso_cartella_dati/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
		$num_linee = count($linee_mercato);
		for ($num1 = 0 ; $num1 < $num_linee ; $num1++) {
			$dat_mercato = explode(",", $linee_mercato[$num1]);
			$dat_cal = $dat_mercato[0];
			$dat_cal = togli_acapo($dat_cal);
			$dat_propr = $dat_mercato[4];
			$dat_propr = togli_acapo($dat_propr);
			$linee_cambi = file("$percorso_cartella_dati/cambi_tra_".$_SESSION['utente']);
			$righe_cambi = count($linee_cambi);

			for ($num2 = 0 ; $num2 < $righe_cambi ; $num2++) {
				$dati_cambi = explode(",", $linee_cambi[$num2]);
				$cambi_numero = $dati_cambi[0];
				$cambi_numero = togli_acapo($cambi_numero);
				$cambi_nome = $dati_cambi[1];
				$cambi_nome = togli_acapo($cambi_nome);
				$cambi_ruolo = $dati_cambi[2];
				$cambi_ruolo = togli_acapo($cambi_ruolo);
				$cambi_costo = $dati_cambi[3];
				$cambi_costo = togli_acapo($cambi_costo);
				$cambi_valore = $dati_cambi[4];
				$cambi_valore = togli_acapo($cambi_valore);
				$cambi_status = $dati_cambi[5];
				$cambi_status = togli_acapo($cambi_status);

				if ($_SESSION['utente'] == $dat_propr and $dat_cal == $cambi_numero and $cambi_status == 0 and $controlo_scrivi_file != "OK") $controlo_scrivi_file = "OK";

				if ($_SESSION['utente'] == $dat_propr and $dat_cal == $cambi_numero and $cambi_status == 0) {
					$nuovo_messaggio = $_SESSION['utente']." ha ceduto $cambi_nome ($cambi_ruolo) per $cambi_valore Fanta-Euro";
					$file_messaggi = fopen("$percorso_cartella_dati/registro_mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt","ab+");
					flock($file_messaggi,LOCK_EX);
					fwrite($file_messaggi,"\r\nRadio mercato: ".date("d/m/Y H:i").$mes_tra." - ".$nuovo_messaggio);
					flock($file_messaggi,LOCK_UN);
					fclose($file_messaggi);
				} # fine if messaggio
			} # fine for $num2

			if ($controlo_scrivi_file != "OK") $scrivi_file .= $linee_mercato[$num1];
			$controlo_scrivi_file = "";
		} # fine for $num
		$filemercato = fopen("$percorso_cartella_dati/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt","wb+");
		flock($filemercato,LOCK_EX);
		fwrite($filemercato,$scrivi_file);
		flock($filemercato,LOCK_UN);
		fclose($filemercato);
		echo "# - Eliminazione cessioni<br/>";

		################################




		################################
		# Scrittura file mercato.txt
		# - Inserimento acquisti

		$scrivi_file = "";
		$linee_cambi = file("$percorso_cartella_dati/cambi_tra_".$_SESSION['utente']);
		$righe_cambi = count($linee_cambi);

		for ($num = 0 ; $num < $righe_cambi ; $num++) {

			$dati_cambi = explode(",", $linee_cambi[$num]);
			$cambi_numero = $dati_cambi[0];
			$cambi_numero = togli_acapo($cambi_numero);

			$cambi_nome = $dati_cambi[1];
			$cambi_nome = togli_acapo($cambi_nome);

			$cambi_ruolo = $dati_cambi[2];
			$cambi_ruolo = togli_acapo($cambi_ruolo);

			$cambi_costo = $dati_cambi[3];
			$cambi_costo = togli_acapo($cambi_costo);

			$cambi_valore = $dati_cambi[4];
			$cambi_valore = togli_acapo($cambi_valore);

			$cambi_status = $dati_cambi[5];
			$cambi_status = togli_acapo($cambi_status);

			$anno_attuale = date("Y");
			$mese_attuale = date("m");
			$giorno_attuale = date("d");
			$ora_attuale = date("H");
			$minuto_attuale = date("i");
			$scadenza = "0";
			
			if ($cambi_status == 1) {

				$cambi_valore = - $cambi_valore;
				$scrivi_file = $acapo."$cambi_numero,$cambi_nome,$cambi_ruolo,$cambi_valore,".$_SESSION['utente'].",$scadenza";
				$file_mercato = fopen("$percorso_cartella_dati/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt","ab+");
				flock($file_mercato,LOCK_EX);
				fwrite($file_mercato,$scrivi_file);
				flock($file_mercato,LOCK_UN);
				fclose($file_mercato);

				$nuovo_messaggio = $_SESSION['utente']." ha acquistato $cambi_nome ($cambi_ruolo) per $cambi_valore Fanta-Euro";
				$file_messaggi = fopen("$percorso_cartella_dati/registro_mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt","ab+");
				flock($file_messaggi,LOCK_EX);
				fwrite($file_messaggi,"\r\nRadio mercato: ".date("d/m/Y H:i")." - ".$nuovo_messaggio);
				flock($file_messaggi,LOCK_UN);
				fclose($file_messaggi);

			} # fine if
		} # fine for
		echo "# - Inserimento acquisti<br/>";

		##############################################


		################################
		# Scrittura file utenti
		# - surplus - variazioni - cambi

		$fileo = file("$percorso_cartella_dati/utenti_".$_SESSION['torneo'].".php");
		list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>",$fileo[$_SESSION['uid']]);
		$surplus = INTVAL($ocrediti);
		$variazioni = INTVAL($ovariazioni);
		$cambi_effettuati = INTVAL($ocambi);

		$aggiorna_surplus = $surplus;
		$aggiorna_variazioni = $variazioni + $costo_attuale - $costo_iniziale;

		#if ($cambi_extra != 0) {
		#	if ($cambi_proposti <= $cambi_extra) {
		#		$cambi_extra = $cambi_proposti;
		#		$cambi_proposti = 0;
		#	}
		#	elseif ($cambi_proposti > $cambi_extra) $cambi_proposti = $cambi_proposti - $cambi_extra;
		#}

		$aggiorna_cambi_effettuati = $cambi_effettuati;
		$agg_file = $outente."<del>".($opass)."<del>".$opermessi."<del>".$oemail."<del>".$ourl."<del>".$osquadra."<del>".$otorneo."<del>". $oserie."<del>".$ocitta."<del>".$aggiorna_surplus."<del>".$aggiorna_variazioni."<del>".$aggiorna_cambi_effettuati."<del>".$oreg . "<del>0<del>0<del>0<del>0<del>0<del>0<del>0<del>0<del>0<del>0<del>0<del>0".$acapo;

		$fileo[$_SESSION['uid']] = $agg_file;
		$nuovo_file = implode('',$fileo);
		$agg_file = fopen("$percorso_cartella_dati/utenti_".$_SESSION['torneo'].".php", "wb");
		flock($agg_file,LOCK_EX);
		fwrite($agg_file, $nuovo_file);
		flock($agg_file,LOCK_UN);
		fclose($agg_file);
		#echo "# - Scrittura file utenti<br/>$cambi_extra<br/>";

		#if ($cambi_extra != 0) {
		#	$file_cce = fopen("$percorso_cartella_dati/cce_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt","ab+");
		#	$linea_cce = $_SESSION['utente'].",$cambi_extra";
		#	flock($file_cce,LOCK_EX);
		#	fwrite($file_cce,$acapo.$linea_cce);
		#	flock($file_cce,LOCK_UN);
		#	fclose($file_cce);
		#	echo "# - scrittura file controllo cambi extra<br/>";
		#}
		# Cancellazione file cambi
		if (@is_file("$percorso_cartella_dati/cambi_tra_".$_SESSION['utente'])) unlink ("$percorso_cartella_dati/cambi_tra_".$_SESSION['utente']);
		echo "# - Cancellazione file cambi<br/>";
		echo "<br/><br/><center><h3>Cambi effettuati correttamente!</h3></center>";
		echo "<br/><br/><br/><form method='post' action='cambi_tra.php'>
		<input type='submit' value='Ritorna alla selezione dei cambi'>
		</form></center><br/><br/><br/>";
	} # fine if ($inserire == "SI");
	else {
		echo "<h3>Sono stati rilevati i seguenti errori:</h3>";
		if ($err1) echo "<br/>- $err1";
		if ($err2) echo "<br/>- $err2";
		if ($err3) echo "<br/>- $err3";
		if ($err4) echo "<br/>- $err4";
		if ($err5) echo "<br/>- $err5";
		if ($err6) echo "<br/>- $err6";
		if ($errore) echo "<br/>- $errore";
		if ($errore1) echo "<br/>- $errore1";
		if ($errore2) echo "<br/>- $errore2";
		if ($errore3) echo "<br/>- $errore3";
		if ($errore4) echo "<br/>- $errore4";
		if ($errore5) echo "<br/>- $errore5";
		if ($errore6) echo "<br/>- $errore6";
		if ($frase_cce) echo "<br/>- $frase_cce";
		##################################
		echo "<br/><br/><br/><form method='post' action='cambi_tra.php'>
		<input type='submit' value='Ritorna alla selezione dei cambi'>
		</form></center><br/><br/><br/>";
	} # fine else if ($inserire == "SI");
	echo "</td></tr></table>";
} # fine if ($_SESSION['valido'] == "SI") {
include("./footer.php");
?>