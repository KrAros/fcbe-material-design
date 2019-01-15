<?php
##################################################################################
#    FANTACALCIOBAZAR
#    Copyright (C) 2003-2006 by Antonello Onida (fantacalciobazar@sassarionline.net)
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
require_once("./controlla_pass.php");
include("./header.php");

	if ($_SESSION['valido'] == "SI") {
	require("./menu.php");
$lock = fopen("$percorso_cartella_dati/mercato.lock","w+");
flock($lock,2);

$trovato = "NO";
$calciatori = file("$percorso_cartella_dati/mercato.txt");
$num_calciatori = count($calciatori);
for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
$dati_calciatore = explode(",", $calciatori[$num1]);
$numero = $dati_calciatore[0];
$proprietario = $dati_calciatore[4];

if ($proprietario == $_SESSION['utente']) {
if ($num_calciatore == $numero) {
$nome = $dati_calciatore[1];
$ruolo = $dati_calciatore[2];
$costo = $dati_calciatore[3];
$tempo_off = $dati_calciatore[5];
$anno_off = substr($tempo_off,0,4);
$mese_off = substr($tempo_off,4,2);
$giorno_off = substr($tempo_off,6,2);
$ora_off = substr($tempo_off,8,2);
$minuto_off = substr($tempo_off,10,2);
$adesso = mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"));
$sec_restanti = mktime($ora_off,$minuto_off,0,$mese_off,$giorno_off,$anno_off) - $adesso;
if ($sec_restanti < 0) {
$trovato = "SI";
$posizione = $num1;
} # fine if ($sec_restanti < 0)
} # fine if ($num_calciatore == $numero)
} # fine if ($proprietario == $_SESSION['utente'])
} # fine for $num1

$verifica_num = ereg_replace("[0-9]","",$valore_rivendita);
if ($verifica_num != "") {
$trovato = "NO";
$frase = "L'offerta deve essere un numero intero.<br/>";
} # fine if ($verifica_num != "")

if ($stato_mercato == "C" or $stato_mercato == "S") {
$trovato = "NO";
$frase .= "Il mercato &egrave; <b>chiuso</b> o <b>sospeso</b> in questo momento.<br/>";
} # fine if ($stato_mercato == "C" or $stato_mercato == "S")

if ($trovato == "NO") {
echo "<html>
<header>
<title> Fantacalcio </title>
</header>
<body bgcolor=#ffffff>
Non puoi vendere questo calciatore.<br/>$frase";
} # fine if ($trovato == "NO")

else {

if ($mercato_libero != "SI") {

$file_mercato = fopen("$percorso_cartella_dati/mercato.txt","wb+");
flock($file_mercato,2);
for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
if ($posizione != $num1) {
fwrite($file_mercato,$calciatori[$num1]);
} # fine if ($posizione != $num1)
else {
$anno_attuale = date("Y");
$mese_attuale = date("m");
$giorno_attuale = date("d");
$ora_attuale = date("H");
$minuto_attuale = date("i");
$scadenza = date("YmdHi",mktime($ora_attuale+$aspetta_ore,$minuto_attuale+$aspetta_minuti,0,$mese_attuale,$giorno_attuale+$aspetta_giorni,$anno_attuale));
$nuovo_costo = $valore_rivendita - 1;
$linea = "$num_calciatore,$nome,$ruolo,$costo,$_SESSION['utente'],$scadenza,$nome_utente,$costo,$nuovo_costo";
fwrite($file_mercato,"$linea
");
} # fine else if ($posizione != $num1)
} # fine for $num1
flock($file_mercato,3);
fclose($file_mercato);

$lockutente = fopen("$percorso_cartella_dati/squadra_$_SESSION['utente'].lock","w+");
flock($lockutente,2);
$linee = @file("$percorso_cartella_dati/squadra_$_SESSION['utente']");
$filesquadra = fopen("$percorso_cartella_dati/squadra_$_SESSION['utente']","w+");
flock($filesquadra,2);
$num_linee = count($linee);
if ($num_linee < 1) { $num_linee = 1; }
$nuovo_surplus = $linee[0] + $aggiungi_surplus;
$linee[0] = "$nuovo_surplus
";
rewind($filesquadra);
for ($num1 = 0 ; $num1 < $num_linee ; $num1++) {
fwrite($filesquadra,$linee[$num1]);
} # fine for $num1
flock($filesquadra,LOCK_UN);
flock($lockutente,LOCK_UN);
} # fine mercato != libero

else  {
$file_mercato = fopen("$percorso_cartella_dati/mercato.txt","wb+");
flock($file_mercato,LOCK_EX);
for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
if ($posizione != $num1) {
fwrite($file_mercato,$calciatori[$num1]);
} # fine if ($posizione != $num1)
else {
$aggiungi_surplus = $valore_rivendita;
} # fine else if ($posizione != $num1)
} # fine for $num1
flock($file_mercato,3);
fclose($file_mercato);

}

echo "<html>
<header>
<title> fantacalcio </title>
</header>
<body bgcolor=#ffffff>
<center><h4>Calciatore rimesso sul mercato per <b>$valore_rivendita</b> Fanta-Euro!<br/>";
} # fine else if ($trovato == "NO")

flock($lock,LOCK_UN);

} # fine if ($pass_errata != "SI")

include("./footer.php");
?>