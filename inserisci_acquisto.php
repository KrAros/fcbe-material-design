<?php
	#################################################################################
	#    FANTACALCIOBAZAR EVOLUTION
	#    Copyright (C) 2003-2008 by Antonello Onida (info@sssr.it)
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
	require_once ("./controlla_pass.php");
	include("./header.php");
	
	if ($_SESSION['valido'] == "SI") {
		require ("./menu.php");
		
		$trovato = "NO";
		$inserire = "SI";
		$soldi_spesi = 0;
		$num_calciatori_posseduti = 0;
		
		$valore = $_POST['valore'];
		$num_calciatore = $_POST['num_calciatore'];
		$xsquadra_ok = $_POST['xsquadra_ok'];
		$valore_mercato = $_POST['valore_mercato'];
		
		$ug = controlla_ug();
		
		if ($stato_mercato == "I" OR $stato_mercato == "R" OR $ug < 1) $calciatori_completi = file($percorso_cartella_dati."/calciatori.txt");
		else {
			for ($num1 = 1; $num1 < 40 ; $num1++) {
				if (strlen($num1) == 1) $num1 = "0".$num1;
			$percorso = $percorso_cartella_voti."/voti".$num1.$seconda_parte_pos_file_voti;
			if (is_file($percorso)) $calciatori_completi = file($percorso);
			else break;
			} # fine for $num1
			} # fine else
			
			$num_calciatori_completi = count($calciatori_completi);
			
			for ($num1 = 0 ; $num1 < $num_calciatori_completi ; $num1++) {
			$dati_calciatore = explode($separatore_campi_file_calciatori, $calciatori_completi[$num1]);
			$numero = $dati_calciatore[($num_colonna_numcalciatore_file_calciatori-1)];
			$numero = togli_acapo($numero);
			
			if ($num_calciatore == $numero) {
			$trovato = "SI";
			$nome = $dati_calciatore[($num_colonna_nome_file_calciatori-1)];
			$nome = togli_acapo($nome);
			$nome = preg_replace("#\"#","",$nome);
			$s_ruolo = $dati_calciatore[($num_colonna_ruolo_file_calciatori-1)];
			$s_ruolo = togli_acapo($s_ruolo);
			$ruolo = $s_ruolo;
			if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
			if ($s_ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
			if ($s_ruolo == $simbolo_portiere_file_calciatori) $ruolo = "P";
			if ($s_ruolo == $simbolo_difensore_file_calciatori) $ruolo = "D";
			if ($s_ruolo == $simbolo_centrocampista_file_calciatori) $ruolo = "C";
			if ($s_ruolo == $simbolo_attaccante_file_calciatori) $ruolo = "A";
			$valore = $dati_calciatore[($num_colonna_valore_calciatori-1)];
			$valore = togli_acapo($valore);
			$xsquadra = $dati_calciatore[($num_colonna_squadra_file_calciatori-1)];
			$xsquadra = togli_acapo($xsquadra);
			$xsquadra = preg_replace("#\"#","",$xsquadra);
			} # fine if ($num_calciatore == $numero)
			} # fine for $num1
			
			#################################
			# Verifiche di acquisto
			
			$calciatori = @file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
			$num_calciatori = @count($calciatori);
			
			for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
			
			$dati_calciatore = explode(",", $calciatori[$num1]);
			$numero = $dati_calciatore[0];
			$proprietario = $dati_calciatore[4];
			
			if ($proprietario == $_SESSION['utente']) {
			$soldi_spesi = $soldi_spesi + $dati_calciatore[3];
			$num_calciatori_posseduti++;
			} # fine if ($proprietario == $_SESSION['utente'])
			
			if ($num_calciatore == $numero) {
			$nome_condiviso = $dati_calciatore[1];
			$ruolo_condiviso = $dati_calciatore[2];
			$trovato = "SI";
			} # fine if ($num_calciatore == $numero)
			
			} # fine for $num1
			
			# Fine verifiche di acquisto
			#################################
			
			if ($trovato != "SI") {
			$inserire = "NO";
			$frase .= "Calciatore inesistente, sei un BARO!<br/>";
			} # fine if ($trovato != "SI")
			
			if ($num_calciatore == "") {
			$inserire = "NO";
			$frase .= "Calciatore non trovato.<br/>";
			} # fine if ($num_calciatore == "")
			
			if ($nuova_offerta == "SI" and $stato_mercato == "S") {
			$inserire = "NO";
			echo "<center>Il mercato &egrave; <b>sospeso</b> in questo momento.</center><br/>";
			} # fine if ($nuova_offerta == "SI" and $stato_mercato == "S")
			
			if ($stato_mercato == "C") {
			$inserire = "NO";
			echo "<center>Il mercato &egrave; <b>chiuso</b> in questo momento.</center><br/>";
			} # fine if ($stato_mercato == "C")
			
			$verifica_num = INTVAL($valore_offerta);
			
			if ($verifica_num <= 0) {
			$inserire = "NO";
			$frase .= "L'offerta deve essere un numero intero positivo.<br/>";
			} # fine if ($verifica_num != "" or $valore_offerta == "" or $valore_offerta == 0)
			
			$num_calciatori_comprabili = $max_calciatori - $num_calciatori_posseduti;
			
			$ifile = file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
			@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $ifile[$_SESSION['uid']]);
			$surplus = INTVAL($ocrediti);
			$variazioni = INTVAL($ovariazioni);
			
			$soldi_spendibili = $soldi_iniziali + $surplus + $variazioni - $soldi_spesi;
			
			if ($num_calciatori_comprabili <= 0) {
			$inserire = "NO";
			$frase .= "Hai raggiunto il valore massimo di calciatori comperabili.<br/>";
			} # fine if ($num_calciatori_comprabili <= 0)
			
			if ($valore_mercato > $soldi_spendibili) {
			$inserire = "NO";
			$frase .= "La tua offerta supera i soldi che hai a disposizione (Disponibilit&agrave;: $soldi_spendibili - Valore: $valore_offerta).<br/>";
			} # fine if ($soldi_spendibili <= $valore_offerta)
			
			if ($mercato_libero == "SI" and $valore_mercato > $soldi_spendibili) {
			$inserire = "NO";
			$frase .= "Il valore inserito non corrisponde a quello della sua valutazione effettiva (Disponibilit&agrave;: $soldi_spendibili - Valore: $valore_offerta).<br/>
			Verifica il giornale di riferimento ed inserisci il valore corretto della valutazione.";
			}
			
			################################
			# Scrittura file mercato.txt
			
			if ($inserire == "SI") {
			$data_chigio = @file("dati/data_chigio.txt");
			$data_cg = $data_chigio[0];
			$ac = substr($data_chigio[0],0,4);
			$mc = substr($data_chigio[0],4,2);
			$gc = substr($data_chigio[0],6,2);
			$anno_attuale = date("Y");
			$mese_attuale = date("m");
			$giorno_attuale = date("d");
			$ora_attuale = date("H");
			$minuto_attuale = date("i");
			$scadenza_teorica = @date("YmdHi",mktime($ora_attuale+$aspetta_ore,$minuto_attuale+$aspetta_minuti,0,$mese_attuale,$giorno_attuale+$aspetta_giorni,$anno_attuale));
			
			if (strlen($data_cg) <> 12) unset($data_cg);
			
			if ($mercato_libero == "NO") {
			if ($stato_mercato == "I" OR $stato_mercato == "P") {
			if (isset($data_cg)){
			if ($scadenza_teorica > $data_cg) $scadenza = $data_cg;
			else $scadenza = $scadenza_teorica;
			}
			else $scadenza = $scadenza_teorica;
			}
			else $scadenza = 0;
			}
			else $scadenza = 0;
			
			$archivio = "\r\n$num_calciatore,$nome,$ruolo,$valore_offerta,".$_SESSION['utente'].",$scadenza";
			$file_mercato = fopen($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt","ab+");
			flock($file_mercato,LOCK_EX);
			fwrite($file_mercato,$archivio);
			flock($file_mercato,LOCK_UN);
			Fclose($file_mercato);
			
			if ($stato_mercato == "I") $nuovo_messaggio = "Mercato iniziale: ".$_SESSION['utente']." ha vincolato $nome per $valore_offerta Fanta-Euro";
			elseif ($stato_mercato == "R") $nuovo_messaggio = "Mercato di riparazione: ".$_SESSION['utente']." ha vincolato $nome per $valore_offerta Fanta-Euro";
			else $nuovo_messaggio = $_SESSION['utente']." ha acquistato $nome per $valore_offerta Fanta-Euro";
			
			$file_messaggi = fopen($percorso_cartella_dati."/registro_mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt","ab+");
			flock($file_messaggi,LOCK_EX);
			fwrite($file_messaggi,"\r\nRadio mercato: ".date("d/m/Y H:i")." - ".$nuovo_messaggio);
			flock($file_messaggi,LOCK_UN);
			fclose($file_messaggi);
			
			echo "<meta http-equiv=\"refresh\" content=\"0; url=squadra.php\">
			<br/><br/><br/><br/><center><h4>Acquisto inserito!</h4></center>";
			} # fine if ($inserire == "SI");
			else {
			echo "<br/><br/><br/><br/><center><h4>$frase</h4></center>";
			echo"<meta http-equiv=\"refresh\" content=\"3; url=squadra.php\">";
			} # fine else if ($inserire == "SI");
			
			} # fine if ($_SESSION...)
			else echo"<meta http-equiv=\"refresh\" content=\"0; url=logout.php\">";
			
			include("./footer.php");
			?>			