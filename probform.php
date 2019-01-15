<?PHP
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
require("./menu.php");
echo"<center><H3>Probabili Formazioni</h3>della Serie A TIM<br/><br/>
<br/>Seleziona il servizio a cui sei interessato:<br/>
<a href='http://www.gazzetta.it/Calcio/prob_form' target='iframe'>Gazzetta dello Sport</a> 
&nbsp; &nbsp; &nbsp; &nbsp;<a href='http://www.fantagazzetta.com/probabili-formazioni-serie-a.asp' target='iframe'>Fantagazzetta</a> 
<br/><br/>
<iframe name='iframe' align='center' style='width: 700px; height: 900px' src='http://www.gazzetta.it/Calcio/prob_form' marginwidth='0' marginheight='0' hspace='0' vspace='0' frameborder='0'>
Il tuo browser non supporta i Frame in linea non puoi vedere questa pagina.
</iframe>
</center>";

include("./footer.php");
?>