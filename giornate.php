<?php
// #################################################################################
// FANTACALCIOBAZAR EVOLUTION
// Copyright (C) 2003-2009 by Antonello Onida
//
// This program is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
// #################################################################################
require_once ("./controlla_pass.php");
include ("./header.php");

if ($_SESSION ['valido'] == "SI") {
	// require("./menu.php");
	$chiusura_giornata = ( int ) @file ( $percorso_cartella_dati . "/chiusura_giornata.txt" );
	// if ($chiusura_giornata >= 0) {
	if ($_GET ['opzione'] != 2 and $_GET ['opzione'] != 3)
	$opzione = 3;
	else
	$opzione = $_GET ['opzione'];

	if ($opzione == 2) {

		if (! $_GET ['nome_squadra'])
		$nome_squadra = "tutti";
		else
		$nome_squadra = $_GET ['nome_squadra'];

		$file = file ( $percorso_cartella_dati . "/utenti_" . $_SESSION ['torneo'] . ".php" );
		$linee = count ( $file );

		for($num1 = 1; $num1 < $linee; $num1 ++) {
			@list ( $outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg ) = explode ( "<del>", $file [$num1] );

			if ($nome_squadra == "tutti" or $nome_squadra == $outente) {

				if ($num1 % 2)
				$colore = "white";
				else
				$colore = $colore_riga_alt;

				$contatore_calciatori = 0;
				$soldi_spesi = 0;
				$num_calciatori_posseduti = 0;
				$np = 0;
				$nd = 0;
				$nc = 0;
				$nf = 0;
				$na = 0;
				$calciatori = @file ( $percorso_cartella_dati . "/mercato_" . $_SESSION ['torneo'] . "_0.txt" );
				$np = 0;
				$nd = 0;
				$nc = 0;
				$nf = 0;
				$na = 0;
				$num_calciatori = count ( $calciatori );
				for($num2 = 0; $num2 < $num_calciatori; $num2 ++) {
					$dati_calciatore = explode ( ",", $calciatori [$num2] );
					$numero = $dati_calciatore [0];
					$ruolo = $dati_calciatore [2];
					$proprietario = $dati_calciatore [4];

					if ($proprietario == $outente) {
						$soldi_spesi = $soldi_spesi + $dati_calciatore [3];

						$num_calciatori_posseduti ++;
						if ($ruolo == "P")
						$np ++;
						else if ($ruolo == "D")
						$nd ++;
						else if ($ruolo == "C")
						$nc ++;
						else if ($ruolo == "F")
						$nf ++;
						else if ($ruolo == "A")
						$na ++;

						$nome = stripslashes ( $dati_calciatore [1] );
						$ruolo = $dati_calciatore [2];
						$costo = $dati_calciatore [3];
						$tempo_off = $dati_calciatore [5];
						$anno_off = substr ( $tempo_off, 0, 4 );
						$mese_off = intval(substr ( $tempo_off, 4, 2 ));
						$giorno_off = substr ( $tempo_off, 6, 2 );
						$ora_off = substr ( $tempo_off, 8, 2 );
						$minuto_off = substr ( $tempo_off, 10, 2 );
						$adesso = mktime ( date ( "H" ), date ( "i" ), 0, date ( "m" ), date ( "d" ), date ( "Y" ) );
						$sec_restanti = mktime ( $ora_off, $minuto_off, 0, $mese_off, $giorno_off, $anno_off ) - $adesso;
						$lista_calciatori [$contatore_calciatori] = $numero;
						$contatore_calciatori ++;
						$nome_linea = "linea_comprato_$ruolo";
						${$nome_linea} [$numero] = "<tr><td align='center'>$numero</td><td>$nome</td><td align='center'>$ruolo</td><td align='center'>$costo</td></tr>";
					} // fine if ($proprietario == $outente)
				} // fine for $num2

				// ########################################################
				$tab_centro = "<table width='100%' border='0' cellspacing='1' cellpadding='1' align='left' summary=''><tr>
				<td class='testa'>Num.</td>
				<td class='testa'>Nome giocatore</td>
				<td class='testa'>Ruolo</td>
				<td class='testa'>Costo</td>";
				$colspan = 5;
				$tab_centro .= "</tr>
				<tr><td align='center' colspan='$colspan'><b>Titolari</b></td></tr>";

				$dati_squadra = @file ( $percorso_cartella_dati . "/squadra_" . $outente );
				$titolari = explode ( ",", $dati_squadra [1] );

				// tabella dei titolari
				$num_titolari = count ( $titolari );
				$num_pos = 1;

				for($num2 = 0; $num2 < $num_titolari; $num2 ++) {
					$numero_titolare = $titolari [$num2];
					if ($linea_comprato_P [$numero_titolare]) {
						$num_pos ++;
						$tab_titolari_P .= $linea_comprato_P [$numero_titolare];
						$inserito [$numero_titolare] = "SI";
					} // fine if ($linea_comprato_P[$numero_titolare])
					if ($linea_comprato_D [$numero_titolare]) {
						$num_pos ++;
						$tab_titolari_D .= $linea_comprato_D [$numero_titolare];
						$inserito [$numero_titolare] = "SI";
					} // fine if ($linea_comprato_D[$numero_titolare])
					if ($linea_comprato_C [$numero_titolare]) {
						$num_pos ++;
						$tab_titolari_C .= $linea_comprato_C [$numero_titolare];
						$inserito [$numero_titolare] = "SI";
					} // fine if ($linea_comprato_C[$numero_titolare])
					if ($linea_comprato_F [$numero_titolare]) {
						$num_pos ++;
						$tab_titolari_F .= $linea_comprato_F [$numero_titolare];
						$inserito [$numero_titolare] = "SI";
					} // fine if ($linea_comprato_F[$numero_titolare])
					if ($linea_comprato_A [$numero_titolare]) {
						$num_pos ++;
						$tab_titolari_A .= $linea_comprato_A [$numero_titolare];
						$inserito [$numero_titolare] = "SI";
					} // fine if ($linea_comprato_A[$numero_titolare])
				} // fine for $num2
				$tab_centro .= $tab_titolari_P . $tab_titolari_D . $tab_titolari_C . $tab_titolari_F . $tab_titolari_A;

				// Tabella dei panchinari
				$tab_centro .= "<tr bgcolor='$colore'><td align='center' colspan='$colspan'><b>In panchina</b></td></tr>";
				$panchinari = explode ( ",", $dati_squadra [2] );
				$num_panchinari = count ( $panchinari );
				$tab_panchinari_P = "";
				$tab_panchinari_D = "";
				$tab_panchinari_C = "";
				$tab_panchinari_F = "";
				$tab_panchinari_A = "";
				$tab_panchinari = "";
				for($num2 = 0; $num2 < $num_panchinari; $num2 ++) {
					$numero_panchinaro = $panchinari [$num2];
					$num_in_panchina = $num2 + 1;
					if ($linea_comprato_P [$numero_panchinaro]) {
						$linea_comprato_P [$numero_panchinaro] = preg_replace ( "#value='panchinaro'#", "value='panchinaro' checked", $linea_comprato_P [$numero_panchinaro] );
						$linea_comprato_P [$numero_panchinaro] = preg_replace ( "#option value='$num_in_panchina'#", "option value='$num_in_panchina' selected", $linea_comprato_P [$numero_panchinaro] );
						$linea_comprato_P [$numero_panchinaro] = preg_replace ( "#<tr bgcolor='$colore'><td>&nbsp;</td>#", "<tr bgcolor='$colore'><td align='center'>$num_pos</td>", $linea_comprato_P [$numero_panchinaro] );
						$num_pos ++;
						$tab_panchinari .= $linea_comprato_P [$numero_panchinaro];
						$inserito [$numero_panchinaro] = "SI";
					} // fine if ($linea_comprato_P[$numero_panchinaro])
					if ($linea_comprato_D [$numero_panchinaro]) {
						$linea_comprato_D [$numero_panchinaro] = preg_replace ( "#value='panchinaro'#", "value='panchinaro' checked", $linea_comprato_D [$numero_panchinaro] );
						$linea_comprato_D [$numero_panchinaro] = preg_replace ( "#option value='$num_in_panchina'#", "option value='$num_in_panchina' selected", $linea_comprato_D [$numero_panchinaro] );
						$linea_comprato_D [$numero_panchinaro] = preg_replace ( "#<tr bgcolor='$colore'><td>&nbsp;</td>#", "<tr bgcolor='$colore'><td align='center'>$num_pos</td>", $linea_comprato_D [$numero_panchinaro] );
						$num_pos ++;
						$tab_panchinari .= $linea_comprato_D [$numero_panchinaro];
						$inserito [$numero_panchinaro] = "SI";
					} // fine if ($linea_comprato_D[$numero_panchinaro])
					if ($linea_comprato_C [$numero_panchinaro]) {
						$linea_comprato_C [$numero_panchinaro] = preg_replace ( "#value='panchinaro'#", "value='panchinaro' checked", $linea_comprato_C [$numero_panchinaro] );
						$linea_comprato_C [$numero_panchinaro] = preg_replace ( "#option value='$num_in_panchina'#", "option value='$num_in_panchina' selected", $linea_comprato_C [$numero_panchinaro] );
						$linea_comprato_C [$numero_panchinaro] = preg_replace ( "#<tr bgcolor='$colore'><td>&nbsp;</td>#", "<tr bgcolor='$colore'><td align='center'>$num_pos</td>", $linea_comprato_C [$numero_panchinaro] );
						$num_pos ++;
						$tab_panchinari .= $linea_comprato_C [$numero_panchinaro];
						$inserito [$numero_panchinaro] = "SI";
					} // fine if ($linea_comprato_C[$numero_panchinaro])
					if ($linea_comprato_F [$numero_panchinaro]) {
						$linea_comprato_F [$numero_panchinaro] = preg_replace ( "#value='panchinaro'#", "value='panchinaro' checked", $linea_comprato_F [$numero_panchinaro] );
						$linea_comprato_F [$numero_panchinaro] = preg_replace ( "#option value='$num_in_panchina'#", "option value='$num_in_panchina' selected", $linea_comprato_F [$numero_panchinaro] );
						$linea_comprato_F [$numero_panchinaro] = preg_replace ( "#<tr bgcolor='$colore'><td>&nbsp;</td>#", "<tr bgcolor='$colore'><td align='center'>$num_pos</td>", $linea_comprato_F [$numero_panchinaro] );
						$num_pos ++;
						$tab_panchinari .= $linea_comprato_F [$numero_panchinaro];
						$inserito [$numero_panchinaro] = "SI";
					} // fine if ($linea_comprato_F[$numero_panchinaro])
					if ($linea_comprato_A [$numero_panchinaro]) {
						$linea_comprato_A [$numero_panchinaro] = preg_replace ( "#value='panchinaro'#", "value='panchinaro' checked", $linea_comprato_A [$numero_panchinaro] );
						$linea_comprato_A [$numero_panchinaro] = preg_replace ( "#option value='$num_in_panchina'#", "option value='$num_in_panchina' selected", $linea_comprato_A [$numero_panchinaro] );
						$linea_comprato_A [$numero_panchinaro] = preg_replace ( "#<tr bgcolor='$colore'><td>&nbsp;</td>#", "<tr bgcolor='$colore'><td align='center'>$num_pos</td>", $linea_comprato_A [$numero_panchinaro] );
						$num_pos ++;
						$tab_panchinari .= $linea_comprato_A [$numero_panchinaro];
						$inserito [$numero_panchinaro] = "SI";
					} // fine if ($linea_comprato_A[$numero_panchinaro])
				} // fine for $num2
				// echo $tab_panchinari_P.$tab_panchinari_D.$tab_panchinari_C.$tab_panchinari_A;
				$tab_centro .= $tab_panchinari;

				// Tabella degli esclusi
				$tab_centro .= "<tr bgcolor='$colore'><td align='center' colspan='$colspan'><b>Tribuna</b></td></tr>" . $acapo;
				$tab_fuori_P = "";
				$tab_fuori_D = "";
				$tab_fuori_C = "";
				$tab_fuori_F = "";
				$tab_fuori_A = "";
				$num_calciatori = count ( $lista_calciatori );
				for($num2 = 0; $num2 < $num_calciatori; $num2 ++) {
					$numero_fuori = $lista_calciatori [$num2];
					if ($inserito [$numero_fuori] != "SI") {
						if ($linea_comprato_P [$numero_fuori]) {
							$linea_comprato_P [$numero_fuori] = preg_replace ( "#value='fuori'#", "value='fuori' checked", $linea_comprato_P [$numero_fuori] );
							$tab_fuori_P .= $linea_comprato_P [$numero_fuori];
							$inserito [$numero_fuori] = "SI";
						} // fine if ($linea_comprato_P[$numero_fuori])
						if ($linea_comprato_D [$numero_fuori]) {
							$linea_comprato_D [$numero_fuori] = preg_replace ( "#value='fuori'#", "value='fuori' checked", $linea_comprato_D [$numero_fuori] );
							$tab_fuori_D .= $linea_comprato_D [$numero_fuori];
							$inserito [$numero_fuori] = "SI";
						} // fine if ($linea_comprato_D[$numero_fuori])
						if ($linea_comprato_C [$numero_fuori]) {
							$linea_comprato_C [$numero_fuori] = preg_replace ( "#value='fuori'#", "value='fuori' checked", $linea_comprato_C [$numero_fuori] );
							$tab_fuori_C .= $linea_comprato_C [$numero_fuori];
							$inserito [$numero_fuori] = "SI";
						} // fine if ($linea_comprato_C[$numero_fuori])
						if ($linea_comprato_F [$numero_fuori]) {
							$linea_comprato_F [$numero_fuori] = preg_replace ( "#value='fuori'#", "value='fuori' checked", $linea_comprato_F [$numero_fuori] );
							$tab_fuori_F .= $linea_comprato_F [$numero_fuori];
							$inserito [$numero_fuori] = "SI";
						} // fine if ($linea_comprato_F[$numero_fuori])
						if ($linea_comprato_A [$numero_fuori]) {
							$linea_comprato_A [$numero_fuori] = preg_replace ( "#value='fuori'#", "value='fuori' checked", $linea_comprato_A [$numero_fuori] );
							$tab_fuori_A .= $linea_comprato_A [$numero_fuori];
							$inserito [$numero_fuori] = "SI";
						} // fine if ($linea_comprato_A[$numero_fuori])
					} // fine if ($inserito[$num_fuori] != "SI")
				} // fine for $num2
				$tab_centro .= $tab_fuori_P . $tab_fuori_D . $tab_fuori_C . $tab_fuori_F . $tab_fuori_A;

				if ($nome_squadra) {
					$messaggi = @file ( $percorso_cartella_dati . "/registro_mercato_" . $_SESSION ['torneo'] . "_0.txt" );
					$num_messaggi = count ( $messaggi );
					$num_iniziale = 0;

					for($num3 = $num_iniziale; $num3 < $num_messaggi; $num3 ++) {
						$messaggio = explode ( "#@?", $messaggi [$num3] );
						$nome = stripslashes ( $messaggio [0] );
						$data = stripslashes ( $messaggio [1] );
						$testo_messaggio = stripslashes ( $messaggio [2] );
						if ($stato_mercato != "I" and strpos ( $nome, $nome_squadra ) !== false)
						$messmerc .= "$nome<br/>";
					} // fine for $num3

					$messmerc = preg_replace ( "#Radio mercato: #", "", $messmerc );
					$messmerc = preg_replace ( "#$nome_squadra ha#", "", $messmerc );
				}
				// #######################
				// Layout pagina

				$titolo = "<font size='+1'><u>";
				if ($osquadra)
				$titolo .= "$osquadra";
				else
				$titolo .= "Squadra";
				$titolo .= " di $outente</u></font>";
				$titolo .= "<br /><br />Presidente: <b>$outente</b>";
				if ($ocitta)
				$titolo .= "<br />Citt&agrave;: <b>$ocitta</b>";
				if ($ourl and $ourl != "http://")
				$titolo .= "<br />Sito Web: <b>$ourl</b>";
				$titolo .= "<br />Email: <b>$oemail</b>";
				$titolo .= "<br />Data iscrizione: $oreg";

				echo "<table width='100%' bgcolor='$sfondo_tab' border='1' cellpadding='5' align='center' summary=''>
				<tr>
				<td valign='top' width='55%'>
				<div style='float:none'>
				<img src='./fantacampo.php?riduci=50&amp;iutente=$outente&amp;noinfo=1' align='right' alt='La tua squadra in campo' title='La tua squadra in campo' />
				$titolo
				</div>
				<div style='clear:both'><u><b>Operazioni effettuate</b></u><br /><font size='-2'>$messmerc</font>
				</div></td>
				<td valign='top' width='45%'>$tab_centro</table>
				</td>
				</tr></table>";
				unset ( $titolo, $tab_centro, $messmerc );
				// #######################

				echo "<br/><hr width='95%' />";
			}
		} // fine for $num1
	} // ######################
	elseif ($opzione == 3) {
		echo '<div class="container" style="width: 85%;margin-top: -10px;">
		<div class="card-panel">
		<div class="row">';
		
		require ("./widget.php");
		echo'<div class="col m9">';
		echo"<div class='bread'><a href='./mercato.php'>Gestione</a> / Campionato</div><br>";
		echo"
		<div class='card'>
		<div class='card-content'>
		<span class='card-title'>Campionato<span style='font-size: 13px;'> - Riepilogo delle giornate disputate</span></span>
		<hr>
		<div class='row'>
		<div style='background-color: $sfondo_tab; margin-top:5px; margin-bottom:5px; padding: 5px; border: 1px solid $sfondo_tab2'>Giornate giocate:&nbsp;" . $acapo;

		for($num1 = 1; $num1 < 40; $num1 ++) {
			if (strlen ( $num1 ) == 1)
			$num1 = "0" . $num1;
			$giornata_controlla = "giornata$num1";
			if (! @is_file ( $percorso_cartella_dati . "/" . $giornata_controlla . "_" . $_SESSION ['torneo'] . "_0" ))
			break;
			else {
				echo "<a href='?opzione=$opzione&amp;giornata=$num1'>&nbsp;$num1&nbsp;</a>&nbsp;" . $acapo;
				$giornata_ultima = $num1;
			}
		} // fine for $num1
		echo "</div>";

		if (! $giornata or $giornata > $giornata_ultima)
		$giornata = "$giornata_ultima";

		$tab_formazioni = "<tr>";
		$num_colonne = 0;
		$num2 = 0;
		$leggendo_formazioni = "SI";
		$leggendo_punteggi = "NO";
		$leggendo_voti = "NO";
		$leggendo_scontri = "NO";
		$voti_esistenti = "NO";

		if ($giornata)
		$file_giornata = file ( $percorso_cartella_dati . "/giornata" . $giornata . "_" . $_SESSION ['torneo'] . "_0" );
		$num_linee_file_giornata = count ( $file_giornata );

		for($num1 = 0; $num1 < $num_linee_file_giornata; $num1 ++) {
			$linea = trim ( $file_giornata [$num1] );
			if ($linea == "#@& fine formazioni #@&")
			$leggendo_formazioni = "NO";
			if ($leggendo_formazioni == "SI") {
				if ($linea == "#@& formazione #@&")
				$giocatore = "";
				if ($giocatore) {
					${$formazione} [$num2] = $file_giornata [$num1];
					$num2 ++;
				} // fine if ($giocatore)
				if ($aggiorna_giocatore) {
					$giocatore = $linea;
					$formazione = "formazione_$giocatore";
					$num2 = 0;
					$aggiorna_giocatore = "";
				} // fine if ($aggiorna_giocatore)
				if ($linea == "#@& formazione #@&")
				$aggiorna_giocatore = "SI";
			} // fine if ($leggendo_formazioni == "SI")

			if ($linea == "#@& fine voti #@&")
			$leggendo_voti = "NO";
			if ($leggendo_voti == "SI") {
				$voti [$num2] = $linea;
				$num2 ++;
			} // fine if ($leggendo_voti == "SI")
			if ($linea == "#@& voti #@&") {
				$leggendo_voti = "SI";
				$voti_esistenti = "SI";
				$num2 = 0;
			} // fine if ($linea == "#@& voti #@&")

			if ($linea == "#@& fine modificatore #@&")
			$leggendo_modificatore = "NO";
			if ($leggendo_modificatore == "SI") {
				$modificatore [$num2] = $linea;
				$num2 ++;
			} // fine if ($leggendo_modificatore == "SI")
			if ($linea == "#@& modificatore #@&") {
				$leggendo_modificatore = "SI";
				$modificatore_esistenti = "SI";
				$num2 = 0;
			} // fine if ($linea == "#@& modificatore #@&")

			if ($linea == "#@& fine punteggi #@&")
			$leggendo_punteggi = "NO";
			if ($leggendo_punteggi == "SI") {
				$punteggi [$num2] = $linea;
				$num2 ++;
			} // fine if ($leggendo_punteggi == "SI")
			if ($linea == "#@& punteggi #@&") {
				$leggendo_punteggi = "SI";
				$punteggi_esistenti = "SI";
				$num2 = 0;
			} // fine if ($linea == "#@& punteggi #@&")

			if ($linea == "#@& fine scontri #@&")
			$leggendo_scontri = "NO";
			if ($leggendo_scontri == "SI") {
				$scontri [$num2] = $linea;
				$num2 ++;
			} // fine if ($leggendo_scontri == "SI")
			if ($linea == "#@& scontri #@&") {
				$leggendo_scontri = "SI";
				$scontri_esistenti = "SI";
				$num2 = 0;
			} // fine if ($linea == "#@& scontri #@&")
		} // fine for $num1

		$file = file ( $percorso_cartella_dati . "/utenti_" . $_SESSION ['torneo'] . ".php" );
		$linee = count ( $file );
		for($num1 = 1; $num1 < $linee; $num1 ++) {
			@list ( $outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg ) = explode ( "<del>", $file [$num1] );
			if ($opermessi != - 1) {
				$nome_posizione [$num1] = $outente;
				$soprannome_squadra = $osquadra;

				if ($soprannome_squadra) {
					$nome_squadra_memo [$outente] = $soprannome_squadra;
					$soprannome_squadra = "<b>" . $soprannome_squadra . "</b>";
				} // fine if ($soprannome_squadra)
				else {
					$soprannome_squadra = "Squadra";
					$nome_squadra_memo [$outente] = $outente;
				} // fine else if ($soprannome_squadra)

				if ($num_colonne >= 2) {
					$tab_formazioni .= "</tr><tr>";
					$num_colonne = 0;
				} // fine if ($num_colonne >= 2)

				$num_colonne ++;
				$tab_formazioni .= "<td align='left' valign='top'><a name='$outente'></a>
				<table width='100%' cellpadding='3' cellspacing='1' bgcolor='$sfondo_tab' align='center' summary=''>
				<caption>$soprannome_squadra di $outente</caption>
				<tr><td><font size='-2'><u>Calciatore</u></font></td>
				<td align='center'><font size='-2'>Fanta<br/>voto</font></td>
				<td align='center'><font size='-2'>Voto<br/>giornale</font></td>
				</tr>" . $acapo;
				$formazione = "formazione_$outente";
				$formazione = $$formazione;
				$num_linee_formazione = count ( $formazione );

				for($num2 = 0; $num2 < $num_linee_formazione; $num2 ++) {
					$riga_calciatore = explode ( ",", $formazione [$num2] );
					$nome_calciatore = stripslashes ( $riga_calciatore [1] );
					if ($num2 % 2)
					$colore = "#FFFFFF";
					else
					$colore = $colore_riga_alt;
					$tab_formazioni .= "<tr bgcolor='$colore'><td>" . $riga_calciatore [2] . "&nbsp;&nbsp;&nbsp;$nome_calciatore</td><td align='center'>" . $riga_calciatore [3] . "</td><td align='center'>" . $riga_calciatore [4] . "</td></tr>" . $acapo;
				} // fine for $num2
				$tab_formazioni .= "</table><div align='right'><a href='#top'>^ Top</a></div></td>" . $acapo;
			}
		} // fine for $num1

		for($num1 = $num_colonne; $num1 < 2; $num1 ++)
		$tab_formazioni .= "<td>&nbsp;</td>" . $acapo;
		$tab_formazioni .= "</tr>";
		$tipo_campionato = "";
		$num_giornata = str_replace ( "giornata", "", $giornata );

		if (substr ( $num_giornata, 0, 1 ) == 0)
		$num_giornata = substr ( $num_giornata, 1 );
		$num_campionati = count ( $campionato );
		reset ( $campionato );

		for($num1 = 0; $num1 < $num_campionati; $num1 ++) {
			$key_campionato = key ( $campionato );
			$giornate_campionato = explode ( "-", $key_campionato );
			if ($num_giornata <= $giornate_campionato [1] and $num_giornata >= $giornate_campionato [0]) {
				$num_giornata_campionato = $num_giornata - $giornate_campionato [0] + 1;
				$tipo_campionato = $campionato [$key_campionato];
				$g_inizio_campionato = $giornate_campionato [0];
				break;
			} // fine if ($num_giornata <= $giornate_campionato[1] and...
			next ( $campionato );
		} // fine for $num1

		if (! $tipo_campionato)
		$tipo_campionato = "N";

		if ($tipo_campionato == "S") {
			echo "<table style='background-color: $sfondo_tab; margin-top:5px; margin-bottom:5px; padding: 2px; border: 1px solid $sfondo_tab2' width='50%' align='left' summary=''>" . $acapo;
			echo "<caption>Giornata $num_giornata_campionato</caption>" . $acapo;
			echo "<tr><th width='50%' align='center'><b>Partite</b></th><th align='center'><b>Risultato</b></th></tr>" . $acapo;
			$partite = "";
			$marcotori = "";
			$num_scontri = count ( $scontri );
			for($num1 = 0; $num1 < $num_scontri; $num1 ++) {
				$dati_scontri = explode ( "##@@&&", $scontri [$num1] );
				echo "<tr><td align='center'>";
				if ($_SESSION ['utente'] == $dati_scontri [0])
				echo "<b>";
				echo $nome_squadra_memo [$dati_scontri [0]];
				if ($_SESSION ['utente'] == $dati_scontri [0])
				echo "</b>";
				echo " - ";
				if ($_SESSION ['utente'] == $dati_scontri [1])
				echo "<b>";
				echo $nome_squadra_memo [$dati_scontri [1]];
				if ($_SESSION ['utente'] == $dati_scontri [1])
				echo "</b>";
				echo "</td>
				<td align='center'>" . $dati_scontri [2] . " - " . $dati_scontri [3] . "</td></tr>" . $acapo;
			} // fine for $num1
			echo "</table>" . $acapo;
		} // fine if ($tipo_campionato == "S")

		// ##############################################

		if ($voti_esistenti == "SI") {
			$dati_giornata = array ();
			$giorn_ata = substr ( $giornata, - 2 );
			$num_voti = count ( $voti );
			for($num1 = 0; $num1 < $num_voti; $num1 ++) {
				$dati_voti = explode ( "##@@&&", $voti [$num1] );
				settype ( $dati_voti [1], "float" );
				$voto [$dati_voti [0]] = $dati_voti [1];
			} // fine for $num1
			arsort ( $voto );
			reset ( $voto );
			while ( list ( $key, $val ) = each ( $voto ) ) {
				$dati_giornata [$key] ['v'] = $val;
			} // fine while

			if ($modificatore_difesa == "SI") {
				$num_mod = count ( $modificatore );
				for($num1 = 0; $num1 < $num_mod; $num1 ++) {
					$dati_mod = explode ( "##@@&&", $modificatore [$num1] );
					settype ( $dati_mod [1], "float" );
					$dati_giornata [$dati_mod [0]] ['m'] = $dati_mod [1];

					$mod [$dati_mod [0]] = $dati_mod [1];
				} // fine for $num1
			} // fine if modificatore difesa

			if ($tipo_campionato == "P") {
				$num_punteggi = count ( $punteggi );
				// echo "<td align='left' valign='top'><b><u>Punteggio</u></b><br/>";
				for($num1 = 0; $num1 < $num_punteggi; $num1 ++) {
					$dati_punteggi = explode ( "##@@&&", $punteggi [$num1] );
					settype ( $dati_punteggi [1], "float" );
					$punteggio [$dati_punteggi [0]] = $dati_punteggi [1];
					$dati_giornata [$dati_punteggi [0]] ['p'] = $dati_punteggi [1];
				} // fine for $num1
				/*
				* arsort ($punteggio);
				* reset ($punteggio);
				* while (list ($key, $val) = each ($punteggio)) {
				* echo "$val<br/>";
				* } # fine while
				* echo "</td>";
				*/
			} // fine if ($tipo_campionato == "P")

			// calcolo la classifica fino a questa giornata
			if ($tipo_campionato != "N") {
				$punti = array ();
				for($num1 = $g_inizio_campionato; $num1 <= $num_giornata; $num1 ++) {
					if (strlen ( $num1 ) == 1)
					$num1 = "0" . $num1;
					$giornata_punti = "giornata$num1";
					if (is_file ( $percorso_cartella_dati . "/" . $giornata_punti . "_" . $_SESSION ['torneo'] . "_0" )) {
						$file_giornata_p = file ( $percorso_cartella_dati . "/" . $giornata_punti . "_" . $_SESSION ['torneo'] . "_0" );
						$num_linee_file_giornata_p = count ( $file_giornata_p );
						$leggendo_punteggi = "NO";
						$punteggi_esistenti_p = "NO";
						for($num2 = 0; $num2 < $num_linee_file_giornata_p; $num2 ++) {
							$linea = trim ( $file_giornata_p [$num2] );
							if ($linea == "#@& fine punteggi #@&")
							$leggendo_punteggi = "NO";
							if ($leggendo_punteggi == "SI") {
								$punteggi_p [$num3] = $file_giornata_p [$num2];
								$num3 ++;
							} // fine if ($leggendo_punteggi == "SI")
							if ($linea == "#@& punteggi #@&") {
								$leggendo_punteggi = "SI";
								$punteggi_esistenti_p = "SI";
								$num3 = 0;
							} // fine if ($leggendo_punteggi == "SI")
						} // fine for $num1
						if ($punteggi_esistenti_p == "SI") {
							$num_punteggi_p = count ( $punteggi_p );
							for($num2 = 0; $num2 < $num_punteggi_p; $num2 ++) {
								$dati_punteggio = explode ( "##@@&&", $punteggi_p [$num2] );
								settype ( $dati_punteggio [1], "float" );
								$punti [$dati_punteggio [0]] = ($punti [$dati_punteggio [0]] + $dati_punteggio [1]);
							} // fine for $num2
						} // fine if ($punteggi_esistenti_p == "SI")
					} // fine if (@is_file("$percorso_cartella_dati/$giornata_punti"))
				} // fine for $num1

				echo "<script type='text/javascript' src='./inc/js/ordina_tabella.js'></script>" . $acapo;
				echo "<table summary='' cellpadding='3' style='background-color: $sfondo_tab; margin-top:5px; margin-bottom:5px; border: 1px solid $sfondo_tab2' align='center' id='t1' class='sortable'><tr>
				<th>Pos</th><th>Classifica: $num_giornata_campionato</th><th>Punti</th><th>Voti</th><th>Mod</th><th>Pg</th></tr>" . $acapo;
				arsort ( $punti );
				reset ( $punti );
				$posclas = 0;
				while ( list ( $key, $val ) = each ( $punti ) ) {
					$posclas ++;
					echo "<tr><td align='right'>" . round ( $posclas ) . "</td>
					<td><a href='?opzione=2&amp;nome_squadra=" . $key . "'>" . $nome_squadra_memo [$key] . "</a></td>
					<td align='center' style='background-color: #C0C0C0'>$val</td>
					<td align='center'><a href='#" . $key . "'>" . $dati_giornata [$key] ['v'] . "</a></td>
					<td align='center'>" . $dati_giornata [$key] ['m'] . "</td>
					<td align='center'>" . $dati_giornata [$key] ['p'] . "</td>
					</tr>" . $acapo;
				} // fine while
			} // fine if ($tipo_campionato != "N")
			echo "</table>" . $acapo;
		} // fine if ($voti_esistenti == "SI")

		echo "<table align='center' width='100%' bgcolor='$sfondo_tab' border='1' cellpadding='0' cellspacing='0' summary=''>
		<caption>Giornata $giornata</caption>
		$tab_formazioni</table>" . $acapo;
	}
} // fine if ($_SESSION["utente"]
else
header ( "Location: ./logout.php" );
include ("./footer.php");
?>