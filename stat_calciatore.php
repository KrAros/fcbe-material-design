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
		
		#################################################################
		##### FUNZIONE - Statistiche calciatori (inc/funzioni_utente.php)
		
		statistiche_calciatore($num_calciatore);
		
		#######################
		##### Layout Principale
		
		echo '<div class="container" style="width: 85%;margin-top: -10px;">
		<div class="card-panel">
		<div class="row">';
		require ("./widget.php");
		echo"<div class='col m9'>
		<div class='row'>
		<div class='col m12'>
		<ol class='breadcrumbs indigo'>
		<li class='breadcrumbs-item'><a class='white-text' href='./mercato.php'>Dashboard</a></li>
		<li class='breadcrumbs-item'><a class='white-text' href='./tab_squadre.php?vedi_squadra=".strtoupper($stat_squadra)."'>".ucfirst(strtolower($stat_squadra))."</a></li>
		<li class='breadcrumbs-item grey-text text-lighten-1'>$nome</li>
		</ol>
		</div>
		</div>";
		tabella_squadre();
		echo"<div class='card'>
		<div class='card-content'>
		<span class='card-title'>$nome<span style='font-size: 13px;'> - $stato</span></span>
		<hr>
		
		<div class='row'>
		<div class='col m4 center-align'>
		<div class='card'>
		<div class='card-content'>";
		if ($foto_calciatori == "SI"){
			if (@is_file("$foto_path$num_calciatore.png")) echo "<img height='160' src='$foto_path$num_calciatore.png' alt='$nome' />";
			else echo "<img src='immagini/nofoto.jpg' alt'Nessuna foto' />";
		}		
		echo"
		</div>
		</div>
		</div>
		
		<div class='col m4 center-align'>
		<div class='card'>
		<div class='card-content'>
		<img height='160'src='./immagini/$stat_squadra.png'>
		</div>
		</div>
		</div>
		
		<div class='col m4'>
		<div class='card center-align'>
		<div class='card-content' style='padding: 0;'>
		
		<div class='$backruolo' style='padding:24px;height: 104px;'>
		<h5 class='white-text center-align'>$ruoli_in_parole</h5>
		</div>
		
		<div class='quotazioni col m6 grey lighten-1'><span class='titoloquotazioni'><b>QUOTAZIONE<br>INIZIALE</b></span><div class='numeroquotazioni grey lighten-3'><span class='valorequotazione'>$quotazione_iniziale</span></div></div>";
		if ($quotazione_iniziale <= $stat_valore) { echo "<div class='quotazioni col m6 green lighten-1'><span class='titoloquotazioni'><b>QUOTAZIONE<br>ATTUALE</b></span><div class='numeroquotazioni green darken-2'><span class='valorequotazioneok'>$stat_valore</span></div></div>"; }
		else { echo "<div class='quotazioni col m6 red lighten-1'><span class='titoloquotazioni'><b>QUOTAZIONE<br>ATTUALE</b></span><div class='numeroquotazioni red darken-2'><span class='valorequotazioneok'>$stat_valore</span></div></div>"; }
		echo"
		
		</div>
		</div>
		</div>
		</div>
		
		<span class='card-title'>Statistiche <span style='font-size: 13px;'> - Giornata $ultima_giornata</span></span>
		<hr>
		<div class='row'>
		<div class='col m4'>
		<div class='card green lighten-2'>
		<div class='card-content' style='text-align: center;'>
		<span class='black-text text-darken-2' style='font-size: 48px;'>$partite_giocate</span><br><span class='black-text text-darken-2'>PRESENZE</span>
		</div>
		</div>
		</div>
		<div class='col m2'>
		<div class='card yellow lighten-2'>
		<div class='card-content' style='text-align: center;'>
		<span class='black-text text-darken-2' style='font-size: 48px;'>$totamm</span><br><span class='black-text text-darken-2'>AMMONIZIONI</span>
		</div>
		</div>
		</div>
		<div class='col m2'>
		<div class='card red lighten-2'>
		<div class='card-content' style='text-align: center;'>
		<span class='black-text text-darken-2' style='font-size: 48px;'>$totesp</span><br><span class='black-text text-darken-2'>ESPULSIONI</span>
		</div>
		</div>
		</div>
		<div class='col m2'>
		<div class='card blue lighten-2'>
		<div class='card-content' style='text-align: center;'>
		<span class='black-text text-darken-2' style='font-size: 48px;'>";
		if ( $ruolo == "P") { echo "$totgolsub"; } else echo "$totgol"; echo"</span><br><span class='black-text text-darken-2'>";
		if ( $ruolo == "P") { echo "GOL SUBITI"; } else echo "GOL FATTI";
		echo "</span>
		</div>
		</div>
		</div>
		<div class='col m2'>
		<div class='card teal lighten-2'>
		<div class='card-content' style='text-align: center;'>
		<span class='black-text text-darken-2' style='font-size: 48px;'>$totass</span><br><span class='black-text text-darken-2'>ASSIST</span>
		</div>
		</div>
		</div>
		</div>
		
		<div class='row'>
		<div class='col m4'>
		<div class='card green lighten-3'>
		<div class='card-content' style='text-align: center;'>
		<span class='black-text text-darken-2' style='font-size: 48px;'>";
		if ( $ruolo == "P") { echo "$totrigp"; } else echo "$totrigt"; echo "</span><br><span class='black-text text-darken-2'>";
		if ( $ruolo == "P") { echo "RIGORI PARATI"; } else echo "RIGORI SEGNATI";
		echo "</span>
		</div>
		</div>
		</div>
		<div class='col m4'>
		<div class='card yellow lighten-3'>
		<div class='card-content' style='text-align: center;'>
		<span class='black-text text-darken-2' style='font-size: 48px;'>";
		if ( $ruolo == "P") { echo "$totrigs"; } else echo "$totrigsb"; echo"</span><br><span class='black-text text-darken-2'>";
		if ( $ruolo == "P") { echo "RIGORI SUBITI"; } else echo "RIGORI SBAGLIATI";
		echo "</span>
		</div>
		</div>
		</div>
		<div class='col m4'>
		<div class='card red lighten-3'>
		<div class='card-content' style='text-align: center;'>
		<span class='black-text text-darken-2' style='font-size: 48px;'>$totaut</span><br><span class='black-text text-darken-2'>AUTOGOL</span>
		</div>
		</div>
		</div>
		</div>
		
		<span class='card-title'>Medie Voto e Fantavoto</span>
		<hr>
		<div class='row'>
		<div class='col m6'>
		<div class='card'>
		<div class='card-content' style='text-align: center;'>
		<span class='black-text text-darken-2' style='font-size: 48px;'>$media_giornale</span><br><span class='black-text text-darken-2'>MEDIA VOTO</span>
		</div>
		</div>
		</div>
		<div class='col m6'>
		<div class='card'>
		<div class='card-content' style='text-align: center;'>
		<span class='black-text text-darken-2' style='font-size: 48px;'>$media_punti</span><br><span class='black-text text-darken-2'>MEDIA FANTAVOTO</span>
		</div>
		</div>
		</div>
		</div>
		
		<div class='row'>
		<div class='col m12'>
		<div class='card'>
		<div class='card-content' style='text-align: center;'>";
        
		grafico(1,'spline','Medie voti di '.$nome.'','Giornate','Voti',$stringav,$stringafv,'Voto','Fantavoto');
		
		echo "</div>
		</div>
		</div>
		</div>	
		
		<span class='card-title'>Quotazione</span>
		<hr>
		<div class='row'>
		<div class='col m12'>
		<div class='card'>
		<div class='card-content' style='text-align: center;'>";
		grafico(2,'area','','Giornate','Quotazione',$stringaval,null,'Quotazione','');
		echo "</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>	
		</div>
		</div>
		</div>"; 
	}
	else {
		echo "</div>
		</div>
		<div id='destra'>";
		include("./menu_i.php");
		echo "</div>";
	}
	
	include("./footer.php");
?>
