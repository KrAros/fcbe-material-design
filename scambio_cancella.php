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
include("./controlla_pass.php");
include("header.php");

if ($_SESSION['valido'] == "SI") {
	include("menu.php");

	$id_scambio=$_GET['id_scambio'];
	$referente=$_GET['referente'];

	echo "<table bgcolor='$sfondo_tab' align='center' cellpadding='20'>
	<caption>Cancellazione scambio di calciatori</caption>
	<tr><td><center><font class='evidenziato'><b>Attenzione!!!</b><br />Confermando la procedura &eacute; irreversibile</font>.<br />Procedere con cura leggendo attentamente tutti i messaggi che sono visualizzati.<br /><br />$id_scambio - $referente<br /><br />";

	$trovato = "NO";
	$num_calciatori_posseduti = 0;
	$num_calciatori_effettivi = 0;
	$soldi_spesi = 0;
	$calciatori_utente = "";
	$num_calciatori_posseduti_altro = 0;
	$num_calciatori_effettivi_altro = 0;
	$soldi_spesi_altro = 0;
	$calciatori_altro = "";
	$calciatori_offerti = "";
	$calciatori_richiesti = "";
	$num_calciatori_offerti = 0;
	$num_calciatori_richiesti = 0;
	$lista_off = "";
	$lista_ric = "";
	$ini_lista_off = "";
	$ini_lista_ric = "";

	$scambi_proposti = file($percorso_cartella_dati."/scambi_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
	$num_scambi_proposti = count($scambi_proposti);

	for ($num1 = 0 ; $num1 < $num_scambi_proposti ; $num1++) {
		$dati_scambio = explode(",", $scambi_proposti[$num1]);
		if ($id_scambio == $dati_scambio[0]) {
			$trovato = "SI";
			$utente_offerente = $dati_scambio[1];
			$calciatori_offerti = $dati_scambio[2];
			$calciatori_offerti = explode(";", $calciatori_offerti);
			$num_calciatori_offerti = count($calciatori_offerti);
			$soldi_offerti = $dati_scambio[3];
			$utente_richiesto = $dati_scambio[4];
			if ($referente == "uno" AND $utente_richiesto != $_SESSION['utente']) $trovato = "NO";
			if ($referente == "due" AND $utente_offerente != $_SESSION['utente']) $trovato = "NO";
			$calciatori_richiesti = $dati_scambio[5];
			$calciatori_richiesti = explode(";", $calciatori_richiesti);
			$num_calciatori_richiesti = count($calciatori_richiesti);
			$soldi_richiesti = $dati_scambio[6];
			$tempo_off = $dati_scambio[7];
			$tempo_off = togli_acapo($tempo_off);
			$anno_off = substr($tempo_off,0,4);
			$mese_off = substr($tempo_off,4,2);
			$giorno_off = substr($tempo_off,6,2);
			$ora_off = substr($tempo_off,8,2);
			$minuto_off = substr($tempo_off,10,2);
			$adesso = mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"));
			$sec_restanti = mktime($ora_off,$minuto_off,0,$mese_off,$giorno_off,$anno_off) - $adesso;
			break;
		} # fine if ($id_scambio == $dati_scambio[0])
	} # fine for $num1

	if ($trovato == "NO") echo "<center><h3>Proposta di scambio non trovata.</h3>$utente_richiesto - $utente_offerente";
	else {
		if ($stato_mercato == "C") {
			echo "<center>Il mercato &eacute; <b>chiuso</b> in questo momento.</center><br />";
		} # fine if ($stato_mercato == "C")
		else {
			if (!$_POST['sicuro']) {
				if ($referente== "uno") echo "<center><form method='POST' action='$SCRIPT_NAME'>
				Sei sicuro di voler cancellare lo scambio proposto da <b>$utente_offerente</b>?<br /><br />
				<input type='hidden' name='c_id_scambio' value='$id_scambio' />
				<input type='hidden' name='c_referente' value='uno' />
				<input type='submit' name='sicuro' value='Cancella scambio' />
				</form></center>";
				if ($referente== "due") echo "<center><form method='post' action='$SCRIPT_NAME'>
				Sei sicuro di voler cancellare lo scambio proposto a <b>$utente_richiesto</b>?<br /><br />
				<input type='hidden' name='c_id_scambio' value='$id_scambio' />
				<input type='hidden' name='c_referente' value='due' />
				<input type='submit' name='sicuro' value='Cancella scambio' />
				</form></center>";
			} # fine if (!$sicuro)
			else {
				$scambi_proposti = @file($percorso_cartella_dati."/scambi_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
				$num_scambi_proposti = count($scambi_proposti);
				$file_scambi = fopen($percorso_cartella_dati."/scambi_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt","wb+");
				flock($file_scambi,LOCK_EX);
				for ($num1 = 0; $num1 <= $num_scambi_proposti; $num1++) {
					$dati_scambio = explode(",", $scambi_proposti[$num1]);
					if ($_POST['c_id_scambio'] != $dati_scambio[0]) fwrite($file_scambi,$scambi_proposti[$num1]);
				} # fine for $num1
				flock($file_scambi,LOCK_UN);
				fclose($file_scambi);
				if ($_POST['c_referente'] == "uno") $nuovo_messaggio = $_SESSION['utente']." ha cancellato lo scambio proposto da $utente_offerente.";
				if ($_POST['c_referente'] == "due") $nuovo_messaggio = $_SESSION['utente']." ha cancellato lo scambio proposto a $utente_richiesto.";

				$file_messaggi = fopen($percorso_cartella_dati."/registro_mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt","ab+");
				flock($file_messaggi,LOCK_EX);
				fwrite($file_messaggi,"\Radio mercato: ".date("d/m/Y H:i")." - ".$nuovo_messaggio);
				flock($file_messaggi,LOCK_UN);
				fclose($file_messaggi);
				echo "Lo scambio &eacute; stato cancellato!<br />";

				if ($scambiare == "NO") echo "<b>Scambio non permesso</b>.<br />";

			} # fine else if (!$sicuro)
		} # fine else if ($stato_mercato == "C")
	} # fine else if ($trovato == "NO")

	echo "</td></tr></table>";
} # fine elseif ($_SESSION['utente'] == "admin")
else echo"<meta http-equiv='refresh' content='0; url=logout.php'>";
include("footer.php");
?>