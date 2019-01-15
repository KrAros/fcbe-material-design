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
include("./header.php");
include("./inc/regexml.inc.php");

$xml_c = new RegEXml;
$fd = $xml_c->get_file("http://www.gazzetta.it/ssi/2011/boxes/calcio/squadre/".strtolower($vedi_squadra)."/formazione/formazione.xml");
$pf = $xml_c->get_xml_tag("probabile_formazione",$fd);
$categoria = $xml_c->get_array_tag("categoria",$pf);
$squadra = $xml_c->get_array_tag("squadra",$pf);
$titolo = $xml_c->get_array_tag("titolo",$pf);
$modulo = $xml_c->get_array_tag("modulo",$pf);
$titolari = $xml_c->get_array_tag("titolari",$pf);
$acquisti = $xml_c->get_array_tag("acquisti",$pf);
$cessioni = $xml_c->get_array_tag("cessioni",$pf);
$trattative = $xml_c->get_array_tag("trattative",$pf);

if ($_SESSION['valido'] == "SI") include ("./menu.php");
else echo "<div class='contenuto'>
<div id='articoli'>
<div id='sinistra'>
<div class='articoli_s'>";

$linea = "";

######################################
##### Controlla numero ultima giornata

for ($num1 = 1; $num1 < 40; $num1++) {
	if (strlen($num1) == 1) $num1 = "0".$num1;
	if (@is_file($percorso_cartella_voti."/voti".$num1.".txt")) {
		$ultima_giornata = "";
	} # fine if (is_dir($giornata))
	else {
		$ultima_giornata = $num1 - 1;
		if (strlen($ultima_giornata) == 1) $ultima_giornata = "0".$ultima_giornata;
		break;
	} # fine else
} # fine for $num1

#######################################


if ($ultima_giornata != "00") {
	$cerca_squadra = file($percorso_cartella_voti."/voti".$ultima_giornata.".txt");
	$frase_giornata = "Dati aggiornati alla giornata $ultima_giornata";
}
else {
	$cerca_squadra = file($percorso_cartella_dati."/calciatori.txt");
	$frase_giornata = "Dati relativi al precampionato";
}

$num_cer_squ = count($cerca_squadra);
$file1 = "./immagini/".strtolower($vedi_squadra).".png";
$file2 = "./immagini/m_".strtolower($vedi_squadra).".png";

$table_layout = "<table summary='Dati squadra' cellpadding='3px' align='center' bgcolor='$sfondo_tab'>
<tr><td class='testa'>&nbsp;</td>
<td class='testa'>&nbsp;</td>
<td class='testa'>&nbsp;</td>
<td class='testa'>V</td>
<td class='testa'>FV</td>
<td class='testa'>€</td>
<td class='testa'>&nbsp;</td></tr>";

for ($num1 = 0 ; $num1 < $num_cer_squ ; $num1++) {

	$dati_calciatore = explode($separatore_campi_file_calciatori, $cerca_squadra[$num1]);
	$numero = $dati_calciatore[($num_colonna_numcalciatore_file_calciatori-1)];
	$numero = trim($numero);
	$nome = stripslashes($dati_calciatore[($num_colonna_nome_file_calciatori-1)]);
	$nome = trim($nome);
	$nome = ereg_replace("\"","",$nome);
	$ruolo = $dati_calciatore[($num_colonna_ruolo_file_calciatori-1)];
	$ruolo = trim($ruolo);
	$valore = $dati_calciatore[($num_colonna_valore_calciatori-1)];
	$valore = trim($valore);
	$ultvoto = $dati_calciatore[($num_colonna_votogiornale_file_voti-1)];
	$ultvoto = trim($ultvoto);
	$ultfantavoto = $dati_calciatore[($num_colonna_vototot_file_voti-1)];
	$ultfantavoto = trim($ultfantavoto);
	$xsquadra = $dati_calciatore[($num_colonna_squadra_file_calciatori-1)];
	$xsquadra = trim($xsquadra);
	$xsquadra = ereg_replace("\"","",$xsquadra);

	$attivo = $dati_calciatore[($ncs_attivo-1)];
	$attivo = trim($attivo);

	if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
	if ($ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
	if ($ruolo == $simbolo_portiere_file_calciatori) $ruolo = "P";
	if ($ruolo == $simbolo_difensore_file_calciatori) $ruolo = "D";
	if ($ruolo == $simbolo_centrocampista_file_calciatori) $ruolo = "C";
	if ($ruolo == $simbolo_attaccante_file_calciatori) $ruolo = "A";

	#####################
	if ($vedi_squadra == $xsquadra and $attivo == "1") {

		if ($ruolo == "P") $color="white";
		if ($ruolo == "D") $color=$colore_riga_alt;
		if ($ruolo == "C") $color="white";
		if ($ruolo == "A") $color=$colore_riga_alt;
		# if ($ruolo == "F") $color="white";

		$table_layout .= "<tr bgcolor = '$color'>
		<td align='center'><a href='stat_calciatore.php?num_calciatore=$numero&amp;ruolo_guarda=$ruolo_guarda&amp;escludi_controllo=$escludi_controllo' class='user'>$numero</a></td>
		<td align=left>$nome</td>
		<td align=center>$ruolo</td>
		<td align=center>$ultvoto</td>
		<td align=center>$ultfantavoto</td>
		<td align=center>$valore</td>";
		if ($_SESSION['valido'] == "SI" and $mercato_libero == "SI" and $stato_mercato == "I")  $table_layout .= "<td align='center'><a href='compra.php?num_calciatore=$numero&amp;valutazione=$valutazione' class='user'>compra</a></td>";
		elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "SI" and $stato_mercato != "I") $table_layout .= "<td align='center'><a href='cambi_tra.php?num_calciatore=$numero' class='user'>cambi</a></td>";
		elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "NO" and $stato_mercato == "I") $table_layout .= "<td align='center'><a href='offerta.php?num_calciatore=$numero' class='user'>offri</a></td>";
		//elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "NO" and $stato_mercato == "B") $table_layout .= "<td align='center'><a href='busta_offerta.php?num_calciatore=$numero&amp;valutazione=$valutazione&amp;xsquadra_ok=$xsquadra_ok&amp;mercato_libero=$mercato_libero' class='user'>inserisci nella busta</a></td>";
        elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "NO" and $stato_mercato == "B") $table_layout .= "<td align='center'><a class='user'>inserisci nella busta</a></td>";
		elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "NO" and $stato_mercato == "P") $table_layout .= "<td align='center'><a href='offerta.php?num_calciatore=$numero' class='user'>offri</a></td>";
		elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "NO" and $stato_mercato == "S") $table_layout .= "<td align='center'><a href='offerta.php?num_calciatore=$numero' class='user'>offri</a></td>";
		elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "NO" and $stato_mercato == "A") $table_layout .= "<td align=center><a href='scambia.php?num_calciatore=$numero&amp;altro_utente=$proprietario' class='user'>scambia</a></td>";
		else $table_layout .= "<td align='center'>non disponibile</td>";
		$table_layout .= "</tr>";
	}
} # fine for $num1
$table_layout .= "</table>";
tabella_squadre_tra();
?>
<table summary="Dati squadra" width="100%" style="background-color: white; text-align: center; background-image:url('http://images.gazzettaobjects.it/libs/css/default_theme/assets/bg_squadre/<?php echo strtolower($vedi_squadra) ?>.gif');background-repeat:no-repeat;">
	<tr><td style="width: 50%; padding: 10px; text-align: justify; vertical-align: top">
		<br /><br /><br />
<?php
$grab1 = file("http://www.gazzetta.it/Calcio/Squadre/".ucfirst(strtolower($vedi_squadra)));

for ($nn=1900; $nn<=2200; $nn++) {
	if (strstr($grab1[$nn],"sede-data bg1")) {
		$lintit=$nn+2;
		$lingn=$nn+3;
		if (strlen(strip_tags($grab1[$lingn])) > 50) {$gn = utf8_encode(html_entity_decode($grab1[$lingn]));$tit = utf8_encode(html_entity_decode($grab1[$lintit]));}
	}
}

unset($grab1);

echo "<div style='padding:5px; float:left'>";

if (@is_file($file1)) echo"<img src='$file1' style='padding: 10px; margin: 0px; float: left;' alt='Stemma sociale' />";

echo "<b><u>Ultime notizie Gazzetta:</u></b><h1>".$tit."</h1><br />".$gn."</div><div style='clear:both;'>&nbsp;</div>
<br /><br />";

echo "<object id='probabili_formazioni' width='620' height='250' data='http://www.gazzetta.it/ssi/swf/campetto_oriz.swf' type='application/x-shockwave-flash'>
<param name='quality' value='high' />
<param name='wmode' value='transparent' />
<param name='allowScriptAccess' value='always' />
<param name='flashvars' value='xmlPath=http://www.gazzetta.it/ssi/2011/boxes/calcio/squadre/".strtolower($vedi_squadra)."/formazione/formazione.xml' />
<param name='movie' value='http://www.gazzetta.it/ssi/swf/campetto_oriz.swf' />
</object>
";


/*
echo "<b>Modulo ".$modulo[0]."<br /><br />Probabile formazione:</b>".$acapo;

foreach($titolari as $val) {
	$val1 = eregi_replace("<calciatore>","<br />", $val);
	$val1 = eregi_replace("</calciatore>","", $val1);
	echo $val1.$acapo;
}

echo "<div style='padding: 5px; float:left'><b><u>Trattative:</u></b>".$acapo;
foreach($trattative as $val) {
	$val1 = eregi_replace("<calciatore>","<br />", $val);
	$val1 = eregi_replace("</calciatore>","", $val1);
	echo $val1.$acapo;
}

*/

echo "<div style='clear:both;'>&nbsp;</div><div style='width: 100%'><img src='$file2' border='0' alt='Maglia sociale' align='right' /><div style='padding: 10px; float:left'><b>Acquisti:</b>".$acapo;
foreach($acquisti as $val) {
	$val1 = eregi_replace("<calciatore>","<br />", $val);
	$val1 = eregi_replace("</calciatore>","", $val1);
	echo $val1.$acapo;
}

echo "</div><div style='padding: 10px; float:left'><b>Cessioni:</b>".$acapo;
foreach($cessioni as $val) {
	$val1 = eregi_replace("<calciatore>","<br />", $val);
	$val1 = eregi_replace("</calciatore>","", $val1);
	echo $val1.$acapo;
}

echo "</div></div></td><td style='vertical-align: top; text-align: center; width: 50%; padding: 10px;'>
<br /><br /><img src='$file2' border='0' alt='Maglia sociale' align='right' /><h2>$frase_giornata</h2><br /><br />
$table_layout
</td></tr></table>";

if ($_SESSION['valido'] != "SI") {
	echo "</div>
	</div>
	<div id='destra'>";
	include("./menu_i.php");
	echo "</div>";
}

include("./footer.php");
?>