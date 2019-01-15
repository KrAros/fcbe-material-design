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
require_once("./dati/dati_gen.php");
require_once("./inc/funzioni.php");


echo "<div class='articolo_d'>";
if ($usa_cms == "SI") link_pagine_link(); 

	echo"<p align='center'>";
	immagine_casuale(top,0,0); 
	echo "</p></div>";

if ($usa_cms == "SI" AND $vedi_notizie == "2") echo "<div class='articolo_d'>".ultime_notizie('')."</div>"; 

if ($attiva_rss == "SI") {
	echo "<div class='articolo_d'><center><b><u>News Calcio</u></b></center><br/>";
	include_once("./inc/RssReader.class.php");

		if (!trim($url_rss)) $url_rss="http://www.gazzetta.it/rss/Calcio.xml"; //rss url
	
	$rsscontent = new RssReader();
	$rsscontent->cache_time = 1200; //set refresh time in second, 0 = disabilita
	$rsscontent->item_num = 5; //set item
	$rsscontent->Rss_Reader($url_rss);
}
echo "</div>";
?>