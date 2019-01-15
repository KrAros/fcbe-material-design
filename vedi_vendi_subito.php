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
require_once ("./controlla_pass.php");
include("./header.php");

if ($_SESSION['valido'] == "SI") {
	require ("./menu.php");
	
	$chiusura_giornata = intval(@file($percorso_cartella_dati."/chiusura_giornata.txt"));
	
	if ($chiusura_giornata != 1) {
	
	echo "<table width='100%' cellspacing=2 cellpadding=5 align='center' bgcolor='$sfondo_tab'>";
	if ($stato_mercato == "I") echo "<caption>Svincolo calciatore</caption><tr><td align=center>";
	else echo "<caption>Vendita calciatore</caption><tr><td align=center>";
	$trovato = "NO";
	$scrivi = "NO";

	$calciatori = file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
	$num_calciatori = count($calciatori);

	for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
		$dati_calciatore = explode(",", $calciatori[$num1]);
		$numero = $dati_calciatore[0];
		$proprietario = $dati_calciatore[4];

		if ($proprietario == $_SESSION['utente']) {
			if ($num_calciatore == $numero) {

				$codice = $dati_calciatore[0];
				$nome = $dati_calciatore[1];
				$ruolo = $dati_calciatore[2];
				$costo = $dati_calciatore[3];
				$tempo_off = $dati_calciatore[5];
				$anno_off = substr($tempo_off,0,4);
				$mese_off = substr($tempo_off,4,2);
				$giorno_off = substr($tempo_off,6,2);
				$ora_off = substr($tempo_off,8,2);
				$minuto_off = substr($tempo_off,10,2);
				$data_acquisto = mktime($ora_off,$minuto_off,0,$mese_off,$giorno_off,$anno_off) - $adesso;
				$data_cessione = mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"));
				$tempo_contratto = $data_acquisto - $data_cessione;

				$trovato = "SI";
				$posizione = $num1;

			} # fine if ($num_calciatore == $numero)
		} # fine if ($proprietario == $_SESSION['utente'])
	} # fine for $num1

	if ($stato_mercato == "C") {
		$trovato = "NO";
		$frase1 = "<br/><br/><h3>Il mercato &egrave; <b>chiuso</b> in questo momento.</h3><br/>";
	} # fine if ($stato_mercato == "C")

	if ($trovato == "NO") {
		echo "<br/><br/><h3>Non puoi vendere questo calciatore.</h3><br/>$frase";
	} # fine if ($trovato == "NO")

	else {

		### Ricerca valore aggiornato da ultimo file voti presente

		for ($num1 = 1; $num1 < 40; $num1++) {
			if (strlen($num1) == 1) $num1 = "0".$num1;

			$percorso = "$percorso_cartella_voti/voti$num1$seconda_parte_pos_file_voti";

			if (is_file("$percorso")) {
				echo "";
			} # fine if
			else {
				$num1 = $num1 - 1;
				if (strlen($num1) == 1) $num1 = "0".$num1;
				$ultima_giornata = $num1;
				echo "<br/><b>Ultima giornata $ultima_giornata</b><br/><br/>";
				break;
			}
		} # fine for $num1

		if ($ultima_giornata != 0) $percorso = "$prima_parte_pos_file_voti$ultima_giornata$seconda_parte_pos_file_voti";
		else $percorso = "dati/calciatori.txt";

		$calciatori = file("$percorso");

		$num_calciatori = count($calciatori);
		echo "<table border=1 cellspacing=2 cellpadding=5 align='center' bgcolor='$sfondo_tab'>
		<tr>
		<td class=testa>Num.</td>
		<td class=testa>Nome</td>
		<td class=testa>Ruolo</td>
		<td class=testa>Valore</td>
		<td class=testa>Squadra</td></tr>";

		for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {

			$dati_calciatore = explode($separatore_campi_file_calciatori, $calciatori[$num1]);
			$numero = $dati_calciatore[($num_colonna_numcalciatore_file_calciatori-1)];
			$numero = togli_acapo($numero);

			if ($numero == $num_calciatore) {

				$nome = $dati_calciatore[($num_colonna_nome_file_calciatori-1)];
				$nome = togli_acapo($nome);
				$nome = ereg_replace("\"","",$nome);
				$s_ruolo = $dati_calciatore[($num_colonna_ruolo_file_calciatori-1)];
				$s_ruolo = togli_acapo($s_ruolo);
				$ruolo = $s_ruolo;
				$valore = $dati_calciatore[($num_colonna_valore_calciatori-1)];
				$valore = togli_acapo($valore);

				$xsquadra = $dati_calciatore[($num_colonna_squadra_file_calciatori-1)];
				$xsquadra = togli_acapo($xsquadra);
				$xsquadra = ereg_replace("\"","",$xsquadra);
				if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
				if ($s_ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
				if ($s_ruolo == $simbolo_portiere_file_calciatori) $ruolo = "P";
				if ($s_ruolo == $simbolo_difensore_file_calciatori) $ruolo = "D";
				if ($s_ruolo == $simbolo_centrocampista_file_calciatori) $ruolo = "C";
				if ($s_ruolo == $simbolo_attaccante_file_calciatori) $ruolo = "A";

				echo"<tr><td align='center'>$numero</td>
				<td>$nome</td>
				<td>$ruolo</td>
				<td>$valore</td>
				<td>$xsquadra</td>
				</tr>";
			}
		} # fine for $num1

		echo "</table>";
		
		if ($mercato_libero == "SI" OR $stato_mercato == "I" OR $stato_mercato == "R") $percentuale_vendita = 100;

		if ($vendi_costo == "NO") {
			$prezzo_vendita = round(($valore/100)*$percentuale_vendita);
			$aggiungi_surplus = $prezzo_vendita - $costo;
		}
		else {
			$prezzo_vendita = round(($costo/100)*$percentuale_vendita);
			$aggiungi_surplus = $prezzo_vendita - $costo;
		}

		echo "<br/><br/><table summary='vedi vendi subito' align='center' cellpadding='5' class='evidenziato'>
		<tr><td>Valutazione attuale del calciatore</td><td align='right'>$prezzo_vendita</td></tr>
		<tr><td>Costo di acquisto</td><td align=right>$costo</td></tr>
		<tr><td>% vendita</td><td align=right>$percentuale_vendita</td></tr>
		<tr><td>Plusvalenza o minusvalenza</td><td align=right>$aggiungi_surplus</td></tr></table>";
		echo "<h2>ATTENZIONE</h2>
		<br/>Procedendo il giocatore sopra indicato sar&agrave; venduto ai valori indicati.<br/><br/>
		Vuoi realmente proseguire?<br/><br/>
		<br /><br /><center><form method='post' action='vendi_subito.php'>
		<input type='hidden' name='num_calciatore' value='$num_calciatore' />
		<input type='submit' name='rivendi' value='Rimetti sul mercato' />
		</form>
		<br /><br /><br /><br />
		<form method='post' action='squadra.php'>
		<input type='submit' name='torna_squadra' value='Torna alla squadra' />
		</form></center>";
	}
	echo "</td></tr></table>";
	} # fine if ($chiusura_giornata != 1)
	else {
		echo "<br /><br /><h2>Giornata chiusa</h2>";
		echo "<p align='center'>Non &eacute; pi&ugrave; consentito effettuare operazioni per questa giornata!<br /><br />Attendere fino a quando viene creata la prossima giornata.</p><br /><br /><br /><br /><br />";
	}
} # fine if ($pass_errata != "SI")
else echo "<meta http-equiv='refresh' content='2; url=logout.php'><br/><br/><br/><br/><h3>Opzione non consentita</h3>";

include("./footer.php");
?>