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
    
    $smarty->assign("TitoloPagina", "Calendario");
	
	$file_utenti = file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
	$linee = count($file_utenti);
	$linee1=$linee-1;
	$giornata_ultima = 0;
	$vedi_giornate = "Giornate:&nbsp; ($linee1)";
	
	for ($num1 = 1 ; $num1 < 40 ; $num1++) {
		if (strlen($num1) == 1) $num1 = "0".$num1;
		$giornata_controlla = "giornata".$num1."_";
		if (!@is_file($percorso_cartella_dati."/".$giornata_controlla.$_SESSION['torneo']."_".$_SESSION['serie'])) {
			break;
		} else {
		$vedi_giornate .= "<a href='#g".intval($num1)."' title='".intval($num1)."'>&nbsp;".intval($num1)."&nbsp;</a>&nbsp;&nbsp;";
		$smarty->assign("vedi_giornate", $vedi_giornate);
		}
	}
	
	$gol = array();
	for($num1 = 1 ; $num1 <= $giornata_ultima ; $num1++) {
		$num_giornata_scontri = $num1;
		if (strlen($num1) == 1) $num_giornata_scontri = "0".$num1;
		$giornata_scontri = "giornata".$num_giornata_scontri."_".$_SESSION['torneo']."_".$_SESSION['serie'];
		$file_giornata = file($percorso_cartella_dati."/".$giornata_scontri);
		$num_linee_file_giornata = count($file_giornata);
		for($num2 = 0 ; $num2 < $num_linee_file_giornata; $num2++) {
			$linea = togli_acapo($file_giornata[$num2]);
			if ($linea == "#@& fine scontri #@&") $leggendo_scontri = "NO";
			if ($leggendo_scontri == "SI") {
				unset($scontri);
				$scontri = explode("##@@&&",$linea);
				$gol[$num1][$scontri[0]] = $scontri[2];
				$gol[$num1][$scontri[1]] = $scontri[3];
			} # fine if ($leggendo_scontri == "SI")
			if ($linea == "#@& scontri #@&") {
				$leggendo_scontri = "SI";
			} # fine if ($linea == "#@& scontri #@&")
		} # fine for $num2
	} # fine for $num1
	
	for($num1 = 1 ; $num1 < $linee; $num1++) {
		@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file_utenti[$num1]);
		$nome_posizione[$num1] = $outente;
		if ($osquadra) $nome_squadra_memo[$outente] = $osquadra;
		else $nome_squadra_memo[$outente] = $outente;
	} # fine for $num1

	$num_campionati = count($campionato);
	reset($campionato);

	for($num1 = 0 ; $num1 < $num_campionati; $num1++) {
		$key_campionato = key($campionato);
		$giornate_campionato = explode("-",$key_campionato);
		$tipo_campionato = $campionato[$key_campionato];
		$g_inizio_camp = $giornate_campionato[0];
		$g_fine_camp = $giornate_campionato[1];
		if ($tipo_campionato != "S" and $tipo_campionato != "P" and $tipo_campionato != "V") $tipo_campionato = "N";
		if ($tipo_campionato != "N") {
			if ($tipo_campionato == "S") {
				$smarty->assign("Sottotitolo", "Campionato dalla <b>$g_inizio_camp</b> alla <b>$g_fine_camp</b>");
				$attiva_scontri_diretti = "NO";
				$contaUtenti = 0;
				for($linea = 1; $linea < $linee; $linea++){
					@list($ooutente, $oopass, $oopermessi, $ooemail, $oourl, $oosquadra, $ootorneo, $ooserie, $oocittà, $oocrediti, $oovariazioni, $oocambi, $ooreg) = explode("<del>", $file_utenti[$linea]);
					$contaUtenti++;
				}
				$num_giocatori=$contaUtenti;
				if ($num_giocatori == 4 or $num_giocatori == 6 or $num_giocatori == 8 or $num_giocatori == 10 or $num_giocatori == 12 or $num_giocatori == 14 or $num_giocatori == 16 or $num_giocatori == 18 or $num_giocatori == 20) {
					$attiva_scontri_diretti = "SI";
				} else { 
					echo "ERRORE: il numero di partecipanti ancora non &egrave; di 4, 6, 8, 10, 12, 14, 16, 18 o 20.<br/><br/>";
				}
				if ($attiva_scontri_diretti == "SI") {
					$file_scontri = file($percorso_cartella_scontri."/squadre".$num_giocatori);
					$num_linee_file_scontri = count($file_scontri);
					$finito_scontri = "NO";
					$conta_cicli_while = 1;
					$num_giornata_campionato = 0;
					$giornata_scritta = $g_inizio_camp - 1;
					echo "<table summary='' align='center' cellspacing='20' width='90%'>";
					$num_cella = 1;
					while ($finito_scontri != "SI") {
						$inizio_campionato = "";
						$campionato_in_corso = "";
						$inizio_giornata = "";
						$giornata_in_corso = "";
						for ($num2 = 0 ; $num2 < $num_linee_file_scontri; $num2++) {
							$linea_file_scontri = trim(togli_acapo($file_scontri[$num2]));
							if ($campionato_in_corso == "SI") {
								if ($linea_file_scontri == "</campionato>") break;
								if ($linea_file_scontri == "</giornata>") {
									$giornata_in_corso = "NO";
									if ($giornata_scritta <= $g_fine_camp) {
										echo "</table>";
										echo "<div align='right'><a href='#top'>^ top</a></div><br/>".$acapo;
										echo "</td>";
										if ($num_cella == 2) {
											echo "</tr>";
											$num_cella = 0;
										} # fine if ($num_cella == 4)
										$num_cella++;
									} # fine if ($giornata_scritta < $g_fine_camp)
								} # fine if ($linea_file_scontri == "</giornata>")
								if ($giornata_in_corso == "SI") {
									$partita = explode("-",$linea_file_scontri);
									$squadra1 = $nome_posizione[$partita[0]];
									$squadra2 = $nome_posizione[$partita[1]];
									echo "<tr><td align='center'><a href='giornate.php?opzione=2&amp;nome_squadra=$squadra1' class='user'>".$nome_squadra_memo[$squadra1]."</a> - <a href='giornate.php?opzione=2&amp;nome_squadra=$squadra2' class='user'>".$nome_squadra_memo[$squadra2]."</a></td><td align='center' width='15%'>".$gol[$num_giornata_campionato][$squadra1]." - ".$gol[$num_giornata_campionato][$squadra2]."</td></tr>".$acapo;
									$giocatore[] = array( 
										"squadra1" => $nome_squadra_memo[$squadra1], 
										"squadra2" => $nome_squadra_memo[$squadra2], 
										"gol_casa" => $gol[$num_giornata_campionato][$squadra1], 
										"gol_fuori" => $gol[$num_giornata_campionato][$squadra2], 
									);
								} # fine if ($campionato_in_corso == "SI")
								if ($inizio_giornata == "SI") {
									$inizio_giornata = "";
									$giornata_scritta++;
									$num_giornata_campionato++;
									if ($linea_file_scontri > $ultima_giornata) $ultima_giornata = $linea_file_scontri;
									if ($giornata_scritta <= $g_fine_camp) {
										if ($num_cella == 1) echo "<tr>";
										$giornata_in_corso = "SI";
										echo "<td width='40%'><a name='g$num_giornata_campionato'></a><table summary='' align='center' width='100%' border='1' cellpadding='5' cellspacing='0' bgcolor='$sfondo_tab'><tr><td class='testa' colspan='2'>Giornata $num_giornata_campionato</td></tr>".$acapo;
										
									$smarty->assign("numero_giornata", $num_giornata_campionato);
									} # fine if ($giornata_scritta < $g_fine_camp)
								} # fine if ($inizio_giornata == "SI")
								if ($linea_file_scontri == "<giornata>") $inizio_giornata = "SI";
							} # fine if ($campionato_in_corso == "SI")
							if ($inizio_campionato == "SI") {
								$inizio_campionato = "";
								if  ($linea_file_scontri == $num_giocatori) $campionato_in_corso = "SI";
							} # fine if ($inizio_campionato)
							if ($linea_file_scontri == "<campionato>") $inizio_campionato = "SI";
						} # fine for $num2
						if ($giornata_scritta >= $g_fine_camp) $finito_scontri = "SI";
						$conta_cicli_while++;
						if ($conta_cicli_while >= 50) $finito_scontri = "SI";
					} # fine while ($finito_scontri != "SI")
					if ($num_cella != 1) echo "<tr>";
					echo "</table>".$acapo;
				} # fine if ($attiva_scontri_diretti == "SI")
			} # fine if ($tipo_campionato == "S")
		} # fine if ($tipo_campionato != "N")
		next($campionato);
	} # fine for $num1
	
	echo "</center></div>".$acapo;
	
	$smarty->assign("GiocatoriTabella", $giocatore); #$giocatore è la variabile con il compito di far vedere l'elenco calciatori
	$smarty->display('calendario.tpl');
?>