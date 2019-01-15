<?php
##################################################################################
#    FANTACALCIOBAZAR EVOLUTION
#    Copyright (C) 2003-2008 by Antonello Onida
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
require_once("./controlla_pass.php");
include("./header.php");

if ($_SESSION['valido'] == "SI") {

$scrivi = "SI";
$filecambi = $percorso_cartella_dati."/cambi_tra_".$_SESSION['utente'];
################################
# controlla esistenza file cambi

if (is_file($filecambi))
$contenuto_cambi = file($filecambi);
else {
$crea_file = "";
$filesquadra = fopen($filecambi,"wb+");
flock($filesquadra,LOCK_EX);
fwrite($filesquadra,$crea_file);
flock($filesquadra,LOCK_UN);
fclose($filesquadra);
} # fine else

#################################
# inserisce valutazione cessione
# aggiunti controlli

if ($ins_val_ces == "SI") {
$contenuto_cambi = file($filecambi);
$righe_contenuto_cambi = count($contenuto_cambi);

for ($num1 = 0 ; $num1 < $righe_contenuto_cambi ; $num1++) {
$dat_val_cal = explode("," , $contenuto_cambi[$num1]);
$num_val_cal = $dat_val_cal[0];
$num_val_cal = togli_acapo($num_val_cal);

if ($num_val_cal == $num_cal) {
echo "<meta http-equiv='refresh' content='1; url=cambi_tra.php'>
<center><h3>Calciatore gia' selezionato</center></h3>";
$scrivi ="NO";
exit;
}
} # fine ciclo for

if ($scrivi == "SI") {
$nome = str_replace("\\","", $nome);
$nuova_linea = "$num_cal,$nome,$ruolo,$costo,$val_cal,0".$acapo;
$filesquadra = fopen($filecambi,"ab+");
flock($filesquadra,LOCK_EX);
fwrite($filesquadra,$nuova_linea);
flock($filesquadra,LOCK_UN);
fclose($filesquadra);

echo "<center><h3>Valutazione cessione inserita!<br/><br/>$nuova_linea</h3>";
}
} # fine ($ins_val_ces == "SI")


#################################
# inserisce valutazione acquisto
# aggiunti controlli

if ($ins_val_acq == "SI") {
$contenuto_cambi = file($filecambi);
$righe_contenuto_cambi = count($contenuto_cambi);

for ($num1 = 0 ; $num1 < $righe_contenuto_cambi ; $num1++) {
$dat_val_cal = explode("," , $contenuto_cambi[$num1]);
$num_val_cal = $dat_val_cal[0];
$num_val_cal = togli_acapo($num_val_cal);

if ($num_val_cal == $num_cal) {
echo "<meta http-equiv='refresh' content='1; url=cambi_tra.php'>
<center><h3>Calciatore gia' selezionato</center></h3>";
$scrivi ="NO";
exit;
}
} # fine ciclo for

$calciatori = @file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
$num_calciatori = count($calciatori);

for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {

$contr_calciatore = explode(",", $calciatori[$num1]);
$contrnum = $contr_calciatore[0];
$contrpro = $contr_calciatore[4];

if ($contrnum == $num_cal and $contrpro == $_SESSION['utente']) {
echo "<meta http-equiv='refresh' content='1; url=cambi_tra.php'>
<center><h3>Calciatore già in tuo possesso</center></h3>";
$scrivi ="NO";
break;
}
} # fine ciclo for

if ($scrivi == "SI") {
$num_val_cal = - $val_cal;
$nome = str_replace("\\","", $nome);
$nuova_linea = "$num_cal,$nome,$ruolo,0,$num_val_cal,1".$acapo;
$filesquadra = fopen($filecambi,"ab+");
flock($filesquadra,LOCK_EX);
fwrite($filesquadra,$nuova_linea);
flock($filesquadra,LOCK_UN);
fclose($filesquadra);
echo "<center><h3>Valutazione acquisto inserita!<br/><br/>$nuova_linea</h3>";
}
} # fine ($ins_val_acq == "SI")


#################################
# elimina valutazioni

if ($eli_val == "SI") {
$linee = @file($filecambi);
$filesquadra = fopen($filecambi,"wb+");
flock($filesquadra,LOCK_EX);
$num_linee = count($linee);
rewind($filesquadra);

$scrivi_file = "";
for ($num1 = 0 ; $num1 < $num_linee ; $num1++) {
$dat_val_cal = explode("," , $linee[$num1]);
$num_val_cal = $dat_val_cal[0];
$num_val_cal = togli_acapo($num_val_cal);

if ($num_val_cal != $num_cal and $linee[$num1] != "") $scrivi_file .= "$linee[$num1]";

} # fine for $num1
fwrite($filesquadra,$scrivi_file);
flock($filesquadra,LOCK_UN);
fclose($filesquadra);
echo "<center><h3>Valutazione eliminata!<br/>$num_cal</h3>";

} # fine ($eli_val == "SI")

#################################
# elimina TUTTE valutazioni

if ($eli_tutti == "SI") {
if (@is_file($filecambi)) unlink ($filecambi);
echo "<center><h3>Valutazioni eliminate!</h3>";

} # fine ($eli_tutti == "SI")

echo "<br/><br/><br/><br/><br/><br/><br/>
<a href='cambi_tra.php' class='user1'>Prosegui</a></center><br/><br/><br/><br/><br/>
<meta http-equiv='refresh' content='0; url=cambi_tra.php'>";

} # fine if ($pass_errata != "SI")
include("./footer.php");
?>