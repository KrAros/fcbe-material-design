<?php
	
	##############################
	##### FUNZIONE - Assegna ruoli
	##### Converte i ruoli da numeri a lettere, assegnando un colore di background
	
	function assegna_ruoli() {
		
		extract($GLOBALS);
		global $ruolo, $backruolo;
		
		$ruoli = array("P","D","C","A");
		$simboli = array($simbolo_portiere_file_calciatori, $simbolo_difensore_file_calciatori, $simbolo_centrocampista_file_calciatori, $simbolo_attaccante_file_calciatori);
		$backruolo = array("orange darken-4", "indigo darken-4", "green darken-4", "red darken-4");
		
		for ($num3 = 0; $num3 < 4; $num3++) {
			if ($ruolo == $simboli[$num3]) {
				$ruolo = $ruoli[$num3]; 
				$backruolo = $backruolo[$num3];
			}	
		}
	}
	
	##################################################
	##### FUNZIONE - Tempo rimasto dall'ultima offerta
	##### Controlla quanto tempo resta alla scadenza di un'offerta presentata per un giocatore e riporta su schermo le azioni possibili
	
	function offerta_tempo_rimasto() {
		
		extract($GLOBALS);
		global $proprietario, $azione, $t_r, $propr_c, $props, $numero;
		
		$proprietario = "Svincolato";
		$propr_c = "";
		$props = "";
		
		$mercato = file($percorso_cartella_dati."/mercato_".$_SESSION ['torneo']."_".$_SESSION ['serie'].".txt");
		$num_mercato = count($mercato);
		$n = $num_mercato - 1;
		
		###############################################################
		#### Il ciclo controlla quanto manca alla scadenza dell'offerta
		
		$adesso = mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"));
		
		for($num2 = 0; $num2 < $num_mercato; $num2 ++) {
			$dati_mercato = explode(",",$mercato[$num2]);
			
			$tempo_off = $dati_mercato[5];
			$anno_off = substr($tempo_off, 0, 4);
			$mese_off = substr($tempo_off, 4, 2);
			$giorno_off = substr($tempo_off, 6, 2);
			$ora_off = substr($tempo_off, 8, 2);
			$minuto_off = substr($tempo_off, 10, 2);
			$secondo_off = substr($tempo_off, 12, 2);
			$sec_restanti = mktime($ora_off, $minuto_off, 0, intval($mese_off), $giorno_off, intval($anno_off) ) - $adesso;
			
			$numero_merc = $dati_mercato[0];
			$proprietario_merc = $dati_mercato[4];
			$tempo_off = $dati_mercato[5];
			$tempo_off_mer = 0;
			
			if ($numero_merc == $numero) {
				$props = "$proprietario_merc ";
				if ($proprietario_merc == $_SESSION ['utente']) {
					$propr_c .= $proprietario_merc;
				}
				
				if ($sec_restanti > 1) {
					$tempo=$anno_off.", ".$mese_off."-1, ".$giorno_off.", ".$ora_off.", ".$minuto_off.", ".$secondo_off; #formato 2012, 8-1, 02, 13, 14
					countdown($numero,$tempo);
					$t_r="<span id='$numero'></span> - <a href='offerta.php?num_calciatore=$numero&amp;valutazione=$valore&amp;squadra_ok=$squadra_ok&amp;mercato_libero=$mercato_libero' class='user'>rilancia</a>";
					} else {
					$t_r = "----";
				}
				
				if ($stato_mercato == "B") {
					$proprietario = "<font color='red' size='-2'>".$_SESSION['utente']."</font>";
					if ($propr_c != $_SESSION['utente'] and (double) substr($tempo_off_mer, 0, 12) <= (double) substr($data_busta_precedente, 0, 12)) {
						$proprietario = "<font color='red' size='-2'>$proprietario_merc</font>";
						$azione = "<a >Venduto</a>";
					}
				} 
				else {
					$proprietario = "<font color='red' size='-2'>$proprietario_merc</font>";
					$tempo_off_mer = $tempo_off;
				}
			}
		} ## fine for $num2	
		return $proprietario;
	}
	
	############################################
	##### FUNZIONE - Associa giocatori con ruolo
	##### Cerca nel file calciatori il COGNOME del giocatore ($nome), trova il numero della stringa e restituisce il numero di ruolo.
	
	function cerca_ruolo_giocatore($nome){
		global $ruolo, $backruolo;
		extract($GLOBALS);
		$nome_giocatore = strtoupper($nome);
		
		$lines = file('./dati/calciatori.txt');
		$line_number = false;		
		
		while (list($key, $line) = each($lines) and !$line_number) {
			$line_number = (strpos($line, $nome_giocatore) !== FALSE) ? $key + 1 : $line_number;
		}
		
		$dati_calciatore = explode($separatore_campi_file_calciatori, $lines[$line_number-1]);
		$ruolo = $dati_calciatore[5];
		
		assegna_ruoli();
		
	}
	
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
		
		global $ruolo, $backruolo, $titolari;
		extract($GLOBALS);
		
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
		<li>";
		cerca_ruolo_giocatore($titolari[0]);
		echo "<div class='playerNumber z-depth-2' style='background-image:url(./immagini/m_$vedi_squadra.gif)'></div>
		<div class='playerName card $backruolo'>".$titolari[0]."</div>
		</li>
		</ul>
		<ul class='difensori matchPlayersList module-".$mod[1]."'>";
		for ($i = $mod[1]; $i > 0; $i--){
			cerca_ruolo_giocatore($titolari[$i+0]);
			echo "<li>
			<div class='playerNumber z-depth-2' style='background-image:url(./immagini/m_$vedi_squadra.gif)'></div>
			<div class='playerName card $backruolo'>".$titolari[$i+0]."</div>
			</li>";
		}
		echo "</ul>
		<ul class='centrocampisti matchPlayersList module-".$mod[2]."'>";
		for ($i = $mod[2]; $i > 0; $i--){
			cerca_ruolo_giocatore($titolari[$i+$mod[1]]);
			echo "<li>
			<div class='playerNumber z-depth-2' style='background-image:url(./immagini/m_$vedi_squadra.gif)'></div>
			<div class='playerName card $backruolo'>".$titolari[$i+$mod[1]]."</div>
			</li>";
		}
		echo "</ul>
		<ul class='attaccanti matchPlayersList module-".$mod[3]."'>";
		for ($i = $mod[3]; $i > 0; $i--){
			cerca_ruolo_giocatore($titolari[$i+$mod[2]+$mod[1]]);
			echo "<li>
			<div class='playerNumber z-depth-2' style='background-image:url(./immagini/m_$vedi_squadra.gif)'></div>
			<div class='playerName card $backruolo'>".$titolari[$i+$mod[2]+$mod[1]]."</div>
			</li>";
		}
		echo "</ul>";
		if (count($mod) == 5 ) {
			echo "<ul class='punte matchPlayersList module-".$mod[4]."'>";
			for ($i = $mod[4]; $i > 0; $i--){
				cerca_ruolo_giocatore($titolari[$i+$mod[3]+$mod[2]+$mod[1]]);
				echo "<li>
				<div class='playerNumber' style='background-image:url(./immagini/m_$vedi_squadra.gif)'></div>
				<div class='playerName card $backruolo'>".$titolari[$i+$mod[3]+$mod[2]+$mod[1]]."</div>
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
		
		extract($GLOBALS);
		global $ruolo, $backruolo;
		
		######################################
		##### Controlla numero ultima giornata		
		
		$ultima_giornata = ultima_giornata_giocata();
		
		if ($ultima_giornata != "00") {
			$calciatori = file($percorso_cartella_voti."/voti".$ultima_giornata.".txt");
			$frase_giornata = "Dati aggiornati alla giornata $ultima_giornata";
		}
		else {
			$calciatori = file($percorso_cartella_dati."/calciatori.txt");
			$frase_giornata = "Dati relativi al precampionato";
		}
		
		$num_cer_squ = count($calciatori);
		
		$mercato = @file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
		$num_acquisti_mercato = count($mercato);
		
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
		<thead>
		<th>Nome</th>
		<th>V</th>
		<th>FV</th>
		<th>Val</th>
		<th>&nbsp;</td>
		</thead>
		</tr>";
		
		for ($num1 = 0 ; $num1 < $num_cer_squ ; $num1++) {
			
			##################################
			##### Controllo componenti squadra		
			
			$dati_calciatore = explode($separatore_campi_file_calciatori, $calciatori[$num1]);
			list ($numero, $giornata, $nome, $squadra, $attivo, $ruolo, $presenza, $votofc, $mininf25, $minsup25, $voto, $golsegnati, $golsubiti, $golvittoria, $golpareggio, $assist, $ammonizione, $espulsione, $rigoretirato, $rigoresubito, $rigoreparato, $rigoresbagliato, $autogol, $entrato, $titolare, $sv, $giocaincasa, $valore) = $dati_calciatore;
			
			$squadra = preg_replace( "#\"#","",$squadra);
			$nome = htmlentities(utf8_encode(preg_replace( "#\"#","",$nome)), 0, 'UTF-8');
			
			assegna_ruoli();
			
			if ($considera_fantasisti_come != $ruoli) $considera_fantasisti_come = "F";
			if ($ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
			
			####################################################
			##### Mostro solo i membri della squadra selezionata
			
			if ($vedi_squadra == $squadra and $attivo == "1") {
				$sx="on";
				
				################################################################
				##### Il ciclo controlla se qualche giocatore è stato acquistato
				
				for ($num2 = 0 ; $num2 < $num_acquisti_mercato ; $num2++) {
					$dati_calciatore = explode(",", $mercato[$num2]);
					$proprietario = $dati_calciatore[4];
					$numero_calciatore= $dati_calciatore[0];
					if ($proprietario == $outente and $numero_calciatore==$numero) $sx="off";
				}
				
				$table_layout .= "<tr>
				<td style='text-align:left'><b class='ruolo $backruolo'>$ruolo</b> <a href='stat_calciatore.php?num_calciatore=$numero&amp;ruolo_guarda=$ruolo_guarda&amp;escludi_controllo=$escludi_controllo' class='user'>$nome</a></td>
				<td class='center'>$voto</td>
				<td class='center'>$votofc</td>
				<td class='center'>$valore</td>";
				if ($_SESSION['valido'] == "SI" and $mercato_libero == "SI" and $stato_mercato == "I" and $sx!="off")  $table_layout .= "<td align='center'><a href='compra.php?num_calciatore=$numero&amp;valutazione=$valutazione' class='user'>compra</a></td>";
				elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "SI" and $stato_mercato != "I" and $sx!="off") $table_layout .= "<td align='center'><a href='cambi.php?num_calciatore=$numero' class='user'>cambia</a></td>";
				elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "NO" and ($stato_mercato == "I" or $stato_mercato == "P" or $stato_mercato == "S") and $sx!="off") $table_layout .= "<td align='center'><a href='offerta.php?num_calciatore=$numero' class='user'>offri</a></td>";
				//elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "NO" and $stato_mercato == "B") $table_layout .= "<td align='center'><a href='busta_offerta.php?num_calciatore=$numero&amp;valutazione=$valutazione&amp;xsquadra_ok=$xsquadra_ok&amp;mercato_libero=$mercato_libero' class='user'>inserisci nella busta</a></td>";
				elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "NO" and $stato_mercato == "B" and $sx!="off") $table_layout .= "<td align='center'><a class='user'>inserisci nella busta</a></td>";
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
	
	#################################
	##### MODULO - Tabella calciatori
	##### Mostra l'elenco completo dei giocatori presenti nel torneo.
	
	function tabella_calciatori($larghezza) {
		
		extract($GLOBALS);
		global $ruolo, $backruolo, $proprietario, $azione, $t_r, $propr_c, $props, $numero;
		
		#####################################
		#### Controlla numero ultima giornata
		
		$data_busta_chiusa = @join('',@file($percorso_cartella_dati."/data_buste_".$_SESSION['torneo']."_0.txt"));
		$data_busta_precedente = @join('',@file($percorso_cartella_dati."/data_buste_precedente_".$_SESSION['torneo']."_0.txt"));
		
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
		
		$layout = "<div class='card'>
		<div class='card-content'>
		<div class='row'>
		<div class='col m$larghezza'>
		<span class='card-title'>Elenco calciatori<span style='font-size: 13px;'> - $frase_voti</span></span>
		<hr>
		<table class='sortable centered highlight' style='width:100%' cellpadding='10' cellspacing='0' id='t1'>
		
		<tr>
		<thead>
		<th style='text-align: center'>&nbsp;&nbsp;Codice&nbsp;&nbsp;</th>
		<th style='text-align: center'>Nome</th>
		<th style='text-align: center'>Ruolo</th>
		<th style='text-align: center'>Operazioni</th>
		<th style='text-align: center'>Valutazione</th>";
		
		if ($mercato_libero == "SI")
		$layout .= "<th style='text-align: center'>Costo iniziale</th>";
		else
		$layout .= "<th style='text-align: center'>Proprietario</th>";
		
		$layout .= "<th style='text-align: center'>Squadra</th></thead></tr>";

		$num_calciatori = count($calciatori);
		
		for($num1 = 0; $num1 < $num_calciatori; $num1++) {
			
			$valore_mercato = " - ";
			$tempo_restante = "";
			$dati_calciatore = explode($separatore_campi_file_calciatori, $calciatori [$num1]);
			list ($numero, $giornata, $nome, $squadra, $attivo, $ruolo, $presenza, $votofc, $mininf25, $minsup25, $voto, $golsegnati, $golsubiti, $golvittoria, $golpareggio, $assist, $ammonizione, $espulsione, $rigoretirato, $rigoresubito, $rigoreparato, $rigoresbagliato, $autogol, $entrato, $titolare, $sv, $giocaincasa, $valore) = $dati_calciatore;
			
			$squadra = preg_replace( "#\"#","",$squadra);
			$nome = htmlentities(utf8_encode(preg_replace( "#\"#","",$nome)), 0, 'UTF-8');
			
			assegna_ruoli();
			
			if ($considera_fantasisti_come != $ruoli) $considera_fantasisti_come = "F";
			if ($ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
			
			if ($ruolo == $ruolo_guarda or $ruolo_guarda == "tutti") {
				$num_cer_val = count($calciatori);
				
				for($num2 = 0; $num2 < $num_cer_val; $num2 ++) {
					$dati_cervalcal = explode($separatore_campi_file_calciatori, $calciatori [$num2]);
					$num_cervalcal = $dati_cervalcal[($num_colonna_numcalciatore_file_calciatori - 1)];
					$num_cervalcal = trim($num_cervalcal);
					
					if ($num_cervalcal == $numero) {
						$costo = $dati_cervalcal[($num_colonna_valore_calciatori - 1)];
						$costo = trim($costo);
						break;
					} else
					$costo = "-";
				}
				
				$mercato = file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
				$num_mercato = count($mercato);
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
							$azione = "<a href='scambia.php?num_calciatore=$numero&amp;altro_utente=$proprietario_merc' class='user'>scambia</a>";
							$proprietario = "<font color='red' size='-2'>$propr_c</font>";
						} 
						elseif ($propr_c != $_SESSION['utente'] and !isset($azione)) {
							$azione = "<a href='busta_offerta.php?num_calciatore=$numero&valutazione=$valore&squadra_ok=$squadra_ok&mercato_libero=$mercato_libero' class='user'>offri</a>";
							$proprietario = "Svincolato";
						}
					} 
					
					elseif ($proprietario == "Svincolato" and ($stato_mercato == "I" or "A" or "P"))
					$azione = "<a href='offerta.php?num_calciatore=$numero&amp;valutazione=$valore&amp;squadra_ok=$squadra_ok&amp;mercato_libero=$mercato_libero&amp;ruolos=$ruolo' class='user'>offri</a>";
					elseif ($proprietario == "Svincolato" and $stato_mercato == "B")
					$azione = "<a href='busta_offerta.php?num_calciatore=$numero&amp;valutazione=$valore&amp;squadra_ok=$squadra_ok&amp;mercato_libero=$mercato_libero' class='user'>offri con busta</a>";
					elseif ($proprietario == "Svincolato" and $stato_mercato == "R")
					$azione = "<a href='compra.php?num_calciatore=$numero&amp;valutazione=$valore&amp;squadra_ok=$squadra_ok' class='user'>compra</a>";
					elseif ($_SESSION ['utente'] != $propr_c and $stato_mercato == "B")
					$azione = "<a href='busta_offerta.php?num_calciatore=$numero&amp;valutazione=$valore&amp;squadra_ok=$squadra_ok&amp;mercato_libero=$mercato_libero' class='user'>offri con busta</a>";
					elseif ($_SESSION ['utente'] != $propr_c and $stato_mercato == "I")
					$azione = $t_r;
					elseif ($_SESSION ['utente'] != $propr_c and $stato_mercato == "P")
					$azione = "<a href='offerta.php?num_calciatore=$numero&amp;valutazione=$valore&amp;squadra_ok=$squadra_ok&amp;mercato_libero=$mercato_libero' class='user'>offri</a>";
					elseif ($_SESSION ['utente'] != $propr_c and ($stato_mercato == "S" or "A")) {
						$ppr = cerca_proprietario($numero);
						$azione = "<a href='scambia.php?num_calciatore=$numero&amp;altro_utente=$ppr' class='user'>scambia</a>";
					} 
					elseif ($_SESSION ['utente'] == $propr_c and $stato_mercato == "B")
					$azione = "<a href='busta_vendi.php?num_calciatore=$numero' class='user'>togli dalla busta</a>";
					elseif ($_SESSION ['utente'] == $propr_c and ($stato_mercato == "I" or "R" or "A" or "P") and $tempo_restante == "")
					$azione = "<a href='vendi.php?num_calciatore=$numero' class='user'>vendi</a>";
					else $azione = "-";
				} 
				
				elseif ($mercato_libero == "SI") {
					if ($squadra_ok == "NO" and $_SESSION ['utente'] != $propr_c)
					$azione = "<a href='compra.php?num_calciatore=$numero&amp;valutazione=$valore&amp;squadra_ok=NO' class='user'>compra</a>";
					elseif (($stato_mercato == "I" or "R") and $_SESSION ['utente'] == $propr_c)
					$azione = "<a href='vedi_vendi_subito.php?num_calciatore=$numero' class='user'>svincola</a>";
					elseif ($stato_mercato == "I" and $_SESSION ['utente'] != $propr_c)
					$azione = "<a href='compra.php?num_calciatore=$numero&amp;valutazione=$valore' class='user'>compra</a>";
					elseif ($stato_mercato == "A" and $_SESSION ['utente'] != $propr_c)
					$azione = "<a href='cambi.php?num_calciatore=$numero' class='user'>cambi</a>";
					else
					$azione = "-";
				} else $azione = "Errore di configurazione";
				
				if ($stato_mercato == "C") $azione = "Mercato chiuso";
				if ($attivo == 0) $azione = "<font color='red'><b>Trasferito</b></font>";
				if ($blocco == 1) $azione = "<font color='red'>Attendere aggiornamento</font>";
				
				if ($stato_mercato != "I") $link_info = "<a href='stat_calciatore.php?num_calciatore=$numero&amp;ruolo_guarda=$ruolo_guarda' class='user'>$numero</a>";
				else $link_info = "<u>$numero</u>";
				
				if ($stato_mercato == "A" and $mercato_libero == "SI" and $props and $pallinogiallo == "SI")
				$info = "<img src='./immagini/info1.gif' style='border:0; margin:0;' title='$props' alt='$props' />";
				
				$layout .= "<tr>
				<td>$link_info</td>
				<td>$nome $info</td>
				<td><span class='ruolo $backruolo'>$ruolo</span></td>
				<td>$azione</td>
				<td>".intval($valore)."</td>";
				
				if ($mercato_libero == "SI") $layout .= "<td class='center'>".intval($costo)."</td>";
				else $layout .= "<td class='center'>&nbsp;$proprietario</td>";
				
				$layout .= "<td class='center'><a href='tab_squadre.php?vedi_squadra=$squadra'>$squadra</a></td></tr>";
				
				
			} // fine if ($ruolo == $ruolo_guarda or ...)
		} // fine for $num1
		$layout .= "</table></div></div></div></div>";
		echo $layout;
	}	
	
?>