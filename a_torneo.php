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
	
	$smarty->assign("TitoloPagina", "Gestione tornei");
	$smarty->assign("Sottotitolo", "Modifica i parametri dei tornei presenti sul sito");
	$smarty->assign("inserimento", $inserimento);
	$smarty->assign("azione", $azione);
	$smarty->assign("attiva_multi", $attiva_multi);
	$smarty->assign("messgestutente", $messgestutente);
	
	if ($_SESSION ['valido'] == "SI" and $_SESSION ['permessi'] == 5) {
		
		echo '<div class="container" style="width: 85%;margin-top: -10px;">
		<div class="card-panel">
		<div class="row">';
		
		require ("./a_widget.php");
		echo'<div class="col m9">';
		echo"<div class='bread'><a href='./a_gestione.php'>Gestione</a> / Gestione tornei</div><br>
		<div class='card'>
		<div class='card-content'>
		<span class='card-title'>Gestione tornei<span style='font-size: 13px;'> - Modifica i parametri dei tornei presenti sul sito</span></span>
		<hr>";
		
		if ($inserimento != "scrivi" and $azione == "cancella") {
			$id = $_POST ["itorneo"];
			$itdenom = $_POST ["itdenom"];
			$smarty->assign("id", $id);
			$smarty->assign("itdenom", $itdenom);
			//exit ();
		}
		
		if ($inserimento == "scrivi") {
			if ($azione == "nuovo") {
				$stringa = $N_otid . "," . $N_otdenom . "," . $N_otpart . ",0," . $N_otmercato_libero . "," . $N_ottipo_calcolo . "," . $N_otgiornate_totali . "," . $N_otritardo_torneo . "," . $N_otcrediti_iniziali . "," . $N_otnumcalciatori . "," . $N_otcomposizione_squadra . "," . $N_otquotacassa . ",0,0,0," . $N_otstato . "," . $N_otmodificatore_difesa . "," . $N_otschemi . "," . $N_otmax_in_panchina . "," . $N_otpanchina_fissa . "," . $N_otmax_entrate_dalla_panchina . "," . $N_otsostituisci_per_ruolo . "," . $N_otsostituisci_per_schema . "," . $N_otsostituisci_fantasisti_come_centrocampisti . "," . $N_otnumero_cambi_max . "," . $N_otrip_cambi_numero . "," . $N_otrip_cambi_giornate . "," . $N_otrip_cambi_durata . "," . $N_otaspetta_giorni . "," . $N_otaspetta_ore . "," . $N_otaspetta_minuti . "," . $N_otnum_calciatori_scambiabili . "," . $N_otscambio_con_soldi . "," . $N_otvendi_costo . "," . $N_otpercentuale_vendita . "," . $N_otsoglia_voti_primo_gol . "," . $N_otincremento_voti_gol_successivi . "," . $N_otvoti_bonus_in_casa . "," . $N_otpunti_partita_vinta . "," . $N_otpunti_partita_pareggiata . "," . $N_otpunti_partita_persa . "," . $N_otdifferenza_punti_a_parita_gol . "," . $N_otdifferenza_punti_zero_a_zero . "," . $N_otmin_num_titolari_in_formazione . "," . $N_otpunti_pareggio . "," . $N_otpunti_posizione [1] . "," . $N_otpunti_posizione [2] . "," . $N_otpunti_posizione [3] . "," . $N_otpunti_posizione [4] . "," . $N_otpunti_posizione [5] . "," . $N_otpunti_posizione [6] . "," . $N_otpunti_posizione [7] . "," . $N_otpunti_posizione [8] . "," . $N_otreset_scadenza . "," . "\n";
				$fp = fopen ( $percorso_cartella_dati . "/tornei.php", "a+" );
				flock ( $fp, LOCK_SH );
				fwrite ( $fp, $stringa );
				flock ( $fp, LOCK_UN );
				fclose ( $fp );
				echo "<h1>Torneo creato</h1><br />
				$N_otid - $N_otdenom<br />
				<form method='post' action='a_torneo.php'>
				<input type='hidden' name='itorneo' value='$id' />
				<input type='submit' value='Ritorna' /></form>";
				exit ();
			} 
			elseif ($azione == "modifica") {
				$stringa = $N_otid . "," . $N_otdenom . "," . $N_otpart . ",0," . $N_otmercato_libero . "," . $N_ottipo_calcolo . "," . $N_otgiornate_totali . "," . $N_otritardo_torneo . "," . $N_otcrediti_iniziali . "," . $N_otnumcalciatori . "," . $N_otcomposizione_squadra . "," . $N_otquotacassa . ",0,0,0," . $N_otstato . "," . $N_otmodificatore_difesa . "," . $N_otschemi . "," . $N_otmax_in_panchina . "," . $N_otpanchina_fissa . "," . $N_otmax_entrate_dalla_panchina . "," . $N_otsostituisci_per_ruolo . "," . $N_otsostituisci_per_schema . "," . $N_otsostituisci_fantasisti_come_centrocampisti . "," . $N_otnumero_cambi_max . "," . $N_otrip_cambi_numero . "," . $N_otrip_cambi_giornate . "," . $N_otrip_cambi_durata . "," . $N_otaspetta_giorni . "," . $N_otaspetta_ore . "," . $N_otaspetta_minuti . "," . $N_otnum_calciatori_scambiabili . "," . $N_otscambio_con_soldi . "," . $N_otvendi_costo . "," . $N_otpercentuale_vendita . "," . $N_otsoglia_voti_primo_gol . "," . $N_otincremento_voti_gol_successivi . "," . $N_otvoti_bonus_in_casa . "," . $N_otpunti_partita_vinta . "," . $N_otpunti_partita_pareggiata . "," . $N_otpunti_partita_persa . "," . $N_otdifferenza_punti_a_parita_gol . "," . $N_otdifferenza_punti_zero_a_zero . "," . $N_otmin_num_titolari_in_formazione . "," . $N_otpunti_pareggio . "," . $N_otpunti_pos . "," . $N_otreset_scadenza . "," . "\n";
				
				$id = $_POST ["N_otid"];
				$tornei = @file ( $percorso_cartella_dati . "/tornei.php" );
				$num_tornei = 0;
				for($num0 = 0; $num0 < count ( $tornei ); $num0 ++) {
					$num_tornei ++;
				}
				
				for($num1 = 1; $num1 < $num_tornei; $num1 ++) {
					@list ( $otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $tquotacassa, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema, $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza ) = explode ( ",", $tornei [$num1] );
					if ($id == $otid)
					$tornei [$num1] = $stringa;
				} // fine for $num1
				
				$fo = fopen ( $percorso_cartella_dati . "/tornei.php", 'wb+' );
				flock ( $fo, LOCK_EX );
				foreach ( $tornei as $N_tornei ) {
					fwrite ( $fo, $N_tornei ) or die ( "Non riesco a scrivere sul file!" );
				}
				flock ( $fo, LOCK_UN );
				fclose ( $fo );
				echo "<h1>Torneo modificato</h1><br />
				$N_otid - $N_otdenom<br />
				<form method='post' action='a_torneo.php'>
				<input type='hidden' name='itorneo' value='$id' />
				<input type='submit' value='Ritorna' /></form>";
				exit ();
			} 
			elseif ($azione == "cancella") {
				$id = $_POST ["iitorneo"];
				$fp = @file ( $percorso_cartella_dati . "/tornei.php" );
				$nt = 0;
				
				foreach ( $fp as $tornei ) {
					$at = explode ( ",", trim ( $tornei ) );
					if ($id == $at [0]) {
						echo " trovato ";
						echo $at [0] . " - " . $at [1] . " - " . $at [2] . " - " . $at [3] . " - " . $at [4] . " - " . $at [5] . " - " . $at [6] . "<br />";
						unset ( $fp [$nt] );
						break;
					}
					$nt ++;
				}
				
				// unset($fp[$id]);
				$fp = implode ( "", $fp );
				$fo = fopen ( $percorso_cartella_dati . "/tornei.php", 'wb+' );
				flock ( $fo, LOCK_EX );
				fwrite ( $fo, $fp );
				flock ( $fo, LOCK_UN );
				fclose ( $fo );
				echo "<h1>Torneo cancellato</h1><br />
				<form method='post' action='a_torneo.php'>
				<input type='submit' value='Ritorna' /></form>";
				exit ();
				} else {
				echo "location: ./a_torneo.php?messgestutente=78";
				header ( "location: ./a_torneo.php?messgestutente=78" );
				exit ();
			}
		} // fine if ($inserimento == "scrivi") {
		
		else {
			
			if (! $itorneo) {
				if (! @is_file ( $percorso_cartella_dati . "/tornei.php" )) {
					$ini_file = "<?php die('ACCESSO VIETATO');?>" . "\n";
					$fp = fopen ( $percorso_cartella_dati . "/tornei.php", "wb+" ) or die ( "errore fileopen" );
					flock ( $fp, LOCK_EX ) or die ( "errore filelocl ex" );
					fwrite ( $fp, $ini_file ) or die ( "errore fwrite" );
					flock ( $fp, LOCK_UN ) or die ( "errore filelocl un" );
					fclose ( $fp ) or die ( "errore fileclose" );
					if (@chmod ( $fp, 0664 ))
					echo "CHMOD 664 impostato!<br />";
					unset ( $ini_file, $fp );
				}
				$dati_tornei = @file ( $percorso_cartella_dati . "/tornei.php" );
				$dati_tornei = @array_slice ( $dati_tornei, 1 );
				$conta_tornei = count ( $dati_tornei );
				$a_tornei = array ();
				
				$mostra_tornei = "<table class='highlight' style='width:100%'>
			    <thead><tr><th>ID</th><th>Denominazione</th><th class='center'>Parametri</th><th class='center'>Gestione</th><th class='center'>Elimina</th></tr></thead>";
				
				$elenco_id_tornei = array ();
				// arrializzo e creo elenco tornei
				foreach ( $dati_tornei as $tornei ) {
					$at = explode(",", trim($tornei));
					$a_tornei[trim($at[0])][] = trim($at[1]);
					$a_tornei[trim($at[0])][] = trim($at[2]);
					$a_tornei[trim($at[0])][] = trim($at[4]);
					$a_tornei[trim($at[0])][] = trim($at[5]);
					$a_tornei[trim($at[0])][] = trim($at[6]);
					$elenco_id_tornei[] = $at[0];
					$id_tornei = trim($at[0]);
					$nome_tornei = trim($at[1]);
					
					$mostra_tornei .= "<tr bgcolor='$sfondo_tab1'>
					<td align='center'>" . trim ( $at [0] ) . "</td>
					<td align='left'>" . trim ( $at [1] ) . "
					</td>
					<td class='center'>
					<form method='post' action='a_torneo.php'>
					<input type='hidden' name='itorneo' value='" . trim ( $at [0] ) . "' />
					<input type='hidden' name='azione' value='vedi' />
					<input type='hidden' name='inserimento' value='NO' />
					<input type='image' src='./immagini/parametri.png' name='submit' alt='Parametri' />
					</form>
					</td>
					<td class='center'>
					<form method='post' action='a_gestione_tornei.php'>
					<input type='hidden' name='itorneo' value='" . trim ( $at [0] ) . "' />
					<input type='image' src='./immagini/gestione.png' name='submit' alt='Gestione' />
					</form>
					</td>
					<td class='center'>
					<form method='post' action='a_torneo.php'>
					<input type='hidden' name='itorneo' value='" . trim ( $at [0] ) . "' />
					<input type='hidden' name='itdenom' value='" . trim ( $at [1] ) . "' />
					<input type='hidden' name='inserimento' value='NO' />
					<input type='hidden' name='azione' value='cancella' />
					<input type='image' src='./immagini/elimina32.png' name='submit' alt='Elimina' />
					</form>
					</td></tr>";
					
					#########################################################################
					##### Inserimento statistiche in array per essere richiamati nel template
					$lista_tornei[] = array( 
						"id" => $id_tornei, 
						"nome" => $nome_tornei, 
						"squadra" => $squadra, 
						"backruolo" => $backruolo,
						"attivo" => $csattivo,
						"costo" => $valore,
						"valore_attuale" => $stat_valore,
						"proprietario" => $proprietario,
						"costo" => $costo,
					);
				}
				for($nnid = 1; $nnid < 100; $nnid ++) {
					if (! in_array ( $nnid, $elenco_id_tornei )) {
						$nt = $nnid;
						$smarty->assign("nuovo_torneo",$nt);
						break;
					}
				}
				$mostra_tornei .= "	<tr><td colspan='5' class='center'>
				<form method='post' action='a_torneo.php'>
				<input type='hidden' name='azione' value='nuovo' />
				<input type='hidden' name='itorneo' value='$nt' />
				<input type='hidden' name='inserimento' value='NO' />
				<button type='submit' class='btn waves-effect waves-light green' name='cancella' value='Crea un nuovo campionato (ID: $nt)'/>Crea un nuovo campionato (ID: $nt)</button>
				</form></td></tr></table><br />";
				unset ( $at, $tornei );
				echo $mostra_tornei;
				
				if ($messgestutente) {
					require_once ("./inc/avvisi.php");
					echo "<br /><font class='evidenziato'>&nbsp;$avviso[$messgestutente]&nbsp;</font>";
				} // fine if ($messgestutente)
				} else {
				if ($azione == "nuovo") {
					if ($attiva_multi != "SI")
					echo "<div align='center' class='evidenziato'><i class='material-icons'>info</i><h2>ATTENZIONE</h2> L'opzione <b>multigestione</b> non &egrave; stata attivata: proseguite a vostro rischio e pericolo!</div>";
					echo "<div class='mdl-card mdl-shadow--2dp' style='width: 100%;min-height:100%;'><div class='mdl-card__supporting-text' style='color:#060643; width: 97%;'>La procedura di <b>configurazione del torneo</b> si svolge in due fasi: questa &egrave; la prima, dove sono definite le caratteristiche generali del torneo. Occorrer&agrave; modificare successivamente la competizione appena creata per selezionare le opzioni specifiche relative alla modalit&agrave; di torneo scelta.</div></div><br />";
					$otid = $itorneo;
					} else {
					$tornei = @file ( $percorso_cartella_dati . "/tornei.php" );
					list ( $otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $otquotacassa, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema, $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza ) = explode ( ",", $tornei [$itorneo] );
				}
				echo "<form name='torneo' method='post' action='a_torneo.php'>";
				if ($azione == "nuovo")
				echo "<input type='hidden' name='azione' value='nuovo' />";
				else
				echo "<input type='hidden' name='azione' value='modifica' />";
			$smarty->assign("info_torneo", array( 'id' => $otid, 'nome' => $otdenom, $otpart, $otserie, 'mercato_libero' => $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $otquotacassa, $temp2, $temp3, $temp4, 'stato_mercato' => $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema, $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza ));
			?>
			<table class="highlight">
				<thead>
					<tr>
						<th class='center'>Nome</th>
						<th class='center'>Opzione</th>
					</tr>
				</thead>
				<tr>
					<td style='width:30%'>
						<p style='padding-left:30px'>ID Torneo</p>
					</td>
					<td style='width:50%'>
						<div class='input-field'>
							<input type="hidden" name="N_otid" value="<?php echo $otid ?>" /><?php echo "$otid"; ?>
						</div>
					</td>
					<td class='center'>
						<i class='material-icons tooltipped' data-position='top' data-tooltip='Progressivo ad uso interno, non modificabile.' >info</i>
					</td>
				</tr>
				<tr>
					<td style='width:30%'>
						<p style='padding-left:30px'>Denominazione</p>
					</td>
					<td style='width:50%'>
						<div class='input-field'>
							<input
							class='validate' placeholder='<?php echo $otdenom?>' type='text' value='<?php echo $otdenom?>' name='N_otdenom' id='input_text' data-length='50' />
						</div>
					</td>
					<td class='center'>
						<i class='material-icons tooltipped' data-position='top' data-tooltip='Il nome del torneo.' >info</i>
					</td>
				</tr>
				<tr>
					<td style='width:30%'>
						<p style='padding-left:30px'>Modalit&agrave; di mercato</p>
					</td>
					<td style='width:50%'>
						<div class='input-field'>
							<select name='N_otmercato_libero'>
								<option value="SI"
								<?php if($otmercato_libero == "SI") echo "selected"; ?>>Mercato libero</option>
								<option value="NO"
								<?php if($otmercato_libero == "NO") echo "selected"; ?>>Asta iniziale</option>
							</select>
						</div>
					</td>
					<td class='center'>
						<i class='material-icons tooltipped' data-position='top' data-tooltip='La mdalit&agrave; del mercato pu&ograve; essere:<br /> <b>Mercato
						libero</b>: un calciatore pu&ograve; apparire in pi&ugrave; rose.<br />
						<b>Asta iniziale</b>: un calciatore pu&ograve; apparire in una sola
						rosa a seguito di asta.' >info</i>
					</td>
				</tr>
				<tr>
					<td style='width:30%'>
						<p style='padding-left:30px'>Stato del mercato</p>
					</td>
					<td style='width:50%'>
						<div class='input-field'>
							<select name='N_otstato'>
								<option value="I" <?php if($otstato == "I") echo "selected"; ?>>Fase Iniziale</option>
								<option value="B" <?php if($otstato == "B") echo "selected"; ?>>Buste chiuse</option>
								<option value="R" <?php if($otstato == "R") echo "selected"; ?>>Mercato riparazione</option>
								<option value="A" <?php if($otstato == "A") echo "selected"; ?>>Mercato aperto</option>
								<option value="P" <?php if($otstato == "P") echo "selected"; ?>>Asta perenne</option>
								<option value="S" <?php if($otstato == "S") echo "selected"; ?>>Mercato sospeso</option>
								<option value="C" <?php if($otstato == "C") echo "selected"; ?>>Mercato chiuso</option>
								<option value="Z" <?php if($otstato == "Z") echo "selected"; ?>>Torneo non attivo</option>
							</select>
						</div>
					</td>
					<td class='center'>
						<i class='material-icons tooltipped' data-position='top' data-tooltip='Lo stato del mercato pu&ograve; essere:<br /> <b>I</b> -
						Iniziale (fase di calcio mercato prima del campionato).<br />
						<b>A</b> - Aperto (consentite tutte le operazioni di mercato).<br />
						<b>P</b> - Asta perenne (consentite tutte le operazioni di mercato
						a base asta).<br /> <b>S</b> - Sospeso (consentiti solo rilanci
						e vendita immediata di calciatori).<br /> <b>C</b> - Chiuso
						(nessuna operazione di mercato consentita).<br /> <b>R</b> -
						Riparazione (fase post-asta in cui si completano le squadre - <b>solo
						con asta iniziale</b>). <br /> <b>B</b> - Buste chiuse (permette
						di fare offerte nascoste - <b>solo con asta iniziale</b>).' >info</i>
					</td>
				</tr>
				<tr>
					<td style='width:30%'>
						<p style='padding-left:30px'>Numero partecipanti</p>
					</td>
					<td style='width:50%'>
						<div class='input-field'>
							<input
							class='validate' placeholder='<?php echo $otpart?>' type='text' value='<?php echo $otpart?>' name='N_otpart' id='input_text' data-length='4' />
						</div>
					</td>
					<td class='center'>
						<i class='material-icons tooltipped' data-position='top' data-tooltip='Totale dei partecipanti al torneo. Inserire <b>0</b> per
						partecipanti infiniti.' >info</i>
					</td>
				</tr>
				<tr>
					<td style='width:30%'>
						<p style='padding-left:30px'>N&deg; serie</p>
					</td>
					<td style='width:50%'>
						<div class='input-field'>
							<select name="N_otserie">
								<option value="0" <?php if($otserie==0) echo "selected"; ?>>1 serie o girone</option>
								<option value="1" <?php if($otserie==1) echo "selected"; ?>>2 serie o gironi</option>
								<option value="2" <?php if($otserie==2) echo "selected"; ?>>3 serie o gironi</option>
								<option value="3" <?php if($otserie==3) echo "selected"; ?>>4 serie o gironi</option>
								<option value="4" <?php if($otserie==4) echo "selected"; ?>>5 serie o gironi</option>
							</select>
						</div>
					</td>
					<td class='center'>
						<i class='material-icons tooltipped' data-position='top' data-tooltip='Opzione attualmente non funzionante.' >info</i>
					</td>
				</tr>
				<tr>
					<td style='width:30%'>
						<p style='padding-left:30px'>Calcolo puteggio</p>
					</td>
					<td style='width:50%'>
						<div class='input-field'>
							<select name="N_ottipo_calcolo">
								<option value="V" <?php if($ottipo_calcolo == "V") echo "selected"; ?>>Somma di voti</option>
								<option value="P" <?php if($ottipo_calcolo == "P") echo "selected"; ?>>Somma dei punti</option>
								<option value="S" <?php if($ottipo_calcolo == "S") echo "selected"; ?>>Scontri diretti</option>
								<option value="N" <?php if($ottipo_calcolo == "N") echo "selected"; ?>>Nessun calcolo</option>
							</select>
						</div>
					</td>
					<td class='center'>
						<i class='material-icons tooltipped' data-position='top' data-tooltip='Modalit&agrave; di calcolo del punteggio delle squadre.' >info</i>
					</td>
				</tr>
				<tr>
					<td style='width:30%'>
						<p style='padding-left:30px'>Giornate totali</p>
					</td>
					<td style='width:50%'>
						<div class='input-field'>
							<input
							class='validate' placeholder='<?php echo $otgiornate_totali?>' type='text' value='<?php echo $otgiornate_totali?>' name='N_otgiornate_totali' id='input_text' data-length='2' />
						</div>
					</td>
					<td class='center'>
						<i class='material-icons tooltipped' data-position='top' data-tooltip='Numero di giornate complessive del campionato.' >info</i>
					</td>
				</tr>
				<tr>
					<td style='width:30%'>
						<p style='padding-left:30px'>Ritardo inizio torneo</p>
					</td>
					<td style='width:50%'>
						<div class='input-field'>
							<input
							class='validate' placeholder='<?php echo $otritardo_torneo?>' type='text' value='<?php echo $otritardo_torneo?>' name='N_otritardo_torneo' id='input_text' data-length='2' />
						</div>
					</td>
					<td class='center'>
						<i class='material-icons tooltipped' data-position='top' data-tooltip='In caso di inizio ritardato, indicare il numero delle giornate
						gi&agrave; giocate.' >info</i>
					</td>
				</tr>
				<tr>
					<td style='width:30%'>
						<p style='padding-left:30px'>Crediti iniziali</p>
					</td>
					<td style='width:50%'>
						<div class='input-field'>
							<input
							class='validate' placeholder='<?php echo $otcrediti_iniziali?>' type='text' value='<?php echo $otcrediti_iniziali?>' name='N_otcrediti_iniziali' id='input_text' data-length='4' />
						</div>
					</td>
					<td class='center'>
						<i class='material-icons tooltipped' data-position='top' data-tooltip='Crediti iniziali, da incrementare in caso di giornate di
						riparazione.' >info</i>
					</td>
				</tr>
				<tr>
					<td style='width:30%'>
						<p style='padding-left:30px'>Numero calciatori</p>
					</td>
					<td style='width:50%'>
						<div class='input-field'>
							<input
							class='validate' placeholder='<?php echo $otnumcalciatori?>' type='text' value='<?php echo $otnumcalciatori?>' name='N_otnumcalciatori' id='input_text' data-length='4' />
						</div>
					</td>
					<td class='center'>
						<i class='material-icons tooltipped' data-position='top' data-tooltip='Numero totale di calciatori acquistabili.' >info</i>
					</td>
				</tr>
				<tr>
					<td style='width:30%'>
						<p style='padding-left:30px'>Composizione rosa</p>
					</td>
					<td style='width:50%'>
						<div class='input-field'>
							<input
							class='validate' placeholder='<?php echo $otcomposizione_squadra?>' type='text' value='<?php echo $otcomposizione_squadra?>' name='N_otcomposizione_squadra' id='input_text' data-length='6' />
						</div>
					</td>
					<td class='center'>
						<i class='material-icons tooltipped' data-position='top' data-tooltip='Esempi: &quot;38806&quot;, &quot;38725&quot;, &quot;38815&quot;,
						&quot;38716&quot;.<br />La somma deve essere uguale al numero dei
						calciatori previsti per questo campionato.' >info</i>
					</td>
				</tr>
				<tr>
					<td style='width:30%'>
						<p style='padding-left:30px'>Schemi di gioco</p>
					</td>
					<td style='width:50%'>
						<div class='input-field'>
							<input
							class='validate' placeholder='<?php echo $otschemi?>' type='text' value='<?php echo $otschemi?>' name='N_otschemi' id='input_text' data-length='100' />
						</div>
					</td>
					<td class='center'>
						<i class='material-icons tooltipped' data-position='top' data-tooltip='Gli schemi di gioco utilizzabili. Gli schemi a 5 numeri servono
						solo se si usano i fantasisti.<br />Si possono aggiungere o togliere
						schemi, <b>separati con un trattino</b>: <br />1343-1352-1451-1442-1433-1541-1532-13403-13502-14501-14402-14303-15401-15302' >info</i>
					</td>
				</tr>
				<tr>
					<td style='width:30%'>
						<p style='padding-left:30px'>Numero panchinari</p>
					</td>
					<td style='width:50%'>
						<div class='input-field'>
							<input
							class='validate' placeholder='<?php echo $otmax_in_panchina?>' type='text' value='<?php echo $otmax_in_panchina?>' name='N_otmax_in_panchina' id='input_text' data-length='2' />
						</div>
					</td>
					<td class='center'>
						<i class='material-icons tooltipped' data-position='top' data-tooltip='Numero di calciatori in panchina.' >info</i>
					</td>
				</tr>
				
				<?php
					
					$checkSI = ""; $checkNO = "";
					if ($otpanchina_fissa == "SI") $checkSI = "checked";
					else $checkNO = "checked";
					
					echo "<tr>
					<td style='width:30%'><p style='padding-left:30px'>Panchina fissa</p></td>
					<td style='width:50%' class='center'>
					<label>
					<input class='with-gap' type='radio' name='N_otpanchina_fissa' value='SI' $checkSI />
					<span>SI&nbsp;</span>
					</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label>
					<input class='with-gap' type='radio' name='N_otpanchina_fissa' value='NO' $checkNO />
					<span>NO</span>
					</label>
					</td>
					<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Impostare su <b>SI</b> per avere la panchina fissa bloccata per
					ruolo, altrimenti <b>NO</b> per averla libera.' >info</i></td>
					</tr>";
					
				?>
				
				<tr>
					<td style='width:30%'>
						<p style='padding-left:30px'>Numero sostituzioni</p>
					</td>
					<td style='width:50%'>
						<div class='input-field'>
							<input
							class='validate' placeholder='<?php echo $otmax_entrate_dalla_panchina?>' type='text' value='<?php echo $otmax_entrate_dalla_panchina?>' name='N_otmax_entrate_dalla_panchina' id='input_text' data-length='2' />
						</div>
					</td>
					<td class='center'>
						<i class='material-icons tooltipped' data-position='top' data-tooltip='Numero di calciatori in panchina che possono essere utilizzati
						per sostituire i titolari.' >info</i>
					</td>
				</tr>
				
				<?php
					
					$checkSI = ""; $checkNO = "";
					if ($otsostituisci_per_ruolo == "SI") $checkSI = "checked";
					else $checkNO = "checked";
					
					echo "<tr>
					<td style='width:30%'><p style='padding-left:30px'>Sostituzione per ruolo</p></td>
					<td style='width:50%' class='center'>
					<label>
					<input class='with-gap' type='radio' name='N_otsostituisci_per_ruolo' value='SI' $checkSI />
					<span>SI&nbsp;</span>
					</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label>
					<input class='with-gap' type='radio' name='N_otsostituisci_per_ruolo' value='NO' $checkNO />
					<span>NO</span>
					</label>
					</td>
					<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Nel caso in cui un titolare non prenda voto, la sostituzione con
					il panchinaro avviene per ruolo.' >info</i></td>
					</tr>";
					
					$checkSI = ""; $checkNO = "";
					if ($otsostituisci_per_schema == "SI") $checkSI = "checked";
					else $checkNO = "checked";
					
					echo "<tr>
					<td style='width:30%'><p style='padding-left:30px'>Sostituzione per schema</p></td>
					<td style='width:50%' class='center'>
					<label>
					<input class='with-gap' type='radio' name='N_otsostituisci_per_schema' value='SI' $checkSI />
					<span>SI&nbsp;</span>
					</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label>
					<input class='with-gap' type='radio' name='N_otsostituisci_per_schema' value='NO' $checkNO />
					<span>NO</span>
					</label>
					</td>
					<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Qualora la sostituzione per ruolo non sia sufficiente,
					verr&agrave; effettua la sostituzione per schema.' >info</i></td>
					</tr>";
					
					$checkSI = ""; $checkNO = "";
					if ($otmodificatore_difesa == "SI") $checkSI = "checked";
					else $checkNO = "checked";
					
					echo "<tr>
					<td style='width:30%'><p style='padding-left:30px'>Modificatore difesa</p></td>
					<td style='width:50%' class='center'>
					<label>
					<input class='with-gap' type='radio' name='N_otmodificatore_difesa' value='SI' $checkSI />
					<span>SI&nbsp;</span>
					</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label>
					<input class='with-gap' type='radio' name='N_otmodificatore_difesa' value='NO' $checkNO />
					<span>NO</span>
					</label>
					</td>
					<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Impostazione per il calcolo del punteggio con modificatore
					difesa.' >info</i></td>
					</tr>";
					
					$checkSI = ""; $checkNO = "";
					if ($otsostituisci_fantasisti_come_centrocampisti == "SI") $checkSI = "checked";
					else $checkNO = "checked";
					
					echo "<tr>
					<td style='width:30%'><p style='padding-left:30px'>Fantasisti come
					centrocampisti</p></td>
					<td style='width:50%' class='center'>
					<label>
					<input class='with-gap' type='radio' name='N_otsostituisci_fantasisti_come_centrocampisti' value='SI' $checkSI />
					<span>SI&nbsp;</span>
					</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label>
					<input class='with-gap' type='radio' name='N_otsostituisci_fantasisti_come_centrocampisti' value='NO' $checkNO />
					<span>NO</span>
					</label>
					</td>
					<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Impostazione utilizzata qualche anno fa. Attualmente non
					influente.' >info</i></td>
					</tr>";
					
				?>
				
				<tr>
					<td style='width:30%'>
						<p style='padding-left:30px'>Messaggeria</p>
					</td>
					<td style='width:50%'>
						<div class='input-field'>
							<select name="N_ottemp1">
								<option value="0" <?php if($ottemp1 == "0") echo "selected"; ?>>Pubblica</option>
								<option value="1" <?php if($ottemp1 == "1") echo "selected"; ?>>Privata</option>
							</select>
						</div>
					</td>
					<td class='center'>
						<i class='material-icons tooltipped' data-position='top' data-tooltip='Pubblica condivide i messaggi con tutti i tornei, privata
						&egrave; ristretta al singolo torneo.' >info</i>
					</td>
				</tr>
				<tr>
					<td style='width:30%'>
						<p style='padding-left:30px'>Quota cassa</p>
					</td>
					<td style='width:50%'>
						<div class='input-field'>
							<input
							class='validate' placeholder='<?php echo $otquotacassa?>' type='text' value='<?php echo $otquotacassa?>' name='N_otquotacassa' id='input_text' data-length='4' />
						</div>
					</td>
					<td class='center'>
						<i class='material-icons tooltipped' data-position='top' data-tooltip='Quota di partecipazione per ogni singolo giocatore.' >info</i>
					</td>
				</tr>   
				<?php
					if ($otmercato_libero == "SI") {
						echo "<tr>
						<td style='width:30%'><p style='padding-left:30px'>Numero totale di cambi</p></td>
						<td style='width:50%'><div class='input-field'><input
						class='validate' placeholder='$otnumero_cambi_max' type='text' value='$otnumero_cambi_max' name='N_otnumero_cambi_max' id='input_text' data-length='2' /></div></td>
						<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Numero di cambi totali che si possono effettuare in una stagione.' >info</i></span></td>
						</tr>
						
						<tr>
						<td style='width:30%'><p style='padding-left:30px'>Numero dei cambi nel mercato di riparazione</p></td>
						<td style='width:50%'><div class='input-field'><input
						class='validate' placeholder='$otrip_cambi_numero' type='text' value='$otrip_cambi_numero' name='N_otrip_cambi_numero' id='input_text' data-length='2' /></div></td>
						<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Numero di cambi extra che si possono effettuare una-tantum in fase di mercato di riparazione. <br><b>Impostare a 0 per disabilitare il mercato di riparazione.</b>' >info</i></span></td>
						</tr>
						
						<tr>
						<td style='width:30%'><p style='padding-left:30px'>Durata mercato di riparazione</p></td>
						<td style='width:50%'><div class='input-field'><input
						class='validate' placeholder='$otrip_cambi_giornate' type='text' value='$otrip_cambi_giornate' name='N_otrip_cambi_giornate' id='input_text' data-length='30' /></div></td>
						<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Giornate dopo le quali &egrave; possibile effettuare il mercato di riparazione, separate da un trattino.<br> Ad esempio: <b>8-14-20-26-32</b>.' >info</i></span></td>
						</tr>
						
						<tr>
						<td style='width:30%'><p style='padding-left:30px'>Durata mercato di riparazione</p></td>
						<td style='width:50%'><div class='input-field'><select name='N_otrip_cambi_durata'>
						<option value='0'";
						if ($otrip_cambi_durata == "0")
						echo "selected";
						echo " > Una giornata</option>
						<option value='1'";
						if ($otrip_cambi_durata == "1")
						echo "selected";
						echo " > Due giornate</option>
						</select></div></td>
						<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Indica se il mercato di riparazione dura una giornata, o due come da regolamento Gazzetta.' >info</i></span></td>
						</tr>";
					} 
					elseif ($otmercato_libero == "NO") {
						echo "<tr>
						<td style='width:30%'><p style='padding-left:30px'>Asta e scambi: aspetta giorni</p></td>
						<td style='width:50%'><div class='input-field'><input
						class='validate' placeholder='$otaspetta_giorni' type='text' value='$otaspetta_giorni' name='N_otaspetta_giorni' id='input_text' data-length='2' /></div></td>
						<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Indicare 01 per un giorno, 02 per due giorni e cos&igrave; via!' >info</i></span></td>
						</tr>
						
						<tr>
						<td style='width:30%'><p style='padding-left:30px'>Asta e scambi: aspetta ore</p></td>
						<td style='width:50%'><div class='input-field'><input
						class='validate' placeholder='$otaspetta_ore' type='text' value='$otaspetta_ore' name='N_otaspetta_ore' id='input_text' data-length='2' /></div></td>
						<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Indicare 01 per una ora, 02 per due e e cos&igrave; via!' >info</i></span></td>
						</tr>
						
						<tr>
						<td style='width:30%'><p style='padding-left:30px'>Asta e scambi: aspetta minuti</p></td>
						<td style='width:50%'><div class='input-field'><input
						class='validate' placeholder='$otaspetta_minuti' type='text' value='$otaspetta_minuti' name='N_otaspetta_minuti' id='input_text' data-length='2' /></div></td>
						<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Indicare 01 per un minuto, 02 per due e e cos&igrave; via!' >info</i></span></td>
						</tr>
						
						<tr>
						<td style='width:30%'><p style='padding-left:30px'>Numero calciatori scambiabili</p></td>
						<td style='width:50%'><div class='input-field'><input
						class='validate' placeholder='$otnum_calciatori_scambiabili' type='text' value='$otnum_calciatori_scambiabili' name='N_otnum_calciatori_scambiabili' id='input_text' data-length='2' /></div></td>
						<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Indica il totale dei calciatori che &egrave; possibile inserire in una offerta di scambio. <b>0 disabilita gli scambi</b>.' >info</i></span></td>
						</tr>";
						
						$checkSI = "";
						$checkNO = "";
						if ($otreset_scadenza == "SI")
						$checkSI = "checked";
						else
						$checkNO = "checked";
						echo "<tr><td>Reset timer asta</td><td align='center'>SI&nbsp;<input type='radio' name='N_otreset_scadenza' value='SI' $checkSI />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO&nbsp;<input type='radio' name='N_otreset_scadenza' value='NO' $checkNO /></td><td>Impostazione che consente di resettare il timer dopo un rilancio dell'offerta.</td></tr>";
						
						$checkSI = "";
						$checkNO = "";
						if ($otscambio_con_soldi == "SI")
						$checkSI = "checked";
						else
						$checkNO = "checked";
						echo "<tr><td>Offerta scambio con crediti</td><td align='center'>SI&nbsp;<input type='radio' name='N_otscambio_con_soldi' value='SI' $checkSI />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO&nbsp;<input type='radio' name='N_otscambio_con_soldi' value='NO' $checkNO /></td><td>Impostazione che consente di inserire anche dei fantacrediti nelle offerte di scambio.</td></tr>";
						
						$checkSI = "";
						$checkNO = "";
						if ($otvendi_costo == "SI")
						$checkSI = "checked";
						else
						$checkNO = "checked";
						echo "<tr><td>Vendita al costo</td><td align='center'>SI&nbsp;<input type='radio' name='N_otvendi_costo' value='SI' $checkSI />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO&nbsp;<input type='radio' name='N_otvendi_costo' value='NO' $checkNO /></td><td>Indica il comportamento in caso di vendita di un calciatore: SI vende al costo di acquisto, NO vende alla valutazione attuale.</td></tr>";
						
						echo "<tr>
						<td>Percentuale di vendita sul prezzo</td>
						<td align='center'><input name='N_otpercentuale_vendita' type='text' value='$otpercentuale_vendita' size='3' maxlength='3' /></td>
						<td align='left'>Indica il deprezzamento che subisce un calciatore in caso di vendita.</td>
						</tr>";
					}
					
					if ($ottipo_calcolo == "P" or $ottipo_calcolo == "S") {
						echo "<tr>
						<td style='width:30%'><p style='padding-left:30px'>Soglia punteggio primo gol</p></td>
						<td style='width:50%'><div class='input-field'><input
						class='validate' placeholder='$otsoglia_voti_primo_gol' type='text' value='$otsoglia_voti_primo_gol' name='N_otsoglia_voti_primo_gol' id='input_text' data-length='2' /></div></td>
						<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='La fantamedia necessaria per assegnare il primo gol della partita.' >info</i></span></td>
						</tr>
						
						<tr>
						<td style='width:30%'><p style='padding-left:30px'>Differenza gol successivi</p></td>
						<td style='width:50%'><div class='input-field'><input
						class='validate' placeholder='$otincremento_voti_gol_successivi' type='text' value='$otincremento_voti_gol_successivi' name='N_otincremento_voti_gol_successivi' id='input_text' data-length='2' /></div></td>
						<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Valore di scarto nel punteggio tra la prima rete realizzata e le successive.' >info</i></span></td>
						</tr>
						
						<tr>
						<td style='width:30%'><p style='padding-left:30px'>Punteggio bonus in casa</p></td>
						<td style='width:50%'><div class='input-field'><input
						class='validate' placeholder='$otvoti_bonus_in_casa' type='text' value='$otvoti_bonus_in_casa' name='N_otvoti_bonus_in_casa' id='input_text' data-length='2' /></div></td>
						<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Punteggio bonus aggiunto alla somma totale della squadra che gioca in casa.' >info</i></span></td>
						</tr>
						
						<tr>
						<td style='width:30%'><p style='padding-left:30px'>Punti per partita vinta</p></td>
						<td style='width:50%'><div class='input-field'><input
						class='validate' placeholder='$otpunti_partita_vinta' type='text' value='$otpunti_partita_vinta' name='N_otpunti_partita_vinta' id='input_text' data-length='2' /></div></td>
						<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Punti ottenuti in classifica per la vittoria di una partita.' >info</i></span></td>
						</tr>
						
						<tr>
						<td style='width:30%'><p style='padding-left:30px'>Punti per partita pareggiata</p></td>
						<td style='width:50%'><div class='input-field'><input
						class='validate' placeholder='$otpunti_partita_pareggiata' type='text' value='$otpunti_partita_pareggiata' name='N_otpunti_partita_pareggiata' id='input_text' data-length='2' /></div></td>
						<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Punti ottenuti in classifica per il pareggio di una partita.' >info</i></span></td>
						</tr>
						
						<tr>
						<td style='width:30%'><p style='padding-left:30px'>Punti per partita persa</p></td>
						<td style='width:50%'><div class='input-field'><input
						class='validate' placeholder='$otpunti_partita_persa' type='text' value='$otpunti_partita_persa' name='N_otpunti_partita_persa' id='input_text' data-length='2' /></div></td>
						<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Punti ottenuti in classifica per la sconfitta in una partita.' >info</i></span></td>
						</tr>
						
						<tr>
						<td style='width:30%'><p style='padding-left:30px'>Gol differenza punti a partita</p></td>
						<td style='width:50%'><div class='input-field'><input
						class='validate' placeholder='$otdifferenza_punti_a_parita_gol' type='text' value='$otdifferenza_punti_a_parita_gol' name='N_otdifferenza_punti_a_parita_gol' id='input_text' data-length='2' /></div></td>
						<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Aggiunge un gol alla squadra vincitrice di una partita. <br>Questo accade se la differenza tra i due punteggi &egrave; almeno pari al valore indicato.' >info</i></span></td>
						</tr>
						
						<tr>
						<td style='width:30%'><p style='padding-left:30px'>Gol differenza punti zero a zero</p></td>
						<td style='width:50%'><div class='input-field'><input
						class='validate' placeholder='$otdifferenza_punti_zero_a_zero' type='text' value='$otdifferenza_punti_zero_a_zero' name='N_otdifferenza_punti_zero_a_zero' id='input_text' data-length='2' /></div></td>
						<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Aggiunge un gol, in caso di 0-0, alla squadra con il punteggio più alto.<br>Questo accade se la differenza tra i due punteggi &egrave; almeno pari al valore indicato.' >info</i></span></td>
						</tr>
						
						<tr>
						<td style='width:30%'><p style='padding-left:30px'>Numero minimo titolari in formazione</p></td>
						<td style='width:50%'><div class='input-field'><input
						class='validate' placeholder='$otmin_num_titolari_in_formazione' type='text' value='$otmin_num_titolari_in_formazione' name='N_otmin_num_titolari_in_formazione' id='input_text' data-length='2' /></div></td>
						<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Numero minimo dei titolari necessari per schierare la formazione prima di una giornata.' >info</i></span></td>
						</tr>";
						
						if ($ottipo_calcolo == "P") {
							echo "<tr>
							<td style='width:30%'><p style='padding-left:30px'>Punti pareggio</p></td>
							<td style='width:50%'><div class='input-field'><select name='N_otpunti_pareggio'>
							<option value='M'";
							if ($otpunti_pareggio == "M")
							;
							echo " > Media</option>
							<option value='A'";
							if ($otpunti_pareggio == "A")
							echo "selected";
							echo " > Alta</option>
							<option value='B'";
							if ($otpunti_pareggio == "B")
							;
							echo " > Bassa</option>
							</select></div></td>
							<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Dati per i campionati a punti per posizione di giornata. Solo con campionato a <u>P</u>unti.<br> Impostare per la media, per i punti della posizione pi&ugrave; alta o per quelli della pi&ugrave; bassa.' >info</i></span></td>
							</tr>
							
							<tr>
							<td style='width:30%'><p style='padding-left:30px'>Punti per posizionamento</p></td>
							<td style='width:50%'><div class='input-field'><input
							class='validate' placeholder='$otpunti_pos' type='text' value='$otpunti_pos' name='N_otpunti_pos' id='input_text' data-length='30' /></div></td>
							<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Indicare i punti da assegnare separandoli con un trattino. Variare a seconda del numero di giocatori.<br />Esempio: <b>10-8-6-5-4-2-1-0</b>.' >info</i></span></td>
							</tr>";
						}
					}
					echo "</table></div>
					<div class='card-action center'>
					<input type='hidden' name='inserimento' value='scrivi' />
					<button type='submit' name='Submit' class='btn waves-effect waves-light green'>Salva le modifiche</button>
					</div>
					</form></div></div></div>";
				}
			} #fine else if ($inserimento == "scrivi") {
			echo "</div></div></div></div></div></div>";
		} # fine if ($_SESSION["utente"]
		else header("location:./logout.php");
		$smarty->assign("TorneiTabella", $lista_tornei); # $giocatore è la variabile con il compito di far vedere l'elenco calciatori
		$smarty->display('a_torneo.tpl');
	?>							