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
##################################################################################

$percorso_cartella_dati = "./dati";   			# Modificare in caso di variazione
$percorso_cartella_voti = "./dati";   			# Modificare in caso di variazione

include("$percorso_cartella_dati/dati.php");
include("./inc/funzioni.php");
include("header.php");

$partite_giocate = 0;
$somma_voti_tot = 0;
$somma_voti_giornale = 0;
for ($num1 = "01" ; $num1 <= $giornata ; $num1++) {
if (strlen($num1) == 1) $num1 = "0".$num1;
if ($voti = @file("$prima_parte_pos_file_voti$num1$seconda_parte_pos_file_voti")) {
$num_voti = count($voti);
for ($num2 = 0 ; $num2 < $num_voti ; $num2++) {
$dati_voto = explode($separatore_campi_file_voti, $voti[$num2]);
$num_calciatore_voto = $dati_voto[($num_colonna_numcalciatore_file_voti-1)];
$num_calciatore_voto = togli_acapo($num_calciatore_voto);

if ($num_calciatore_voto == $num_calciatore) {
$voto_tot = $dati_voto[($num_colonna_vototot_file_voti-1)];
$voto_tot = togli_acapo($voto_tot);
$voto_tot = str_replace(",",".",$voto_tot);
$voto_giornale = $dati_voto[($num_colonna_votogiornale_file_voti-1)];
$voto_giornale = togli_acapo($voto_giornale);
$voto_giornale = str_replace(",",".",$voto_giornale);
if ($voto_tot != 0 or $voto_giornale != 0) {
$partite_giocate++;
$somma_voti_tot = $somma_voti_tot + $voto_tot;
$somma_voti_giornale = $somma_voti_giornale + $voto_giornale;
} # fine if ($voto_tot != 0 or $voto_giornale != 0)

if ($statistiche == "SI") {
$stat_codice = $dati_voto[($ncs_codice -1)];  
$stat_giornata = $dati_voto[($ncs_giornata -1)];
$stat_nome = $dati_voto[($ncs_nome -1)];
$stat_nome = ereg_replace("\"","",$stat_nome);
$stat_squadra = $dati_voto[($ncs_squadra -1)];
$stat_squadra = ereg_replace("\"","",$stat_squadra);
$stat_attivo = $dati_voto[($ncs_attivo -1)];
$stat_ruolo = $dati_voto[($ncs_ruolo -1)];
$stat_presenza = $dati_voto[($ncs_presenza -1)]; $totpresenze = $totpresenze + $stat_presenza;
$stat_votofc = $dati_voto[($ncs_votofc -1)]; $totvotfc = $totvotfc + $stat_votofc;
$stat_mininf25 = $dati_voto[($ncs_mininf25 -1)]; $totmininf25 = $totmininf25 + $stat_mininf25;
$stat_minsup25 = $dati_voto[($ncs_minsup25 -1)]; $totminsup25 = $totminsup25 + $stat_minsup25;
$stat_voto = $dati_voto[($ncs_voto -1)]; $totvot = $totvot + $stat_voto;
$stat_golsegnati = $dati_voto[($ncs_golsegnati -1)]; $totgol = $totgol + $stat_golsegnati;
$stat_golsubiti = $dati_voto[($ncs_golsubiti -1)]; $totgolsub = $totgolsub + $stat_golsubiti;
$stat_golvittoria = $dati_voto[($ncs_golvittoria -1)]; $totgolvit = $totgolvit + $stat_golvittoria;
$stat_golpareggio = $dati_voto[($ncs_golpareggio -1)]; $totgolpar = $totgolpar + $stat_golpareggio;
$stat_assist = $dati_voto[($ncs_assist -1)]; $totass = $totass + $stat_assist;
$stat_ammonizione = $dati_voto[($ncs_ammonizione -1)]; $totamm = $totamm + $stat_ammonizione; 
$stat_espulsione = $dati_voto[($ncs_espulsione -1)]; $totesp = $totesp + $stat_espulsione; 
$stat_rigoretirato = $dati_voto[($ncs_rigoretirato -1)]; $totrigt = $totrigt + $stat_rigoretirato;
$stat_rigoresubito = $dati_voto[($ncs_rigoresubito -1)]; $totrigs = $totrigs + $stat_rigoresubito;
$stat_rigoreparato = $dati_voto[($ncs_rigoreparato -1)]; $totrigp = $totrigp + $stat_rigoreparato;
$stat_rigoresbagliato = $dati_voto[($ncs_rigoresbagliato -1)]; $totrigsb = $totrigsb + $stat_rigoresbagliato;
$stat_autogol = $dati_voto[($ncs_autogol -1)]; $totaut = $totaut + $stat_autogol;
$stat_subentrato = $dati_voto[($ncs_entrato -1)];
$stat_titolare = $dati_voto[($ncs_titolare -1)]; $tottit = $tottit + $stat_titolare;
$stat_valore = $dati_voto[($ncs_valore -1)];
}

break;
} # fine if ($num_calciatore == $num_calciatore_voto)
$ultima_giornata = $num1;

} # fine if ($voti = @file("$percorso_cartella_voti/voti$num1.txt"))
} # fine for $num2
} # fine for $num1

if ($partite_giocate != 0) {
$media_giornale = round(($somma_voti_giornale / $partite_giocate),2);
$media_punti = round(($somma_voti_tot / $partite_giocate),2);
} # fine if ($partite_giocate != 0)
else {
$media_giornale = 0;
$media_punti = 0;
} # fine else if ($partite_giocate != 0)

$calciatori = file("$percorso_cartella_voti/calciatori.txt");
$num_calciatori = count($calciatori);
for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
$dati_calciatore = explode($separatore_campi_file_calciatori, $calciatori[$num1]);
$numero = $dati_calciatore[($num_colonna_numcalciatore_file_calciatori-1)];
$numero = togli_acapo($numero);
if ($num_calciatore == $numero) {
$nome = $dati_calciatore[($num_colonna_nome_file_calciatori-1)];
$nome = togli_acapo($nome);
$nome = ereg_replace("\"","",$nome);
if ($num_colonna_squadra_file_calciatori != 0) {
$xsquadra = $dati_calciatore[($num_colonna_squadra_file_calciatori-1)];
$xsquadra = togli_acapo($xsquadra);
$xsquadra = ereg_replace("\"","",$xsquadra);
} # fine if ($num_colonna_squadra_file_calciatori != 0)
$s_ruolo = $dati_calciatore[($num_colonna_ruolo_file_calciatori-1)];
$s_ruolo = togli_acapo($s_ruolo);
$ruolo = $s_ruolo;
if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
if ($s_ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
if ($s_ruolo == $simbolo_portiere_file_calciatori) $ruolo = "P";
if ($s_ruolo == $simbolo_difensore_file_calciatori) $ruolo = "D";
if ($s_ruolo == $simbolo_centrocampista_file_calciatori) $ruolo = "C";
if ($s_ruolo == $simbolo_attaccante_file_calciatori) $ruolo = "A";
break;
} # fine if ($num_calciatore == $numero)
} # fine for $num1

echo "<center><h3>Statistiche</h3><table width=\"90%\" class=border border=0 cellspacing=2 cellpadding=2 align=\"center\" bgcolor=\"$sfondo_tab\">
<tr><td class=testa>Num.</td>
<td class=testa>Nome</td>
<td class=testa>Ruolo</td>";
if ($xsquadra) echo "<td class=testa>Squadra</td>";
echo "<td class=testa>Partite giocate</td>
<td class=testa>Media voti giornale</td>
<td class=testa>Media punti</td></tr>
<tr bgcolor=white><td align=\"center\">$num_calciatore</td>
<td>$nome</td>
<td align=\"center\">$ruolo</td>";
if ($xsquadra) echo "<td align=\"center\">$xsquadra</td>";
echo "<td align=\"center\">$partite_giocate</td>
<td align=\"center\">$media_giornale</td>
<td align=\"center\">$media_punti</td>
</tr></table>";


if ($statistiche == "SI") {
if ($stat_attivo == 0) $mess = "<b><font color=red>Non disponibile</font></b>";
else $mess = "In attività";

if ($stat_ruolo == 0) $st_ruolo = "Portiere";
if ($stat_ruolo == 1) $st_ruolo = "Difensore";
if ($stat_ruolo == 2) $st_ruolo = "Centrocampista";
if ($stat_ruolo == 3) $st_ruolo = "Fantasista";
if ($stat_ruolo == 4) $st_ruolo = "Attaccante";

$tabstat1 = "<center><h4>Statistiche complete</h4></center><table width=\"90%\" border=0 cellspacing=0 cellpadding=10 align=\"center\" bgcolor=\"$sfondo_tab\"><tr><td width=\"35%\">";
$tabstat2 = "</td></tr></table>";

$tabstat3 = "<table width=\"100%\" class=border border=0 cellspacing=1 cellpadding=1 align=\"center\" bgcolor=\"$sfondo_tab2\">
<tr bgcolor=white><td>Codice</td><td align=center>$stat_codice</td></tr>
<tr><td>Giornata</td><td align=center>$stat_giornata</td></tr>
<tr bgcolor=white><td>Nome</td><td align=center><b>$stat_nome</b></td></tr>
<tr><td>Squadra</td><td align=center><b>$stat_squadra</b></td></tr>
<tr bgcolor=white><td>Status</td><td align=center>$mess</td></tr>
<tr><td>Ruolo</td><td align=center>$st_ruolo</td></tr>
<tr bgcolor=white><td>Valore</td><td align=center>$stat_valore</td></tr>";
if ($foto_calciatori == "SI") $tabstat3 .= "<tr bgcolor=white><td colspan=2 align=center><p><img src=\"$foto_path$num_calciatore.jpg\" border=1 hspace=5 vspace=5></p></td></tr>";
$tabstat3 .= "</table></td>";

$tabstat4 = "<td width=\"65%\" align=center><table width=\"80%\" class=border border=0 cellspacing=1 cellpadding=0 align=\"center\" bgcolor=\"$sfondo_tab\">
<tr><td class=testa width=\"50%\">Valori</td><td class=testa width=\"25%\">Ultima giornata</td><td class=testa width=\"25%\">Dati storici</td></tr>

<tr bgcolor=white><td>Presenza</td><td align=center>$stat_presenza</td><td align=center>$totpresenze</td></tr>
<tr><td>Voto FC</td><td align=center>$stat_votofc</td><td align=center>$totvotfc</td></tr>
<tr bgcolor=white><td>Voto Gazzetta</td><td align=center>$stat_voto</td><td align=center>$totvot</td></tr>
<tr><td>Gol segnati</td><td align=center>$stat_golsegnati</td><td align=center>$totgol</td></tr>
<tr bgcolor=white><td>Gol subiti</td><td align=center>$stat_golsubiti</td><td align=center>$totgolsub</td></tr>
<tr><td>Gol vittoria</td><td align=center>$stat_golvittoria</td><td align=center>$totgolvit</td></tr>
<tr bgcolor=white><td>Gol pareggio</td><td align=center>$stat_golpareggio</td><td align=center>$totgolpar</td></tr>
<tr><td>Assist</td><td align=center>$stat_assist</td><td align=center>$totass</td></tr>
<tr bgcolor=white><td>Ammonizione</td><td align=center>$stat_ammonizione</td><td align=center>$totamm</td></tr>
<tr><td>Espulsione</td><td align=center>$stat_espulsione</td><td align=center>$totesp</td></tr>
<tr bgcolor=white><td>Rigore tirato</td><td align=center>$stat_rigoretirato</td><td align=center>$totrigt</td></tr>
<tr><td>Rigore subito</td><td align=center>$stat_rigoresubito</td><td align=center>$totrigs</td></tr>
<tr bgcolor=white><td>Rigore parato</td><td align=center>$stat_rigoreparato</td><td align=center>$totrigp</td></tr>
<tr><td>Rigore sbagliato</td><td align=center>$stat_rigoresbagliato</td><td align=center>$totrigsb</td></tr>
<tr bgcolor=white><td>Autogol</td><td align=center>$stat_autogol</td><td align=center>$totaut</td></tr></table>";

echo "$tabstat1 $tabstat3 $tabstat4 $tabstat2";

} # fine if ($statistiche == "SI")

echo "<br/>";

include("footer.php");
?>