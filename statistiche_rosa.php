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
	#
	#
	# 07-09-03  fire@dabrosca.net :
	# 	cerca nel file dati\mercato.txt i giocatori dell'utente connesso ed elenca:
	#
	#Num
	#Nome
	#Ruolo
	#Partite
	#Media
	#Gol
	#Gialli
	#Rossi
	#Rigori
	#Assist
	#MediaFC
	#Valore
	##################################################################################
	require_once("./controlla_pass.php");
	include("./header.php");
	
	if ($_SESSION['valido'] == "SI") {
		######################################
		##### Controlla numero ultima giornata
		for ($num1 = 1 ; $num1 < 40 ; $num1++) {
			if (strlen($num1) == 1) $num1 = "0".$num1;
			$giornata_controlla = "giornata$num1";
			if (!@is_file($percorso_cartella_dati."/".$giornata_controlla."_".$_SESSION['torneo']."_".$_SESSION['serie'])) break;
			else $giornata_ultima = $num1;
		} # fine for $num1
		
		$ultima_giornata = $giornata_ultima;
		
		#######################################
		
		if ($ultima_giornata == "") echo "<br/><br/><center><h3>Statistiche non presenti</h3></center><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
		else {
			
			echo '<div class="container" style="width: 85%;margin-top: -10px;">
			<div class="card-panel">
			<div class="row">';
			
			require ("./widget.php");
			echo"<div class='col m9'>
			<div class='row'>
			<div class='col m12'>
			<ol class='breadcrumbs indigo'>
			<li class='breadcrumbs-item'><a class='white-text' href='./mercato.php'>Dashboard</a></li>
			<li class='breadcrumbs-item grey-text text-lighten-1'>Statistiche rosa</li>
			</ol>
			</div>
			</div>";
			tabella_squadre();
			echo"<div class='card'>
			<div class='card-content'>
			<span class='card-title'>Statistiche rosa<span style='font-size: 13px;'> - Dati statistici fino alla giornata $ultima_giornata</span></span>
			<hr>
			<table style='width:100%'>";
			
			#######################################
			
			statistiche_rosa();
			echo $tabella."</table></table></div></div></div></div></div></div>";
		} # fine else
	} # fine if ($pass_errata != "SI")
	else echo"<meta http-equiv='refresh' content='0; url=logout.php'>";
	
	include("./footer.php");
?>				