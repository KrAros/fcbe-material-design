<?php
	##################################################################################
	#    FANTACALCIOBAZAR EVOLUTION
	#    Copyright (C) 2003-2008 by Antonello Onida
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
	if ($_SESSION['valido'] == "SI" AND $_SESSION['permessi'] == 5) {
		#require("./a_menu.php");
		if ($_POST['fdc']) echo "file da creare: $fdc";
		if($scrivi == "SI") {
			$fpc = fopen($fdc, "a+");
			fclose($fpc);
			echo "File $fdc creato</h1>";
		}		
		$oggetto_da_controllare= array();
		$oggetto_da_controllare[] = $percorso_cartella_dati;
		$oggetto_da_controllare[] = $percorso_cartella_dati."/messaggi";
		$oggetto_da_controllare[] = $percorso_cartella_dati."/cache";
		$oggetto_da_controllare[] = $percorso_cartella_dati."/copia";
		$oggetto_da_controllare[] = $dir_immagini;
		$oggetto_da_controllare[] = $percorso_cartella_dati."/dati_gen.php";
		$oggetto_da_controllare[] = $percorso_cartella_dati."/tornei.php";
		$oggetto_da_controllare[] = $percorso_cartella_dati."/testi.php";
		$oggetto_da_controllare[] = $percorso_cartella_dati."/db10.txt";
		$conta = 0;
		echo '<div class="container" style="width: 85%;margin-top: -10px;">
		<div class="card-panel">
		<div class="row">';
		
		require ("./a_widget.php");
		echo'<div class="col m9">';
		
		local_version();
		echo"<div class='bread'><a href='./a_gestione.php'>Gestione</a> / Configurazione sito</div><br>
		<div class='card'>
		<div class='card-content'>
		<span class='card-title'>Verifica installazione<span style='font-size: 13px;'> - Controlla se il sito è correttamente configurato</span></span>
		<hr>
		<div class='row'>
		<table class='highlight'>
		<tr>
		<thead>
		<th class='center' width='50%' >Descrizione</th>
		<th class='center' width='20%' >Stato</th>
		<th class='center'>Azione</th>
		</thead>
		</tr>
		<tr>
		<td width='50%'>Versione attuale script: <b>".local_version()."</b></td>
		<td width='20%' class='center'>";
		if(local_version() == last_update()){
			echo"<b><font color='green'>Nessun aggiornamento<br>disponibile.</font></b><br/>";
			} else {	
			echo"<b><font color='red'>Aggiornamento disponibile:<br>scarica la v.".last_update()."</font></b><br/>";
			$data = array("version" => $vnum);
		}
		
		echo"</td>
		<td class='center'><a class='version_check' id='1' style='cursor: pointer;'>Aggiorna</a> - <a href='https://raw.githubusercontent.com/KrAros/fcbe-material-design/master/dati/update/CHANGELOG'>Changelog</a> 

        <span class='loading'></span></td></tr>";
		
		foreach ($oggetto_da_controllare as $controllo){
			$ef=0; $ep=0;
			if ($conta % 2) $colore="#FFFFFF"; else $colore="$colore_riga_alt";
			
			echo "<tr bgcolor=$colore>
			<td width='50%'>Verifica permessi cartella: <b>$controllo</b></td>
			<td width='20%' class='center'>";
			
			if(is_dir($controllo)) {
				echo "<b><font color='green'>cartella trovata</font></b><br/>";
			}
			elseif(is_file($controllo)){
				echo "<b><font color='green'>file trovato</font></b><br/>";
			}
			elseif(!is_file($controllo)) {
				echo "<font color='red'>file non trovato</font><br/>";
				$errore[] = "<u>$controllo</u>: crea il file <b>$controllo</b>!";
				$ef=1;
			}
			else echo "<b><font color='green'>cartella non presente</font></b><br/>";
			
			
			if(@is_writable($controllo)) {
				echo "<font color='green'>scrivibile</font>&nbsp;";
			}
			else {
				echo "<b><font color='red'>non scrivibile</font></b>&nbsp;";
				$errore[] = "<u>$controllo</u>: permessi di scrittura non corretti!";
				$ep=1;
			}
			
			if(@is_readable($controllo)) {
				echo "<font color='green'>leggibile</font>&nbsp;";
			}
			else {
				echo  "<b><font color='red'>non leggibile</font></b>&nbsp;";
				$errore[]="<u>$controllo</u>: permessi di lettura non corretti!";
				$ep=1;
			}
			
			/*
				if(@is_executable($controllo)) {
				echo "<font color='green'>eseguibile</font>";
				}
				else {
				echo  "<b><font color='red'>non eseguibile</font></b>";
				$errore[]="<u>$controllo</u>: permessi di esecuzione non corretti!";
				$err=2;
				}
			*/
			
			if ($ef==1){
				$azione="<form method='post' action='a_verifiche.php'>
				<input type='hidden' name='fdc' value='$controllo'>
				<input type='hidden' name='scrivi' value='SI'>
				<input type='submit' value='Crea file $controllo'>	
				</form>";
			}
			elseif ($ep==1){
			}
			else $azione = "&nbsp;";
			
			echo"</td><td>$azione</td></tr>";
			$conta++;
		}
		echo "</table>";
		
		echo "<p align='left'>";
		echo "Creazione URL sito: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
		echo "</p>";
		echo "<p align='left'>";
		echo "Creazione path assoluto sito: ".$_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['PHP_SELF']);
		echo "</p>";
		if ($chiusura_giornata == 1) $mcg = "<b style='color:red'>La procedura si &egrave; messa in chiusura giornata</b>.";
		echo "<p align='left'>Data attuale: $data_attuale<br/>Data chiusura giornata: $verdatachiusura<br/>Chiusura Giornata: $chiusura_giornata - $mcg</p>";
		
		if ($vedi_notizie == 0) {
			echo "<p align='left'>";
			echo "Le notizie in prima pagina sono disattivate";
			echo "</p>";
			notizie();
		}
		
		if ($errore) $errori = implode("<br />",$errore);
		if ($errori) echo "<p align='left'>$errori</p>";
		
		pr($_SESSION);
		
		pr($_SERVER);
		
		echo "<pre>";
		print_r(ini_get_all());
		echo "</pre>";
		echo "</div></div></div></div></div></div></div>";
		
	} # fine if ($_SESSION valido)
	else header("location: logout.php?logout=2");
	include("./footer.php");
?>			
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>