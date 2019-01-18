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
	
	if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] >= 4) {
		
		echo '<div class="container" style="width: 85%;margin-top: -10px;">
		<div class="card-panel">
		<div class="row">';
		require ("./a_widget.php");
		echo "<div class='col m9'>
		<div class='bread'><a href='./a_gestione.php'>Gestione</a> / Crea sondaggio</div>
		<div class='card'>
		<div class='card-content'>
		<span class='card-title'>Sondaggi<span style='font-size: 13px;'> - Crea un sondaggio sul sito</span></span>
		<hr>
		<table><tr><td align=left>";
		
		if (!@is_file($percorso_cartella_dati."/sondaggio.php")) {
			if ($crea_sondaggio) {
				if (!$domanda) $crea = "NO";
				$domanda = stripslashes($domanda);
				$domanda = str_replace("$","\\\$",$domanda);
				$domanda = str_replace("'","\\'",$domanda);
				if (!$tipo) $crea = "NO";
				ereg_replace("[0-9]","",$num_voti_segreti);
				if ((ereg_replace("[0-9]","",$num_voti_segreti) != "" or $num_voti_segreti == "" or $num_voti_segreti == 0) and $tipo == "votazione_segreta") $crea = "NO";
				if ((ereg_replace("[0-9]","",$num_voti_palesi) != "" or $num_voti_palesi == "" or $num_voti_palesi == 0) and $tipo == "votazione_palese") $crea = "NO";
				if ($crea != "NO") {
					if ($tipo == "votazione_segreta" or $tipo == "sondaggio_segreto")  $voto_palese = "NO";
					else $voto_palese = "SI";
					if ($tipo == "votazione_segreta") $voti_consentiti =$num_voti_segreti ;
					if ($tipo == "votazione_palese") $voti_consentiti =$num_voti_palesi ;
					if ($tipo == "sondaggio_segreto" or $tipo == "sondaggio_palese") $voti_consentiti = 0;
					$file_sondaggio = fopen("$percorso_cartella_dati/sondaggio.php","w+");
					flock($file_sondaggio,LOCK_EX);
					$testo_file = "<?php
					\$voti_consentiti = '$voti_consentiti';
					\$voto_palese = '$voto_palese';
					\$domanda = '$domanda';
					\$opzioni = array();
					";
					$tornei = @file($percorso_cartella_dati."/tornei.php");
					$num_tornei = count($tornei);
					
					for ($num = 1 ; $num < $num_tornei; $num++) {
						unset($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza);
						@list($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza) = explode(",", $tornei[$num]);
						
						$file = file("./dati/utenti_".$otid.".php");
						$linee = count($file);
						
						for($num1 = 1 ; $num1 < $linee+1; $num1++) {
							@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$num1]);
							$testo_file .= "\$voti_$outente = array();\n";
						} # fine for $num1
					}
					$testo_file .= "?>";
					fwrite($file_sondaggio,$testo_file);
					flock($file_sondaggio,LOCK_UN);
					fclose($file_sondaggio);
					echo "<center><h5>Sondaggio creato.</h5><br/>";
				} # fine if ($crea != "NO")
				else echo "<center>ERRORE.<br/>";
				echo "<form method='post' action='./a_crea_sondaggio.php'>
				<input type='submit' name='vai' value='OK' />
				</form>";
			} # fine if ($crea_sondaggio)
			else {
				echo "<center><h5>Creazione sondaggio</h5></center><br/><form method='post' action='a_crea_sondaggio.php'>
				Domanda: <input type='text' name='domanda' size='50' /><br/><br/>Tipo:<br/>
				<input type='radio' name='tipo' value='votazione_segreta' /> Votazione segreta con
				<input type='text' name='num_voti_segreti' size='2' maxlength='2' value='1' /> voto/i per giocatore<br/>
				<input type='radio' name='tipo' value='votazione_palese' /> Votazione palese con
				<input type='text' name='num_voti_palesi' size='2' maxlength='2' value='1' /> voto/i per giocatore<br/>
				<input type='radio' name='tipo' value='sondaggio_segreto' checked /> Sondaggio segreto (infiniti voti, non si registrano i votanti)<br/>
				<input type='radio' name='tipo' value='sondaggio_palese' /> Sondaggio palese (infiniti voti, tutti vedono i voti degli altri)<br/>
				<center><input type='submit' name='crea_sondaggio' value='Crea il sondaggio' /></center>
				</form>";
			} # fine else if ($crea_sondaggio)
		} # fine if (!@is_file("$percorso_cartella_dati/sondaggio.php"))
		
		else {
			
			if ($cancella_sondaggio) {
				if (unlink($percorso_cartella_dati."/sondaggio.php")) echo "Sondaggio cancellato";
				else echo "ERRORE.<br/>";
				echo "<form method='post' action='./a_crea_sondaggio.php'>
				<input type='submit' name='vai' value='OK' />
				</form>";
			} # fine if ($cancella_sondaggio)
			else {
				
				if ($nuova_opzione) {
					include($percorso_cartella_dati."/sondaggio.php");
					$linee_sondaggio = file($percorso_cartella_dati."/sondaggio.php");
					$filesondaggio = fopen($percorso_cartella_dati."/sondaggio.php","w+");
					$num_linee_sondaggio = count($linee_sondaggio);
					for ($num1 = 0 ; $num1 < $num_linee_sondaggio; $num1++) {
						if (substr($linee_sondaggio[$num1],0,10) == "\$opzioni =") {
							if (count($opzioni) != 0) $linee_sondaggio[$num1] = str_replace(");",",);",$linee_sondaggio[$num1]);
							$nuova_opzione = stripslashes($nuova_opzione);
							$nuova_opzione = str_replace("$","\\\$",$nuova_opzione);
							$nuova_opzione = str_replace("'","\\'",$nuova_opzione);
							$linee_sondaggio[$num1] = str_replace(");","'$nuova_opzione');",$linee_sondaggio[$num1]);
						} # fine if (substr($linee_sondaggio[$num1],0,10) == "\$opzioni =")
						$linea = substr($linee_sondaggio[$num1],0,2);
						if ($linea == "?>") $linee_sondaggio[$num1] = "\$voti".(count($opzioni)+1)." = 0;\n?>";
					} # fine for $num1
					rewind($filesondaggio);
					flock($filesondaggio,LOCK_EX);
					for ($num1 = 0 ; $num1 < $num_linee_sondaggio; $num1++) {
						fwrite($filesondaggio,$linee_sondaggio[$num1]);
					} # fine for $num1
					flock($filesondaggio,LOCK_UN);
					fclose($filesondaggio);
				} # fine if ($nuova_opzione)
				
				include($percorso_cartella_dati."/sondaggio.php");
				if ($voti_consentiti == 0) {
					echo "<center>Sondaggio ";
					$o = "o";
				} # fine if ($voti_consentiti == 0)
				else {
					echo "<center>Votazione ";
					$o = "a";
				} # fine else if ($voti_consentiti == 0)
				if ($voto_palese == "SI") echo "palese";
				else echo "segret$o";
				if ($voti_consentiti > 1) echo " ($voti_consentiti voti consentiti)";
				echo "</center><br/>";
				echo "<b>Domanda</b>: $domanda<br/>
				<b>Opzioni</b>:<br/>";
				$num_opzioni = count($opzioni);
				for ($num1 = 0 ; $num1 < $num_opzioni; $num1++) {
					echo "- ".$opzioni[$num1]."<br/>";
				} # fine for $num1
				echo "<form method='post' action='./a_crea_sondaggio.php'>
				<input type='submit' name='aggiungi_opzione' value='Aggiungi opzione' /> :
				<input type='text' name='nuova_opzione' size='50' /><br/>
				</form>";
				echo "<br /><form method='post' action='./a_crea_sondaggio.php'>
				<input type='submit' name='cancella_sondaggio' value='Cancella il sondaggio' />
				</form>";
			} # fine else if ($cancella_sondaggio)
		} # fine else if (!@is_file("$percorso_cartella_dati/sondaggio.php"))
		echo"</td></tr></table>";
		echo"</div></div></div></div></div></div>";  
	} # fine if ($_SESSION...
	else echo"<meta http-equiv='refresh' content='0; url=logout.php'>";
	include("./footer.php");
?>				