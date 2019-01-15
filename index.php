<?php
##################################################################################
#    FANTACALCIOBAZAR EVOLUTION
#    Copyright (C) 2003-2010 by Antonello Onida
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

# nel caso fosse settato register_globals = Off
reset($_POST);
$conta=count($_POST);
for($num1 = 0 ; $num1 < $conta; $num1++) {
$var_POST = key($_POST);
$$var_POST = $_POST[$var_POST];
next($_POST);
} # fine for $num1

reset($_GET);
$conta=count($_GET);
for($num1 = 0 ; $num1 < $conta; $num1++) {
$var_GET = key($_GET);
$$var_GET = strip_tags($_GET[$var_GET]);
next($_GET);
} # fine for $num1

header("Cache-control: private");
include_once("./dati/dati_gen.php");
include_once("./inc/funzioni.php");
include("./header.php");
?>

<div class="contenuto">
<div id="articoli">
<div id="sinistra">
<div class="articoli_s">

<?php
if ($usa_cms == "SI" AND strip_tags($_GET[paginaid])) {
pagina(strip_tags($_GET[paginaid]));
}
elseif ($usa_cms == "SI" AND strip_tags($_GET[categoria])) {
categoria($_GET[categoria]);
}
elseif ($usa_cms == "SI" AND strip_tags($_GET[notiziaid])) {
notizia($_GET[notiziaid], strip_tags(htmlentities($evidenzia)));
}
elseif ($usa_cms == "SI" AND strip_tags($ricerca)) {
ricerca(strip_tags(htmlentities($testo)));
}
elseif ($usa_cms == "SI" AND $vedi_notizie >= 1) {
echo"<p style='float: left; margin: 10; padding-right: 10px;'>";
if ($mostra_gall_index == "SI") immagine_casuale('sx',0,0);
echo "</p>".$acapo;

if (trim($messaggi[1]) != "") echo "<div class='slogan'>".html_entity_decode($messaggi[1])."</div><div style='clear:both;'>&nbsp;</div>".$acapo;

if (trim($messaggi[3]) OR trim($messaggi[4])) echo "<div>".$acapo;
if (trim($messaggi[3]) != "") echo "<div class='box1'>" . html_entity_decode($messaggi[3]) . "</div>".$acapo;
if (trim($messaggi[4]) != "") echo "<div class='box2'>" . html_entity_decode($messaggi[4]) . "</div>".$acapo;
if (trim($messaggi[3]) OR trim($messaggi[4])) echo "</div>".$acapo;

echo "<div style='clear:both;'>&nbsp;</div>".$acapo;
notizie();

}
elseif(trim($messaggi[1]) != "") {
echo"<p style='float: left; margin: 10; padding-right: 10px;'>";
immagine_casuale('sx',0,0);
echo "</p>".$acapo;

if (trim($messaggi[1]) != "") echo "<div class='slogan'>".html_entity_decode($messaggi[1])."</div><div style='clear:both;'>&nbsp;</div>".$acapo;

if (trim($messaggi[3]) OR trim($messaggi[4])) echo "<div>".$acapo;
if (trim($messaggi[3]) != "") echo "<div class='box1'>" . html_entity_decode($messaggi[3]) . "</div>".$acapo;
if (trim($messaggi[4]) != "") echo "<div class='box2'>" . html_entity_decode($messaggi[4]) . "</div>".$acapo;
if (trim($messaggi[3]) OR trim($messaggi[4])) echo "</div>".$acapo;

echo "<div style='clear:both;'>&nbsp;</div>".$acapo;
}
else {
echo"<p style='float: left; margin: 0; padding-right: 10px;'>";
immagine_casuale('sx',0,0);
echo "</p>.$acapo";
if (trim($messaggi[3]) OR trim($messaggi[4])) echo "<div>".$acapo;
if (trim($messaggi[3]) != "") echo "<div class='box1'>" . html_entity_decode($messaggi[3]) . "</div>".$acapo;
if (trim($messaggi[4]) != "") echo "<div class='box2'>" . html_entity_decode($messaggi[4]) . "</div>".$acapo;
if (trim($messaggi[3]) OR trim($messaggi[4])) echo "</div>".$acapo;

echo "<div style='clear:both;'>&nbsp;</div>".$acapo;
}

echo "</div>
</div>
<div id='destra'>";
include("./menu_i.php");
echo "</div>";
?>
<div id='addizionali'>
<br /><br />
<!-- SiteSearch Google -->
<form method="get" action="http://www.sssr.it/ricerca.php" target="_top">
<table summary="addizionali" align="center" border="0" bgcolor="#ffffff">
<tr><td nowrap="nowrap" valign="top" align="left" height="32">
<input type="hidden" name="domains" value="sassarionline.net;fantacalciobazar.altervista.org;fantacalciobazar.sssr.it" />
<label for="sbi" style="display: none">Inserisci i termini di ricerca</label>
<input type="text" name="q" size="31" maxlength="255" value="" id="sbi" />
</td>
<td nowrap="nowrap">
<label for="sbb" style="display: none">Invia modulo di ricerca</label>
<input type="submit" name="sa" value="Cerca con Google" id="sbb" />
<input type="hidden" name="client" value="pub-9997862776187032" />
<input type="hidden" name="forid" value="1" />
<input type="hidden" name="ie" value="ISO-8859-1" />
<input type="hidden" name="oe" value="ISO-8859-1" />
<input type="hidden" name="cof" value="GALT:#0066CC;GL:1;DIV:#999999;VLC:336633;AH:center;BGC:FFFFFF;LBGC:FF9900;ALC:0066CC;LC:0066CC;T:000000;GFNT:666666;GIMP:666666;FORID:11" />
<input type="hidden" name="hl" value="it" />
</td></tr>
<tr>
<td nowrap="nowrap" colspan="2">
<table summary="">
	<tr>
		<td>
			<input type="radio" name="sitesearch" value="" checked="checked" id="ss0" />
		<label for="ss0" title="Ricerca nel Web"><font size="-1" color="#000000">Web</font></label></td>
			<td>
				<input type="radio" name="sitesearch" value="sassarionline.net" id="ss1" />
			<label for="ss1" title="Cerca sassarionline.net"><font size="-1" color="#000000">sassarionline.net</font></label></td>
				<td>
					<input type="radio" name="sitesearch" value="fantacalciobazar.altervista.org" id="ss2" />
				<label for="ss2" title="Cerca fantacalciobazar.altervista.org"><font size="-1" color="#000000">fantacalciobazar.altervista.org</font></label></td>
					<td>
						<input type="radio" name="sitesearch" value="fantacalciobazar.sssr.it" id="ss3" />
					<label for="ss3" title="Cerca fantacalciobazar.sssr.it"><font size="-1" color="#000000">fantacalciobazar.sssr.it</font></label></td>
					</tr>
				</table>
			</td></tr></table>
		</form>
		<!-- SiteSearch Google -->
	</div>
</div>
<?php
include("./footer.php");
?>