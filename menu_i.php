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
require_once("./dati/dati_gen.php");
require_once("./inc/funzioni.php");

if (trim($messaggi[5]) != "") echo "<div class='slogan'>".html_entity_decode($messaggi[5])."</div>";
elseif ($mostra_calendario == "SI") {
	echo " <div class='slogan'><center>";
	crea_calendario();
	echo "</center></div>";
}

echo "<div align='center'>Ritieni utile il progetto?<br />Sostieni il progetto FCBE<br />
<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
<input type='hidden' name='cmd' value='_s-xclick' />
<input type='image' src='https://www.paypal.com/it_IT/i/btn/x-click-but04.gif' name='submit' alt='Effettua i tuoi pagamenti con PayPal.  un sistema rapido, gratuito e sicuro.' />
<input type='hidden' name='encrypted' value='-----BEGIN PKCS7-----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-----END PKCS7-----' />
</form>
<div style='clear:both;'>&nbsp;</div></div>";

echo "<div id='menu_d'>";

if ($iscrizione_online == "SI") echo "<a href='./iscrizione.php'>Iscrizione on-line</a>";
if ($usa_cms == "SI") link_pagine_box();
#echo "<a href='./regolamento.php'>Regolamento</a>";
if (is_file("$percorso_cartella_dati/tornei.php")) echo "<a href='./vedi_tornei.php'>Tornei in corso</a>";
if ($usa_cms == "SI") link_categorie();
if ($usa_cms == "SI") echo "<form method='post' class='ricerca' action='index.php'>
<div id='searchform'>
<p><input name='testo' class='text' id='testo' type='text' value='' />
<input name='ricerca' class='button' value='Ricerca' type='submit' /></p>
</div>
</form>";

echo "<div id='loginbox'><p align='center'><b><u>Accesso procedura</u></b></p>";

if(@$_GET["fallito"] == 1) echo "<br/><div class='evidenziato'>> Pseudonimo o password errati o mancanti!</div>";
elseif(@$_GET["fallito"] == 2) echo "<br/><div class='evidenziato'>> Password amministratore errata.<br/>E' stata inviata una mail di notifica.</div>";
elseif(@$_GET["fallito"] == 3) echo "<br><div class=\"evidenziato\">> Scegli il torneo dal men&ugrave; a tendina</div>";
elseif(@$_GET["nofile"]) echo "<br/><div class='evidenziato'>> File utenti non trovato!</div>";
elseif(@$_GET["logout"] == 1) echo "<br/><div class='evidenziato'>> Disconnesso!</div>";
elseif(@$_GET["logout"] == 2) echo "<br/><div class='evidenziato'>> Accesso riservato!</div>";
elseif(@$_GET["logout"] == 3) echo "<br/><div class='evidenziato'>> Rieseguire accesso!</div>";
elseif(@$_GET["nuovo"]) echo "<br/><div class='evidenziato'>> Connesso!</div>";
elseif(@$_GET["iscritto"]) echo "<br/><div class='evidenziato'>> Utente iscritto! Email inviata!</div>";
elseif(@$_GET["attesa"]) echo "<br/><div class='evidenziato'>> Utente in attesa di autorizzazione!</div>";

if(isset($_SESSION["valido"]) AND $_SESSION['valido'] == "SI"){
	echo"<br/>Ciao: <b>".$_SESSION['utente']."</b><br/>";
	include("./inc/online.php");
}
else {
		$tornei = @file("$percorso_cartella_dati/tornei.php");
		$num_tornei = 0;
		$conta_tornei = count($tornei);
	if($attiva_multi == "SI" and $conta_tornei > 2) {
		$vedi_tornei_attivi = "<select name='l_torneo'>";
		$vedi_tornei_attivi .= "<option value=''>Scegli il tuo torneo</option>";
		#$tornei = @file("$percorso_cartella_dati/tornei.php");
		#$num_tornei = 0;
		#$conta_tornei = count($tornei);
		for($num1 = 0; $num1 < $conta_tornei; $num1++){
			$num_tornei++;
		}

		for ($num1 = 1 ; $num1 < $num_tornei; $num1++) {
			@list($otid, $otdenom) = explode(",", trim($tornei[$num1]));
			$vedi_tornei_attivi .= "<option value='$otid'>$otdenom</option>";
		} # fine for $num1

		$vedi_tornei_attivi .= "</select>";
	}
	else $vedi_tornei_attivi = "<input type='hidden' name='l_torneo' value='1' />";

	echo "<br/><form method='post' action='./login.php'>
	username: <input type='text' name='l_utente' class='text' /><br/>
	password:   <input type='password' name='l_pass' class='text' /><br/>
	$vedi_tornei_attivi<br>
	Ricordami <input type=\"checkbox\" name=\"l_ricordami\" value=\"SI\">	<br/><br/>
	
	<input type='image' name='login' value='Login' src='immagini/entra.gif'>
	</form>";
	echo "<br/><div class='articolo_d'><a href='./recuperopass.php'>recupera password</a></div>";
	#echo "<br/><div class='articolo_d'><a href='./recuperopass.php'>recupera password</a></div>";
	
} # fine ----------<input name='login' class='button' value='Login' type='submit' />
echo "</div>";
unset ($vedi_tornei_attivi,$tornei);
?>

</div>
<div class="articolo_d">
	<?php
	if ($usa_cms == "SI") link_pagine_link();
	?>
	<p align="center">
		<?php
		if ($mostra_immagini_in_login == "SI") immagine_casuale("top",0,0);
		?>
	</p>

</div>
<?php
if ($usa_cms == "SI" AND $vedi_notizie == "2") echo "<div class='articolo_d'>".ultime_notizie('')."</div>";

if ($mostra_voti_in_login == "SI") {

	

	$mostra_voti_vedi = "<div class='articolo_d'><center><form method='post' name='vedi_voti' action='voti.php'>
	<input type = 'hidden' name = 'escludi_controllo' value = 'SI' />
	<input type='submit' name='guarda_voti' value='Voti della giornata' /> n. \r\n
	<select name='giornata' onChange='submit()'>";

	for ($num1 = 1 ; $num1 < 40 ; $num1++) {
		if (strlen($num1) == 1) $num1 = "0".$num1;

		$percorso = "$prima_parte_pos_file_voti$num1$seconda_parte_pos_file_voti";
		if (is_file("$percorso")) {
			$mostra_voti_vedi .= "<option value='$num1' selected>$num1</option>";
		} # fine if
		else break;
	} # fine for $num1
	$mostra_voti_vedi .= "</select><br/><br/>
	<input type='radio' name='ruolo_guarda' value='tutti' checked /> Tutti |
	<input type='radio' name='ruolo_guarda' value='P' /> P |
	<input type='radio' name='ruolo_guarda' value='D' /> D |
	<input type='radio' name='ruolo_guarda' value='C' /> C |";

	if ($considera_fantasisti_come == "F") $mostra_voti_vedi .= "<input type='radio' name='ruolo_guarda' value='F' /> F |";
	$mostra_voti_vedi .= "<input type='radio' name='ruolo_guarda' value='A' /> A
	</form></center></div>";
	echo $mostra_voti_vedi;
} # fine if

if ($mostra_giornate_in_login == "SI") {

	$vedi_tornei_attivi = "<select name='itorneo'>";
	$tornei = @file("$percorso_cartella_dati/tornei.php");
	$num_tornei = 0;
	for($num1 = 0; $num1 < count($tornei); $num1++){
		$num_tornei++;
	}

	for ($num1 = 1 ; $num1 < $num_tornei; $num1++) {
		@list($tid, $tdenom, $tpart, $tserie) = explode(",", trim($tornei[$num1]));
		$tdenom = ereg_replace("\"","",$tdenom);

		if ($torneo_completo != "SI") $vedi_tornei_attivi .= "<option value='$tid'>$tdenom</option>";

	} # fine for $num1

	$vedi_tornei_attivi .= "</select>";

	$giormerc = "<form method='post' action='guarda_giornata.php'>
	<input type='hidden' name='escludi_controllo' value='SI' />
	<input type='submit' name='guarda_giornata' value='Vedi' /> giornata n. <select name='giornata' onChange='submit()'>";

	for ($num1 = 1; $num1 < 40 ; $num1++) {
		if (strlen($num1) == 1) $num1 = "0".$num1;
		$controlla_giornata = "giornata$num1";
		if (@is_file("$percorso_cartella_dati/$controlla_giornata")) $giormerc .= "<option value='$num1' selected>$num1</option>";
		else break;
	} # fine for $num1

	$giormerc .= "</select><br/>".$vedi_tornei_attivi."</form><br/>";
	if ($num1 > 1) echo "<div class='articolo_d'>
	<div>".$giormerc."</div>
	<div>".$mostra_voti_vedi."</div>
	</div>";
}

echo "<div class='articolo_d'>
<p><img src='./immagini/more.gif' alt='' /> <a href='temporeale.php'>Risultati tempo reale</a></p>
<p><img src='./immagini/more.gif' alt='' /> <a href='televideo.php'>Televideo RAI</a></p>
</div>";

if ($attiva_shoutbox == "SI"){
	$db_sb     = "./dati/db09.txt";
	if( isset($_POST['azione']) AND isset($_POST['security_code']) AND $_POST['security_code'] == $_SESSION['security_code'] AND $_POST['azione'] == "aggiungi" AND $_POST['messaggio'] != "Messaggio") {
		if( $_POST['email'] == "Email" ) $_POST['email'] = "";
		$nuova_linea = "\r\n" . $_POST['nome']."|".$_POST['email']."|".date("Y/m/d H:i")."|".stripslashes(htmlspecialchars($_POST['messaggio']));
		$fp = fopen($db_sb,"a");
		if(flock($fp, LOCK_EX )){
			fwrite( $fp,$nuova_linea );
			flock( $fp, LOCK_UN );
			fclose($fp);
			} else {
				echo "Impossibile utilizzare il file " . $db_sb . "!";
			}
			unset($_SESSION['security_code'], $_POST['azione']);
		}
		unset($fp,$nuova_linea);
		mostra_shoutbox();
	}

	if ($attiva_rss == "SI") {
		echo "<div class='articolo_d'><center><b><u>News Calcio</u></b></center><br/>\n";

		if (!trim($url_rss)) $url_rss="http://www.gazzetta.it/rss/Calcio.xml"; //rss url

		include_once "./inc/rss_fetch.php";
		$html  = "- <a href='#{link}' target='_blank'>#{title}</a><br />\n";
		#$html .= "      #{description}<br /><font size='-1'>#{pubDate}</font><br />\n";
		$rss = new rss_parser($url_rss, 10, $html, 1);
		echo "</div>\n";
	}
	?>
</div>
