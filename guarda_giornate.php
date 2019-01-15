<?php
##################################################################################
#    FANTACALCIOBAZAR EVOLUTION
#    Copyright (C) 2003-2006 by Antonello Onida (fantacalcio@sassarionline.net)
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
##################################################################################
@$escludi_controllo = $_POST['escludi_controllo'];

if ($escludi_controllo != "SI") {
	require_once ("./controlla_pass.php");
	include("./header.php");
	#require ("menu.php");
}
else {
	require ("./dati/dati_gen.php");
	include("./header.php");
}
###########################################################

	for ($num1 = 1; $num1 < 40 ; $num1++) {
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

if ($giornata_ultima) $file_giornata = file($percorso_cartella_dati."/giornata".$giornata."_".$_SESSION['torneo']."_".$_SESSION['serie']);
$num_linee_file_giornata = count($file_giornata);

for($num1 = 0 ; $num1 < $num_linee_file_giornata; $num1++) {
$linea = togli_acapo($file_giornata[$num1]);

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

$file = file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
$linee = count($file);
for($num1 = 1; $num1 < $linee; $num1++){
@list($outente, $opassword, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$num1]);
$nome_posizione[$num1] = $outente;

if ($osquadra) {
$nome_squadra_memo[$outente] = $osquadra;
$soprannome_squadra = "<b>".$osquadra."</b>";
} # fine if
else {
$soprannome_squadra = "Squadra";
$nome_squadra_memo[$outente] = $outente;
} # fine else

if ($num_colonne >= 2) {
$tab_formazioni .= "</tr><tr>";
$num_colonne = 0;
} # fine if ($num_colonne >= 2)
$num_colonne++;
$tab_formazioni .= "<td class=\"testa\"><h4>$soprannome_squadra di $outente</h4>";
$formazione = "formazione_$outente";
$formazione = $$formazione;
$num_linee_formazione = count($formazione);
for ($num2 = 0 ; $num2 < $num_linee_formazione; $num2++) {
# $formazione[$num2] = ereg_replace(" ","_",$formazione[$num2]);
$tab_formazioni .= $formazione[$num2]."<br/>";
} # fine for $num2
$tab_formazioni .= "</td>";

} # fine for $num1
for ($num1 = $num_colonne ; $num1 < 2; $num1++) $tab_formazioni .= "<td>&nbsp;</td>";
$tab_formazioni .= "</tr>";

#### fine tab_formazioni
##################################################

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
echo "<br/><table bgcolor=\"$sfondo_tab\" align=\"center\" width=\"100%\" cellpadding=\"5\" border=\"0\">";
echo "<tr><td class=\"testa\">Partite</td><td class=\"testa\">Risultato</td></tr>";
$partite = "";
$marcotori = "";
$num_scontri = count($scontri);
for ($num1 = 0 ; $num1 < $num_scontri ; $num1++) {
$dati_scontri = explode("##@@&&", $scontri[$num1]);
echo "<tr><td align=center>".$nome_squadra_memo[$dati_scontri[0]]." - ".$nome_squadra_memo[$dati_scontri[1]]."</td>
<td align=\"center\">".$dati_scontri[2]." - ".$dati_scontri[3]."</td></tr>";
} # fine for $num1
echo "</table>";
} # fine if ($tipo_campionato == "S")

###############################################

	if ($voti_esistenti == "SI") {
	$giorn_ata = substr($giornata,-2);

	echo "<br/><table align=\"center\" class=\"border\" cellpadding=\"5\" bgcolor=\"$sfondo_tab\"><tr>";

	# calcolo la classifica fino a questa giornata
	$punti = ""; $num3 = 0;

	for ($num1 = $g_inizio_campionato ; $num1 <= $num_giornata ; $num1++) {
		if (strlen($num1) == 1) $num1 = "0".$num1;
		$giornata_punti = "giornata$num1";
			if (@is_file($percorso_cartella_dati."/".$giornata_punti."_".$_SESSION['torneo']."_".$_SESSION['serie'])) {
			$file_giornata_p = @file($percorso_cartella_dati."/".$giornata_punti."_".$_SESSION['torneo']."_".$_SESSION['serie']);
			$num_linee_file_giornata_p = count($file_giornata_p);
			$leggendo_punteggi = "NO";
			$punteggi_esistenti_p = "NO";
				for($num2 = 0 ; $num2 < $num_linee_file_giornata_p; $num2++) {
				$linea = togli_acapo($file_giornata_p[$num2]);
					if ($linea == "#@& fine punteggi #@&") {
					$leggendo_punteggi = "NO";
					}
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
				settype($dati_punteggio[1],"double");
				$punti[$dati_punteggio[0]] = ($punti[$dati_punteggio[0]] + $dati_punteggio[1]);
				$xpunti [$num1][$dati_punteggio[0]] = $dati_punteggio[1];

				} # fine for $num2
			} # fine if ($punteggi_esistenti_p == "SI")
		} # fine if (@is_file("$percorso_cartella_dati/$giornata_punti"))
	} # fine for $num1

	echo "<td class=\"testa\">Classifica alla giornata $num_giornata_campionato</td></tr><tr><td>";
	arsort ($punti);
	reset ($punti);
	$posclas = 0;
		while (list ($key, $val) = each ($punti)) {
		$posclas++;
		echo "$posclas)&nbsp;".$nome_squadra_memo[$key].": $val<br/>";
		} # fine while

		#print_r ($xpunti);

	echo "</td>";
	echo "</tr></table>";
	} # fine if ($voti_esistenti == "SI")

	echo "<br/><table align=\"center\" border=\"1\" class=\"border\" cellpadding=\"2\" cellspacing=\"0\" bgcolor=\"$sfondo_tab\"><tr><td class=\"testa\">Squadra</td>";
		for ($num2 = $g_inizio_campionato ; $num2 <= $num_giornata ; $num2++) {
		echo "<td class=\"testa\"><font size=\"1\">$num2</font></td>";
		} # fine for $num2
	echo "<td class=\"testa\"><font size=\"1\">Tot</font></td>";
	echo "</tr><tr>";

$file = file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
$linee = count($file);

for($num1 = 1; $num1 < $linee; $num1++){
@list($outente, $opassword, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$num1]);
$totpunti = 0;
$soprannome_squadra = $osquadra;

	if ($soprannome_squadra) {
	$nome_squadra_memo[$outente] = $soprannome_squadra;
	$soprannome_squadra = $osquadra;
	} # fine if
	else {
	$soprannome_squadra = "Squadra";
	$nome_squadra_memo[$outente] = $outente;
	} # fine else

echo "<td class=\"testa\">$soprannome_squadra<br/>di $outente</td>";

	for ($num2 = $g_inizio_campionato ; $num2 <= $num_giornata ; $num2++) {
		if (strlen($num2) == 1) $num2 = "0".$num2;
	$zpunti=$xpunti [$num2][$outente];
	$totpunti=$totpunti+$zpunti;
	echo "<td align=\"center\"><font size=\"1\">$zpunti</font></td>";
	} # fine for $num1
	echo "<td align=\"center\"><font size=\"1\"><b>$totpunti</b></font></td>";

echo "</tr><tr>";
} # fine for $num1
###########################################################
echo "</tr></table><br/><br/><br/><br/><br/>";

include("./footer.php");
?>