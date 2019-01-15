<?php
##################################################################################
#    FANTACALCIOBAZAR EVOLUTION#    Copyright (C) 2003-2006 by Antonello Onida (fantacalciobazar@sassarionline.net)
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
require_once ("./controlla_pass.php");
include("./header.php");

if ($_SESSION['valido'] == "SI") {

echo "<table bgcolor='$sfondo_tab' align='center'>
<caption>Modifica squadra</caption><tr><td align='center'>";

$num_titolari = 0;
$num_titolari_P = 0;
$num_titolari_D = 0;
$num_titolari_C = 0;
$num_titolari_F = 0;
$num_titolari_A = 0;
$num_panchinari = 0;

$calciatori = file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
$num_calciatori = count($calciatori);
	for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
	$dati_calciatore = explode(",", $calciatori[$num1]);
	$numero = trim($dati_calciatore[0]);
	$proprietario = trim($dati_calciatore[4]);

	if ($proprietario == $_SESSION['utente']) {
	$ruolo = $dati_calciatore[2];
	$tempo_off = $dati_calciatore[5];
	$anno_off = substr($tempo_off,0,4);
	$mese_off = intval(substr($tempo_off,4,2));
	$giorno_off = substr($tempo_off,6,2);
	$ora_off = substr($tempo_off,8,2);
	$minuto_off = substr($tempo_off,10,2);
	$adesso = mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"));
	$sec_restanti = mktime($ora_off,$minuto_off,0,$mese_off,$giorno_off,$anno_off) - $adesso;

	if ($sec_restanti < 0) {
	$nome_schierato = "schierato$numero";

	if ($$nome_schierato == "titolare") {
	$nome_lista = "lista_titolari_$ruolo";
	$$nome_lista .= "$numero,";
	$num_titolari++;
	$nome_num_titolari = "num_titolari_$ruolo";
	$$nome_num_titolari++;
	} # fine if ($$nome_schierato == "titolare")

	if ($$nome_schierato == "panchinaro") {
	$num_in_panchina = "panchinaro$numero";
	$num_in_panchina = $$num_in_panchina;
	$verifica_num = preg_replace("#[0-9]#","",$num_in_panchina);

	if ($verifica_num != "" or $num_in_panchina > $max_in_panchina) {
	$inserire = "NO";
	$frase = "Si deve inserire la posizione del calciatore in panchina.<br />";
	} # fine if ($verifica_num != "")

	if ($num_in_panchina_usati[$num_in_panchina]) {
	$inserire = "NO";
	$frase .= "Vi sono 2 calciatori in panchina con lo stesso numero!<br />";
	} # fine if ($num_in_panchina_usati[$num_in_panchina])
	$num_in_panchina_usati[$num_in_panchina] = $numero;
	$num_panchinari++;
	} # fine if ($$nome_schierato == "panchinaro")
	} # fine if ($sec_restanti < 0)
	} # fine if ($proprietario == $_SESSION utente)
	} # fine for $num1

for ($num1 = 1 ; $num1 <= $max_in_panchina ; $num1++) {
if ($num_in_panchina_usati[$num1]) {
$numero = $num_in_panchina_usati[$num1];
$lista_panchinari .= "$numero,";
} # fine if ($num_in_panchina_usati[$num1])
} # fine for $num1

$lista_titolari = $lista_titolari_P.$lista_titolari_D.$lista_titolari_C.$lista_titolari_F.$lista_titolari_A;

$schema = $num_titolari_P.$num_titolari_D.$num_titolari_C.$num_titolari_A;
if ($num_titolari_F != 0) $schema = $num_titolari_P.$num_titolari_D.$num_titolari_C.$num_titolari_F.$num_titolari_A;
$schema_trovato = "NO";
if ($num_titolari > 11) {
$inserire = "NO";
$frase .= "Hai schierato più di 11 calciatori!<br />";
} # fine if ($num_titolari > 11)
if ($num_panchinari > $max_in_panchina) {
$inserire = "NO";
$frase .= "Hai schierato più di $max_in_panchina calciatori in panchina!<br />";
} # fine if ($num_panchinari > $max_in_panchina)
if ($num_titolari == 11) {
$num_schemi = count($schemi);

for ($num1 = 0 ; $num1 < $num_schemi ; $num1++) {
if ($schemi[$num1] == $schema) { $schema_trovato = "SI"; }
} # fine for $num1

if ($schema_trovato != "SI") {
$inserire = "NO";
$frase .= "Hai adottato uno schema non consentito!<br />";
} # fine if ($schema_trovato != "SI")
} # fine if ($num_titolari == 11)

if ($num_titolari < 11) {
$max_num_cons_P = 0;
$max_num_cons_D = 0;
$max_num_cons_C = 0;
$max_num_cons_F = 0;
$max_num_cons_A = 0;
$num_schemi = count($schemi);

for ($num1 = 0 ; $num1 < $num_schemi ; $num1++) {
if (strlen($schemi[$num1]) == 4) {
$num_cons_P = substr($schemi[$num1],0,1);
$num_cons_D = substr($schemi[$num1],1,1);
$num_cons_C = substr($schemi[$num1],2,1);
$num_cons_F = 0;
$num_cons_A = substr($schemi[$num1],3,1);
} # fine if (strlen($schemi[$num1]) == 4)
elseif (strlen($schemi[$num1]) == 5) {
$num_cons_P = substr($schemi[$num1],0,1);
$num_cons_D = substr($schemi[$num1],1,1);
$num_cons_C = substr($schemi[$num1],2,1);
$num_cons_F = substr($schemi[$num1],3,1);
$num_cons_A = substr($schemi[$num1],4,1);
} # fine elseif (strlen($schemi[$num1]) == 5)

if ($num_cons_P > $max_num_cons_P) { $max_num_cons_P = $num_cons_P; }
if ($num_cons_D > $max_num_cons_D) { $max_num_cons_D = $num_cons_D; }
if ($num_cons_C > $max_num_cons_C) { $max_num_cons_C = $num_cons_C; }
if ($num_cons_F > $max_num_cons_F) { $max_num_cons_F = $num_cons_F; }
if ($num_cons_A > $max_num_cons_A) { $max_num_cons_A = $num_cons_A; }
} # fine for $num1

if ($num_titolari_P > $max_num_cons_P) { $inserire = "NO"; $frase .= "Troppi portieri!<br />"; }
if ($num_titolari_D > $max_num_cons_D) { $inserire = "NO"; $frase .= "Troppi difensori!<br />"; }
if ($num_titolari_C > $max_num_cons_C) { $inserire = "NO"; $frase .= "Troppi centrocampisti!<br />"; }
if ($num_titolari_F > $max_num_cons_F) { $inserire = "NO"; $frase .= "Troppi fantasisti!<br />"; }
if ($num_titolari_A > $max_num_cons_A) { $inserire = "NO"; $frase .= "Troppi attaccanti!<br />"; }
} # fine if ($num_titolari < 11)

if ($inserire != "NO") {
$filesquadra = $percorso_cartella_dati."/squadra_".$_SESSION['utente'];
$clinee = @file($filesquadra);
$file_squadra = @fopen($filesquadra,"wb+");
flock($file_squadra,LOCK_EX);
$num_linee = count($clinee);
if ($num_linee < 3) { $num_linee = 3; }
$clinee[0] = "Test".$acapo;
$clinee[1] = "$lista_titolari".$acapo;
$clinee[2] = "$lista_panchinari".$acapo;
for ($num = 0 ; $num < $num_linee ; $num++) {
fwrite($file_squadra,$clinee[$num]);
} # fine for $num
flock($file_squadra,LOCK_UN);
fclose($file_squadra);
if ($reset_form) echo "Formazione Resettata";
	else echo"$lista_titolari - $lista_panchinari";
	
echo "<meta http-equiv='refresh' content='0; url=squadra.php'><center><h5>Modifiche effettuate</h5>";
} # fine if ($inserire != "NO")
else {
echo "<font class='evidenziato'>$frase</font>";
} # fine else if ($inserire != "NO")

if ($reset_form AND $outente == $_SESSION['utente']) unlink($percorso_cartella_dati."/squadra_".$outente);

echo "<br /><br /><center><form method='post' action='squadra.php'>
<input type='submit' name='torna_squadra' value='Torna alla squadra'>
</form></center>";
echo "</td></tr></table>";
echo"</td></tr></table>";

} # fine if ($_SESSION valido)

else echo"<meta http-equiv='refresh' content='0; url=logout.php'>";

include("./footer.php");
?>