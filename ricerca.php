<?php
##################################################################################
#    FANTACALCIOBAZAR EVOLUTION
#    Copyright (C) 2003-2006 by Antonello Onida (fantacalciobazar@sassarionline.net)
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
session_start();
header("Cache-control: private");
require_once("./dati/dati_gen.php");
require_once("./inc/funzioni.php");
require("./header.php");
?>
<div class="contenuto">
<center>
<!-- Google Search Result Snippet Begins -->
<div id="googleSearchUnitIframe"></div>

<script type="text/javascript">
   var googleSearchIframeName = 'googleSearchUnitIframe';
   var googleSearchFrameWidth = 700;
   var googleSearchFrameborder = 0 ;
   var googleSearchDomain = 'www.google.it';
</script>
<script type="text/javascript"
         src="http://www.google.com/afsonline/show_afs_search.js">
</script>
<!-- Google Search Result Snippet Ends -->
</center>
</div>
<?php
include("./footer.php");
?>