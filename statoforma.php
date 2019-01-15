<?php

##################################################################################
#    FANTACALCIOBAZAR
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
#
#
# 07-09-03  fire@dabrosca.net :
# Legge dal file \dati\squadre.txt l'elenco dewlle squadre e prepara il combo per
# la selezione della squadra
# 			$o_team = squadra selezionata
##################################################################################

$percorso_cartella_dati = "./dati";
$percorso_cartella_voti = $percorso_cartella_dati;
include("header.php");
include("$percorso_cartella_dati/dati.php");
include("./inc/funzioni.php");
if ($pass_errata != "SI") {
$linea = "";

echo "<form method=\"post\" action=\"stateam.php?vedi_squadra=$o_team&nome_utente=$nome_utente&pass_fornita=$pass_fornita\"><b>Visualizza squadra</b><br/>
<input type=\"hidden\" name=\"nome_utente\" value=\"$nome_utente\">
<input type=\"hidden\" name=\"pass_fornita\" value=\"$pass_fornita\">
<select name=\"o_team\" onChange='submit()'> ";

/*Leggo il file con le squadre*/
$team = file("$percorso_cartella_voti/squadre.txt");
$numteam=count($team);

$f_team = file("$percorso_cartella_voti/squadre.txt");
$numteam=count($f_team);
for ($i=0; $i<$numteam; $i++) {
$tmp= explode(",", $f_team[$i]);
$team[$i] = $tmp[1];
};

for($num1 = 0 ; $num1 < $numteam; $num1++) {

$o_team = $team[$num1];


echo "<option value=\"$o_team\">$o_team</option>";
} # fine for $num1

echo "</select>&nbsp;<input type=\"submit\" name=\"guarda_squadra\" value=\"Vedi\"></form>";

} # fine if ($pass_errata != "SI")

echo "<br/><left><br/><a href=\"javascript:history.back();\"><b>Torna indietro</b></a></center>";
include("footer.php");
echo "<br/><br/>";

?>