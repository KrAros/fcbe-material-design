<?php
##################################################################################
#    FANTACALCIOBAZAR EVOLUTION
#    Copyright (C) 2003-2007 by Antonello Onida (fantacalciobazar@sassarionline.net)
#    Copyright (C) 2001-2002 by Marco Maria Francesco De Santis (marcods@gmx.net)
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

	if ($_SESSION['permessi'] == 5) require ("./a_menu.php");
	else require ("./menu.php");

	echo "<b>Previsioni del tempo</b><br/><br/>";

	if (!isset($zipcode)){
		echo "
		<center>
		<FORM ACTION='".$PHP_SELF."' METHOD='GET'>
		ZIP Code: <input type='text' name='zipcode' SIZE='5' MAXLENGTH='5'><br />
		<input type='submit' value='Prova grabbatura'>
		</FORM>
		</center>";
	}

	if (isset($zipcode)){

		if ($zipcode == ""){
			echo ("Inserire ZIP Code.<br />");
		}
		else {
		echo "<div align=\"center\"><table width=303 border=1 cellpadding=0 cellspacing=0 bordercolor=\"#000000\"><tr><td>";
		$count = 0;
		$url = "http://www.weather.com/weather/local/" . $zipcode;

		while ($count < 1){
			++$count;
			$fp=fopen($url,"r");

			if (!fp){
				echo ("<p>Impossibile leggere sito Weather.com</p>");
				include ("footer.php");
				exit;
			}

			$file=fread($fp,40000);
			fclose($fp);
			preg_match("/<!-- Insert City Name and Zip Code -->.*td COLSPAN/s",$file,$matches);
			$matches[0] .= "=2></td></tr></table>";
			echo ("<div align=\"center\">");
			echo ("<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 WIDTH=302><TR><TD BGCOLOR=\"#FFFFCC\"><IMG SRC=\"http://image.weather.com/web/blank.gif\" WIDTH=\"5\" HEIGHT=\"1\" BORDER=\"0\"></TD><TD BGCOLOR=\"#FFFFCC\" CLASS=\"bodyText\" VALIGN=\"top\"><B>$zipcode:<br>");
			echo ($matches[0]);
			echo ("</div>");
		}

		echo ("</td></tr></table></div>");
		}

	}
}
include ("footer.php");
?>