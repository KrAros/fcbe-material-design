<?php
##################################################################################
#    FANTACALCIOBAZAR
#    Copyright (C) 2003-2007 by Antonello Onida (fantacalcio@sssr.it)
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
require ("./controlla_pass.php");
require ("./header.php");

if ($_SESSION['valido'] == "SI") {
require ("./menu.php");

$lock = fopen("$percorso_cartella_dati/mercato.lock","w+");
flock($lock,2);

$trovato = "NO";
$scrivi = "NO";

$calciatori = @file("$percorso_cartella_dati/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
$num_calciatori = count($calciatori);

for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
$dati_calciatore = explode(",", $calciatori[$num1]);
$numero = $dati_calciatore[0];
$proprietario = $dati_calciatore[4];

if ($proprietario == $_SESSION['utente']) {
if ($num_calciatore == $numero) {

$codice = $dati_calciatore[0];
$nome = $dati_calciatore[1];
$ruolo = $dati_calciatore[2];
$costo = $dati_calciatore[3];
$tempo_off = $dati_calciatore[5];
$anno_off = substr($tempo_off,0,4);
$mese_off = substr($tempo_off,4,2);
$giorno_off = substr($tempo_off,6,2);
$ora_off = substr($tempo_off,8,2);
$minuto_off = substr($tempo_off,10,2);
$data_acquisto = mktime($ora_off,$minuto_off,0,$mese_off,$giorno_off,$anno_off) - $adesso;
$data_cessione = mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"));
$tempo_contratto = $data_acquisto - $data_cessione;

$trovato = "SI";
$posizione = $num1;

} # fine if ($num_calciatore == $numero)
} # fine if ($proprietario == $_SESSION['utente'])
} # fine for $num1

if ($stato_mercato == "C") {
$trovato = "NO";
$frase1 = "Il mercato &egrave; <b>chiuso</b> in questo momento.<br>";
} # fine if ($stato_mercato == "C")

if ($trovato == "NO") {
echo "Il calciatore non é stato trovato.<br>$frase";
} # fine if ($trovato == "NO")

else {

### Ricerca valore aggiornato da ultimo file voti presente

for ($num1 = "01" ; $num1 < 40 ; $num1++) {
if (strlen($num1) == 1) $num1 = "0".$num1;

$percorso = "$percorso_cartella_voti/voti$num1.txt";

if (is_file("$percorso")) { echo "";} # fine if
else {
$num1 = $num1 -1;
if (strlen($num1) == 1) $num1 = "0".$num1;
$ultima_giornata = $num1;
break;
}

} # fine for $num1

if ($ultima_giornata != 0) $percorso = "$prima_parte_pos_file_voti$ultima_giornata$seconda_parte_pos_file_voti";
else $percorso = "dati/calciatori.txt";

$cerca_calciatore = file("$percorso");

$num_cerca_calciatori = count($cerca_calciatore);
echo "<center><h3>Cessione calciatore</h3></center>
<table border=1 cellspacing=2 cellpadding=5 align=\"center\" bgcolor=\"$sfondo_tab\">
<tr>
<td class=testa>Num.</td>
<td class=testa>Nome</td>
<td class=testa>Ruolo</td>
<td class=testa>Valore</td>
<td class=testa>Squadra</td></tr>";

for ($num1 = 0 ; $num1 < $num_cerca_calciatori ; $num1++) {

$dati_cerca_calciatore = explode($separatore_campi_file_calciatori, $cerca_calciatore[$num1]);
$numero_cerca = $dati_cerca_calciatore[($num_colonna_numcalciatore_file_calciatori-1)];
$numero_cerca = togli_acapo($numero_cerca);

if ($numero_cerca == $num_calciatore) {

$nome_cerca = $dati_cerca_calciatore[($num_colonna_nome_file_calciatori-1)];
$nome_cerca = togli_acapo($nome_cerca);
$nome_cerca = ereg_replace("\"","",$nome_cerca);
$s_ruolo_cerca = $dati_cerca_calciatore[($num_colonna_ruolo_file_calciatori-1)];
$s_ruolo_cerca = togli_acapo($s_ruolo_cerca);
$ruolo_cerca = $s_ruolo_cerca;
$valore_cerca = $dati_cerca_calciatore[($num_colonna_valore_calciatori-1)];
$valore_cerca = togli_acapo($valore_cerca);

$xsquadra_cerca = $dati_cerca_calciatore[($num_colonna_squadra_file_calciatori-1)];
$xsquadra_cerca = togli_acapo($xsquadra_cerca);
$xsquadra_cerca = ereg_replace("\"","",$xsquadra_cerca);

if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
if ($s_ruolo_cerca == $simbolo_fantasista_file_calciatori) $ruolo_cerca = $considera_fantasisti_come;
if ($s_ruolo_cerca == $simbolo_portiere_file_calciatori) $ruolo_cerca = "P";
if ($s_ruolo_cerca == $simbolo_difensore_file_calciatori) $ruolo_cerca = "D";
if ($s_ruolo_cerca == $simbolo_centrocampista_file_calciatori) $ruolo_cerca = "C";
if ($s_ruolo_cerca == $simbolo_attaccante_file_calciatori) $ruolo_cerca = "A";

echo"<tr><td align=\"center\">$numero</td>
<td>$nome_cerca</td>
<td>$ruolo_cerca</td>
<td>$prezzo_vendita</td>
<td>$xsquadra_cerca</td>
</tr>";
}
} # fine for $num1

echo "</table>";

if ($vendi_costo == "SI") {
$prezzo_vendita = round(($costo/100)*$percentuale_vendita);
$aggiungi_surplus = $prezzo_vendita - $costo;
}
else {
$prezzo_vendita = round(($valore_cerca/100)*$percentuale_vendita);
$aggiungi_surplus = $prezzo_vendita - $costo;
}


####### scrittura su file mercato.txt #######

$file_mercato = fopen($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt","wb+");
flock($file_mercato,LOCK_EX);
for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
if ($posizione != $num1) {
fwrite($file_mercato,$calciatori[$num1]);
} # fine if ($posizione != $num1)
} # fine for $num1
flock($file_mercato,LOCK_UN);
fclose($file_mercato);

####### scrittura su file squadra_nomeutente #######

#if ($stato_mercato != "I" OR $stato_mercato == "R") {

$file = file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg, $otitolari, $opanchina, $onome, $ocognome) = explode("<del>", trim($file[$_SESSION['uid']]));
$nuovo_credito = $ocrediti + $aggiungi_surplus;

$agg_dati = $outente."<del>".($opass)."<del>".$opermessi."<del>".$oemail."<del>".$ourl."<del>".$osquadra."<del>".$otorneo."<del>".$oserie."<del>".$ocittà."<del>".$nuovo_credito."<del>".$ovariazioni."<del>".$ocambi."<del>".$oreg. "<del>0<del>0<del>".$onome."<del>".$ocognome."<del>0<del>0<del>0<del>0<del>0<del>0<del>0<del>0".$acapo;

$file[$_SESSION['uid']] = $agg_dati;

$nuovi_dati = implode ("",$file);
$agg_file = fopen($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php", "wb");
flock($agg_file,LOCK_EX);
fwrite($agg_file, $nuovi_dati);
flock($agg_file,LOCK_UN);
fclose($agg_file);

#}

echo "<center><h3>Calciatore tolto dalla busta chiusa!</h3><center>";
} # fine else if ($trovato == "NO")

echo "<br><center><form method=\"post\" action=\"squadra.php\">
<input type=\"submit\" name=\"torna_squadra\" value=\"Torna alla squadra\">
</form></center><br><br><br><br><br>";

flock($lock,3);

} # fine if ($_SESSION['valido'] == "SI" {
else echo"<meta http-equiv=\"refresh\" content=\"0; url=logout.php\">";
echo"</td></tr></table>";
require ("./footer.php");
?>
