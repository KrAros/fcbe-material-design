<?php
	// #################################################################################
	// FANTACALCIOBAZAR EVOLUTION
	// Copyright (C) 2003 - 2011 by Antonello Onida
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
		// require ("./menu.php");
		echo '<script type="text/javascript">
		<!--
		// set the radio button with the given value as being checked
		// do nothing if there are no radio buttons
		// if the given value does not exist, all the radio buttons
		// are reset to unchecked
		function setCheckedValue(radioObj, newValue) {
		if(!radioObj)
		return;
		var radioLength = radioObj.length;
		if(radioLength == undefined) {
		radioObj.checked = (radioObj.value == newValue.toString());
		return;
		}
		for(var i = 0; i < radioLength; i++) {
		radioObj[i].checked = false;
		if(radioObj[i].value == newValue.toString()) {
		radioObj[i].checked = true;
		}
		}
		}
		function ResetOption(selectObj, newValue) {
		if(!selectObj)
		return;
		var optionLength = selectObj.options.length;
		for(var i = 0; i < optionLength; i++) {
		selectObj.options[i].selected = false;
		if(selectObj.options[i].value == newValue.toString()) {
		selectObj.options[i].selected = true;
		}
		}
		}
		//-->
		</script>';
		
		$chiusura_giornata = intval ( @file ( $percorso_cartella_dati . "/chiusura_giornata.txt" ) );
		$data_busta_precedente = @join ( '', @file ( "./dati/data_buste_precedente_" . $_SESSION ['torneo'] . "_0.txt" ) );
		if ($chiusura_giornata != 1) {
			for($num1 = 1; $num1 < 40; $num1 ++) {
				if (strlen ( $num1 ) == 1)
				$num1 = "0" . $num1;
				
				if (@is_file ( $percorso_cartella_voti . "/voti" . $num1 . ".txt" ))
				$ultima_giornata = 0;
				else {
					$ultima_giornata = $num1 - 1;
					if (strlen ( $ultima_giornata ) == 1)
					$ultima_giornata = "0" . $ultima_giornata;
					break;
				} // fine else
			} // fine for $num1
			
			// valorizzazione $cerca per panchina
			$cerca = array ();
			
			if ($ultima_giornata >= 1 and file_exists ( $percorso_cartella_voti . "/voti" . $ultima_giornata . ".txt" ))
			$cerca = @file ( $percorso_cartella_voti . "/voti" . $ultima_giornata . ".txt" );
			else
			$cerca = @file ( $percorso_cartella_dati . "/calciatori.txt" );
			
			$num_calc_cerca = count ( $cerca );
			$dat_calc = array ();
			$dc = array ();
			
			for($num1 = 0; $num1 < $num_calc_cerca; $num1 ++) {
				$dat_calc = explode ( $separatore_campi_file_calciatori, $cerca [$num1] );
				$ndc = $dat_calc [($num_colonna_numcalciatore_file_calciatori - 1)];
				$ndc = trim ( $ndc );
				
				$dc [$ndc] ['gio'] = $dat_calc [1];
				$dc [$ndc] ['nom'] = trim ( stripslashes ( $dat_calc [($num_colonna_nome_file_calciatori - 1)] ) );
				$dc [$ndc] ['nom'] = str_replace ( "\"", "", $dc [$ndc] ['nom'] );
				$dc [$ndc] ['ruo'] = trim ( $dat_calc [($num_colonna_ruolo_file_calciatori - 1)] );
				$dc [$ndc] ['val'] = trim ( $dat_calc [($num_colonna_valore_calciatori - 1)] );
				$dc [$ndc] ['squ'] = trim ( $dat_calc [($num_colonna_squadra_file_calciatori - 1)] );
				$dc [$ndc] ['squ'] = str_replace ( "\"", "", $dc [$ndc] ['squ'] );
				$dc [$ndc] ['att'] = trim ( $dat_calc [($ncs_attivo - 1)] );
			}
			
			if (! $nome_squadra)
			$nome_squadra = $_SESSION ['utente'];
			
			$filei = file ( $percorso_cartella_dati . "/utenti_" . $_SESSION ['torneo'] . ".php" );
			$linee = count ( $filei );
			
			switch ($abilita_stat) {
				case 'AUTO' :
				{
					if (@fopen ( $sito_principale . $cartella_remota . '/_stats', 'r' ))
					$stat_1 = file_get_contents ( $sito_principale . $cartella_remota . '/_stats' );
					else if (@fopen ( $sito_mirror . $cartella_remota . '/_stats', 'r' ))
					$stat_1 = file_get_contents ( $sito_mirror . $cartella_remota . '/_stats' );
					else
					$stat_1 = "";
					break;
				}
				case 'PRINCIPALE' :
				{
					if (@fopen ( $sito_principale . $cartella_remota . '/_stats', 'r' ))
					$stat_1 = file_get_contents ( $sito_principale . $cartella_remota . '/_stats' );
					else
					$stat_1 = "";
					break;
				}
				case 'MIRROR' :
				{
					if (@fopen ( $sito_mirror . $cartella_remota . '/_stats', 'r' ))
					$stat_1 = file_get_contents ( $sito_mirror . $cartella_remota . '/_stats' );
					else
					$stat_1 = "";
					break;
				}
				case 'OFF' :
				{
					$stat_1 = "";
					break;
				}
			}
			
			if (isset ( $stat_1 )) {
				
				$ok_pre = "SI";
				$stat_x = array ();
				$stat_1 = preg_replace ( '/\n/', ' ', $stat_1 );
				$stat_x = unserialize ( $stat_1 );
				if (@! fopen ( './dati/_stats', 'r' )) {
					$stat_2 = fopen ( './dati/_stats', 'w+' );
					fwrite ( $stat_2, "test" );
					fclose ( $stat_2 );
				}
				$dati = array ();
				$fd = file_get_contents ( './dati/_stats' );
				$fd = preg_replace ( '/\n/', ' ', $fd );
				$dati = unserialize ( $fd );
				if ($stat_x != $dati) {
					$stat_2 = fopen ( "./dati/_stats", "w" );
					fwrite ( $stat_2, $stat_1 );
					fclose ( $stat_2 );
					$fd = file_get_contents ( './dati/_stats' );
					$fd = preg_replace ( '/\n/', ' ', $fd );
					$dati = unserialize ( $fd );
				}
			} else
			$ok_pre = "NO";
			
			for($num1 = 1; $num1 < $linee; $num1 ++) {
				@list ( $outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg ) = explode ( "<del>", trim ( $filei [$num1] ) );
				
				if ($nome_squadra == "tutti" or $nome_squadra == $outente) {
					if ($otorneo == $_SESSION ['torneo']) {
						$dati_squadra = @file ( $percorso_cartella_dati . "/squadra_" . $outente );
						$titolo = "<font size='+1'><u>";
						
						if ($osquadra)
						$titolo .= $osquadra;
						else
						$titolo .= "Squadra";
						
						$titolo .= " di $outente</u></font>";
						/*
							* if (substr($ourl,-3) == "jpg" or substr($ourl,-3) == "JPG" or substr($ourl,-3) == "gif" or substr($ourl,-3) == "GIF") {
							* $logo_squadra = $ourl;
							* $titolo .= "<br /><br /><img alt='Logo squadra' src='$logo_squadra' border='1' height='100'/>";
							* } else {
							* $logo_squadra = "./immagini/loghi/$outente.jpg";
							* if (@is_file($logo_squadra)) $titolo .= "<br /><br /><img alt='Logo squadra' src='$logo_squadra' border='1' height='100'/>";
							* }
							* $titolo .= "<br /><br />Presidente: <b>$outente</b>";
						*/
						if ($ocitta)
						$titolo .= "<br />Citt&agrave;: <b>$ocitta</b>";
						
						$titolo .= "<br />Email: <b>$oemail</b>";
						$titolo .= "<br />Torneo: <b>$otorneo</b>";
						$titolo .= "<br />Serie: <b>$oserie</b>";
						$titolo .= "<br />Data iscrizione: $oreg";
						
						if (isset ( $ourl ) and $ourl != "http://")
						$titolo .= "<br />Sito Web: <b>$ourl</b>";
						
						if (file_exists ( $percorso_cartella_dati . "/squadra_" . $outente )) {
							$titolo .= "<br />Ultima modifica formazione: " . date ( "d-m-Y H:i:s.", filemtime ( $percorso_cartella_dati . "/squadra_$outente" ) );
						}
						$cambi_effettuati = INTVAL ( $ocambi );
						$cambi_total = $numero_cambi_max + $cambi_extra;
						$titolo .= "<br />Cambi: $cambi_effettuati su $cambi_total";
						// ################################
						//
						if ($ultima_giornata >= 1 and file_exists ( $percorso_cartella_voti . "/voti$ultima_giornata.txt" ))
						$cerca = @file ( $percorso_cartella_voti . "/voti$ultima_giornata.txt" );
						else
						$cerca = @file ( "$percorso_cartella_dati/calciatori.txt" );
						
						//
						$num_calciatori = count ( $cerca );
						$conta_panca = 0;
						$layout_panchina = "";
						$tab_centro = "";
						$panchina_img = explode ( ",", $dati_squadra [2] );
						//
						$riga_dati_calciatori = - 1;
						
						foreach ( $panchina_img as $valore_panca ) {
							$riga_dati_calciatori = ricerca_binaria ( $cerca, $num_calciatori, $valore_panca );
							//
							if ($riga_dati_calciatori >= 0) {
								$maglia_calciatore = explode ( $separatore_campi_file_calciatori, $cerca [$riga_dati_calciatori] );
								$mnumero = $maglia_calciatore [($num_colonna_numcalciatore_file_calciatori - 1)];
								$mnumero = trim ( $mnumero );
								
								if ($valore_panca == $mnumero) {
									$mnome = stripslashes ( $maglia_calciatore [($num_colonna_nome_file_calciatori - 1)] );
									$mnome = trim ( $mnome );
									$mnome = preg_replace ( "#\"#", "", $mnome );
									if (preg_match ( "#[a-z]#", $mnome, $array ))
									;
									$posizione = strpos ( $mnome, $array [0] );
									// i luigi
									$mnome .= "  ";
									$mnome1 = $mnome;
									// f luigi
									$mnome = substr ( $mnome, 0, strpos ( $mnome, $array [0] ) - 2 );
									$mnome = trim ( $mnome );
									// i luigi
									$mnome1 = substr ( $mnome1, strpos ( $mnome1, $array [0] ) - 1, strlen ( $mnome1 ) );
									$mnome1 = trim ( $mnome1 );
									// f luigi
									$msquadra = $maglia_calciatore [($num_colonna_squadra_file_calciatori - 1)];
									$msquadra = preg_replace ( "#\"#", "", $msquadra );
									$msquadra = trim ( $msquadra );
									// i luigi
									$msquadra = str_replace ( ' ', '_', $msquadra );
									if (file_exists ( "./immagini/m_" . strtolower ( $msquadra ) . ".gif" ))
									$m_squadra = "./immagini/m_" . strtolower ( $msquadra ) . ".gif";
									$layout_panchina .= "<img style='border-radius: 12px;' src=\"$m_squadra\" vspace=\"1\" hspace=\"1\" alt=\"$msquadra\" title=\"$msquadra\" /><br /><div class=\"panchinari\">$mnome</div>";
									$conta_panca ++;
								} // end-if ($valore_panca == $mnumero)
							} // ($riga_dati_calciatori >= 0)
							elseif ($riga_dati_calciatori < 0 and trim ( $valore_panca ) != "") {
								$msquadra = "no_squadra";
								$mnome = "$valore_panca";
								$mnome1 = "";
								if (file_exists ( "./immagini/m_" . strtolower ( $msquadra ) . ".gif" ))
								$m_squadra = "./immagini/m_" . strtolower ( $msquadra ) . ".gif";
								$layout_panchina .= "<img src=\"$m_squadra\" vspace=\"1\" hspace=\"1\" alt=\"$msquadra\" title=\"$msquadra\" /><br /><div class=\"panchinari\">$mnome<br />$mnome1</div><br />\n";
								$conta_panca ++;
							} // end-if ($riga_dati_calciatori < 0 and trim($valore_panca) != "" )
						} // end-foreach ($panchina_img as $valore_panca)
						
						// Fine Panchina
						// ###################################################################
						$contatore_calciatori = 0;
						$soldi_spesi = 0;
						$num_calciatori_posseduti = 0;
						$np = 0;
						$nd = 0;
						$nc = 0;
						$nf = 0;
						$na = 0;
						$tab_offerte = "<table summary='squadra' bgcolor='$sfondo_tab' class='border' width='100%' align='center'>
						<tr><td class='testa'>Numero</td>
						<td class='testa'>Nome giocatore</td>
						<td class='testa'>Ruolo</td>
						<td class='testa'>Costo</td>
						<td class='testa'>Tempo rimasto</td></tr>";
						
						$calciatori = @file ( $percorso_cartella_dati . "/mercato_" . $_SESSION ['torneo'] . "_" . $_SESSION ['serie'] . ".txt" );
						$np = 0;
						$nd = 0;
						$nc = 0;
						$nf = 0;
						$na = 0;
						$num_calciatori = count ( $calciatori );
						$num_calciatori1 = count ( $cerca );
						
						for($num2 = 0; $num2 < $num_calciatori; $num2 ++) {
							$dati_calciatore = explode ( ",", $calciatori [$num2] );
							$numero = $dati_calciatore [0];
							$ruolo = $dati_calciatore [2];
							$proprietario = $dati_calciatore [4];
							
							if ($proprietario == $outente) {
								$soldi_spesi = $soldi_spesi + $dati_calciatore [3];
								$num_calciatori_posseduti ++;
								// #####valutazione
								$a = ricerca_binaria ( $cerca, $num_calciatori1, $numero );
								$b = explode ( $separatore_campi_file_calciatori, $cerca [$a] );
								$val_gio = $b [$ncs_valore - 1];
								$attivo = $b [$ncs_attivo - 1];
								// ######
								if ($ruolo == "P")
								$np ++;
								else if ($ruolo == "D")
								$nd ++;
								else if ($ruolo == "C")
								$nc ++;
								else if ($ruolo == "F")
								$nf ++;
								else if ($ruolo == "A")
								$na ++;
								
								$nome = $dati_calciatore [1];
								$nome = togli_acapo ( $nome );
								$nome = preg_replace ( "#\"#", "", $nome );
								$ruolo = $dati_calciatore [2];
								$costo = $dati_calciatore [3];
								$tempo_off = $dati_calciatore [5];
								$anno_off = substr ( $tempo_off, 0, 4 );
								$mese_off = intval(substr ( $tempo_off, 4, 2 ));
								$giorno_off = substr ( $tempo_off, 6, 2 );
								$ora_off = substr ( $tempo_off, 8, 2 );
								$minuto_off = substr ( $tempo_off, 10, 2 );
								$secondo_off = substr ( $tempo_off, 12, 2 );
								$adesso = mktime ( date ( "H" ), date ( "i" ), 0, date ( "m" ), date ( "d" ), date ( "Y" ) );
								$sec_restanti = mktime ( $ora_off, $minuto_off, 0, $mese_off, $giorno_off, $anno_off ) - $adesso;
								if ($stato_mercato == "P") {
									if ($sec_restanti > 1) {
										$checkgiocatoreinasta ++;
										if ($ruolo == "P")
										$np --;
										if ($ruolo == "D")
										$nd --;
										if ($ruolo == "C")
										$nc --;
										if ($ruolo == "F")
										$nf --;
										if ($ruolo == "A")
										$na --;
									}
								}
								// ########################## info giocatore
								
								if ($ok_pre == "SI") {
									
									$dcs = trim ( ucfirst ( strtolower ( $dc [$numero] ['squ'] ) ) );
									if ($dati [$dcs] ['pan'] != "") {
										$ss_part = html_entity_decode ( strip_tags ( implode ( "", $dati [$dcs] ['par'] ) ) );
										$ss_tito = str_replace ( "'", "&#39;", html_entity_decode ( strip_tags ( implode ( "", $dati [$dcs] ['tit'] ) ) ) );
										$ss_panc = str_replace ( "'", "&#39;", html_entity_decode ( strip_tags ( implode ( "", $dati [$dcs] ['pan'] ) ) ) );
										$ss_squa = str_replace ( "'", "&#39;", html_entity_decode ( strip_tags ( implode ( "", $dati [$dcs] ['squ'] ) ) ) );
										$ss_indi = str_replace ( "'", "&#39;", html_entity_decode ( strip_tags ( implode ( "", $dati [$dcs] ['ind'] ) ) ) );
										$stat_squadra = "<div>
										<img src='./immagini/m_" . strtolower ( $dcs ) . ".gif' border='0' vspace='0' hspace='3' width='24px' alt='$dcs' title='$dcs' />
										<img src='./immagini/soccer_3_24.png' title='$ss_part' alt='$ss_part' border=0 />
										<img src='./immagini/soccer_4_24.png' title='Titolari: $ss_tito' alt='Titolari: $ss_tito' border=0 />
										<img src='./immagini/soccer_2_24.png' title='Panchinari: $ss_panc' alt='Panchinari: $ss_panc' border=0 />
										<img src='./immagini/soccer_1_24.png' title='Squalificati: $ss_squa' alt='Squalificati: $ss_squa' border=0 />
										<img src='./immagini/soccer_5_24.png' title='Indisponibili: $ss_indi' alt='Indisponibili: $ss_indi' border=0 />
										</div>";
										} else {
										$stat_squadra = "Errore caricamento";
									}
								} else if ($abilita_stat == "NO")
								$stat_squadra = "---------";
								else
								$stat_squadra = "Nessun dato";
								// #######################
								
								if ($attivo == "0")
								$attivo1 = "<font size='0' color='red'><b> - Trasferito</b></font>";
								else
								$attivo1 = "";
								
								if ($sec_restanti < 1 or ($stato_mercato != "I" and $stato_mercato != "P")) {
									$lista_calciatori [$contatore_calciatori] = $numero;
									$contatore_calciatori ++;
									$nome_linea = "linea_comprato_$ruolo";
									${$nome_linea} [$numero] = "<tr><td>&nbsp;</td>
									<td class='nome_gio center'>" . htmlentities ( utf8_decode ( $nome ) ) . "$attivo1</td>
									<td class='center'>$stat_squadra</td>
									<td class='center'>$ruolo</td>
									<td class='center'>$costo/$val_gio</td>";
									
									if ($outente != $_SESSION ['utente']) {
										if ($mercato_libero == "NO") {
											if (($stato_mercato == "I" or $stato_mercato == "R") and $_SESSION ['utente'] == $propr_c)
											$azione = "Di propriet&agrave;";
											elseif ($stato_mercato == "I" and $_SESSION ['utente'] != $propr_c)
											$azione = "<a href='offerta.php?num_calciatore=$numero&amp;valutazione=$valutazione&amp;xsquadra_ok=$xsquadra_ok&amp;mercato_libero=$mercato_libero' class='user'>offri</a>";
											elseif ($stato_mercato == "B" and $_SESSION ['utente'] == $propr_c)
											$azione = "Inserito nella Busta";
											elseif ($stato_mercato == "B" and $_SESSION ['utente'] != $propr_c)
											$azione = "<a href='busta_offerta.php?num_calciatore=$numero&valutazione=$valutazione&xsquadra_ok=$xsquadra_ok&mercato_libero=$mercato_libero' class=user>offri</a>";
											elseif ($stato_mercato == "R" and $proprietario == "<font class'svinc'>Svincolato</font>")
											$azione = "Riparazione: <a href='compra.php?num_calciatore=$numero&amp;valutazione=$valutazione&amp;xsquadra_ok=$xsquadra_ok' class='user'>compra</a>";
											elseif ($stato_mercato == "P" and $proprietario == "<font class'svinc'>Svincolato</font>")
											$azione = "<a href='offerta.php?num_calciatore=$numero&amp;valutazione=$valutazione&amp;xsquadra_ok=$xsquadra_ok&amp;mercato_libero=$mercato_libero' class='user'>offri</a>";
											elseif ($stato_mercato == "R" and $proprietario != "<font class'svinc'>Svincolato</font>")
											$azione = "Di terzi";
											elseif ($stato_mercato == "P" and $_SESSION ['utente'] == $propr_c)
											$azione = "<a href='vendi.php?num_calciatore=$numero' class='user'>vendi</a>";
											elseif ($stato_mercato == "P" and $_SESSION ['utente'] != $propr_c)
											$azione = "<a href='scambia.php?num_calciatore=$numero&amp;altro_utente=$outente' class='user'>scambia</a>";
											elseif ($stato_mercato == "A" and $proprietario == "<font class'svinc'>Svincolato</font>")
											$azione = "<a href='compra.php?num_calciatore=$numero&amp;valutazione=$valutazione&amp;xsquadra_ok=$xsquadra_ok' class='user'>compra</a>";
											elseif ($stato_mercato == "A" and $_SESSION ['utente'] == $propr_c)
											$azione = "<a href='vendi.php?num_calciatore=$numero' class='user'>vendi</a>";
											elseif ($stato_mercato == "A" and $_SESSION ['utente'] != $propr_c)
											$azione = "<a href='scambia.php?num_calciatore=$numero&amp;altro_utente=$outente' class='user'>scambia</a>";
											} elseif ($mercato_libero == "SI") {
											if ($stato_mercato == "I" and $_SESSION ['utente'] == $propr_c)
											$azione = "<a href='squadra.php' class='user'>Acquistato</a>";
											elseif ($stato_mercato == "I" and $_SESSION ['utente'] != $propr_c)
											$azione = "<a href='compra.php?num_calciatore=$numero&amp;valutazione=$valutazione' class='user'>compra</a>";
											elseif ($stato_mercato == "R" and $_SESSION ['utente'] == $propr_c)
											$azione = "<a href='vedi_vendi_subito.php?num_calciatore=$numero' class='user'>vendi</a>";
											elseif ($xsquadra_ok == "NO" and $_SESSION ['utente'] != $propr_c)
											$azione = "Riparazione: <a href='compra.php?num_calciatore=$numero&amp;valutazione=$valutazione&amp;xsquadra_ok=NO' class='user'>compra</a>";
											elseif ($stato_mercato == "A" and $_SESSION ['utente'] == $propr_c)
											$azione = "Di propriet&agrave;";
											elseif ($stato_mercato == "A" and $_SESSION ['utente'] != $propr_c)
											$azione = "<a href='cambi.php?num_calciatore=$numero' class='user'>cambi</a>";
										} else
										$azione = "Nessuna opzione";
										
										if ($stato_mercato == "C")
										$azione = "Mercato chiuso";
										if ($attivo == "0")
										$azione = "<font class='alert'>Trasferito</font>";
										if ($num1 % 2)
										$colore = "#FFFFFF";
										else
										$colore = "$colore_riga_alt";
										if ($blocco == 1)
										$azione = "<font class='alert'>Attendere aggiornamento</font>";
										
										${$nome_linea} [$numero] .= "<td class='center'>$azione</td>\n";
									}
									
									if ($outente == $_SESSION ['utente']) {
										
										${$nome_linea} [$numero] = ${$nome_linea} [$numero]."<td class='center' bgcolor='$bgtabtitolari'><label><input class='with-gap' type='radio' name='schierato$numero' value='titolare' /><span></span></label></td>
										<td style='width:15%;padding: 0;' class='center' bgcolor='$bgtabpanchinari'>
										<div class='input-field col m6' style='margin-top: 0;margin-bottom: 0;'><label><input class='with-gap' type='radio' name='schierato$numero' value='panchinaro' /><span></span></label></div>
										<div class='input-field col m6' style='margin-top: 0;margin-bottom: 0;'><select name='panchinaro$numero' onChange=setCheckedValue(document.seleziona_squadra.schierato$numero,'panchinaro') >\n";
										
										${$nome_linea} [$numero] = ${$nome_linea} [$numero]."<option value='-'>-</option>";
										
										if ($panchina_fissa == "NO") {
											for($num3 = 1; $num3 <= $max_in_panchina; $num3 ++) {
												${$nome_linea} [$numero] = ${$nome_linea} [$numero]."<option value='$num3'>$num3</option>";
											} // fine for $num3
											} else {
											if ($dati_calciatore [2] == "P") {
												${$nome_linea} [$numero] = ${$nome_linea} [$numero]."<option value='1'>1</option>";
											} // fine if
											else if ($dati_calciatore [2] == "D") {
												for($num3 = 2; $num3 <= 3; $num3 ++) {
													${$nome_linea} [$numero] .= "<option value='$num3'>$num3</option>";
												} // fine for $num3
												} else if ($dati_calciatore [2] == "C") {
												for($num3 = 4; $num3 <= 5; $num3 ++) {
													${$nome_linea} [$numero] .= "<option value='$num3'>$num3</option>";
												} // fine for $num3
												} else if ($dati_calciatore [2] == "A") {
												for($num3 = 6; $num3 <= 7; $num3 ++) {
													${$nome_linea} [$numero] .= "<option value='$num3'>$num3</option>";
												} // fine for $num3
											}
										} // fine panchina panchina_fissa
										
										${$nome_linea} [$numero] = ${$nome_linea} [$numero]."</select></div></td>
										<td class='center'><label><input class='with-gap' type='radio' name='schierato$numero' value='fuori' onClick=ResetOption(document.seleziona_squadra.panchinaro$numero,'-') /><span></span></label></td>";
										
										if ($mercato_libero == "SI") {
											if ($stato_mercato == "I")
											$offri = "<td align='center'><a href='vedi_vendi_subito.php?num_calciatore=$numero' class='user'>vendi ora</a></td>";
											elseif ($stato_mercato == "R")
											$offri = "<td align='center'><a href='vedi_vendi_subito.php?num_calciatore=$numero' class='user'>svincola</a></td>";
											else
											$offri = "<td align='center'><a href='stat_calciatore.php?num_calciatore=$numero&amp;ruolo_guarda=$ruolo' class='user'>Statistiche</a></td>";
											} elseif ($mercato_libero == "NO") {
											$data_busta_chiusa = @join ( '', @file ( "./dati/data_buste_" . $_SESSION ['torneo'] . "_0.txt" ) );
											
											$test1 = ( double ) substr ( $data_busta_precedente, 0, 12 );
											$test2 = ( double ) substr ( $tempo_off, 0, 12 );
											if ($stato_mercato == "I")
											$offri = "<td align='center'>Fase iniziale</td>";
											elseif ($stato_mercato == "B" and $tempo_off - $data_busta_chiusa == "0")
											$offri = "<td align='center'>Gi&agrave; acquisito nella Busta Chiusa</td>";
											elseif ($stato_mercato == "B" and ( double ) substr ( $tempo_off, 0, 12 ) <= ( double ) substr ( $data_busta_precedente, 0, 12 ))
											$offri = "<td align='center'>Fuori Mercato (Gia assegnato)</td>";
											elseif ($stato_mercato == "B" and $tempo_off != $data_busta_chiusa)
											$offri = "<td align='center'><a href='busta_vendi.php?num_calciatore=$numero' class='user'>ELIMINA dalla busta</a><br><a href='busta_offerta.php?num_calciatore=$numero&amp;valutazione=$valutazione&amp;xsquadra_ok=$xsquadra_ok&amp;mercato_libero=$mercato_libero&amp;mod=SI' class='user'>MODIFICA l'offerta</a></td>";
											elseif ($stato_mercato == "R")
											$offri = "<td align='center'><a href='vendi.php?num_calciatore=$numero' class='user'>svincola</a></td>";
											elseif ($stato_mercato == "P")
											$offri = "<td align='center'><a href='vendi.php?num_calciatore=$numero' class='user'>vendi</a></td>";
											elseif ($stato_mercato == "A" or $stato_mercato == "S")
											$offri = "<td align='center'><a href='vendi.php?num_calciatore=$numero' class='user'>vendi</a></td>";
											else
											$offri = "<td align='center'>Nessuna opzione</td>";
										} else
										$offri = "<td align='center'>Stato mercato errato</td>";
										
										${$nome_linea} [$numero] = ${$nome_linea} [$numero].$offri;
									} // fine if ($outente == $_SESSION['utente'])
									${$nome_linea} [$numero] = ${$nome_linea} [$numero]."</tr>";
								} // fine if ($sec_restanti < 0)
								
								else {
									$tempo_restante = "";
									$giorni = floor ( $sec_restanti / 86400 );
									$secondi_resto = $sec_restanti - ($giorni * 86400);
									$ore = floor ( $secondi_resto / 3600 );
									$secondi_resto = $sec_restanti - ($giorni * 86400) - ($ore * 3600);
									$minuti = floor ( $secondi_resto / 60 );
									$secondi_resto = $sec_restanti - ($giorni * 86400) - ($ore * 3600) - $minuti * 60;
									
									if ($giorni > 0) {
										if ($giorni > 1)
										$tempo_restante .= $giorni . " giorni";
										else
										$tempo_restante .= $giorni . " giorno";
									}
									
									if ($ore > 0) {
										if ($tempo_restante != "")
										$tempo_restante .= ", ";
										if ($ore > 1)
										$tempo_restante .= $ore . " ore";
										else
										$tempo_restante .= $ore . " ora";
									}
									
									if ($minuti > 0) {
										if ($tempo_restante != "")
										$tempo_restante .= ", ";
										if ($minuti > 1)
										$tempo_restante .= $minuti . " minuti";
										else
										$tempo_restante .= $minuti . " minuto";
									}
									
									if ($giorni == 0 and $ore == 0 and $minuti == 0 and $secondi_resto > 0)
									$tempo_restante .= $secondi_resto . " secondi";
									
									$nuovo_costo = $dati_calciatore [8];
									if ($nuovo_costo) {
										$costo_mostra = $nuovo_costo;
										} else {
										$costo_mostra = $costo;
									}
									
									$tempo = $anno_off . ", " . $mese_off . "-1, " . $giorno_off . ", " . $ora_off . ", " . $minuto_off . ", " . $secondo_off; // formato 2012, 8-1, 02, 13, 14
									countdown ( $numero, $tempo );
									
									$tab_offerte .= "<tr><td align='center'>$numero</td>
									<td align='left'>" . htmlentities ( $nome ) . "</td>
									<td align='center'>$ruolo</td>
									<td align='center'>$costo_mostra</td>
									<td align='center'><div id='$numero'></div></td></tr>";
								} // fine else if ($sec_restanti < 0)
							} // fine if ($proprietario == $outente)
						} // fine for $num2
						$tab_offerte .= "</table>";
						
						// ########################################################
						
						if ($outente == $_SESSION ['utente']) {
							
							// ########################
							// Controlla squadra #
							// ########################
							
							@list ( $ooutente, $oopass, $oopermessi, $ooemail, $oourl, $oosquadra, $ootorneo, $ooserie, $oocitta, $oocrediti, $oovariazioni, $oocambi, $ooreg ) = explode ( "<del>", trim ( $filei [$_SESSION ['uid']] ) );
							$surplus = INTVAL ( $oocrediti );
							$variazioni = INTVAL ( $oovariazioni );
							$cambi_effettuati = INTVAL ( $oocambi );
							$soldi_spendibili = $soldi_iniziali + $surplus + $variazioni - $soldi_spesi;
							
							$num_calciatori_comprabili = $max_calciatori - $num_calciatori_posseduti;
							
							if ($num_calciatori_posseduti != $max_calciatori)
							$info_rosa = "<b><font color='red'>ATTENZIONE: la squadra non &eacute; completa!</font></b><br />Mancano <b>$num_calciatori_comprabili</b> calciatori da acquistare.";
							else
							$info_rosa = "";
							
							$schema_giocatori = "$np$nd$nc$nf$na";
							$verifica_sg = "";
							$num_giocons = count ( $composizione_squadra );
							
							for($num3 = 0; $num3 < $num_giocons; $num3 ++) {
								$verifica_sg .= $composizione_squadra [$num3] . "<br />";
								if ($composizione_squadra [$num3] == $schema_giocatori) {
									$xsquadra_ok = "SI";
								}
							} // fine for $num3
							
							if ($xsquadra_ok != "SI") {
								// if ($xsquadra_ok != "SI" and $mercato_libero =="SI") {
								$inserire = "NO";
								$controlla_squadra = "";
								if ($np == substr ( $verifica_sg, 0, 1 ))
								$controlla_squadra .= "<tr><td style='width: 25%;'><p class='ruolotab'>Portieri</p><b><p class='numtab'>$np / " . substr ( $verifica_sg, 0, 1 ) . "</b></p><center><p class='btn waves-effect waves-light green'>Al completo</p></center></td>";
								elseif ($np > substr ( $verifica_sg, 0, 1 ))
								$controlla_squadra .= "<tr><td><p class='ruolotab'>Portieri:</p> <p class='numtab'><font color='red'><b>$np</b></font> / " . substr ( $verifica_sg, 0, 1 ) . " </p><center><p class='btn waves-effect waves-light red'>Vendere esubero</p></center></td>";
								elseif ($np < substr ( $verifica_sg, 0, 1 ))
								$controlla_squadra .= "<tr><td style='width: 25%;'><p class='ruolotab'>Portieri</p><p class='numtab'>$np / " . substr ( $verifica_sg, 0, 1 ) . " </p><center><a class='btn waves-effect waves-light indigo' href='tab_calciatori.php?ruolo_guarda=P&amp;xsquadra_ok=NO&amp;mercato_libero=$mercato_libero' class='user'>acquista</a></center></td>";
								if ($nd == substr ( $verifica_sg, 1, 1 ))
								$controlla_squadra .= "<td style='width: 25%;'><p class='ruolotab'>Difensori</p><b><p class='numtab'>$nd / " . substr ( $verifica_sg, 1, 1 ) . "</b></p><center><p class='btn waves-effect waves-light green'>Al completo</p></center></td></tr>";
								elseif ($nd > substr ( $verifica_sg, 1, 1 ))
								$controlla_squadra .= "<td><p class='ruolotab'>Difensori:</p> <p class='numtab'><font color='red'><b>$np</b></font> / " . substr ( $verifica_sg, 1, 1 ) . " </p><center><p class='btn waves-effect waves-light red'>Vendere esubero</p></center></td></tr>";
								elseif ($nd < substr ( $verifica_sg, 1, 1 ))
								$controlla_squadra .= "<td style='width: 25%;'><p class='ruolotab'>Difensori</p><p class='numtab'> $nd / " . substr ( $verifica_sg, 1, 1 ) . "</p><center><a class='btn waves-effect waves-light indigo' href='tab_calciatori.php?ruolo_guarda=D&amp;xsquadra_ok=NO&amp;mercato_libero=$mercato_libero' class='user'>acquista</a></center></td></tr>";
								if ($nc == substr ( $verifica_sg, 2, 1 ))
								$controlla_squadra .= "<tr><td style='width: 25%;'><p class='ruolotab'>Centrocampisti</p><b><p class='numtab'>$nc / " . substr ( $verifica_sg, 2, 1 ) . "</b></p><center><p class='btn waves-effect waves-light green'>Al completo</p></center></td>";
								elseif ($nc > substr ( $verifica_sg, 2, 1 ))
								$controlla_squadra .= "<tr><td><p class='ruolotab'>Centrocampisti:</p> <p class='numtab'><font color='red'><b>$np</b></font> / " . substr ( $verifica_sg, 2, 1 ) . " </p><center><p class='btn waves-effect waves-light red'>Vendere esubero</p></center></td>";
								elseif ($nc < substr ( $verifica_sg, 2, 1 ))
								$controlla_squadra .= "<tr><td style='width: 25%;'><p class='ruolotab'>Centrocampisti</p><p class='numtab'>$nc / " . substr ( $verifica_sg, 2, 1 ) . "</p><center><a class='btn waves-effect waves-light indigo' href='tab_calciatori.php?ruolo_guarda=C&amp;xsquadra_ok=NO&amp;mercato_libero=$mercato_libero' class='user'>acquista</a></center></td>";
								if ($considera_fantasisti_come == "F") {
									if ($nf == substr ( $verifica_sg, 3, 1 ))
									$controlla_squadra .= "<td style='width: 25%;'><p class='ruolotab'>Fantasisti</p><b><p class='numtab'>$nf / " . substr ( $verifica_sg, 3, 1 ) . "</b></p><center><p class='btn waves-effect waves-light green''>Al completo</p></center></td>";
									elseif ($nf > substr ( $verifica_sg, 3, 1 ))
									$controlla_squadra .= "<td><p class='ruolotab'>Fantasisti:</p> <p class='numtab'><font color='red'><b>$np</b></font> / " . substr ( $verifica_sg, 3, 1 ) . " </p><center><p class='btn waves-effect waves-light red'>Vendere esubero</p></center></td>";
									elseif ($nf < substr ( $verifica_sg, 3, 1 ))
									$controlla_squadra .= "<td style='width: 25%;'><p class='ruolotab'>Fantasisti</p><p class='numtab'>$nf / " . substr ( $verifica_sg, 3, 1 ) . "</p><center><a class=btn waves-effect waves-light indigo' href='tab_calciatori.php?ruolo_guarda=F&amp;xsquadra_ok=NO&amp;mercato_libero=$mercato_libero' class='user'>acquista</a></center></td>";
								}
								if ($na == substr ( $verifica_sg, 4, 1 ))
								$controlla_squadra .= "<td style='width: 25%;'><p class='ruolotab'>Attaccanti</p><b><p class='numtab'>$na / " . substr ( $verifica_sg, 4, 1 ) . "</b></p><center><p class='btn waves-effect waves-light green'>Al completo</p></center></td></tr>";
								elseif ($na > substr ( $verifica_sg, 4, 1 ))
								$controlla_squadra .= "<td><p class='ruolotab'>Attaccanti:</p> <p class='numtab'><font color='red'><b>$np</b></font> / " . substr ( $verifica_sg, 4, 1 ) . " </p><center><p class='btn waves-effect waves-light red'>Vendere esubero</p></center></td></tr>";
								elseif ($na < substr ( $verifica_sg, 4, 1 ))
								$controlla_squadra .= "<td style='width: 25%;'><p class='ruolotab'>Attaccanti</p><p class='numtab'>$na / " . substr ( $verifica_sg, 4, 1 ) . "</p><center><a class='btn waves-effect waves-light indigo' href='tab_calciatori.php?ruolo_guarda=A&amp;xsquadra_ok=NO&amp;mercato_libero=$mercato_libero' class='user'>acquista</a></center></td></tr>";
							} // fine if ($xsquadra_ok != "SI")
							else {
								$fuori_tabella .= "<br />
								<div class='center'>
								<button type='submit' class='btn waves-effect waves-light green' name='cambia_formazione'/>Conferma formazione<i class='material-icons right'>check</i></button>
								<span style='padding:30px'></span>
								<button type='submit' class='btn waves-effect waves-light red' name='reset_form'/>Azzera formazione<i class='material-icons right'>close</i></button>
								</div>";
							} // fine else $xsquadra_ok
							
							// ###################################################
							
							$num_calciatori_comprabili = $max_calciatori - $num_calciatori_posseduti;
							
							if ($num_calciatori_posseduti != $max_calciatori) {
								$tab_lato = "<h4>ATTENZIONE</h4>Mancano <b>$num_calciatori_comprabili</b> calciatori da acquistare.";
							} else
							$tab_lato = "";
						}
						
						$tab_centro = "<div class='card'>
				        <div class='card-content'>
						<span class='card-title'>Schiera la tua formazione</span>
			 	        <hr>
                        <table style='width:100%'  cellspacing='0' cellpadding='2' align='center' bgcolor='$sfondo_tab'>
						<tr>
						<th style='text-align: center'>Pos.</th>
						<th style='text-align: center'>Giocatore</th>
						<th style='text-align: center'>Squadra</th>
						<th style='text-align: center'>Ruolo</th>
						<th style='text-align: center'>Cos/Val</th>";
						$colspan = 6;
						
						if ($outente == $_SESSION ['utente']) {
							$tab_centro .= "<th style='text-align: center'>Titolare</th><th style='text-align: center'>Panchina</th><th style='text-align: center'>Tribuna</th>";
							$colspan = 10;
						} // fine if ($outente == $_SESSION['utente'])
						
						$tab_centro .= "<th style='text-align: center'>&nbsp;</th></tr>
						<tr bgcolor='$bgtabtitolari'><th style='text-align: center' colspan='$colspan'><b>TITOLARI</b></th></tr>";
						$titolari = explode ( ",", $dati_squadra [1] );
						
						// tabella dei titolari
						$num_titolari = count ( $titolari );
						$num_pos = 1;
						
						for($num2 = 0; $num2 < $num_titolari; $num2 ++) {
							$numero_titolare = $titolari [$num2];
							if ($linea_comprato_P [$numero_titolare]) {
								$linea_comprato_P [$numero_titolare] = preg_replace ( "#value='titolare'#", "value='titolare' checked", $linea_comprato_P [$numero_titolare] );
								$linea_comprato_P [$numero_titolare] = preg_replace ( "#<tr><td>&nbsp;</td>#", "<tr bgcolor='$bgtabtitolari'><td class='portiere'>$num_pos</td>", $linea_comprato_P [$numero_titolare] );
								$num_pos ++;
								$tab_titolari_P .= $linea_comprato_P [$numero_titolare];
								$inserito [$numero_titolare] = "SI";
							} // fine if ($linea_comprato_P[$numero_titolare])
							
							if (isset ( $linea_comprato_D [$numero_titolare] )) {
								$linea_comprato_D [$numero_titolare] = preg_replace ( "#value='titolare'#", "value='titolare' checked", $linea_comprato_D [$numero_titolare] );
								$linea_comprato_D [$numero_titolare] = preg_replace ( "#<tr><td>&nbsp;</td>#", "<tr bgcolor='$bgtabtitolari'><td class='numero'>$num_pos</td>", $linea_comprato_D [$numero_titolare] );
								$num_pos ++;
								$tab_titolari_D .= $linea_comprato_D [$numero_titolare];
								$inserito [$numero_titolare] = "SI";
							} // fine if ($linea_comprato_D[$numero_titolare])
							
							if (isset ( $linea_comprato_C [$numero_titolare] )) {
								$linea_comprato_C [$numero_titolare] = preg_replace ( "#value='titolare'#", "value='titolare' checked", $linea_comprato_C [$numero_titolare] );
								$linea_comprato_C [$numero_titolare] = preg_replace ( "#<tr><td>&nbsp;</td>#", "<tr bgcolor='$bgtabtitolari'><td class='numero'>$num_pos</td>", $linea_comprato_C [$numero_titolare] );
								$num_pos ++;
								$tab_titolari_C .= $linea_comprato_C [$numero_titolare];
								$inserito [$numero_titolare] = "SI";
							} // fine if ($linea_comprato_C[$numero_titolare])
							
							if (isset ( $linea_comprato_F [$numero_titolare] )) {
								$linea_comprato_F [$numero_titolare] = preg_replace ( "#value='titolare'#", "value='titolare' checked", $linea_comprato_F [$numero_titolare] );
								$linea_comprato_F [$numero_titolare] = preg_replace ( "#<tr><td>&nbsp;</td>#", "<tr bgcolor='$bgtabtitolari'><td class='numero'>$num_pos</td>", $linea_comprato_F [$numero_titolare] );
								$num_pos ++;
								$tab_titolari_F .= $linea_comprato_F [$numero_titolare];
								$inserito [$numero_titolare] = "SI";
							} // fine if ($linea_comprato_F[$numero_titolare])
							
							if (isset ( $linea_comprato_A [$numero_titolare] )) {
								$linea_comprato_A [$numero_titolare] = preg_replace ( "#value='titolare'#", "value='titolare' checked", $linea_comprato_A [$numero_titolare] );
								$linea_comprato_A [$numero_titolare] = preg_replace ( "#<tr><td>&nbsp;</td>#", "<tr bgcolor='$bgtabtitolari'><td class='numero'>$num_pos</td>", $linea_comprato_A [$numero_titolare] );
								$num_pos ++;
								$tab_titolari_A .= $linea_comprato_A [$numero_titolare];
								$inserito [$numero_titolare] = "SI";
							} // fine if ($linea_comprato_A[$numero_titolare])
						} // fine for $num2
						
						$tab_centro .= $tab_titolari_P . $tab_titolari_D . $tab_titolari_C . $tab_titolari_F . $tab_titolari_A;
						
						// Tabella dei panchinari
						$tab_centro .= "<tr bgcolor='$bgtabpanchinari'><th style='text-align: center' colspan='$colspan'><b>PANCHINA</b></th></tr>";
						$panchinari = explode ( ",", $dati_squadra [2] );
						$num_panchinari = count ( $panchinari );
						$tab_panchinari_P = "";
						$tab_panchinari_D = "";
						$tab_panchinari_C = "";
						$tab_panchinari_F = "";
						$tab_panchinari_A = "";
						$tab_panchinari = "";
						for($num2 = 0; $num2 < $num_panchinari; $num2 ++) {
							$numero_panchinaro = $panchinari [$num2];
							$num_in_panchina = $num2 + 1;
							
							if ($linea_comprato_P [$numero_panchinaro]) {
								$linea_comprato_P [$numero_panchinaro] = preg_replace ( "#value='panchinaro'#", "value='panchinaro' checked", $linea_comprato_P [$numero_panchinaro] );
								$linea_comprato_P [$numero_panchinaro] = preg_replace ( "#option value='$num_in_panchina'#", "option value='$num_in_panchina' selected", $linea_comprato_P [$numero_panchinaro] );
								$linea_comprato_P [$numero_panchinaro] = preg_replace ( "#<tr><td>&nbsp;</td>#", "<tr bgcolor='$bgtabpanchinari'><td class='portiere'>$num_pos</td>", $linea_comprato_P [$numero_panchinaro] );
								$num_pos ++;
								$tab_panchinari .= $linea_comprato_P [$numero_panchinaro];
								$inserito [$numero_panchinaro] = "SI";
							} // fine if ($linea_comprato_P[$numero_panchinaro])
							
							if (isset ( $linea_comprato_D [$numero_panchinaro] )) {
								$linea_comprato_D [$numero_panchinaro] = preg_replace ( "#value='panchinaro'#", "value='panchinaro' checked", $linea_comprato_D [$numero_panchinaro] );
								$linea_comprato_D [$numero_panchinaro] = preg_replace ( "#option value='$num_in_panchina'#", "option value='$num_in_panchina' selected", $linea_comprato_D [$numero_panchinaro] );
								$linea_comprato_D [$numero_panchinaro] = preg_replace ( "#<tr><td>&nbsp;</td>#", "<tr bgcolor='$bgtabpanchinari'><td class='numero'>$num_pos</td>", $linea_comprato_D [$numero_panchinaro] );
								$num_pos ++;
								$tab_panchinari .= $linea_comprato_D [$numero_panchinaro];
								$inserito [$numero_panchinaro] = "SI";
							} // fine if ($linea_comprato_D[$numero_panchinaro])
							
							if (isset ( $linea_comprato_C [$numero_panchinaro] )) {
								$linea_comprato_C [$numero_panchinaro] = preg_replace ( "#value='panchinaro'#", "value='panchinaro' checked", $linea_comprato_C [$numero_panchinaro] );
								$linea_comprato_C [$numero_panchinaro] = preg_replace ( "#option value='$num_in_panchina'#", "option value='$num_in_panchina' selected", $linea_comprato_C [$numero_panchinaro] );
								$linea_comprato_C [$numero_panchinaro] = preg_replace ( "#<tr><td>&nbsp;</td>#", "<tr bgcolor='$bgtabpanchinari'><td class='numero'>$num_pos</td>", $linea_comprato_C [$numero_panchinaro] );
								$num_pos ++;
								$tab_panchinari .= $linea_comprato_C [$numero_panchinaro];
								$inserito [$numero_panchinaro] = "SI";
							} // fine if ($linea_comprato_C[$numero_panchinaro])
							
							if (isset ( $linea_comprato_F [$numero_panchinaro] )) {
								$linea_comprato_F [$numero_panchinaro] = preg_replace ( "#value='panchinaro'#", "value='panchinaro' checked", $linea_comprato_F [$numero_panchinaro] );
								$linea_comprato_F [$numero_panchinaro] = preg_replace ( "#option value='$num_in_panchina'#", "option value='$num_in_panchina' selected", $linea_comprato_F [$numero_panchinaro] );
								$linea_comprato_F [$numero_panchinaro] = preg_replace ( "#<tr><td>&nbsp;</td>#", "<tr bgcolor='$bgtabpanchinari'><td class='numero'>$num_pos</td>", $linea_comprato_F [$numero_panchinaro] );
								$num_pos ++;
								$tab_panchinari .= $linea_comprato_F [$numero_panchinaro];
								$inserito [$numero_panchinaro] = "SI";
							} // fine if ($linea_comprato_F[$numero_panchinaro])
							
							if (isset ( $linea_comprato_A [$numero_panchinaro] )) {
								$linea_comprato_A [$numero_panchinaro] = preg_replace ( "#value='panchinaro'#", "value='panchinaro' checked", $linea_comprato_A [$numero_panchinaro] );
								$linea_comprato_A [$numero_panchinaro] = preg_replace ( "#option value='$num_in_panchina'#", "option value='$num_in_panchina' selected", $linea_comprato_A [$numero_panchinaro] );
								$linea_comprato_A [$numero_panchinaro] = preg_replace ( "#<tr><td>&nbsp;</td>#", "<tr bgcolor='$bgtabpanchinari'><td class='numero'>$num_pos</td>", $linea_comprato_A [$numero_panchinaro] );
								$num_pos ++;
								$tab_panchinari .= $linea_comprato_A [$numero_panchinaro];
								$inserito [$numero_panchinaro] = "SI";
							} // fine if ($linea_comprato_A[$numero_panchinaro])
						} // fine for $num2
						
						$tab_centro .= $tab_panchinari;
						
						// Tabella degli esclusi
						$tab_centro .= "<tr><th style='text-align: center' colspan='$colspan'><b>TRIBUNA</b></th></tr>";
						$num_calciatori = count ( $lista_calciatori );
						for($num2 = 0; $num2 < $num_calciatori; $num2 ++) {
							$numero_fuori = $lista_calciatori [$num2];
							if ($inserito [$numero_fuori] != "SI") {
								if ($linea_comprato_P [$numero_fuori]) {
									$linea_comprato_P [$numero_fuori] = preg_replace ( "#value='fuori'#", "value='fuori' checked", $linea_comprato_P [$numero_fuori] );
									$tab_fuori_P .= $linea_comprato_P [$numero_fuori];
									$inserito [$numero_fuori] = "SI";
								} // fine if ($linea_comprato_P[$numero_fuori])
								if ($linea_comprato_D [$numero_fuori]) {
									$linea_comprato_D [$numero_fuori] = preg_replace ( "#value='fuori'#", "value='fuori' checked", $linea_comprato_D [$numero_fuori] );
									$tab_fuori_D .= $linea_comprato_D [$numero_fuori];
									$inserito [$numero_fuori] = "SI";
								} // fine if ($linea_comprato_D[$numero_fuori])
								if ($linea_comprato_C [$numero_fuori]) {
									$linea_comprato_C [$numero_fuori] = preg_replace ( "#value='fuori'#", "value='fuori' checked", $linea_comprato_C [$numero_fuori] );
									$tab_fuori_C .= $linea_comprato_C [$numero_fuori];
									$inserito [$numero_fuori] = "SI";
								} // fine if ($linea_comprato_C[$numero_fuori])
								if ($linea_comprato_F [$numero_fuori]) {
									$linea_comprato_F [$numero_fuori] = preg_replace ( "#value='fuori'#", "value='fuori' checked", $linea_comprato_F [$numero_fuori] );
									$tab_fuori_F .= $linea_comprato_F [$numero_fuori];
									$inserito [$numero_fuori] = "SI";
								} // fine if ($linea_comprato_F[$numero_fuori])
								if ($linea_comprato_A [$numero_fuori]) {
									$linea_comprato_A [$numero_fuori] = preg_replace ( "#value='fuori'#", "value='fuori' checked", $linea_comprato_A [$numero_fuori] );
									$tab_fuori_A .= $linea_comprato_A [$numero_fuori];
									$inserito [$numero_fuori] = "SI";
								} // fine if ($linea_comprato_A[$numero_fuori])
							} // fine if ($inserito[$num_fuori] != "SI")
						} // fine for $num2
						$tab_centro .= $tab_fuori_P . $tab_fuori_D . $tab_fuori_C . $tab_fuori_F . $tab_fuori_A;
						$tab_centro .= "</table>";
						
						// #######################
						// Layout pagina
						if ($consenti_logo == "SI") {
							if (substr ( $_SESSION ['url'], - 3 ) == "jpg" or substr ( $_SESSION ['url'], - 3 ) == "JPG" or substr ( $_SESSION ['url'], - 3 ) == "gif" or substr ( $_SESSION ['url'], - 3 ) == "GIF") {
								$logo_squadra = $_SESSION ['url'];
								} else {
								$logo_squadra = "./immagini/loghi/" . $_SESSION ['utente'] . ".jpg";
							}
						}
						$dati_utente = "<div class='row'>
						<div class='col m5'>												    
						<div class='card'>							    						    
						<span class='card-title white-text' style='background-color: #3f51b5;background-image:url($logo_squadra);background-repeat:no-repeat;background-position:right;background-size:40%;height:116px;padding: 42px 0 0 10px;';>                                    							    
						Profilo giocatore      
						</span>                                							
						<div class='card-content'>
						<p align='left'><b>Presidente:</b> " . $_SESSION ['utente'] . "</p>
						<p align='left'><b>E-mail:</b> " . $_SESSION ['email'] . "</p>							
						<p align='left'><b>Data iscrizione:</b> " . $_SESSION ['reg'] . "</p>                    
						<p align='left'><b>Citt&agrave;:</b> " . $_SESSION ['citta'] . "</p>				
						<p align='left'><b>Sito web:</b> <a href=" . $_SESSION ['url'] . " target='_blank'> visualizza</a></p>";
						if ($mercato_libero == "SI") {
							$dati_utente .= "<p align='left'><b>Cambi effettuati:</b> $cambi_effettuati</p>							
							<p align='left'><b>Cambi totali:</b> $numero_cambi_max</p>			
							<p align='left'><b>Crediti disponibili:</b> $soldi_spendibili</p>";
						}
						if (file_exists ( $percorso_cartella_dati . "/squadra_$outente" )) {
							$dati_utente .= "<p align='left'><b>Invio formazione:</b> " . date ( "d-m-Y H:i:s", filemtime ( $percorso_cartella_dati . "/squadra_" . $outente )."</p>" );
						}
						$dati_utente .= "</div></div></div>";
						if ($num_calciatori_comprabili != "0") {
							$dati_utente .= "
							<div class='col m7'>
							<table cellpadding='10' cellspacing='0'>		                        							
							<tr>			                            							    
							<td><center><b>Crediti disponibili:</b> $soldi_spendibili</center></td>											
							<td><center><b>Giocatori da acquistare:</b> $num_calciatori_comprabili</center></td>								
							</tr>		                                							
							$controlla_squadra			                         						
							</table></div>";
						}
						
						if ($mercato_libero != "SI")
						$dati_utente .= "<br /><a href='#off' class='user'>Offerte in corso</a>";
						
						if ($outente == $_SESSION ['utente']) {
							//tabella_squadre ();
							echo '<div class="container" style="width: 85%;margin-top: -10px;">
							<div class="card-panel">
							<div class="row">';
							
							require ("./widget.php");
							
							echo "<div class='col m9'>
							<div class='card'>
							<div class='card-content'>
							<span class='card-title'>" . $_SESSION ['squadra'] . "<span style='font-size: 13px;'> - Gestione sqauadra</span></span>
							<hr>";
							if ($tab_lato != "" and $xsquadra_ok != "SI")
							echo "<div class='mdl-cell mdl-cell--12-col'><div class='evidenziato'>$info_rosa</div></div>";
							echo "$dati_utente";
							if ($tab_lato != "" and $xsquadra_ok != "SI")
							echo "$fuori_tabella\n";
							elseif ($vedi_campetto == "SI") {
								echo "<div class='col m7'><div class='card'>
								<table align='center'>																						
								<tr>
								<td align='center' style='padding:0px' valign='top'><img src='fantacampo.php?riduci=90&amp;orientamento_campetto=0&amp;iutente=$outente' alt='La tua squadra in campo' /></td>
								<td class='center' style='padding: 0px 12px 0px 0px;'>
								<b>Panchina</b>
								<br/><br/>
								$layout_panchina
								</td>																    										
								</tr>
								</table></div></div></div>";
							}
							} else {
							tabella_squadre ();
							echo "<table summary='squadra testa' bgcolor='$sfondo_tab' width='100%' align='center'>
							<tr><td align='center' class='testa'>$titolo";
							
							if (substr ( $ourl, - 3 ) == "jpg" or substr ( $ourl, - 3 ) == "JPG" or substr ( $ourl, - 3 ) == "gif" or substr ( $ourl, - 3 ) == "GIF") {
								$logo_squadra = $ourl;
								echo "</td><td><img alt='Logo squadra' src='$logo_squadra' border='1' />";
								} else {
								$logo_squadra = "./immagini/loghi/$outente.jpg";
								if (@is_file ( $logo_squadra ))
								echo "</td><td><img alt='Logo squadra' src='$logo_squadra' border='1' />";
							}
							echo "</td></tr></table>";
						}
						
						if ($outente == $_SESSION ['utente'])
						echo "<div class='row'><div class='col m12'>
						
						<form method='post' action='seleziona_squadra.php' name='seleziona_squadra'>
						$tab_centro
						$fuori_tabella
						</form>
						<form method='post' action='seleziona_squadra.php' name='reset_form'></form>
						</div></div></div></div></div></div></div></div></div></div>";
						elseif ($stato_mercato == "I" or $stato_mercato == "R" or $stato_mercato == "B") {
							echo "<p align='center'>IMPOSSIBILE VISIONARE LE FORMAZIONI DI ALTRE SQUADRE IN QUESTA FASE!</p>";
						} elseif ($outente != $_SESSION ['utente'])
						echo "<table summary='squadra corpo' bgcolor='$sfondo_tab' width='100%' align='center' cellpadding='3'>
						<tr><td valign='top'>
						$tab_centro
						$fuori_tabella
						</td></tr></table>
						</td>														
						</tr>													
						</table>";
						
						$tab_lato = "";
						$tab_centro = "";
						$fuori_tabella = "";
						
						// #######################
						
						if ($mercato_libero != "SI" and $stato_mercato != "R" and $stato_mercato != "B")
						echo "<a name='off'></a><h3><u>Vedi le offerte in corso</u></h3><br />$tab_offerte";
					} // fine if ($otorneo == $_session...
				} // fine if ($nome_squadra == $outente or $nome_squadra == "tutti")
			} // fine for $num1
		} // fine if ($chiusura_giornata != 1)
		else {
			echo "<br /><br /><h2>Giornata chiusa</h2>";
			echo "<p align='center'>Non &eacute; pi&ugrave; consentito effettuare operazioni per questa giornata!<br /><br />Attendere fino a quando viene creata la prossima giornata.</p><br /><br /><br /><br /><br />";
		}
	} // fine if ($_SESSION['valido'] == "SI")
	else
	echo "<meta http-equiv='refresh' content='0; url=logout.php'>";
	include ("./footer.php");
?>