<?php
##################################################################################
#    FANTACALCIOBAZAR EVOLUTION
#    Copyright (C) 2003-2006 by Antonello Onida (f
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

echo "<div class='mdl-grid'>";
require ("./widget.php");

	if ($_SESSION['valido'] == "SI") {
	#require ("./menu.php");
	$chiusura_giornata = INTVAL(@file($percorso_cartella_dati."/chiusura_giornata.txt"));

		if ($chiusura_giornata == 0) {
		echo "<div class='mdl-cell mdl-cell--9-col'>
    <div class='bread'><a href='./mercato.php'>Gestione</a> / Acquista calciatore</div>
	<table class='mdl-data-table mdl-shadow--2dp' style='width:100%'  cellpadding='5' align='center' bgcolor='$sfondo_tab'>
		<caption>Acquisto calciatore</caption><tr><td align='center'>";

		$duplicato = "NO";
		$trovato = "NO";
		$acquisto = "SI";
		$soldi_spesi = 0;
		$num_calciatori_posseduti = 0;

		$calciatori = @file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_0.txt");
		$num_calciatori = count($calciatori);

		for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
		$dati_calciatore = explode(",", $calciatori[$num1]);
		$numero = trim($dati_calciatore[0]);
		$proprietario = trim($dati_calciatore[4]);

		if ($proprietario == $_SESSION['utente']) {
		$soldi_spesi = $soldi_spesi + $dati_calciatore[3];
		$num_calciatori_posseduti++;
		} # fine if ($proprietario == $_SESSION['utente'])

		##############################################
		# Verifica se il giocatore &egrave; duplicato       #
		##############################################

		if ($num_calciatore == $numero and $_SESSION['utente'] == $proprietario) {
		$acquisto = "NO";
		$duplicato = "SI";
		} # fine if ($num_calciatore == $numero and $_SESSION['utente'] == $proprietario)

		##############################################
		# Verifica se il giocatore &egrave; in comproprietà #
		##############################################

		if ($num_calciatore == $numero and $duplicato != "SI" and $proprietario != $_SESSION['utente']) {

		$trovato = "SI";
		$nome = trim($dati_calciatore[1]);
		$ruolo = trim($dati_calciatore[2]);
		$costo = trim($dati_calciatore[3]);

		echo "<center>Il giocatore <b>$nome</b> ($numero - <b>$ruolo</b>) &egrave; gia stato acquistato da <b>$proprietario</b> per <b>$costo</b> FantaEuro</center>";
		} # fine if ($num_calciatore == $numero ...

		} # fine for $num1

		#############################################
		# Seleziona giocatore dal elenco calciatori #
		#############################################

		if ($mercato_libero == "SI" and $stato_mercato == "I") $calciatori = file($percorso_cartella_dati."/calciatori.txt");
		elseif ($mercato_libero == "NO" and $stato_mercato == "R") $calciatori = file($percorso_cartella_dati."/calciatori.txt");

		else {
			for ($num1 = 1; $num1 < 40 ; $num1++) {

				if (strlen($num1) == 1) $num1 = "0".$num1;
			$percorso = $percorso_cartella_voti."/voti".$num1.$seconda_parte_pos_file_voti;
				if (is_file($percorso)) $calciatori = file($percorso);
				else break;
			} # fine for $num1
		} # fine else
		$num_calciatori = count($calciatori);

		for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
		$dati_calciatore = explode($separatore_campi_file_calciatori, $calciatori[$num1]);
		$numero = $dati_calciatore[($num_colonna_numcalciatore_file_calciatori-1)];

		if ($numero == $num_calciatore) {
		$trovato = "SI";
		$nome = $dati_calciatore[($num_colonna_nome_file_calciatori-1)];
		$nome = togli_acapo($nome);
		$nome = ereg_replace("\"","",$nome);
		$s_ruolo = $dati_calciatore[($num_colonna_ruolo_file_calciatori-1)];
		$s_ruolo = trim($s_ruolo);
		$ruolo = $s_ruolo;
		$valore = $dati_calciatore[($num_colonna_valore_calciatori-1)];
		$valore = trim($valore);
		$xsquadra = $dati_calciatore[($num_colonna_squadra_file_calciatori-1)];
		$xsquadra = togli_acapo($xsquadra);
		$xsquadra = ereg_replace("\"","",$xsquadra);

		if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
		if ($s_ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
		if ($s_ruolo == $simbolo_portiere_file_calciatori) $ruolo = "P";
		if ($s_ruolo == $simbolo_difensore_file_calciatori) $ruolo = "D";
		if ($s_ruolo == $simbolo_centrocampista_file_calciatori) $ruolo = "C";
		if ($s_ruolo == $simbolo_attaccante_file_calciatori) $ruolo = "A";

		echo "<br/><br/><table class='mdl-data-table mdl-shadow--2dp' width='100%' cellspacing=2 cellpadding=5 bgcolor='$sfondo_tab1'>";
		echo "<tr><td class='testa' colspan='4'>Dati calciatore</td></tr>";

		echo"<tr><td>$numero</td>
		<td>$nome</td>
		<td>$ruolo</td>
		<td>$xsquadra</td></tr>";
		} # fine if ($num_calciatore == $numero)
		} # fine for $num1
		echo "</table>";

		if ($stato_mercato == "S") {
		$acquisto = "NO";
		echo "<center>Il mercato &egrave; <b>sospeso</b> in questo momento.</center><br/>";
		} # fine if ($stato_mercato == "S")

		if ($stato_mercato == "C") {
		$acquisto = "NO";
		echo "<center>Il mercato &egrave; <b>chiuso</b> in questo momento.</center><br/>";
		} # fine if ($stato_mercato == "C")

		$num_calciatori_comprabili = $max_calciatori - $num_calciatori_posseduti;

		$file = file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
		@list($ooutente, $oopass, $oopermessi, $ooemail, $oourl, $oosquadra, $ootorneo, $ooserie, $oocitta, $oocrediti, $oovariazioni, $oocambi, $ooreg) = explode("<del>", $file[$_SESSION['uid']]);
		$surplus = INTVAL($oocrediti);
		$variazioni = INTVAL($oovariazioni);
		$cambi_effettuati = INTVAL($oocambi);

		$soldi_spendibili = $soldi_iniziali + $surplus + $variazioni - $soldi_spesi;

		if ($num_calciatori_comprabili <= 0 or $soldi_spendibili <= 0) { $acquisto = "NO"; }

		echo "<center><br/>FantaEuro disponibili: <b>$soldi_spendibili</b>.<br/>
		Numero di calciatori ancora acquistabili: <b>$num_calciatori_comprabili</b>.<br/></center>";

		if ($acquisto == "SI" and $duplicato != "SI") {
		echo "<br/><b>Valutazione ufficiale del calciatore</b><br/><br/>";
		echo "<form method='post' action='inserisci_acquisto.php'>
		Il valore di acquisto per <b>$nome</b> e di <b>$valore</b> FantaEuro.<br/><br/>
		<input type='hidden' name='valore_offerta' value='$valore' />
		<input type='hidden' name='num_calciatore' value='$num_calciatore' />
		<input type='hidden' name='xsquadra_ok' value='$xsquadra_ok' />
		<input type='hidden' name='valore_mercato' value='$valore' />
		<input type='submit' name='invia' value='Acquista' />
		</form><br/><br/><br/>";
		} # fine if ($acquisto == "SI" and $duplicato != "SI")

		else {
		echo "<br/><br/>Non si possono fare offerte per questo giocatore!<br/>";
		if ($duplicato == "SI") echo "Hai gi&agrave; acquistato il calciatore selezionato";
		if ($errore1) echo "Differenza di valutazione";
		}
		} # fine if ($chiusura_giornata != 1)
		else {
			echo "<br/><table align='center' bgcolor='$sfondo_tab' cellpadding='10' cellspacing='0' border='0' class='border'><tr><td class='testa'>Giornata chiusa</td></tr><tr><td>";
			echo "Non &egrave; pi&ugrave; consentito effettuare operazioni per questa giornata!<br/>Attendere fino a quando viene creata la prossima giornata.</td></tr></table>";
		}
	echo "</td></tr></table>";
	} # fine if ($_SESSION['valido'])...

include("./footer.php");
?>