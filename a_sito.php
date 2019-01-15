<?php
##################################################################################
#    FANTACALCIOBAZAR Evolution
#    Copyright (C) 2003-2010 by Antonello Onida 
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
require_once ("./controlla_pass.php");
include("./header.php");

if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] >= 2) {
	#if ($_SESSION['permessi'] == 5) require ("./a_menu.php");
	#else require ("./menu.php");

	if ($usa_tinyMCE == "SI") echo '<script language="javascript" type="text/javascript" src="./inc/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript" src="./inc/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript">
	tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
		language: "it",
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",

        // Example content CSS (should be your site CSS)
        content_css : "css/example.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
	});
	</script>';

	$oggi = getdate();
	$giorno = $oggi[mday];

	if ($giorno < 10) {
		$giorno = "0$giorno";
	}
	$mese = $oggi[mon];
	if ($mese < 10) {
		$mese = "0$mese";
	}
	$anno = $oggi[year];
	$ora = $oggi[hours];
	if ($ora < 10) {
		$ora = "0$ora";
	}
	$min = $oggi[minutes];
	if ($min < 10) {
		$min = "0$min";
	}

	$data_mod	= "$anno$mese$giorno$ora$min";
	
	if (!$q) {
		if ( $archivio_dati == "csvfile" ) {
			require_once ( "./inc/csvfile.inc.php" );
			$news_list        = new csvfile;
			$news_list->name  = $notizie_file;
			$news_list->init();
			$pagine_list        = new csvfile;
			$pagine_list->name  = $pagine_file;
			$pagine_list->init();
			$categorie_list        = new csvfile;
			$categorie_list->name  = $categorie_file;
			$categorie_list->init();
		}
		
		$num_news  	= $news_list->entries();
		$num_pagine  	= $pagine_list->entries();
		$num_categorie = $categorie_list->entries();

        menu_superiore();
        echo"</div>

		</div>";
	}
	else	{
		if ($q == 1){agg_pagina();}
		elseif ($q == 2){agg_pagina2();}
		elseif ($q == 3){gestione_pagine();}
		elseif ($q == 4){modifica_pagina();}
		elseif ($q == 5){elimina_pagina();}
		elseif ($q == 6){agg_categoria();}
		elseif ($q == 7){agg_categoria2();}
		elseif ($q == 8){gestione_categorie();}
		elseif ($q == 9){modifica_categoria();}
		elseif ($q == 10){elimina_categoria();}
		elseif ($q == 11){agg_notizia();}
		elseif ($q == 12){agg_notizia2();}
		elseif ($q == 13){gestione_notizie();}
		elseif ($q == 14){modifica_notizia();}
		elseif ($q == 15){elimina_notizia();}
		else {echo "Funzione non esistente";}
	}
} # fine if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] >= 4)

else header("location: a_sito.php?fallito=1");
include("./footer.php");
?>