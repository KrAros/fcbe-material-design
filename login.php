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
##################################################################################
session_start();
$scadenza_sessioni = 60*60*2;  		# secondi x minuti x ore
session_set_cookie_params($scadenza_sessioni);
session_start();
header ("Cache-control: private");
require_once("./dati/dati_gen.php");
$debug = "NO";
if ($debug == "SI") echo "";
if (!$_POST['l_utente'] AND $_SESSION['valido'] != "SI" ) {
	header("location: index.php?fallito=1");
	}
else {
	if(@$_SESSION['valido'] == "SI" AND $_SESSION["utente"] == $admin_user AND $_SESSION["pass"] == $admin_pass){
		header("location: ./a_gestione.php");
		exit;
	}
	elseif(@$_SESSION['valido'] == "SI" AND $_SESSION["utente"] != $admin_user){
		header("location: ./mercato.php");
		exit;
	}
	else {
		$login_utente = $_POST['l_utente'];
		$login_pass = $_POST['l_pass'];
		$login_torneo = $_POST['l_torneo'];
		
		if ($login_utente == $admin_user) {
			if ($login_pass == $admin_pass) {
				$_SESSION["utente"] = $admin_user;
				$_SESSION["pass"] = $admin_pass;
				$_SESSION["admin"] = "SI";
				$_SESSION["permessi"] = 5;
				$_SESSION["valido"] = "SI";
				$_SESSION['csn'] = $_SERVER[SERVER_NAME];
				header("location: a_gestione.php");
				exit;
			}
			else {
				unset($_SESSION);
				$_SESSION["valido"] = "NO";
				header("location: index.php?fallito=2");
				exit;
			}
		}
		elseif ($login_utente != $admin_user) {
			
			$tornei = @file("$percorso_cartella_dati/tornei.php");
			$num_tornei = count($tornei);
			for ($num1 = 1 ; $num1 < $num_tornei; $num1++) {
				@list($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza) = explode(",", $tornei[$num1]);
				$_SESSION['otreset']=$otreset_scadenza;
				if (is_file($percorso_cartella_dati."/utenti_".$otid.".php")) {
					$file = @file("./dati/utenti_".$otid.".php")or die("Impossibile caricare i dattagli degli utenti [RIF: ./dati/utenti $otid]");
					$linee = count($file);
					$linea = 1;
					$trovato = 0;
					do {
						@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg, $otitolari, $opanchina, $otemp1, $otemp2, $otemp3, $otemp4, $otemp5, $otemp6, $otemp7, $otemp8, $otemp9, $otemp0) = explode("<del>", $file[$linea]);
						if(($login_utente == $outente) && (md5($login_pass) == $opass) && ($login_torneo == $otorneo)) $trovato = 1;
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
				$_SESSION['uid'] = $linea;
				$_SESSION['utente'] = $outente;
				$_SESSION['pass'] = $opass;
				$_SESSION['permessi'] = $opermessi;
				$_SESSION['email'] = $oemail;
				$_SESSION['url'] = $ourl;
				$_SESSION['citta'] = trim($ocitta);
				$_SESSION['squadra'] = trim($osquadra);
				$_SESSION['torneo'] = $otorneo;
				$_SESSION['serie'] = $oserie;
				$_SESSION['valido'] = "SI";
				$_SESSION['reg'] = trim($oreg);
				$_SESSION['titolari'] = $otitolari;
				$_SESSION['panchina'] = $opanchina;
				$_SESSION['temp1'] = $otemp1;
				$_SESSION['temp2'] = $otemp2;
				$_SESSION['temp3'] = $otemp3;
				$_SESSION['temp4'] = $otemp4;
				$_SESSION['temp5'] = $otemp5;
				$_SESSION['temp6'] = $otemp6;
				$_SESSION['temp7'] = $otemp7;
				$_SESSION['temp8'] = $otemp8;
				$_SESSION['temp9'] = $otemp9;
				$_SESSION['temp0'] = $otemp0;
				$_SESSION['csn'] = $_SERVER[SERVER_NAME];
				header("location: ". $_SERVER['PHP_SELF']);
				exit;
			}
			elseif ($trovato == 1 and $opermessi < 0) {
				header("location: index.php?attesa=1");
				exit;
			}
			else header("location: index.php?fallito=1");
		}
	}
}
?>