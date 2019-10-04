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
	@$escludi_controllo = $_GET ['escludi_controllo'];
	
	if ($escludi_controllo != "SI")
	require_once ("./controlla_pass.php");
	else
	require ("./dati/dati_gen.php");
	include ("./header.php");
	
	if (! @$_GET ['ruolo_guarda'])
	$ruolo_guarda = "tutti";
	else
	$ruolo_guarda = $_GET ['ruolo_guarda'];
	for($num1 = 1; $num1 < 40; $num1 ++) {
		if (strlen ( $num1 ) == 1)
		$num1 = "0" . $num1;
		if (! is_file ( "./dati/$anno_guarda/MCC$num1.txt" ))
		break;
	} // fine for $num1
	if (! @$_GET ['numgio'])
	$num_gio = $num1 - 1;
	else
	$num_gio = $_GET ['numgio'];
	
	if ($squadra_guarda == "tutte") $squadratitolo = "di tutte le squadre"; else $squadratitolo = $squadra_guarda; 
	
	$sq = file($percorso_cartella_dati."/squadre.txt");
	
	$stagioni = array_filter(glob('./dati/*[0-9]*'), 'is_dir');
	$stagioni = str_replace("./dati/", "", $stagioni);
	
	echo '<div class="container" style="width: 85%;margin-top: -10px;">
	<div class="card-panel">
	<div class="row">';
	require ("./widget.php");
	
	echo "<div class='col m9'>
	<div class='row'>
	<div class='col m12'>
	<ol class='breadcrumbs indigo'>
	<li class='breadcrumbs-item'><a class='white-text' href='./mercato.php'>Dashboard</a></li>
	<li class='breadcrumbs-item grey-text text-lighten-1'>Statistiche ".ucfirst(strtolower($squadra_guarda))."</li>
	</ol>
	</div>
	</div>
	
	<div class='card'>
	<div class='card-content'>
	<span class='card-title'>Statistiche $squadratitolo<span style='font-size: 13px;'> - Visualizza le statistiche delle squadre</span></span>
	<hr>
	<div class='row'>
	<div class='col m12'>
	<div class='row'>
	<div class='col m4 center'><label>Filtra per ruolo:</label>
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
	</div>";
	
	foreach ($sq as $squad) {
		
		$squad = trim ($squad);
		$squadpost = $_GET['squadra_guarda'];
		if ($squad == $squadpost) $selected = "selected"; else $selected="";
		$team .= "<option value='$squad' $selected>$squad</option>";
		
	}
	
	foreach ($stagioni as $stgn) {
		
		$stgn = trim ($stgn);
		$stgpost = $_GET['anno_guarda'];
		if ($stgn == $stgpost) $selected = "selected"; else $selected="";
		$season .= "<option value='$stgn' $selected>$stgn</option>";
		
	}
	
	for($num1 = 1; $num1 < 40; $num1 ++) {
		if (strlen ( $num1 ) == 1)
		$num1 = "0" . $num1;
		if (! is_file ( "./dati/$anno_guarda/MCC$num1.txt" ))
		break;
		else {
			$matchpost = $_GET['numgio'];
			if ($num1 == $matchpost) $selected = "selected"; else $selected="";
			$match .= "<option value='$num1' $selected>$num1</option>";
			$giornata_ultima = $num1;
		}
	} // fine for $num1
	
	echo "<form id='form1' action='' method='post'>
	<div class='col m4 center'><label>Seleziona squadra:</label>
	<div class='input-field col m12 right' style='margin-top: 0;'>
	<select id='squadr' name='squadr' onchange='selectChanged(this)'>";
	
	echo "<option value='tutte'>Tutte</option>"; 
	echo "$team
	</select>
	</div>
	</div>
	
	
	<div class='col m2 center'><label>Seleziona stagione:</label>
	<div class='input-field col m12 right' style='margin-top: 0;'>
	<select id='stg' name='stg' onchange='selectChanged(this)'>";
	
	echo "$season
	</select>
	</div>
	</div>
	
	<div class='col m2 center'><label>Seleziona giornata:</label>
	<div class='input-field col m12 right' style='margin-top: 0;'>
	<select id='numgio' name='numgio' onchange='selectChanged(this)'>";
	
	
	echo "<option value='tutte'>Tutte</option>"; 
	echo "$match
	</select>
	</div>
	</div>
	</div>
	</div>
	</div>
	</form>";
	
	if ($num_gio != 'tutte') {
		
		$naviga = '
		<div class="row">
		<div class="col m12">
		<ul class="collapsible">
		<li>
		<div class="collapsible-header yellow" style="font-size: 16px;line-height: 1.6em;">
		<i class="material-icons">info_outline</i>
		Legenda<i class="material-icons">arrow_drop_down</i></div>
		<div class="collapsible-body yellow lighten-3"><p><b>V</b> - Voto; <b>FV</b> - FantaVoto; <b>Gf</b> - Gol Fatti; <b>Gr</b> - Gol su Rigore; <b>Rs</b> - Rigore Sbagliato; <b>Gv</b> - Gol Vittoria; <b>Gp</b> - Gol Pareggio; <b>As</b> - Assist;<br> <b>Gs</b> - Gol Subito; <b>Rp</b> - Rigore Parato; <b>Au</b> - Autorete;</p></div>
		</li>
		</ul>
		</div>
		</div>';
		
		echo $naviga;
		
		$percorso = "./dati/$anno_guarda/MCC$num_gio.txt";
		$calciatori = file ( $percorso );
		
		if ($calciatori) {
			
			$tabella = "<table class='sortable responsive-table highlight' style='width:100%' cellpadding='10' cellspacing='0' id='t1'>
			<tr>
			<thead>
			<th></th>
			<th>Nome</th>
			<th class='center'>V</th>
			<th class='center'>FV</th>
			<th class='center'>Gf</th>
			<th class='center'>Gr</th>
			<th class='center'>Rs</th>
			<th class='center'>Gv</th>
			<th class='center'>Gp</th>
			<th class='center'>As</th>
			<th class='center'>Gs</th>
			<th class='center'>Rp</th>
			<th class='center'>Au</th>
			</thead>
			</tr>";
			
			$num_calciatori = count ( $calciatori );
			
			for($num1 = 0; $num1 < $num_calciatori; $num1 ++) {
				
				$dc = explode ( "|", $calciatori [$num1] );
				$num = $dc [$ncs_codice - 1];
				$gio = $dc [$ncs_giornata - 1];
				$nome = $dc [($ncs_nome - 1)];
				@$nome = preg_replace ( "#\"#", "", $nome );
				$ruolo = $dc [($ncs_ruolo - 1)];
				$val = $dc [($ncs_valore - 1)];
				$v = round ( $dc [($ncs_voto - 1)], 1 );
				$vfc = round ( $dc [($ncs_votofc - 1)], 1 );
				$sq = $dc [($ncs_squadra - 1)];
				@$sq = preg_replace ( "#\"#", "", $sq );
				$att = $dc [($ncs_attivo - 1)];
				$pres = $dc [($ncs_presenza - 1)];
				$min25 = $dc [($ncs_mininf25 - 1)];
				$sup25 = $dc [($ncs_minsup25 - 1)];
				$entr = $dc [($ncs_entrato - 1)];
				$tito = $dc [($ncs_titolare - 1)];
				$casa = $dc [($ncs_casa - 1)];
				$gfatt = $dc [($ncs_golsegnati - 1)];
				$gfatt = preg_replace ( "#0#", "-", $gfatt );
				$gsub = $dc [($ncs_golsubiti - 1)];
				$gsub = preg_replace ( "#0#", "-", $gsub );
				$gvitt = $dc [($ncs_golvittoria - 1)];
				$gvitt = preg_replace ( "#0#", "-", $gvitt );
				$gpari = $dc [($ncs_golpareggio - 1)];
				$gpari = preg_replace ( "#0#", "-", $gpari );
				$assi = $dc [($ncs_assist - 1)];
				$assi = preg_replace ( "#0#", "-", $assi );
				$giall = $dc [($ncs_ammonizione - 1)];
				$rosso = $dc [($ncs_espulsione - 1)];
				$rtir = $dc [($ncs_rigoretirato - 1)];
				$rtir = preg_replace ( "#0#", "-", $rtir );
				$rsub = $dc [($ncs_rigoresubito - 1)];
				$rpar = $dc [($ncs_rigoreparato - 1)];
				$rpar = preg_replace ( "#0#", "-", $rpar );
				$rsba = $dc [($ncs_rigoresbagliato - 1)];
				$rsba = preg_replace ( "#0#", "-", $rsba );
				$auto = $dc [($ncs_autogol - 1)];
				$auto = preg_replace ( "#0#", "-", $auto );
				
				assegna_ruoli('calciatori');
				
				if (round ( $vfc, 1 ) == 6 and round ( $v, 1 ) == 0 and INTVAL ( $pres ) == 1 and INTVAL ( $entr ) == 0)
				$colpol = "yellow";
				else
				$colpol = "";
				if (round ( $vfc, 1 ) == 0 and round ( $v, 1 ) >= 0 and INTVAL ( $pres ) == 1 and INTVAL ( $entr ) == 1)
				$colsv = "lightgreen";
				else
				$colsv = "";
				if (INTVAL ( $pres ) != INTVAL ( $entr ))
				$coldif = "lightblue";
				else
				$coldif = "";
				
				if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A")
				$considera_fantasisti_come = "F";
				if ($ruolo == $simbolo_fantasista_file_calciatori)
				$ruolo = $considera_fantasisti_come;
				
				if (($sq == $squadra_guarda or $squadra_guarda == "tutte")) {
					
					if ($ruolo == "P")
					$colore = "#dddddd";
					else
					$colore = "trasparent";
					if ($giall != "0") {
						$class = "triangolog";
						} elseif ($rosso != "0") {
						$class = "triangolor";
					} else
					$class = "";
					if ($pres != "0") {
						$tabella .= "<tr class='$ruolo' align='center'>
						<td class='center' style='padding: 5px;'><span class='ruolo $backruolo'>$ruolo</span></td>
						<td>$nome </td>
						<td class='center' ><div class='$class'></div>$v</td>
						<td class='center' bgcolor='$colsv'>$vfc</td>
						<td class='center'>$gfatt</td>
						<td class='center'>$rtir</td>
						<td class='center'>$rsba</td>
						<td class='center'>$gvitt</td>
						<td class='center'>$gpari</td>
						<td class='center'>$assi</td>
						<td class='center' style='background: $colore'>$gsub</td>
						<td class='center' style='background: $colore'>$rpar</td>
						<td class='center'>$auto</td>
						</tr>";
					}
				} // fine if ($ruolo == $ruolo_guarda or ...)
			} // fine for $num1
			
			$tabella .= "</table>";
			
			echo $tabella;
		} 
	} 
	else {
		for($num1 = 1; $num1 < 40; $num1 ++) {
			if (strlen ( $num1 ) == 1)
			$num1 = "0" . $num1;
			$giornata_controlla = "giornata$num1";
			if (!@is_file($percorso_cartella_dati."/".$giornata_controlla."_".$_SESSION['torneo']."_".$_SESSION['serie']))
			break;
			else
			$giornata_ultima = $num1;
		} // fine for $num1
		
		$ultima_giornata = $giornata_ultima;
		
		if ($ultima_giornata == "")
		echo "<br/><br/><center><h4>Statistiche non presenti</h4></center><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
		else {
			$vedi_squadra = trim ( $squadra_guarda );
			$file0 = "./immagini/" . strtolower ( $vedi_squadra ) . ".jpg";
			$file1 = "./immagini/" . strtolower ( $vedi_squadra ) . ".png";
			$file2 = "./immagini/m_" . strtolower ( $vedi_squadra ) . ".gif";
			
			echo "<p align='center'>Dati statistici aggiornati dalla giornata di campionato 01 alla giornata $ultima_giornata</p>
			<table class='sortable responsive-table highlight' style='width:100%' cellpadding='10' cellspacing='0' id='t1'>
			<tr>
			<thead>
			<th></th>
			<th>Nome</th>
			<th class='center'>Partite</th>
			<th class='center'>Media</th>
			<th class='center'>Media FV</th>
			<th class='center'>Gol</th>
			<th class='center'>Assist</th>
			<th class='center'>Gialli</th>
			<th class='center'>Rossi</th>
			<th class='center'>Su Rigore</th>
			<th class='center'>Autogol</th>
			</thead>
			</tr>";
			
			// ######################################
			if ($stato_mercato != "I" and $ultima_giornata >= 1)
			$voti = @file($prima_parte_pos_file_voti.$ultima_giornata.".txt");
			else
			$voti = file("$percorso_cartella_dati/calciatori.txt");
			
			$num_voti = count($voti);
			
			// Aggiunte
			
			if ($ultima_giornata != "")
			$cerca_squadra = file ( "$prima_parte_pos_file_voti$ultima_giornata.txt" );
			else
			$cerca_squadra = file ( "$percorso_cartella_dati/calciatori.txt" );
			$num_cer_squ = count ( $cerca_squadra );
			
			$calciatori = file ( "$percorso_cartella_dati/calciatori.txt" );
			$num_calciatori = count ( $calciatori );
			
			$partite_giocate = 0;
			$somma_voti_tot = 0;
			$somma_voti_giornale = 0;
			for($knum1 = 0; $knum1 < $num_cer_squ; $knum1 ++) {
				$dati_calciatore = explode ( $separatore_campi_file_calciatori, $cerca_squadra [$knum1] );
				$numero = $dati_calciatore [($num_colonna_numcalciatore_file_calciatori - 1)];
				$numero = togli_acapo ( $numero );
				$num_calciatore = $numero;
				$nome = $dati_calciatore [($num_colonna_nome_file_calciatori - 1)];
				$nome = togli_acapo ( $nome );
				$nome = preg_replace ( "#\"#", "", $nome );
				$ruolo = $dati_calciatore [($num_colonna_ruolo_file_calciatori - 1)];
				$ruolo = togli_acapo ( $ruolo );
				$valore = $dati_calciatore [($num_colonna_valore_calciatori - 1)];
				$valore = togli_acapo ( $valore );
				$xsquadra = $dati_calciatore [($num_colonna_squadra_file_calciatori - 1)];
				$xsquadra = togli_acapo ( $xsquadra );
				$xsquadra = preg_replace ( "#\"#", "", $xsquadra );
				$attivo = $dati_calciatore [($ncs_attivo - 1)];
				$attivo = togli_acapo ( $attivo );
				if ($considera_fantasisti_come != $ruoli) $considera_fantasisti_come = "F";
				if ($ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
				
				if ($xsquadra == $vedi_squadra or $vedi_squadra=="tutte") {
					
					for($num1 = 1; $num1 < $ultima_giornata + 1; $num1 ++) {
						if (strlen ( $num1 ) == 1)
						$num1 = "0" . $num1;
						
						if ($voti = @file ( "$prima_parte_pos_file_voti$num1.txt" )) {
							$num_voti = count ( $voti );
							$calciatori = file ( "$percorso_cartella_dati/calciatori.txt" );
							$num_calciatori = count ( $calciatori );
							for($num2 = 0; $num2 < $num_voti; $num2 ++) {
								$dati_voto = explode ( $separatore_campi_file_voti, $voti [$num2] );
								$num_calciatore_voto = $dati_voto [($num_colonna_numcalciatore_file_voti - 1)];
								$num_calciatore_voto = togli_acapo ( $num_calciatore_voto );
								if ($num_calciatore == $num_calciatore_voto) {
									$voto_tot = $dati_voto [($num_colonna_vototot_file_voti - 1)];
									$voto_tot = togli_acapo ( $voto_tot );
									$voto_tot = str_replace ( ",", ".", $voto_tot );
									$voto_giornale = $dati_voto [($num_colonna_votogiornale_file_voti - 1)];
									$voto_giornale = togli_acapo ( $voto_giornale );
									$voto_giornale = str_replace ( ",", ".", $voto_giornale );
									
									if ($voto_tot != 0 or $voto_giornale != 0) {
										$partite_giocate ++;
										$somma_voti_tot = $somma_voti_tot + $voto_tot;
										$somma_voti_giornale = $somma_voti_giornale + $voto_giornale;
									} // fine if ($voto_tot != 0 or $voto_giornale != 0)
									
									if ($statistiche == "SI") {
										$stat_codice = $dati_voto [($ncs_codice - 1)];
										$stat_giornata = $dati_voto [($ncs_giornata - 1)];
										$stat_nome = $dati_voto [($ncs_nome - 1)];
										$stat_nome = preg_replace ( "#\"#", "", $stat_nome );
										$stat_squadra = $dati_voto [($ncs_squadra - 1)];
										$stat_squadra = preg_replace ( "#\"#", "", $stat_squadra );
										$stat_attivo = $dati_voto [($ncs_attivo - 1)];
										$stat_ruolo = $dati_voto [($ncs_ruolo - 1)];
										$stat_presenza = $dati_voto [($ncs_presenza - 1)];
										$totpresenze = $totpresenze + $stat_presenza;
										$stat_votofc = $dati_voto [($ncs_votofc - 1)];
										$totvotfc = $totvotfc + $stat_votofc;
										$stat_mininf25 = $dati_voto [($ncs_mininf25 - 1)];
										$totmininf25 = $totmininf25 + $stat_mininf25;
										$stat_minsup25 = $dati_voto [($ncs_minsup25 - 1)];
										$totminsup25 = $totminsup25 + $stat_minsup25;
										$stat_voto = $dati_voto [($ncs_voto - 1)];
										$totvot = $totvot + $stat_voto;
										$stat_golsegnati = $dati_voto [($ncs_golsegnati - 1)];
										$totgol = $totgol + $stat_golsegnati;
										$stat_golsubiti = $dati_voto [($ncs_golsubiti - 1)];
										$totgolsub = $totgolsub + $stat_golsubiti;
										$stat_golvittoria = $dati_voto [($ncs_golvittoria - 1)];
										$totgolvit = $totgolvit + $stat_golvittoria;
										$stat_golpareggio = $dati_voto [($ncs_golpareggio - 1)];
										$totgolpar = $totgolpar + $stat_golpareggio;
										$stat_assist = $dati_voto [($ncs_assist - 1)];
										$totass = $totass + $stat_assist;
										$stat_ammonizione = $dati_voto [($ncs_ammonizione - 1)];
										$totamm = $totamm + $stat_ammonizione;
										$stat_espulsione = $dati_voto [($ncs_espulsione - 1)];
										$totesp = $totesp + $stat_espulsione;
										$stat_rigoretirato = $dati_voto [($ncs_rigoretirato - 1)];
										$totrigt = $totrigt + $stat_rigoretirato;
										$stat_rigoresubito = $dati_voto [($ncs_rigoresubito - 1)];
										$totrigs = $totrigs + $stat_rigoresubito;
										$stat_rigoreparato = $dati_voto [($ncs_rigoreparato - 1)];
										$totrigp = $totrigp + $stat_rigoreparato;
										$stat_rigoresbagliato = $dati_voto [($ncs_rigoresbagliato - 1)];
										$totrigsb = $totrigsb + $stat_rigoresbagliato;
										$stat_autogol = $dati_voto [($ncs_autogol - 1)];
										$totaut = $totaut + $stat_autogol;
										$stat_subentrato = $dati_voto [($ncs_entrato - 1)];
										$stat_titolare = $dati_voto [($ncs_titolare - 1)];
										$tottit = $tottit + $stat_titolare;
										$stat_valore = $dati_voto [($ncs_valore - 1)];
										$tot_golsegnati = $tot_golsegnati + $stat_golsegnati;
										$tot_golsubiti = $tot_golsubiti + $stat_golsubiti;
									}
								} // fine if ($num_calciatore == $num_calciatore_voto)
							} // fine if ($voti = @file("$prima_parte_pos_file_voti$num1.txt"))
						} // fine for $num2
					} // fine for $num1
					
					if ($partite_giocate != 0) {
						$media_giornale = round ( ($somma_voti_giornale / $partite_giocate), 2 );
						$media_punti = round ( ($somma_voti_tot / $partite_giocate), 2 );
					} // fine if ($partite_giocate != 0)
					else {
						$media_giornale = 0;
						$media_punti = 0;
					} // fine else if ($partite_giocate != 0)
					
					$calciatori = file ( "$percorso_cartella_dati/calciatori.txt" );
					$num_calciatori = count ( $calciatori );
					for($num1 = 0; $num1 < $num_calciatori; $num1 ++) {
						$dati_calciatore = explode ( $separatore_campi_file_calciatori, $calciatori [$num1] );
						$numero = $dati_calciatore [($num_colonna_numcalciatore_file_calciatori - 1)];
						$numero = togli_acapo ( $numero );
						if ($num_calciatore == $numero) {
							$nome = $dati_calciatore [($num_colonna_nome_file_calciatori - 1)];
							$nome = togli_acapo ( $nome );
							$nome = preg_replace ( "#\"#", "", $nome );
							if ($num_colonna_squadra_file_calciatori != 0) {
								$xsquadra = $dati_calciatore [($num_colonna_squadra_file_calciatori - 1)];
								$xsquadra = togli_acapo ( $xsquadra );
								$xsquadra = preg_replace ( "#\"#", "", $xsquadra );
							} // fine if ($num_colonna_squadra_file_calciatori != 0)
							$ruolo = $dati_calciatore [($num_colonna_ruolo_file_calciatori - 1)];
							$ruolo = togli_acapo ( $ruolo );
							
							assegna_ruoli('calciatori');
							if ($considera_fantasisti_come != $ruoli) $considera_fantasisti_come = "F";
							if ($ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
							break;
						} // fine if ($num_calciatore == $numero)
					} // fine for $num1
					
					if ($statistiche == "SI") {
						if ($stat_attivo == 0)
						$mess = "<b><font color='red'>Non disponibile</font></b>";
						else
						$mess = "In attività";
						
						if ($ruolo == "P")
						$tot_golsegnati = $tot_golsubiti;
						if ($stat_attivo == "0")
						$csattivo = " - <font class='piccolo' color='red'>Trasferito</font>";
						else
						$csattivo = "";
						
						echo "<tr class='$ruolo'>
						<td class='center' style='padding: 15px;'><span class='ruolo $backruolo'>$ruolo</span></td>
						<td>$nome $csattivo</td>
						<td class='center'>$totpresenze</td>
						<td class='center'>$media_giornale</td>
						<td class='center'>$media_punti</td>
						<td class='center'>$tot_golsegnati</td>
						<td class='center'>$totass</td>
						<td class='center'>$totamm</td>
						<td class='center'>$totesp</td>
						<td class='center'>$totrigt</td>
						<td class='center'>$totaut</td>
						</tr>";
					}
					; // Fine if ($xsquadra==$vedi_squadra) {
					
					$stat_presenza = 0;
					$totpresenze = 0;
					$stat_votofc = 0;
					$totvotfc = 0;
					$stat_voto = 0;
					$totvot = 0;
					$stat_golsegnati = 0;
					$tot_golsegnati = 0;
					$stat_golsubiti = 0;
					$tot_golsubiti = 0;
					$stat_golvittoria = 0;
					$totgolvit = 0;
					$stat_golpareggio = 0;
					$totgolpar = 0;
					$stat_assist = 0;
					$totass = 0;
					$stat_ammonizione = 0;
					$totamm = 0;
					$stat_espulsione = 0;
					$totesp = 0;
					$stat_rigoretirato = 0;
					$totrigt = 0;
					$stat_rigoresubito = 0;
					$totrigs = 0;
					$stat_rigoreparato = 0;
					$totrigp = 0;
					$stat_rigoresbagliato = 0;
					$totrigsb = 0;
					$stat_autogol = 0;
					$totaut = 0;
					$partite_giocate = 0;
					$media_giornale = 0;
					$media_punti = 0;
					$partite_giocate = 0;
					$somma_voti_tot = 0;
					$somma_voti_giornale = 0;
				} // fine for $Knum1
			} // fine if ($statistiche == "SI")
			echo "</table>";
		} // fine else
	}
	echo "</div></div></div></div></div></div>";
	echo "<script type='text/javascript' src='./inc/js/ordina_tabella.js'></script>";
	
	include ("./footer.php");
?>		