<?php
##################################################################################
#    Implementazione Utility Recovery User Password 
#    Copyright (C) 2011 by KaYMaN - Contact: mattiaciro@tiscali.it	
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
session_start();
require_once("./dati/dati_gen.php");
require_once ("./inc/rec/sendmail_include.php");
require_once("./inc/funzioni.php");
include("./header.php");
$nuovapass = "Ciao [USER_NAME],\n
La tua nuova password per accedere al tuo account ".$titolo_sito." &egrave;:\n
[NEW_PASS]\n
Saluti,
".$titolo_sito."\n";
$testorec = "Ciao [USER_NAME],\n
E' stata richiesta una nuova password per accedere al tuo account ".$titolo_sito.".\n
Per confermare il cambio password clicca sul seguente link:\n
[NEW_PASS_LINK]\n
Saluti,
".$titolo_sito."\n";

function stripinput($text) {
	if (QUOTES_GPC) $text = stripslashes($text);
	$search = array("&", "\"", "'", "\\", '\"', "\'", "<", ">", "&nbsp;");
	$replace = array("&amp;", "&quot;", "&#39;", "&#92;", "&quot;", "&#39;", "&lt;", "&gt;", " ");
	$text = str_replace($search, $replace, $text);
	return $text;
}

$tornei = @file("$percorso_cartella_dati/tornei.php");
			$num_tornei = count($tornei);
echo "<div class='contenuto'>
<div id='articoli'>
<div id='sinistra'>
<table align=center summary = 'Modulo iscrizione'><caption>Recupero Password</caption>";
if (isset($_GET['email']) && isset($_GET['account'])) {
	$error = 0;
	$emailc = $_GET['email'];
	$accoc = $_GET['account'];
	
	for ($num1 = 1 ; $num1 < $num_tornei; $num1++) {
				@list($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza) = explode(",", $tornei[$num1]);
				
				if (is_file($percorso_cartella_dati."/utenti_".$otid.".php")) {
					$file = @file("./dati/utenti_".$otid.".php")or die("Impossibile caricare i dattagli degli utenti [RIF: ./dati/utenti $otid]");
					$linee = count($file);
					$linea = 1;
					$error = 0;

					do {
						@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg, $otitolari, $opanchina, $otemp1, $otemp2, $otemp3, $otemp4, $otemp5, $otemp6, $otemp7, $otemp8, $otemp9, $otemp0) = explode("<del>", $file[$linea]);
						
						 
						if(($emailc == $oemail) && ($accoc == $opass)) $error=0;
						else $error = 1;
						if($error==0) break;
						$linea++;
					} while ($linea < $linee);
					if($error==0) break;
				}
				else {
					$error = 1;
				}
			}
	
	$email = stripinput(trim(preg_replace("/ +/i", "", $_GET['email'])));
	if (!preg_match("/^[-0-9A-Z_\.]{1,50}@([-0-9A-Z_\.]+\.){1,50}([0-9A-Z]){2,4}$/i", $email)) { $error = 1; }
	if (!preg_match("/^[0-9a-z]{32}$/", $_GET['account'])) { $error = 1; }
	if ($error == 0) {
		
			$chars = "abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789@";
			$char_count = strlen($chars) - 1;
			$new_pass = "";
			for ($i = 0; $i < 8; $i++) {
				$new_pass .= substr($chars, mt_rand(0, $char_count), 1);
			}
			$mailbody = str_replace("[NEW_PASS]", $new_pass, $nuovapass);
			$mailbody = str_replace("[USER_NAME]", $outente, $mailbody);
			sendemail($outente, $email,$admin_nome, $email_mittente, $titolo_sito." Recupero Password", $mailbody);
			
			
			// nn ci sono errori
			$newpass = md5(strip_tags($new_pass));
			$stringa = "$outente<del>$newpass<del>$opermessi<del>$oemail<del>$ourl<del>$osquadra<del>$otorneo<del>$oserie<del>$ocitta<del>$ocrediti<del>$ovariazioni<del>$ocambi<del>$oreg<del>$otitolari<del>$opanchina<del>$otemp1<del>$otemp2<del>$otemp3<del>$otemp4<del>$otemp5<del>$otemp6<del>$otemp7<del>$otemp8<del>$otemp9<del>$otemp0";
				$percorso_file = $percorso_cartella_dati."/utenti_".$otorneo.".php";
				//echo $percorso_file;
				$ofile = @file($percorso_file);
						$ofile[$linea] = $stringa;
						
						$nuovo_file = implode("",$ofile);

						$fp = fopen($percorso_file, "wb+");
						flock($fp, LOCK_EX);
						fwrite($fp, $nuovo_file);
						flock($fp, LOCK_UN);
						fclose($fp);
			echo "<tr><td align=center width ='25%'>Password Inviata</td></tr><tr><td align=center><a href='index.php'>Torna alla home</a>\n</div></td></tr>\n";
			echo "</tr>
</table>
</form>";
echo "</div></div><div id='destra'>";
include("./menu_i.php");
echo "</div></div>";
die();
			
		} else {
			$error = 1;
		}
	}

	if ($error == 1) { 
//UN Pò Brutto come CODICE - Ma Siccome nel Header.php di richiamo si usa un echo riporta l'errore
echo "<meta http-equiv='refresh' content='0;URL=index.php'>";

}
elseif(isset($_POST['send_password'])) {
	if(($_SESSION['CONTROLLO'] == $_POST['security_code']) && (!empty($_SESSION['CONTROLLO'])) ) {
	unset($_SESSION['CONTROLLO']);
	$email = stripinput(trim(preg_replace("/ +/i", "", $_POST['email'])));
		if (preg_match("/^[-0-9A-Z_\.]{1,50}@([-0-9A-Z_\.]+\.){1,50}([0-9A-Z]){2,4}$/i", $email)) {
			
			
		for ($num1 = 1 ; $num1 < $num_tornei; $num1++) {
				@list($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza) = explode(",", $tornei[$num1]);

				if (is_file($percorso_cartella_dati."/utenti_".$otid.".php")) {
					$file = @file("./dati/utenti_".$otid.".php")or die("Impossibile caricare i dattagli degli utenti [RIF: ./dati/utenti $otid]");
					$linee = count($file);
					$linea = 1;
					$trovato = 0;

					do {
						@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg, $otitolari, $opanchina, $otemp1, $otemp2, $otemp3, $otemp4, $otemp5, $otemp6, $otemp7, $otemp8, $otemp9, $otemp0, $recpass) = explode("<del>", $file[$linea]);
						
						if($email == $oemail) $trovato = 1;
						else $trovato = 0;
						if($trovato==1) break;
						$linea++;
					} while ($linea < $linee);
					if($trovato==1) break;
				}
				else {
					$trovato = 0;
				}
			}		
		
		if ($trovato == 1 and $opermessi >=0) {
			$new_pass_link = "http://".$_SERVER['HTTP_HOST']."/recuperopass.php?email=".$email."&account=".$opass;
			$mailbody = str_replace("[NEW_PASS_LINK]", $new_pass_link, $testorec);
			$mailbody = str_replace("[USER_NAME]", $outente, $mailbody);
			sendemail($outente, $email,$admin_nome, $email_mittente, $titolo_sito." Recupero Password", $mailbody);
			echo "<tr><td width ='25%'><div style='text-align:center'><br />\n Una Email di conferma &egrave; stata inviata al tuo indirizzo <br /><br />\n<a href='index.php'>Torna alla Home</a><br /><br />\n</div></td><tr>\n";
			
		} else {
			echo "<tr><td width ='25%'><div style='text-align:center'><br />\n L'indirizzo che hai specificato non &egrave; stato trovato<br /><br />\n<a href='recuperopass.php'>Riprova</a><br /><br />\n</div></td></tr>\n";
			
		}
	} else {
		echo "<tr><td width ='25%'><div style='text-align:center'><br />\nL'indirizzo Email che hai specificato non &egrave; valido<br /><br />\n<a href='#'>Riprova</a><br /><br /></div></td></tr>\n";
	}
	} 
	else {echo "<tr><td width ='25%'><div align='center'><font text='red'>Codice Immagine Errato </font><br /><br />\n<a href='recuperopass.php'>Riprova</a></div></td></tr>";} 
   } 

else {
	echo "<div style='text-align:center'>\n<form name='passwordform' method='post' action='#'></td>\n";
	echo "<tr><td align=center width ='100%'>Inserire la propria Mail di Registrazione<td><tr>\n";
	echo "<tr><td align=center width = '100%'><input type='text' name='email'  /></td></tr><tr>\n";
	?>
		<tr><td align=center width ='100%'>Codice di Controllo</td></tr>
		<tr><td align=center width ='100%'><img src="captcha.php"></td></tr>
		<tr><td align=center width ='100%'><input id="security_code" name="security_code" type="text" /></td></tr>	
		<? echo "<tr><td align=center width = '100%'><input type='submit' name='send_password' value='Invia Password'  /></td></tr>\n";
	echo "</form>\n</div>\n";
	
}
echo "</tr>
</table>
</form>";
echo "</div></div><div id='destra'>";
include("./menu_i.php");
echo "</div></div>";

?>