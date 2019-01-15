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

if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] >= 4) {
require ("./a_menu.php");
	if ($usa_tinyMCE == "SI") echo '<center><div id="content">
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
	else echo "<center><div id='content'>";

	$a = array();
	$a = $_POST;
	$a1 = array_values($a);
	$m = substr(key($_POST),0,1);
	$n = intval(substr(key($_POST),1,2));
	$a2 = $a1[0];

	if (!@is_file($percorso_cartella_dati."/testi.php")) {
		$ini_file = "<?php die('ACCESSO VIETATO');?>".$acapo.$acapo.$acapo.$acapo.$acapo.$acapo.$acapo.$acapo.$acapo.$acapo;
		$fp = fopen($percorso_cartella_dati."/testi.php", "wb+") OR die ("errore fileopen");
		flock ($fp,LOCK_EX) OR die ("errore filelocl ex");
		fwrite($fp, $ini_file) OR die ("errore fwrite");
		flock ($fp,LOCK_UN) OR die ("errore filelocl un");
		fclose($fp) OR die ("errore fileclose");
		unset ($ini_file,$fp);
	}

	echo "<table summary='Editor testi' bgcolor='$sfondo_tab' width='100%' align='center' cellpadding='5' cellspacing='5'>
	<caption>EDITOR TESTI $a2 $m $n</caption><tr><td align='center'>
	<div>
	<div style='float:none; padding: 1px'>
	<div style='width: 30%; float:left; text-align:right'>Testata in pagina principale (index.php)</div>
	<div style='width: 70%; float:none;'>
	<form method='post' action='a_testi.php'>
	<input type='submit' name='m01' value='vedi' class='button' />
	<input type='submit' name='m01' value='attiva' class='button' />
	<input type='submit' name='m01' value='modifica' class='button' />
	<input type='submit' name='m01' value='cancella' class='button' />
	</form>
	</div>
	</div>
	<div style='float:none; padding: 1px'>
	<div style='width: 30%; float:left; text-align:right'>Testata in gestione (gestione.php)</div>
	<div style='width: 70%; float:none;'>
	<form method='post' action='a_testi.php'>
	<input type='submit' name='m02' value='vedi' class='button' />
	<input type='submit' name='m02' value='attiva' class='button' />
	<input type='submit' name='m02' value='modifica' class='button' />
	<input type='submit' name='m02' value='cancella' class='button' />
	</form>
	</div>
	</div>
	<div style='float:none; padding: 1px'>
	<div style='width: 30%; float:left; text-align:right'>Box 1 in pagina principale (index.php)</div>
	<div style='width: 70%; float:none;'>
	<form method='post' action='a_testi.php'>
	<input type='submit' name='m03' value='vedi' class='button' />
	<input type='submit' name='m03' value='attiva' class='button' />
	<input type='submit' name='m03' value='modifica' class='button' />
	<input type='submit' name='m03' value='cancella' class='button' />
	</form>
	</div>
	</div>
	<div style='float:none; padding: 1px'>
	<div style='width: 30%; float:left; text-align:right'>Box 2 in pagina principale (index.php)</div>
	<div style='width: 70%; float:none;'>
	<form method='post' action='a_testi.php'>
	<input type='submit' name='m04' value='vedi' class='button' />
	<input type='submit' name='m04' value='attiva' class='button' />
	<input type='submit' name='m04' value='modifica' class='button' />
	<input type='submit' name='m04' value='cancella' class='button' />
	</form>
	</div>
	</div>
	<div style='float:none; padding: 1px'>
	<div style='width: 30%; float:left; text-align:right'>Editoriale in menu laterale (menu.php)</div>
	<div style='width: 70%; float:none;'>
	<form method='post' action='a_testi.php'>
	<input type='submit' name='m05' value='vedi' class='button' />
	<input type='submit' name='m05' value='attiva' class='button' />
	<input type='submit' name='m05' value='modifica' class='button' />
	<input type='submit' name='m05' value='cancella' class='button' />
	</form>
	</div>
	</div>
	<div style='float:none; padding: 1px'>
	<div style='width: 30%; float:left; text-align:right'>Informative varie</div>
	<div style='width: 70%; float:none;'>
	<form method='post' action='a_testi.php'>
	<input type='submit' name='m06' value='vedi' class='button' />
	<input type='submit' name='m06' value='attiva' class='button' />
	<input type='submit' name='m06' value='modifica' class='button' />
	<input type='submit' name='m06' value='cancella' class='button' />
	</form>
	</div>
	</div>
	<div style='float:none; padding: 1px'>
	<div style='width: 30%; float:left; text-align:right'>Crediti pi&eacute; pagina</div>
	<div style='width: 70%; float:none;'>
	<form method='post' action='a_testi.php'>
	<input type='submit' name='m07' value='vedi' class='button' />
	<input type='submit' name='m07' value='attiva' class='button' />
	<input type='submit' name='m07' value='modifica' class='button' />
	<input type='submit' name='m07' value='cancella' class='button' />
	</form>
	</div>
	</div>

	<div style='float:none; padding: 1px'>
	<div style='width: 30%; float:left; text-align:right'>Link lettore (inserire codice in opzione HTML)</div>
	<div style='width: 70%; float:none;'>
	<form method='post' action='a_testi.php'>
	<input type='submit' name='m08' value='vedi' class='button' />
	<input type='submit' name='m08' value='attiva' class='button' />
	<input type='submit' name='m08' value='modifica' class='button' />
	<input type='submit' name='m08' value='cancella' class='button' />
	</form>
	</div>
	</div>

	<div style='float:none; padding: 1px'>
	<div style='width: 30%; float:left; text-align:right'>Giornata Serie A</div>
	<div style='width: 70%; float:none;'>
	<form method='post' action='a_testi.php'>
	<input type='submit' name='m09' value='vedi' class='button' />
	<input type='submit' name='m09' value='attiva' class='button' />
	<input type='submit' name='m09' value='modifica' class='button' />
	<input type='submit' name='m09' value='cancella' class='button' />
	<input type='submit' name='m09' value='carica' class='button' />
	</form>
	</div>
	</div>

	<div style='float:none; padding: 1px'>
	<div style='width: 30%; float:left; text-align:right'>Testo aggiuntivo in ISCRIZIONE UTENTI</div>
	<div style='width: 70%; float:none;'>
	<form method='post' action='a_testi.php'>
	<input type='submit' name='m10' value='vedi' class='button' />
	<input type='submit' name='m10' value='attiva' class='button' />
	<input type='submit' name='m10' value='modifica' class='button' />
	<input type='submit' name='m10' value='cancella' class='button' />
	</form>
	</div>
	</div>

	</div>
	</td></tr></table>
	<br/><br/>";

	if (isset($m)) {
		if ($salva_modifiche) {
			$linee_mess = @file($percorso_cartella_dati."/testi.php");
			$n_contenuto_dati = str_replace(array("\n","\r"),"", $n_contenuto_dati);
			$n_contenuto_dati = nl2br($n_contenuto_dati);
			$n_contenuto_dati = str_replace("|", " ", $n_contenuto_dati);
			$n_contenuto_dati = trim(stripslashes($n_contenuto_dati));
			$n_contenuto_dati = htmlentities($n_contenuto_dati, ENT_QUOTES);
			$linee_mess[$n] = $n_contenuto_dati.$acapo;
			$scrivi_testi = implode('',$linee_mess);
			if (is_file($percorso_cartella_dati."/testi.php")) {
				$file_dati = fopen($percorso_cartella_dati."/testi.php","wb+");
				flock($file_dati,LOCK_EX);
				fwrite($file_dati,$scrivi_testi);
				flock($file_dati,LOCK_UN);
				fclose($file_dati);
				unset ($file_dati,$linee_mess,$scrivi_testi);				
				echo "<center><h4>Modifiche $n salvate.</h4></center><br/>";
			} # fine if (fopen("$percorso_cartella_dati/dati.php","w+"))
			else echo "<b>ERRORE</b>: si devono cambiare i permessi di scrittura del file testi.php per salvare le modifiche, leggi il README.<br/>";
		} # fine if ($salva_modifiche)
		elseif ($a2=="vedi") {
			if (@is_file($percorso_cartella_dati."/testi.php")) $linee_mess = file($percorso_cartella_dati."/testi.php");
			echo "<table summary='Anteprima' bgcolor='$sfondo_tab' width='100%' border='1' cellpadding='5px'>
			<caption>ANTEPRIMA TESTO</caption><tr><td>";
			echo html_entity_decode($linee_mess[$n])."<br/>";
			echo"</td></tr></table>";
		} # fine if
		elseif ($a2=="attiva"){
			echo "Funzione per future implementazioni!";
		}
		elseif ($a2=="cancella"){
			echo "<table summary='Elimina' bgcolor='$sfondo_tab' width='100%'>
			<caption>ELIMINA TESTO</caption><tr><td align ='center'>";
			echo "<form method='post' action='a_testi.php'>
			<input type='hidden' name='m$n' value='$a2' />
			<b>Vuoi eliminare il testo n. $n?</b><br/><br/>
			<input type='submit' name='salva_modifiche' value='Elimina testo' />
			</form>Procedendo il testo sar&agrave; eliminato e non sar&agrave; pi&ugrave; disponibile.
			</td></tr></table>";
		}
		elseif ($a2=="modifica"){
               if (@is_file($percorso_cartella_dati."/testi.php")) $linee_mess = file($percorso_cartella_dati."/testi.php");
               echo "<table summary='Edita' bgcolor='$sfondo_tab' width='100%'>
               <caption>EDITA TESTO</caption><tr><td align ='center'>";
               echo "<form method='post' action='a_testi.php'>
               <input type='hidden' name='m$n' value='$a2' />
               <textarea name='n_contenuto_dati' rows='20' cols='120'>".$linee_mess[$n]."</textarea>
               &nbsp;&nbsp;&nbsp;<input type='submit' name='salva_modifiche' value='Salva le modifiche' />
               </form></td></tr></table>";
          }
		elseif ($a2=="carica"){
			if (@fopen('http://fantadownload.altervista.org/mirrorFCBE/giornataseriea.txt', 'r')) {
			$riga = file('http://fantadownload.altervista.org/mirrorFCBE/giornataseriea.txt'); 
			$linee_mess[$n]=$riga[1];
			$giorn_num=$riga[0];
			echo "<table summary='Carica' bgcolor='$sfondo_tab' width='100%'>
			<caption>Carica Giornata serie A</caption><tr><td align ='center'>";
			echo "<form method='post' action='a_testi.php'>
			<input type='hidden' name='m$n' value='$a2' />
			<textarea name='n_contenuto_dati' rows='20' cols='120'>".$linee_mess[$n]."</textarea>
			<input type='submit' name='salva_modifiche' value='Carica  giornata n° $giorn_num' />
			</form></td></tr></table>";		
			#$n_contenuto_dati=$linee_mess[$n];
			}
			else echo "File origine non disponibile";
			
		}
	} # fine if ($m)
	echo "</div></center>";
} # fine if ($_SESSION["utente"]
else echo"<meta http-equiv='refresh' content='0; url=logout.php'>";
include("./footer.php");
?>