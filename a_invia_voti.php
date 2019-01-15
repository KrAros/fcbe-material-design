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

  if($attiva_multi == "SI") {
		$frase='INDICA PER QUALE TORNEO VUOI INVIARE LE FORMAZIONI';
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

if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] <= 4) {
require ("./menu.php");

##################################
# Invio email

	if ($gestione_email == "mail_anteprima" or $gestione_email == "mail_OK") {

	########################
	# Layout pagina

	$mail_formazione = "";
	$color = "ghostwhite";
	$nome_squadra = "tutti";
	############################################

    $file = @file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
	$linee = count($file);

	for($num1 = 1 ; $num1 < $linee; $num1++) {
	
	@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$num1]);
	$giocatore = $outente;
	$soprannome_squadra = $osquadra;
	$soprannome_squadra = togli_acapo($soprannome_squadra);
	$titolo = "<center><h3><font color='red'>";
	if ($soprannome_squadra) $titolo .= "$soprannome_squadra";
	else $titolo .=  "Squadra";
	$titolo .=  " di $giocatore</font></h3>";
	$dati_squadra = @file("$percorso_cartella_dati/squadra_$giocatore");

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

	$calciatori = @file("$percorso_cartella_dati/mercato_".$_SESSION['torneo']."_0.txt");
	$np = 0; $nd = 0; $nc = 0; $nf = 0; $na = 0;

	$num_calciatori = count($calciatori);
	for ($num2 = 0 ; $num2 < $num_calciatori ; $num2++) {
	$dati_calciatore = explode(",", $calciatori[$num2]);
	$numero = $dati_calciatore[0];
	$ruolo = $dati_calciatore[2];
	$proprietario = $dati_calciatore[4];

	if ($proprietario == $giocatore) {
	$soldi_spesi = $soldi_spesi + $dati_calciatore[3];

	$num_calciatori_posseduti++;
	if ($ruolo == "P") $np++;
	else if ($ruolo == "D") $nd++;
	else if ($ruolo == "C") $nc++;
	else if ($ruolo == "F") $nf++;
	else if ($ruolo == "A") $na++;

	$nome = $dati_calciatore[1];
	$ruolo = $dati_calciatore[2];
	$costo = $dati_calciatore[3];
	$lista_calciatori[$contatore_calciatori] = $numero;
	$contatore_calciatori++;
	$nome_linea = "linea_comprato_$ruolo";
	${$nome_linea}[$numero] = "<tr><td>&nbsp;</td>
	<td align=center>$numero</td>
	<td>$nome</td>
	<td align=center>$ruolo</td>";
	${$nome_linea}[$numero] .= "</tr>";
	} # fine if ($proprietario == $giocatore)
	} # fine for $num2

	#########################################################
	$tab_centro = "<table width='80%' class='border' border=0 cellspacing=1 cellpadding=1 align='center'><tr><td align='center'><b>Pos.</b></td>
	<td align='center'><b>Num.</b></td>
	<td align='center'><b>Nome giocatore</b></td>
	<td align='center'><b>Ruolo</b></td>";
	$colspan = 4;
	$tab_centro .= "</tr>
	<tr><td class='testa' align='center' colspan='$colspan'><B>Titolari</B></td></tr>";
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
	$linea_comprato_P[$numero_titolare] = ereg_replace("value=\"titolare\"","value=\"titolare\" checked",$linea_comprato_P[$numero_titolare]);
	$linea_comprato_P[$numero_titolare] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align=center>$num_pos</td>",$linea_comprato_P[$numero_titolare]);
	$num_pos++;
	$tab_titolari_P .= $linea_comprato_P[$numero_titolare];
	$inserito[$numero_titolare] = "SI";
	} # fine if ($linea_comprato_P[$numero_titolare])
	if ($linea_comprato_D[$numero_titolare]) {
	$linea_comprato_D[$numero_titolare] = ereg_replace("value=\"titolare\"","value=\"titolare\" checked",$linea_comprato_D[$numero_titolare]);
	$linea_comprato_D[$numero_titolare] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align=center>$num_pos</td>",$linea_comprato_D[$numero_titolare]);
	$num_pos++;
	$tab_titolari_D .= $linea_comprato_D[$numero_titolare];
	$inserito[$numero_titolare] = "SI";
	} # fine if ($linea_comprato_D[$numero_titolare])
	if ($linea_comprato_C[$numero_titolare]) {
	$linea_comprato_C[$numero_titolare] = ereg_replace("value=\"titolare\"","value=\"titolare\" checked",$linea_comprato_C[$numero_titolare]);
	$linea_comprato_C[$numero_titolare] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align=center>$num_pos</td>",$linea_comprato_C[$numero_titolare]);
	$num_pos++;
	$tab_titolari_C .= $linea_comprato_C[$numero_titolare];
	$inserito[$numero_titolare] = "SI";
	} # fine if ($linea_comprato_C[$numero_titolare])
	if ($linea_comprato_F[$numero_titolare]) {
	$linea_comprato_F[$numero_titolare] = ereg_replace("value=\"titolare\"","value=\"titolare\" checked",$linea_comprato_F[$numero_titolare]);
	$linea_comprato_F[$numero_titolare] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align=center>$num_pos</td>",$linea_comprato_F[$numero_titolare]);
	$num_pos++;
	$tab_titolari_F .= $linea_comprato_F[$numero_titolare];
	$inserito[$numero_titolare] = "SI";
	} # fine if ($linea_comprato_F[$numero_titolare])
	if ($linea_comprato_A[$numero_titolare]) {
	$linea_comprato_A[$numero_titolare] = ereg_replace("value=\"titolare\"","value=\"titolare\" checked",$linea_comprato_A[$numero_titolare]);
	$linea_comprato_A[$numero_titolare] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align=center>$num_pos</td>",$linea_comprato_A[$numero_titolare]);
	$num_pos++;
	$tab_titolari_A .= $linea_comprato_A[$numero_titolare];
	$inserito[$numero_titolare] = "SI";
	} # fine if ($linea_comprato_A[$numero_titolare])
	} # fine for $num2
	$tab_centro .= $tab_titolari_P.$tab_titolari_D.$tab_titolari_C.$tab_titolari_F.$tab_titolari_A;

	# Tabella dei panchinari
	$tab_centro .= "<tr><td class=testa colspan='$colspan'><B>In panchina</B></td></tr>";
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
	$linea_comprato_P[$numero_panchinaro] = ereg_replace("value=\"panchinaro\"","value=\"panchinaro\" checked",$linea_comprato_P[$numero_panchinaro]);
	$linea_comprato_P[$numero_panchinaro] = ereg_replace("option value=\"$num_in_panchina\"","option value=\"$num_in_panchina\" selected",$linea_comprato_P[$numero_panchinaro]);
	$linea_comprato_P[$numero_panchinaro] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align=center>$num_pos</td>",$linea_comprato_P[$numero_panchinaro]);
	$num_pos++;
	$tab_panchinari .= $linea_comprato_P[$numero_panchinaro];
	$inserito[$numero_panchinaro] = "SI";
	} # fine if ($linea_comprato_P[$numero_panchinaro])
	if ($linea_comprato_D[$numero_panchinaro]) {
	$linea_comprato_D[$numero_panchinaro] = ereg_replace("value=\"panchinaro\"","value=\"panchinaro\" checked",$linea_comprato_D[$numero_panchinaro]);
	$linea_comprato_D[$numero_panchinaro] = ereg_replace("option value=\"$num_in_panchina\"","option value=\"$num_in_panchina\" selected",$linea_comprato_D[$numero_panchinaro]);
	$linea_comprato_D[$numero_panchinaro] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align=center>$num_pos</td>",$linea_comprato_D[$numero_panchinaro]);
	$num_pos++;
	$tab_panchinari .= $linea_comprato_D[$numero_panchinaro];
	$inserito[$numero_panchinaro] = "SI";
	} # fine if ($linea_comprato_D[$numero_panchinaro])
	if ($linea_comprato_C[$numero_panchinaro]) {
	$linea_comprato_C[$numero_panchinaro] = ereg_replace("value=\"panchinaro\"","value=\"panchinaro\" checked",$linea_comprato_C[$numero_panchinaro]);
	$linea_comprato_C[$numero_panchinaro] = ereg_replace("option value=\"$num_in_panchina\"","option value=\"$num_in_panchina\" selected",$linea_comprato_C[$numero_panchinaro]);
	$linea_comprato_C[$numero_panchinaro] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align=center>$num_pos</td>",$linea_comprato_C[$numero_panchinaro]);
	$num_pos++;
	$tab_panchinari .= $linea_comprato_C[$numero_panchinaro];
	$inserito[$numero_panchinaro] = "SI";
	} # fine if ($linea_comprato_C[$numero_panchinaro])
	if ($linea_comprato_F[$numero_panchinaro]) {
	$linea_comprato_F[$numero_panchinaro] = ereg_replace("value=\"panchinaro\"","value=\"panchinaro\" checked",$linea_comprato_F[$numero_panchinaro]);
	$linea_comprato_F[$numero_panchinaro] = ereg_replace("option value=\"$num_in_panchina\"","option value=\"$num_in_panchina\" selected",$linea_comprato_F[$numero_panchinaro]);
	$linea_comprato_F[$numero_panchinaro] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align=center>$num_pos</td>",$linea_comprato_F[$numero_panchinaro]);
	$num_pos++;
	$tab_panchinari .= $linea_comprato_F[$numero_panchinaro];
	$inserito[$numero_panchinaro] = "SI";
	} # fine if ($linea_comprato_F[$numero_panchinaro])
	if ($linea_comprato_A[$numero_panchinaro]) {
	$linea_comprato_A[$numero_panchinaro] = ereg_replace("value=\"panchinaro\"","value=\"panchinaro\" checked",$linea_comprato_A[$numero_panchinaro]);
	$linea_comprato_A[$numero_panchinaro] = ereg_replace("option value=\"$num_in_panchina\"","option value=\"$num_in_panchina\" selected",$linea_comprato_A[$numero_panchinaro]);
	$linea_comprato_A[$numero_panchinaro] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align=center>$num_pos</td>",$linea_comprato_A[$numero_panchinaro]);
	$num_pos++;
	$tab_panchinari .= $linea_comprato_A[$numero_panchinaro];
	$inserito[$numero_panchinaro] = "SI";
	} # fine if ($linea_comprato_A[$numero_panchinaro])
	} # fine for $num2
	#echo $tab_panchinari_P.$tab_panchinari_D.$tab_panchinari_C.$tab_panchinari_A;
	$tab_centro .= $tab_panchinari;

	# Tabella degli esclusi
	$tab_centro .= "<tr><td class=testa colspan=\"$colspan\"><B>Tribuna</B></td></tr>";
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
	$linea_comprato_P[$numero_fuori] = ereg_replace("value=\"fuori\"","value=\"fuori\" checked",$linea_comprato_P[$numero_fuori]);
	$tab_fuori_P .= $linea_comprato_P[$numero_fuori];
	$inserito[$numero_fuori] = "SI";
	} # fine if ($linea_comprato_P[$numero_fuori])
	if ($linea_comprato_D[$numero_fuori]) {
	$linea_comprato_D[$numero_fuori] = ereg_replace("value=\"fuori\"","value=\"fuori\" checked",$linea_comprato_D[$numero_fuori]);
	$tab_fuori_D .= $linea_comprato_D[$numero_fuori];
	$inserito[$numero_fuori] = "SI";
	} # fine if ($linea_comprato_D[$numero_fuori])
	if ($linea_comprato_C[$numero_fuori]) {
	$linea_comprato_C[$numero_fuori] = ereg_replace("value=\"fuori\"","value=\"fuori\" checked",$linea_comprato_C[$numero_fuori]);
	$tab_fuori_C .= $linea_comprato_C[$numero_fuori];
	$inserito[$numero_fuori] = "SI";
	} # fine if ($linea_comprato_C[$numero_fuori])
	if ($linea_comprato_F[$numero_fuori]) {
	$linea_comprato_F[$numero_fuori] = ereg_replace("value=\"fuori\"","value=\"fuori\" checked",$linea_comprato_F[$numero_fuori]);
	$tab_fuori_F .= $linea_comprato_F[$numero_fuori];
	$inserito[$numero_fuori] = "SI";
	} # fine if ($linea_comprato_F[$numero_fuori])
	if ($linea_comprato_A[$numero_fuori]) {
	$linea_comprato_A[$numero_fuori] = ereg_replace("value=\"fuori\"","value=\"fuori\" checked",$linea_comprato_A[$numero_fuori]);
	$tab_fuori_A .= $linea_comprato_A[$numero_fuori];
	$inserito[$numero_fuori] = "SI";
	} # fine if ($linea_comprato_A[$numero_fuori])
	} # fine if ($inserito[$num_fuori] != "SI")
	} # fine for $num2
	$tab_centro .= $tab_fuori_P.$tab_fuori_D.$tab_fuori_C.$tab_fuori_F.$tab_fuori_A;

	$mail_formazione .= $titolo;
	$mail_formazione .=  "$tab_centro</td></tr></table>";

	} # fine for $num1

	$oggetto = "Invio formazioni\r\n";
	$mail_css = "<style type='text/css'>
	BODY {font-family: Tahoma; font-size:9pt; color: #700b0b}
	
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

	$mail_formazione = "$mail_css $commento<hr>".trim(stripslashes("$mail_formazione"));

	########################
		$destinatari = "";
        $file = file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
		$linee = count($file);
			for($linea = 1; $linea < $linee; $linea++) {
			@list($outente, $opassword, $opermessi, $oemail, $ourl, $osquadra, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$linea]);
				$destinatari .= "$outente <$oemail>,";
			}
		$destinatari .= "\r\n";

		if ($gestione_email == "mail_OK") {

	  	$intestazioni  = "MIME-Version: 1.0\n";
	  	$intestazioni .= "Content-type: text/html; charset=iso-8859-1\n";
	   	#$intestazioni .= "X-Priority: 3\n";
	   	#$intestazioni .= "X-MSMail-Priority: Normal\n";
	   	#$intestazioni .= "X-Mailer: FantacalcioBazar mailer\n";
		$intestazioni .= "From: $admin_nome <$email_mittente>\n" ;

			if(@mail($destinatari,$oggetto,"$mail_formazione\n",$intestazioni)) $azione = "La mail ‚ stata inoltrata con successo."; 
			else $azione = "Si sono verificati dei problemi nell'invio della mail.";
		}

		elseif ($gestione_email == "mail_anteprima") $azione = "<center><h3>Invio formazioni</h3><form method='post' action='a_invia_voti.php'>
		<input type='hidden' name='commento' value='$commento' />
		<input type='hidden' name='gestione_email' value='mail_OK' />
		<input type='submit' name='invia' value='Invia messaggio' />
		</form></center><hr><b>DESTINATARI</b><br/>$destinatari<hr><hr><b>MESSAGGIO</b><br/>$mail_formazione";

		elseif ($azione == "") $azione = "Errore, Invio email non riuscito.";
	}
	# fine gestione invio emails
	###############################

	else $azione = "<h3>Invio email con formazioni</h3>
	Inserisci un eventuale commento all'invio delle formazioni<br/>
	<form method='post' action='a_invia_voti.php'>
	<input type='hidden' name='gestione_email' value='mail_anteprima' />
	<textarea name='commento' rows=8 cols=60 wrap='virtual'>Invio delle formazioni selezionate per questa giornata di fantacalcio.</textarea><br/>
	<input type='submit' value='Anteprima invio' /></form>";

echo "$azione";

include("./footer.php");
} # fine if ($pass_admin_errata == "NO")
#########################################################

if ($_SESSION['permessi'] == 5) {
require ("./a_menu.php");

	if($_POST["l_torneo"]!= "")
$storneo=$_POST["l_torneo"];

##################################
# Invio email

	if ($gestione_email == "mail_anteprima" or $gestione_email == "mail_OK") {

	########################
	# Layout pagina

	$mail_formazione = "";
	$color = "ghostwhite";
	$nome_squadra = "tutti";
	############################################

    $file = @file("./dati/utenti_".$storneo.".php");
	$linee = count($file);

	for($num1 = 1 ; $num1 < $linee; $num1++) {
	
	@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$num1]);
	$giocatore = $outente;
	$soprannome_squadra = $osquadra;
	$soprannome_squadra = togli_acapo($soprannome_squadra);
	$titolo = "<center><h3><font color='red'>";
	if ($soprannome_squadra) $titolo .= "$soprannome_squadra";
	else $titolo .=  "Squadra";
	$titolo .=  " di $giocatore</font></h3>";
	$dati_squadra = @file("$percorso_cartella_dati/squadra_$giocatore");

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

	$calciatori = @file("$percorso_cartella_dati/mercato_".$storneo."_0.txt");
	$np = 0; $nd = 0; $nc = 0; $nf = 0; $na = 0;

	$num_calciatori = count($calciatori);
	for ($num2 = 0 ; $num2 < $num_calciatori ; $num2++) {
	$dati_calciatore = explode(",", $calciatori[$num2]);
	$numero = $dati_calciatore[0];
	$ruolo = $dati_calciatore[2];
	$proprietario = $dati_calciatore[4];

	if ($proprietario == $giocatore) {
	$soldi_spesi = $soldi_spesi + $dati_calciatore[3];

	$num_calciatori_posseduti++;
	if ($ruolo == "P") $np++;
	else if ($ruolo == "D") $nd++;
	else if ($ruolo == "C") $nc++;
	else if ($ruolo == "F") $nf++;
	else if ($ruolo == "A") $na++;

	$nome = $dati_calciatore[1];
	$ruolo = $dati_calciatore[2];
	$costo = $dati_calciatore[3];
	$lista_calciatori[$contatore_calciatori] = $numero;
	$contatore_calciatori++;
	$nome_linea = "linea_comprato_$ruolo";
	${$nome_linea}[$numero] = "<tr><td>&nbsp;</td>
	<td align=center>$numero</td>
	<td>$nome</td>
	<td align=center>$ruolo</td>";
	${$nome_linea}[$numero] .= "</tr>";
	} # fine if ($proprietario == $giocatore)
	} # fine for $num2

	#########################################################
	$tab_centro = "<table width='80%' class='border' border=0 cellspacing=1 cellpadding=1 align='center'><tr><td align='center'><b>Pos.</b></td>
	<td align='center'><b>Num.</b></td>
	<td align='center'><b>Nome giocatore</b></td>
	<td align='center'><b>Ruolo</b></td>";
	$colspan = 4;
	$tab_centro .= "</tr>
	<tr><td class='testa' align='center' colspan='$colspan'><B>Titolari</B></td></tr>";
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
	$linea_comprato_P[$numero_titolare] = ereg_replace("value=\"titolare\"","value=\"titolare\" checked",$linea_comprato_P[$numero_titolare]);
	$linea_comprato_P[$numero_titolare] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align=center>$num_pos</td>",$linea_comprato_P[$numero_titolare]);
	$num_pos++;
	$tab_titolari_P .= $linea_comprato_P[$numero_titolare];
	$inserito[$numero_titolare] = "SI";
	} # fine if ($linea_comprato_P[$numero_titolare])
	if ($linea_comprato_D[$numero_titolare]) {
	$linea_comprato_D[$numero_titolare] = ereg_replace("value=\"titolare\"","value=\"titolare\" checked",$linea_comprato_D[$numero_titolare]);
	$linea_comprato_D[$numero_titolare] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align=center>$num_pos</td>",$linea_comprato_D[$numero_titolare]);
	$num_pos++;
	$tab_titolari_D .= $linea_comprato_D[$numero_titolare];
	$inserito[$numero_titolare] = "SI";
	} # fine if ($linea_comprato_D[$numero_titolare])
	if ($linea_comprato_C[$numero_titolare]) {
	$linea_comprato_C[$numero_titolare] = ereg_replace("value=\"titolare\"","value=\"titolare\" checked",$linea_comprato_C[$numero_titolare]);
	$linea_comprato_C[$numero_titolare] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align=center>$num_pos</td>",$linea_comprato_C[$numero_titolare]);
	$num_pos++;
	$tab_titolari_C .= $linea_comprato_C[$numero_titolare];
	$inserito[$numero_titolare] = "SI";
	} # fine if ($linea_comprato_C[$numero_titolare])
	if ($linea_comprato_F[$numero_titolare]) {
	$linea_comprato_F[$numero_titolare] = ereg_replace("value=\"titolare\"","value=\"titolare\" checked",$linea_comprato_F[$numero_titolare]);
	$linea_comprato_F[$numero_titolare] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align=center>$num_pos</td>",$linea_comprato_F[$numero_titolare]);
	$num_pos++;
	$tab_titolari_F .= $linea_comprato_F[$numero_titolare];
	$inserito[$numero_titolare] = "SI";
	} # fine if ($linea_comprato_F[$numero_titolare])
	if ($linea_comprato_A[$numero_titolare]) {
	$linea_comprato_A[$numero_titolare] = ereg_replace("value=\"titolare\"","value=\"titolare\" checked",$linea_comprato_A[$numero_titolare]);
	$linea_comprato_A[$numero_titolare] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align=center>$num_pos</td>",$linea_comprato_A[$numero_titolare]);
	$num_pos++;
	$tab_titolari_A .= $linea_comprato_A[$numero_titolare];
	$inserito[$numero_titolare] = "SI";
	} # fine if ($linea_comprato_A[$numero_titolare])
	} # fine for $num2
	$tab_centro .= $tab_titolari_P.$tab_titolari_D.$tab_titolari_C.$tab_titolari_F.$tab_titolari_A;

	# Tabella dei panchinari
	$tab_centro .= "<tr><td class=testa colspan='$colspan'><B>In panchina</B></td></tr>";
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
	$linea_comprato_P[$numero_panchinaro] = ereg_replace("value=\"panchinaro\"","value=\"panchinaro\" checked",$linea_comprato_P[$numero_panchinaro]);
	$linea_comprato_P[$numero_panchinaro] = ereg_replace("option value=\"$num_in_panchina\"","option value=\"$num_in_panchina\" selected",$linea_comprato_P[$numero_panchinaro]);
	$linea_comprato_P[$numero_panchinaro] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align=center>$num_pos</td>",$linea_comprato_P[$numero_panchinaro]);
	$num_pos++;
	$tab_panchinari .= $linea_comprato_P[$numero_panchinaro];
	$inserito[$numero_panchinaro] = "SI";
	} # fine if ($linea_comprato_P[$numero_panchinaro])
	if ($linea_comprato_D[$numero_panchinaro]) {
	$linea_comprato_D[$numero_panchinaro] = ereg_replace("value=\"panchinaro\"","value=\"panchinaro\" checked",$linea_comprato_D[$numero_panchinaro]);
	$linea_comprato_D[$numero_panchinaro] = ereg_replace("option value=\"$num_in_panchina\"","option value=\"$num_in_panchina\" selected",$linea_comprato_D[$numero_panchinaro]);
	$linea_comprato_D[$numero_panchinaro] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align=center>$num_pos</td>",$linea_comprato_D[$numero_panchinaro]);
	$num_pos++;
	$tab_panchinari .= $linea_comprato_D[$numero_panchinaro];
	$inserito[$numero_panchinaro] = "SI";
	} # fine if ($linea_comprato_D[$numero_panchinaro])
	if ($linea_comprato_C[$numero_panchinaro]) {
	$linea_comprato_C[$numero_panchinaro] = ereg_replace("value=\"panchinaro\"","value=\"panchinaro\" checked",$linea_comprato_C[$numero_panchinaro]);
	$linea_comprato_C[$numero_panchinaro] = ereg_replace("option value=\"$num_in_panchina\"","option value=\"$num_in_panchina\" selected",$linea_comprato_C[$numero_panchinaro]);
	$linea_comprato_C[$numero_panchinaro] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align=center>$num_pos</td>",$linea_comprato_C[$numero_panchinaro]);
	$num_pos++;
	$tab_panchinari .= $linea_comprato_C[$numero_panchinaro];
	$inserito[$numero_panchinaro] = "SI";
	} # fine if ($linea_comprato_C[$numero_panchinaro])
	if ($linea_comprato_F[$numero_panchinaro]) {
	$linea_comprato_F[$numero_panchinaro] = ereg_replace("value=\"panchinaro\"","value=\"panchinaro\" checked",$linea_comprato_F[$numero_panchinaro]);
	$linea_comprato_F[$numero_panchinaro] = ereg_replace("option value=\"$num_in_panchina\"","option value=\"$num_in_panchina\" selected",$linea_comprato_F[$numero_panchinaro]);
	$linea_comprato_F[$numero_panchinaro] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align=center>$num_pos</td>",$linea_comprato_F[$numero_panchinaro]);
	$num_pos++;
	$tab_panchinari .= $linea_comprato_F[$numero_panchinaro];
	$inserito[$numero_panchinaro] = "SI";
	} # fine if ($linea_comprato_F[$numero_panchinaro])
	if ($linea_comprato_A[$numero_panchinaro]) {
	$linea_comprato_A[$numero_panchinaro] = ereg_replace("value=\"panchinaro\"","value=\"panchinaro\" checked",$linea_comprato_A[$numero_panchinaro]);
	$linea_comprato_A[$numero_panchinaro] = ereg_replace("option value=\"$num_in_panchina\"","option value=\"$num_in_panchina\" selected",$linea_comprato_A[$numero_panchinaro]);
	$linea_comprato_A[$numero_panchinaro] = ereg_replace("<tr><td>&nbsp;</td>","<tr><td align=center>$num_pos</td>",$linea_comprato_A[$numero_panchinaro]);
	$num_pos++;
	$tab_panchinari .= $linea_comprato_A[$numero_panchinaro];
	$inserito[$numero_panchinaro] = "SI";
	} # fine if ($linea_comprato_A[$numero_panchinaro])
	} # fine for $num2
	#echo $tab_panchinari_P.$tab_panchinari_D.$tab_panchinari_C.$tab_panchinari_A;
	$tab_centro .= $tab_panchinari;

	# Tabella degli esclusi
	$tab_centro .= "<tr><td class=testa colspan=\"$colspan\"><B>Tribuna</B></td></tr>";
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
	$linea_comprato_P[$numero_fuori] = ereg_replace("value=\"fuori\"","value=\"fuori\" checked",$linea_comprato_P[$numero_fuori]);
	$tab_fuori_P .= $linea_comprato_P[$numero_fuori];
	$inserito[$numero_fuori] = "SI";
	} # fine if ($linea_comprato_P[$numero_fuori])
	if ($linea_comprato_D[$numero_fuori]) {
	$linea_comprato_D[$numero_fuori] = ereg_replace("value=\"fuori\"","value=\"fuori\" checked",$linea_comprato_D[$numero_fuori]);
	$tab_fuori_D .= $linea_comprato_D[$numero_fuori];
	$inserito[$numero_fuori] = "SI";
	} # fine if ($linea_comprato_D[$numero_fuori])
	if ($linea_comprato_C[$numero_fuori]) {
	$linea_comprato_C[$numero_fuori] = ereg_replace("value=\"fuori\"","value=\"fuori\" checked",$linea_comprato_C[$numero_fuori]);
	$tab_fuori_C .= $linea_comprato_C[$numero_fuori];
	$inserito[$numero_fuori] = "SI";
	} # fine if ($linea_comprato_C[$numero_fuori])
	if ($linea_comprato_F[$numero_fuori]) {
	$linea_comprato_F[$numero_fuori] = ereg_replace("value=\"fuori\"","value=\"fuori\" checked",$linea_comprato_F[$numero_fuori]);
	$tab_fuori_F .= $linea_comprato_F[$numero_fuori];
	$inserito[$numero_fuori] = "SI";
	} # fine if ($linea_comprato_F[$numero_fuori])
	if ($linea_comprato_A[$numero_fuori]) {
	$linea_comprato_A[$numero_fuori] = ereg_replace("value=\"fuori\"","value=\"fuori\" checked",$linea_comprato_A[$numero_fuori]);
	$tab_fuori_A .= $linea_comprato_A[$numero_fuori];
	$inserito[$numero_fuori] = "SI";
	} # fine if ($linea_comprato_A[$numero_fuori])
	} # fine if ($inserito[$num_fuori] != "SI")
	} # fine for $num2
	$tab_centro .= $tab_fuori_P.$tab_fuori_D.$tab_fuori_C.$tab_fuori_F.$tab_fuori_A;

	$mail_formazione .= $titolo;
	$mail_formazione .=  "$tab_centro</td></tr></table>";

	} # fine for $num1

	$oggetto = "Invio formazioni\r\n";
	$mail_css = "<style type='text/css'>
	BODY {font-family: Tahoma; font-size:9pt; color: #700b0b}
	
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

	$mail_formazione = "$mail_css $commento<hr>".trim(stripslashes("$mail_formazione"));

	########################
		$destinatari = "";
		$file = @file("./dati/utenti_".$storneo.".php");
		$linee = count($file);
			for($linea = 1; $linea < $linee; $linea++) {
			@list($outente, $opassword, $opermessi, $oemail, $ourl, $osquadra, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$linea]);
				$destinatari .= "$outente <$oemail>,";
			}
		$destinatari .= "\r\n";

		if ($gestione_email == "mail_OK") {

	  	$intestazioni  = "MIME-Version: 1.0\n";
	  	$intestazioni .= "Content-type: text/html; charset=iso-8859-1\n";
	   	#$intestazioni .= "X-Priority: 3\n";
	   	#$intestazioni .= "X-MSMail-Priority: Normal\n";
	   	#$intestazioni .= "X-Mailer: FantacalcioBazar mailer\n";
		$intestazioni .= "From: $admin_nome <$email_mittente>\n" ;

			if(@mail($destinatari,$oggetto,"$mail_formazione\n",$intestazioni)) $azione = "La mail ‚ stata inoltrata con successo."; 
			else $azione = "Si sono verificati dei problemi nell'invio della mail.";
		}

		elseif ($gestione_email == "mail_anteprima") $azione = "<center><h3>Invio formazioni</h3><form method='post' action='a_invia_voti.php'>
		<input type='hidden' name='commento' value='$commento' />
		<input type=\"hidden\" name=\"storneo\" value=\"$storneo\">
		<input type='hidden' name='gestione_email' value='mail_OK' />
		<input type='submit' name='invia' value='Invia messaggio' />
		</form></center><hr><b>DESTINATARI</b><br/>$destinatari<hr><hr><b>MESSAGGIO</b><br/>$mail_formazione";

		elseif ($azione == "") $azione = "Errore, Invio email non riuscito.";
	}
	# fine gestione invio emails
	###############################

		else $azione = "<h3>Invio email con formazioni</h3>
      $frase<br>
    <form method=\"post\" action=\"a_invia_voti.php\">
    <input type=\"hidden\" name=\"gestione_email\" value=\"mail_anteprima\">
    <input type=\"hidden\" name=\"storneo\" value=\"mail_anteprima\">
    $vedi_tornei_attivi	<br/><br/>
    Inserisci un eventuale commento all'invio delle formazioni<br>
	<textarea name=\"commento\" rows=8 cols=60 wrap=\"virtual\">Invio formazioni prossima giornata.</textarea><br>
    <input type=\"submit\" value=\"Anteprima invio\"></form>";

echo "$azione";


include("./footer.php");
} # fine if ($pass_admin_errata == "NO")
?>