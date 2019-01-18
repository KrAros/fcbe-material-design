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
	$a_fm = "SI"; # Controllo in header per il caricamento del CSS relativo
	require_once("./controlla_pass.php");
	include("./header.php");
	
	if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] = 5) {
		require("./inc/fm_class.php");
		
		echo '<div class="container" style="width: 85%;margin-top: -10px;">
		<div class="card-panel">
		<div class="row">';
		require ("./a_widget.php");
		echo "<div class='col m9'>
		<div class='bread'><a href='./a_gestione.php'>Gestione</a> / File Manager</div>
		<div class='card'>
		<div class='card-content'>
		<span class='card-title'>File Manager<span style='font-size: 13px;'> - Controlla i file caricati sul sito</span></span>
		<hr>";
		
		// Aggiungere il nome dei files in questo array da proteggere
		// dalle opzioni di scrittura, rinomina, modifica, etc. 
		// I nomi devono essere dentro apici e separati da una virgola.
		$protected_files = array();
		
		// Crea una istanza di DirPHP.
		$dirphp = new DirPHP("d/m/y", $protected_files, $header, $footer);
		
		// Questa Š la password di protesione.
		// La password di default Š 'default'. 
		// E' inclusa una utility per la generazione in 'inc/make_hash.php'.
		$dirphp->security['hash'] = "c21f969b5f03d33d43e04f8f136e7682";
		
		// Questa funzione fa tutto il lavoro
		echo "<div class='dirphp'>";
		$dirphp->handle_events();
		echo "</div>";
		echo"</div></div></div></div></div></div></div>";  //CHIUDONO CARD INIZIALE
	}
	else header("location: logout.php?logout=2");
	
	include("./footer.php");
?>