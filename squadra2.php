<?php
##################################################################################
#    FANTACALCIOBAZAR EVOLUTION
#    Copyright (C) 2003-2006 by Antonello Onida (fantacalciobazar@sassarionline.net)
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

	if ($_SESSION['valido'] == "SI") require ("./menu.php");

		$utenti = @file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
		$linee = count($utenti);

			for($num1=1; $num1 < $linee; $num1++) {
			@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $utenti[$num1]);
			$dati_squadra = @file($percorso_cartella_dati."/squadra_".$outente);

			if ($sfondo_tab == "") $sfondo_tab = "#E4EDED";
			$color = "ghostwhite";
############################################
$titolo = "<h3><font color='red'>";
	if ($osquadra) $titolo .= "$osquadra";
	else $titolo .=  "Squadra";
$titolo .=  " di $outente</font></h3>";

echo "<center>$titolo\r\n<a href='javascript:history.back();' class='user'>Indietro</a></center>";
####################################################################

$blocco_P = ""; $blocco_D = ""; $blocco_C = ""; $blocco_A = ""; $panchina = "";

$titolari = explode(",", $dati_squadra[1]);
$num_titolari = count($titolari)-1;
for($num2 = 0 ; $num2 < $num_titolari; $num2++) {
$numero_titolare = $titolari[$num2];
if ($numero_titolare <= 200) $blocco_P .= "&nbsp;&nbsp;&nbsp;<img src='$foto_path$numero_titolare.jpg' class='shadow' alt='' />&nbsp;&nbsp;&nbsp;\r\n";
if ($numero_titolare > 200 and $numero_titolare <= 500) $blocco_D .= "&nbsp;&nbsp;<img src='$foto_path$numero_titolare.jpg' alt=''  class='shadow' />&nbsp;&nbsp;\r\n";
if ($numero_titolare > 500 and $numero_titolare <= 800) $blocco_C .= "&nbsp;&nbsp;<img src='$foto_path$numero_titolare.jpg' alt='' class='shadow' />&nbsp;&nbsp;\r\n";
if ($numero_titolare > 800) $blocco_A .= "&nbsp;&nbsp;<img src='$foto_path$numero_titolare.jpg' class='shadow' alt='' />&nbsp;&nbsp;\r\n";
} # fine for $num2

$panchinari = explode(",", $dati_squadra[2]);
$num_panchinari = count($panchinari)-1;
for ($num2 = 0 ; $num2 < $num_panchinari ; $num2++) {
$numero_panchinaro = $panchinari[$num2];
$panchina .= "<img src='$foto_path$numero_panchinaro.jpg' border='1' alt='' width='30' /><br/><br/>\r\n";
} # fine for $num2

echo "<table cellspacing='10' border='0' bgcolor='$sfondo_tab'>\r\n
<tr><td align='center' valign='middle'>\r\n
<h4><u>Titolari</u></h4>\r\n
</td>\r\n
<td align='center' valign='middle'>\r\n
<h5><u>Panchina</u></h5>\r\n
</td>\r\n
</tr>\r\n
<tr>\r\n
<td align='center' valign='top'>\r\n
$blocco_P<br/><br/><br/>\r\n
$blocco_D<br/><br/><br/>\r\n
$blocco_C<br/><br/><br/>\r\n
$blocco_A</td>\r\n
<td align='center' valign='top'>\r\n
$panchina\r\n
</td></tr></table>\r\n";
########################

echo "<br/><br/><hr width='95%' />";

			} # fine for $num1

include("./footer.php");
?>