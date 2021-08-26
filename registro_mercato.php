<?php
    require './libs/Smarty.class.php';
    require './controlla_pass.php';
    $smarty = new Smarty;
    //$smarty->force_compile = true;
    $smarty->debugging = true;
    $smarty->caching = false;
    $smarty->cache_lifetime = 120;
    
    $smarty->assign("TitoloPagina", "Registro mercato");
    $smarty->assign("Sottotitolo", "Controlla tutti i movimenti di mercato di ogni squadra");
		
		$file = file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
		$linee = count($file);
		$num_giocatori = 0;
		for($num1 = 1; $num1 < $linee; $num1++){
			if(!"") $num_giocatori++;
		}
		
		$managers = array();
		for($num1 = 1 ; $num1 <= $num_giocatori; $num1++) {
			@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$num1]);
			$ssquadra[$outente] = $osquadra;
			$managerselec = "";
			if ($_POST['manager'] == $outente) $managerselec = "selected";
			$smarty->assign("managerselec", $managerselec);
			$managers[$num1] = $outente;   
			$smarty->assign('managers', $managers);
		}
		
		if( !isset($_POST['manager']) ){
			$managerseltutti = "selected";
			$smarty->assign("managerseltutti", $managerseltutti);
		}
		else $managersel = $_POST['manager'];
		
		$messaggi = @file($percorso_cartella_dati."/registro_mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
		$num_messaggi = @count($messaggi);
		$num_iniziale = 0;
		#rsort ($messaggi);
		
		for ($num1 = $num_iniziale ; $num1 < $num_messaggi ; $num1++) {
			$messaggio = explode("#@?",$messaggi[$num1]);
			$nome = stripslashes($messaggio[0]);
			$data = stripslashes($messaggio[1]);
			$testo_messaggio = stripslashes($messaggio[2]);
			$soprannome = $ssquadra[$nome];
			
			if (substr("$messaggi[$num1]",0,13) == "Radio mercato") $messmerc .= "$nome<br/>";
			
			if (isset($_POST['manager']) AND $_POST['manager'] != "Tutti"){
				if (strstr($nome, "$managersel ha")){
					$messmerc_manager .= "$nome<br />";
				}
			}
			
		} # fine for $num1
		
		
		if (isset($_POST['manager']) AND $_POST['manager'] != "Tutti"){
			$smarty->assign("messmerc", $messmerc_manager); #Riepilogo movimenti Allenatore selezionato
		} else {
			$smarty->assign("messmerc", $messmerc); #Riepilogo movimenti tutti Allenatori
		}
		
    $smarty->display('registro_mercato.tpl');
?>