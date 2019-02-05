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
	
	if ($_SESSION ['valido'] == "SI" or $escludi_controllo == "SI") {

		#######################
		##### Layout Principale
		
		echo '<div class="container" style="width: 85%;margin-top: -10px;">
		<div class="card-panel">
		<div class="row">';
		require ("./widget.php");
		echo "<div class='col m9'>
		<div class='row'>
		<div class='col m12'>
		<ol class='breadcrumbs indigo'>
		<li class='breadcrumbs-item'><a class='white-text' href='./mercato.php'>Dashboard</a></li>
		<li class='breadcrumbs-item grey-text text-lighten-1'>Listone calciatori</li>
		</ol>
		</div>
		</div>";
		tabella_squadre();  
		
		echo "<div class='row'>";
		
		###################
		##### Colonna unica	
		
		echo "<div class='col m12'>";
		
		#########################################################
		##### MODULO - Tabella calciatori (inc/funzioni_utente.php)
		
		tabella_calciatori(12);
		
		echo "</div>"; ## Chiudo la colonna unica
		
		echo "<script type='text/javascript' src='./inc/js/ordina_tabella.js'></script>";
			
		################################################
		##### Chiudo i div aperti in Layout Principale
		
		echo "</div></div></div></div></div>";
		
	} // fine if ($pass_errata != "SI")
	
	include ("./footer.php");
?>		