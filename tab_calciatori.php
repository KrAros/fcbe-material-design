<?php
	// #################################################################################
	// FANTACALCIOBAZAR EVOLUTION
	// Copyright (C) 2003-2009 by Antonello Onida
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
	
	require './libs/Smarty.class.php';
    require './controlla_pass.php';
    $smarty = new Smarty;
    //$smarty->force_compile = true;
    $smarty->debugging = true;
    $smarty->caching = true;
    $smarty->cache_lifetime = 120;
    
    $smarty->assign("TitoloPagina", "Listone calciatori");

		#####################################
		#### Controlla num_calciatore ultima giornata
		
		$data_busta_chiusa = @join('',@file($percorso_cartella_dati."/data_buste_".$_SESSION['torneo']."_0.txt"));
		$data_busta_precedente = @join('',@file($percorso_cartella_dati."/data_buste_precedente_".$_SESSION['torneo']."_0.txt"));
		$calciatori_iniziale = @file("$percorso_cartella_dati/calciatori.txt");
		
		if ($stato_mercato != "I") $ultima_giornata = ultima_giornata_giocata();
		
		if ($stato_mercato != "I" and $ultima_giornata >= 1) {
			if (@is_file("$percorso_cartella_voti/voti$ultima_giornata.txt")) {
				$calciatori = file("$percorso_cartella_voti/voti$ultima_giornata.txt");
				$frase_voti = "Dati aggiornati all'ultima giornata <b>$ultima_giornata</b>";
				} else {
				$ultima_giornata --;
				$calciatori = file("$percorso_cartella_voti/voti$ultima_giornata.txt");
				$frase_voti = "<font color=red>Dati dell'ultima giornata ancora non presenti.</font><br/> Valutazione alla giornata <b>$ultima_giornata</b>.";
				$blocco = 1;
			}
			} else {
			$calciatori = @file("$percorso_cartella_dati/calciatori.txt");
			$frase_voti = "Dati relativi al precampionato.";
		}
		
		$smarty->assign("Sottotitolo", $frase_voti);
		
		#######################################################
		#### Ciclo assegnazione variabili per array giocatore[]
		
		$my_database_txt = './dati/statistiche.txt';  
		$array_righi = file($my_database_txt);  
	
		$num_calciatori = count($calciatori);
		foreach($array_righi as $key => $dati_giocatore){  
			list ($num_calciatore, $giornata, $nome, $squadra, $attivo, $ruolo, $presenza, $votofc, $mininf25, $minsup25, $voto, $golsegnati, $golsubiti, $golvittoria, $golpareggio, $assist, $ammonizione, $espulsione, $rigoretirato, $rigoresubito, $rigoreparato, $rigoresbagliato, $autogol, $entrato, $titolare, $sv, $giocaincasa, $valore) = explode("|", $dati_giocatore);  

			$valore_mercato = " - ";
			$tempo_restante = "";
			$dati_calciatore = explode($separatore_campi_file_calciatori, $calciatori [$num1]);
			$squadra = preg_replace( "#\"#","",$squadra);
			$nome = htmlentities(utf8_encode(preg_replace( "#\"#","",$nome)), 0, 'UTF-8');
			if ($stato_mercato != "I") $nome = "<a href='stat_calciatore.php?num_calciatore=$num_calciatore' class='user'>$nome</a>";
			
			assegna_ruoli('calciatori');
			
			if ($considera_fantasisti_come != $ruoli) $considera_fantasisti_come = "F";
			if ($ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
			
			$num_cer_val = count($calciatori_iniziale);
						
			for($num2 = 0; $num2 < $num_cer_val; $num2 ++) {
				$dati_cervalcal = explode($separatore_campi_file_calciatori, $calciatori_iniziale[$num2]);
				$num_cervalcal = $dati_cervalcal[($num_colonna_numcalciatore_file_calciatori - 1)];
				$num_cervalcal = trim($num_cervalcal);
				
				if ($num_cervalcal == $num_calciatore) {
					$costo = $dati_cervalcal[($num_colonna_valore_calciatori - 1)];
					$costo = trim($costo);
					break;
				} else {
					$costo = "-";
				}
			}
				
			$mercato = @file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
			$num_mercato = @count($mercato);
			$n = $num_mercato - 1;
				
			offerta_tempo_rimasto();
				
			if ($mercato_libero == "NO") {
				if ($stato_mercato == "B") {
					$ultima_riga = explode(",", $mercato[$n]);
					if ($ultima_riga [0] == "" and $n > 1) {
						$diff_giri = $ultima_riga [1] - $data_busta_chiusa;
						} else {
						$diff_giri = 0;
					}
					if (strlen($tempo_off_mer) == 16)
					$tempo_off_mer = substr($tempo_off_mer, 0, 12);
					$diff = $tempo_off_mer - $data_busta_chiusa;
					if ($propr_c == $_SESSION['utente'] and ($diff == 0 or $diff == $diff_giri)) {
						$azione = "Acquisito nella Busta";
						$proprietario = "<font color='red' size='-2'>$_SESSION[utente]</font>";
					} 
					elseif ($propr_c == $_SESSION['utente']) { 
						$azione = "Inserito nella Busta";
					}
					elseif ($propr_c != $_SESSION['utente'] and ($diff == 0 or $diff == $diff_giri)) {
						$azione = "<a href='scambia.php?num_calciatore=$num_calciatore&amp;altro_utente=$proprietario_merc' class='user'>scambia</a>";
						$proprietario = "<font color='red' size='-2'>$propr_c</font>";
					} 
					elseif ($propr_c != $_SESSION['utente'] and !isset($azione)) {
						$azione = "<a href='busta_offerta.php?num_calciatore=$num_calciatore&valutazione=$valore&squadra_ok=$squadra_ok&mercato_libero=$mercato_libero' class='user'>offri</a>";
						$proprietario = "Svincolato";
					}
				} 
				elseif ($proprietario == "Svincolato" and ($stato_mercato == "I" or "A" or "P")) {
					$azione = "<a href='offerta.php?num_calciatore=$num_calciatore&amp;valutazione=$valore&amp;squadra_ok=$squadra_ok&amp;mercato_libero=$mercato_libero&amp;ruolos=$ruolo' class='user'>offri</a>";
				}
				elseif ($proprietario == "Svincolato" and $stato_mercato == "B") {
					$azione = "<a href='busta_offerta.php?num_calciatore=$num_calciatore&amp;valutazione=$valore&amp;squadra_ok=$squadra_ok&amp;mercato_libero=$mercato_libero' class='user'>offri con busta</a>";
				}
				elseif ($proprietario == "Svincolato" and $stato_mercato == "R") {
					$azione = "<a href='compra.php?num_calciatore=$num_calciatore&amp;valutazione=$valore&amp;squadra_ok=$squadra_ok' class='user'>compra</a>";
				}
				elseif ($_SESSION ['utente'] != $propr_c and $stato_mercato == "B") {
					$azione = "<a href='busta_offerta.php?num_calciatore=$num_calciatore&amp;valutazione=$valore&amp;squadra_ok=$squadra_ok&amp;mercato_libero=$mercato_libero' class='user'>offri con busta</a>";
				}
				elseif ($_SESSION ['utente'] != $propr_c and $stato_mercato == "I") {
					$azione = $t_r;
				}
				elseif ($_SESSION ['utente'] != $propr_c and $stato_mercato == "P") {
					$azione = "<a href='offerta.php?num_calciatore=$num_calciatore&amp;valutazione=$valore&amp;squadra_ok=$squadra_ok&amp;mercato_libero=$mercato_libero' class='user'>offri</a>";
				}
				elseif ($_SESSION ['utente'] != $propr_c and ($stato_mercato == "S" or "A")) {
					$ppr = cerca_proprietario($num_calciatore);
					$azione = "<a href='scambia.php?num_calciatore=$num_calciatore&amp;altro_utente=$ppr' class='user'>scambia</a>";
				} 
				elseif ($_SESSION ['utente'] == $propr_c and $stato_mercato == "B") {
					$azione = "<a href='busta_vendi.php?num_calciatore=$num_calciatore' class='user'>togli dalla busta</a>";
				}
				elseif ($_SESSION ['utente'] == $propr_c and ($stato_mercato == "I" or "R" or "A" or "P") and $tempo_restante == "") {
					$azione = "<a href='vendi.php?num_calciatore=$num_calciatore' class='user'>vendi</a>";
				} 
				else {
					$azione = "-";
				} 
			}
				
			elseif ($mercato_libero == "SI") {
				if ($squadra_ok == "NO" and $_SESSION ['utente'] != $propr_c) {
					$azione = "<a href='compra.php?num_calciatore=$num_calciatore&amp;valutazione=$valore&amp;squadra_ok=NO' class='user'>compra</a>";
				}
				elseif (($stato_mercato == "I" or "R") and $_SESSION ['utente'] == $propr_c) {
					$azione = "<a href='vedi_vendi_subito.php?num_calciatore=$num_calciatore' class='user'>svincola</a>";
				}
				elseif ($stato_mercato == "I" and $_SESSION ['utente'] != $propr_c) {
					$azione = "<a href='compra.php?num_calciatore=$num_calciatore&amp;valutazione=$valore' class='user'>compra</a>";
				}
				elseif ($stato_mercato == "A" and $_SESSION ['utente'] != $propr_c) {
					$azione = "<a href='cambi.php?num_calciatore=$num_calciatore' class='user'>cambi</a>";
				} else {
					$azione = "-";
				}
			} else {
				$azione = "Errore di configurazione";
			}
				
			if ($stato_mercato == "C") $azione = "Mercato chiuso";
			if ($attivo == 0) $azione = "<font color='red'><b>Trasferito</b></font>";
			if ($blocco == 1) $azione = "<font color='red'>Attendere aggiornamento</font>";
				
			if ($stato_mercato == "A" and $mercato_libero == "SI" and $props and $pallinogiallo == "SI")
			$info = "<img src='./immagini/info1.gif' style='border:0; margin:0;' title='$props' alt='$props' />";
				
			$icona = "m_".strtolower($squadra).".gif";
			$giocatore[] = array( 
				"nome" => $nome, 
				"ruolo" => $ruolo, 
				"squadra" => $squadra, 
				"partite_giocate" => $presenza,
				"media_giornale" => $voto,
				"media_punti" => $votofc,
				"valore" => intval($valore),
				"azione" => $azione,
				"info" => $info,
				"backruolo" => $backruolo
			);
		}
		
	$smarty->assign("GiocatoriTabella", $giocatore); #$giocatore è la variabile con il compito di far vedere l'elenco calciatori
	$smarty->display('tab_calciatori.tpl');
?>		