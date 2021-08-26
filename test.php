<?php  
 require './controlla_pass.php';
$my_database_txt = './dati/voti20.txt';  
$array_righi = file($my_database_txt);  

	echo "Numero - Giornata - Nome - Squadra - Attivo - Ruolo - Partite giocate - Media giornale - Fanta Media - Valore<br>";
foreach($array_righi as $key => $dati_giocatore){  
    list ($num_calciatore, $giornata, $nome, $squadra, $attivo, $ruolo, $presenza, $votofc, $mininf25, $minsup25, $voto, $golsegnati, $golsubiti, $golvittoria, $golpareggio, $assist, $ammonizione, $espulsione, $rigoretirato, $rigoresubito, $rigoreparato, $rigoresbagliato, $autogol, $entrato, $titolare, $sv, $giocaincasa, $valore) = explode("|", $dati_giocatore);  
    
	$squadra = preg_replace( "#\"#","",$squadra);
			$nome = htmlentities(utf8_encode(preg_replace( "#\"#","",$nome)), 0, 'UTF-8');
			if ($stato_mercato != "I") $nome = "<a href='stat_calciatore.php?num_calciatore=$num_calciatore' class='user'>$nome</a>";
			
			$partite_giocate = 0;
			$somma_voti_tot = 0;
			$somma_voti_giornale = 0;
			$totgol = 0;
			$totgolsub = 0;
			$totass = 0;
			$totamm = 0;
			$totesp = 0;
			$totrigt = 0;
			$totrigs = 0;
			$totrigp = 0;
			$totrigsb = 0;
			$totaut = 0;
			
			controllo_statistiche(1,20);
			
			if ($partite_giocate != 0) {
				$media_giornale = round(($somma_voti_giornale/$partite_giocate),2);
				$media_punti = round(($somma_voti_tot/$partite_giocate),2);
			} else {
				$media_giornale = 0;
				$media_punti = 0;
			} 
	echo $num_calciatore."|".$giornata."|".$nome."|".$squadra."|".$attivo."|".$ruolo."|".$partite_giocate."|".$media_giornale."|0|0|".$media_punti."|".$totgol."|".$totgolsub."|0|0|".$totass."|".$totamm."|".$totesp."|".$totrigt."|".$totrigs."|".$totrigp."|".$totrigsb."|".$totaut."|0|0|0|0|".$valore."<br>";
	$giocatore[] = array( 
				"nome" => $nome, 
				"ruolo" => $ruolo, 
				"squadra" => $squadra, 
				"partite_giocate" => $partite_giocate,
				"media_giornale" => $media_giornale,
				"media_punti" => $media_punti,
				"valore" => intval($valore),
				"azione" => $azione,
				"info" => $info,
				"backruolo" => $backruolo
			);
}
?> 