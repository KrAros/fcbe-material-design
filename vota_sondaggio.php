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

if ($_SESSION['valido'] == "SI") {
require ("./menu.php");

if (@is_file("$percorso_cartella_dati/sondaggio.php")) {
echo"<table width='98%' align=center cellpadding=10 class=border bgcolor='$sfondo_tab'><tr><td class=testa1>Sondaggio attuale</td></tr><tr><td>";
include("$percorso_cartella_dati/sondaggio.php");
$voti_giocatore = "voti_".$_SESSION['utente'];
$voti_giocatore = count($$voti_giocatore);

if ($voti_consentiti != 0 and $voti_giocatore >= $voti_consentiti) echo "<b>Hai raggiunto il limite massivo di votazioni!</b><br/><br/>";
else echo "Sono consentiti <b>$voti_consentiti</b> voti.<br/><br/>";

if ($vota and ($voti_consentiti == 0 or $voti_giocatore < $voti_consentiti)) {
include("$percorso_cartella_dati/sondaggio.php");
$linee_sondaggio = file("$percorso_cartella_dati/sondaggio.php");
$filesondaggio = fopen("$percorso_cartella_dati/sondaggio.php","w+");
flock($filesondaggio,LOCK_EX);
$voti = "voti".$voto;
$$voti++;
$lung_nome_utente = strlen($_SESSION['utente'])+6;
$num_linee_sondaggio = count($linee_sondaggio);

for ($num1 = 0 ; $num1 < $num_linee_sondaggio; $num1++) {
if (substr($linee_sondaggio[$num1],0,6) == "\$voti".$voto or substr($linee_sondaggio[$num1],0,7) == "\$voti".$voto) {
$linee_sondaggio[$num1] = "\$voti".$voto." = ".$$voti.";".$acapo;
} # fine if (substr($linee_sondaggio[$num1],0,6) == "\$voti".$voto or substr($linee_sondaggio[$num1],0,7) == "\$voti".$voto)
if ($voti_consentiti != 0 or $voto_palese == "SI") {
if (substr($linee_sondaggio[$num1],0,$lung_nome_utente) == "\$voti_".$_SESSION['utente']) {
if ($voti_giocatore != 0) $linee_sondaggio[$num1] = str_replace(");",",);",$linee_sondaggio[$num1]);
if ($voto_palese == "NO") $nuovo_voto = 0;
else $nuovo_voto = $voto;
$linee_sondaggio[$num1] = str_replace(");","\"$nuovo_voto\");",$linee_sondaggio[$num1]);
} # fine if (substr($linee_sondaggio[$num1],0,$lung_nome_utente) == "\$voti_".$_SESSION['utente'])
} # fine if ($voti_consentiti != 0 or $voto_palese == "SI")
} # fine for $num1
rewind($filesondaggio);
for ($num1 = 0 ; $num1 < $num_linee_sondaggio; $num1++) {
fwrite($filesondaggio,$linee_sondaggio[$num1]);
} # fine for $num1
flock($filesondaggio,LOCK_UN);
fclose($filesondaggio);

require ("$percorso_cartella_dati/sondaggio.php");
} # fine if ($vota and ($voti_consentiti == 0 or $voti_giocatore < $voti_consentiti))

echo "<b>Domanda</b>: $domanda<br/>";
$num_opzioni = count($opzioni);
$voti_tot = 0;
for ($num1 = 0 ; $num1 < $num_opzioni; $num1++) {
$voti  = "voti".($num1+1);
$voti_tot = $voti_tot + $$voti;
} # fine for $num1
$voti_tot_p = $voti_tot;
if ($voti_tot_p == 0) $voti_tot_p = 1;
for ($num1 = 0 ; $num1 < $num_opzioni; $num1++) {
$voti  = "voti".($num1+1);
$voti  = $$voti;
$percentuale = round((($voti*100)/$voti_tot_p),1);
echo "<u>".($num1+1)."</u>. <b>".$opzioni[$num1]."</b>: <font color='red'><b>$percentuale%</b></font> ($voti voti)<br/>";
} # fine for $num1
echo "<br/><br/>Voti totali: $voti_tot<br/><br/>";

if ($voto_palese == "SI") {
$file = file("./dati/utenti_".$_SESSION['torneo'].".php");
for($i = 1; $i < sizeof($file); $i++){
@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$i]);
if ($outente != "admin") {
echo  "Voti di $outente: ";
$voti_giocatore = "voti_".$outente;
$num_voti_giocatore = count($$voti_giocatore);
$lista_voti = "";
for($num2 = 0 ; $num2 < $num_voti_giocatore; $num2++) $lista_voti .= ${$voti_giocatore}[$num2].", ";
echo substr($lista_voti,0,-2)."<br/>";
} # fine if ($outente != "admin") {
} # fine for $num1
} # fine if ($voto_palese == "SI")

} # fine if (@is_file("$percorso_cartella_dati/sondaggio.php"))
else "<center><h4>Nessun sondaggio attivo!</h4></center>";

echo "</td></tr></table></td></tr></table>";
} # fine if ($_SESSION['valido'] == "SI") {
else echo"<meta http-equiv='refresh' content='0; url=logout.php>";

include("./footer.php");
?>