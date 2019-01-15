<?php
##################################################################################
#    FANTACALCIOBAZAR
#    Copyright (C) 2003-2007 by Antonello Onida (fantacalciobazar@sssr.it)
#    Copyright (C) 2001-2002 by Marco Maria Francesco De Santis (marcods@gmx.net)
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
session_start();
if ($_POST['escludi_controllo'] == 'SI') $_SESSION['ec'] = "SI"; else $_SESSION['ec'] = "NO";

include("./controlla_pass.php");
include("./header.php");

if ($_SESSION['valido'] == "SI") include ("./menu.php");
else echo "<div class='contenuto'>
<div id='articoli'>
<div id='sinistra'>
<div class='articoli_s'>";

$percorso = "$prima_parte_pos_file_voti$giornata$seconda_parte_pos_file_voti";
$calciatori = file("$percorso");
$num_calciatori = count($calciatori);

$tabella = "<table width='100%' cellspacing='0' cellpadding='2' align='center'>
<caption>Guarda voti giornata $giornata</caption><tr>
<td class='testa1'>Num.</td>
<td class='testa1'>Nome</td>
<td class='testa1'>Ruolo</td>
<td class='testa1'>Voto</td>
<td class='testa1'>Voto FC</td>
<td class='testa1'>Valore</td>
<td class='testa1'>Squadra</td></tr>";

for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {

	if ($num1 % 2) $color="white";
	else $color=$colore_riga_alt;

	$dati_calciatore = explode($separatore_campi_file_calciatori, $calciatori[$num1]);
	$numero = $dati_calciatore[($num_colonna_numcalciatore_file_calciatori-1)];
	$numero = trim($numero);
	$nome = $dati_calciatore[($num_colonna_nome_file_calciatori-1)];
	$nome = trim($nome);
	$nome = ereg_replace("\"","",$nome);
	$s_ruolo = $dati_calciatore[($num_colonna_ruolo_file_calciatori-1)];
	$s_ruolo = trim($s_ruolo);
	$ruolo = $s_ruolo;
	$valore = $dati_calciatore[($num_colonna_valore_calciatori-1)];
	$valore = trim($valore);
	$voto = $dati_calciatore[($num_colonna_votogiornale_file_voti-1)];
	$voto = trim($voto);
	$votoFC = $dati_calciatore[($num_colonna_vototot_file_voti-1)];
	$votoFC = trim($votoFC);

	$xsquadra = $dati_calciatore[($num_colonna_squadra_file_calciatori-1)];
	$xsquadra = trim($xsquadra);
	$xsquadra = ereg_replace("\"","",$xsquadra);
	if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
	if ($s_ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
	if ($s_ruolo == $simbolo_portiere_file_calciatori) $ruolo = "P";
	if ($s_ruolo == $simbolo_difensore_file_calciatori) $ruolo = "D";
	if ($s_ruolo == $simbolo_centrocampista_file_calciatori) $ruolo = "C";
	if ($s_ruolo == $simbolo_attaccante_file_calciatori) $ruolo = "A";

	if ($ruolo == $ruolo_guarda or $ruolo_guarda == "tutti") {
		$tabella .= "<tr bgcolor='$color'><td align='center'><a href='stat_calciatore.php?num_calciatore=$numero&amp;ruolo_guarda=$ruolo_guarda' class='user'>$numero</a></td>
		<td align='left'>$nome</td>
		<td align='center'>$ruolo</td>
		<td align='center'>$voto</td>
		<td align='center'>$votoFC</td>
		<td align='center'>$valore</td>
		<td align='center'><a href='tab_squadre.php?vedi_squadra=$xsquadra' class='user'>$xsquadra</a></td></tr>";
	} # fine if ($ruolo == $ruolo_guarda or ...)

} # fine for $num1
$tabella .=  "</table>";

echo $tabella;

if ($_SESSION['valido'] != "SI") {
	echo "</div>
			</div>
			<div id='destra'>";
	include("./menu_i.php");
	echo "</div>";
}

include("./footer.php");
?>