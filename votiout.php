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
include("./dati/dati_gen.php");
include("./inc/funzioni.php");
include("./header.php");

if (!$_GET['anno_guarda']) $anno_guarda = "2008"; else $anno_guarda = $_GET['anno_guarda'];
if (!$_GET['ruolo_guarda']) $ruolo_guarda = "tutti"; else $ruolo_guarda = $_GET['ruolo_guarda'];
if (!$_GET['squadra_guarda']) $squadra_guarda = "tutte"; else $squadra_guarda = $_GET['squadra_guarda'];

$naviga = "<div style='background-color: $sfondo_tab; margin-top:5px; margin-bottom:5px; padding: 5px; border: 1px solid $sfondo_tab2'>
<a href='".@$PHP_SELF."'>Inizio</a> - ";
if ($squadra_guarda != "tutte") $naviga .=  "<a href='".@$PHP_SELF."?squadra_guarda=tutte&amp;ruolo_guarda=$ruolo_guarda&amp;anno_guarda=$anno_guarda'>Squadre</a> - ";
if ($ruolo_guarda != "tutti") $naviga .=  "<a href='".@$PHP_SELF."?ruolo_guarda=tutti&amp;squadra_guarda=$squadra_guarda&amp;anno_guarda=$anno_guarda'>Ruoli</a> - ";
$naviga .=  "<a href='".@$PHP_SELF."?ruolo_guarda=P&amp;squadra_guarda=$squadra_guarda&amp;anno_guarda=$anno_guarda'>P</a> - 
<a href='".@$PHP_SELF."?ruolo_guarda=D&amp;squadra_guarda=$squadra_guarda&amp;anno_guarda=$anno_guarda'>D</a> - 
<a href='".@$PHP_SELF."?ruolo_guarda=C&amp;squadra_guarda=$squadra_guarda&amp;anno_guarda=$anno_guarda'>C</a> - 
<a href='".@$PHP_SELF."?ruolo_guarda=A&amp;squadra_guarda=$squadra_guarda&amp;anno_guarda=$anno_guarda'>A</a> - 
<a href='".@$PHP_SELF."?squadra_guarda=tutte&amp;ruolo_guarda=$ruolo_guarda&amp;anno_guarda=2008'>2008</a> - 
<a href='".@$PHP_SELF."?squadra_guarda=tutte&amp;ruolo_guarda=$ruolo_guarda&amp;anno_guarda=2007'>2007</a> - 
<a href='".@$PHP_SELF."?squadra_guarda=tutte&amp;ruolo_guarda=$ruolo_guarda&amp;anno_guarda=2006'>2006</a> - 
<a href='".@$PHP_SELF."?squadra_guarda=tutte&amp;ruolo_guarda=$ruolo_guarda&amp;anno_guarda=2005'>2005</a> - 
<a href='".@$PHP_SELF."?squadra_guarda=tutte&amp;ruolo_guarda=$ruolo_guarda&amp;anno_guarda=2004'>2004</a> - 
<a href='".@$PHP_SELF."?squadra_guarda=tutte&amp;ruolo_guarda=$ruolo_guarda&amp;anno_guarda=2003'>2003</a> - 
<a href='".@$PHP_SELF."?squadra_guarda=tutte&amp;ruolo_guarda=$ruolo_guarda&amp;anno_guarda=2002'>2002</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Leggenda colori: <span style='background-color:yellow'>6 politico</span> - <span style='background-color:lightgreen'>Senza voto</span> - <span style='background-color:lightblue'>Presenza < > Entrato</span>
<br />
Giornate giocate:&nbsp;"; 

		for($num1 = 1; $num1 < 40 ; $num1++) {
			if (strlen($num1) == 1) $num1 = "0".$num1;
			if (!@is_file("./dati/$anno_guarda/MCC$num1.txt")) break;
			else {
				$naviga .= "<a href='?numgio=$num1&amp;ruolo_guarda=$ruolo_guarda&amp;squadra_guarda=$squadra_guarda&amp;anno_guarda=$anno_guarda'>&nbsp;$num1&nbsp;</a>&nbsp;";
				$giornata_ultima = $num1;
			}
		} # fine for $num1
		$naviga .= "</div></center>";

if (!$_GET['numgio']) $num_gio = $num1-1; else $num_gio = $_GET['numgio'];
unset ($num1);

echo "<center><h3>Guarda voti giornata $num_gio/$anno_guarda</h3>".$naviga;

$percorso = "./dati/$anno_guarda/MCC$num_gio.txt";
$calciatori = file($percorso);

if ($calciatori) {

	$tabella = "<table summary='Verifica voti' border='1' style='border-collapse: collapse' cellspacing='0' cellpadding='5' align='center' bgcolor='$sfondo_tab'>
	<tr>
	<th style='font-size:9px; text-align:center'>$anno_guarda</th>
	<th style='font-size:9px; text-align:center'>Nome</th>
	<th style='font-size:9px; text-align:center'>Squadra</th>
	<th style='font-size:9px; text-align:center'>Voto</th>
	<th style='font-size:9px; text-align:center'>Voto FC</th>
	<th style='font-size:9px; text-align:center'>€</th>
	<th style='font-size:9px; text-align:center'>Att</th>
	<th style='font-size:9px; text-align:center'>Pres</th>
	<th style='font-size:9px; text-align:center'>-25</th>
	<th style='font-size:9px; text-align:center'>+25</th>
	<th style='font-size:9px; text-align:center'>Entr</th>
	<th style='font-size:9px; text-align:center'>tit</th>
	<th style='font-size:9px; text-align:center'>Casa</th>
	<th style='font-size:9px; text-align:center'>G Fatti</th>
	<th style='font-size:9px; text-align:center'>R Tir</th>
	<th style='font-size:9px; text-align:center'>R Sba</th>
	<th style='font-size:9px; text-align:center'>G vit</th>
	<th style='font-size:9px; text-align:center'>G par</th>
	<th style='font-size:9px; text-align:center'>ass</th>
	<th style='font-size:9px; text-align:center; background-color: yellow'>&nbsp;</th>
	<th style='font-size:9px; text-align:center; background-color: red'>&nbsp;</th>
	<th style='font-size:9px; text-align:center'>Gsubiti</th>
	<th style='font-size:9px; text-align:center'>RigSub</th>
	<th style='font-size:9px; text-align:center'>RigPar</th>
	<th style='font-size:9px; text-align:center'>autogol</th>
	</tr>";

	$num_calciatori = count($calciatori);

	for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {

		$dc = explode("|", $calciatori[$num1]);
		$num = $dc[$ncs_codice-1];
		$gio = $dc[$ncs_giornata-1];
		$nome = $dc[($ncs_nome-1)];
		@$nome = ereg_replace("\"","",$nome);
		$ruolo = $dc[($ncs_ruolo-1)];
		$val = $dc[($ncs_valore-1)];
		$v = round($dc[($ncs_voto-1)],1);
		$vfc = round($dc[($ncs_votofc-1)],1);
		$sq = $dc[($ncs_squadra-1)];
		@$sq = ereg_replace("\"","",$sq);
		$att = $dc[($ncs_attivo-1)];
		$pres = $dc[($ncs_presenza-1)];
		$min25 = $dc[($ncs_mininf25-1)];
		$sup25 = $dc[($ncs_minsup25-1)];
		$entr = $dc[($ncs_entrato-1)];
		$tito = $dc[($ncs_titolare-1)];
		$casa = $dc[($ncs_casa-1)];
		$gfatt = $dc[($ncs_golsegnati-1)];
		$gsub = $dc[($ncs_golsubiti-1)];
		$gvitt = $dc[($ncs_golvittoria-1)];
		$gpari = $dc[($ncs_golpareggio-1)];
		$assi = $dc[($ncs_assist-1)];
		$giall = $dc[($ncs_ammonizione-1)];
		$rosso = $dc[($ncs_espulsione-1)];
		$rtir = $dc[($ncs_rigoretirato-1)];
		$rsub = $dc[($ncs_rigoresubito-1)];
		$rpar = $dc[($ncs_rigoreparato-1)];
		$rsba = $dc[($ncs_rigoresbagliato-1)];
		$auto = $dc[($ncs_autogol-1)];

		if (round($vfc,1) == 6 AND round($v,1) == 0 AND INTVAL($pres) == 1 AND INTVAL($entr) == 0) $colpol = "yellow";  
		else $colpol = "";
		if (round($vfc,1) == 0 AND round($v,1) >= 0 AND INTVAL($pres) == 1 AND INTVAL($entr) == 1) $colsv = "lightgreen";  
		else $colsv = "";
		if (INTVAL($pres) != INTVAL($entr)) $coldif = "lightblue";  
		else $coldif = "";

		if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
		if ($ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
		if ($ruolo == $simbolo_portiere_file_calciatori) $ruolo = "P";
		if ($ruolo == $simbolo_difensore_file_calciatori) $ruolo = "D";
		if ($ruolo == $simbolo_centrocampista_file_calciatori) $ruolo = "C";
		if ($ruolo == $simbolo_attaccante_file_calciatori) $ruolo = "A";

		if (($ruolo == $ruolo_guarda OR $ruolo_guarda == "tutti") AND ($sq == $squadra_guarda OR $squadra_guarda == "tutte")) {
			
			if ($ruolo == "P") $colore = "#dddddd"; else $colore = "#ffffff"; 
			
			$tabella .= "<tr align='center'>
			<td bgcolor='$coldif'>$num - $gio</td>
			<td style='text-align:left'><b>$ruolo</b> - $nome</td>
			<td><a href='".@$PHP_SELF."?squadra_guarda=$sq&amp;ruolo_guarda=$ruolo_guarda&amp;anno_guarda=$anno_guarda'>$sq</a></td>
			<td bgcolor='$colpol'>$v</td>
			<td bgcolor='$colsv'>$vfc</td>
			<td>$val</td>
			<td>$att</td>
			<td bgcolor='#eeeeee'>$pres</td>
			<td>$min25</td>
			<td>$sup25</td>
			<td bgcolor='#eeeeee'>$entr</td>
			<td>$tito</td>
			<td>$casa</td>
			<td>$gfatt</td>
			<td>$rtir</td>
			<td>$rsba</td>
			<td>$gvitt</td>
			<td>$gpari</td>
			<td>$assi</td>
			<td>$giall</td>
			<td>$rosso</td>
			<td bgcolor='$colore'>$gsub</td>
			<td bgcolor='$colore'>$rsub</td>
			<td bgcolor='$colore'>$rpar</td>
			<td>$auto</td>
			</tr>";
		} # fine if ($ruolo == $ruolo_guarda or ...)

	} # fine for $num1
	$tabella .= "</table>";

	echo $tabella;
}
include("./footer.php");
?>