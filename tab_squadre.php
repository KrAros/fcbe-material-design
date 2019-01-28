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
	
	if ($_SESSION['valido'] == "SI") {
		
		#######################
		##### Layout Principale	
		
		$logourl = "http://images2.gazzettaobjects.it/includes2013/LIBS/css/assets/squadre/".ucfirst(strtolower($vedi_squadra)).".jpg";
		
		echo "<div class='container' style='width: 85%;margin-top: -10px;'>
		<div class='card-panel'>
		<div class='row'>";
		require ("./widget.php");
		echo "<div class='col m9'>
		<div class='row'>
		<div class='col m12'>
		<ol class='breadcrumbs indigo'>
		<li class='breadcrumbs-item'><a class='white-text' href='./mercato.php'>Dashboard</a></li>
		<li class='breadcrumbs-item grey-text text-lighten-1'>".ucfirst(strtolower($vedi_squadra))."</li>
		</ol>
		</div>
		</div>";
		tabella_squadre();  
		echo "<div class='card'>
		<div class='backsquadre' style='background-image:url($logourl);'><h4 class='backsquadrenome'>".ucfirst(strtolower($vedi_squadra))."</h4></div>
		
		<div class='card-content'>
		<div class='row'>";
		
		#########################
		##### Colonna di sinistra	
		
		echo "<div class='col m6'>";
		
		######################################################
		##### MODULO - Prossima Gara (inc/funzioni_utente.php)	
		
		modulo_prossima_gara(12);
		
		####################################################################
		##### MODULO - Info e Probabili Formazioni (inc/funzioni_utente.php)
		
		modulo_info_e_probabili_formazioni();
		
		##############################################
		##### MODULO - Ultime notizie squadra (inc/funzioni_utente.php)
		
		ultime_notizie_squadra(12);
		
		echo "</div>"; ## Chiudo la colonna di sinistra
		
		#######################
		##### Colonna di destra

		echo "<div class='col m6'>";
		
		###############################################################
		##### MODULO - Rosa squadra ufficiale (inc/funzioni_utente.php)
		
		rosa_squadra(12);
		
		echo "</div>"; ## Chiudo la colonna di destra
		
		################################################
		##### Chiudo i div aperti in Layout Principale
		
		echo "</div>
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