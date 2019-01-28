<?php
	##################################################################################
	#    FANTACALCIOBAZAR EVOLUTION
	#    Copyright (C) 2003-2006 by Antonello Onida (fantacalcio@sassarionline.net)
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
	require_once("./controlla_pass.php");
	include("./header.php");
	
	if ($_SESSION['valido'] == "SI") {
		
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
		<li class='breadcrumbs-item'><a class='white-text' href='#'>Dashboard</a></li>
		<li class='breadcrumbs-item grey-text text-lighten-1'>Riepilogo movimenti</li>
		</ol>
		</div>
		</div>";
		tabella_squadre();  
		
		echo "<div class='row'>";
		
		###################
		##### Colonna unica	
		
		echo "<div class='col m12'>";
		
		#########################################################
		##### MODULO - Registro mercato (inc/funzioni_utente.php)
		
		registro_mercato(12);
		
		echo "</div>"; ## Chiudo la colonna unica
		
		################################################
		##### Chiudo i div aperti in Layout Principale
		
		echo "</div></div></div></div></div>";
			
	} # fine if ($_SESSION['valido'] == "SI")
	
	include("./footer.php");
?>	