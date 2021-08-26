<?php
	##################################################################################
	#    FANTACALCIOBAZAR EVOLUTION
	#    Copyright (C) 2003-2006 by Antonello Onida (fantacalcio@sassarionline.net)
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
    
    $smarty->assign("TitoloPagina", "Statistiche Rosa");
	$ultima_giornata = ultima_giornata_giocata();
	$smarty->assign("Sottotitolo", "Dati statistici fino alla giornata $ultima_giornata");

	############################################
	##### Inizio controllo statistiche giocatori
	
	if ($ultima_giornata == "") {
		echo "<br/><br/><center><h3>Statistiche non presenti</h3></center><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
	} else {			
		if ($stato_mercato != "I" AND $ultima_giornata >= 1) {
			$voti = file("$percorso_cartella_voti/voti$ultima_giornata.txt");
		} else { 
			$voti = file("$percorso_cartella_dati/calciatori.txt");
		}
		$num_voti = count($voti);
		$cerca_fantasquadra = file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
		$num_cer_fantasqu = count($cerca_fantasquadra);
		array_multisort ($cerca_fantasquadra, SORT_ASC, SORT_STRING);
		$partite_giocate = 0;
		$somma_voti_tot = 0;
		$somma_voti_giornale = 0;
		$count=0;
		for ($knum1 = 0 ; $knum1 <= $num_cer_fantasqu ; $knum1++) {	
			$dati_calciatore = explode(",", trim($cerca_fantasquadra[$knum1]));
			list ($num_calciatore, $nome, $ruolo, $valore, $fantasquadra) = $dati_calciatore;
			$nome = preg_replace("#\"#","",$nome);
			$fantasquadra = preg_replace("#\"#","",$fantasquadra);
			
			if ($fantasquadra == $vedi_squadra) {
				controllo_statistiche(1,40);			
				if ($partite_giocate != 0) {
					$media_giornale = round(($somma_voti_giornale /$partite_giocate),2);
					$media_punti = round(($somma_voti_tot / $partite_giocate),2);
				} else {
					$media_giornale = 0;
					$media_punti = 0;
				} 
				if ($stat_attivo == 0) $mess = "<b><font color=red>Non disponibile</font></b>";
				else $mess = "In attività";
				
				if ($ruolo == "P") $tot_golsegnati = $tot_golsubiti;
				if ($stat_attivo == "0") $csattivo = " - <font class='piccolo'>Trasferito</font>"; else $csattivo = "";
				
				$lmsquadra = "m_".strtolower($stat_squadra).".gif";
				$squadra = "<img class='iconasquadra z-depth-2' src='./immagini/$lmsquadra'/><a href='tab_squadre.php?vedi_squadra=$stat_squadra' style=' border: 0px; text-decoration: none;'>$stat_squadra</a>";
				assegna_ruoli('mercato');
				$count++;
				
				for($i = 0; $i <= 3; $i++){
					$sum += $media_giornale;
				}
				
				#########################################################################
				##### Inserimento statistiche in array per essere richiamati nel template
				
				$giocatore[] = array( 
					"nome" => $nome, 
					"ruolo" => $ruolo, 
					"squadra" => $squadra, 
					"partite_giocate" => $totpresenze,
					"media_giornale" => $media_giornale,
					"media_punti" => $media_punti,
					"gol" => $tot_golsegnati,
					"assist" => $totass,
					"rigori" => $totrigt,
					"ammonizioni" => $totamm,
					"espulsioni" => $totesp,
					"backruolo" => $backruolo,
					"attivo" => $csattivo,
					"costo" => $valore,
					"valore_attuale" => $stat_valore,
					"ultimo_fantavoto" => $uvt,
					"ultimo_voto" => $uvg
				);
				
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
				$partite_giocate=0;
				$media_giornale=0;
				$media_punti=0;
				$partite_giocate = 0;
				$somma_voti_tot = 0;
				$somma_voti_giornale = 0;
			} # fine for $Knum1
		} # fine if ($statistiche == "SI")	
	} # fine else
	
	$smarty->assign("GiocatoriTabella", $giocatore); #$giocatore è la variabile con il compito di far vedere l'elenco calciatori
	$smarty->display('statistiche_rosa.tpl');
	?>	