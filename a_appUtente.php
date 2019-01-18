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
	require("./header.php");
	if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] >= 3) {
		if ($_SESSION['permessi'] == 3 OR $_SESSION['permessi'] == 4) require ("./menu.php");
		#elseif ($_SESSION['permessi'] == 5) require ("./a_menu.php");
		if($_GET['cambia']) {
			if($go) {
				$id = strip_tags($_GET['cambia']);
				if($id == 0){
					echo "<center><h3>Impossibile modificare questo utente</h3></td></tr></table>";
					echo"<meta http-equiv='refresh' content='1; url=a_appUtente.php?messgestutente=26'>";
					include("./footer.php");
					exit;
				}
				else {
					if ($_SESSION['permessi'] == 3 OR $_SESSION['permessi'] == 4) $percorso_file = $percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php";
					elseif ($_SESSION['permessi'] == 5) $percorso_file = $percorso_cartella_dati."/utenti_".$itorneo.".php";
					$fileo = file($percorso_file);
					list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg, $otitolari, $opanchina, $onome, $ocognome) = explode("<del>", trim($fileo[$id]));
					$linee = count($fileo);
					$Npermessi = "0";				
					$stringa = "$outente<del>$opass<del>$Npermessi<del>$oemail<del>$ourl<del>$osquadra<del>$otorneo<del>$oserie<del>$ocitta<del>$ocrediti<del>$ovariazioni<del>$ocambi<del>$oreg<del>0<del>0<del>$onome<del>$ocognome<del>0<del>0<del>0<del>0<del>0<del>0<del>0<del>0\n";
					$fileo[$id] = $stringa;
					$nuovo_file = implode("",$fileo);
					
					$fp = fopen($percorso_cartella_dati."/utenti_".$itorneo.".php", "wb+");
					flock($fp, LOCK_EX);
					fwrite($fp, $nuovo_file);
					flock($fp, LOCK_UN);
					fclose($fp);
					$oggetto = "Iscrizione Torneo Fantacalcio\n";				
					$messaggio = "Benvenuto in $titolo_sito!
					La tua iscrizione dal torneo &egrave; stata accettata. <br /><br />Nella mail precedente ti sono stati inviati i dati di accesso.<br /><br />
					Leggi attentamente il regolamento di gioco e ogni messaggio che sar&agrave; pubblicato sul sito.<br /><br />
					Puoi connetterti e acquistare i tuoi calciatori, schierare la formazione e modificare alcuni tuoi dati nella pagina relativa alla squadra. <br /><br />
					Segui con attenzione le fasi di gioco, sarai guidato dai messaggi del Presidente di Lega, e potrai utilizzare la funzione di messaggistica per ogni ed eventuale comunicazione.<br /><br /
					Cordiali saluti!<br />$admin_nome<br /><br /><a href=$url_sito>$url_sito</a><br /><br />\n";
					$intestazioni  = "MIME-Version: 1.0\n";
					$intestazioni .= "Content-type: text/html; charset=iso-8859-1\n";
					#$intestazioni .= "X-Priority: 3\n";
					#$intestazioni .= "X-MSMail-Priority: Normal\n";
					#$intestazioni .= "X-Mailer: php\n";
					$intestazioni .= "From: $admin_nome <$email_mittente>\n" ;
					$intestazioni .= "Bcc: $admin_nome <$email_mittente>\n";
					$destinatario = "$outente <$oemail>\n";
					
					if(!@mail($destinatario,$oggetto,$messaggio,$intestazioni))
					{
						echo "Il messaggio non &egrave; stato spedito.";
						exit;
					}
					echo "<center><h3>Utente <u>$outente</u> approvato</h3></td></tr></table>";
					echo"<meta http-equiv='refresh' content='0; url=a_appUtente.php?messgestutente=25'>";
					include("./footer.php");
					exit;
				}
			}
			else {
				$id = $cambia;
				if ($_SESSION['permessi'] == 4) $percorso_file = $percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php";
				elseif ($_SESSION['permessi'] == 5) $percorso_file = $percorso_cartella_dati."/utenti_".$itorneo.".php";
				
				$filei = file($percorso_file);
				@list($iutente, $ipass, $ipermessi, $iemail, $iurl, $isquadra, $itorneo, $iserie, $icitta, $icrediti, $ivariazioni, $icambi, $ireg) = explode("<del>", trim($filei[$id]));
				
				echo '<div class="container" style="width: 85%;margin-top: -10px;">
				<div class="card-panel">
				<div class="row">';
				
				require ("./a_widget.php");
				echo'<div class="col m9">';
				echo"<div class='bread'><a href='./a_gestione.php'>Gestione</a> / Configurazione sito</div><br>
				<div class='card'>
				<div class='card-content'>
				<span class='card-title'>Approvazione utenti<span style='font-size: 13px;'> - Abilita i profili in attesa</span></span>
				<hr>
				<div class='row'>
				
				<h4 class='center'>Vuoi approvare la richiesta di questo utente ($id - $cambia)?</h4>
				<form method = 'post' action = 'a_appUtente.php?cambia=$id&amp;itorneo=$itorneo&amp;go=1'>
				<table class='highlight'>
				<tr align=left><td>Pseudonimo: </td><td>$iutente</td></tr>
				<tr align=left><td>Squadra: </td><td>$isquadra</td></tr>
				<tr align=left><td>Torneo: </td><td>$itorneo</td></tr>
				<tr align=left><td>Serie: </td><td>$iserie</td></tr>
				<tr align=left><td>Password: </td><td>$ipass</td></tr>
				<tr align=left><td>Email: </td><td>$iemail</td></tr>
				<tr align=left><td>Sito web: </td><td>$url</td></tr>
				<tr align=left><td>Citt&agrave;: </td><td>$icitta</td></tr>
				</table>	
				</div>
				</div>
				<div class='card-action center'>
				<button type='submit' class='btn waves-effect waves-light green' name = 'submit'>Approva utente</button>
				</div>
				</form>";
			}
		}
		else {
			if ($_SESSION['permessi'] == 4 OR $_SESSION['permessi'] == 3){
				echo"<table bgcolor='$sfondo_tab' cellpadding='10' width='100%' align='center'>
				<caption>Approvazione utenti</caption><tr align='left'>
				<td valign='top' style='border: 1px solid #888888;'>";
				$fileo = @file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
				$linee = count($fileo);
				$tot = 0;		
				for($numx = 1 ; $numx < $linee; $numx++) {
					@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", trim($fileo[$numx]));
					
					if ($opermessi == -1) {
						echo "<a href = 'a_appUtente.php?cambia=".$numx."&amp;itorneo=".$otorneo."' class='user'>".$outente." </a><br />";
						echo "email: ". $oemail. " - ";
						echo "torneo: ". $otorneo. " - ";
						echo "serie: ". $oserie. " - ";
						echo "squadra: ". $osquadra. " - ";
						echo "citt&agrave;: ". $ocitta. "<hr size='1' noshade='noshade' />";
						$tot++;
					}
				}
				if ($tot == 0) echo "<center><b>Nessun utente in attesa di approvazione</b></center>";
				echo "</td></tr></table>";		
			}
			elseif ($_SESSION['permessi'] == 5){
				echo '<div class="container" style="width: 85%;margin-top: -10px;">
				<div class="card-panel">
				<div class="row">';
				
				require ("./a_widget.php");
				echo'<div class="col m9">';
				echo"<div class='bread'><a href='./a_gestione.php'>Gestione</a> / Configurazione sito</div><br>
				<div class='card'>
				<div class='card-content'>
				<span class='card-title'>Approvazione utenti<span style='font-size: 13px;'> - Abilita i profili in attesa</span></span>
				<hr>
				<div class='row'>
				<table class='highlight'>
				<tr align='left'>
				<td>";
				
				$tornei = @file($percorso_cartella_dati."/tornei.php");
				$num_tornei = count($tornei);
				
				for ($num1 = 1 ; $num1 < $num_tornei; $num1++) {
					@list($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza) = explode(",", $tornei[$num1]);
					$fileo = @file($percorso_cartella_dati."/utenti_".$otid.".php");
					$linee = count($fileo);
					$tot =0;			
					for($numx = 1 ; $numx < $linee; $numx++) {
						@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $fileo[$numx]);
						if ($opermessi == -1) {
							echo "<a href = 'a_appUtente.php?cambia=".$numx."&amp;itorneo=".$otorneo."' class='user'>".$outente." </a><br />";
							echo "email: ". $oemail. " - ";
							echo "torneo: ". $otorneo. " - ";
							echo "serie: ". $oserie. " - ";
							echo "squadra: ". $osquadra. " - ";
							echo "citt&agrave;: ". $ocitta. "<hr size='1' noshade='noshade' />";
							$tot++;
						}
					}
				}
				if ($tot == 0) echo "<p class='center'><b>Nessun utente in attesa di approvazione</b></p>";
				echo "</td></tr></table>";
			}
		}
		echo "</div></div></div></div></div></div></div>";
	} # fine if ($_SESSION["valido"] == "SI" $_SESSION["utente"] =="admin") {
	else header("location: index.php?fallito=1");
	include("./footer.php");
?>					