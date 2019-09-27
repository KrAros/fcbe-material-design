<?php
	// #################################################################################
	// FANTACALCIOBAZAR EVOLUTION
	// Copyright (C) 2003-2008 by Antonello Onida
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
	require_once ("./controlla_pass.php");
	include ("./header.php");
	
	echo '<div class="container" style="width: 85%;margin-top: -10px;">
	<div class="card-panel">
	<div class="row">';
	
	require ("./widget.php");
	echo "<div class='col m9'>
	<div class='row'>
	<div class='col m12'>
	<ol class='breadcrumbs indigo'>
	<li class='breadcrumbs-item'><a class='white-text' href='./mercato.php'>Dashboard</a></li>
	<li class='breadcrumbs-item grey-text text-lighten-1'>Riepilogo rose</li>
	</ol>
	</div>
	</div>
	<div class='card'>
	<div class='card-content'>
	<span class='card-title'>Riepilogo rose<span style='font-size: 13px;'> - Visualizza le rose dei partecipanti</span></span>
	<hr>
	<div class='row'>";
	
    rosa_utenti();
	
	echo "<script type='text/javascript' src='./inc/js/ordina_tabella.js'></script>";
	echo "</div></div></div></div></div></div></div>";
	require ("./footer.php");
?>