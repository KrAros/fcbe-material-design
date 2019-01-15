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
require_once("./controlla_pass.php");
include("./header.php");
########2345
if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] >= 4) {
	if ($_SESSION['permessi'] == 4) require ("./menu.php");	if($_POST['inserimento'] != "ok"){

		$vedi_tornei_attivi = "<select class='mdl-textfield__input' name='itorneo'>";
		$tornei = @file($percorso_cartella_dati."/tornei.php");
		$num_tornei = 0;
		for($num1 = 0; $num1 < count($tornei); $num1++){
			$num_tornei++;
		}

		for ($num1 = 1 ; $num1 < $num_tornei; $num1++) {
			@list($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza) = explode(",", $tornei[$num1]);

			$fileo = @file($percorso_cartella_dati."/utenti_".$otid.".php");
			$linee = @count($fileo);
			$num_giocatori = 0;

			for($numx = 1 ; $numx < $linee; $numx++) {
				@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $fileo[$numx]);
				if ($otorneo == $otid) $num_giocatori++;
			}

			if ($num_giocatori < $otpart OR $otpart == 0) $vedi_tornei_attivi .= "<option value='$otid'>$otdenom</option>";

		} # fine for $num1

		$vedi_tornei_attivi .= "</select>";
		?>
		<form method = "POST" action = "<?php echo($_SERVER['PHP_SELF']); ?>">
		<input type = "hidden" name = "inserimento" value = "ok" />
		<input type = "hidden" name = "ireg" value = "<?php print(date("d.m.Y H:i:s", mktime())); ?>" />
		<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:100%">
		<caption>Iscrizione utente al campionato</caption><tbody>
		<tr>
		<td colspan="3" class="mdl-data-table__cell--non-numeric">
		<br /><b>Iscrizione immediata di un utente: ricever&agrave; automaticamente una e-mail con i suoi dati d'accesso presenti.</b><br /><br /></td>		</tr>
		<tr>
		<td class="mdl-data-table__cell--non-numeric">Nome **</td>        <td align="center"><div class="mdl-textfield mdl-js-textfield"><input class="mdl-textfield__input" type = "text" name = "inome" /><label class="mdl-textfield__label" for="sample2">Inserisci...</label></div></td> 		<td>Nome del partecipante al torneo, diverso dall'Username.</td>		</tr>
		<tr>		<td class="mdl-data-table__cell--non-numeric">Cognome **</td>        <td align="center"><div class="mdl-textfield mdl-js-textfield"><input class="mdl-textfield__input" type = "text" name = "icognome" /><label class="mdl-textfield__label" for="sample2">Inserisci...</label></div></td>
		<td>Cognome del partecipante al torneo, diverso dall'Username.</td>				</tr>		<tr>
		<td class="mdl-data-table__cell--non-numeric">Username **</td>        <td align="center"><div class="mdl-textfield mdl-js-textfield"><input class="mdl-textfield__input" type = "text" name = "iutente" /><label class="mdl-textfield__label" for="sample2">Inserisci...</label></div></td>		<td>Username del partecipante al torneo. Minimo 4 e massimo 12 caratteri.</td>
		</tr>
		<tr>		<td class="mdl-data-table__cell--non-numeric">Password *</td>        <td align="center"><div class="mdl-textfield mdl-js-textfield"><input class="mdl-textfield__input" type = "password" name = "ipass" /><label class="mdl-textfield__label" for="sample2">Inserisci...</label></div></td>
		<td>Password del partecipante al torneo. Minimo 4 e massimo 12 caratteri.</td>		</tr>
		<tr>
		<td class="mdl-data-table__cell--non-numeric">Conferma password *</td>        <td align="center"><div class="mdl-textfield mdl-js-textfield"><input class="mdl-textfield__input" type = "password" name = "ipass2" /><label class="mdl-textfield__label" for="sample2">Inserisci...</label></div></td>
		<td>Ripetere la password inserita precedentemente.</td>				</tr>
		<tr>
		<td class="mdl-data-table__cell--non-numeric">E-mail *</td>        <td align="center"><div class="mdl-textfield mdl-js-textfield"><input class="mdl-textfield__input" type = "text" name = "iemail" /><label class="mdl-textfield__label" for="sample2">Inserisci...</label></div></td>
		<td>E-mail del partecipante al torneo: utile per validare il profilo. </td>		</tr>
		<tr>
		<td class="mdl-data-table__cell--non-numeric">Ripeti e-mail *</td>        <td align="center"><div class="mdl-textfield mdl-js-textfield"><input class="mdl-textfield__input" type = "text" name = "iemail2" /><label class="mdl-textfield__label" for="sample2">Inserisci...</label></div></td>
		<td>Ripetere e-mail inserita precedentemente.</td>		</tr>
		<tr>
		<td class="mdl-data-table__cell--non-numeric">Nome squadra *</td>        <td align="center"><div class="mdl-textfield mdl-js-textfield"><input class="mdl-textfield__input" type = "text" name = "isquadra" /><label class="mdl-textfield__label" for="sample2">Inserisci...</label></div></td>
		<td>Nome della squadra iscritta al torneo. </td>		</tr>		
		<?php
		if ($_SESSION['permessi'] == 5) echo"<tr>
		<td class='mdl-data-table__cell--non-numeric'><a href='./vedi_tornei.php'>Visiona tornei</a></td>
		<td align='center'><div class='mdl-textfield mdl-js-textfield'>". $vedi_tornei_attivi." </div></td>		<td>Prendi visione dei tornei disputati su questa piattaforma.</td>
		</tr>";
		elseif ($_SESSION['permessi'] == 4) echo"<tr>
		<td width = '35%' align = 'right'>Torneo</td>
		<td width = '65%' align = 'left'><input type = 'hidden' name = 'itorneo' value='".$_SESSION['torneo']."' />".$_SESSION['torneo']."</td>
		</tr>";
		?>
		<tr>
		<td class="mdl-data-table__cell--non-numeric">Sito web</td>        <td align="center"><div class="mdl-textfield mdl-js-textfield"><input class="mdl-textfield__input" type = "text" name = "iurl" value="http://" /><label class="mdl-textfield__label" for="sample2">Inserisci...</label></div></td>
		<td>Sito web di riferimento del partecipante.</td>		</tr>
		<tr>
		<td class="mdl-data-table__cell--non-numeric">Citt&agrave;:</td>        <td align="center"><div class="mdl-textfield mdl-js-textfield"><input class="mdl-textfield__input" type = "text" name = "icitta" /><label class="mdl-textfield__label" for="sample2">Inserisci...</label></div></td>
		<td>Citt&agrave; di residenza del partecipante.</td>		</tr>
		<tr>		<td colspan="3" class="mdl-data-table__cell--non-numeric">
		* Obbligatorio e Case Sensitive<br>		** Obbligatorio, Case Sensitive e non modificabile</td>
		</tr>
		<tr><td colspan="3"><br /><br />
		<p style="text-align:justify; color:#FF0000;">
		Compilando il presente modulo <b><u>si autorizza ad utilizzare</u></b> i dati personali allo scopo della presente procedura. <br>Trattandosi di un gioco, e considerata la natura di per sé non sicura del web, si consiglia di immettere dati di fantasia evitando di inserire info importanti. <br>I dati inseriti saranno comunque trattati secondo la normativa vigente in tema di privacy: non saranno comunicati a nessuno e non saranno utilizzati a scopo pubblicitario.</p><br /><br />
		<?php if ($regole_iscrizione) echo "<U><b>ALTRI AVVISI</b></U><br /> ".html_entity_decode($regole_iscrizione)."<br /><br />"; ?>
		</td></tr>		
		<tr>
		<td colspan="3">		<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored' value="Accetta ed iscrivi" type = "submit" name = "submit" alt = "Prosegui e inserisci" /></td>
		</tr>
		</tbody></table></form>
		<?php
	} elseif ($_POST['inserimento'] == "ok"){

		####################################################
		$iutente = strip_tags($_POST['iutente']);
		$icognome = strip_tags($_POST['icognome']);
		$iutente = strip_tags($_POST['iutente']);
		$ipass = strip_tags($_POST['ipass']);
		$ipass2 = strip_tags($_POST['ipass2']);
		$ipermessi = 0;
		$iemail = strip_tags($_POST['iemail']);
		$iemail2 = strip_tags($_POST['iemail2']);
		$iurl = strip_tags($_POST['iurl']);
		$icitta = strip_tags($_POST['icitta']);
		$isquadra = strip_tags($_POST['isquadra']);
		$itorneo = ($_POST['itorneo']);
		$iserie = 0;
		$icrediti = 0;
		$ivariazioni = 0;
		$icambi = 0;
		$ireg = $_POST['ireg'];

		if (!eregi("^[a-z0-9][_\.a-z0-9-]+@([a-z0-9][0-9a-z-]+\.)+([a-z]{2,4})",$_POST['iemail'])) $err[] = "&nbsp;&nbsp;&nbsp;- email non corretta;";
		
		if (!preg_match("/[a-z']$/i",$_POST['inome'])) $err[] = "&nbsp;&nbsp;&nbsp;- Nome non corretto; consentiti caratteri non numerici non accentati (usare l'apostrofo) e nessuno spazio;";
	
		if (!preg_match("/[a-z' ]$/i",$_POST['icognome'])) $err[] = "&nbsp;&nbsp;&nbsp;- Nome non corretto; consentiti caratteri non numerici non accentati (usare l'apostrofo);";
		
		if (!preg_match("/^[a-z0-9]{4,12}$/i",$_POST['iutente'])) $err[] = "&nbsp;&nbsp;&nbsp;- Username non corretto; consentiti da 4 a 12 caratteri normali, non accentati e nessuno spazio;";
		
		if (!eregi("^[a-zA-Z0-9]{4,12}",$_POST['ipass']))	$err[] = "&nbsp;&nbsp;&nbsp;- password non corretta; consentiti da 4 a 12 caratteri normali;";

		if ($ipass!==$ipass2) $err[]="&nbsp;&nbsp;&nbsp;- le password non coincidono;";

		if ($iemail!==$iemail2) $err[]="&nbsp;&nbsp;&nbsp;- gli indirizzi email non coincidono;";

		if ($iutente == $admin_user) $err[]="&nbsp;&nbsp;&nbsp;- nome utente gi&agrave; utilizzato;";

		// Verifica esistenza nome utente
		//-----------------------------------------
		if (!@is_file($percorso_cartella_dati."/utenti_".$_POST['itorneo'].".php")) {
			$ini_file = "<?php die('ACCESSO VIETATO');?> // password = 5f4dcc3b5aa765d61d8327deb882cf99  --> md5(password)";
			$fp = fopen($percorso_cartella_dati."/utenti_".$_POST['itorneo'].".php", "wb") OR die ("errore fileopen");
			flock ($fp,LOCK_EX) OR die ("errore filelocl ex");
			fwrite($fp, $ini_file) OR die ("errore fwrite");
			flock ($fp,LOCK_UN) OR die ("errore filelocl un");
			fclose($fp) OR die ("errore fileclose");
			unset ($fp,$ini_file);
		}
		$tornei = @file($percorso_cartella_dati."/tornei.php");
		$num_tornei = count($tornei);
		$layout = "<table><caption>Tornei in corso</caption>";

		for ($num1 = 1 ; $num1 < $num_tornei; $num1++) {
			@list($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza) = explode(",", $tornei[$num1]);

			$filep = @file($percorso_cartella_dati."/utenti_".$otid.".php") OR die("Ci sono problemi di permessi sul file utenti");
			$linee = count($filep);
			$trovato = 0;
			for ($num2 = 1 ; $num2 < $linee; $num2++) {
				list($outente, $opassword, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $filep[$num2]);
				if(strtolower($iutente) == strtolower($outente)) $trovato = $trovato +1;
				if(strtolower($iemail) == strtolower($oemail)) $trovato = $trovato +2;
				if(strtolower($isquadra) == strtolower($osquadra)) $trovato = $trovato +4;
				#echo "$otid $iutente $outente $num2 $trovato<br>";

				if($trovato > 0) break;
			}
		if($trovato==1) $err[]="&nbsp;&nbsp;&nbsp;- pseudonimo ($iutente) gi&agrave; utilizzato da un altro utente;";
		if($trovato==2) $err[]="&nbsp;&nbsp;&nbsp;- indirizzo email gi&agrave; utilizzato da un altro utente;";
		if($trovato==4) $err[]="&nbsp;&nbsp;&nbsp;- nome squadra o indirizzo email gi&agrave; utilizzato da un altro utente;";
		if($trovato==3) $err[]="&nbsp;&nbsp;&nbsp;- pseudonimo ed indirizzo email gi&agrave; utilizzati da un altro utente;";
		if($trovato==5) $err[]="&nbsp;&nbsp;&nbsp;- pseudonimo e nome squadra gi&agrave; utilizzati da un altro utente;";
		if($trovato==6) $err[]="&nbsp;&nbsp;&nbsp;- indirizzo email e nome squadra gi&agrave; utilizzati da un altro utente;";
		if($trovato==7) $err[]="&nbsp;&nbsp;&nbsp;- pseudonimo, indirizzo email e nome squadra gi&agrave; utilizzati da un altro utente;";
		}

	if(!empty($err)){
		$tr=implode("<br />",$err);
		?>
		<div class='contenuto'>
		<div id='articoli'>
		<table align="center">
		<caption>Iscrizione utente al campionato</caption>
		<tr><td align="center"><h1>Errori rilevati</h1></td></tr>
		<tr><td><br /><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nei dati immessi nel precedente modulo sono stati riscontrati i seguenti errori:<br /><?php echo $tr; ?><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Si prega di verificare i dati precedentemente immessi, verificando la presenza di eventuali caratteri non consentiti, di compilare i campi richiesti e di inserire le conferme di password e email.<br /></td></tr>
		<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="history.go(-1)">torna al modulo</a><br /><br /><br /><br /><br /><br /></td></tr></table></div></div>
		<?php
		unset($err,$tr);
	} else { 		// non ci sono errori
		//  Invio mail al nuovo iscritto
		// Crea la stringa da inserire

		$stringa = "\n".$iutente. "<del>". md5($ipass). "<del>". $ipermessi. "<del>". $iemail. "<del>". $iurl. "<del>". $isquadra. "<del>". $itorneo. "<del>". $iserie. "<del>". $icitta. "<del>". $icrediti. "<del>". $ivariazioni. "<del>". $icambi. "<del>". $ireg. "<del>0<del>0<del>".$inome."<del>".$icognome."<del>0<del>0<del>0<del>0<del>0<del>0<del>0<del>0";

		$oggetto = "Iscrizione Torneo Fantacalcio";

	  	$messaggio = "Benvenuto in $titolo_sito!<br />
		In questa email puoi trovare i dati necessari per accedere al sito:<br />
		<b>Pseudonimo:</b> $iutente<br />
		<b>Password:</b> $ipass<br />
		<b>Nome squadra:</b> $isquadra<br />
		<b>Email:</b> $iemail<br /><br />
		La tua iscrizione &egrave; attiva gi&agrave; da adesso. Puoi connetterti e acquistare i tuoi calciatori, schierare la formazione e modificare alcuni tuoi dati nella pagina relativa alla squadra. Segui con attenzione le fasi di gioco, sarai guidato dai messaggi del Presidente di Lega, e potrai utilizzare la funzione di messaggistica per ogni ed eventuale comunicazione.<br /><br />
		Cordiali saluti!<br />$admin_nome<br /><br /><a href=$url_sito>$url_sito</a><br /><br />
		PS: conserva o stampa questa mail per ogni futura eventuale esigenza.<hr>";

		$intestazioni  = "MIME-Version: 1.0\r\n";
		$intestazioni .= "Content-type: text/html; charset=iso-8859-1\r\n";
		#$intestazioni .= "X-Priority: 3\r\n";
		#$intestazioni .= "X-MSMail-Priority: Normal\r\n";
		#$intestazioni .= "X-Mailer: php\r\n";
		$intestazioni .= "From: $admin_nome <$email_mittente>\r\n" ;
		$intestazioni .= "Bcc: $admin_nome <$email_mittente>\r\n";

		$destinatario = "$iutente <$iemail>\r\n";

		if(!@mail($destinatario,$oggetto,$messaggio,$intestazioni))	$messiscr = "<h1>Iscrizione effettuata.</h1> <br /> <h2>Il messaggio non &egrave; stato spedito per un errore di servizio. <br />Contatta l'amministratore per informarlo di ci&ograve;!</h2>";
		else $messiscr = "<h1>Iscrizione effettuata.</h1> <br />E' stata inviata una mail con i dati che hai inserito, conservala per ogni evenienza!";

		$fp = fopen($percorso_cartella_dati."/utenti_".$_POST['itorneo'].".php", "ab");
		flock($fp,LOCK_SH);
		fwrite($fp, $stringa);
		flock($fp,LOCK_UN);
		fclose($fp);
		unset($fp, $stringa);

		echo"
		<div class='contenuto'>
		<div id='articoli'>
		<table align='center'>
		<caption>Iscrizione utente al campionato</caption>
		<tr><td align='center'>
		$messiscr
		<br /><br /><br /><br /><br />
		<br /><br /><br /><br /><br />
		<br /><br /><br /><br /><br />
		<br /><br /><br /><br /><br />
		</td></tr>
		</td></tr></table></div></div>";
		#echo $stringa;
		include("./footer.php");
		exit;
		}
	} # fine elseif ($inserimento == "ok")
	else echo "<center><h3>Utente $iutente non aggiunto</h3><br /><br /><br /><br /><br /></td></tr></table>";
}
else header("location: ./logout.php");

include("./footer.php");
?>