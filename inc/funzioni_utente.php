<?php
	
	############################
	##### MODULO - Prossima Gara
	##### Mostra il prossimo scontro di Serie A della squadra della quale si visualizzano le info
	
	function modulo_prossima_gara($larghezza) {
		global $vedi_squadra;
		
		########################################################
		##### Carico le informazioni per le probabili formazioni
		
		$xml = simplexml_load_file('http://xml2.temporeale.gazzettaobjects.it/Calcio/prob_form/squadre/'.strtolower($vedi_squadra).'/formazione.xml');
		
		$data = $xml->data;
		$ora = $xml->ora;
		$prossima_partita = $xml->partita;
		$teamlogo = explode("-", $prossima_partita);
		$casa = "./immagini/".strtolower($teamlogo[0]).".png";
		$trasferta = "./immagini/".strtolower($teamlogo[1]).".png";
		
		######################
		##### Template grafico
		
		echo "<div class='card center-align'>
		<div class='card-content'>
		<div class='row'>
		<div class='col m$larghezza'>
		<span class='card-title left-align'>Prossima gara in Serie A</span>
		<hr><br>
		<img height='130' src='$casa'> <span class='vs'>VS</span> <img height='130' src='$trasferta'> 
		$data - $ora
		</div>
		</div>
		</div>
		</div>";
	}	
	
	##########################################
	##### MODULO - Info e Probabili Formazioni
	##### Mostra le probabili formazioni ed info della prossima in Serie A della squadra della quale si visualizzano le info
	
	function modulo_info_e_probabili_formazioni() {
		global $vedi_squadra;
		
		########################################################
		##### Carico le informazioni per le probabili formazioni
		
		$xml = simplexml_load_file('http://xml2.temporeale.gazzettaobjects.it/Calcio/prob_form/squadre/'.strtolower($vedi_squadra).'/formazione.xml');
		$modulo = $xml->modulo;
		
		$mod = explode("-", $modulo);
		array_unshift($mod, "1");
		
		$titolari = $xml->titolari->calciatore;
		$data = $xml->data;
		$ora = $xml->ora;
		$prossima_partita = $xml->partita;
		
		######################
		##### Template grafico
		
		echo "<div class='card center-align'>
		<div class='card-content'>
		<div class='row'>
		<div class='giocherebbero_cosi'>
		<div class='headgioca'>
		<h2 class='pro_for'>Probabile Formazione</h2>
		<h2 class='modulo'>Modulo: $modulo</h2>
		</div>
		<div class='footballMatchField'>
		<div class='matchTotalField n".count($mod)."'>
		<ul class='portiere matchPlayersList module-1'>
		<li>
		<div class='playerNumber' style='background-image:url(./immagini/m_$vedi_squadra.gif)'></div>
		<div class='playerName'>".$titolari[0]."</div>
		</li>
		</ul>
		<ul class='difensori matchPlayersList module-".$mod[1]."'>";
		for ($i = $mod[1]; $i > 0; $i--){
			echo "<li>
			<div class='playerNumber' style='background-image:url(./immagini/m_$vedi_squadra.gif)'></div>
			<div class='playerName'>".$titolari[$i+0]."</div>
			</li>";
		}
		echo "</ul>
		<ul class='centrocampisti matchPlayersList module-".$mod[2]."'>";
		for ($i = $mod[2]; $i > 0; $i--){
			echo "<li>
			<div class='playerNumber' style='background-image:url(./immagini/m_$vedi_squadra.gif)'></div>
			<div class='playerName'>".$titolari[$i+$mod[1]]."</div>
			</li>";
		}
		echo "</ul>
		<ul class='attaccanti matchPlayersList module-".$mod[3]."'>";
		for ($i = $mod[3]; $i > 0; $i--){
			echo "<li>
			<div class='playerNumber' style='background-image:url(./immagini/m_$vedi_squadra.gif)'></div>
			<div class='playerName'>".$titolari[$i+$mod[2]+$mod[1]]."</div>
			</li>";
		}
		echo "</ul>";
		if (count($mod) == 5 ) {
			echo "<ul class='punte matchPlayersList module-".$mod[4]."'>";
			for ($i = $mod[4]; $i > 0; $i--){
				echo "<li>
				<div class='playerNumber' style='background-image:url(./immagini/m_$vedi_squadra.gif)'></div>
				<div class='playerName'>".$titolari[$i+$mod[3]+$mod[2]+$mod[1]]."</div>
				</li>";
			}
			echo "</ul>"; 
		}
		echo"</div>
		</div>
		
		<div class='info panchina_section'>
		<div style='clear:both;'>&nbsp;</div>
		<p class='card green lighten-2 center-align'><b>Panchina</b></p>
		<p style='padding-top:6px'>";
		foreach($xml->panchina->calciatore as $panchina) {
			echo $panchina." - ";
		}
		echo "</p>
		</div>
		<div class='info first'>
		<p class='card orange lighten-2 center-align'><b>Infortunati:</b></p>
		<p style='padding-top:6px'>";
		foreach($xml->indisponibili->calciatore as $indisponibili) {
			echo $indisponibili." - ";
		}
		echo "</p>
		</div>
		<div class='info second'>
		<p class='card red lighten-2 center-align'><b>Squalificati:</b></p>
		<p style='padding-top:6px'>";
		foreach($xml->squalificati->calciatore as $squalificati) {
			echo $squalificati." - ";
		}
		echo "</p>
		</div>
		<div class='info diffidati_section'>
		<p class='card yellow lighten-2 center-align'><b>Diffidati</b></p>
		<p style='padding-top:6px'>";
		foreach($xml->diffidati->calciatore as $diffidati) {
			echo $diffidati." - ";
		}
		echo "</p>
		</div>
		<div class='info altri_section'>
		<p class='card blue lighten-2 center-align'><b>Altri</b></p>
		<p style='padding-top:6px'>";
		foreach($xml->altri->calciatore as $altri) {
			echo $altri." - ";
		}
		echo "</p>
		</div>
		<div class='info ballottaggi_section'>
		<p class='card teal lighten-2 center-align'><b>Ballottaggi</b></p>
		<p style='padding-top:6px; padding-bottom:40px'>";
		foreach($xml->ballottaggi->calciatore as $ballottaggi) {
			echo $ballottaggi." - ";
		}
		echo "</p>
		</div>
		<div style='clear:both;'>&nbsp;</div>
		<div style='clear:both;'>&nbsp;</div>
		</div>
		</div>
		</div> 
		</div>"; 
	}
	
	#####################################
	##### MODULO - Ultime notizie squadra
	##### Mostra il prossimo scontro di Serie A della squadra della quale si visualizzano le info
	
	function ultime_notizie_squadra($larghezza) {
		global $vedi_squadra;
		
		###############################################
		##### Carico le informazioni per le ultime news
		
		$url_rss="http://www.gazzetta.it/rss/Squadre/".ucfirst(strtolower($vedi_squadra)).".xml"; //rss url
		include_once "./inc/rss_fetch.php";
		
		echo "<div class='card'>
		<div class='card-content'>
		<div class='row'>
		<div class='col m$larghezza'>
		<span class='card-title '>Ultime notizie</span>
		<hr>";
		output_rss_feed($url_rss, 5, true, false, 100);
	    echo "</div>
		</div>
		</div>
		</div>";
	}	
	
	#####################################
	##### MODULO - Rosa squadra ufficiale
	##### Mostra la rosa completa di Serie A della squadra della quale si visualizzano le info
	
	function rosa_squadra($larghezza) {
		
		global $percorso_cartella_voti, $percorso_cartella_dati, $separatore_campi_file_calciatori, $num_colonna_nome_file_calciatori, $num_colonna_numcalciatore_file_calciatori, $num_colonna_ruolo_file_calciatori, $num_colonna_valore_calciatori, $num_colonna_squadra_file_calciatori, $ncs_attivo, $outente, $mercato_libero, $stato_mercato, $simbolo_portiere_file_calciatori, $simbolo_difensore_file_calciatori, $simbolo_centrocampista_file_calciatori, $simbolo_attaccante_file_calciatori, $vedi_squadra, $num_colonna_votogiornale_file_voti, $num_colonna_vototot_file_voti;
		
		######################################
		##### Controlla numero ultima giornata		
		
		$ultima_giornata = ultima_giornata_giocata();
		
		if ($ultima_giornata != "00") {
			$cerca_squadra = file($percorso_cartella_voti."/voti".$ultima_giornata.".txt");
			$frase_giornata = "Dati aggiornati alla giornata $ultima_giornata";
		}
		else {
			$cerca_squadra = file($percorso_cartella_dati."/calciatori.txt");
			$frase_giornata = "Dati relativi al precampionato";
		}
		
		$num_cer_squ = count($cerca_squadra);
		
		######################
		##### Template grafico
		
		$table_layout = "<div class='card'>
		<div class='card-content'>
		<div class='row'>
		<div class='col m$larghezza'>
		<span class='card-title'>Rosa<span style='font-size: 13px;'> - $frase_giornata</span></span>
		<hr>
		<table class='centered highlight' style='width:100%' cellpadding='3px' bgcolor='$sfondo_tab'>
		<tr>
		<td class='testa'>Nome</td>
		<td class='testa'>V</td>
		<td class='testa'>FV</td>
		<td class='testa'>Val</td>
		<td class='testa'>&nbsp;</td>
		</tr>";
		
		$calciatori = @file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
		$num_calciatori = count($calciatori);
		
		
		for ($num1 = 0 ; $num1 < $num_cer_squ ; $num1++) {
			
			#######################################
			#Controllo componenti squadra		
			
			$dati_calciatore = explode($separatore_campi_file_calciatori, $cerca_squadra[$num1]);
			$numero = $dati_calciatore[($num_colonna_numcalciatore_file_calciatori-1)];
			$numero = trim($numero);
			$nome = stripslashes($dati_calciatore[($num_colonna_nome_file_calciatori-1)]);
			$nome = trim($nome);
			$nome = preg_replace( "/\"/", "",$nome);
			$ruolo = $dati_calciatore[($num_colonna_ruolo_file_calciatori-1)];
			$ruolo = trim($ruolo);
			$valore = $dati_calciatore[($num_colonna_valore_calciatori-1)];
			$valore = trim($valore);
			$ultvoto = $dati_calciatore[($num_colonna_votogiornale_file_voti-1)];
			$ultvoto = trim($ultvoto);
			$ultfantavoto = $dati_calciatore[($num_colonna_vototot_file_voti-1)];
			$ultfantavoto = trim($ultfantavoto);
			$xsquadra = $dati_calciatore[($num_colonna_squadra_file_calciatori-1)];
			$xsquadra = trim($xsquadra);
			$xsquadra = preg_replace( "/\"/", "",$xsquadra);
			
			$attivo = $dati_calciatore[($ncs_attivo-1)];
			$attivo = trim($attivo);
			
			if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
			if ($ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
			if ($ruolo == $simbolo_portiere_file_calciatori) $ruolo = "P";
			if ($ruolo == $simbolo_difensore_file_calciatori) $ruolo = "D";
			if ($ruolo == $simbolo_centrocampista_file_calciatori) $ruolo = "C";
			if ($ruolo == $simbolo_attaccante_file_calciatori) $ruolo = "A";
			
			#####################
			if ($vedi_squadra == $xsquadra and $attivo == "1") {
				$sx="on";
				for ($num2 = 0 ; $num2 < $num_calciatori ; $num2++) {
					$dati_calciatore = explode(",", $calciatori[$num2]);
					$proprietario = $dati_calciatore[4];
					$numero_calciatore= $dati_calciatore[0];
					if ($proprietario == $outente and $numero_calciatore==$numero) $sx="off";
				}
				if ($ruolo == "P") {$backruolo = "#ffb732";}
				if ($ruolo == "D") {$backruolo = "#00007f";}
				if ($ruolo == "C") {$backruolo = "#006600";}
				if ($ruolo == "A") {$backruolo = "#cc0000";}
				
				$table_layout .= "<tr>
				<td style='text-align:left'><b class='ruolo' style='background: $backruolo'>$ruolo</b> <a href='stat_calciatore.php?num_calciatore=$numero&amp;ruolo_guarda=$ruolo_guarda&amp;escludi_controllo=$escludi_controllo' class='user'>$nome</a></td>
				<td align=center>$ultvoto</td>
				<td align=center>$ultfantavoto</td>
				<td align=center>$valore</td>";
				if ($_SESSION['valido'] == "SI" and $mercato_libero == "SI" and $stato_mercato == "I" and $sx!="off")  $table_layout .= "<td align='center'><a href='compra.php?num_calciatore=$numero&amp;valutazione=$valutazione' class='user'>compra</a></td>";
				elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "SI" and $stato_mercato != "I" and $sx!="off") $table_layout .= "<td align='center'><a href='cambi.php?num_calciatore=$numero' class='user'>cambia</a></td>";
				elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "NO" and $stato_mercato == "I" and $sx!="off") $table_layout .= "<td align='center'><a href='offerta.php?num_calciatore=$numero' class='user'>offri</a></td>";
				//elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "NO" and $stato_mercato == "B") $table_layout .= "<td align='center'><a href='busta_offerta.php?num_calciatore=$numero&amp;valutazione=$valutazione&amp;xsquadra_ok=$xsquadra_ok&amp;mercato_libero=$mercato_libero' class='user'>inserisci nella busta</a></td>";
				elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "NO" and $stato_mercato == "B" and $sx!="off") $table_layout .= "<td align='center'><a class='user'>inserisci nella busta</a></td>";
				elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "NO" and $stato_mercato == "P" and $sx!="off") $table_layout .= "<td align='center'><a href='offerta.php?num_calciatore=$numero' class='user'>offri</a></td>";
				elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "NO" and $stato_mercato == "S" and $sx!="off") $table_layout .= "<td align='center'><a href='offerta.php?num_calciatore=$numero' class='user'>offri</a></td>";
				elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "NO" and $stato_mercato == "A" and $sx!="off") $table_layout .= "<td align=center><a href='scambia.php?num_calciatore=$numero&amp;altro_utente=$proprietario' class='user'>scambia</a></td>";
				else $table_layout .= "<td align='center'>----</td>";
				$table_layout .= "</tr>";
			}
		} # fine for $num1
		$table_layout .= "</table>
		</div>
		</div>
		</div>
		</div>";
		echo $table_layout;
	}
	
	###############################
	##### MODULO - Registro Mercato
	##### Mostra il riepilogo degli acquisti, con la possibilità di filtrare le operazioni per ogni utente
	
	function registro_mercato($larghezza) {
		global $percorso_cartella_dati;
		
		$file = file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
		$linee = count($file);
		$num_giocatori = 0;
		for($num1 = 1; $num1 < $linee; $num1++){
			if(!"") $num_giocatori++;
		}
		
		for($num1 = 1 ; $num1 < $num_giocatori; $num1++) {
			@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$num1]);
			$ssquadra[$outente] = $osquadra;
			
			$managerselec = "";
			if ($_POST['manager'] == $outente) $managerselec = "selected";
			$managers .= "<option value='$outente' $managerselec>$outente</option>";
		}
		
		######################
		##### Template grafico
		
		echo "<div class='card'>
		<div class='card-content'>
		<span class='card-title'>Riepilogo movimenti</span>
		<hr>
		<div class='row'>
		<div class='col m$larghezza'>
		<div class='row'>
		<form action='registro_mercato.php' method='post'>
		<div class='input-field col m4 right'>
		<select name='manager' onchange='this.form.submit()'>";
		
		if( !isset($_POST['manager']) ){
			$managerseltutti = "selected";
		}
		else $managersel = $_POST['manager'];
		
		echo "<option value='Tutti' $managerseltutti>Tutti</option>"; 
		echo "$managers
		</select>
		<label>Filtra per utente</label>
		</form>
		</div>
		</div>";
		
		$messaggi = @file($percorso_cartella_dati."/registro_mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
		$num_messaggi = count($messaggi);
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
			echo "$messmerc_manager";
		}
		else {
			echo "$messmerc";
		}
		echo "</div>
		</div>
		</div>
		</div>";
	}	
	
?>