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
require_once ("./controlla_pass.php");
include("./header.php");

if ($_SESSION['valido'] == "SI") {
	require ("./menu.php");
	$chiusura_giornata = (INT) @file("$percorso_cartella_dati/chiusura_giornata.txt");
	if ($num_calciatori_scambiabili == 0 or $stato_mercato == "C" or $stato_mercato == "S" or $stato_mercato == "I" or $chiusura_giornata == 1)  {
		echo "<center><h3>Non si possono fare scambi in questo momento.</h3><br />";
		if ($num_calciatori_scambiabili == 0) echo "<center><font class='evidenziato'>Attualmente non sono permessi scambi.</font><br /><br />";
		if ($stato_mercato == "C") echo "<center><font class='evidenziato'>Il mercato &egrave; temporaneamente chiuso.</font><br /><br />";
		if ($stato_mercato == "S") echo "<center><font class='evidenziato'>Il mercato &egrave; stato sospeso.</font><br /><br />";
		if ($stato_mercato == "I") echo "<center><font class='evidenziato'>Il mercato &egrave; nella fase iniziale.</font><br /><br />";
		if ($stato_mercato == "R") echo "<center><font class='evidenziato'>Il mercato &egrave; nella fase di riparazione.</font><br /><br />";
		if ($chiusura_giornata == 1) echo "<center><font class='evidenziato'>La giornata &egrave; chiusa. Attendere l'aggiornamento.</font><br /><br />";
	}
	else {
		$num_calciatori_posseduti = 0;
		$num_calciatori_effettivi = 0;
		$soldi_spesi = 0;
		$calciatori_utente = "";
		$num_calciatori_posseduti_altro = 0;
		$num_calciatori_effettivi_altro = 0;
		$soldi_spesi_altro = 0;
		$calciatori_altro = "";
		$num_calciatori_offerti = 0;
		$num_calciatori_richiesti = 0;
		$lista_ric = "";
		$lista_off = "";
		$calciatori = @file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
		$num_calciatori = count($calciatori);

		for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
			$dati_calciatore = explode(",", $calciatori[$num1]);
			$numero = $dati_calciatore[0];
			$nome = $dati_calciatore[1];
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
			$proprietario = $dati_calciatore[4];

			if ($proprietario == $_SESSION['utente']) {
				$soldi_spesi = $soldi_spesi + $dati_calciatore[3];
				$num_calciatori_posseduti++;

				if ($sec_restanti < 0) {
					$num_calciatori_effettivi++;
					$nomi_calciatori_utente[$num_calciatori_effettivi] = $nome;
					$num_calciatori_utente[$num_calciatori_effettivi] = $numero;
					$ruolo_calciatori_utente[$num_calciatori_effettivi] = $ruolo;
					$calciatori_utente[$numero] = "SI";
				} # fine if ($sec_restanti < 0)

			} # fine if ($proprietario == $_SESSION['utente'])

			if ($proprietario == $altro_utente) {
				$soldi_spesi_altro = $soldi_spesi_altro + $dati_calciatore[3];
				$num_calciatori_posseduti_altro++;

				if ($sec_restanti < 0) {
					$num_calciatori_effettivi_altro++;
					$nomi_calciatori_altro[$num_calciatori_effettivi_altro] = $nome;
					$num_calciatori_altro[$num_calciatori_effettivi_altro] = $numero;
					$ruolo_calciatori_altro[$num_calciatori_effettivi_altro] = $ruolo;
					$calciatori_altro[$numero] = "SI";
				} # fine if ($sec_restanti < 0)
			} # fine if ($proprietario == $altro_utente)
		} # fine for $num1

		if ($_POST['offri_scambio']) {

			for ($num1 = 0 ; $num1 < $num_calciatori_scambiabili ; $num1++) {
				$calciatore_scambio_utente = "calciatore_scambio_utente$num1";
				$calciatore_scambio_utente = $$calciatore_scambio_utente;

				if ($calciatori_utente[$calciatore_scambio_utente] != "SI" and $calciatore_scambio_utente != "") {
					$scambiare = "NO";
					echo "Hai offerto un calciatore non in tuo possesso!<br />";
				} # fine if ($calciatori_utente[$calciatore_scambio_utente] != "SI" and...

				if ($gia_offerti_utente[$calciatore_scambio_utente] == "SI") {
					$scambiare = "NO";
					echo "Hai offerto più volte lo stesso calciatore.<br />";
				} # fine if ($gia_offerti_utente[$calciatore_scambio_utente] == "SI")

				if ($calciatore_scambio_utente != "") {
					if ($num_calciatori_offerti > 0) $lista_off .= ";$calciatore_scambio_utente";
					else $lista_off .= "$calciatore_scambio_utente";
					$gia_offerti_utente[$calciatore_scambio_utente] = "SI";
					$num_calciatori_offerti++;
				} # fine if ($calciatore_scambio_utente != "")

				$calciatore_scambio_altro = "calciatore_scambio_altro$num1";
				$calciatore_scambio_altro = $$calciatore_scambio_altro;
				########################
				
				if ($calciatori_altro[$calciatore_scambio_altro] != "SI" and $calciatore_scambio_altro != "") {
					$scambiare = "NO";
					echo "Hai richiesto un calciatore non posseduto da ".$altro_utente."!<br />";
				} # fine if ($calciatori_altro[$calciatore_scambio_altro] != "SI" and...

				if ($gia_offerti_altro[$calciatore_scambio_altro] == "SI") {
					$scambiare = "NO";
					echo "Hai richiesto più volte lo stesso calciatore.<br />";
				} # fine if ($gia_offerti_altro[$calciatore_scambio_altro] == "SI")

				if ($calciatore_scambio_altro != "") {
					if ($num_calciatori_richiesti > 0) $lista_ric .= ";$calciatore_scambio_altro";
					else $lista_ric .= "$calciatore_scambio_altro";
					$gia_offerti_altro[$calciatore_scambio_altro] = "SI";
					$num_calciatori_richiesti++;
				} # fine if ($calciatore_scambio_utente != "")
			} # fine for $num1

			if ($num_calciatori_offerti == 0) {
				$scambiare = "NO";
				echo "Non hai offerto nessun calciatore.<br />";
			} # fine if ($num_calciatori_offerti == 0)

			if ($num_calciatori_richiesti == 0) {
				$scambiare = "NO";
				echo "Non hai richiesto nessun calciatore.<br />";
			} # fine if ($num_calciatori_richiesti == 0)

			$num_calciatori_dopo = $num_calciatori_posseduti + $num_calciatori_richiesti - $num_calciatori_offerti;
			if ($num_calciatori_dopo > $max_calciatori) {
				$scambiare = "NO";
				echo "Dopo lo scambio avresti più di $max_calciatori calciatori.<br />";
			} # fine if ($num_calciatori_dopo > $max_calciatori)

			if ($_SESSION['utente'] == $altro_utente) {
				$scambiare = "NO";
				echo "Hai una doppia personalit&agrave;?.<br />";
			} # fine if ($_SESSION['utente'] == $altro_utente)

			$verifica_num = ereg_replace("[0-9]","",$soldi_scambio_utente);
			$verifica_num_altro = ereg_replace("[0-9]","",$soldi_scambio_altro);

			if ($verifica_num != "" or $verifica_num_altro != "") {
				$scambiare = "NO";
				echo "I Fanta-Euro devono essere un numero intero.<br />";
			} # fine if ($verifica_num != "")

			$filei = file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
			$linee = count($filei);
			@list($ooutente, $oopass, $oopermessi, $ooemail, $oourl, $oosquadra, $ootorneo, $ooserie, $oocitta, $oocrediti, $oovariazioni, $oocambi, $ooreg) = explode("<del>", $filei[$_SESSION['uid']]);
			$surplus = intval($oocrediti);
			$variazioni = intval($oovariazioni);
			$soldi_spendibili = $soldi_iniziali + $surplus + $variazioni - $soldi_spesi;

			if ($soldi_scambio_utente > $soldi_spendibili) {
				$scambiare = "NO";
				echo "Hai offerto più crediti di quelli da te posseduti.<br />";
			} # fine if ($soldi_scambio_utente > $soldi_spendibili)

			for($num1 = 1 ; $num1 < $linee; $num1++) {
				@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $filei[$num1]);
				if ($outente == $altro_utente) {
					$surplus_altro = (int) $ocrediti;
					$variazioni_altro = (int) $ovariazioni;
					$soldi_spendibili_altro = $soldi_iniziali + $surplus_altro + $variazioni_altro - $soldi_spesi_altro;
					break;
				}
			}

			if ($soldi_scambio_altro > $soldi_spendibili_altro) {
				$scambiare = "NO";
				echo "Hai richiesto a ".$altro_utente." più crediti di quelli disponibili.<br />";
			} # fine if ($soldi_scambio_utente > $soldi_spendibili_altro)

			if ($scambiare != "NO") {
				$scambi_proposti = @file($percorso_cartella_dati."/scambi_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
				$num_scambi_proposti = count($scambi_proposti);
				$num_offerte_utente = 0;
				$id_scambio = 0;
				
				for ($num1 = 0 ; $num1 < $num_scambi_proposti ; $num1++) {
					$dati_scambio = explode(",", $scambi_proposti[$num1]);
					if ($num1 == 0 and $dati_scambio[0]) $id_scambio = $dati_scambio[0];
					else $dati_scambio[0]=0;
					$offerente = $dati_scambio[1];
					if ($offerente == $_SESSION['utente']) $num_offerte_utente++;
				} # fine for $num1
				#echo $dati_scambio[0]."zzzzzzzzz";
				if ($num_offerte_utente >= 12) {
					$scambiare = "NO";
					echo "Hai gi&agrave; in corso 12 offerte di scambio.<br />";
				} # fine if ($num_offerte_utente >= 12)

				# finalmente dopo tutti i controlli inserisco lo scambio
				if ($scambiare != "NO") {

					//SPEDISCO MAIL-------------------------------------------------

					$sdata = date("d/m/y",time());
					settype ($sdata,string);
					// invio mail a noi
					$to = $_SESSION['MAILA'];
					$oggetto = "$titolo_sito: proposta di scambio!";
					$messaggio = "L'allenatore <b>".$_SESSION['utente']."</b> della squadra <b>".$_SESSION["squadra"]."</b>  ti ha fatto una proposta di scambio di calciatori! \n\n<br/><br/>";
					$messaggio = $messaggio."Vai a vedere sul sito <a href='http://" .$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']). "'>http://" .$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF'])."</a> \n\n";
					$intestazioni  = "MIME-Version: 1.0\r\n";
					$intestazioni .= "Content-type: text/html; charset=iso-8859-1\r\n";
					$intestazioni .= "From: $admin_nome ($email_mittente)\r\n" ;

					mail($to , $oggetto ,$messaggio , $intestazioni) ;

					//FINE SPEDISCO MAIL--------------------------------------------

					$file_scambi = fopen($percorso_cartella_dati."/scambi_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt","w+");
					flock($file_scambi,LOCK_EX);
					$anno_attuale = date("Y");
					$mese_attuale = date("m");
					$giorno_attuale = date("d");
					$ora_attuale = date("H");
					$minuto_attuale = date("i");
					$scadenza_teorica = date("YmdHi",mktime($ora_attuale+$aspetta_ore,$minuto_attuale+$aspetta_minuti,0,$mese_attuale,$giorno_attuale+$aspetta_giorni,$anno_attuale));
					$data_chigio = @file("dati/data_chigio.txt");
					$data_cg = $data_chigio[0];
					

					if (strlen($data_cg) <> 12) unset($data_cg);

					if ($mercato_libero == "NO") {
							if (isset($data_cg)){
								if ($scadenza_teorica > $data_cg) $scadenza = $data_cg;
								else $scadenza = $scadenza_teorica;
							}
							else $scadenza = $scadenza_teorica;
					}
					else $scadenza = 0;

					if (!$soldi_scambio_utente) $soldi_scambio_utente = 0;

					if (!$soldi_scambio_altro) $soldi_scambio_altro = 0;

					$id_scambio++;
					$linea = "$id_scambio,".$_SESSION['utente'].",$lista_off,$soldi_scambio_utente,".$altro_utente.",$lista_ric,$soldi_scambio_altro,$scadenza\n";
					fwrite($file_scambi,$linea);
					for ($num1 = 0 ; $num1 < $num_scambi_proposti ; $num1++) {
						# se lo scambio &egrave; scaduto non lo riscrivo
						$dati_scambio = explode(",", $scambi_proposti[$num1]);
						$tempo_off = $dati_scambio[7];
						$tempo_off = togli_acapo($tempo_off);
						$anno_off = substr($tempo_off,0,4);
						$mese_off = substr($tempo_off,4,2);
						$giorno_off = substr($tempo_off,6,2);
						$ora_off = substr($tempo_off,8,2);
						$minuto_off = substr($tempo_off,10,2);
						$adesso = mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"));
						$sec_restanti = mktime($ora_off,$minuto_off,0,$mese_off,$giorno_off,$anno_off) - $adesso;
						if ($sec_restanti > 0) fwrite($file_scambi,$scambi_proposti[$num1]);
					} # fine for $num1
					flock($file_scambi,LOCK_UN);
					fclose($file_scambi);
					$nuovo_messaggio = $_SESSION['utente']." ha inviato una proposta di scambio a ".$altro_utente.".";
					$file_messaggi = fopen($percorso_cartella_dati."/registro_mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt","ab+");
					flock($file_messaggi,LOCK_EX);
					fwrite($file_messaggi,"\nRadio mercato: ".date("d/m/Y H:i")." - ".$nuovo_messaggio);
					flock($file_messaggi,LOCK_UN);
					fclose($file_messaggi);
					echo "<center><h4>L'offerta di scambio &egrave; stata inviata!</h4><br /><br /><br /><br />
					<a href='scambi_proposti.php' title='Scambi proposti'>Scambi proposti</a></center>";
				} # fine if ($scambiare != "NO")
			} # fine if ($scambiare != "NO")

			if ($scambiare == "NO") echo "<center><h4>Scambio non permesso.</h4><br />";
		} # fine if ($offri_scambio)
		else {
			echo "<center><h4>Tramite questa procedura &egrave; possibile proporre degli scambi ad un altro giocatore.</h4></center><br /><br />";
			echo "<table width='80%' border=0 class=border cellpadding=10 align=center bgcolor='$sfondo_tab'>
			<form method='post' action='scambia.php'>
			<tr><td width='50%'>
			<input type='hidden' name='altro_utente' value='$altro_utente' />
			<font size=+1>Io (<b>".$_SESSION['utente']."</b>) offro:</font><br /><br />";
			for ($num1 = 0 ; $num1 < $num_calciatori_scambiabili ; $num1++) {
				if ($num1 != 0) echo " + <br /><br />";
				echo "<select name='calciatore_scambio_utente$num1'>
				<option value='' selected>---</option>";
				for ($num2 = 1 ; $num2 <= $num_calciatori_effettivi ; $num2++) {
					$nome = $nomi_calciatori_utente[$num2];
					$numero = $num_calciatori_utente[$num2];
					echo "<option value='$numero'>$nome ($ruolo_calciatori_utente[$num2])</option>";
				} # fine for $num2
				echo "</select>";
			} # fine for $num1
			
			if ($scambio_con_soldi == "SI") {
				echo "<br /><br /> + <input type='text' name='soldi_scambio_utente' size='8' />
				Fanta-Euro.</td>";
			} # fine if ($scambio_con_soldi == "SI")
			
			//-----------------parte invio mail-------------------------------------
			$filei = file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
			$linee = count($filei);

			for($num1 = 1 ; $num1 < $linee; $num1++) {
				@list($Utente, $Pass, $Permessi, $Email, $Url, $Squadra, $Citta, $Crediti, $Variazioni, $Cambi, $Reg) = explode("<del>", $filei[$num1]);
				if ($Utente == $altro_utente) {

					session_register( "MAILA" );
					$MAILA = $Email;
					$_SESSION['MAILA']=$MAILA;
					//echo "<strong>$Utente</strong>";
					//echo "<strong>$Permessi</strong>";
					//echo "<strong>$Email</strong>";
					//echo "<strong>$Squadra</strong>";
					break;
				}
			}
			//-----------------------------------------------------
			echo "<td width='50%'><font size=+1>per ottenere <b>(da ".$altro_utente.")</b>:</font><br /><br />";
			for ($num1 = 0 ; $num1 < $num_calciatori_scambiabili ; $num1++) {
				if ($num1 != 0) echo " + <br /><br />";
				echo "<select name='calciatore_scambio_altro$num1'>
				<option value=''>-----</option>";
				for ($num2 = 1 ; $num2 <= $num_calciatori_effettivi_altro ; $num2++) {
					$nome = $nomi_calciatori_altro[$num2];
					$numero = $num_calciatori_altro[$num2];
					echo "<option value='$numero'";
					if ($num1 == 0 and $numero == $num_calciatore) echo " selected";
					echo ">$nome ($ruolo_calciatori_altro[$num2])</option>";
				} # fine for $num2
				echo "</select>";
			} # fine for $num1

			if ($scambio_con_soldi == "SI") {
				echo "<br /><br /> + <input type='text' name='soldi_scambio_altro' size='8' />
				Fanta-Euro.</td></tr></table>";
			} # fine if ($scambio_con_soldi == "SI")
			else echo "</td></tr></table>";
			
			echo " <br /><br /><br /><center>
			<input type='submit' name='offri_scambio' value='Offri lo scambio' />
			</center></form><br /><br /><p align='justify' class='evidenziato' style='PADDING-LEFT: 30px; PADDING-RIGHT: 30px; PADDING-TOP: 30px; PADDING-BOTTOM: 30px;' >Attenzione: la procedura consente di scambiare 2 o 3 giocatori per un numero diverso (1 o 2); le parti interessate ad uno scambio di questo tipo dovranno necessariamente ristabilire la quota stabilita di <b>$max_calciatori</b> calciatori in mercato. <br /><br />Chi, a seguito di una operazione di mercato sbilanciata, si trovasse ad aver meno calciatori di quelli necessari dovr&agrave; essere in possesso di crediti sufficienti per successivi acquisti, <b>altrimenti non potr&agrave; effettuare modifiche nella squadra</b>. Dovr&agrave; cos&igrave; vendere uno o pi&ugrave; calciatori e con il ricavato ristabilire il numero necessario.<br /><br />Chi si troverasse nella situazione di avere pi&ugrave; di <b>$max_calciatori</b> calciatori non potr&agrave; effettuare lo scambio prima di aver ceduto il numero necessario di calciatori.<br /><br /><b>Eventuali differenze economiche derivanti dallo scambio resteranno nel bilancio del giocatore.<br />Verificate attentamente la convenienza di uno scambio, anche economica, in quanto una differenza passiva rimarr&agrave; a vostro carico.</b></p>";

		} # fine else if ($offri_scambio)
	} # fine else if ($num_calciatori_scambiabili == 0)

	echo "</td></tr></table><br /><br /><br /><br />";
} # fine if ($_SESSION['valido'] == "SI") {
else echo"<meta http-equiv='refresh' content='0; url=logout.php'>";
include("./footer.php");
?>