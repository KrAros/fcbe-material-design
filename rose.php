<?php
// #################################################################################
// FANTACALCIOBAZAR EVOLUTION
// Copyright (C) 2003-2008 by Antonello Onida
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
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
// #################################################################################
require_once ("./controlla_pass.php");
include ("./header.php");

echo '<div class="container" style="width: 85%;margin-top: -10px;">
	<div class="card-panel">
	<div class="row">';

require ("./widget.php");
echo '<div class="col m9">';
echo "<div class='bread'><a href='./mercato.php'>Gestione</a> / Riepilogo rose</div><br>";
echo "
	<div class='card'>
	<div class='card-content'>
	<span class='card-title'>Riepilogo rose<span style='font-size: 13px;'> - Visualizza le rose dei partecipanti</span></span>
	<hr>
	<div class='row'>";

if ($_SESSION ['valido'] == "SI" and ($stato_mercato != "I" or $stato_mercato != "R" or $_SESSION ['permessi'] == 4)) {

	$chiusura_giornata = ( int ) @file ( $percorso_cartella_dati . "/chiusura_giornata.txt" );

	$nome_squadra = "tutti";
	// ###########################################
	$utenti = @file ( $percorso_cartella_dati . "/utenti_" . $_SESSION ['torneo'] . ".php" );
	$linee = count ( $utenti );
	for($num1 = 1; $num1 < $linee; $num1 ++) {
		@list ( $outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg ) = explode ( "<del>", $utenti [$num1] );

		$titolo = "<font size=+2>";
		if ($osquadra)
			$titolo .= "$osquadra</font>";
		else
			$titolo .= "Squadra</font>";

		// ###################################################################
		$contatore_calciatori = 0;
		$lista_calciatori = "";
		$soldi_spesi = 0;
		$num_calciatori_posseduti = 0;
		$np = 0;
		$nd = 0;
		$nc = 0;
		$nf = 0;
		$na = 0;
		$linea_offerto = "";
		$linea_comprato_P = "";
		$linea_comprato_D = "";
		$linea_comprato_C = "";
		$linea_comprato_F = "";
		$linea_comprato_A = "";
		$tab_comprati = "";
		$tab_offerte = "<table summary='Principale' class='border' width='100%' border='1' cellspacing='1' cellpadding='3' align='center' bgcolor='$sfondo_tab'>
			<tr><td class='testa'>Num.</td>
			<td class='testa'>Nome giocatore</td>
			<td class='testa'>Ruolo</td>
			<td class='testa'>Costo</td>
			<td class='testa'>Tempo rimasto</td></tr>";

		$calciatori = @file ( $percorso_cartella_dati . "/mercato_" . $_SESSION ['torneo'] . "_" . $_SESSION ['serie'] . ".txt" );
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
				$mese_off = intval ( substr ( $tempo_off, 4, 2 ) );
				$giorno_off = substr ( $tempo_off, 6, 2 );
				$ora_off = substr ( $tempo_off, 8, 2 );
				$minuto_off = substr ( $tempo_off, 10, 2 );
				$adesso = mktime ( date ( "H" ), date ( "i" ), 0, date ( "m" ), date ( "d" ), date ( "Y" ) );
				$sec_restanti = mktime ( $ora_off, $minuto_off, 0, $mese_off, $giorno_off, $anno_off ) - $adesso;
				$lista_calciatori [$contatore_calciatori] = $numero;
				$contatore_calciatori ++;

				$tab_centro .= "<tr><td align='center'>$numero</td>
					<td>$nome</td>
					<td align='center'>$ruolo</td>
					<td align='center'>$costo</td></tr>";
			} // fine if ($proprietario == $outente)
		} // fine for $num2

		// ########################################################
		$tab_lato = "";

		// ###################################################
		// #######################
		// Layout pagina
		echo " <div class='col m6'>
			<div class='card'>
			<span class='card-title white-text' style='background-color: #3f51b5;height:60px;padding: 14px 0 0 10px;';>                                    							    
			$titolo     
			</span>
			<div class='card-content'>
			<table class='highlight' style='width:100%'>
			<thead>
			<tr>
			<th>Codice</th>
			<th>Nome</th>
			<th>Ruolo</th>
			<th>Costo</th>
			</tr>
			</thead>
			$tab_centro
			</table>
			</div>
			<div class='card-action'>
			<div class='row' style='margin: 0;'>
			<span class='left'>Presidente: <b>$outente</b></span>
			<span class='right'>Data iscrizione: $oreg</span>
			</div>
			</div></div></div>";

		echo $fuori_tabella;

		$tab_lato = "";
		$tab_centro = "";
		$fuori_tabella = "";

		// #######################
	} // fine for $num1
} // fine VALID
echo "</div></div></div></div></div></div></div>";
require ("./footer.php");
?>