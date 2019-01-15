<?php
##################################################################################
#    FANTACALCIOBAZAR
#    Copyright (C) 2003-2010 by Antonello Onida (fantacalcio@sssr.it)
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
require ("./controlla_pass.php");
require ("./header.php");

if ($_SESSION['valido'] == "SI") {

	require ("./menu.php");

	$chiusura_giornata = (INT) @file("$percorso_cartella_dati/chiusura_giornata.txt");

	if ($chiusura_giornata != 1) {

		######################################
		##### Controlla numero ultima giornata

		if ($stato_mercato != "I") {
			for ($num1 = "01" ; $num1 < 50 ; $num1++) {
				if (strlen($num1) == 1) $num1 = "0".$num1;
				$giornata = "giornata$num1";
				if (@is_file("$percorso_cartella_dati/$giornata")) $ultima_giornata = "";
				else {
					$ultima_giornata = $num1 - 1;
					if (strlen($ultima_giornata) == 1) $ultima_giornata = "0".$ultima_giornata;
					break;
				} # fine else
			} # fine for $num1
		} # if mercato iniziale

		if ($stato_mercato != "I" AND $ultima_giornata >= 1) {
			$cerca_valutazione = file("$percorso_cartella_voti/voti$ultima_giornata.txt");
			$calciatori = file("$percorso_cartella_dati/calciatori.txt");
			if (@is_file("$percorso_cartella_voti/voti$ultima_giornata.txt")) {
				$cerca_valutazione = file("$percorso_cartella_voti/voti$ultima_giornata.txt");
				$frase_voti = "Dati aggiornati all'ultima giornata";
			}
			else {
				$ultima_giornata--;
				$cerca_valutazione = file("$percorso_cartella_voti/voti$ultima_giornata.txt");
				$frase_voti = "<font color=red>Dati dell'ultima giornata ancora non presenti.</font><br> Valutazione alla giornata $ultima_giornata";
				$blocco=1;
			}
		}
		else {
			$cerca_valutazione = file("$percorso_cartella_dati/calciatori.txt");
			$calciatori = file("$percorso_cartella_dati/calciatori.txt");
			$frase_voti = "Dati di precampionato";
		}

		echo "<center><font size=5>Acquisto calciatori</font><br><u>$frase_voti</u></center><br>";

		if ($mercato_libero == "NO" AND $xsquadra_ok != "NO") {

			$mercato = @file("$percorso_cartella_dati/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");

			echo "<center><font class=evidenziato><b>Attenzione!!!</b><br>Confermando inserirai nella busta il giocatore.</font>.<br><br><br>";

			$trovato = "NO";
			$offribile = "SI";
			$soldi_spesi = 0;
			$num_calciatori_posseduti = 0;
			echo "<br><table width=\"70%\" border=1 cellspacing=2 cellpadding=2 class=border align=\"center\" bgcolor=\"$sfondo_tab\">
			<tr><td class=testa1>Num.</td>
			<td class=testa1>Nome</td>
			<td class=testa1>Ruolo</td>";

			$num_calciatori = count($mercato);
			for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
				$dati_calciatore = explode(",", $mercato[$num1]);
				$numero = $dati_calciatore[0];
				$proprietario = $dati_calciatore[4];

				if ($proprietario == $_SESSION['utente']) {
					$soldi_spesi = $soldi_spesi + $dati_calciatore[3];
					$num_calciatori_posseduti++;
				} # fine if ($proprietario == $_SESSION['utente'])

				if ($num_calciatore == $numero and $dati_calciatore[4] == $_SESSION['utente']) {
					$trovato = "SI";
					$nome = $dati_calciatore[1];
					$ruolo = $dati_calciatore[2];
					$costo = $dati_calciatore[3];
					$proprietario_vero = $proprietario;
					$tempo_off = $dati_calciatore[5];
					$anno_off = substr($tempo_off,0,4);
					$mese_off = substr($tempo_off,4,2);
					$giorno_off = substr($tempo_off,6,2);
					$ora_off = substr($tempo_off,8,2);
					$minuto_off = substr($tempo_off,10,2);
					$adesso = mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"));
					$sec_restanti = mktime($ora_off,$minuto_off,0,$mese_off,$giorno_off,$anno_off) - $adesso;

					if ($sec_restanti < 1) {
						$tempo_restante = "COMPRATO";
						$offribile = "SI";
						$trovato = "SI";
					} # fine if ($sec_restanti < 1)
					else {
						$tempo_restante="";
						$giorni=floor($sec_restanti/86400);
						$secondi_resto=$sec_restanti-($giorni*86400); 
						$ore=floor($secondi_resto/3600);
						$secondi_resto=$sec_restanti-($giorni*86400)-($ore*3600);
						$minuti= floor($secondi_resto/60);
						$secondi_resto = $sec_restanti-($giorni*86400)-($ore*3600)-$minuti*60;

						if ($giorni > 0) {
							if ($giorni > 1) $tempo_restante .= $giorni." giorni";
							else $tempo_restante .= $giorni." giorno";
						}

						if ($ore > 0) {
							if ($tempo_restante != "") $tempo_restante .= ", ";
							if ($ore > 1) $tempo_restante .= $ore." ore";
							else $tempo_restante .= $ore." ora";
						}

						if ($minuti > 0) {
							if ($tempo_restante != "") $tempo_restante .= ", ";
							if ($minuti > 1) $tempo_restante .= $minuti." minuti";
							else $tempo_restante .= $minuti." minuto";
						}

						if ($giorni == 0 AND $ore == 0 AND $minuti == 0 AND $secondi_resto > 0) $tempo_restante .= $secondi_resto." secondi";
						$vecchio_proprietario = $dati_calciatore[6];
						$vecchio_costo = $dati_calciatore[7];
						$nuovo_costo = $dati_calciatore[8];
					} # fine else if ($sec_restanti < 0)

					if ($vecchio_proprietario) { $proprietario_mostra = "$proprietario <font size=-2>(venduto da $vecchio_proprietario)</font>"; }
					else { $proprietario_mostra = $proprietario; }
					if ($nuovo_costo) { $costo_mostra = $nuovo_costo; }
					else { $costo_mostra = $costo; }

					echo"<tr><td align=center>$numero</td>
					<td>$nome</td>
					<td align=center><img src=\"./images/$ruolo.gif\" alt=\"$ruolo\" title=\"$ruolo\"></td></tr>";
				} # fine if ($num_calciatore == $numero)
			} # fine for $num1

			if ($trovato != "SI") {
				$nuova_offerta = "SI";
				$num_calciatori = count($calciatori);

				for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
					$dati_calciatore = explode($separatore_campi_file_calciatori, $calciatori[$num1]);
					$numero = $dati_calciatore[($num_colonna_numcalciatore_file_calciatori-1)];
					$numero = togli_acapo($numero);

					if ($num_calciatore == $numero) {
						$trovato = "SI";
						$nome = $dati_calciatore[($num_colonna_nome_file_calciatori-1)];
						$nome = togli_acapo($nome);
						$nome = ereg_replace("\"","",$nome);
						$s_ruolo = $dati_calciatore[($num_colonna_ruolo_file_calciatori-1)];
						$s_ruolo = togli_acapo($s_ruolo);
						$ruolo = $s_ruolo;
						if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
						if ($s_ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
						if ($s_ruolo == $simbolo_portiere_file_calciatori) $ruolo = "P";
						if ($s_ruolo == $simbolo_difensore_file_calciatori) $ruolo = "D";
						if ($s_ruolo == $simbolo_centrocampista_file_calciatori) $ruolo = "C";
						if ($s_ruolo == $simbolo_attaccante_file_calciatori) $ruolo = "A";
						echo"<tr><td>$numero</td>
						<td>$nome</td>
						<td><img src=\"./images/$ruolo.gif\" alt=\"$ruolo\" title=\"$ruolo\"></td></tr>";
					} # fine if ($num_calciatore == $numero)
				} # fine for $num1
			} # fine if ($trovato != "SI")
		} # fine     if ($mercato_libero == "NO" AND $xsquadra_ok != "NO")

		else {

			if ($stato_mercato != "I") $calciatori = @file("$percorso_cartella_voti/voti$ultima_giornata.txt");
			else $calciatori = @file("$percorso_cartella_dati/calciatori.txt");

			$mercato = @file("$percorso_cartella_dati/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");

			echo "<center><font class=evidenziato><b>Attenzione!!!</b><br>Confermando la procedura &egrave; irreversibile.<br>Procedere con cura leggendo attentamente tutti i messaggi che sono visualizzati.</font><br><br>";

			echo "<br><table width=\"70%\" border=1 cellspacing=2 cellpadding=2 class=border align=\"center\" bgcolor=\"$sfondo_tab\">
			<tr><td class=testa1>Num.</td>
			<td class=testa1>Nome</td>
			<td class=testa1>Ruolo</td>
			</tr>";

			$trovato = "NO";
			$offribile = "SI";
			$soldi_spesi = 0;
			$num_calciatori_posseduti = 0;
			$num_calciatori_mercato = count($mercato);

			for ($num1 = 0 ; $num1 < $num_calciatori_mercato ; $num1++) {
				$dati_calciatore = explode(",", $mercato[$num1]);
				$numero = $dati_calciatore[0];
				$proprietario = $dati_calciatore[4];

				if ($proprietario == $_SESSION['utente']) {
					$soldi_spesi = $soldi_spesi + $dati_calciatore[3];
					$num_calciatori_posseduti++;
				} # fine if ($proprietario == $_SESSION['utente'])
			} # fine for $num1

			###################################################
			$num_calciatori = count($calciatori);

			for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
				$dati_calciatore = explode(",", $calciatori[$num1]);
				$numero = $dati_calciatore[0];
				$proprietario = $dati_calciatore[4];

				if ($num_calciatore == $numero) {
					$trovato = "SI";
					$nome = $dati_calciatore[2];
					$nome = togli_acapo($nome);
					$ruolo = $dati_calciatore[5];
					$xsquadra = $dati_calciatore[3];
					$xsquadra = togli_acapo($xsquadra);
					$costo = $dati_calciatore[27];
					$nome = ereg_replace("\"","",$nome);
					$xsquadra = ereg_replace("\"","",$xsquadra);

					if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
					if ($ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
					if ($ruolo == $simbolo_portiere_file_calciatori) $ruolo = "P";
					if ($ruolo == $simbolo_difensore_file_calciatori) $ruolo = "D";
					if ($ruolo == $simbolo_centrocampista_file_calciatori) $ruolo = "C";
					if ($ruolo == $simbolo_attaccante_file_calciatori) $ruolo = "A";

					echo"<tr><td align=center>$numero</td>
					<td>$nome</td>
					<td align=center><img src=\"./images/$ruolo.gif\" alt=\"$ruolo\" title=\"$ruolo\"></td>
					<td align=center>$costo</td>
					<td align=center>$xsquadra</td></tr>";
					break;

				} # fine if ($num_calciatore == $numero)
			} # fine for $num1

			####################################################

			if ($trovato != "SI") {
				$nuova_offerta = "SI";
				$calciatori = file("$percorso_cartella_voti/calciatori.txt");
				$num_calciatori = count($calciatori);

				for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
					$dati_calciatore = explode($separatore_campi_file_calciatori, $calciatori[$num1]);
					$numero = $dati_calciatore[($num_colonna_numcalciatore_file_calciatori-1)];
					$numero = togli_acapo($numero);

					if ($num_calciatore == $numero) {
						$trovato = "SI";
						$nome = $dati_calciatore[($num_colonna_nome_file_calciatori-1)];
						$nome = togli_acapo($nome);
						$nome = ereg_replace("\"","",$nome);
						$s_ruolo = $dati_calciatore[($num_colonna_ruolo_file_calciatori-1)];
						$s_ruolo = togli_acapo($s_ruolo);
						$ruolo = $s_ruolo;
						if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
						if ($s_ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
						if ($s_ruolo == $simbolo_portiere_file_calciatori) $ruolo = "P";
						if ($s_ruolo == $simbolo_difensore_file_calciatori) $ruolo = "D";
						if ($s_ruolo == $simbolo_centrocampista_file_calciatori) $ruolo = "C";
						if ($s_ruolo == $simbolo_attaccante_file_calciatori) $ruolo = "A";
						echo"<tr><td>$numero</td>
						<td>$nome</td>
						<td><img src=\"./images/$ruolo.gif\" alt=\"$ruolo\" title=\"$ruolo\"></td>
						</tr>";
					} # fine if ($num_calciatore == $numero)
				} # fine for $num1
			} # fine if ($trovato != "SI")
		} # fine else if ($mercato_libero == "NO" AND $xsquadra_ok == "SI")

		if ($trovato != "SI") {
			$offribile = "NO";
			echo "<tr><td colspan=\"6\" align=center>Giocatore inesistente, sei un BARO!</td></tr>";
		} # fine if ($trovato != "SI")

		echo "</table>";

		if ($nuova_offerta == "SI" and $stato_mercato == "S") {
			$offribile = "NO";
			echo "<br><center><font class=evidenziato>Il mercato &egrave; <b>sospeso</b> in questo momento.<font></center><br>";
		} # fine if ($nuova_offerta == "SI" and $stato_mercato == "S")

		if ($stato_mercato == "C") {
			$offribile = "NO";
			echo "<br><center><font class=evidenziato>Il mercato &egrave; <b>chiuso</b> in questo  momento.</font></center><br>";
		} # fine if ($stato_mercato == "C")

		$num_calciatori_comprabili = $max_calciatori - $num_calciatori_posseduti;

		$file = file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
		@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$_SESSION['uid']]);

		$surplus = $ocrediti;
		$variazioni = $ovariazioni;
		$soldi_spendibili = $soldi_iniziali + $surplus + $variazioni - $soldi_spesi;

		if ($vecchio_proprietario == $_SESSION['utente'] and $vecchio_proprietario != $proprietario_vero) {
			$togliere_surplus = $vecchio_costo -  $costo;
			$frase_togliere = " (meno $togliere_surplus Fanta-Euro ricavati dalla vendita di questo giocatore)";
		} # fine if ($vecchio_proprietario == $_SESSION['utente'] and ...)

		if ($mod == "NO" AND ($num_calciatori_comprabili <= 0 or $soldi_spendibili <= 0)) { $offribile = "NO"; }
		print "<h1>$offribile</h1>";
		echo "<center><font class=evidenziato><br>FantaEuro ancora da spendere: <b>$soldi_spendibili</b> $frase_togliere.<br>
		Numero di calciatori ancora comperabili: <b>$num_calciatori_comprabili</b></font>.<br>";

		$scadenza = date("YmdHi");
		$a = join ('', file ("./dati/data_buste_".$_SESSION['torneo']."_0.txt"));
		if ($scadenza > $a) { echo "<center><font class=evidenziato><br> NON PUOI PI&Ugrave; FARE UNA OFFERTA PERCH&Eacute; &Egrave; STATA SUPERATA LA DATA DI CONSENGA DELLE BUSTE CHIUSE</font>";}
		if ($offribile == "SI" AND $stato_mercato == "B" AND $scadenza <= $a ) {
			echo "<center><br><form method=\"post\" action=\"busta_inserisci_offerta.php\">
			Fai una offerta per <b>$nome</b> di
			<input type=\"text\" name=\"valore_offerta\" size=\"8\">
			Fanta-Euro.<br>
			<input type=\"hidden\" name=\"num_calciatore\" value=\"$num_calciatore\">
			<input type=\"hidden\" name=\"mod\" value=\"$mod\">
			<input type=\"submit\" name=\"invia\" value=\"Invia\">
			</form>";
		} # fine if ($offribile == "SI"...

		if ($soldi_spendibili == "0")
		{ echo "<center><br><br><h4><font class=evidenziato>Non hai pi&ugrave; soldi per fare l'offerta. TOGLI dalla busta chiusa qualche giocatore per completare la rosa</h4></font><br>"; }


		if ($num_calciatori_comprabili == "0" AND $mod != "SI")
		{ echo "<center><br><br><h4><font class=evidenziato>Hai raggiunto il limite massimo di calciatori comperabili.</h4></font><br>"; }

	} # fine if ($chiusura_giornata != 1)
	else {
		echo "<br><br><br><center><h2>Giornata chiusa</h2></center>";
		echo "<p align=center>Non &egrave; pi&ugrave; consentito effettuare operazioni per questa giornata!<br><br>Attendere fino a quando viene creata la prossima giornata.</p>";
	}

} # fine if ($_SESSION...)
else echo"<meta http-equiv=\"refresh\" content=\"0; url=logout.php\">";

echo "</td></tr></table>";
include("footer.php");
?>