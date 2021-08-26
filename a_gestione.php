<?php
	##################################################################################
	#    FANTACALCIOBAZAR EVOLUTION
	#    Copyright (C) 2003 - 2009 by Antonello Onida
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
	require './libs/Smarty.class.php';
    require './controlla_pass.php';
    $smarty = new Smarty;
    //$smarty->force_compile = true;
    $smarty->debugging = true;
    $smarty->caching = false;
    $smarty->cache_lifetime = 120;
	include('a_widget.php');
	
	$smarty->assign("TitoloPagina", "Dashboard amministrativa");
	$smarty->assign("Sottotitolo", "Benvenuto Amministratore!");
	
	if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] == 5) {
		#require ("./a_menu.php");		
		
		if ($procedi=="SI"){
			$mcc=file_get_contents($sito_mirror.$cartella_remota."/MCC$ultima_gio.txt");
			$mcc_vecchio=fopen("./".$prima_parte_pos_file_voti.$ultima_gio.".txt","w+");
			fwrite($mcc_vecchio,$mcc);
			fclose($mcc_vecchio);
			$voti_vecchio=fopen($percorso_cartella_voti."/voti".$ultima_gio.".txt","w+");
			fwrite($voti_vecchio,$mcc);
			fclose($voti_vecchio);	
			$errori= error_get_last();
			if (empty($errori)){
				$mess_mcc = "Errore nella copia del file: ".$errori['type'];
				$mess_mcc .= "\n".$errori['message'];
			} 
			else $mess_mcc = "File MCC$ultima_gio aggiornato!";
			
		}
		if($cfv == "SI" AND isset($nfv) AND isset($lfv)){
			$voti_1x = file_get_contents($lfv);
			$voti_2x = fopen("./".$prima_parte_pos_file_voti.$nfv.".txt","w+");
			fwrite($voti_2x,$voti_1x);
			fclose($voti_2x);
			$errori= error_get_last();
			if (empty($errori)){
				$messcfv = "Errore nella copia del file: ".$errori['type'];
				$messcfv .= "\n".$errori['message'];
			} 
			else $messcfv = "<p class='evidenziato green white-text center'>File MCC$nfv.txt copiato con successo!</p>";
		}
		if($ccfv == "SI" AND isset($clfv)){
			$voti_1 = file_get_contents($clfv);
			$voti_2 = fopen($percorso_cartella_dati."/calciatori.txt","w+");
			fwrite($voti_2,$voti_1);
			fclose($voti_2);
			$errori= error_get_last();
			if (empty($errori)){
				$messccfv = "Errore nella copia del file: ".$errori['type'];
				$messccfv .= "\n".$errori['message'];
			} 
			else $messccfv = "<p class='evidenziato green white-text center'>File calciatori.txt caricato con successo!</p>";
		}
		if ($blocca_giornata == "chiudi") {
			$file_dati = fopen($percorso_cartella_dati."/chiusura_giornata.txt","wb+");
			flock($file_dati,LOCK_EX);
			fwrite($file_dati, "1");
			flock($file_dati,LOCK_UN);
			fclose($file_dati);
			echo "<meta http-equiv='refresh' content='0; url=a_gestione.php?messgestutente=60'>";
			exit;
		}
		
		if ($blocca_giornata == "apri") {
			if (@is_file($percorso_cartella_dati."/chiusura_giornata.txt")) {
				unlink ($percorso_cartella_dati."/chiusura_giornata.txt");
				echo "<meta http-equiv='refresh' content='0; url=a_gestione.php?messgestutente=61'>";
				exit;
			}
			else {
				echo "<meta http-equiv='refresh' content='0; url=a_gestione.php?messgestutente=62'>";
				exit;
			}
		}
		
		if ($cambia_data == "cambia_data") {
		    $orario = explode(":", $timepicker);
			$data = explode("/", $datepicker); ### aaaa/mm/gg
			$file_dati = fopen($percorso_cartella_dati."/data_chigio.txt","wb+");
			flock($file_dati,LOCK_EX);
			fwrite($file_dati, "$data[2]$data[1]$data[0]$orario[0]$orario[1]");
			flock($file_dati,LOCK_UN);
			fclose($file_dati);
			echo "<meta http-equiv='refresh' content='0; url=a_gestione.php?messgestutente=65'>";
			exit;
		}
		$dis="";
		$dis1="";
		$dis2="";
		
		
		if (isset($mess_mcc)) $tabella_giornate .= "<div style='padding: 5px'>$mess_mcc</div>";
		if (isset($messcfv)) $tabella_giornate .= "<div style='padding: 5px'>$messcfv</div>";
		if (isset($messccfv)) $tabella_giornate .= "<div style='padding: 5px'>$messccfv</div>";
		
		$tabella_giornate .= "<div class='row'>
		<div class='col m12'>
		<div class='card light-blue darken-4'>
        <div class='card-content white-text'>
		<span class='card-title center'>Elenco giornate</span>
		<p>";
		
		$tornei = @file($percorso_cartella_dati."/tornei.php");
		$num_tornei = count($tornei);
		for ($nums1 = 1 ; $nums1 < $num_tornei; $nums1++) {
			@list($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza) = explode(",", $tornei[$nums1]);
			if ($otritardo_torneo != 0) $flag_ritardo = $otritardo_torneo;
		} # fine for $nums1
		
		$num1 = 1;
		while ($num1 <= 38) {
			if (strlen($num1) == 1) $num1 = "0".$num1;
			if ($num1 == 11 OR $num1 == 21 OR $num1 == 31) $tabella_giornate .= "<br/><br/>";
			
			$giornata = "giornata$num1";
			
			for($num0 = 1; $num0 < $num_tornei; $num0++) {
				if (@is_file($percorso_cartella_dati."/".$giornata."_".$num0."_0") AND $num1 >= $prossima) {
					$tabella_giornate_giocate .= "<a href='a_giornata.php?num_giornata=$num1' class='evidenziato z-depth-4 white'>&nbsp;$num1&nbsp;</a>&nbsp;&nbsp;&nbsp;";
					$ultima_gio=$num1;
					if($num1 >= $prossima) $prossima = $num1+1;
				} 
			} # fine for $num0
			$num1++;
		} # fine for $num1
		$smarty->assign("giornate_giocate", $tabella_giornate_giocate);
		$tabella_giornate.="</p></div></div></div></div>";
		
		if ($prossima < 1) $prossima = 1;
		if (strlen($prossima) == 1) $prossima = "0".$prossima;
		
		switch ($abilita_stat) {
			case 'AUTO': {
				if (@fopen($sito_principale.$cartella_remota.'/MCC'.$prossima.'.txt', 'r')) $lfv = $sito_principale.$cartella_remota."/MCC$prossima.txt";
				else if (@fopen($sito_mirror.$cartella_remota.'/MCC'.$prossima.'.txt', 'r')) $lfv = $sito_mirror.$cartella_remota."/MCC$prossima.txt";
				else {$dis2="disabled='disabled'";
				$lfv = "NO";}
				break;
			}	
			case 'PRINCIPALE': {
				if (@fopen($sito_principale.$cartella_remota.'/MCC'.$prossima.'.txt', 'r')) $lfv = $sito_principale.$cartella_remota."/MCC$prossima.txt";
				else {$dis2="disabled='disabled'";
				$lfv = "NO";}
				break;	
			}	
			case 'MIRROR': {
				if (@fopen($sito_mirror.$cartella_remota.'/MCC'.$prossima.'.txt', 'r')) $lfv = $sito_mirror.$cartella_remota."/MCC$prossima.txt";
				else {$dis2="disabled='disabled'";
				$lfv = "NO";}
				break;	
			}
			case 'OFF': {
				$dis2="disabled='disabled'";
				$lfv = "NO";
				break;
			}				
		}
		
		$file_voti_locale = "./".$prima_parte_pos_file_voti.$prossima.".txt";
		
		if (@fopen($file_voti_locale,'r')) {$dis="";}
		else {$dis="disabled='disabled'";}
		$smarty->assign("dis", $dis);
		
		#if ($lfv == "NO") $tabella_giornate .= "<div style='float: left; padding: 5px;'>MCC$prossima.txt non disponibile!</div>";
			#elseif (@fopen($file_voti_locale,'r')) $tabella_giornate .= "<div style='float: left; padding: 5px;'>MCC$prossima.txt presente!<br />Si pu&ograve; creare la giornata!</div>";
			#$tabella_giornate .= "Cartella voti remota\n";
			
			############################### file calciatori
			switch ($abilita_stat) {
				case 'AUTO': {
					if (@fopen($sito_principale.$cartella_remota.'/MCC00.txt', 'r')) $clfv = $sito_principale.$cartella_remota."/MCC00.txt";
					else if (@fopen($sito_mirror.$cartella_remota.'/calciatori.txt', 'r')) $clfv = $sito_mirror.$cartella_remota."/calciatori.txt";
					else {$dis1="disabled='disabled'";
					$clfv = "NO";}
					break;
				}	
				case 'PRINCIPALE': {
					if (@fopen($sito_principale.$cartella_remota.'/MCC00.txt', 'r')) $clfv = $sito_principale.$cartella_remota."/MCC00.txt";
					else {$dis1="disabled='disabled'";
					$clfv = "NO";}
					break;	
				}	
				case 'MIRROR': {
					if (@fopen($sito_mirror.$cartella_remota.'/calciatori.txt', 'r')) $clfv = $sito_mirror.$cartella_remota."/calciatori.txt";
					else {$dis1="disabled='disabled'";
					$clfv = "NO";}
					break;	
				}
				case 'OFF': {
					$dis1="disabled='disabled'";
					$clfv = "NO";
					break;
				}				
			}
			
			$file_voti_localec = "./dati/calciatori.txt";
			if (file_exists($file_voti_localec)) $gh=date ("j/n/Y", filemtime($file_voti_localec));
			else $gh="---";
			
			$curl = curl_init($clfv);
			curl_setopt($curl, CURLOPT_NOBODY, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_FILETIME, true);
			$result = curl_exec($curl);
			if ($result === false) {
			echo "Cartella remota mancante"; }
			$timestamp = curl_getinfo($curl, CURLINFO_FILETIME);
			
			$smarty->assign("timestamp", $timestamp);
			$time_voti_locale = filemtime($file_voti_localec);
			$smarty->assign("time_voti_locale", $time_voti_locale);
			$smarty->assign("clfv", $clfv);
			$smarty->assign("lfv", $lfv);
			
			if ($timestamp > @filemtime($file_voti_localec)) { //otherwise unknown
				$tabella_giornate .= "<form method='post' action='./a_gestione.php'>
				<input type='hidden' name='ccfv' value='SI' />
				<input type='hidden' name='clfv' value='$clfv' />
				<div class='row'>
				<div class='col m12'>
				<div class='card yellow'>
				<div class='card-content center'>
				<span class='card-title'>Lista calciatori</span>
				<p><i class='medium material-icons yellow-text text-darken-3'>info</i></p>
				<br>
				<p>&Eacute; disponibile un nuovo file <b>Calciatori</b>: scaricalo!</p>
				</div>
				<div class='card-action center'>
				<button class='btn waves-effect waves-light yellow darken-3 black-text' type='submit' name='carica_calciatori' $dis1>Aggiorna lista</button>
				</div>
				</div>
				</div>
				</form>";
				} else {
				$tabella_giornate .= "<div class='row'>
				<div class='col m12'>
				<div class='card green'>
				<div class='card-content center white-text'>
				<span class='card-title'>Lista calciatori</span>
				<p><i class='medium material-icons green-text text-lighten-4'>check_circle</i></p>
				<br>
				<p>Tutto aggiornato: l'ultimo file <b>Calciatori</b> &eacute; caricato sul sito.</p>
				</div>
				<div class='card-action center'>
				<button class='btn waves-effect waves-light green darken-3 black-text' type='submit' disabled>Nulla da aggiornare</button>
				</div>
				</div>
				</div>";	
			} 
			$curl = curl_init($sito_mirror.$cartella_remota."/MCC$ultima_gio.txt");
			curl_setopt($curl, CURLOPT_NOBODY, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_FILETIME, true);
			$result = curl_exec($curl);
			
			if ($result === false) {
				echo (curl_error($curl)); 
			}
			$timestamp = curl_getinfo($curl, CURLINFO_FILETIME);
			$file_mcc = ("./".$prima_parte_pos_file_voti.$ultima_gio.".txt");
			$mcc_file = @filemtime($file_mcc);
			$smarty->assign("mcc_file", $mcc_file);
			$smarty->assign("ultima_gio", $ultima_gio);
			
			if ($timestamp > @filemtime($file_mcc) and $ultima_gio == 00) { 	
				$tabella_giornate .= "<div class='col s12 m6'>
				<div class='card green'>
				<div class='card-content center white-text'>
				<span class='card-title'>Fase preliminare</span>
				<p><i class='medium material-icons green-text text-lighten-4'>check_circle</i></p>
				<br>
				<p>I file MCC non sono disponibili in questa fase.</p>
				</div>
				<div class='card-action center'>
				<button class='btn waves-effect waves-light' type='submit' name='carica_calciatori' disabled $dis1>Nulla da aggiornare</button>
				</div>
				</div>
				</div>";
			} 
			elseif ($timestamp > @filemtime($file_mcc)) {
				//otherwise unknown
				$tabella_giornate .= "<center><br/><span class='evidenziato'>E' disponibile un aggiornamento del file <b>MCC$ultima_gio.txt</b></center></span><br/>";
				$tabella_giornate .= "<div style='float: left; padding: 5px;'><form method='post' action='./a_gestione.php'>
				<input type='hidden' name='procedi' value='SI' />
				<input type='hidden' name='ultima_gio' value='$ultima_gio' />
				<input type='submit' name='aggiorna_voti' value='Aggiorna MCC$ultima_gio.txt' />
				</form></div>";
				} else {
				$tabella_giornate .= "<div class='col s12 m6'>
				<div class='card green'>
				<div class='card-content center white-text'>
				<span class='card-title'>Voti giornata $ultima_gio</span>
				<p><i class='medium material-icons green-text text-lighten-4'>check_circle</i></p>
				<br>
				<p>Il file MCC della giornata precedente &eacute; aggiornato.</p>
				</div>
				<div class='card-action center'>
				<button class='btn waves-effect waves-light' type='submit' name='carica_calciatori' disabled $dis1>Nulla da aggiornare</button>
				</div>
				</div>
				</div>";
			}	
			
			#########################	controllo presenza voti --> disattivo pulsante calciatori
			#	$ultima=ultima_giornata_giocata();
			#	if (@fopen("$percorso_cartella_voti/voti$ultima.txt", 'r')) $dis1="disabled='disabled'";
				#		else $dis1="";
				
				if ($clfv == "NO" and $lfv =="NO" ) $tabella_giornate .= "<div style='float: center; padding: 22px;'><b>Procedura disattivata da pannello config!</b></div>";
				else {
					$file_mcc = ("./".$prima_parte_pos_file_voti.$prossima.".txt");
					$file_mcc = file_exists($file_mcc);
					$smarty->assign("file_mcc", $file_mcc);
					$smarty->assign("prossima", $prossima);
					
					#elseif (@fopen($file_voti_localec,'r')) $tabella_giornate .= "<div style='float: left; padding: 5px;'>calciatori.txt presente!<br />Si può aggiornare!</div>";
					if (!file_exists($file_mcc)) { 
						$tabella_giornate .= "<form method='post' action='./a_gestione.php'>
						<input type='hidden' name='cfv' value='SI' />
						<input type='hidden' name='lfv' value='$lfv' />
						<input type='hidden' name='nfv' value='$prossima' />
						<div class='col s12 m6'>
						<div class='card yellow'>
						<div class='card-content center'>
						<span class='card-title'>Voti giornata $prossima</span>
						<p><i class='medium material-icons yellow-text text-darken-3'>info</i></p>
						<br>
						<p>&Eacute; disponibile un nuovo file <b>MCC</b>: scaricalo!</p>
						</div>
						<div class='card-action center'>
						<button class='btn waves-effect waves-light yellow darken-3 black-text' type='submit' name='preleva_voti' $dis1>Preleva MCC$prossima.txt</button>
						</div>
						</div>
						</div>
						</div>
						</form>";
					} else $tabella_giornate .= "<div class='col s12 m6'>
					<div class='card green'>
					<div class='card-content center white-text'>
					<span class='card-title'>Voti giornata</span>
					<p><i class='medium material-icons green-text text-lighten-4'>check_circle</i></p>
					<br>
					<p>Tutto &eacute; correttamente aggiornato: l'ultimo file MCC &eacute; caricato sul sito.</p>
					</div>
					<div class='card-action center'>
					<button class='btn waves-effect waves-light' type='submit' name='carica_calciatori' disabled $dis1>Nulla da aggiornare</button>
					</div>
					</div>
					</div>
					</div>";
					
					$tabella_giornate .= "<div class='center'><form method='post' action='./a_crea_giornata.php'>
					<input type='hidden' name='giornata' value='$prossima' />
					<button class='btn waves-effect waves-light green' type='submit' name='crea_giornata' $dis>Crea la giornata $prossima</button>
					</form></div>";
					
				}
				#######################################
				
				if ($messgestutente) {
					require_once ("./inc/avvisi.php");
					$tabella_msg = "<br/><span class='evidenziato' style='color: #000000'> $avviso[$messgestutente] </span>";
				} # fine if ($messgestutente)
				
				if ($manutenzione == "SI") $mess_manu = "<img border='1' src='./immagini/manutenzione.gif' alt='Sito in manutenzione' vspace='10' width='150' /><br/><b>Attenzione: sito in stato di manutenzione!</b><br/><br/>";
				else unset($mess_manu);
				

				
				#############
			}
			else header("location: logout.php?logout=2");
			$smarty->display('a_gestione.tpl');
		?>																																																								