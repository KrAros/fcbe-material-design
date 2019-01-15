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
$escludi_controllo = $_POST['escludi_controllo'];

if ($escludi_controllo != "SI") {
	require_once ("./controlla_pass.php");
	require_once("./inc/funzioni.php");
	include("./header.php");
	require ("menu.php");
}
else {
	require ("./dati/dati_gen.php");
	require_once("./inc/funzioni.php");
	include("./header.php");
	$ca=explode(';',$_POST['itorneo']);
	$_SESSION['torneo']=$ca[0];
	$_SESSION['serie'] = "0";
	$range_campionato = $_POST['range'];
	$campionato[$range_campionato] = $_POST['otipo'];
	$otdenom=$ca[1];
	$giornata=$_POST['giornata'];
}

	for($num1 = "01" ; $num1 < 40 ; $num1++) {
		if (strlen($num1) == 1) $num1 = "0".$num1;
	$giornata_controlla = "giornata$num1";
		if (!@is_file($percorso_cartella_dati."/".$giornata_controlla."_".$_SESSION['torneo']."_".$_SESSION['serie'])) break;
		else $giornata_ultima = $num1;
	} # fine for $num1

	if (!$giornata or $giornata > $giornata_ultima) $giornata = "$giornata_ultima";

$tab_formazioni = "<tr>";
$num_colonne = 0;
$punti = "";
$voti = "";
$scontri = "";
$num2 = 0;
$leggendo_formazioni = "SI";
$leggendo_punteggi = "NO";
$leggendo_voti = "NO";
$leggendo_scontri = "NO";
$voti_esistenti = "NO";

if ($giornata_ultima) $file_giornata = @file($percorso_cartella_dati."/giornata".$giornata."_".$_SESSION['torneo']."_".$_SESSION['serie']);
$num_linee_file_giornata = count($file_giornata);

for($num1 = 0 ; $num1 < $num_linee_file_giornata; $num1++) {
$linea = trim($file_giornata[$num1]);
if ($linea == "#@& fine formazioni #@&") $leggendo_formazioni = "NO";
if ($leggendo_formazioni == "SI") {
if ($linea == "#@& formazione #@&") $giocatore = "";
if ($giocatore) {
${$formazione}[$num2] = $file_giornata[$num1];
$num2++;
} # fine if ($giocatore)
if ($aggiorna_giocatore) {
$giocatore = $linea;
$formazione = "formazione_$giocatore";
$num2 = 0;
$aggiorna_giocatore = "";
} # fine if ($aggiorna_giocatore)
if ($linea == "#@& formazione #@&") $aggiorna_giocatore = "SI";
} # fine if ($leggendo_formazioni == "SI")

if ($linea == "#@& fine voti #@&") $leggendo_voti = "NO";
if ($leggendo_voti == "SI") {
$voti[$num2] = $linea;
$num2++;
} # fine if ($leggendo_voti == "SI")
if ($linea == "#@& voti #@&") {
$leggendo_voti = "SI";
$voti_esistenti = "SI";
$num2 = 0;
} # fine if ($linea == "#@& voti #@&")

if ($linea == "#@& fine modificatore #@&") $leggendo_modificatore = "NO";
if ($leggendo_modificatore == "SI") {
$modificatore[$num2] = $linea;
$num2++;
} # fine if ($leggendo_modificatore == "SI")
if ($linea == "#@& modificatore #@&") {
$leggendo_modificatore = "SI";
$modificatore_esistenti = "SI";
$num2 = 0;
} # fine if ($linea == "#@& modificatore #@&")

if ($linea == "#@& fine punteggi #@&") $leggendo_punteggi = "NO";
if ($leggendo_punteggi == "SI") {
$punteggi[$num2] = $linea;
$num2++;
} # fine if ($leggendo_punteggi == "SI")
if ($linea == "#@& punteggi #@&") {
$leggendo_punteggi = "SI";
$punteggi_esistenti = "SI";
$num2 = 0;
} # fine if ($linea == "#@& punteggi #@&")

if ($linea == "#@& fine scontri #@&") $leggendo_scontri = "NO";
if ($leggendo_scontri == "SI") {
$scontri[$num2] = $linea;
$num2++;
} # fine if ($leggendo_scontri == "SI")
if ($linea == "#@& scontri #@&") {
$leggendo_scontri = "SI";
$scontri_esistenti = "SI";
$num2 = 0;
} # fine if ($linea == "#@& scontri #@&")
} # fine for $num1

echo "<table bgcolor='$sfondo_tab' width='100%' border='0' cellspacing='0' cellpadding='5'>
	<caption> Torneo <b>$otdenom</b></caption></table>";

$file = @file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
$linee = count($file);
for ($num1 = 1 ; $num1 < $linee; $num1++) {
@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$num1]);
	$nome_posizione[$num1] = $outente;
	$soprannome_squadra = $osquadra;

		if ($soprannome_squadra) {
		$nome_squadra_memo[$outente] = $soprannome_squadra;
		$soprannome_squadra = "<b>".$soprannome_squadra."</b>";
		} # fine if ($soprannome_squadra)
		else {
		$soprannome_squadra = "Squadra";
		$nome_squadra_memo[$outente] = $outente;
		} # fine else if ($soprannome_squadra)

		if ($num_colonne >= 2) {
		$tab_formazioni .= "</tr><tr>";
		$num_colonne = 0;
		} # fine if ($num_colonne >= 2)
	$num_colonne++;
	$vedivoti=htmlentities($nome_squadra_memo[$outente],ENT_QUOTES);
	$tab_formazioni .= "<td align='left' valign='top'><a name='$vedivoti'></a>
	<table width='100%' cellpadding='0' cellspacing='0' bgcolor='$sfondo_tab'><caption>$soprannome_squadra di $outente</caption><tr><td><font size='-2'><u>Calciatore</u></font></td><td align='center'><font size='-2'>Fanta<br/>voto</font></td><td align='center'><font size='-2'>Voto<br/>giornale</font></td></tr>";
	$formazione = "formazione_$outente";
	$formazione = $$formazione;
	$num_linee_formazione = count($formazione);
		for ($num2 = 0 ; $num2 < $num_linee_formazione; $num2++) {
		$riga_calciatore = explode(",", $formazione[$num2]);
		$nome_calciatore = stripslashes($riga_calciatore[1]);
			if ($num2 % 2) $colore="white"; else $colore=$colore_riga_alt;
		$tab_formazioni .= "<tr bgcolor='$colore'><td><a href='stat_calciatore.php?num_calciatore=$riga_calciatore[0]&amp;escludi_controllo=$escludi_controllo' class='piccolo'>$riga_calciatore[2]</a>&nbsp;&nbsp;&nbsp;$nome_calciatore</td><td align='center'>$riga_calciatore[3]</td><td align='center'>$riga_calciatore[4]</td></tr>";
		} # fine for $num2
	$tab_formazioni .= "</table><div align='right'><a href='#top'>^ Top</a></div></td>";

	} # fine for $num1
	for ($num1 = $num_colonne ; $num1 < 2; $num1++) $tab_formazioni .= "<td>&nbsp;</td>";
	$tab_formazioni .= "</tr>";

$tipo_campionato = "";
		$num_giornata = str_replace("giornata","",$giornata);
		if (substr($num_giornata,0,1) == 0) $num_giornata = substr($num_giornata,1);
		$num_campionati = count($campionato);
		reset($campionato);
		for($num1 = 0 ; $num1 < $num_campionati; $num1++) {
			$key_campionato = key($campionato);
			$giornate_campionato = explode("-",$key_campionato);
			if ($num_giornata <= $giornate_campionato[1] and $num_giornata >= $giornate_campionato[0]) {
				$num_giornata_campionato = $num_giornata - $giornate_campionato[0] + 1;
				$tipo_campionato = $campionato[$key_campionato];
				$g_inizio_campionato = $giornate_campionato[0];
				break;
			} # fine if ($num_giornata <= $giornate_campionato[1] and...
			next($campionato);
		} # fine for $num1
		if (!$tipo_campionato) $tipo_campionato = "N";

if ($tipo_campionato == "S") {
echo "<br/><table width='50%' align='center' bgcolor='$sfondo_tab' cellpadding='5' border='1'>";
echo "<tr><td width='50%' align='center'><b>Partite</b></td><td width='50%' align='center'><b>Risultato</b></td></tr>";
$partite = "";
$marcotori = "";
$num_scontri = count($scontri);
for($num1 = 0 ; $num1 < $num_scontri ; $num1++) {
$dati_scontri = explode("##@@&&", $scontri[$num1]);
echo "<tr><td align='center'>".$nome_squadra_memo[$dati_scontri[0]]." - ".$nome_squadra_memo[$dati_scontri[1]]."</td>
<td align='center'>".$dati_scontri[2]." - ".$dati_scontri[3]."</td></tr>";
} # fine for $num1
echo "</table><br/>";
} # fine if ($tipo_campionato == "S")

###############################################

	if ($voti_esistenti == "SI") {
	$giorn_ata = substr($giornata,-2);
	echo "<br/><table align='center' bgcolor='$sfondo_tab' class='border' cellpadding='10'><tr><td align='left' valign='top'><b><u>Voti della giornata $giorn_ata</u></b>:<br/>";
	$num_voti = count($voti);
	for ($num1 = 0 ; $num1 < $num_voti ; $num1++) {
	$dati_voti = explode("##@@&&", $voti[$num1]);
	settype($dati_voti[0],"string");
	settype($dati_voti[1],"float");
	$voto[$dati_voti[0]] = $dati_voti[1];
	} # fine for $num1
	arsort ($voto);
	reset ($voto);
	while (list ($key, $val) = each ($voto)) {
	$vedivoti=htmlentities($nome_squadra_memo[$key], ENT_QUOTES);
	echo $nome_squadra_memo[$key].": <a href='#$vedivoti'>$val</a><br/>";
	} # fine while
	echo "</td>";

	if ($modificatore_difesa == "SI") {
	echo "<td align='left' valign='top'><u><b>Modificatore difesa</b></u><br/>";
	$num_mod = count($modificatore);
	for ($num1 = 0 ; $num1 < $num_mod ; $num1++) {
	$dati_mod = explode("##@@&&", $modificatore[$num1]);
	settype($dati_mod[0],"string");
	settype($dati_mod[1],"float");
	echo $dati_mod[0].": ".$dati_mod[1]."<br/>";
	$mod[$dati_mod[0]] = $dati_mod[1];
	} # fine for $num1
	echo "</td>";
	} # fine if modificatore difesa

	if ($tipo_campionato == "P") {
	echo "<td align='left' valign='top'><b><u>Punteggio</u></b><br/>";
	$num_punteggi = count($punteggi);
	for ($num1 = 0 ; $num1 < $num_punteggi ; $num1++) {
	$dati_punteggi = explode("##@@&&", $punteggi[$num1]);
	settype($dati_punteggi[0],"string");
	settype($dati_punteggi[1],"float");
	$punteggio[$dati_punteggi[0]] = $dati_punteggi[1];
	} # fine for $num1
	arsort ($punteggio);
	reset ($punteggio);
	while (list ($key, $val) = each ($punteggio)) {
	echo "$val<br/>";
	} # fine while
	echo "</td>";
	} # fine if ($tipo_campionato == "P")

	# calcolo la classifica fino a questa giornata
	if ($tipo_campionato != "N") {
	$punti = "";
	for ($num1 = $g_inizio_campionato; $num1 <= $num_giornata; $num1++) {
	if (strlen($num1) == 1) $num1 = "0".$num1;
	$giornata_punti = "giornata$num1";
	if (@is_file($percorso_cartella_dati."/".$giornata_punti."_".$_SESSION['torneo']."_".$_SESSION['serie'])) {
	$file_giornata_p = @file($percorso_cartella_dati."/".$giornata_punti."_".$_SESSION['torneo']."_".$_SESSION['serie']);
	$num_linee_file_giornata_p = count($file_giornata_p);
	$leggendo_punteggi = "NO";
	$punteggi_esistenti_p = "NO";
	for($num2 = 0 ; $num2 < $num_linee_file_giornata_p; $num2++) {
	$linea = trim($file_giornata_p[$num2]);
	if ($linea == "#@& fine punteggi #@&") $leggendo_punteggi = "NO";
	if ($leggendo_punteggi == "SI") {
	$punteggi_p[$num3] = $file_giornata_p[$num2];
	$num3++;
	} # fine if ($leggendo_punteggi == "SI")
	if ($linea == "#@& punteggi #@&") {
	$leggendo_punteggi = "SI";
	$punteggi_esistenti_p = "SI";
	$num3 = 0;
	} # fine if ($leggendo_punteggi == "SI")
	} # fine for $num1
	if ($punteggi_esistenti_p == "SI") {
	$num_punteggi_p = count($punteggi_p);
	for ($num2 = 0 ; $num2 < $num_punteggi_p ; $num2++) {
	$dati_punteggio = explode("##@@&&", $punteggi_p[$num2]);
	settype($dati_punteggio[0],"string");
	settype($dati_punteggio[1],"float");
	$punti[$dati_punteggio[0]] = ($punti[$dati_punteggio[0]] + $dati_punteggio[1]);
	} # fine for $num2
	} # fine if ($punteggi_esistenti_p == "SI")
	} # fine if (@is_file("$percorso_cartella_dati/$giornata_punti"))
	} # fine for $num1

	echo "<td align='left'>&nbsp;&nbsp;</td><td valign='top' align='left'><font color='red'><b><u>Classifica alla giornata $num_giornata_campionato</u></b>:</font><br/>";
    arsort ($punti);
    reset ($punti);
    $posclas = 0;
        while (list ($key, $val) = each ($punti)) {
        $posclas++;
    if (($posclas == 1) && ($nome_squadra_memo[$key] == $_SESSION['squadra']))
    echo "<font class=\"evidenziato\"><b>"."$posclas)&nbsp;".stripslashes($nome_squadra_memo[$key]).": $val</b></font><br/>\n";
    elseif ($nome_squadra_memo[$key] == $_SESSION['squadra'])
    echo "<font class=\"evidenziato\">"."$posclas)&nbsp;".stripslashes($nome_squadra_memo[$key]).": $val</font><br/>\n";
        elseif ($posclas == 1){
        echo "<b>"."$posclas)&nbsp;".stripslashes($nome_squadra_memo[$key]).": $val</b><br/>\n";
            $puntprimo = $val;
            }
        else    {
            if ($puntprimo == $val)
                echo "<b>"."$posclas)&nbsp;".stripslashes($nome_squadra_memo[$key]).": $val</b><br />\n";
            else
            echo "$posclas)&nbsp;".stripslashes($nome_squadra_memo[$key]).": $val<br />\n";
            }
        } # fine while
	echo "</td>";
	} # fine if ($tipo_campionato != "N")
	echo "</tr></table>";
	} # fine if ($voti_esistenti == "SI")

echo "<table align='center' width='100%' bgcolor='$sfondo_tab' border='1' cellpadding='10' cellspacing='5'>
<caption>Giornata $giornata</caption>
$tab_formazioni</table>";

include("./footer.php");
?>