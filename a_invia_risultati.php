<?php
##################################################################################
#    FANTACALCIOBAZAR
#    Copyright (C) 2003 by Antonello Onida (fantacalcio@sassarionline.net)
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
	
  if($attiva_multi == "SI") {
		$frase='INDICA PER QUALE TORNEO VUOI INVIARE I VOTI';
		$vedi_tornei_attivi = "<select name='l_torneo'>";
		$vedi_tornei_attivi .= "<option value=''>Scegli il torneo</option>";
		$tornei = @file("$percorso_cartella_dati/tornei.php");
		$num_tornei = 0;
			for($num1 = 0; $num1 < count($tornei); $num1++){
			$num_tornei++;
			}

			for ($num1 = 1 ; $num1 < $num_tornei; $num1++) {
			@list($otid, $otdenom) = explode(",", $tornei[$num1]);
			$vedi_tornei_attivi .= "<option value='$otid'>$otdenom</option>";
			} # fine for $num1

		$vedi_tornei_attivi .= "</select>";

		}
		else 
		$vedi_tornei_attivi = "<input type='hidden' name='l_torneo' value='1' />";

if ($_SESSION['valido'] == "SI" AND $_SESSION['permessi'] == 4){
	require ("./menu.php");
	
if ($gestione_email == "mail_anteprima" or $gestione_email == "mail_OK") {
	for($num1 = "01" ; $num1 < 40 ; $num1++) {
		if (strlen($num1) == 1) $num1 = "0".$num1;
	$giornata_controlla = "giornata$num1";
	   $ggult=$num1-1;
		if (!@is_file($percorso_cartella_dati."/".$giornata_controlla."_".$_SESSION['torneo']."_".$_SESSION['serie'])) break;
		else $giornata_ultima = $num1;
	} # fine for $num1

	if (!$giornata or $giornata > $giornata_ultima) $giornata = "$giornata_ultima";
	

$mexemail = "<center><h2>Giornata $giornata_ultima</h2></center>";

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
		$tab_formazioni .= "<tr bgcolor='$colore'><td>$riga_calciatore[2]&nbsp;&nbsp;&nbsp;$nome_calciatore</td><td align='center'>$riga_calciatore[3]</td><td align='center'>$riga_calciatore[4]</td></tr>";
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

if ($ottipo_calcolo == "S") {
$mexemail .= "<br/><table width=\"80%\" align=\"center\" bgcolor=\"$sfondo_tab\" cellpadding=\"5\" border=\"1\">";
$mexemail .= "<tr><td width=\"50%\" align=\"center\"><b>Partite</b></td><td><b>Risultato</b></td></tr>";
$partite = "";
$marcotori = "";
$num_scontri = count($scontri);
for($num1 = 0 ; $num1 < $num_scontri ; $num1++) {
$dati_scontri = explode("##@@&&", $scontri[$num1]);
$mexemail .= "<tr><td>".$nome_squadra_memo[$dati_scontri[0]]." - ".$nome_squadra_memo[$dati_scontri[1]]."</td><td align=\"center\">".$dati_scontri[2]." - ".$dati_scontri[3]."</td></tr>";
} # fine for $num1
$mexemail .= "</table><br/>";
} # fine if ($ottipo_calcolo == "S")

###############################################

    if ($voti_esistenti == "SI") {
    $giorn_ata = substr($giornata,-2);
    if ($voti_bonus_in_casa)
    $mexemail .= "<br/><table align=\"center\" bgcolor=\"$sfondo_tab\" class=\"border\" cellpadding=\"10\"><tr><td align=\"left\" valign=\"top\"><b><u>Voti della giornata $ggult</u></b>:<br/><font color=\"red\">(Aggiungere +$voti_bonus_in_casa per le squadre in casa)</font><br/><br/>";
    else
    $mexemail .= "<br/><table align=\"center\" bgcolor=\"$sfondo_tab\" class=\"border\" cellpadding=\"10\"><tr><td align=\"left\" valign=\"top\"><b><u>Voti della giornata $ggult</u></b>:<br/>";
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
    $mexemail .= $nome_squadra_memo[$key].": $val<br/>";
    } # fine while
    $mexemail .= "</td>";

    if ($modificatore_difesa == "SI") {
    $mexemail .= "<td align=\"left\" valign=\"top\"><u><b>Modificatore difesa</b></u><br/>";
    if ($voti_bonus_in_casa) $mexemail .= "<br/><br/>";
    $num_mod = count($modificatore);
	for ($num1 = 0 ; $num1 < $num_mod ; $num1++) {
	$dati_mod = explode("##@@&&", $modificatore[$num1]);
	settype($dati_mod[0],"string");
	settype($dati_mod[1],"float");
    $mexemail .= $dati_mod[0].": ".$dati_mod[1]."<br/>";
    $mod[$dati_mod[0]] = $dati_mod[1];
    } # fine for $num1
    $mexemail .= "</td>";
    } # fine if modificatore difesa

	if ($tipo_campionato == "P") {
    if ($voti_bonus_in_casa) $mexemail .= "<br/><br/>";
    $mexemail .= "<td align=\"left\" valign=\"top\"><b><u>Punteggio</u></b><br/>";
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
    $mexemail .= "$val<br/>";
    } # fine while
    $mexemail .= "</td>";
    } # fine if ($ottipo_calcolo == "P")

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


    $mexemail .= "<td align=\"left\">&nbsp;&nbsp;</td><td align=\"left\"><font color=\"red\"><b><u>Classifica alla giornata $ggult</u></b>:</font><br/>";
    $mexemail .= "<br/><br/>";
arsort ($punti);
	reset ($punti);
	$posclas = 0;
		while (list ($key, $val) = each ($punti)) {
		$posclas++;
		$vedivoti=htmlentities($nome_squadra_memo[$key], ENT_QUOTES);
        $mexemail .= "$posclas)&nbsp;".$nome_squadra_memo[$key].": $val<br/>";
        } # fine while
    $mexemail .= "</td>";
    } # fine if ($ottipo_calcolo != "N")
    $mexemail .= "</tr></table>";
    } # fine if ($voti_esistenti == "SI")

$mexemail .= "<br/><br/><table align=\"center\" bgcolor=\"$sfondo_tab\" border=\"1\" cellpadding=\"10\" cellspacing=\"5\">$tab_formazioni</table>";









##################################
# Invio email


    $oggetto = "Invio risultati\r\n";
    $mail_css = "<style type=\"text/css\">
    BODY {background-color:#EEEEEE; font-family: Tahoma; font-size:9pt; color: #700b0b}
    
    TABLE { font-family:Tahoma; font-size:8pt }
    
    TABLE.border {border-width: 1px; border-style: solid; border-color: black;}
    
    TD.testa {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        text-transform: uppercase;
        color: #faf717;
        background: #700b0b;
        font-weight: bold;
        font-variant: normal;
        text-align: center;
        vertical-align: middle;
        font-size: 9px;
    }
    </style>";

    $mexemail = "$mail_css $commento<hr>".trim(stripslashes("$mexemail"));

    ########################
        $destinatari = "";
        $file = file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
        $linee = count($file);
                    for($linea = 1; $linea < $linee; $linea++) {       
            @list($outente, $opassword, $opermessi, $oemail, $ourl, $osquadra, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$linea]);      
                $destinatari .= "$outente <$oemail>,";      
            }      
        $destinatari .= "\r\n";      
       
			
        if ($gestione_email == "mail_OK") {

          $intestazioni  = "MIME-Version: 1.0\r\n";
          $intestazioni .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $intestazioni .= "From: $email_nome_mittente <$email_mittente>\r\n" ;
        $intestazioni .= "X-Mailer: PHP v".phpversion()."\r\n";
        $intestazioni .= "bcc: ".$destinatari;
                if(@mail("Utenti $titolo_sito <$email_mittente>",$oggetto,"$mexemail\r\n",$intestazioni)) 
                    $azione = "La mail &egrave; stata inoltrata con successo.";        
                else 
                    $azione = "Si sono verificati dei problemi nell'invio della mail.";      
                }



        elseif ($gestione_email == "mail_anteprima") $azione = "<center><h3>Invio resoconto ultima giornata</h3><form method=\"post\" action=\"a_invia_risultati.php\">
        <input type=\"hidden\" name=\"commento\" value=\"$commento\">
        <input type=\"hidden\" name=\"gestione_email\" value=\"mail_OK\">
        <input type=\"submit\" name=\"invia\" value=\"Invia messaggio\">
        </form></center><hr><b>DESTINATARI</b><br>$destinatari<hr><hr><b>MESSAGGIO</b><br>$mexemail";

        elseif ($azione == "") $azione = "Errore, Invio email non riuscito.";
    }
    # fine gestione invio emails
    ###############################

    else $azione = "<h3>Invio resoconto ultima giornata</h3>
    Inserisci un eventuale commento all'invio dei voti<br>
    <form method=\"post\" action=\"a_invia_risultati.php\">
    <input type=\"hidden\" name=\"gestione_email\" value=\"mail_anteprima\">
    <textarea name=\"commento\" rows=8 cols=60 wrap=\"virtual\">Invio resoconto ultima giornata.</textarea><br>
    <input type=\"submit\" value=\"Anteprima invio\"></form>";

echo "$azione</td></tr></table>";


require ("./footer.php");
}
########################################################
	if ($_SESSION['permessi'] == 5) {

	require ("./a_menu.php");
	
	if($_POST["l_torneo"]!= "")
$storneo=$_POST["l_torneo"];

$pp="_".$storneo."_0";

	$tornei = @file($percorso_cartella_dati."/tornei.php");
	$num_tornei = count($tornei);

	for($num = 1 ; $num < $num_tornei; $num++) {
		unset ($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $continuare, $errore, $errori, $voti, $schema_attuale, $mercato_libero, $campionato, $diff_num_giornata_file, $stato_mercato, $soldi_iniziali, $composizione_squadra, $numero_cambi_max, $rip_cambi_numero, $rip_cambi_giornate, $rip_cambi_durata, $modificatore_difesa, $schemi, $max_in_panchina, $panchina_fissa, $max_entrate_dalla_panchina, $sostituisci_per_ruolo, $sostituisci_per_schema, $sostituisci_fantasisti_come_centrocampisti, $aspetta_giorni, $aspetta_ore, $aspetta_minuti, $num_calciatori_scambiabili, $scambio_con_soldi, $vendi_costo, $percentuale_vendita, $soglia_voti_primo_gol, $incremento_voti_gol_successivi, $voti_bonus_in_casa, $punti_partita_vinta, $punti_partita_pareggiata, $punti_partita_persa, $differenza_punti_a_parita_gol, $differenza_punti_zero_a_zero, $min_num_titolari_in_formazione, $punti_pareggio, $punti_posizione, $formazione,$num_giornata_voti);

		@list($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza) = explode(",", $tornei[$num]);
}
	
if ($gestione_email == "mail_anteprima" or $gestione_email == "mail_OK") {
for ($num1 = 1 ; $num1 < 40 ; $num1++) {
        if ($num1<10) $num1 = "0".$num1;
   $ggult=$num1-1;
    $giornata_controlla = "giornata$num1".$pp;
        if (!@is_file("$percorso_cartella_dati/$giornata_controlla")) break;
        else $giornata_ultima = $num1.$pp;
    } # fine for $num1

	if (!$giornata or $giornata > $giornata_ultima) $giornata = "$giornata_ultima";
	

$mexemail = "<center><h2>Giornata $ggult</h2></center>";

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

if ($giornata_ultima) $file_giornata = file("$percorso_cartella_dati/giornata$giornata");
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

$file = @file("./dati/utenti_".$storneo.".php");
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
		$tab_formazioni .= "<tr bgcolor='$colore'><td>$riga_calciatore[2]&nbsp;&nbsp;&nbsp;$nome_calciatore</td><td align='center'>$riga_calciatore[3]</td><td align='center'>$riga_calciatore[4]</td></tr>";
		} # fine for $num2
	$tab_formazioni .= "</table><div align='right'><a href='#top'>^ Top</a></div></td>";

	} # fine for $num1
	for ($num1 = $num_colonne ; $num1 < 2; $num1++) $tab_formazioni .= "<td>&nbsp;</td>";
	$tab_formazioni .= "</tr>";


$tipo_campionato = "";
$num_giornata = str_replace("giornata","",$giornata);
if (substr($num_giornata,0,1) == 0) $num_giornata = substr($num_giornata,1);
$num_campionati = count($campionato);
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

if ($ottipo_calcolo == "S") {
$mexemail .= "<br/><table width=\"80%\" align=\"center\" bgcolor=\"$sfondo_tab\" cellpadding=\"5\" border=\"1\">";
$mexemail .= "<tr><td width=\"50%\" align=\"center\"><b>Partite</b></td><td><b>Risultato</b></td></tr>";
$partite = "";
$marcotori = "";
$num_scontri = count($scontri);
for($num1 = 0 ; $num1 < $num_scontri ; $num1++) {
$dati_scontri = explode("##@@&&", $scontri[$num1]);
$mexemail .= "<tr><td>".$nome_squadra_memo[$dati_scontri[0]]." - ".$nome_squadra_memo[$dati_scontri[1]]."</td><td align=\"center\">".$dati_scontri[2]." - ".$dati_scontri[3]."</td></tr>";
} # fine for $num1
$mexemail .= "</table><br/>";
} # fine if ($ottipo_calcolo == "S")

###############################################

    if ($voti_esistenti == "SI") {
    $giorn_ata = substr($giornata,-2);
    if ($voti_bonus_in_casa)
    $mexemail .= "<br/><table align=\"center\" bgcolor=\"$sfondo_tab\" class=\"border\" cellpadding=\"10\"><tr><td align=\"left\" valign=\"top\"><b><u>Voti della giornata $ggult</u></b>:<br/><font color=\"red\">(Aggiungere +$voti_bonus_in_casa per le squadre in casa)</font><br/><br/>";
    else
    $mexemail .= "<br/><table align=\"center\" bgcolor=\"$sfondo_tab\" class=\"border\" cellpadding=\"10\"><tr><td align=\"left\" valign=\"top\"><b><u>Voti della giornata $ggult</u></b>:<br/>";
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
    $mexemail .= $nome_squadra_memo[$key].": $val<br/>";
    } # fine while
    $mexemail .= "</td>";

    if ($otmodificatore_difesa == "SI") {
    $mexemail .= "<td align=\"left\" valign=\"top\"><u><b>Modificatore difesa</b></u><br/>";
    if ($voti_bonus_in_casa) $mexemail .= "<br/><br/>";
    $num_mod = count($modificatore);
	for ($num1 = 0 ; $num1 < $num_mod ; $num1++) {
	$dati_mod = explode("##@@&&", $modificatore[$num1]);
	settype($dati_mod[0],"string");
	settype($dati_mod[1],"float");
    $mexemail .= $dati_mod[0].": ".$dati_mod[1]."<br/>";
    $mod[$dati_mod[0]] = $dati_mod[1];
    } # fine for $num1
    $mexemail .= "</td>";
    } # fine if modificatore difesa

	if ($ottipo_calcolo == "P") {
    if ($voti_bonus_in_casa) $mexemail .= "<br/><br/>";
    $mexemail .= "<td align=\"left\" valign=\"top\"><b><u>Punteggio</u></b><br/>";
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
    $mexemail .= "$val<br/>";
    } # fine while
    $mexemail .= "</td>";
    } # fine if ($ottipo_calcolo == "P")

    	# calcolo la classifica fino a questa giornata
	if ($ottipo_calcolo != "N") {
	$punti = "";
	for ($num1 = $g_inizio_campionato; $num1 <= $num_giornata; $num1++) {
	if (strlen($num1) == 1) $num1 = "0".$num1;
	$giornata_punti = "giornata$num1".$pp;
    if (@is_file("$percorso_cartella_dati/$giornata_punti")) {
    $file_giornata_p = @file("$percorso_cartella_dati/$giornata_punti");
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


    $mexemail .= "<td align=\"left\">&nbsp;&nbsp;</td><td align=\"left\"><font color=\"red\"><b><u>Classifica alla giornata $ggult</u></b>:</font><br/>";
    arsort ($punti);
	reset ($punti);
	$posclas = 0;
		while (list ($key, $val) = each ($punti)) {
		$posclas++;
		$vedivoti=htmlentities($nome_squadra_memo[$key], ENT_QUOTES);
        $mexemail .= "$posclas)&nbsp;".$nome_squadra_memo[$key].": $val<br/>";
        } # fine while
    $mexemail .= "</td>";
    } # fine if ($ottipo_calcolo != "N")
    $mexemail .= "</tr></table>";
    } # fine if ($voti_esistenti == "SI")

$mexemail .= "<br/><br/><table align=\"center\" bgcolor=\"$sfondo_tab\" border=\"1\" cellpadding=\"10\" cellspacing=\"5\">$tab_formazioni</table>";









##################################
# Invio email


    $oggetto = "Invio risultati\r\n";
    $mail_css = "<style type=\"text/css\">
    BODY {background-color:#EEEEEE; font-family: Tahoma; font-size:9pt; color: #700b0b}
    
    TABLE { font-family:Tahoma; font-size:8pt }
    
    TABLE.border {border-width: 1px; border-style: solid; border-color: black;}
    
    TD.testa {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        text-transform: uppercase;
        color: #faf717;
        background: #700b0b;
        font-weight: bold;
        font-variant: normal;
        text-align: center;
        vertical-align: middle;
        font-size: 9px;
    }
    </style>";

    $mexemail = "$mail_css $commento<hr>".trim(stripslashes("$mexemail"));

    ########################
        $destinatari = "";
        $file = file("./dati/utenti_".$storneo.".php");
	
        $linee = count($file);
           for($linea = 1; $linea < $linee; $linea++) {       
            @list($outente, $opassword, $opermessi, $oemail, $ourl, $osquadra, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$linea]);      
                $destinatari .= "$outente,"; 
				$lista_indirizzi[$linea-1]="$oemail,";
				
            }      
        $destinatari .= "\r\n";    

        if ($gestione_email == "mail_OK") {
		
        $intestazioni  = "MIME-Version: 1.0\r\n";
        $intestazioni .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $intestazioni .= "From: $admin_nome <$email_mittente>\r\n" ;
        $intestazioni .= "X-Mailer: PHP v".phpversion()."\r\n";
		
		
		###################	
	
		$mail2send = 10;
		$tot_ind = count ($lista_indirizzi); 
		$num_invii = ceil($tot_ind/$mail2send);
		$contatore = 0;
		for ($n = 1; $n <= $num_invii; ++$n) {
			$destinatarix ="";
			for ($nm = 1; $nm <= $mail2send; ++$nm) {
				$destinatarix .= $lista_indirizzi[$contatore];
				$contatore++;
			} 
      		
        $intestazioni .= "bcc: ".$destinatarix;
        if(@mail("Utenti $titolo_sito <$email_mittente>",$oggetto,"$mexemail\r\n",$intestazioni)) 
            $azione = "La mail &egrave; stata inoltrata con successo.";        
        else 
        $azione = "Si sono verificati dei problemi nell'invio della mail.";      
      
}
	  }



        elseif ($gestione_email == "mail_anteprima") $azione = "<center><h3>Invio resoconto ultima giornata</h3><form method=\"post\" action=\"a_invia_risultati.php\">
        <input type=\"hidden\" name=\"commento\" value=\"$commento\">
	    <input type=\"hidden\" name=\"storneo\" value=\"$storneo\">
        <input type=\"hidden\" name=\"gestione_email\" value=\"mail_OK\">
        <input type=\"submit\" name=\"invia\" value=\"Invia messaggio\">
        </form></center><hr><b>DESTINATARI</b><br>$destinatari<hr><hr><b>MESSAGGIO</b><br>$mexemail";

        elseif ($azione == "") $azione = "Errore, Invio email non riuscito.";
    }
    # fine gestione invio emails
    ###############################

		else $azione = "<h3>Invio resoconto ultima giornata</h3>
      $frase<br>
    <form method=\"post\" action=\"a_invia_risultati.php\">
    <input type=\"hidden\" name=\"gestione_email\" value=\"mail_anteprima\">
    <input type=\"hidden\" name=\"storneo\" value=\"mail_anteprima\">
    $vedi_tornei_attivi	<br/><br/>
    Inserisci un eventuale commento all'invio dei voti<br>
	<textarea name=\"commento\" rows=8 cols=60 wrap=\"virtual\">Invio resoconto ultima giornata.</textarea><br>
    <input type=\"submit\" value=\"Anteprima invio\"></form>";


echo "$azione</td></tr></table>";


require ("./footer.php");

	}
?>