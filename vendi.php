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

	echo "<br /><br /><table summary='vendi' bgcolor='$sfondo_tab' align='center' cellpadding='20' width='98%'>
	<caption>Svincolo calciatore</caption><tr><td>";
	$chiusura_giornata = intval(@file("$percorso_cartella_dati/chiusura_giornata.txt"));

		if ($chiusura_giornata != 1) {

		echo "<font class=evidenziato><b>Attenzione!!!</b><br />Confermando la procedura &egrave; irreversibile</font>.<br />Procedere con cura leggendo attentamente tutti i messaggi che sono visualizzati.<br /><br />";

			if ($stato_mercato == "S") echo "<center>Il mercato &egrave; <b>sospeso</b> in questo momento.</center><br />";
			elseif ($stato_mercato == "C") echo "<center>Il mercato &egrave; <b>chiuso</b> in questo momento.</center><br />";
			elseif ($stato_mercato == "I") echo "<center><b>Fase preliminare.</b></center><br />";
			elseif ($stato_mercato == "R") echo "<center><b>Mercato di riparazione.</b></center><br />";
			elseif ($stato_mercato == "P") echo "<center><b>Mercato in asta perenne.</b></center><br />";

		$trovato = "NO";
		$num_calciatori_posseduti = 0;
		$soldi_spesi = 0;
		$calciatori = @file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
		$num_calciatori = count($calciatori);

			for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
			$dati_calciatore = explode(",", $calciatori[$num1]);
			$numero = $dati_calciatore[0];
			$proprietario = $dati_calciatore[4];

				if ($proprietario == $_SESSION['utente']) {
				$soldi_spesi = $soldi_spesi + $dati_calciatore[3];
				$num_calciatori_posseduti++;

					if ($num_calciatore == $numero) {
					$num_trovato = $numero;
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

						if ($sec_restanti < 1 or $stato_mercato = "R") { $trovato = "SI"; }
					} # fine if ($num_calciatore == $numero)
				} # fine if ($proprietario == $_SESSION['utente'])
			} # fine for $num1

		if ($trovato == "NO") {
		echo "<br /><center><h3>Giocatore non trovato<br />Non puoi vendere questo calciatore</h3></center><br /><br /><br /><br /><br /><br /><br />";
		} # fine if ($trovato == "NO")
		else {
			if ($mercato_libero == "SI") {
				if ($stato_mercato == "I" or squadra_ok =="NO"){
				echo "<center><b>CESSIONE AL COSTO<b></center></br>";
				echo "<center><h4>Svincolo calciatore</h4><br />Questa operazione consente di svincolare il calciatore <b>$nome</b> (Valore di mercato: $valore_vendita) per sostituirlo con un'altro disponibile.<br /><br /><font color=red><b>Procedere di seguito all'acquisto di un'altro calciatore.</b></font><br />
				<form method='post' action='vendi_subito.php'>
				<input type='hidden' name='prezzo_vendita' value='$prezzo_vendita' />
				<input type='hidden' name='num_calciatore' value='$num_calciatore' />
				<input type='submit' name='vendi_subito' value='Vendi subito' />
				 il calciatore <b>$nome</b> per <b>$prezzo_vendita</b> Fanta-Euro (comprato a <b>$costo</b> Fanta-Euro).<br />
				</form></center>";
				}
			}

			if ($mercato_libero == "NO") {

				if ($vendi_costo == "SI") {
				$prezzo_vendita = round(($costo/100)*$percentuale_vendita);
				$frase1 = "Lo svincolo &egrave; effettuato tenendo presente il $percentuale_vendita % del costo di acquisto.";
				$azione1 = "<center><b>CESSIONE AL COSTO</b></center></br>
				<center>Questa operazione consente di svincolare il calciatore <b>$nome</b> a <b>$prezzo_vendita FantaEuro</b> (Prezzo di acquisto: $costo) per sostituirlo con un'altro disponibile.<br /><br /><font color=red><b>Procedere di seguito all'acquisto di un'altro calciatore.</b></font><br />
				<form method='post' action='vendi_subito.php'>
				<input type='hidden' name='prezzo_vendita' value='$prezzo_vendita' />
				<input type='hidden' name='num_calciatore' value='$num_calciatore' />
				<input type='submit' name='vendi_subito' value='Vendi subito' />
				 il calciatore <b>$nome</b> per <b>$prezzo_vendita</b> Fanta-Euro (comprato a <b>$costo</b> Fanta-Euro).
				</form></center>";
				}

				elseif ($vendi_costo == "NO") {
					for ($num1 = 1; $num1 < 40 ; $num1++) {

						if (strlen($num1) == 1) $num1 = "0".$num1;
					$giornata = "giornata$num1";

						if (@is_file("$percorso_cartella_dati/$giornata")) {
						$ultima_giornata = "";
						} # fine if (is_file($giornata))
						else {
						$ultima_giornata = $num1 - 1;
							if (strlen($ultima_giornata) == 1) $ultima_giornata = "0".$ultima_giornata;
						break;
						} # fine else
					} # fine for $num1

					if (@is_file("$percorso_cartella_voti/voti$ultima_giornata.txt")) {
					$cerca_valutazione = file("$percorso_cartella_voti/voti$ultima_giornata.txt");
					}
					elseif ($ultima_giornata == "00" or $stato_mercato == "R") {
					$cerca_valutazione = file("$percorso_cartella_dati/calciatori.txt");
					}
					else {
					echo "<center><h3>DATI IN CORSO DI AGGIORNAMENTO</h3><br />Attendere il calcolo dei voti e l'aggiornamento delle quotazioni!</center><br />";
					include ("footer.php");
					exit;
					}


				$num_cer_val = count($cerca_valutazione);

					for ($num2 = 0 ; $num2 < $num_cer_val ; $num2++) {
					$dati_cervalcal = explode($separatore_campi_file_calciatori, $cerca_valutazione[$num2]);
					$num_cervalcal = $dati_cervalcal[($num_colonna_numcalciatore_file_calciatori-1)];
					$num_cervalcal = togli_acapo($num_cervalcal);

						if ($num_cervalcal == $num_trovato) {
						$valore_vendita = $dati_cervalcal[($num_colonna_valore_calciatori-1)];
						$valore_vendita = togli_acapo($valore_vendita);
						break;
						} # fine if
					} # fine for $num2

				$valutazione_vendita = round(($valore_vendita/100)*$percentuale_vendita);

				$cerca_costo = file("$percorso_cartella_dati/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
				$num_calciatori_mercato = count($cerca_costo);

					for ($num3 = 0 ; $num3 < $num_calciatori_mercato ; $num3++) {
					$dati_calciatore_mercato = explode(",", $cerca_costo[$num3]);

						if (count($dati_calciatore_mercato) >= 6) {
						$numero_mercato = $dati_calciatore_mercato[0];
						$nome_mercato = $dati_calciatore_mercato[1];
						$ruolo_mercato = $dati_calciatore_mercato[2];
						$costo_mercato = $dati_calciatore_mercato[3];
						$proprietario_mercato = $dati_calciatore_mercato[4];

							if ($proprietario_mercato == $_SESSION['utente'] and $numero_mercato == $num_calciatore) {
							$valore_acquisto = $costo_mercato;
							break;
							} # fine if ($proprietario == $_SESSION['utente'])
						} # fine if (count($dati_calciatore) >= 6)
					} # fine for $num3
				$prezzo_vendita = $valutazione_vendita;
				$frase1 = "Lo svincolo &egrave; effettuato tenendo presente il $percentuale_vendita % della valutazione dello stesso al momento di effettuazione dell'operazione.<br /> Siamo attualmente siamo alla giornata <b>$ultima_giornata</b>";
				$azione1 = "($numero_mercato) <b>$nome_mercato</b> - $ruolo_mercato<br />
				Proprietario attuale: $proprietario_mercato<br />
				Costo iniziale: $valore_acquisto<br />
				Valore vendita: $valore_vendita<br />
				Prezzo vendita: $prezzo_vendita<br />
				<br /><br /><center><form method='post' action='vendi_subito.php'>
				<input type='hidden' name='num_calciatore' value='$num_calciatore' />
				Vendi al mercato il calciatore <b>$nome</b> al prezzo di <b>$prezzo_vendita (Costo iniziale: $costo_mercato)</b> Fanta-Euro.<br /><br /><br />
				<input type='submit' name='rivendi' value='Rimetti sul mercato' />
				<input type='hidden' name='valore_rivendita' value='$prezzo_vendita' />
				</form></center>";
				} # fine elseif ($vendi_costo == "NO")
			} # fine if ($mercato_libero = "NO")
		echo "<table summary='vendi' border=1 class=border cellpadding=10 cellspacing=10 align=center bgcolor='$sfondo_tab'><tr><td>$frase1</td></tr><tr><td>$azione1</td></tr></table>";
		} # fine else ($trovato == "NO")
	} # fine if ($Chiusura_giornata != 1)

	else {
	echo "<center><h2>Giornata chiusa</h2></center>";
	echo "<p align=center>Non &egrave; pi&ugrave; consentito effettuare operazioni per questa giornata!<br /><br />Attendere fino a quando viene creata la prossima giornata.</p>";
	}

	echo "</td></tr></table></td></tr></table>";

} # fine elseif ($_SESSION['utente'] == "admin")
else echo"<meta http-equiv='refresh' content='0; url=logout.php'>";
echo"</td></tr></table>";

include("./footer.php");
?>