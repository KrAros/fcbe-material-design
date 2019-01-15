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

if ($_SESSION['valido'] == "SI" AND ($stato_mercato != "I" OR $stato_mercato != "R" OR $_SESSION['permessi'] == 4)) {
require("./menu.php");

$chiusura_giornata = (INT) @file($percorso_cartella_dati."/chiusura_giornata.txt");

$nome_squadra = "tutti";
############################################
$utenti = @file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
$linee = count($utenti);
	for($num1 = 1 ; $num1 < $linee; $num1++) {
	@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $utenti[$num1]);
	
		$titolo = "<font size=+2><u>";
			if ($osquadra) $titolo .= "$osquadra";
			else $titolo .=  "Squadra";
		$titolo .= " di $outente</u></font>";
		$titolo .= "<br /><br />Presidente: <b>$outente</b>";
		if ($ocitta) $titolo .= "<br />Citt&agrave;: <b>$ocitta</b>";
		#$titolo .= "<br />Email: <b>$oemail</b>";
		$titolo .= "<br />Data iscrizione: $oreg";
		if ($ourl and $ourl != "http://") $titolo .= "<br />Telefono: <b>$ourl</b>";
		if (file_exists($percorso_cartella_dati."/squadra_".$outente)) {
			$titolo .= "<br />Ultima modifica formazione: " .date("d-m-Y H:i:s",filemtime($percorso_cartella_dati."/squadra_$outente"));
			} else $titolo .="<br />Ultima modifica formazione: Nessuna formazione schierata";
		$cambi_effettuati = INTVAL($ocambi);
		$cambi_total=$numero_cambi_max + $cambi_extra;
		$titolo.="<br />Cambi: $cambi_effettuati su $cambi_total"; 
#	if ($foto_calciatori == "SI") $titolo .= "<br /><a href='squadra2.php'>Foto calciatori</a>";
		
	####################################################################
	$contatore_calciatori = 0;
	$lista_calciatori = "";
	$soldi_spesi = 0;
	$num_calciatori_posseduti = 0;
	$np = 0; $nd = 0; $nc = 0; $nf = 0; $na = 0;
	$linea_offerto = "";
	$linea_comprato_P = "";
	$linea_comprato_D = "";
	$linea_comprato_C = "";
	$linea_comprato_F = "";
	$linea_comprato_A = "";
	$tab_comprati = "";
	$tab_offerte = "<table summary='Principale' class='border' width='100%' border='1' cellspacing='1' cellpadding='3' align='center' bgcolor='$sfondo_tab'>
	<tr><td class='testa'>Num.</td>
	<td class='testa'>Nome giocatore</td>
	<td class='testa'>Ruolo</td>
	<td class='testa'>Costo</td>
	<td class='testa'>Tempo rimasto</td></tr>";
	
	$calciatori = @file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
	$np = 0; $nd = 0; $nc = 0; $nf = 0; $na = 0;
	
	$num_calciatori = count($calciatori);
	for ($num2 = 0 ; $num2 < $num_calciatori ; $num2++) {
	$dati_calciatore = explode(",", $calciatori[$num2]);
	$numero = $dati_calciatore[0];
	$ruolo = $dati_calciatore[2];
	$proprietario = $dati_calciatore[4];
	
	if ($proprietario == $outente) {
	$soldi_spesi = $soldi_spesi + $dati_calciatore[3];
	
	$num_calciatori_posseduti++;
	if ($ruolo == "P") $np++;
	else if ($ruolo == "D") $nd++;
	else if ($ruolo == "C") $nc++;
	else if ($ruolo == "F") $nf++;
	else if ($ruolo == "A") $na++;
	
	$nome = stripslashes($dati_calciatore[1]);
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
	$lista_calciatori[$contatore_calciatori] = $numero;
	$contatore_calciatori++;
	$nome_linea = "linea_comprato_$ruolo";
	${$nome_linea}[$numero] = "<tr><td>&nbsp;</td>
	<td align='center'>$numero</td>
	<td>$nome</td>
	<td align='center'>$ruolo</td>
	<td align='center'>$costo</td>";
	${$nome_linea}[$numero] .= "</tr>";
	} # fine if ($proprietario == $outente)
	} # fine for $num2
	
	#########################################################
	$tab_lato = "";
	
	$tab_centro .= "<table summary='Calciatori' width='100%' border='0' cellspacing='1' cellpadding='2' align='center' bgcolor='$sfondo_tab'><tr>
	<td class='testa'>Pos.</td>
	<td class='testa'>Num.</td>
	<td class='testa'>Nome giocatore</td>
	<td class='testa'>Ruolo</td>
	<td class='testa'>Costo</td>";
	$colspan = 5;
	$tab_centro .= "</tr>
	<tr><td align='center' colspan='$colspan'><b>Titolari</b></td></tr>";
	
	$dati_squadra = @file($percorso_cartella_dati."/squadra_".$outente);
	$titolari = explode(",", $dati_squadra[1]);
	
	# tabella dei titolari
	$num_titolari = count($titolari);
	$tab_titolari_P = "";
	$tab_titolari_D = "";
	$tab_titolari_C = "";
	$tab_titolari_F = "";
	$tab_titolari_A = "";
	$inserito = "";
	$num_pos = 1;

	for ($num2 = 0 ; $num2 < $num_titolari ; $num2++) {
	$numero_titolare = $titolari[$num2];
	if ($linea_comprato_P[$numero_titolare]) {
	$linea_comprato_P[$numero_titolare] = ereg_replace("value='titolare'","value='titolare' checked",$linea_comprato_P[$numero_titolare]);
	$linea_comprato_P[$numero_titolare] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align='center'>$num_pos</td>",$linea_comprato_P[$numero_titolare]);
	$num_pos++;
	$tab_titolari_P .= $linea_comprato_P[$numero_titolare];
	$inserito[$numero_titolare] = "SI";
	} # fine if ($linea_comprato_P[$numero_titolare])
	if ($linea_comprato_D[$numero_titolare]) {
	$linea_comprato_D[$numero_titolare] = ereg_replace("value='titolare'","value='titolare' checked",$linea_comprato_D[$numero_titolare]);
	$linea_comprato_D[$numero_titolare] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align='center'>$num_pos</td>",$linea_comprato_D[$numero_titolare]);
	$num_pos++;
	$tab_titolari_D .= $linea_comprato_D[$numero_titolare];
	$inserito[$numero_titolare] = "SI";
	} # fine if ($linea_comprato_D[$numero_titolare])
	if ($linea_comprato_C[$numero_titolare]) {
	$linea_comprato_C[$numero_titolare] = ereg_replace("value='titolare'","value='titolare' checked",$linea_comprato_C[$numero_titolare]);
	$linea_comprato_C[$numero_titolare] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align='center'>$num_pos</td>",$linea_comprato_C[$numero_titolare]);
	$num_pos++;
	$tab_titolari_C .= $linea_comprato_C[$numero_titolare];
	$inserito[$numero_titolare] = "SI";
	} # fine if ($linea_comprato_C[$numero_titolare])
	if ($linea_comprato_F[$numero_titolare]) {
	$linea_comprato_F[$numero_titolare] = ereg_replace("value='titolare'","value='titolare' checked",$linea_comprato_F[$numero_titolare]);
	$linea_comprato_F[$numero_titolare] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align='center'>$num_pos</td>",$linea_comprato_F[$numero_titolare]);
	$num_pos++;
	$tab_titolari_F .= $linea_comprato_F[$numero_titolare];
	$inserito[$numero_titolare] = "SI";
	} # fine if ($linea_comprato_F[$numero_titolare])
	if ($linea_comprato_A[$numero_titolare]) {
	$linea_comprato_A[$numero_titolare] = ereg_replace("value='titolare'","value='titolare' checked",$linea_comprato_A[$numero_titolare]);
	$linea_comprato_A[$numero_titolare] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align='center'>$num_pos</td>",$linea_comprato_A[$numero_titolare]);
	$num_pos++;
	$tab_titolari_A .= $linea_comprato_A[$numero_titolare];
	$inserito[$numero_titolare] = "SI";
	} # fine if ($linea_comprato_A[$numero_titolare])
	} # fine for $num2
	$tab_centro .= $tab_titolari_P.$tab_titolari_D.$tab_titolari_C.$tab_titolari_F.$tab_titolari_A;
	
	# Tabella dei panchinari
	$tab_centro .= "<tr><td align='center' colspan='$colspan'><B>In panchina</B></td></tr>";
	$panchinari = explode(",", $dati_squadra[2]);
	$num_panchinari = count($panchinari);
	$tab_panchinari_P = "";
	$tab_panchinari_D = "";
	$tab_panchinari_C = "";
	$tab_panchinari_F = "";
	$tab_panchinari_A = "";
	$tab_panchinari = "";
	for ($num2 = 0 ; $num2 < $num_panchinari ; $num2++) {
	$numero_panchinaro = $panchinari[$num2];
	$num_in_panchina = $num2 + 1;
	if ($linea_comprato_P[$numero_panchinaro]) {
	$linea_comprato_P[$numero_panchinaro] = ereg_replace("value='panchinaro'","value='panchinaro' checked",$linea_comprato_P[$numero_panchinaro]);
	$linea_comprato_P[$numero_panchinaro] = ereg_replace("option value='$num_in_panchina'","option value='$num_in_panchina' selected",$linea_comprato_P[$numero_panchinaro]);
	$linea_comprato_P[$numero_panchinaro] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align='center'>$num_pos</td>",$linea_comprato_P[$numero_panchinaro]);
	$num_pos++;
	$tab_panchinari .= $linea_comprato_P[$numero_panchinaro];
	$inserito[$numero_panchinaro] = "SI";
	} # fine if ($linea_comprato_P[$numero_panchinaro])
	if ($linea_comprato_D[$numero_panchinaro]) {
	$linea_comprato_D[$numero_panchinaro] = ereg_replace("value='panchinaro'","value='panchinaro' checked",$linea_comprato_D[$numero_panchinaro]);
	$linea_comprato_D[$numero_panchinaro] = ereg_replace("option value='$num_in_panchina'","option value='$num_in_panchina' selected",$linea_comprato_D[$numero_panchinaro]);
	$linea_comprato_D[$numero_panchinaro] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align='center'>$num_pos</td>",$linea_comprato_D[$numero_panchinaro]);
	$num_pos++;
	$tab_panchinari .= $linea_comprato_D[$numero_panchinaro];
	$inserito[$numero_panchinaro] = "SI";
	} # fine if ($linea_comprato_D[$numero_panchinaro])
	if ($linea_comprato_C[$numero_panchinaro]) {
	$linea_comprato_C[$numero_panchinaro] = ereg_replace("value='panchinaro'","value='panchinaro' checked",$linea_comprato_C[$numero_panchinaro]);
	$linea_comprato_C[$numero_panchinaro] = ereg_replace("option value='$num_in_panchina'","option value='$num_in_panchina' selected",$linea_comprato_C[$numero_panchinaro]);
	$linea_comprato_C[$numero_panchinaro] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align='center'>$num_pos</td>",$linea_comprato_C[$numero_panchinaro]);
	$num_pos++;
	$tab_panchinari .= $linea_comprato_C[$numero_panchinaro];
	$inserito[$numero_panchinaro] = "SI";
	} # fine if ($linea_comprato_C[$numero_panchinaro])
	if ($linea_comprato_F[$numero_panchinaro]) {
	$linea_comprato_F[$numero_panchinaro] = ereg_replace("value='panchinaro'","value='panchinaro' checked",$linea_comprato_F[$numero_panchinaro]);
	$linea_comprato_F[$numero_panchinaro] = ereg_replace("option value='$num_in_panchina'","option value='$num_in_panchina' selected",$linea_comprato_F[$numero_panchinaro]);
	$linea_comprato_F[$numero_panchinaro] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align='center'>$num_pos</td>",$linea_comprato_F[$numero_panchinaro]);
	$num_pos++;
	$tab_panchinari .= $linea_comprato_F[$numero_panchinaro];
	$inserito[$numero_panchinaro] = "SI";
	} # fine if ($linea_comprato_F[$numero_panchinaro])
	if ($linea_comprato_A[$numero_panchinaro]) {
	$linea_comprato_A[$numero_panchinaro] = ereg_replace("value='panchinaro'","value='panchinaro' checked",$linea_comprato_A[$numero_panchinaro]);
	$linea_comprato_A[$numero_panchinaro] = ereg_replace("option value='$num_in_panchina'","option value='$num_in_panchina' selected",$linea_comprato_A[$numero_panchinaro]);
	$linea_comprato_A[$numero_panchinaro] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align='center'>$num_pos</td>",$linea_comprato_A[$numero_panchinaro]);
	$num_pos++;
	$tab_panchinari .= $linea_comprato_A[$numero_panchinaro];
	$inserito[$numero_panchinaro] = "SI";
	} # fine if ($linea_comprato_A[$numero_panchinaro])
	} # fine for $num2
	#echo $tab_panchinari_P.$tab_panchinari_D.$tab_panchinari_C.$tab_panchinari_A;
	$tab_centro .= $tab_panchinari;
	
	# Tabella degli esclusi
	$tab_centro .= "<tr><td align='center' colspan='$colspan'><B>Tribuna</B></td></tr>";
	$tab_fuori_P = "";
	$tab_fuori_D = "";
	$tab_fuori_C = "";
	$tab_fuori_F = "";
	$tab_fuori_A = "";
	$num_calciatori = count($lista_calciatori);
	for ($num2 = 0 ; $num2 < $num_calciatori ; $num2++) {
	$numero_fuori = $lista_calciatori[$num2];
	if ($inserito[$numero_fuori] != "SI") {
	if ($linea_comprato_P[$numero_fuori]) {
	$linea_comprato_P[$numero_fuori] = ereg_replace("value='fuori'","value='fuori' checked",$linea_comprato_P[$numero_fuori]);
	$tab_fuori_P .= $linea_comprato_P[$numero_fuori];
	$inserito[$numero_fuori] = "SI";
	} # fine if ($linea_comprato_P[$numero_fuori])
	if ($linea_comprato_D[$numero_fuori]) {
	$linea_comprato_D[$numero_fuori] = ereg_replace("value='fuori'","value='fuori' checked",$linea_comprato_D[$numero_fuori]);
	$tab_fuori_D .= $linea_comprato_D[$numero_fuori];
	$inserito[$numero_fuori] = "SI";
	} # fine if ($linea_comprato_D[$numero_fuori])
	if ($linea_comprato_C[$numero_fuori]) {
	$linea_comprato_C[$numero_fuori] = ereg_replace("value='fuori'","value='fuori' checked",$linea_comprato_C[$numero_fuori]);
	$tab_fuori_C .= $linea_comprato_C[$numero_fuori];
	$inserito[$numero_fuori] = "SI";
	} # fine if ($linea_comprato_C[$numero_fuori])
	if ($linea_comprato_F[$numero_fuori]) {
	$linea_comprato_F[$numero_fuori] = ereg_replace("value='fuori'","value='fuori' checked",$linea_comprato_F[$numero_fuori]);
	$tab_fuori_F .= $linea_comprato_F[$numero_fuori];
	$inserito[$numero_fuori] = "SI";
	} # fine if ($linea_comprato_F[$numero_fuori])
	if ($linea_comprato_A[$numero_fuori]) {
	$linea_comprato_A[$numero_fuori] = ereg_replace("value='fuori'","value='fuori' checked",$linea_comprato_A[$numero_fuori]);
	$tab_fuori_A .= $linea_comprato_A[$numero_fuori];
	$inserito[$numero_fuori] = "SI";
	} # fine if ($linea_comprato_A[$numero_fuori])
	} # fine if ($inserito[$num_fuori] != "SI")
	} # fine for $num2
	$tab_centro .= $tab_fuori_P.$tab_fuori_D.$tab_fuori_C.$tab_fuori_F.$tab_fuori_A;
	
	$num_calciatori_comprabili = $max_calciatori - $num_calciatori_posseduti;
	$surplus = (int) $ocrediti;
	$variazioni = (int) $ovariazioni;
	$cambi_effettuati = (int) $ocambi;
	
	$home_page_squadra = $ourl;
	$home_page_squadra = togli_acapo($home_page_squadra);
	if (!$home_page_squadra) $home_page_squadra_vedi = "http://";
	
	$soldi_spendibili = $soldi_iniziali + $surplus + $variazioni - $soldi_spesi;
	
	if ($outente == $_SESSION['utente']) {
	for ($num2 = "01" ; $num2 < 40 ; $num2++) {
	if (strlen($num2) == 1) $num2 = "0".$num2;
	$giornata = "$percorso_cartella_dati/giornata$num2";
	if (!@is_file($giornata)) break;
	} # fine for $num2
	
	} # fine if ($outente == $_SESSION['utente'])
	
	####################################################
	
	########################
	# Layout pagina
	
	echo "<table summary='Panchina' width='100%' class='border' border='0' cellspacing='1' cellpadding='2' align='center'>
	<caption>$titolo</caption><tr><td valign='top'>";
	
	if ($tab_lato != "" and $xsquadra_ok != "SI") echo "$tab_lato<hr /><br/>FantaEuro residui: <b>$soldi_spendibili</b> Fanta-Euro.<br/><br/>
	$controlla_squadra</td><td width='80%'>";
	
	echo "$tab_centro</table></td></tr></table>";
	echo $fuori_tabella;
	
	$tab_lato = "";
	$tab_centro = "";
	$fuori_tabella = "";
	
	########################
	
	echo "<br/><br/><hr width='90%' />";
	} # fine for $num1
} # fine VALID
require ("./footer.php");
?>