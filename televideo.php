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
if ($_SESSION['valido'] == "SI") {
if ($_SESSION['permessi'] == 5) require ("./a_menu.php");
else require ("./menu.php");

if (!$_GET['telev']) $telev = "200"; else $telev = $_GET['telev'];
if (!$_GET['sottop']) $sottop = "";
if ($_POST['invio'] == "Precedente") $telev = $telev-1;
if ($_POST['invio'] == "Successiva") $telev = $telev+1;

if ($sottop == "")
$lnkimage = "http://www.televideo.rai.it/televideo/pub/tt4web/Nazionale/page-" . $telev . ".png";
else
$lnkimage = "http://www.televideo.rai.it/televideo/pub/tt4web/Nazionale/page-" . $telev . "." . $sottop . ".png";

if (!@fopen($lnkimage, "r")){
$errore = "URL: $lnkimage non trovata";
if ($sottop == "") {
$lnkimage = "http://www.televideo.rai.it/televideo/pub/tt4web/Nazionale/page-" . $telev . ".png";
$sottop = "";
}
elseif ($sottop != "") {
$sottop = "2";
$lnkimage = "http://www.televideo.rai.it/televideo/pub/tt4web/Nazionale/page-" . $telev . "." . $sottop . ".png";
}
else
$lnkimage = "http://www.televideo.rai.it/televideo/pub/tt4web/Nazionale/page-100.png";
}

$tp = $telev -1;
$ts = $telev +1;
/*
echo "<form method='post' action='televideo.php'>
<input type='hidden' name='telev' value='".$_GET['telev']."' />
<table align=center cellpadding=5 cellspacing=10 width='100%'>
<tr><td bgcolor=black align=center valign=middle>
<img SRC='$lnkimage' hspace=5 vspace=5 alt='Televideo RAI' /></td>
<td align=center valign=middle>
<h2>Televideo RAI</h2><br/><br/>Pagina <input type='text' name='telev' size=3 maxlength=3 value='$telev' />
Sottopagina <input type='text' name='sottop' size=2 maxlength=2 value='$sottop' />
<input type='submit' name='invio' value='Vai' /><br/><br/>
<input type='submit' name='invio' value='$tp' />
<input type='submit' name='invio' value='$ts' /><br/>  <br/>
<input type='submit' name='telev' value='100' />
<input type='submit' name='telev' value='200'/><br/><br/>
Se non appare la pagina televideo pu&ograve; significare <br/>che la pagina non esiste <br/>o che occorre cambiare il numero di sottopagina.";
*/
#if ($errore) echo "<hr>$errore";
echo"<table align='center' cellpadding='5' cellspacing='10' width='100%'>
<tr><td bgcolor='black' align='center' valign='middle'>
<img SRC='$lnkimage' hspace='5' vspace='5' alt='Televideo RAI' /></td>
<td align='center' valign='middle'>
<a href='televideo.php?telev=230'>Atalanta</a> <br />
<a href='televideo.php?telev=231'>Bologna</a><br />
<a href='televideo.php?telev=232'>Cagliari</a> <br />
<a href='televideo.php?telev=233'>Chievo</a> <br />
<a href='televideo.php?telev=234'>Crotone</a> <br />
<a href='televideo.php?telev=235'>Empoli</a> <br />
<a href='televideo.php?telev=236'>Fiorentina</a> <br />
<a href='televideo.php?telev=237'>Genoa</a> <br />
<a href='televideo.php?telev=238'>Inter</a> <br />
<a href='televideo.php?telev=239'>Juventus</a> <br />
<a href='televideo.php?telev=240'>Lazio</a> <br />
<a href='televideo.php?telev=241'>Milan</a> <br />
<a href='televideo.php?telev=242'>Napoli</a> <br />
<a href='televideo.php?telev=243'>Palermo</a> <br />
<a href='televideo.php?telev=244'>Pescara</a> <br />
<a href='televideo.php?telev=245'>Roma</a> <br />
<a href='televideo.php?telev=246'>Samp</a> <br />
<a href='televideo.php?telev=247'>Sassuolo</a> <br />
<a href='televideo.php?telev=248'>Torino</a> <br />
<a href='televideo.php?telev=249'>Udinese</a> <br /> <br />
<br/>
<a href='televideo.php?telev=229'>Brevi calcio</a> <br />
<br/>
<a href='televideo.php?telev=200'>Indice</a> <br />
</td></tr></table></form>";
} # fine if ($_SESSION['valido'] == "SI"
else header("location: logout.php?logout=2"); 
include("./footer.php");
?>