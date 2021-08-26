<?php
	
	#######################
	##### Chiusura giornata
	
	if (@is_file($percorso_cartella_dati."/chiusura_giornata.txt")) { $colorinfo = "red"; $status_giornata = "Giornata Chiusa"; }
	else { $colorinfo = "green"; $status_giornata = "Giornata Aperta";}
	
	$smarty->assign("status_giornata", $status_giornata);
	
	$data_chigio = @file($percorso_cartella_dati."/data_chigio.txt");
	$ac = substr($data_chigio[0],0,4);
	$mc = substr($data_chigio[0],4,2);
	$gc = substr($data_chigio[0],6,2);
	$orac = substr($data_chigio[0],8,2);
	$minc = substr($data_chigio[0],10,2);
	
	$smarty->assign("colorinfo", $colorinfo);
	$smarty->assign("giorno_chiusura", $gc);
	$smarty->assign("mese_chiusura", $mc);
	$smarty->assign("anno_chiusura", $ac);
	$smarty->assign("ora_chiusura", $orac);
	$smarty->assign("minuti_chiusura", $minc);
	
	###############
	##### RSS forum 

	include_once "./inc/rss_fetch.php";
	$feed_rss_forum = output_rss_feed('http://fantacalciobazar.altervista.org/syndication.php', 10, true, true, 200);
	$smarty->assign("feed_rss_forum", $feed_rss_forum);
				
	######################
	##### Statistiche sito - TODO	
				
	//include('./inc/online.php');
	//include('./inc/flount.php');
		
?>
