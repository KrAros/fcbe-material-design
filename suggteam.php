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
    $smarty->caching = false;
    $smarty->cache_lifetime = 120;
    
    $smarty->assign("TitoloPagina", "Forma squadra");
		
	$ultima_giornata = ultima_giornata_giocata();
	
	###############################################################################################
	##### Calcolo il numero minimo di partite_disputate per prendere in considerazione il giocatore
		
	if (!$range) $range=5;
	$partite_minime_per_range = $range/3;
		
	if ($range%2) $partite_minime_per_range = round($partite_minime_per_range,0);
	$fine_range = $ultima_giornata;
	
	if ($ultima_giornata > $range) {
		$inizio_range = $ultima_giornata - $range +1;
	} else {
		$inizio_range = 1 ;
	}
		
	if (strlen($inizio_range) == 1) $inizio_range = "0".$inizio_range;
		
	$smarty->assign("Sottotitolo", "Calciatori migliori nelle ultime $range giornate");
	$vedi_squadra = $_SESSION['utente'];
		
	############################################
	##### Inizio controllo statistiche giocatori
	
	$voti = file($percorso_cartella_voti."/voti".$ultima_giornata.".txt");
	$num_voti = count($voti);
	$cerca_fantasquadra = @file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
	$num_cer_fantasqu = count($cerca_fantasquadra);
	array_multisort ($cerca_fantasquadra,SORT_ASC, SORT_STRING);
		
	$partite_giocate = 0;
	$somma_voti_tot = 0;
	$somma_voti_giornale = 0;
		
	for ($knum1 = 0 ; $knum1 < $num_cer_fantasqu; $knum1++) {
		$dati_calciatore = explode(",", $cerca_fantasquadra[$knum1]);
		list($num_calciatore, $nome, $ruolo, $valore, $fantasquadra) = $dati_calciatore;
			
		$nome = htmlentities(utf8_encode(preg_replace( "#\"#","",$nome)), 0, 'UTF-8');
		$nome = "<a href='stat_calciatore.php?num_calciatore=$numero'>$nome</a>";
		$fantasquadra = preg_replace("#\"#","",$fantasquadra);
			
		if ($considera_fantasisti_come != $ruoli) $considera_fantasisti_come = "F";
		if ($ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
			
		if ($fantasquadra == $vedi_squadra) {
			controllo_statistiche($inizio_range,$fine_range);	
			if ($partite_giocate != 0) {
				$media_giornale = round(($somma_voti_giornale /$partite_giocate),2);
				$media_punti = round(($somma_voti_tot / $partite_giocate),2);
			} else {
				$media_giornale = 0;
				$media_punti = 0;
			} 
				
			if ($statistiche == "SI") {
				if ($stat_attivo == 0) $mess = "<b><font color=red>Non disponibile</font></b>";
				else $mess = "In attività";
						
				if ($ruolo == "P" and $totpresenze >= $partite_minime_per_range) {
					$portieri[]=array($nome,$totpresenze,$media_giornale,$tot_golsubiti,$totamm,$totesp,$media_punti+10,$totass,$numero,$stat_squadra);
				}
				if ($ruolo == "D" and $totpresenze >= $partite_minime_per_range){
					$difensori[]=array($nome,$totpresenze,$media_giornale,$tot_golsegnati,$totamm,$totesp,$media_punti+10,$totass,$numero,$stat_squadra);
				}		
				if ($ruolo == "C" and $totpresenze >= $partite_minime_per_range){
					$centrocampisti[]=array($nome,$totpresenze,$media_giornale,$tot_golsegnati,$totamm,$totesp,$media_punti+10,$totass,$numero,$stat_squadra);
				}			
				if ($ruolo == "A" and $totpresenze >= $partite_minime_per_range){
					$attaccanti[]=array($nome,$totpresenze,$media_giornale,$tot_golsegnati,$totamm,$totesp,$media_punti+10,$totass,$numero,$stat_squadra);
				}		
				if ($ruolo == "F" and $totpresenze >= $partite_minime_per_range){
					$fantasisti[]=array($nome,$totpresenze,$media_giornale,$tot_golsegnati,$totamm,$totesp,$media_punti+10,$totass,$numero,$stat_squadra);
				}
			} 
					
			$stat_presenza=0;
			$totpresenze=0;
			$stat_votofc=0;
			$totvotfc=0;
			$stat_voto=0;
			$totvot=0;
			$stat_golsegnati=0;
			$tot_golsegnati=0;
			$stat_golsubiti=0;
			$tot_golsubiti=0;
			$stat_golvittoria=0;
			$totgolvit=0;
			$stat_golpareggio=0;
			$totgolpar=0;
			$stat_assist=0;
			$totass=0;
			$stat_ammonizione=0;
			$totamm=0;
			$stat_espulsione=0;
			$totesp=0;
			$stat_rigoretirato=0;
			$totrigt=0;
			$stat_rigoresubito=0;
			$totrigs=0;
			$stat_rigoreparato=0;
			$totrigp=0;
			$stat_rigoresbagliato=0;
			$totrigsb=0;
			$stat_autogol=0;
			$totaut=0;
			$totgol=0;
			$partite_giocate=0;
			$media_giornale=0;
			$media_punti=0;
			$partite_giocate = 0;
			$somma_voti_tot = 0;
			$somma_voti_giornale = 0;	
		} 
	}
			
	$ordinamento = 6;
	
	#########################################################################
	##### Inserimento statistiche in array per essere richiamati nel template
	
	function cmp1 ($a, $b) {
		global $ordinamento;
		return strcmp($b[$ordinamento], $a[$ordinamento]);
	}
		
	usort($portieri, "cmp1");
	usort($difensori, "cmp1");
	usort($centrocampisti, "cmp1");
	usort($attaccanti, "cmp1");
			
	$nome = $portieri[0][0];
	$totpresenze = $portieri[0][1];
	$media_giornale = $portieri[0][2];
	$tot_golsegnati = $portieri[0][3];
	$totamm = $portieri[0][4];
	$totesp = $portieri[0][5];
	$media_punti = $portieri[0][6]-10;
	$totass = $portieri[0][7];
	$numero = $portieri[0][8];
	$squadra = $portieri[0][9];
	$ruolo = "P";
	$backruolo = "orange darken-4";
			
	$giocatore[] = array( 
		"nome" => $nome, 
		"ruolo" => $ruolo, 
		"squadra" => $squadra, 
		"partite_giocate" => $totpresenze,
		"media_giornale" => $media_giornale,
		"media_punti" => $media_punti,
		"gol" => $tot_golsegnati,
		"assist" => $totass,
		"rigori" => $stat_rigoretirato,
		"ammonizioni" => $totamm,
		"espulsioni" => $totesp,
		"backruolo" => $backruolo
	);
			
	for ($i=0; $i<$dif; $i++) {
		$nome = $difensori[$i][0];
		$totpresenze = $difensori[$i][1];
		$media_giornale = $difensori[$i][2];
		$tot_golsegnati = $difensori[$i][3];
		$totamm = $difensori[$i][4];
		$totesp = $difensori[$i][5];
		$media_punti = $difensori[$i][6]-10;
		$totass = $difensori[$i][7];
		$numero = $difensori[$i][8];
		$squadra = $difensori[$i][9];
		$ruolo = "D";
		$backruolo = "indigo darken-4";
				
		$giocatore[] = array( 
			"nome" => $nome, 
			"ruolo" => $ruolo, 
			"squadra" => $squadra, 
			"partite_giocate" => $totpresenze,
			"media_giornale" => $media_giornale,
			"media_punti" => $media_punti,
			"gol" => $tot_golsegnati,
			"assist" => $totass,
			"rigori" => $stat_rigoretirato,
			"ammonizioni" => $totamm,
			"espulsioni" => $totesp,
			"backruolo" => $backruolo
		);
	}
			
	for ($i=0; $i<$cen; $i++) {
		$nome = $centrocampisti[$i][0];
		$totpresenze = $centrocampisti[$i][1];
		$media_giornale = $centrocampisti[$i][2];
		$tot_golsegnati = $centrocampisti[$i][3];
		$totamm = $centrocampisti[$i][4];
		$totesp = $centrocampisti[$i][5];
		$media_punti = $centrocampisti[$i][6]-10;
		$totass = $centrocampisti[$i][7];
		$numero = $centrocampisti[$i][8];
		$squadra = $centrocampisti[$i][9];
		$ruolo = "C";
		$backruolo = "green darken-4";
				
		$giocatore[] = array( 
			"nome" => $nome, 
			"ruolo" => $ruolo, 
			"squadra" => $squadra, 
			"partite_giocate" => $totpresenze,
			"media_giornale" => $media_giornale,
			"media_punti" => $media_punti,
			"gol" => $tot_golsegnati,
			"assist" => $totass,
			"rigori" => $stat_rigoretirato,
			"ammonizioni" => $totamm,
			"espulsioni" => $totesp,
			"backruolo" => $backruolo
		);
	}
			
	for ($i=0; $i<$att; $i++) {
		$nome = $attaccanti[$i][0];
		$totpresenze = $attaccanti[$i][1];
		$media_giornale = $attaccanti[$i][2];
		$tot_golsegnati = $attaccanti[$i][3];
		$totamm = $attaccanti[$i][4];
		$totesp = $attaccanti[$i][5];
		$media_punti = $attaccanti[$i][6]-10;
		$totass = $attaccanti[$i][7];
		$numero = $attaccanti[$i][8];
		$squadra = $attaccanti[$i][9];
		$ruolo = "A";
		$backruolo = "red darken-4";
				
		$giocatore[] = array( 
			"nome" => $nome, 
			"ruolo" => $ruolo, 
			"squadra" => $squadra, 
			"partite_giocate" => $totpresenze,
			"media_giornale" => $media_giornale,
			"media_punti" => $media_punti,
			"gol" => $tot_golsegnati,
			"assist" => $totass,
			"rigori" => $stat_rigoretirato,
			"ammonizioni" => $totamm,
			"espulsioni" => $totesp,
			"backruolo" => $backruolo
		);
	};
			
	$numero_giornate = array();
	for ($num1 = "02" ; $num1 < 50 ; $num1++) {
		if (strlen($num1) == 1) $num1 = "0".$num1;
		if (@is_file("$percorso_cartella_dati/voti$num1.txt")) {
			$numero_giornate[$num1] = $num1;
			$smarty->assign('numero_giornate', $numero_giornate);
		} else {
			break;
		}
	} 
			
    $smarty->assign("range", $range);
    $smarty->assign("dif", $dif);
    $smarty->assign("cen", $cen);
    $smarty->assign("att", $att);
	$smarty->assign("GiocatoriTabella", $giocatore); #$giocatore è la variabile con il compito di far vedere l'elenco calciatori
	$smarty->display('suggteam.tpl');
?>	