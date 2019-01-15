<?php
	##################################################################################
	#    FANTACALCIOBAZAR EVOLUTION
	#    Copyright (C) 2003-2009 by Antonello Onida
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
	include("./controlla_pass.php");
	include("./header.php");
	
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
	$teamlogo = explode("-", $prossima_partita);
	$casa = "./immagini/".strtolower($teamlogo[0]).".png";
	$trasferta = "./immagini/".strtolower($teamlogo[1]).".png";
	
	$logourl = "http://images2.gazzettaobjects.it/includes2013/LIBS/css/assets/squadre/".ucfirst(strtolower($vedi_squadra)).".jpg";
	
	##################################
	##### Lettore RSS News - DA FIXARE
	
	$url_rss="http://www.gazzetta.it/rss/Squadre/".ucfirst(strtolower($vedi_squadra)).".xml"; //rss url
	include_once "./inc/rss_fetch.php";
	
	if ($_SESSION['valido'] == "SI") {
				
		#######################
		##### Layout Principale	
		
		echo '<div class="container" style="width: 85%;margin-top: -10px;">
		<div class="card-panel">
		<div class="row">';
		require ("./widget.php");
		echo "<div class='col m9'>
		<div class='bread'><a href='./mercato.php'>Gestione</a> / ".ucfirst(strtolower($vedi_squadra))."</div>";
		tabella_squadre();  
		echo '<div class="card">
		<div style="height:62px; background-image:url('.$logourl.');background-repeat:no-repeat; background-size:100%"><h4 style="padding-top: 6px;text-align: left;color: white;padding-left: 10px;">'.ucfirst(strtolower($vedi_squadra)).'</h4></div>';
		
		##################################
		##### Probabili formazioni ed info	
		
		echo "<div class='card-content'>
		<div class='row'>
		<div class='col m6'>
		<div class='card center-align'>
		<div class='card-content'>
		<span class='card-title left-align'>Prossima gara in Serie A</span>
		<hr><br>
		<img height='130' src='$casa'> <span class='vs'>VS</span> <img height='130' src='$trasferta'> 
		$data - $ora
		</div>
		</div>
		
		<div class='card center-align'>
		<div class='card-content' style='height: 760px;'>
		<div class='giocherebbero_cosi'>
		<div class='headgioca'>
		<h2 class='pro_for'>Probabile Formazione</h2>
		<h2 class='modulo'>Modulo: $modulo</h2>
		</div>
		<div class='footballMatchField'>
		<div class='matchTotalField n".count($mod)."'>
		<ul class='portiere matchPlayersList module-1'>
		<li>
		<div class='playerNumber' style='background-image:url(./immagini/m_$vedi_squadra.gif)'/>
		</div>
		<div class='playerName'>".$titolari[0]."</div>
		</li>
		</ul>
		<ul class='difensori matchPlayersList module-".$mod[1]."'>";
		for ($i = $mod[1]; $i > 0; $i--){
			echo "<li>
			<div class='playerNumber' style='background-image:url(./immagini/m_$vedi_squadra.gif)'/>
			</div>
			<div class='playerName'>".$titolari[$i+0]."</div>
			</li>";
		}
		echo "</ul>
		<ul class='centrocampisti matchPlayersList module-".$mod[2]."'>";
		for ($i = $mod[2]; $i > 0; $i--){
			echo "<li>
			<div class='playerNumber' style='background-image:url(./immagini/m_$vedi_squadra.gif)'/>
			</div>
			<div class='playerName'>".$titolari[$i+$mod[1]]."</div>
			</li>";
		}
		echo "</ul>
		<ul class='attaccanti matchPlayersList module-".$mod[3]."'>";
		for ($i = $mod[3]; $i > 0; $i--){
			echo "<li>
			<div class='playerNumber' style='background-image:url(./immagini/m_$vedi_squadra.gif)'/>
			</div>
			<div class='playerName'>".$titolari[$i+$mod[2]+$mod[1]]."</div>
			</li>";
		}
		echo "</ul>";
		if (count($mod) == 5 ) {
			echo "<ul class='punte matchPlayersList module-".$mod[4]."'>";
			for ($i = $mod[4]; $i > 0; $i--){
				echo "<li>
				<div class='playerNumber' style='background-image:url(./immagini/m_$vedi_squadra.gif)'/>
				</div>
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
		<p style='padding-top:6px'>";
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
		
		########################################################################################
		##### Rose squadre ufficiali - il numero tra parentesi specifica la larghezza del modulo	
		
		rosa_squadra(6);
		
		echo"</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>";
		
		} else {
		echo "<div id='destra'>";
		include("./menu_i.php");
		echo "</div>";
	}
	include("./footer.php");
?>																																											