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

if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] == 5) {
require ("./a_menu.php");

if ($mod_file){

if ($cambia_qualcosa) {

if ($salva_modifiche) {
if (@fopen($mod_file,"w+")) {
$n_contenuto_dati = stripslashes($n_contenuto_dati);
$file_dati = fopen($mod_file,"wb+");
flock($file_dati,LOCK_EX);
fwrite($file_dati,$n_contenuto_dati);
flock($file_dati,LOCK_UN);
fclose($file_dati);
echo "<center><h3>Modifiche salvate.</h3></center><br/>";
echo"<meta http-equiv='refresh' content='0; url=a_gestione.php?messgestutente=32'>";
exit;
} # fine if (fopen("$percorso_cartella_dati/$mod_file","w+"))
else echo "<b>ERRORE</b>: si devono cambiare i permessi di scrittura del file <b>$mod_file</b> per salvare le modifiche: leggi il manuale.<br/>";
echo"<meta http-equiv='refresh' content='0; url=mercato.php?messgestutente=33'>";
exit;
} # fine if ($salva_modifiche)

} # fine if ($cambia_qualcosa)

else {
if (is_file($mod_file)) $linee_dati = file($mod_file);
else {
	$linee_dati = "";
	$avviso = "<font size='1' color='yellow'>&nbsp;&nbsp;&nbsp; # FILE NON ANCORA CREATO</font>";
}

echo "<form method='post' action='a_edita_file.php'>
<input type='hidden' name='cambia_qualcosa' value='SI' />
<input type='hidden' name='mod_file' value='$mod_file' />
<table bgcolor=$sfondo_tab width='100%'>
<caption>Modifica file: $mod_file $avviso</caption>
<tr><td align='center'>";

if (is_file($mod_file)) $linee_dati = file($mod_file);
else $linee_dati = "";
$num_linee_dati = count($linee_dati);
echo "<textarea name='n_contenuto_dati' rows='30' cols='120'>";
for ($num1 = 0 ; $num1 < $num_linee_dati; $num1++) echo stripslashes($linee_dati[$num1]);
echo "</textarea><br/>
<input type='submit' name='salva_modifiche' value='Salva le modifiche' />
<br/></td></tr></table></form>";
} # fine else if ($cambia_qualcosa)
} # fine if ($mod_file)
else {
echo"<meta http-equiv='refresh' content='0; url=a_gestione.php?messgestutente=34'>";
} # fine else if ($mod_file)

} # fine if ($_SESSION == "SI")
else echo"<meta http-equiv='refresh' content='0; url=logout.php'>";

include("./footer.php");
?>