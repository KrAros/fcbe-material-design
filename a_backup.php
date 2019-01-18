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
	require_once("./controlla_pass.php");
	include("./header.php");
	
	if (!isset($nome_file_bck_zip)) $nome_file_bck_zip = "./dati/copia/dati.zip";
	
	if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] >= 3) {
		
		echo '<div class="container" style="width: 85%;margin-top: -10px;">
		<div class="card-panel">
		<div class="row">';
		require ("./a_widget.php");
		echo "<div class='col m9'>
		<div class='bread'><a href='./a_gestione.php'>Gestione</a> / Backup</div>
		<div class='card'>
		<div class='card-content'>
		<span class='card-title'>Backup<span style='font-size: 13px;'> - Effettua il backup della cartella dati</span></span>
		<hr>";
		
		function stampa_info_zip($p_lista,$file,$colore_riga_alt) {
			$ap_html="";
			$ap_tot_ogg=0;
			$ap_tot_compressed_size=0;
			$ap_tot_size=0;
			$ap_tot_ratio=0;
			#
			foreach($p_lista as $key => $val):
			$ap_tot_ogg++;
			if ($ap_tot_ogg == 1){
				$ap_html .= "<table summary = 'Backup Dati' width='90%' border='0' cellspacing='0' cellpadding='2' align='center' bgcolor='#EEEEEE'>\n";
				$ap_html .= "<caption>Info Dati $file</caption>\n";
				$ap_html .= "<thead>\n";
				$ap_html .= "<tr>";
				$ap_html .= "<th class='testa1'>filename</th>".
				"<th class='testa1'>stored_filename</th>".
				"<th class='testa1'>size</th>".
				"<th class='testa1'>compressed_size</th>".
				"<th class='testa1'>ratio%</th>".
				"<th class='testa1'>mtime</th>".
				"<th class='testa1'>comment</th>".
				"<th class='testa1'>folder</th>".
				"<th class='testa1'>index</th>".
				"<th class='testa1'>status</th>";
				$ap_html .=  "</tr>\n</thead>\n<tbody>\n";
				$ap_n_col=0;
			}#end-if ($ap==1)
			#
			$ap_size=0;
			$ap_ratio=0;
			$ap_compressed_size=0;
			#
			if ($key % 2) $colore="white";
			else $colore=$colore_riga_alt;
			#
			$ap_html .= "<tr bgcolor='$colore'>\n";
			//
			$ap_tot_compressed_size +=intval($val["compressed_size"]);
			$ap_compressed_size=intval($val["compressed_size"]);
			$ap_tot_size +=intval($val["size"]);
			$ap_size = intval($val["size"]);
			// ratio
			$ap_ratio = 0;
			if ($ap_size  > 0) $ap_ratio = round(100-(($ap_compressed_size/$ap_size)*100));
			if ($ap_ratio < 0) $ap_ratio = 0;
			//
			$ap_html .= "<td>".$val["filename"]."</td>".
			"<td>".$val["stored_filename"]."</td>".
			"<td>".$val["size"]."</td>".
			"<td>".$val["compressed_size"]."</td>".
			"<td>$ap_ratio %</td>".
			"<td>".date ("Y-m-d_H:i:s",$val["mtime"])."</td>".
			"<td>".$val["comment"]."</td>".
			"<td>".$val["folder"]."</td>".
			"<td>".$val["index"]."</td>".
			"<td>".$val["status"]."</td>";
			$ap_html .=  "</tr>\n";
			endforeach;
			$ap_html .= "</tbody>\n";
			if ($ap_size > 0) $ap_tot_ratio=round(100-(($ap_tot_compressed_size/$ap_tot_size)*100));
			if ($ap_tot_ratio < 0) $ap_tot_ratio=0;
			$ap_html .= "<tfoot><tr><th colspan='2' align='center'>Totale </th><th>$ap_tot_size</th><th>$ap_tot_compressed_size</th><th>$ap_tot_ratio %</th><th colspan='3'></th><th>$ap_tot_ogg</th><th></th></tr>\n</tfoot>";
			$ap_html .= "</table>\n";
			return $ap_html;
	} #end-function stampa_info_zip
	#
	//
	
	echo "<br/><table summary='Backup' width='95%' align='center' class='border' cellpadding='10' bgcolor='$sfondo_tab'><tr><td class='testa1'>BACKUP CARTELLA DATI</td></tr><tr valign ='top'><td align='left'>";
	
	if (@is_file("$nome_file_bck_zip") and (!@$crea_file) ) {
		echo "<br/><br/><br/><br/>";
		echo "<a href='$nome_file_bck_zip' class='user'>File Dati BACK UP $nome_file_bck_zip</a><br/>";
		echo date("F d Y H:i:s ", filemtime("$nome_file_bck_zip"))."<br/>";
		echo filesize("$nome_file_bck_zip") . " bytes <br/>";
	}
	
	echo "<center><form method='POST' action='a_backup.php'>";
	
	if (@is_file("$nome_file_bck_zip") or (@$crea_file) ) {
		echo "<input type='submit' name='info_file' value='Info File' />";
		echo "<input type='submit' name='crea_file' value='Aggiorna File' />";
		echo "<input type='submit' name='estrai_file' value='Estrai File' />";
	echo "<input type='submit' name='cancella_file' value='Cancella File' />";}
	else echo "<input type='submit' name='crea_file' value='Crea File' />";
	#
	echo "</form></center>";
	
	if (@$crea_file) {
		require_once("inc/pclzip.lib.php");
		$archive = new PclZip("$nome_file_bck_zip");
		$v_list = $archive->create("dati");
		echo "<br/><br/><br/><br/>";
		echo "<a href='$nome_file_bck_zip' class='user'>File Dati BCK $nome_file_bck_zip</a><br/>";
		echo date("F d Y H:i:s ", filemtime("$nome_file_bck_zip"))."<br/>";
		echo filesize("$nome_file_bck_zip") . " bytes <br/><br/>";
		if ($v_list == 0) die("Error : ".$archive->errorInfo(true));
	else print stampa_info_zip($v_list,"$nome_file_bck_zip",$colore_riga_alt);  }
	elseif ((@is_file("$nome_file_bck_zip")) and (@$estrai_file)) {
		require_once("inc/pclzip.lib.php");
		$archive = new PclZip("$nome_file_bck_zip");
		$list = $archive->extract(PCLZIP_OPT_SET_CHMOD, 0755);
		if ($list == 0) die("ERROR : '".$archive->errorInfo(true)."'");
	else print stampa_info_zip($list,"$nome_file_bck_zip",$colore_riga_alt);}
	elseif ((@is_file("$nome_file_bck_zip")) and (@$info_file)) {
		require_once("inc/pclzip.lib.php");
		$archive = new PclZip("$nome_file_bck_zip");
		$list = $archive->listContent();
		if ($list == 0) die("ERROR : '".$archive->errorInfo(true)."'");
	else print stampa_info_zip($list,"$nome_file_bck_zip",$colore_riga_alt); }
	elseif (@is_file("$nome_file_bck_zip") and (@$cancella_file)) {
		unlink("$nome_file_bck_zip");
		echo"<meta http-equiv='refresh' content='0; url=a_backup.php'>";
	}
	
	echo "</td></tr></table>";
	echo"</div></div></div></div></div></div></div>";  //CHIUDONO CARD INIZIALE
	
	require ("./footer.php");
} # fine if ($_SESSION == "SI")
else echo"<meta http-equiv='refresh' content='0; url=logout.php'>";

?>			