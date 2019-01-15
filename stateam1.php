<?php
##################################################################################
#    FANTACALCIOBAZAR EVOLUTION
#    Copyright (C) 2003-2006 by Antonello Onida (fantacalcio@sassarionline.net)
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
#
#
# 07-09-03  fire@dabrosca.net :
# 	per ogni giocatore cerca nei file voti e visualizza :
#
#Num
#Nome
#Ruolo
#Partite
#Media
#Gol
#Gialli
#Rossi
#Rigori
#Assist
#MediaFC
#
##################################################################################
require_once("./controlla_pass.php");
include("./header.php");

if ($_SESSION['valido'] == "SI") {
	require ("./menu.php");

	for ($num1 = 1 ; $num1 < 40 ; $num1++) {
		if (strlen($num1) == 1) $num1 = "0".$num1;
		$giornata_controlla = "giornata$num1";
		if (!@is_file($percorso_cartella_dati."/".$giornata_controlla."_".$_SESSION['torneo']."_".$_SESSION['serie'])) break;
		else $giornata_ultima = $num1;
	} # fine for $num1

	$ultima_giornata = $giornata_ultima;
	if ($ultima_giornata == "") echo "<br/><br/><center><h4>Statistiche non presenti</h4></center><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
	else {
		$vedi_squadra = trim($o_team);

		// Kalskotos
		// aggiunti valori dei ruoli
		if ($o_ruolo == "P") $vedi_ruolo = "PORTIERI";
		if ($o_ruolo == "D") $vedi_ruolo = "DIFENSORI";
		if ($o_ruolo == "C") $vedi_ruolo = "CENTROCAMPISTI";
		if ($o_ruolo == "A") $vedi_ruolo = "ATTACCANTI";
		// fine aggiunta

		if ($o_ruolo <> "") {
			$layout = "<table width='100%' cellpadding='20' align='center' bgcolor='$sfondo_tab'>
			<caption>Riassunto $vedi_ruolo</caption>
			<tr><td align='center'>";
		}
		else {
			$layout = "<table width='100%' cellpadding='20' align='center' bgcolor='$sfondo_tab'>
			<caption>Riassunto $vedi_squadra</caption>
			<tr><td align='center'>";
			$file1 = "./immagini/".strtolower($vedi_squadra).".gif";
			$file2 = "./immagini/m_".strtolower($vedi_squadra).".gif";
			if (@is_file($file1)) echo"<img src='$file1' border='0' vspace='10' alt='Maglietta' /><br/>";
			if (@is_file($file2)) echo"<img src='$file2' border='0' vspace='10' alt='Logo' /><br/>";
		}

		$layout .= "<br/><br/>Dati statistici aggiornati dalla giornata di campionato 01 alla giornata $ultima_giornata</td></tr></table>
		<table width='100%' cellpadding='1' align='center' bgcolor='$sfondo_tab' id='t1' class='sortable'>
		<tr>
		<th>Num.</th>
		<th>Nome</th>
		<th>Ruolo</th>
		<th>Valore</th>
		<th>Partite</th>
		<th>Media</th>
		<th>MediaFC</th>
		<th>Gol</th>
		<th>Assist</th>
		<th>Gialli</th>
		<th>Rossi</th>
		<th>Rigori T</th>
		<th>Rigori S</th></tr>";

		#######################################
		if ($stato_mercato != "I" AND $ultima_giornata >= 1) $voti = file("$prima_parte_pos_file_voti$ultima_giornata.txt");
		else $voti = file("$percorso_cartella_dati/calciatori.txt");

		$num_voti = count($voti);


		if ($ultima_giornata != "") $cerca_squadra = file("$prima_parte_pos_file_voti$ultima_giornata.txt");
		else $cerca_squadra = file("$percorso_cartella_dati/calciatori.txt");
		$num_cer_squ = count($cerca_squadra);

		$calciatori = file("$percorso_cartella_dati/calciatori.txt");
		$num_calciatori = count($calciatori);

		$partite_giocate = 0;
		$somma_voti_tot = 0;
		$somma_voti_giornale = 0;
		for ($knum1 = 0 ; $knum1 < $num_cer_squ ; $knum1++) {
			$dati_calciatore = explode($separatore_campi_file_calciatori, $cerca_squadra[$knum1]);
			$numero = $dati_calciatore[($num_colonna_numcalciatore_file_calciatori-1)];
			$numero = togli_acapo($numero);
			$num_calciatore = $numero;
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
			$attivo = $dati_calciatore[($ncs_attivo-1)];
			$attivo = togli_acapo($attivo);
			if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
			if ($s_ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
			if ($s_ruolo == $simbolo_portiere_file_calciatori) $ruolo = "P";
			if ($s_ruolo == $simbolo_difensore_file_calciatori) $ruolo = "D";
			if ($s_ruolo == $simbolo_centrocampista_file_calciatori) $ruolo = "C";
			if ($s_ruolo == $simbolo_attaccante_file_calciatori) $ruolo = "A";

			// Kalskotos
			// aggiunto caso di statistiche per ruolo
			if ($xsquadra==$vedi_squadra OR $ruolo==$o_ruolo) {

				for ($num1 = 1 ; $num1 < $ultima_giornata+1 ; $num1++) {
					if (strlen($num1) == 1) $num1 = "0".$num1;

					if ($voti = @file("$prima_parte_pos_file_voti$num1.txt")) {
						$num_voti = count($voti);
						$calciatori = file("$percorso_cartella_dati/calciatori.txt");
						$num_calciatori = count($calciatori);
						for ($num2 = 0 ; $num2 < $num_voti ; $num2++) {
							$dati_voto = explode($separatore_campi_file_voti, $voti[$num2]);
							$num_calciatore_voto = $dati_voto[($num_colonna_numcalciatore_file_voti-1)];
							$num_calciatore_voto = togli_acapo($num_calciatore_voto);
							if ($num_calciatore == $num_calciatore_voto) {
								$voto_tot = $dati_voto[($num_colonna_vototot_file_voti-1)];
								$voto_tot = togli_acapo($voto_tot);
								$voto_tot = str_replace(",",".",$voto_tot);
								$voto_giornale = $dati_voto[($num_colonna_votogiornale_file_voti-1)];
								$voto_giornale = togli_acapo($voto_giornale);
								$voto_giornale = str_replace(",",".",$voto_giornale);

								if ($voto_tot != 0 or $voto_giornale != 0) {
									$partite_giocate++;
									$somma_voti_tot = $somma_voti_tot + $voto_tot;
									$somma_voti_giornale = $somma_voti_giornale + $voto_giornale;
								} # fine if ($voto_tot != 0 or $voto_giornale != 0)

								if ($statistiche == "SI") {
									$stat_codice = $dati_voto[($ncs_codice -1)];
									$stat_giornata = $dati_voto[($ncs_giornata -1)];
									$stat_nome = $dati_voto[($ncs_nome -1)];
									$stat_nome = ereg_replace("\"","",$stat_nome);
									$stat_squadra = $dati_voto[($ncs_squadra -1)];
									$stat_squadra = ereg_replace("\"","",$stat_squadra);
									$stat_attivo = $dati_voto[($ncs_attivo -1)];
									$stat_ruolo = $dati_voto[($ncs_ruolo -1)];
									$stat_presenza = $dati_voto[($ncs_presenza -1)]; $totpresenze = $totpresenze + $stat_presenza;
									$stat_votofc = $dati_voto[($ncs_votofc -1)]; $totvotfc = $totvotfc + $stat_votofc;
									$stat_mininf25 = $dati_voto[($ncs_mininf25 -1)]; $totmininf25 = $totmininf25 + $stat_mininf25;
									$stat_minsup25 = $dati_voto[($ncs_minsup25 -1)]; $totminsup25 = $totminsup25 + $stat_minsup25;
									$stat_voto = $dati_voto[($ncs_voto -1)]; $totvot = $totvot + $stat_voto;
									$stat_golsegnati = $dati_voto[($ncs_golsegnati -1)]; $totgol = $totgol + $stat_golsegnati;
									$stat_golsubiti = $dati_voto[($ncs_golsubiti -1)]; $totgolsub = $totgolsub + $stat_golsubiti;
									$stat_golvittoria = $dati_voto[($ncs_golvittoria -1)]; $totgolvit = $totgolvit + $stat_golvittoria;
									$stat_golpareggio = $dati_voto[($ncs_golpareggio -1)]; $totgolpar = $totgolpar + $stat_golpareggio;
									$stat_assist = $dati_voto[($ncs_assist -1)]; $totass = $totass + $stat_assist;
									$stat_ammonizione = $dati_voto[($ncs_ammonizione -1)]; $totamm = $totamm + $stat_ammonizione;
									$stat_espulsione = $dati_voto[($ncs_espulsione -1)]; $totesp = $totesp + $stat_espulsione;
									$stat_rigoretirato = $dati_voto[($ncs_rigoretirato -1)]; $totrigt = $totrigt + $stat_rigoretirato;
									$stat_rigoresubito = $dati_voto[($ncs_rigoresubito -1)]; $totrigs = $totrigs + $stat_rigoresubito;
									$stat_rigoreparato = $dati_voto[($ncs_rigoreparato -1)]; $totrigp = $totrigp + $stat_rigoreparato;
									$stat_rigoresbagliato = $dati_voto[($ncs_rigoresbagliato -1)]; $totrigsb = $totrigsb + $stat_rigoresbagliato;
									$stat_autogol = $dati_voto[($ncs_autogol -1)]; $totaut = $totaut + $stat_autogol;
									$stat_subentrato = $dati_voto[($ncs_entrato -1)];
									$stat_titolare = $dati_voto[($ncs_titolare -1)]; $tottit = $tottit + $stat_titolare;
									$stat_valore = $dati_voto[($ncs_valore -1)];
									$tot_golsegnati = $tot_golsegnati + $stat_golsegnati;
									$tot_golsubiti = $tot_golsubiti + $stat_golsubiti;
								}

							} # fine if ($num_calciatore == $num_calciatore_voto)
						} # fine if ($voti = @file("$prima_parte_pos_file_voti$num1.txt"))
					} # fine for $num2
				} # fine for $num1

				if ($partite_giocate != 0) {
					$media_giornale = round(($somma_voti_giornale /$partite_giocate),2);
					$media_punti = round(($somma_voti_tot / $partite_giocate),2);

				} # fine if ($partite_giocate != 0)
				else {
					$media_giornale = 0;
					$media_punti = 0;
				} # fine else if ($partite_giocate != 0)

				$calciatori = file("$percorso_cartella_dati/calciatori.txt");
				$num_calciatori = count($calciatori);
				for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
					$dati_calciatore = explode($separatore_campi_file_calciatori, $calciatori[$num1]);
					$numero = $dati_calciatore[($num_colonna_numcalciatore_file_calciatori-1)];
					$numero = togli_acapo($numero);
					if ($num_calciatore == $numero) {
						$nome = $dati_calciatore[($num_colonna_nome_file_calciatori-1)];
						$nome = togli_acapo($nome);
						$nome = ereg_replace("\"","",$nome);
						if ($num_colonna_squadra_file_calciatori != 0) {
							$xsquadra = $dati_calciatore[($num_colonna_squadra_file_calciatori-1)];
							$xsquadra = togli_acapo($xsquadra);
							$xsquadra = ereg_replace("\"","",$xsquadra);
						} # fine if ($num_colonna_squadra_file_calciatori != 0)
						$s_ruolo = $dati_calciatore[($num_colonna_ruolo_file_calciatori-1)];
						$s_ruolo = togli_acapo($s_ruolo);
						$ruolo = $s_ruolo;
						if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
						if ($s_ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
						if ($s_ruolo == $simbolo_portiere_file_calciatori) $ruolo = "P";
						if ($s_ruolo == $simbolo_difensore_file_calciatori) $ruolo = "D";
						if ($s_ruolo == $simbolo_centrocampista_file_calciatori) $ruolo = "C";
						if ($s_ruolo == $simbolo_attaccante_file_calciatori) $ruolo = "A";
						break;
					} # fine if ($num_calciatore == $numero)
				} # fine for $num1

				if ($statistiche == "SI") {
					if ($stat_attivo == 0) $mess = "<b><font color='red'>Non disponibile</font></b>";
					else $mess = "In attività";

					if ($stat_ruolo == 0) $st_ruolo = "Portiere";
					if ($stat_ruolo == 1) $st_ruolo = "Difensore";
					if ($stat_ruolo == 2) $st_ruolo = "Centrocampista";
					if ($stat_ruolo == 3) $st_ruolo = "Attaccante";
					# if ($stat_ruolo == 3) $st_ruolo = "Fantasista";

					if ($ruolo == "P") $color=$carattere_colore_chiaro;
					if ($ruolo == "D") $color=$colore_riga_alt;
					if ($ruolo == "C") $color=$carattere_colore_chiaro;
					if ($ruolo == "A") $color=$colore_riga_alt;
					# if ($ruolo == "F") $color=$carattere_colore_chiaro;

					if ($ruolo == "P") $tot_golsegnati = $tot_golsubiti;
					if ($stat_attivo == "0") $csattivo = " - <font class='piccolo'>Trasferito</font>"; else $csattivo = "";

					$layout .= "<tr bgcolor='$color'>";
					$layout .= "<td align='center'><a href='stat_calciatore.php?num_calciatore=$numero' class='user'>$numero</a></td>
					<td>$nome $csattivo</td>
					<td align='center'>$ruolo</td>
					<td align='center'>$valore</td>
					<td align='center'>$totpresenze</td>
					<td align='center'>$media_giornale</td>
					<td align='center'>$media_punti</td>
					<td align='center'>$tot_golsegnati</td>
					<td align='center'>$totass</td>
					<td align='center'>$totamm</td>
					<td align='center'>$totesp</td>
					<td align='center'>$totrigt</td>
					<td align='center'>$totrigs</td>
					</tr>";

				}; #Fine  if ($xsquadra==$vedi_squadra) {

				$stat_presenza=0;
				$totpresenze=0;
				$stat_votofc=0;
				$totvotfc=0;
				$stat_voto=0;
				$totvot=0;
				$stat_golsegnati=0;
				$tot_golsegnati=0;
				$stat_golsubiti=0;
				$tot_golsubiti=0;
				$stat_golvittoria=0;
				$totgolvit=0;
				$stat_golpareggio=0;
				$totgolpar=0;
				$stat_assist=0;
				$totass=0;
				$stat_ammonizione=0;
				$totamm=0;
				$stat_espulsione=0;
				$totesp=0;
				$stat_rigoretirato=0;
				$totrigt=0;
				$stat_rigoresubito=0;
				$totrigs=0;
				$stat_rigoreparato=0;
				$totrigp=0;
				$stat_rigoresbagliato=0;
				$totrigsb=0;
				$stat_autogol=0;
				$totaut=0;
				$partite_giocate=0;
				$media_giornale=0;
				$media_punti=0;
				$partite_giocate = 0;
				$somma_voti_tot = 0;
				$somma_voti_giornale = 0;

			} # fine for $Knum1

		} # fine if ($statistiche == "SI")

		echo "<script type='text/javascript' src='./inc/js/ordina_tabella.js'></script>";
		echo $layout ."</table>";

	} # fine else
} # fine if ($_SESSION['valido'] == "SI") {
else echo"<meta http-equiv='refresh' content='0; url=logout.php'>";

include("./footer.php");
?>