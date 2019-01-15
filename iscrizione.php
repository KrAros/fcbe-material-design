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
#error_reporting(E_ALL);
require_once("./dati/dati_gen.php");
require_once("./inc/funzioni.php");
include("./header.php");

echo "<div class='contenuto'>
<div id='articoli'>
<div id='sinistra'>
<div class='articoli_s'>";

if ($iscrizione_online == "SI") {

if($_POST['inserimento'] != "ok"){
		
$tornei = @file($percorso_cartella_dati."/tornei.php");
$num_tornei = 0;
	for($num1 = 0; $num1 < count($tornei); $num1++){
	$num_tornei++;
	}
$vedi_tornei_attivi = "<select name='itorneo'>";
	for ($num1 = 1 ; $num1 < $num_tornei; $num1++) {
	@list($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza) = explode(",", $tornei[$num1]);
	
	$fileo = @file($percorso_cartella_dati."/utenti_".$otid.".php");
	$linee = @count($fileo);
	$num_giocatori = 0;
	
		for($numx = 1; $numx < $linee; $numx++) {
		@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) =explode("<del>", trim($fileo[$numx]));
		if ($otorneo == $otid) $num_giocatori++;
		}
		if ($num_giocatori < $otpart OR $otpart == 0) $vedi_tornei_attivi .= "<option value='$otid'>$otdenom</option>";
	} # fine for $num1

$vedi_tornei_attivi .= "</select>";

If ($num1<=1) $erro="<b>Nessun Torneo attivo</b>";
else $erro="<input type = 'image' src = 'immagini/registrati.png' name = 'submit' alt = 'Prosegui e inserisci' />"

?>
<form method = "post" action = "iscrizione.php">
<input type = "hidden" name = "inserimento" value = "ok" />
<input type = "hidden" name = "ireg" value = "<?php print(date("d.m.Y H:i:s", mktime())); ?>" />
<table summary = "Modulo iscrizione">
<caption>Iscrizione utente al campionato</caption>
<tr>
<td colspan="2" align="center">
<?php
	if ($iscrizione_immediata_utenti == "NO") echo "<br /><b>L'iscrizione &egrave; subordinata alla approvazione del Presidente della Lega.<br />Riceverai una email con i dati di accesso ed alcune brevi note che &egrave; consigliato conservare.</b><br /><br />\n";
	else echo "<br /><b>Iscrizione immediata.<br />Riceverai una email con i dati ed alcune brevi note che &egrave; consigliato conservare.</b><br /><br />\n";

	if (trim($messaggi[10]) != "") echo "<div class='slogan'>" . html_entity_decode($messaggi[10]) . "</div>\n";
?>
</td>
</tr>
<tr>
<td width = "25%" align = "right">Nome:</td>
<td width = "75%">
<input type = "text" name = "inome" />&nbsp;&nbsp; ** obbligatorio</td>
</tr>
<tr>
<td width = "25%" align = "right">Cognome:</td>
<td width = "75%">
<input type = "text" name = "icognome" />&nbsp;&nbsp; ** obbligatorio</td>
</tr>
<tr>
<td width = "25%" align = "right">Username:</td>
<td width = "75%">
<input type = "text" name = "iutente" />&nbsp;&nbsp; ** obbligatorio minimo 4 e massimo 12 caratteri</td>
</tr>
<tr>
<td width = "25%" align = "right">Password:</td>
<td width = "75%">
<input type = "password" name = "ipass" />&nbsp;&nbsp; * obbligatorio minimo 4 e massimo 12 caratteri</td>
</tr>
<tr>
<td width = "25%" align = "right">Conferma password:</td>
<td width = "75%">
<input type = "password" name = "ipass2" />&nbsp;&nbsp; * obbligatorio</td>
</tr>
<tr>
<td width = "25%" align = "right">Email:</td>
<td width = "75%">
<input type = "text" name = "iemail" />&nbsp;&nbsp; obbligatorio</td>
</tr>
<tr>
<td width = "25%" align = "right">Ripeti email:</td>
<td width = "75%">
<input type = "text" name = "iemail2" />&nbsp;&nbsp; obbligatorio</td>
</tr>
<tr>
<td width = "25%" align = "right">Nome squadra:</td>
<td width = "75%">
<input type = "text" name = "isquadra" />&nbsp;&nbsp; obbligatorio minimo 4 e massimo 18 caratteri</td>
</tr>
<tr>
<td width = "25%" align = "right"><a href="./vedi_tornei.php">Visiona tornei</a></td>
<td width = '75%'><?php echo $vedi_tornei_attivi; ?></td>
</tr>
<tr>
<td width = "25%" align = "right">Sito web</td>
<td width = "75%">
<input type = "text" name = "iurl" value="http://" /></td>
</tr>
<tr>
<td width = "25%" align = "right">Citt&agrave;:</td>
<td width = "75%">
<input type = "text" name = "icitta" /></td>
</tr>
<tr>
<td width = "25%" align = "right">*</td>
<td width = "75%" align = "left">Case Sensitive</td>
</tr>
<tr>
<td width = "25%" align = "right">**</td>
<td width = "75%" align = "left">Case Sensitive e non modificabile</td>
</tr>
<tr>
<td colspan="2" align = "center"><br /><br />
<input type="checkbox" value="yes" name="iagree"/> Ho preso visione del Regolamento che trovo qui:<br/><a href="./regolamento.php">Regolamento Torneo</a>
</td>
</tr>
<tr>
<td width = "35%" align = "right"></td>
<td width = "65%"><br/><br/><?php echo $erro; ?></td>
</tr>
</table>
</form>
<?php
} elseif ($_POST['inserimento'] == "ok"){

####################################################

$inome = strip_tags($_POST['inome']);
$icognome = strip_tags($_POST['icognome']);
$iutente = strip_tags($_POST['iutente']);
$ipass = strip_tags($_POST['ipass']);
$ipass2 = strip_tags($_POST['ipass2']);
if ($iscrizione_immediata_utenti == 'NO') $ipermessi = -1;
else  $ipermessi = 0;
$iemail = strip_tags($_POST['iemail']);
$iemail2 = strip_tags($_POST['iemail2']);
$iurl = strip_tags($_POST['iurl']);
$icitta = strip_tags($_POST['icitta']);
$isquadra = strip_tags($_POST['isquadra']);
$itorneo = ($_POST['itorneo']);
$iregolamento = ($_POST['iagree']);
$iserie = 0;
$icrediti = 0;
$ivariazioni = 0;
$icambi = 0;
$ireg = $_POST['ireg'];

	if (!eregi("^[a-z0-9][_\.a-z0-9-]+@([a-z0-9][0-9a-z-]+\.)+([a-z]{2,4})",$_POST['iemail'])) $err[] = "&nbsp;&nbsp;&nbsp;- email non corretta;";

	if (!preg_match("/[a-z']$/i",$_POST['inome'])) $err[] = "&nbsp;&nbsp;&nbsp;- Nome non corretto; consentiti caratteri non numerici non accentati (usare l'apostrofo) e nessuno spazio;";
	
	if (!preg_match("/[a-z' ]$/i",$_POST['icognome'])) $err[] = "&nbsp;&nbsp;&nbsp;- Cognome non corretto; consentiti caratteri non numerici non accentati (usare l'apostrofo);";
	
	if (!preg_match("/^[a-z0-9]{4,12}$/i",$_POST['iutente'])) $err[] = "&nbsp;&nbsp;&nbsp;- Username non corretto; consentiti da 4 a 12 caratteri normali, non accentati e nessuno spazio;";
	
	if (!preg_match("/^[_a-z0-9-]{4,20}$/i",$_POST['isquadra'])) $err[] = "&nbsp;&nbsp;&nbsp;- nome squadra non corretto; consentiti da 4 a 18 caratteri normali, non accentati e nessuno spazio;";

	if (!preg_match("/^[a-z0-9]{4,12}$/i",$_POST['ipass']))	$err[] = "&nbsp;&nbsp;&nbsp;- password non corretta; consentiti da 4 a 12 caratteri normali, non accentati e nessuno spazio;";

	if ($ipass!==$ipass2) $err[]="&nbsp;&nbsp;&nbsp;- le password non coincidono;";

	if ($iemail!==$iemail2) $err[]="&nbsp;&nbsp;&nbsp;- gli indirizzi email non coincidono;";

	if (!$itorneo) $err[]="&nbsp;&nbsp;&nbsp;- torneo non selezionato;";

	if ($iutente == $admin_user) $err[]="&nbsp;&nbsp;&nbsp;- nome utente gi&agrave; utilizzato;";
	
	if ($iregolamento != "yes" ) $err[]="<b>&nbsp;&nbsp;&nbsp;- Devi accettare il regolamento per iscriverti;</b>";
	
// Verifica esistenza nome utente
//-----------------------------------------
	if (!@is_file($percorso_cartella_dati."/utenti_".$_POST['itorneo'].".php")) {
	$ini_file = "<?php die('ACCESSO VIETATO');?> // password = 5f4dcc3b5aa765d61d8327deb882cf99  --> md5(password)\n";
	$fp = fopen($percorso_cartella_dati."/utenti_".$_POST['itorneo'].".php", "wb") OR die ("errore fileopen");
	flock ($fp,LOCK_EX) OR die ("errore filelocl ex");
	fwrite($fp, $ini_file) OR die ("errore fwrite");
	flock ($fp,LOCK_UN) OR die ("errore filelocl un");
	fclose($fp) OR die ("errore fileclose");
		if (@chmod ($ini_file, 0664)) echo "CHMOD 664 impostato!<br />";
	unset ($ini_file);
	}
$tornei = @file($percorso_cartella_dati."/tornei.php");
$num_tornei = count($tornei);
$layout = "<table summary='Tornei in corso'><caption>Tornei in corso</caption>";

	for ($num1 = 1 ; $num1 < $num_tornei; $num1++) {
	@list($otid, $otdenom, $otpart, $otsqpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $ottipo, $ottrasferisci_gratis, $otforza_trasferisci) = explode(",", trim($tornei[$num1]));
	
	if (@is_file($percorso_cartella_dati."/utenti_".$itorneo.".php")) {
	$filep = @file($percorso_cartella_dati."/utenti_".$itorneo.".php") OR die("Ci sono problemi di permessi sul file utenti");
	$linee = count($filep);
	$trovato = 0;
	
		if ($itorneo == $otid) {$idenom = $otdenom;
		for ($num2 = 1 ; $num2 < $linee; $num2++) {
		@list($outente, $opassword, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni,$ocambi, $oreg)= explode("<del>", trim($filep[$num2]));
		if(strtolower($iutente) == strtolower($outente)) $trovato = $trovato +1;
		if(strtolower($iemail) == strtolower($oemail)) $trovato = $trovato +2;
		if(strtolower($isquadra) == strtolower($osquadra)) $trovato = $trovato +4;
	
		if($trovato > 0) break;}
	}
if($trovato==1) $err[]="&nbsp;&nbsp;&nbsp;- username ($iutente) gi&agrave; utilizzato da un altro utente;";
if($trovato==2) $err[]="&nbsp;&nbsp;&nbsp;- indirizzo email gi&agrave; utilizzato da un altro utente;";
if($trovato==4) $err[]="&nbsp;&nbsp;&nbsp;- nome squadra o indirizzo email gi&agrave; utilizzato da un altro utente;";
if($trovato==3) $err[]="&nbsp;&nbsp;&nbsp;- username ed indirizzo email gi&agrave; utilizzati da un altro utente;";
if($trovato==5) $err[]="&nbsp;&nbsp;&nbsp;- username e nome squadra gi&agrave; utilizzati da un altro utente;";
if($trovato==6) $err[]="&nbsp;&nbsp;&nbsp;- indirizzo email e nome squadra gi&agrave; utilizzati da un altro utente;";
if($trovato==7) $err[]="&nbsp;&nbsp;&nbsp;- username, indirizzo email e nome squadra gi&agrave; utilizzati da un altro utente;";
}
}

if(!empty($err)){
$tr=implode("<br />",$err);
?>
<table align="center">
<caption>Iscrizione utente al campionato</caption>
<tr><td align="center"><h1>Errori rilevati</h1></td></tr>
<tr><td><br /><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nei dati immessi nel precedente modulo sono stati riscontrati i seguentierrori:<br /><?php echo $tr ?><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Si prega di verificare i dati precedentemente immessi, verificando la presenza di eventuali caratteri non consentiti, di compilare i campi richiesti e di inserire le conferme di password e email.<br /></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="history.go(-1)">torna al modulo</a><br /><br/><br/><br/><br/><br/></td></tr></table>
<?php
unset($err,$tr);
} else { 		// non ci sono errori

// Verifico in che modo va attivato l'utente
if ($ipermessi==0){
	$attivazione_email=true;
	$ipermessi=-1;
}
// Crea la stringa da inserire

$stringa = $iutente. "<del>". md5($ipass). "<del>". $ipermessi. "<del>". $iemail. "<del>". $iurl. "<del>". $isquadra. "<del>". $itorneo. "<del>". $iserie. "<del>". $icitta. "<del>". $icrediti. "<del>". $ivariazioni. "<del>". $icambi. "<del>". $ireg . "<del>0<del>0<del>".$inome."<del>".$icognome."<del>0<del>0<del>0<del>0<del>0<del>0<del>0<del>0\n";

$oggetto = "Iscrizione Torneo Fantacalcio";
// Creo l'hash per l'attivazione
if ($attivazione_email){
	$codice=md5($stringa);
	$hash=$iutente."<del>".$itorneo."<del>".$codice."<del>".$ipass."<del>".$idenom."\n";
	// Se il file non esiste lo creo e blocco l'accesso via http
	if (!file_exists($percorso_cartella_dati."/hash.php")){
		$filehash = fopen($percorso_cartella_dati."/hash.php", "w+");
		flock($filehash,LOCK_EX);
		fwrite($filehash, "<?php die('ACCESSO NEGATO');?>\n");
		flock($filehash,LOCK_UN);
		fclose($filehash);
		unset($filehash);
	}//fine if(!file_exists)
	$filehash = fopen($percorso_cartella_dati."/hash.php", "ab");
	flock($filehash,LOCK_EX);
	fwrite($filehash, $hash);
	flock($filehash,LOCK_UN);
	fclose($filehash);
	unset($attivazione_email,$hash,$filehash);
}//fine if($attivazione_email)
// Invio mail al nuovo iscritto
if ($iscrizione_immediata_utenti == "NO") $messaggio = "Benvenuto in $titolo_sito!<br />
In questa email puoi trovare i dati necessari per accedere al sito:<br />
<b>Link al sito</b>: <a href='http://" .$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']). "'>http://" .$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']). "</a><br />
<b>Torneo:</b> $idenom<br />
<b>Username:</b> $iutente<br />
<b>Password:</b> $ipass<br />
<b>Nome squadra:</b> $isquadra<br />
<b>Email:</b> $iemail<br /><br />
Si ricorda che la registrazione &egrave; subordinata alla approvazione della Presidenza di Lega; una volta effettuato il primo Login si pu&ograve; modificare la password ed i dati della squadra accedendo alla apposita pagina.<br /><br />
Cordiali saluti!<br />$admin_nome<br /><br /><a href='http://" .$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']). "'>http://" .$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']). "</a><br /><br />
<b>Importante: conserva o stampa questa mail per ogni futura eventuale esigenza.</b><hr />";

else	$messaggio = "Benvenuto in $titolo_sito!<br />
In questa email puoi trovare i dati necessari per accedere al sito:<br />
<b>Link al sito</b>: <a href='http://" .$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']). "'>http://" .$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']). "</a><br /><br />
<b>Puoi attivare la tua iscrizione cliccando sul seguente link:</b> <br/><br/>
<a href='http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF'])."/attiva.php?codice=".$codice."&amp;cancella=NO'>http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF'])."/attiva.php?codice=".$codice."&cancella=NO</a><br/><br/>
Subito dopo la tua attivazione potrai connetterti e acquistare i tuoi calciatori, schierare la formazionee modificare alcuni tuoi dati nella pagina relativa alla squadra. Segui con attenzione le fasi di gioco, sarai guidato dai messaggi del Presidente di Lega, e potrai utilizzare la funzione di messaggistica per ogni ed eventuale comunicazione.<br /><br />
Cordiali saluti!<br />$admin_nome<br /><br /><a href='http://" .$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']). "'>http://" .$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']). "</a><br /><br />
<b>Se non sei stato tu a effettuare l'iscrizione, clicca sul seguente link per eliminare l'utente</b><br/><br/>
<a href='http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF'])."/attiva.php?codice=".$codice."&amp;cancella=SI'>http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF'])."/attiva.php?codice=".$codice."&cancella=SI</a><br/><br/>
<hr />";

$intestazioni  = "MIME-Version: 1.0\r\n";
$intestazioni .= "Content-type: text/html; charset=iso-8859-1\r\n";
#$intestazioni .= "X-Priority: 3\r\n";
#$intestazioni .= "X-MSMail-Priority: Normal\r\n";
#$intestazioni .= "X-Mailer: php\r\n";
$intestazioni .= "From: $admin_nome <$email_mittente>\r\n" ;
$intestazioni .= "Bcc: $admin_nome <$email_mittente>\r\n";
$destinatario = "$iutente <$iemail>\r\n";

if(!@mail($destinatario,$oggetto,$messaggio,$intestazioni))	$messiscr = "<h1>Iscrizione effettuata.</h1> <br/> <h2>Il messaggio non &egrave; stato spedito per un errore di servizio. <br />Contatta l'amministratore per informarlo di ci&ograve;!</h2>";
else $messiscr = "<h1>Iscrizione effettuata.</h1> <br />E' stata inviata una mail con i dati che hai inserito, conservala per ogni evenienza!";

$fp = fopen($percorso_cartella_dati."/utenti_".$_POST['itorneo'].".php", "ab");
flock($fp,LOCK_EX);
fwrite($fp, $stringa);
flock($fp,LOCK_UN);
fclose($fp);
unset($fp, $stringa);


echo"<table align='center'>
<caption>Iscrizione utente al campionato</caption>
<tr><td align='center'>
$messiscr
<br /><br /><br /><br /><br />
<br /><br /><br /><br /><br />
<br /><br /><br /><br /><br />
</td></tr><br /><br /><br /><br /><br />
</td></tr></table>";

echo"<meta http-equiv=\"refresh\" content=\"5; url=index.php\">";
include("./footer.php");
exit;
} # fine elseif ($inserimento == "ok")

} else echo "<table align='center'>
<caption>Iscrizione utente al campionato</caption>
<tr><td align='center'><h1>Si &egrave; verificato un problema.</h1> <br /><br /><br /><br /><br /><br /></td></tr></table>
<meta http-equiv='refresh' content='5; url=index.php'>";
}# fine if iscrizioni_online =SI
else {
echo "<table align='center'>
<tr><td align='center'><br /><br /><br /><br /><br />
<h1>Iscrizioni al campionato chiuse</h1> <br /><br /><br /><br /><br />
</td></tr></table>";
echo"<meta http-equiv='refresh' content='5; url=index.php'>";
} # fine elseif iscrizioni_online =SI
echo "</div></div><div id='destra'>";
include("./menu_i.php");
echo "</div></div>";
include("./footer.php");
?>