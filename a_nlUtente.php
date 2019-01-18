<?php
	##################################################################################
	#    FANTACALCIOBAZAR EVOLUTION
	#    Copyright (C) 2003-2010 by Antonello Onida
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
	
	if ($usa_tinyMCE == "SI") echo '<div id="content">
	<script type="text/javascript" src="./inc/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript">
	tinyMCE.init({
	// General options
	mode : "textareas",
	theme : "advanced",
	language: "it",
	plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
	
	// Theme options
	theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
	theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
	theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,
	
	// Skin options
	skin : "o2k7",
	skin_variant : "silver",
	
	// Example content CSS (should be your site CSS)
	content_css : "css/example.css",
	
	// Drop lists for link/image/media/template dialogs
	template_external_list_url : "js/template_list.js",
	external_link_list_url : "js/link_list.js",
	external_image_list_url : "js/image_list.js",
	media_external_list_url : "js/media_list.js",
	
	// Replace values for the template plugin
	template_replace_values : {
	username : "Some User",
	staffid : "991234"
	}
	});
	</script>';
	else echo "<center><div id='content'>";
	
	if($attiva_multi == "SI") {
		$vedi_tornei_attivi = "<select name='l_torneo'>";
		$vedi_tornei_attivi .= "<option value='0'>Tutti</option>";
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
	else $vedi_tornei_attivi = "<input type='hidden' name='l_torneo' value='1' />";
	
	echo '<div class="container" style="width: 85%;margin-top: -10px;">
	<div class="card-panel">
	<div class="row">';
	
	if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] >= 3) {
		
		#########################################
		if ($_SESSION['permessi'] == 3 or $_SESSION['permessi'] == 4 ) {
			
			require ("widget.php");
			echo "<div class='col m9'>
			<div class='bread'><a href='./mercato.php'>Gestione</a> / Invia newsletter</div>
			<div class='card'>
			<div class='card-content'>
			<span class='card-title'>Invia newsletter<span style='font-size: 13px;'> - Contatta tramite mail gli iscritti</span></span>
			<hr>";
			
			if($_POST["invia"]) {
				
				$destinatari = array();
				$fileu = @file("./dati/utenti_".$_SESSION['torneo']);
				$linee = count($fileu);
				$destinatari = array();
				for($lineu = 1; $lineu <= $linee; $lineu++) {
					@list($outente, $opassword, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$lineu]);
					if ($oemail) $destinatari[] = $oemail;
					echo "$oemail ";
				}
				$destinatari1 = implode(", ",$destinatari);
				
				$oggetto = strip_tags($_POST['oggetto']);
				$oggetto = stripslashes($oggetto);
				$oggetto = html_entity_decode($oggetto, ENT_QUOTES).$acapo;
				
				$messaggio = stripslashes($_POST['messaggio']);
				$messaggio = html_entity_decode($messaggio, ENT_QUOTES);
				$messaggio = $messaggio."<hr />$titolo_sito<br />http://".$_SERVER['SERVER_NAME'].$acapo;
				
				$intestazioni  = "MIME-Version: 1.0".$acapo;
				$intestazioni .= "Content-type: text/html; charset=iso-8859-1".$acapo;
				$intestazioni .= "From: $admin_nome <$email_mittente>".$acapo;
				$intestazioni .= "Bcc: $destinatari1".$acapo;
				
				if(!mail($email_mittente,"$oggetto","$messaggio",$intestazioni)){
					echo "Il messaggio non &egrave; stato spedito.<hr />$destinatari<hr />$oggetto<hr />$messaggio<hr />$intestazioni";
					include("./footer.php");
					exit;
				}
				
				echo "<center><h3>Newsletter inviata con successo</h3></center>";
				echo "<meta http-equiv='refresh' content='0; url=a_gestione.php?messgestutente=70'>";
				include("./footer.php");
				exit;
			}
			elseif($_POST['anteprima']) {
				if (!$_POST['oggetto']) echo "<h4>Inserire oggetto messaggio</h4>";
				elseif (!$_POST['messaggio']) echo "<h4>Inserire testo messaggio</h4>";
				else  {
					echo "<form method='post' action='a_nlUtente.php'>
					<input name='invia' type='hidden' value='1' />
					<input name='oggetto' type='hidden' value='".htmlentities(stripslashes($_POST['oggetto']), ENT_QUOTES)."' />
					<input name='messaggio' type='hidden' value='".htmlentities(stripslashes($_POST['messaggio']), ENT_QUOTES)."' />
					<table summary='Newsletter' bgcolor='$sfondo_tab' width = '100%'>
					<caption>Anteprima invio messaggio a tutti gli utenti</caption>
					<tr align='left'><td>Oggetto: </td><td>".stripslashes($_POST['oggetto'])."</td></tr>
					<tr align='left'><td>Messaggio: </td><td>".stripslashes($_POST['messaggio'])."</td></tr>
					<tr align='left'><td>Invia: </td><td><input type='Image' src='immagini/next.gif' name='invia' alt='Invia Newsletter' align='top' /></td></tr>
					</table></form>";
				}
			}
			else {
				echo"<form method='post' action='a_nlUtente.php'>
				<input type='hidden' name='anteprima' value='1' />
				<table summary='Newsletter' bgcolor='$sfondo_tab' cellpadding='20' width='100%'>
				<caption>Invio Newsletter</caption>
				<tr align='left'><td>Oggetto: </td><td><input name='oggetto' type='text' size='60' maxlength='60' /></td></tr>
				<tr align='left'><td>Messaggio: </td><td><textarea name='messaggio' cols='80' rows='20'></textarea></td></tr>
				<tr align='left'><td>Anteprima: </td><td><input type = 'Image' src = 'immagini/next.gif' name = 'invia' alt = 'Anteprima Newsletter' align = 'top' /></td></tr>
				</table></form>";
			}
		}
		
		#########################################
		if ($_SESSION['permessi'] == 5) {
			
			require ("./a_widget.php");
			echo "<div class='col m9'>
			<div class='bread'><a href='./a_gestione.php'>Gestione</a> / Invia newsletter</div>
			<div class='card'>
			<div class='card-content'>
			<span class='card-title'>Invia newsletter<span style='font-size: 13px;'> - Contatta tramite mail gli iscritti</span></span>
			<hr>
			<div class='row'>";
			
			############### INVIO
			if($_POST['invia']) {
				
				if($_POST['l_torneo'] != "") $storneo = $_POST['l_torneo'];
				else $storneo = 0;
				
				$destinatari = array();
				
				if($storneo != 0){
					$fileu = @file("./dati/utenti_".$storneo.".php");
					$linee = count($fileu);
					$destinatari = array();
					for($lineu = 1; $lineu <= $linee; $lineu++) {
						@list($outente, $opassword, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$lineu]);
						if ($oemail) $destinatari[] = $oemail;
						echo "$oemail ";
					}
					$destinatari1 = implode(", ",$destinatari);
					} else {
					$tornei = @file($percorso_cartella_dati."/tornei.php");
					$num_tornei = count($tornei);
					
					for ($num = 1 ; $num < $num_tornei; $num++) {
						unset($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza);
						
						@list($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza) = explode(",", $tornei[$num]);
						
						if (is_file($percorso_cartella_dati."/utenti_".$otid.".php")) {
							$filei = file($percorso_cartella_dati."/utenti_".$otid.".php");
							$totalLines = count($filei);
							
							for($line = 1; $line < $totalLines; $line++) {
								@list($outente, $opassword, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $filei[$line]);
								
								if (isset($oemail)) $destinatari[] = $oemail;
							}
						}
					}
					$destinatari1 = implode(", ",$destinatari);
				}
				
				$oggetto = strip_tags($_POST['oggetto']);
				$oggetto = stripslashes($oggetto);
				$oggetto = html_entity_decode($oggetto, ENT_QUOTES).$acapo;
				
				$messaggio = stripslashes($_POST['messaggio']);
				$messaggio = html_entity_decode($messaggio, ENT_QUOTES);
				$messaggio = $messaggio."<hr />$titolo_sito<br />http://".$_SERVER['SERVER_NAME'].$acapo;
				
				$intestazioni  = "MIME-Version: 1.0".$acapo;
				$intestazioni .= "Content-type: text/html; charset=iso-8859-1".$acapo;
				$intestazioni .= "From: $admin_nome <$email_mittente>".$acapo;
				$intestazioni .= "Bcc: $destinatari1".$acapo;
				
				if(!mail($email_mittente,"$oggetto","$messaggio",$intestazioni)){
					echo "Il messaggio non &egrave; stato spedito.<hr />$destinatari<hr />$oggetto<hr />$messaggio<hr />$intestazioni";
					include("./footer.php");
					exit;
				}
				
				echo "<center><h3>Newsletter inviata con successo</h3></center>";
				echo "<meta http-equiv='refresh' content='0; url=a_gestione.php?messgestutente=70'>";
				include("./footer.php");
				exit;
			}
			############### ANTEPRIMA
			else if($_POST['anteprima']) {
				
				if($_POST['l_torneo'] != "") $storneo = $_POST['l_torneo'];
				else $storneo = 0;
				
				if (!$_POST['oggetto']) {
					echo "<form method='post' action='a_nlUtente.php'>
					<table summary='Newsletter' bgcolor='$sfondo_tab' width = '100%'>
					<caption>Invio messaggio a tutti gli utenti</caption>
					<tr align='left'><td>Torneo: </td><td>".$_POST['l_torneo']."</td></tr>
					<tr align='left'><td>Oggetto: </td>
					<td><input name='oggetto' type='text' size='60' maxlength='60' />
					<--- Inserire oggetto messaggio qui</td></tr>
					<tr align='left'><td>Messaggio: </td><td><textarea name='messaggio' cols='80' rows='20'>".stripslashes($_POST['messaggio'])."</textarea></td></tr>
					<tr align='left'><td>Anteprima: </td><td><input type = 'Image' src = 'immagini/next.gif' name = 'invia' alt = 'Anteprima Newsletter' align = 'top' /></td></tr>
					</table>
					<input name='l_torneo' type='hidden' value='".$_POST['l_torneo']."' />
					<input name='messaggio' type='hidden' value='".stripslashes($_POST['messaggio'])."' />
					</form>";
				}
				elseif (!$_POST['messaggio']) {
					echo "<form method='post' action='a_nlUtente.php'>
					<input name='l_torneo' type='hidden' value='".$_POST['l_torneo']."' />
					<input name='oggetto' type='hidden' value='".stripslashes($_POST['oggetto'])."' />
					<table summary='Newsletter' bgcolor='$sfondo_tab' width = '100%'>
					<caption>Invio messaggio a tutti gli utenti</caption>
					<tr align='left'><td>Torneo: </td><td>".$_POST['l_torneo']."</td></tr>
					<tr align='left'><td>Oggetto: </td><td>".stripslashes($_POST['oggetto'])."</td></tr>
					<tr align='left'><td>Messaggio: </td><td><textarea name='messaggio' cols='80' rows='20'>Inserire oggetto messaggio qui</textarea></td></tr>
					<tr align='left'><td>Anteprima: </td><td><input type = 'Image' src = 'immagini/next.gif' name = 'invia' alt = 'Anteprima Newsletter' align = 'top' /></td></tr>
					</table></form>";
				}
				else {
					echo "<form method='post' action='a_nlUtente.php'>
					<input name='invia' type='hidden' value='1' />
					<input name='l_torneo' type='hidden' value='".$_POST['l_torneo']."' />
					<input name='oggetto' type='hidden' value='".htmlentities(stripslashes($_POST['oggetto']), ENT_QUOTES)."' />
					<input name='messaggio' type='hidden' value='".htmlentities(stripslashes($_POST['messaggio']), ENT_QUOTES)."' />
					<table summary='Newsletter' bgcolor='$sfondo_tab' width = '100%'>
					<caption>Anteprima invio messaggio a tutti gli utenti</caption>
					<tr align='left'><td>Oggetto: </td><td>".stripslashes($_POST['oggetto'])."</td></tr>
					<tr align='left'><td>Messaggio: </td><td>".stripslashes($_POST['messaggio'])."</td></tr>
					<tr align='left'><td>ID torneo: </td><td>".$_POST['l_torneo']."</td></tr>
					<tr align='left'><td>Invia: </td><td><input type='Image' src='immagini/next.gif' name='invia' alt='Invia Newsletter' align='top' /></td></tr>
					</table></form>";
				}
			}
			############### INSERIMENTO
			else {
				echo "<form method='post' action='a_nlUtente.php'>
				<input type='hidden' name='anteprima' value='1' />
				<table class='highlight'>";
				
				if($attiva_multi == "SI") echo "<tr align='left'><td>Torneo: </td><td>$vedi_tornei_attivi</td></tr>";
				
				echo "<tr align='left'><td>Oggetto: </td><td><input name='oggetto' type='text' size='60' maxlength='60' /></td></tr>
				<tr align='left'><td>Messaggio: </td><td><textarea name='messaggio' cols='80' rows='20'></textarea></td></tr>
				</table>
				</div>
				</div>
				<div class='card-action center'>
				<button type='submit' class='btn waves-effect waves-light green' name = 'invia'>Anteprima</button>
				</div>
				</form>";
			}
		}
		
		echo "</div></div></div></div></div></div></div>";
	} # fine if ($_SESSION["valido"] == "SI" $_SESSION["utente"] =="admin")
	
	if ($usa_tinyMCE == "SI") echo '</div>';
	
	else header("location: index.php?fallito=1");
	include("./footer.php");
?>			