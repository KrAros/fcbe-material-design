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