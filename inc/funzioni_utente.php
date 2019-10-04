<?php
	
	function statistiche_rosa() {
		extract($GLOBALS);
		global $ruolo, $backruolo, $ruoli_in_parole, $stat_squadra, $stat_voto, $stat_valore, $num_calciatore_voto, $nome,
		$quotazione_iniziale, $partite_giocate, $ultima_giornata, $totamm, $totesp, $totgol, $totgolsub, $totass, $totrigp, 
		$totrigt, $totrigs, $totrigsb, $totaut, $media_giornale, $media_punti, $stringav, $stringafv, $stringaval, $stato, 
		$vedi_squadra;
		
		if ($stato_mercato != "I" AND $ultima_giornata >= 1) $voti = file("$percorso_cartella_voti/voti$ultima_giornata.txt");
		else $voti = file("$percorso_cartella_dati/calciatori.txt");
		
		$tabella = "<table class='highlight' width='100%' cellpadding='0' cellspacing='0' align='center' bgcolor='$sfondo_tab' summary='Tabella statistiche squadra'>
		<tr>
		<thead>
		<th></th>
		<th>Nome</th>
		<th>Squadra</th>
		<th class='center'>Gare</th>
		<th class='center'>Medie</th>
		<th class='center'>Gol</th>
		<th class='center'>Assist</th>
		<th class='center'>Gialli</th>
		<th class='center'>Rossi</th>
		<th class='center'>Rigori</th>
		<th class='center'>Cos / Val</th>
		<th class='center'>Ultimi</th>
		</thead>
		</tr>";
		
		$num_voti = count($voti);
		#Aggiunte
		$cerca_squadra = file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
		$num_cer_squ = count($cerca_squadra);
		
		#print_r ($cerca_squadra);
		#echo "<hr>";
		array_multisort ($cerca_squadra, SORT_ASC, SORT_STRING);
		#print_r ($cerca_squadra);
		
		$partite_giocate = 0;
		$somma_voti_tot = 0;
		$somma_voti_giornale = 0;
		$count=0;
		for ($knum1 = 0 ; $knum1 <= $num_cer_squ ; $knum1++) {	
			$dati_calciatore = explode(",", trim($cerca_squadra[$knum1]));
			list ($num_calciatore, $nome, $ruolo, $valore, $xsquadra) = $dati_calciatore;
			
			$nome = preg_replace("#\"#","",$nome);
			$xsquadra = preg_replace("#\"#","",$xsquadra);
			assegna_ruoli('calciatori');
			
			if ($xsquadra == $vedi_squadra) {	
				for ($num1 = 1; $num1 < 40; $num1++) {
					if (strlen($num1) == 1) $num1 = "0".$num1;
					
					if ($voti = @file("$percorso_cartella_voti/voti$num1.txt")) {
						$num_voti = count($voti);
						for ($num2 = 0 ; $num2 <= $num_voti ; $num2++) {
							$dati_voto = explode($separatore_campi_file_voti, $voti[$num2]);
							list ($num_calciatore_voto, $stat_giornata, $stat_nome, $stat_squadra, $stat_attivo, $stat_ruolo, $stat_presenza, $stat_votofc, $stat_mininf25, $stat_minsup25, $stat_voto, $stat_golsegnati, $stat_golsubiti, $stat_golvittoria, $stat_golpareggio, $stat_assist, $stat_ammonizione, $stat_espulsione, $stat_rigoretirato, $stat_rigoresubito, $stat_rigoreparato, $stat_rigoresbagliato, $stat_autogol, $stat_subentrato, $stat_titolare, $stat_sv, $stat_giocaincasa, $stat_valore) = $dati_voto;
							
							if ($num_calciatore == $num_calciatore_voto) {
								$voto_tot = $dati_voto[($num_colonna_vototot_file_voti-1)];
								$voto_tot = togli_acapo($voto_tot);
								$voto_tot = str_replace(",",".",$voto_tot);
								$voto_giornale = $dati_voto[($num_colonna_votogiornale_file_voti-1)];
								$voto_giornale = togli_acapo($voto_giornale);
								$voto_giornale = str_replace(",",".",$voto_giornale);
								$uvt = $voto_tot; $uvg = $voto_giornale;
								if ($voto_tot != 0 or $voto_giornale != 0) {
									$partite_giocate++;
									$somma_voti_tot = $somma_voti_tot + $voto_tot;
									$somma_voti_giornale = $somma_voti_giornale + $voto_giornale;
								} # fine if ($voto_tot != 0 or $voto_giornale != 0)
								
								$stat_nome = preg_replace ( "/\"/", "",$stat_nome);
								$stat_squadra = preg_replace ( "/\"/", "",$stat_squadra);
								$totpresenze = $totpresenze + $stat_presenza;
								$totvotfc = $totvotfc + $stat_votofc;
								$totmininf25 = $totmininf25 + $stat_mininf25;
								$totminsup25 = $totminsup25 + $stat_minsup25;
								$totvot = $totvot + $stat_voto;
								$totgol = $totgol + $stat_golsegnati;
								$totgolsub = $totgolsub + $stat_golsubiti;
								$totgolvit = $totgolvit + $stat_golvittoria;
								$totgolpar = $totgolpar + $stat_golpareggio;
								$totass = $totass + $stat_assist;
								$totamm = $totamm + $stat_ammonizione;
								$totesp = $totesp + $stat_espulsione;
								$totrigt = $totrigt + $stat_rigoretirato;
								$totrigs = $totrigs + $stat_rigoresubito;
								$totrigp = $totrigp + $stat_rigoreparato;
								$totrigsb = $totrigsb + $stat_rigoresbagliato;
								$totaut = $totaut + $stat_autogol;
								$stat_subentrato = $dati_voto[($ncs_entrato -1)];
								$tottit = $tottit + $stat_titolare;
								$stat_valore = $dati_voto[($ncs_valore -1)];
								$tot_golsegnati = $tot_golsegnati + $stat_golsegnati;
								$tot_golsubiti = $tot_golsubiti + $stat_golsubiti;
								
								break;
							} # fine if ($num_calciatore == $num_calciatore_voto)
							#$ultima_giornata = $num1;
						} # fine if ($voti = @file("$percorso_cartella_voti/MCC$num1.txt"))
					} # fine for $num2
				} # fine for $num1
				
				if ($partite_giocate != 0) {
					$media_giornale = round(($somma_voti_giornale /$partite_giocate),2);
					$media_punti = round(($somma_voti_tot / $partite_giocate),2);
				} # fine if ($partite_giocate != 0)
				else {
					$media_giornale = 0;
					$media_punti = 0;
				} # fine else if ($partite_giocate != 0)
				if ($stat_attivo == 0) $mess = "<b><font color=red>Non disponibile</font></b>";
				else $mess = "In attività";
				
				if ($ruolo == "P") $tot_golsegnati = $tot_golsubiti;
				if ($stat_attivo == "0") $csattivo = " - <font class='piccolo'>Trasferito</font>"; else $csattivo = "";
				
				
				$lmsquadra = "m_".strtolower($stat_squadra).".gif";
				$squadra = "<img class='iconasquadra z-depth-2' src='./immagini/$lmsquadra'/><a href='tab_squadre.php?vedi_squadra=$stat_squadra' style=' border: 0px; text-decoration: none;'>$stat_squadra</a>";
				assegna_ruoli('mercato');
				
				$count++;
				$tabella .= "<tr class='$ruolo'>
				<td class='center'><b class='ruolo $backruolo'>$ruolo</b></td> 
				<td><a href='stat_calciatore.php?num_calciatore=$num_calciatore'>$nome</a> $csattivo</td>
				<td>$squadra</td>
				<td class='center'>$totpresenze</td>
				<td class='center'>$media_punti ($media_giornale)</td>
				<td class='center'>$tot_golsegnati</td>
				<td class='center'>$totass</td>
				<td class='center'>$totamm</td>
				<td class='center'>$totesp</td>
				<td class='center'>$totrigt</td>
				<td class='center'>$valore / $stat_valore</td>
				<td class='center'>$uvt ($uvg)</td></tr>";
				$sum = 0;
				
				for($i = 0; $i <= 3; $i++){
					$sum += $media_giornale;
				}
				
				//if($count == 3) {
				//	$tabella .= "<tr>
				//	<td colspan='9'></td>
				//	<td class='center'>$sum</td>
				//	<td class='center'>$uvt ($uvg)</td></tr>";
				//}
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
		echo $tabella;
	}
	
	########################
	##### FUNZIONE - Grafico
	##### Visualizza un grafico con i dati immessi
	
	function grafico($numero_grafico,$tipo,$titolo,$vocex,$vocey,$datix,$datiy,$leggendax,$leggenday){
		
		extract($GLOBALS);
		
		echo'<div id="container',$numero_grafico,'" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		<script>
		Highcharts.chart("container'.$numero_grafico.'", {
		chart: {
		type: "'.$tipo.'"
		},
		title: {
		text: "'.$titolo.'"
		},
		xAxis: {
		categories: ["1", "2", "3", "4", "5", "6",
		"7", "8", "9", "10", "11", "12",
		"13", "14", "15", "16", "17", "18",
		"19", "20", "21", "22", "23", "24",
		"25", "26", "27", "28", "29", "30",
		"31", "32", "33", "34", "35", "36", "37", "38"],
		title: {
		text: "'.$vocex.'"
		}
		},
		yAxis: {
		title: {
		text: "'.$vocey.'"
		}
		},
		tooltip: {
		crosshairs: true,
		shared: true,
		},
		plotOptions: {
		spline: {
		marker: {
		radius: 4,
		lineColor: "#666666",
		lineWidth: 1
		}
		}
		}, 
		series: [{
		name: "'.$leggendax.'",
		marker: {
		symbol: "diamond"
		},
		data: ['.$datix.']
		}, ';
		if ($datiy != null) {
			echo '{
			name: "'.$leggenday.'",
			marker: {
			symbol: "square"
			},
			color: "#8b0000",
			data: ['.$datiy.']
			}';
		}
		echo ']
		});
		</script>';
	}
	
	#######################################
	##### FUNZIONE - Statistiche Calciatori
	##### Restituisce le statistiche stagionali del calciatore visualizzato estrapolandoli dal file voti
	
	function statistiche_calciatore($code) {
		
		extract($GLOBALS);
		global $ruolo, $backruolo, $ruoli_in_parole, $stat_squadra, $stat_voto, $stat_valore, $num_calciatore_voto, $nome,
		$quotazione_iniziale, $partite_giocate, $ultima_giornata, $totamm, $totesp, $totgol, $totgolsub, $totass, $totrigp, 
		$totrigt, $totrigs, $totrigsb, $totaut, $media_giornale, $media_punti, $stringav, $stringafv, $stringaval, $stato;
		
		$partite_giocate = 0;
		$somma_voti_tot = 0;
		$somma_voti_giornale = 0;
		
		for ($num1 = 1; $num1 < 40; $num1++) {
			if (strlen($num1) == 1) $num1 = "0".$num1;
			
			if ($voti = @file("$percorso_cartella_voti/voti$num1.txt")) {
				$num_voti = count($voti);
				for ($num2 = 0; $num2 < $num_voti; $num2++) {
					$dati_voto = explode($separatore_campi_file_voti, $voti[$num2]);
					list ($num_calciatore_voto, $stat_giornata, $stat_nome, $stat_squadra, $stat_attivo, $stat_ruolo, $stat_presenza, $stat_votofc, $stat_mininf25, $stat_minsup25, $stat_voto, $stat_golsegnati, $stat_golsubiti, $stat_golvittoria, $stat_golpareggio, $stat_assist, $stat_ammonizione, $stat_espulsione, $stat_rigoretirato, $stat_rigoresubito, $stat_rigoreparato, $stat_rigoresbagliato, $stat_autogol, $stat_subentrato, $stat_titolare, $stat_sv, $stat_giocaincasa, $stat_valore) = $dati_voto;
					
					if ($code == $num_calciatore_voto) {
						$stat_votofc = str_replace(",",".",$stat_votofc);
						$stat_voto = str_replace(",",".",$stat_voto);
						$stat_valore = str_replace(",",".",$stat_valore);
						
						$stringafv .= $dati_voto[7].",";
						$stringav .= $dati_voto[10].",";
						$stringaval .= $dati_voto[27].",";
						
						if ($stat_votofc != 0 or $stat_voto != 0) {
							$partite_giocate++;
							$somma_voti_tot = $somma_voti_tot + $stat_votofc;
							$somma_voti_giornale = $somma_voti_giornale + $stat_voto;
						} 
						
						$stat_nome = preg_replace ( "/\"/", "",$stat_nome);
						$stat_squadra = preg_replace ( "/\"/", "",$stat_squadra);
						$totpresenze = $totpresenze + $stat_presenza;
						$totvotfc = $totvotfc + $stat_votofc;
						$totmininf25 = $totmininf25 + $stat_mininf25;
						$totminsup25 = $totminsup25 + $stat_minsup25;
						$totvot = $totvot + $stat_voto;
						$totgol = $totgol + $stat_golsegnati;
						$totgolsub = $totgolsub + $stat_golsubiti;
						$totgolvit = $totgolvit + $stat_golvittoria;
						$totgolpar = $totgolpar + $stat_golpareggio;
						$totass = $totass + $stat_assist;
						$totamm = $totamm + $stat_ammonizione;
						$totesp = $totesp + $stat_espulsione;
						$totrigt = $totrigt + $stat_rigoretirato;
						$totrigs = $totrigs + $stat_rigoresubito;
						$totrigp = $totrigp + $stat_rigoreparato;
						$totrigsb = $totrigsb + $stat_rigoresbagliato;
						$totaut = $totaut + $stat_autogol;
						$tottit = $tottit + $stat_titolare;
						
						break;
					} # fine if ($num_calciatore == $num_calciatore_voto)
					$ultima_giornata = $num1;
				} # fine if ($voti = @file("$percorso_cartella_voti/voti$num1.txt"))
			} # fine for $num2
		} # fine for $num1
		if ($partite_giocate != 0) {
			$media_giornale = round(($somma_voti_giornale/$partite_giocate),2);
			$media_punti = round(($somma_voti_tot/$partite_giocate),2);
		} # fine if ($partite_giocate != 0)
		else {
			$media_giornale = 0;
			$media_punti = 0;
		} # fine else if ($partite_giocate != 0)
		
		if ($ultima_giornata != "") $calciatori = file("$prima_parte_pos_file_voti$ultima_giornata.txt");
		else $calciatori = file("$percorso_cartella_dati/calciatori.txt");
		$calciatori_iniziale = file("$percorso_cartella_dati/calciatori.txt");
		
		$num_calciatori = count($calciatori);
		for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
			$dati_calciatore = explode($separatore_campi_file_calciatori, $calciatori[$num1]);
			list ($numero, $giornata, $nome, $squadra, $attivo, $ruolo, $presenza, $votofc, $mininf25, $minsup25, $voto, $golsegnati, $golsubiti, $golvittoria, $golpareggio, $assist, $ammonizione, $espulsione, $rigoretirato, $rigoresubito, $rigoreparato, $rigoresbagliato, $autogol, $entrato, $titolare, $sv, $giocaincasa, $valore) = $dati_calciatore;
			
			if ($num_calciatore == $numero) {
				
				$squadra = preg_replace( "#\"#","",$squadra);
				$nome = htmlentities(utf8_encode(preg_replace( "#\"#","",$nome)), 0, 'UTF-8');
				
				assegna_ruoli('calciatori');
				
				if ($considera_fantasisti_come != $ruoli) $considera_fantasisti_come = "F";
				if ($ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
				
				###### Quotazione iniziale ######
				$valore_calciatore = explode($separatore_campi_file_calciatori, $calciatori_iniziale[$num1]);
				$quotazione_iniziale = $valore_calciatore[($num_colonna_valore_calciatori-1)];
				break;
			} # fine if ($num_calciatore == $numero)
		} # fine for $num1
		
		if ($stat_attivo == 0) $stato = "<b><font color='darkred'>Trasferito</font></b>";
		else $stato = "<b><font color='darkgreen'>In attivit&agrave;</font></b>";	
		
	}
	
	##############################
	##### FUNZIONE - Assegna ruoli
	##### Converte i ruoli da numeri a lettere, assegnando un colore di background
	
	function assegna_ruoli($file_riferimento) {
		
		extract($GLOBALS);
		global $ruolo, $backruolo, $ruoli_in_parole, $ruoli;
		
		$ruoli = array("P", "D", "C", "A");
		$ruoli_in_parole = array("PORTIERE", "DIFENSORE", "CENTROCAMPISTA", "ATTACCANTE");
		if ($file_riferimento != "mercato") {
			$simboli = array($simbolo_portiere_file_calciatori, $simbolo_difensore_file_calciatori, $simbolo_centrocampista_file_calciatori, $simbolo_attaccante_file_calciatori);
			} elseif ($file_riferimento == "mercato") {
			$simboli = $ruoli;
		}
		$backruolo = array("orange darken-4", "indigo darken-4", "green darken-4", "red darken-4");
		
		for ($num3 = 0; $num3 < 4; $num3++) {
			if ($ruolo == $simboli[$num3]) {
				$ruolo = $ruoli[$num3]; 
				$backruolo = $backruolo[$num3];
				$ruoli_in_parole = $ruoli_in_parole[$num3];
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
	
	function cerca_ruolo_giocatore($nome) {
		
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
		
		assegna_ruoli('calciatori');
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
		<img style='vertical-align: middle;' width='100' src='$casa'> <span class='vs'>VS</span> <img style='vertical-align: middle;'  width='100' src='$trasferta'> 
		<br><br>$data - $ora
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
	##### Mostra la rosa completa di Serie A della squadra della quale si visualizzano le info.
	
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
		<th></th>
		<th>Nome</th>
		<th>V</th>
		<th>FV</th>
		<th>Val</th>
		<th>&nbsp;</th>
		</thead>
		</tr>";
		
		for ($num1 = 0 ; $num1 < $num_cer_squ ; $num1++) {
			
			##################################
			##### Controllo componenti squadra		
			
			$dati_calciatore = explode($separatore_campi_file_calciatori, $calciatori[$num1]);
			list ($numero, $giornata, $nome, $squadra, $attivo, $ruolo, $presenza, $votofc, $mininf25, $minsup25, $voto, $golsegnati, $golsubiti, $golvittoria, $golpareggio, $assist, $ammonizione, $espulsione, $rigoretirato, $rigoresubito, $rigoreparato, $rigoresbagliato, $autogol, $entrato, $titolare, $sv, $giocaincasa, $valore) = $dati_calciatore;
			
			$squadra = preg_replace( "#\"#","",$squadra);
			$nome = htmlentities(utf8_encode(preg_replace( "#\"#","",$nome)), 0, 'UTF-8');
			
			assegna_ruoli('calciatori');
			
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
				<td class='center' style='padding: 5px;'><span class='ruolo $backruolo'>$ruolo</span></td>
				<td class='left'><a href='stat_calciatore.php?num_calciatore=$numero&amp;ruolo_guarda=$ruolo_guarda&amp;escludi_controllo=$escludi_controllo' class='user'>$nome</a></td>
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
		<div class='card-action'>
          <a href='http://localhost/fcbe-material-design/statistiche.php?numgio=tutte&squadra_guarda=$vedi_squadra&anno_guarda=$cartella_remota'>Guarda le statistiche complete della rosa <i class='material-icons right'>send</i></a>
        </div>
		</div>";
		echo $table_layout;
	}
	
	###############################
	##### MODULO - Registro Mercato
	##### Mostra il riepilogo degli acquisti, con la possibilità di filtrare le operazioni per ogni utente.
	
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
		global $ruolo, $backruolo, $proprietario, $azione, $t_r, $propr_c, $props, $num_calciatori, $calciatori;
		
		#####################################
		#### Controlla numero ultima giornata
		
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
		
		$layout = "<div class='card'>
		<div class='card-content'>
		<div class='row'>
		<div class='col m$larghezza'>
		<span class='card-title'>Elenco calciatori<span style='font-size: 13px;'> - $frase_voti</span></span>
		<hr>
		
		<div class='row'>
		<div class='col m6 center'><label>Filtra per ruolo:</label>
		<div class='switch' style='padding-top: 10px;'>
		<label>
		<input id='switch_portieri' type='checkbox' checked>
		<span class='lever portieri'></span>
		</label>
		<label>
		<input id='switch_difensori' type='checkbox' checked>
		<span class='lever difensori'></span>
		</label>
		<label>
		<input id='switch_centrocampisti' type='checkbox' checked>
		<span class='lever centrocampisti'></span>
		</label>
		<label>
		<input id='switch_attaccanti' type='checkbox' checked>
		<span class='lever attaccanti'></span>
		</label>
		</div>
		</div>
		<div class='col m6 center'><label>Cerca giocatore:</label>
        <div class='input-field' style='margin: 0;'>
		<input type='text' id='search'></input>
        </div>
		</div>
		</div>
		
		<table class='sortable responsive-table highlight' style='width:100%' cellpadding='10' cellspacing='0' id='t1'>
		<tr>
		<thead>
		<th></th>
		<th>Calciatore</th>
		<th>Squadra</th>
		<th>Presenze</th>
		<th>Media Voto</th>
		<th style='text-align: center'>Media FantaVoto</th>";
		
		if ($mercato_libero == "SI")
		$layout .= "<th style='text-align: center'>Quotazione</th>";
		else
		$layout .= "<th style='text-align: center'>Quotazione</th>";
		
		$layout .="<th>Operazioni</th></thead></tr>";
		
		$num_calciatori = count($calciatori);
		
		for($num1 = 0; $num1 < $num_calciatori; $num1++) {
			
			$valore_mercato = " - ";
			$tempo_restante = "";
			$dati_calciatore = explode($separatore_campi_file_calciatori, $calciatori [$num1]);
			list ($numero, $giornata, $nome, $squadra, $attivo, $ruolo, $presenza, $votofc, $mininf25, $minsup25, $voto, $golsegnati, $golsubiti, $golvittoria, $golpareggio, $assist, $ammonizione, $espulsione, $rigoretirato, $rigoresubito, $rigoreparato, $rigoresbagliato, $autogol, $entrato, $titolare, $sv, $giocaincasa, $valore) = $dati_calciatore;
			
			$squadra = preg_replace( "#\"#","",$squadra);
			$nome = htmlentities(utf8_encode(preg_replace( "#\"#","",$nome)), 0, 'UTF-8');
			if ($stato_mercato != "I") $nome = "<a href='stat_calciatore.php?num_calciatore=$numero' class='user'>$nome</a>";
			
			assegna_ruoli('calciatori');
			
			if ($considera_fantasisti_come != $ruoli) $considera_fantasisti_come = "F";
			if ($ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
			
			if ($ruolo == $ruolo_guarda or $ruolo_guarda == "tutti") {
				$num_cer_val = count($calciatori_iniziale);
				
				
				for($num2 = 0; $num2 < $num_cer_val; $num2 ++) {
					$dati_cervalcal = explode($separatore_campi_file_calciatori, $calciatori_iniziale[$num2]);
					$num_cervalcal = $dati_cervalcal[($num_colonna_numcalciatore_file_calciatori - 1)];
					$num_cervalcal = trim($num_cervalcal);
					
					if ($num_cervalcal == $numero) {
						$costo = $dati_cervalcal[($num_colonna_valore_calciatori - 1)];
						$costo = trim($costo);
						break;
					} else
					$costo = "-";
				}
				
				$partite_giocate = 0;
				$somma_voti_tot = 0;
				$somma_voti_giornale = 0;
				
				for ($num3 = 1; $num3 < 40; $num3++) {
					if (strlen($num3) == 1) $num3 = "0".$num3;
					
					if ($voti = @file("$percorso_cartella_voti/voti$num3.txt")) {
						$num_voti = count($voti);
						for ($num4 = 0; $num4 < $num_voti; $num4++) {
							$dati_voto = explode($separatore_campi_file_voti, $voti[$num4]);
							list ($num_calciatore_voto, $stat_giornata, $stat_nome, $stat_squadra, $stat_attivo, $stat_ruolo, $stat_presenza, $stat_votofc, $stat_mininf25, $stat_minsup25, $stat_voto, $stat_golsegnati, $stat_golsubiti, $stat_golvittoria, $stat_golpareggio, $stat_assist, $stat_ammonizione, $stat_espulsione, $stat_rigoretirato, $stat_rigoresubito, $stat_rigoreparato, $stat_rigoresbagliato, $stat_autogol, $stat_subentrato, $stat_titolare, $stat_sv, $stat_giocaincasa, $stat_valore) = $dati_voto;
							
							if ($numero == $num_calciatore_voto) {
								$stat_votofc = str_replace(",",".",$stat_votofc);
								$stat_voto = str_replace(",",".",$stat_voto);
								$stat_valore = str_replace(",",".",$stat_valore);
								
								if ($stat_votofc != 0 or $stat_voto != 0) {
									$partite_giocate++;
									$somma_voti_tot = $somma_voti_tot + $stat_votofc;
									$somma_voti_giornale = $somma_voti_giornale + $stat_voto;
								} 
								
								break;
							} # fine if ($num_calciatore == $num_calciatore_voto)
							$ultima_giornata = $num1;
						} # fine if ($voti = @file("$percorso_cartella_voti/voti$num1.txt"))
					} # fine for $num2
				} # fine for $num1
				if ($partite_giocate != 0) {
					$media_giornale = round(($somma_voti_giornale/$partite_giocate),2);
					$media_punti = round(($somma_voti_tot/$partite_giocate),2);
				} # fine if ($partite_giocate != 0)
				else {
					$media_giornale = 0;
					$media_punti = 0;
				} # fine else if ($partite_giocate != 0)
				
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
				
				if ($stato_mercato == "A" and $mercato_libero == "SI" and $props and $pallinogiallo == "SI")
				$info = "<img src='./immagini/info1.gif' style='border:0; margin:0;' title='$props' alt='$props' />";
				
				
				$layout .= "<tr class='$ruolo'>
				<td class='center' style='padding: 15px;'><span class='ruolo $backruolo'>$ruolo</span></td>
				<td>$nome $info</td>
				<td><img class='iconasquadra' src='./immagini/m_$squadra.gif'><a href='tab_squadre.php?vedi_squadra=$squadra'>$squadra</a></td>
				<td class='center'>$partite_giocate</td>
				<td class='center'>$media_giornale</td>
				<td class='center'>$media_punti</td>
				<td class='center'>".intval($valore)."</td>";
				
				if ($mercato_libero == "SI") $layout .= "";
				else $layout .= "<td class='center'>&nbsp;$proprietario</td>";
				
				$layout .= "<td class='center'>$azione</td>
				</tr>";
				
				
			} // fine if ($ruolo == $ruolo_guarda or ...)
		} // fine for $num1
		$layout .= "</table></div></div></div></div>";
		echo $layout;
	}	
	
	#################################
	##### MODULO - Rosa utenti
	##### Mostra l'elenco completo delle rose dei partecipanti al torneo.
	
	function rosa_utenti() {
		
		
		extract($GLOBALS);
		global $percorso_cartella_dati, $backruolo, $ruolo;
		
		if ($_SESSION ['valido'] == "SI" and ($stato_mercato != "I" or $stato_mercato != "R" or $_SESSION ['permessi'] == 4)) {
			
			$chiusura_giornata = (int) @file($percorso_cartella_dati."/chiusura_giornata.txt");
			
			$nome_squadra = "tutti";
			// ###########################################
			$utenti = @file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
			$linee = count($utenti);
			for($num1 = 1; $num1 < $linee; $num1 ++) {
				@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $utenti [$num1]);
				
				
				
				// ###################################################################
				$contatore_calciatori = 0;
				$lista_calciatori = "";
				$soldi_spesi = 0;
				$num_calciatori_posseduti = 0;
				$np = 0;
				$nd = 0;
				$nc = 0;
				$nf = 0;
				$na = 0;
				$linea_offerto = "";
				$linea_comprato_P = "";
				$linea_comprato_D = "";
				$linea_comprato_C = "";
				$linea_comprato_F = "";
				$linea_comprato_A = "";
				$tab_comprati = "";
				$tab_offerte = "<table class='sortable responsive-table highlight' style='width:100%' cellpadding='10' cellspacing='0' id='t1'>
				<tr><td class='testa'>Num.</td>
				<td class='testa'>Nome giocatore</td>
				<td class='testa'>Ruolo</td>
				<td class='testa'>Costo</td>
				<td class='testa'>Tempo rimasto</td></tr>";
				
				$calciatori = file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
				//Lo ordino numericamente, in maniera decrescente per avere la data più recente in alto
				array_multisort($calciatori,SORT_NUMERIC,SORT_ASC);		
				
				$np = 0;
				$nd = 0;
				$nc = 0;
				$nf = 0;
				$na = 0;
				
				$num_calciatori = count ($calciatori);
				for($num2 = 0; $num2 < $num_calciatori; $num2 ++) {
					
					$surplus = INTVAL($ocrediti);
					$variazioni = INTVAL($ovariazioni);
					$cambi_effettuati = INTVAL($ocambi);
					$soldi_spendibili = $soldi_iniziali + $surplus + $variazioni - $soldi_spesi;
					
					
					if ($osquadra) {
						$titolo = "$osquadra<p class='creditirimasti right indigo darken-4'>$soldi_spendibili<small>Crediti rimasti</small></p>"; 
						} else {
						$titolo = "Squadra";
					}
					
					$dati_calciatore = explode(",", $calciatori[$num2]);
					$numero = $dati_calciatore [0];
					$ruolo = $dati_calciatore [2];
					$squadra = $dati_calciatore [6];
					$proprietario = $dati_calciatore [4];
					assegna_ruoli('mercato');
					
					if ($proprietario == $outente) {
						$soldi_spesi = $soldi_spesi + $dati_calciatore [3];
						
						$num_calciatori_posseduti ++;
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
						
						$nome = stripslashes ( $dati_calciatore [1] );
						$ruolo = $dati_calciatore [2];
						$costo = $dati_calciatore [3];
						$tempo_off = $dati_calciatore [5];
						$anno_off = substr ( $tempo_off, 0, 4 );
						$mese_off = intval ( substr ( $tempo_off, 4, 2 ) );
						$giorno_off = substr ( $tempo_off, 6, 2 );
						$ora_off = substr ( $tempo_off, 8, 2 );
						$minuto_off = substr ( $tempo_off, 10, 2 );
						$adesso = mktime ( date ( "H" ), date ( "i" ), 0, date ( "m" ), date ( "d" ), date ( "Y" ) );
						$sec_restanti = mktime ( $ora_off, $minuto_off, 0, $mese_off, $giorno_off, $anno_off ) - $adesso;
						$lista_calciatori [$contatore_calciatori] = $numero;
						$contatore_calciatori ++;
						
						$tab_centro .= "<tr>
						<td align='center'><b class='ruolo $backruolo'>$ruolo</b></td>
						<td>$nome</td>
						<td><img class='iconasquadra' src='./immagini/m_$squadra.gif'><a href='tab_squadre.php?vedi_squadra=$squadra'>$squadra</td>
						<td class='center'>$costo</td></tr>";
					} // fine if ($proprietario == $outente)
					
				} // fine for $num2
				
				// ########################################################
				$tab_lato = "";
				
				// ###################################################
				// #######################
				// Layout pagina
				echo " <div class='col m6'>
				<div class='card'>
				<span class='card-title white-text' style='background-color: #3f51b5;height:60px;padding: 14px 0 0 10px;'>                                    							    
				$titolo     
				</span>
				<div class='card-content'>
				<table class='sortable responsive-table highlight' style='width:100%' cellpadding='10' cellspacing='0' id='t1'>
				<thead>
				<tr>
				<th></th>
				<th>Calciatore</th>
				<th>Squadra</th>
				<th class='center'>Costo</th>
				</tr>
				</thead>
				$tab_centro
				</table>
				</div>
				<div class='card-action'>
				<div class='row' style='margin: 0;'>
				<span class='left'>Presidente: <b>$outente</b></span>
				<span class='right'>Data iscrizione: $oreg</span>
				</div>
				</div></div></div>";
				
				echo $fuori_tabella;
				
				$tab_lato = "";
				$tab_centro = "";
				$fuori_tabella = "";
				
				// #######################
			} // fine for $num1
		} // fine VALID
	}



	function invia_formazione() {
	
	extract($GLOBALS);
	global $percorso_cartella_dati, $reset_form, $outente, $frase;
		
		$num_titolari = 0;
		$num_titolari_P = 0;
		$num_titolari_D = 0;
		$num_titolari_C = 0;
		$num_titolari_F = 0;
		$num_titolari_A = 0;
		$num_panchinari = 0;
		
		$calciatori = file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
		$num_calciatori = count($calciatori);
		for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
			$dati_calciatore = explode(",", $calciatori[$num1]);
			$numero = trim($dati_calciatore[0]);
			$proprietario = trim($dati_calciatore[4]);
			
			if ($proprietario == $_SESSION['utente']) {
				$ruolo = $dati_calciatore[2];
				$tempo_off = $dati_calciatore[5];
				$anno_off = substr($tempo_off,0,4);
				$mese_off = intval(substr($tempo_off,4,2));
				$giorno_off = substr($tempo_off,6,2);
				$ora_off = substr($tempo_off,8,2);
				$minuto_off = substr($tempo_off,10,2);
				$adesso = mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"));
				$sec_restanti = mktime($ora_off,$minuto_off,0,$mese_off,$giorno_off,$anno_off) - $adesso;
				
				if ($sec_restanti < 0) {
					$nome_schierato = "schierato$numero";
					
					if ($$nome_schierato == "titolare") {
						$nome_lista = "lista_titolari_$ruolo";
						$$nome_lista .= "$numero,";
						$num_titolari++;
						$nome_num_titolari = "num_titolari_$ruolo";
						$$nome_num_titolari++;
					} # fine if ($$nome_schierato == "titolare")
					
					if ($$nome_schierato == "panchinaro") {
						$num_in_panchina = "panchinaro$numero";
						$num_in_panchina = $$num_in_panchina;
						$verifica_num = preg_replace("#[0-9]#","",$num_in_panchina);
						
						if ($verifica_num != "" or $num_in_panchina > $max_in_panchina) {
							$inserire = "NO";
							$frase = "Si deve inserire la posizione del calciatore in panchina!<br />";
						} # fine if ($verifica_num != "")
						
						if ($num_in_panchina_usati[$num_in_panchina]) {
							$inserire = "NO";
							$frase .= "Ci sono 2 calciatori in panchina con lo stesso numero!<br />";
						} # fine if ($num_in_panchina_usati[$num_in_panchina])
						$num_in_panchina_usati[$num_in_panchina] = $numero;
						$num_panchinari++;
					} # fine if ($$nome_schierato == "panchinaro")
				} # fine if ($sec_restanti < 0)
			} # fine if ($proprietario == $_SESSION utente)
		} # fine for $num1
		
		for ($num1 = 1 ; $num1 <= $max_in_panchina ; $num1++) {
			if ($num_in_panchina_usati[$num1]) {
				$numero = $num_in_panchina_usati[$num1];
				$lista_panchinari .= "$numero,";
			} # fine if ($num_in_panchina_usati[$num1])
		} # fine for $num1
		
		$lista_titolari = $lista_titolari_P.$lista_titolari_D.$lista_titolari_C.$lista_titolari_F.$lista_titolari_A;
		
		$schema = $num_titolari_P.$num_titolari_D.$num_titolari_C.$num_titolari_A;
		if ($num_titolari_F != 0) $schema = $num_titolari_P.$num_titolari_D.$num_titolari_C.$num_titolari_F.$num_titolari_A;
		$schema_trovato = "NO";
		if ($num_titolari > 11) {
			$inserire = "NO";
			$frase .= "Hai schierato più di 11 calciatori!<br />";
		} # fine if ($num_titolari > 11)
		if ($num_panchinari > $max_in_panchina) {
			$inserire = "NO";
			$frase .= "Hai schierato più di $max_in_panchina calciatori in panchina!<br />";
		} # fine if ($num_panchinari > $max_in_panchina)
		if ($num_titolari == 11) {
			$num_schemi = count($schemi);
			
			for ($num1 = 0 ; $num1 < $num_schemi ; $num1++) {
				if ($schemi[$num1] == $schema) { $schema_trovato = "SI"; }
			} # fine for $num1
			
			if ($schema_trovato != "SI") {
				$inserire = "NO";
				$frase .= "Hai adottato uno schema non consentito!<br />";
			} # fine if ($schema_trovato != "SI")
		} # fine if ($num_titolari == 11)
		
		if ($num_titolari < 11) {
			$max_num_cons_P = 0;
			$max_num_cons_D = 0;
			$max_num_cons_C = 0;
			$max_num_cons_F = 0;
			$max_num_cons_A = 0;
			$num_schemi = count($schemi);
			
			for ($num1 = 0 ; $num1 < $num_schemi ; $num1++) {
				if (strlen($schemi[$num1]) == 4) {
					$num_cons_P = substr($schemi[$num1],0,1);
					$num_cons_D = substr($schemi[$num1],1,1);
					$num_cons_C = substr($schemi[$num1],2,1);
					$num_cons_F = 0;
					$num_cons_A = substr($schemi[$num1],3,1);
				} # fine if (strlen($schemi[$num1]) == 4)
				elseif (strlen($schemi[$num1]) == 5) {
					$num_cons_P = substr($schemi[$num1],0,1);
					$num_cons_D = substr($schemi[$num1],1,1);
					$num_cons_C = substr($schemi[$num1],2,1);
					$num_cons_F = substr($schemi[$num1],3,1);
					$num_cons_A = substr($schemi[$num1],4,1);
				} # fine elseif (strlen($schemi[$num1]) == 5)
				
				if ($num_cons_P > $max_num_cons_P) { $max_num_cons_P = $num_cons_P; }
				if ($num_cons_D > $max_num_cons_D) { $max_num_cons_D = $num_cons_D; }
				if ($num_cons_C > $max_num_cons_C) { $max_num_cons_C = $num_cons_C; }
				if ($num_cons_F > $max_num_cons_F) { $max_num_cons_F = $num_cons_F; }
				if ($num_cons_A > $max_num_cons_A) { $max_num_cons_A = $num_cons_A; }
			} # fine for $num1
			
			if ($num_titolari_P > $max_num_cons_P) { $inserire = "NO"; $frase .= "Hai schierato troppi portieri!<br />"; }
			if ($num_titolari_D > $max_num_cons_D) { $inserire = "NO"; $frase .= "Hai schierato troppi difensori!<br />"; }
			if ($num_titolari_C > $max_num_cons_C) { $inserire = "NO"; $frase .= "Hai schierato troppi centrocampisti!<br />"; }
			if ($num_titolari_F > $max_num_cons_F) { $inserire = "NO"; $frase .= "Hai schierato troppi fantasisti!<br />"; }
			if ($num_titolari_A > $max_num_cons_A) { $inserire = "NO"; $frase .= "Hai schierato troppi attaccanti!<br />"; }
		} # fine if ($num_titolari < 11)
		
		if ($inserire != "NO") {
			$filesquadra = $percorso_cartella_dati."/squadra_".$_SESSION['utente'];
			$clinee = @file($filesquadra);
			$file_squadra = @fopen($filesquadra,"wb+");
			flock($file_squadra,LOCK_EX);
			$num_linee = @count($clinee);
			if ($num_linee < 3) { $num_linee = 3; }
			$clinee[0] = "Test".$acapo;
			$clinee[1] = "$lista_titolari".$acapo;
			$clinee[2] = "$lista_panchinari".$acapo;
			for ($num = 0 ; $num < $num_linee ; $num++) {
				fwrite($file_squadra,$clinee[$num]);
			} # fine for $num
			flock($file_squadra,LOCK_UN);
			fclose($file_squadra);
		} # fine if ($inserire != "NO")
		
	} 
	
?>											