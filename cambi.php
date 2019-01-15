<?php
// #################################################################################
// FANTACALCIOBAZAR EVOLUTION
// Copyright (C) 2003-2011 by Antonello Onida
//
// This program is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
// #################################################################################
require_once ("./controlla_pass.php");
include ("./header.php");

if ($_SESSION ['valido'] == "SI") {
	// include("./menu.php");
	
	$nome_squadra = $_SESSION ['utente'];
	$chiusura_giornata = ( int ) @file ( $percorso_cartella_dati . "/chiusura_giornata.txt" );
	$ultima_giornata = 0;
	tabella_squadre ();
	// #####################################
	// #### Controlla numero ultima giornata
	
	for($num1 = 1; $num1 < 40; $num1 ++) {
		if (strlen ( $num1 ) == 1)
			$num1 = "0" . $num1;
		if (@is_file ( $percorso_cartella_dati . "/giornata" . $num1 . "_" . $_SESSION ['torneo'] . "_" . $_SESSION ['serie'] ))
			$ultima_giornata = $num1;
		else
			break;
	} // fine for $num1
	
	if ($diff_num_giornata_file > 0)
		$voti_ultima_giornata = $ultima_giornata + $diff_num_giornata_file;
	else
		$voti_ultima_giornata = $ultima_giornata;
	
	if (strlen ( $voti_ultima_giornata ) == 1)
		$voti_ultima_giornata = "0" . $voti_ultima_giornata;
	$frase_ug = "Ultima giornata giocata: $ultima_giornata - Serie A: $voti_ultima_giornata";
	
	if ($voti_ultima_giornata - $ultima_giornata != $diff_num_giornata_file) {
		echo "Errore configurazione giornate!<br/$voti_ultima_giornata - $ultima_giornata != $diff_num_giornata_file";
		die ();
	}
	
	// ##############################
	if ($chiusura_giornata != 1 and $ultima_giornata > 0) {
		
		if ($stato_mercato == "A") {
			
			$adesso = date ( "d/m/Y H:i" );
			$valuta_saldo = 0;
			
			$calciatori = @file ( $percorso_cartella_dati . "/mercato_" . $_SESSION ['torneo'] . "_" . $_SESSION ['serie'] . ".txt" );
			$num_calciatori = count ( $calciatori );
			
			$ordinamento = 0;
			function cmp1($a, $b) {
				global $ordinamento;
				return strcmp ( $a [$ordinamento], $b [$ordinamento] );
			}
			usort ( $calciatori, "cmp1" );
			
			$tab_comprati = "";
			$soldi_spesi = 0;
			$num_calciatori_posseduti = 0;
			
			for($num1 = 0; $num1 < $num_calciatori; $num1 ++) {
				
				$dati_calciatore = explode ( ",", $calciatori [$num1] );
				
				if (count ( $dati_calciatore ) >= 6) {
					$numero = $dati_calciatore [0];
					$nome = $dati_calciatore [1];
					$nome = ereg_replace ( "\"", "", $nome );
					$nome = htmlentities ( $nome, ENT_QUOTES );
					$ruolo = $dati_calciatore [2];
					$costo = $dati_calciatore [3];
					$proprietario = $dati_calciatore [4];
					
					if ($proprietario == $nome_squadra) {
						$soldi_spesi = $soldi_spesi + $dati_calciatore [3];
						$num_calciatori_posseduti ++;
						
						// ####################
						
						if ($ultima_giornata > 0)
							$percorso = "$percorso_cartella_voti/voti$voti_ultima_giornata.txt";
						else
							$percorso = "dati/calciatori.txt";
						
						$cerca_valutazione = @file ( $percorso );
						$num_cer_val = count ( $cerca_valutazione );
						
						for($num2 = 0; $num2 < $num_cer_val; $num2 ++) {
							$dati_cervalcal = explode ( $separatore_campi_file_calciatori, $cerca_valutazione [$num2] );
							$num_cervalcal = $dati_cervalcal [($num_colonna_numcalciatore_file_calciatori - 1)];
							$num_cervalcal = togli_acapo ( $num_cervalcal );
							
							if ($ultima_giornata > 0)
								$stat_attivo = $dati_cervalcal [($ncs_attivo - 1)];
							
							if ($num_cervalcal == $numero) {
								$valutazione = $dati_cervalcal [($num_colonna_valore_calciatori - 1)];
								$valutazione = togli_acapo ( $valutazione );
								$valore_squadra = $valore_squadra + $valutazione;
								break;
							}
						}
						// ####################
						
						if ($stato_mercato != "I")
							$offri = "<form method='post' action='valuta.php'>
					<input type='hidden' name='ins_val_ces' value='SI' />
					<input type='hidden' name='num_cal' value='$numero' />
					<input type='hidden' name='nome' value='$nome' />
					<input type='hidden' name='ruolo' value='$ruolo' />
					<input type='hidden' name='costo' value='$costo' />
					<input type='hidden' name='val_cal' value='$valutazione' />";
						// $offri = "<a href='valuta.php?ins_val_ces=SI&amp;num_cal=$numero&amp;nome=$nome&amp;ruolo=$ruolo&amp;costo=$costo&amp;val_cal=$valutazione' class='user'>seleziona</a>";
						else
							$offri = "<b>Fase preliminare</b>";
						
						if ($stat_attivo == "0" and $trasferiti_ok == "SI") {
							$csattivo = " - <font color=red class='piccolo'>Trasferito</font>";
							$offri .= "<input type='image' src='immagini/ok_no.png' disabled='disabled' /></form>";
						} else {
							$offri .= "<input type='image' src='immagini/ok.png' name='submit' alt='Seleziona calciatore per cambio' /></form>";
							$csattivo = "";
						}
						
						if ($ruolo == "D" or $ruolo == "A")
							$bgcolore = "$colore_riga_alt";
						else
							$bgcolore = "#FFFFFF";
						
						$tab_comprati .= "<tr bgcolor='$bgcolore'>
				<td align='left' class='mdl-data-table__cell--non-numeric'><b>$ruolo - </b>" . stripslashes ( $nome ) . " $csattivo</td>
				<td align='center' class='corpo'>$costo</td>
				<td align='center' class='corpo'>$valutazione</td>
				<td align='center' class='corpo'>$offri</td></tr>";
					} // fine if ($proprietario == $nome_squadra] )
				} // fine if (count($dati_calciatore) >= 6)
			} // fine for $num1
			
			echo "<div class='mdl-grid'>";
			require ("./widget.php");
			echo "<div class='mdl-cell mdl-cell--9-col'>
                      <div class='bread'><a href='./mercato.php'>Gestione</a> / Cambi calciatori</div>
	                  <table class='mdl-data-table mdl-shadow--2dp' style='width:100%' cellpadding='10' cellspacing='0' id='t1' class='sortable'>
	                      <caption>Procedura Cambi - $nome_squadra</caption>
	                      <tr>
                              <td>
                                  <div class='mdl-grid'><center>E' possibile valutare i cambi da effettuare. <br>Puoi simulare i cambi selezionando i tuoi calciatori dal box di sinistra e scegliendo quelli da acquistare nel box di sopra.</center>
                                      <div class='mdl-cell mdl-cell--6-col'>
	                                      <table summary='Cambi' width='100%' cellspacing='0' cellpadding='0' class='mdl-data-table mdl-shadow--2dp' >
	                                          <tr>
                                                  <td class='testa'>Nome</td>
	                                              <td class='testa'>Costo</td>
	                                              <td class='testa'>Valore</td>
	                                              <td class='testa'>&nbsp;</td>
                                              </tr>
	                                          $tab_comprati
			                              </table>
                                      </div>";
			
			// ######################################
			// ## seconda colonna
			
			echo "<div class='mdl-cell mdl-cell--6-col'>
            <table class='mdl-data-table mdl-shadow--2dp' summary='Cambi' cellpadding='1' width='100%'>";
			
			$num_calciatori_comprabili = $max_calciatori - $num_calciatori_posseduti;
			
			$filep = file ( $percorso_cartella_dati . "/utenti_" . $_SESSION ['torneo'] . ".php" );
			@list ( $outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg ) = explode ( "<del>", $filep [$_SESSION ['uid']] );
			
			$surplus = INTVAL ( $ocrediti );
			$variazioni = INTVAL ( $ovariazioni );
			$cambi_effettuati = INTVAL ( $ocambi );
			$cambi_extra = 0;
			$soldi_spendibili = $soldi_iniziali + $variazioni + $surplus - $soldi_spesi;
			$valuta_saldo = $valuta_saldo + $soldi_spendibili;
			
			echo "<tr><td>Oggi &egrave; $adesso<br/>$frase_ug<br/><br/>";
			if ($num_calciatori_posseduti != $max_calciatori)
				echo "<b>Attenzione!!!<br/>Rosa non completa!</b><br/>";
			
			if ($rip_cambi_numero != 0) {
				$numgiorip = count ( $rip_cambi_giornate );
				for($num1 = 0; $num1 < $numgiorip; $num1 ++) {
					if ($ultima_giornata == $rip_cambi_giornate [$num1] or $ultima_giornata == ($rip_cambi_giornate [$num1] + $rip_cambi_durata)) {
						echo "<b><font class='evidenziato'><u>Giornata di riparazione</u><br/>Solo per questa giornata<br/>sono concessi <b><u>$rip_cambi_numero</u></b> cambi extra.</font></b><br/><br/>";
						
						if (@is_file ( "$percorso_cartella_dati/cce_" . $_SESSION ['torneo'] . "_" . $_SESSION ['serie'] . ".txt" )) {
							$controllo_cambi_extra = @file ( "$percorso_cartella_dati/cce_" . $_SESSION ['torneo'] . "_" . $_SESSION ['serie'] . ".txt" );
							$righe_cce = count ( $controllo_cambi_extra );
							$cambi_extra_cce = 0;
							
							for($numcce = 0; $numcce < $righe_cce; $numcce ++) {
								$dati_cce = explode ( ",", $controllo_cambi_extra [$numcce] );
								$cce_nomeutente = $dati_cce [0];
								$cce_usati = $dati_cce [1];
								
								if ($_SESSION ['utente'] == $cce_nomeutente) {
									$cambi_extra_cce = $cambi_extra_cce + $cce_usati;
									// echo "$cambi_extra_cce - $cce_usati<br/>";
									if ($cambi_extra_cce <= 0)
										$cambi_extra_cce = 0;
								} // fine if
							} // fine for
							$frase_cce = "<b>Hai gi&agrave; utilizzato n. $cambi_extra_cce cambi extra</b>";
							$cambi_extra = $rip_cambi_numero - $cambi_extra_cce;
						} else
							$cambi_extra = $rip_cambi_numero;
					}
				}
			} // fine if ($rip_cambi_numero != 0)
			
			$cambi_residui = $numero_cambi_max - $cambi_effettuati + $cambi_extra;
			
			echo "Budget iniziale: <b>$soldi_iniziali</b><br/>
		Valore rosa attuale: <b>$valore_squadra</b><br/>
		FantaEuro residui: <b>$valuta_saldo</b> ($variazioni)<br/><br/>

		Cambi totali: $numero_cambi_max<br/>
		Cambi effettuati: $cambi_effettuati<br/>";
			
			if ($cambi_extra != 0)
				echo "<font class='evidenziato'>Cambi extra: $cambi_extra</font><br/>";
			if ($frase_cce)
				echo "<font class='evidenziato'>$frase_cce</font><br/>";
			echo "Cambi residui: $cambi_residui</td></tr>";
			
			// ################################
			// ## Form cerca giocatore
			
			$val_cal = 0;
			$cerca_giocatore = "<hr /><font color='red'>Non hai selezionato alcun calciatore da scambiare.</font>";
			if ($num_calciatore)
				$num_ricerca = $num_calciatore;
			
			$tabella_attuali = "<tr><td><u>Saldo FantaEuro</u></td>
		<td align='center'>&nbsp;</td>
		<td align='center'>&nbsp;</td>
		<td align='center'>&nbsp;</td>
		<td align='center'>$valuta_saldo</td></tr>
		<tr><td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td></tr>";
			
			echo "<td valign='top' align='center'><b>Valutazione acquisti</b><br/><br/>Cerca:
		<a href='tab_calciatori.php?ruolo_guarda=P' class='user'><b>&nbsp;P&nbsp;</b></a> -
		<a href='tab_calciatori.php?ruolo_guarda=D' class='user'><b>&nbsp;D&nbsp;</b></a> -
		<a href='tab_calciatori.php?ruolo_guarda=C' class='user'><b>&nbsp;C&nbsp;</b></a> - ";
			
			if ($considera_fantasisti_come == "F")
				echo "<a href='tab_calciatori.php?ruolo_guarda=F' class='user'><b>&nbsp;F&nbsp;</b></a> - ";
			
			echo "<a href='tab_calciatori.php?ruolo_guarda=A' class='user'><b>&nbsp;A&nbsp;</b></a><br/><br/>";
			echo "<form method='post' action='cambi.php'>
		<input type='submit' name='vedi' value='Vedi' />
		 Cerca giocatore
		<input type='text' name='num_ricerca' size='3' /></form>";
			
			if ($num_ricerca) {
				if ($ultima_giornata > 0)
					$percorso = $percorso_cartella_voti . "/voti" . $voti_ultima_giornata . ".txt";
				else
					$percorso = $percorso_cartella_dati . "/calciatori.txt";
				$calciatori_completi = file ( $percorso );
				$num_calciatori_completi = count ( $calciatori_completi );
				
				for($num1 = 0; $num1 < $num_calciatori_completi; $num1 ++) {
					$dati_calciatore = explode ( $separatore_campi_file_calciatori, $calciatori_completi [$num1] );
					$numero = $dati_calciatore [($num_colonna_numcalciatore_file_calciatori - 1)];
					$numero = trim ( $numero );
					if ($numero == $num_ricerca) {
						$nome = $dati_calciatore [($num_colonna_nome_file_calciatori - 1)];
						$nome = togli_acapo ( $nome );
						$nome = ereg_replace ( "\"", "", $nome );
						$nome = htmlentities ( $nome, ENT_QUOTES );
						$s_ruolo = $dati_calciatore [($num_colonna_ruolo_file_calciatori - 1)];
						$s_ruolo = togli_acapo ( $s_ruolo );
						$ruolo = $s_ruolo;
						if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A")
							$considera_fantasisti_come = "F";
						if ($s_ruolo == $simbolo_fantasista_file_calciatori)
							$ruolo = $considera_fantasisti_come;
						if ($s_ruolo == $simbolo_portiere_file_calciatori)
							$ruolo = "P";
						if ($s_ruolo == $simbolo_difensore_file_calciatori)
							$ruolo = "D";
						if ($s_ruolo == $simbolo_centrocampista_file_calciatori)
							$ruolo = "C";
						if ($s_ruolo == $simbolo_attaccante_file_calciatori)
							$ruolo = "A";
						$valore = $dati_calciatore [($num_colonna_valore_calciatori - 1)];
						$valore = togli_acapo ( $valore );
						$xsquadra = $dati_calciatore [($num_colonna_squadra_file_calciatori - 1)];
						$xsquadra = togli_acapo ( $xsquadra );
						$xsquadra = ereg_replace ( "\"", "", $xsquadra );
						$cerca_giocatore = "<table summary='Cambi' align='center' cellpadding='5'><tr><td>$numero - <a href='valuta.php?ins_val_acq=SI&amp;num_cal=$numero&amp;nome=$nome&amp;ruolo=$ruolo&amp;val_cal=$valore' class='user'><b style='color: red;'>$nome</b></a><br/>Valutazione: $valore - $ruolo - $xsquadra</td></tr><tr><td class='testa'>clicca sul nome <br>per selezionare</td></tr></table>";
						break;
					} // fine if ($num_ricerca == $numero)
				} // fine for $num1
			}
			
			echo "$cerca_giocatore
		</td></tr></table>";
			
			// ##################################
			
			if (@is_file ( "$percorso_cartella_dati/cambi_$nome_squadra" ))
				$vedi_valuta = @file ( "$percorso_cartella_dati/cambi_$nome_squadra" );
			$righe_valuta = count ( $vedi_valuta );
			
			for($num1 = 0; $num1 < $righe_valuta; $num1 ++) {
				
				$dati_valuta = explode ( ",", $vedi_valuta [$num1] );
				$valuta_numero = $dati_valuta [0];
				$valuta_numero = togli_acapo ( $valuta_numero );
				
				$valuta_nome = $dati_valuta [1];
				$valuta_nome = togli_acapo ( $valuta_nome );
				$valuta_nome = stripslashes ( $valuta_nome );
				$valuta_nome = ereg_replace ( "\"", "", $valuta_nome );
				
				$valuta_ruolo = $dati_valuta [2];
				$valuta_ruolo = togli_acapo ( $valuta_ruolo );
				
				$valuta_costo = $dati_valuta [3];
				$valuta_costo = togli_acapo ( $valuta_costo );
				
				$valuta_valore = $dati_valuta [4];
				$valuta_valore = togli_acapo ( $valuta_valore );
				
				$valuta_status = $dati_valuta [5];
				$valuta_status = togli_acapo ( $valuta_status );
				
				if ($valuta_status == 0) {
					$vedi = "Cessione";
					$font_color = "navy";
					$link = "<a href='valuta.php?eli_val=SI&amp;num_cal=$valuta_numero' class='user'><b>X</b></a> $valuta_ruolo <a href='stat_calciatore.php?num_calciatore=$valuta_numero&amp;ruolo_guarda=$ruolo_guarda' class='user'><font color='$font_color'>$valuta_nome</font></a>";
					$valuta_saldo = $valuta_saldo + $valuta_valore;
				}
				
				if ($valuta_status == 1) {
					$vedi = "Acquisto";
					$font_color = "green";
					$link = "<a href='valuta.php?eli_val=SI&amp;num_cal=$valuta_numero' class='user'><b>X</b></a> $valuta_ruolo <a href='stat_calciatore.php?num_calciatore=$valuta_numero&amp;ruolo_guarda=$ruolo_guarda' class='user'><font color='$font_color'>$valuta_nome</font></a>";
					$valuta_saldo = $valuta_saldo + $valuta_valore;
				}
				if ($valuta_status != 0 and $valuta_status != 1)
					$vedi = "Errore!";
				
				$tabella_attuali .= "<tr><td align='left'><font color='$font_color'>$link</font></td>
		<td align='center'><font color='$font_color'>$valuta_costo</font></td>
		<td align='center'><font color='$font_color'>$valuta_valore</font></td>
		<td align='center'><font color='$font_color'>$vedi</font></td>
		<td align='center'><font color='$font_color'>$valuta_saldo</font></td></tr>";
			} // fine for $num1
			
			echo "<br/><table summary='Cambi' cellpadding='3' width='100%'>
		<tr><td class='testa'>Nome</td>
		<td class='testa'>Valore</td>
		<td class='testa'>+/-</td>
		<td class='testa'>Status</td>
		<td class='testa'>Saldo</td></tr>";
			
			echo "$tabella_attuali";
			echo "</table>";
			
			if ($cambi_extra != 0)
				echo "<br/><b><font class='evidenziato'>In questa giornata del Campionato si possono effettuare <b><u>$rip_cambi_numero</u></b> cambi extra.<br/>Se non li utilizzi in questa settimana non potrai utilizzarli successivamente.</font></b><br/>";
			
			if (@is_file ( "$percorso_cartella_dati/cambi_$nome_squadra" )) {
				
				$controllo = ( int ) @file ( "$percorso_cartella_dati/cambi_$nome_squadra" );
				if ($controllo != 0)
					echo "<br/><br/><a href='valuta.php?eli_tutti=SI' class='user'><b>X</b></a> - Elimina tutti<br/><br/><font class='evidenziato'><b>Attenzione</b>: la conferma dei cambi &egrave; definitiva ed irreversibile.</font>
		<center>
		<form method='post' action='inserisci_cambi.php'>
		<input type='hidden' name='soldi_spesi' value='$soldi_spesi' />
		<input type='hidden' name='cambi_extra' value='$cambi_extra' />
		<input type='hidden' name='frase_cce' value='$frase_cce' />
		<br><input type='submit' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored' name='conferma' value='Conferma cambi' />
		</form></center>";
			} // fine if (@is_file...
			
			echo "</td></tr></table>";
			echo "<br/><center>
		<form method='post' action='mercato.php'>
		<input type='submit' name='torna_mercato' value='Torna al mercato' />
		</form></center>";
		} // fine if ($stato_mercato != ...

		else
			echo "<CENTER><h3>FASE CAMBI NON DISPONIBILE</h3>
		<br/><br/>";
	} // fine if ($chiusura_giornata != 1)

	else {
		// require ("./menu.php");
		echo "<center><h2>Giornata chiusa</h2></center>";
		echo "<p align='center'>Non &egrave; consentito effettuare operazioni!<br/><br/>Attendere fino a quando viene creata la prossima giornata.</p><br/><br/><br/><br/><br/><br/>";
	}
} // fine if ($_SESSION['valido'] == "SI") {
else
	echo "<meta http-equiv='refresh' content='0; url=logout.php'>";

include ("./footer.php");
?>