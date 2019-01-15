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

if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] == 5) {
	#require("./a_menu.php");
	
	if ($verifiche_config == 2) {
		$n_contenuto_dati = "<?php
############################################################################
# FANTACALCIOBAZAR EVOLUTION
# Copyright (C) 2003-2010 by Antonello Onida
#
# PARAMETRI VISUALIZZAZIONE ED ESTETICA\n\n";
		$n_contenuto_dati .= "\$news_per_pagina				    = '$N_news_per_pagina';\n";
		$n_contenuto_dati .= "\$n_ultime_notizie 				= '$N_n_ultime_notizie';\n";
		$n_contenuto_dati .= "\$commenti_fb 					= '$N_commenti_fb';\n";
		$n_contenuto_dati .= "\$like_fb 						= '$N_like_fb';\n";
		$n_contenuto_dati .= "\$dim_comm_fb 						= '$N_dim_comm_fb';\n";

		
		# Dati non configurabili da form
		
		$n_contenuto_dati .= "# PARAMETRI NON CONFIGURABILI DA FORM\n\n";
		$n_contenuto_dati .= "\$archivio_dati = 'csvfile'; #csvfile o mysql\n";
		$n_contenuto_dati .= "\$notizie_file = './dati/notizie_file.csv';\n";
		$n_contenuto_dati .= "\$pagine_file = './dati/pagine_file.csv';\n";
		$n_contenuto_dati .= "\$categorie_file = './dati/categorie_file.csv';\n";
		$n_contenuto_dati .= "\$sottocategorie_file = './dati/sottocategorie_file.csv';\n";
		$n_contenuto_dati .= "\$mostra_calendario = 'NO';\n";
		$n_contenuto_dati .= "\$mostra_gall_index = 'SI';\n";
		$n_contenuto_dati .= "\$data_mod = gmmktime();\n";
		$n_contenuto_dati .= "?>";
		
		if (@fopen($percorso_cartella_dati."/cms.conf.php","w+")) {
			$file_dati = fopen($percorso_cartella_dati."/cms.conf.php","wb+");
			flock($file_dati,LOCK_EX);
			$n_contenuto_dati = trim($n_contenuto_dati);
			fwrite($file_dati,$n_contenuto_dati);
			flock($file_dati,LOCK_UN);
			fclose($file_dati);
			echo "<br/><br/><center><h3>Modifiche cms.conf.php salvate.</h3></center><br/><br/><br/><br/><br/>";
			echo"<meta http-equiv='refresh' content='0; url=a_gestione.php?messgestutente=30'>";
			exit;
		} # fine if (fopen("$percorso_cartella_dati/dati_gen.php","w+"))
		else  {
			echo "<br/><br/><center><h3>Modifiche dati_gen.php non salvate.</h3></center><br/><br/><br/><br/><br/>";
			echo "<meta http-equiv='refresh' content='0; url=a_gestione.php?messgestutente=31'>";
			exit;
		}
	} # fine if ($verifiche_config == 2) {
	
	else	if ($verifiche_config == 1) {
		$procedi = "SI";
	} # fine else if ($verifiche_config == 1) {
	
	else {
		echo "<form name='form_configura' action='./a_cms_configura.php' method='post'>
		<table class='mdl-data-table mdl-js-data-table mdl-shadow--2dp'>
		<caption>CONFIGURAZIONE VISUALIZZAZIONE</caption>
		
		<tr><td class='mdl-data-table__cell--non-numeric'>News per pagina</td><td width='20%'><div class='mdl-textfield mdl-js-textfield'><input
					class='mdl-textfield__input' type='text' value='$news_per_pagina' name='N_news_per_pagina' size=40 maxlength=50 /><label
					class='mdl-textfield__label' for='sample2'>Inserisci...</label></div></td><td width='50%'>Numero di news visualizzabili in ogni pagina.</td></tr>
					
		<tr><td class='mdl-data-table__cell--non-numeric'>Numero ultime notizie</td><td><div class='mdl-textfield mdl-js-textfield'><input
					class='mdl-textfield__input'type='text' value='$n_ultime_notizie' name='N_n_ultime_notizie' size=40 maxlength=40 /><label
					class='mdl-textfield__label' for='sample2'>Inserisci...</label></div></td><td>Numero news visualizzabili nelle ultime notizie.</td></tr>";
					
		$checkSI = ""; $checkNO = "";
		if ($commenti_fb == "SI") $checkSI = "checked";
		else $checkNO = "checked";
		echo"<tr><td class='mdl-data-table__cell--non-numeric'>Commenti Facebook</td>
        <td class='mdl-data-table__cell--non-numeric'>
		    <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect'>
                <span class='mdl-radio__label'>SI&nbsp;</span>
				<input class='mdl-radio__button'  type='radio' name='N_commenti_fb' value='SI' $checkSI />
            </label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label class='mdl-radio mdl-js-radio mdl-js-ripple-effect'>
			    <span class='mdl-radio__label'>NO&nbsp;</span>
				<input class='mdl-radio__button' type='radio' name='N_commenti_fb' value='NO' $checkNO />
            </label>
		</td>
        <td>Abilita la possibilit&agrave; di commentare con l'account Facebook.</td></tr>";
		
		$checkSI = ""; $checkNO = "";
		if ($like_fb == "SI") $checkSI = "checked";
		else $checkNO = "checked";
		echo"<tr><td class='mdl-data-table__cell--non-numeric'>Like Facebook</td>
        <td class='mdl-data-table__cell--non-numeric'>
		    <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect'>
                <span class='mdl-radio__label'>SI&nbsp;</span>
				<input class='mdl-radio__button'  type='radio' name='N_like_fb' value='SI' $checkSI />
            </label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label class='mdl-radio mdl-js-radio mdl-js-ripple-effect'>
			    <span class='mdl-radio__label'>NO&nbsp;</span>
				<input class='mdl-radio__button' type='radio' name='N_like_fb' value='NO' $checkNO />
            </label>
		</td>
        <td>Abilita la possibilit&agrave; di inserire like alle notizie. <br>Attivo <b>solo</b> se lo sono anche i commenti.</td></tr>
		
		<tr><td class='mdl-data-table__cell--non-numeric'>Dimensione commenti Facebook</td><td><div class='mdl-textfield mdl-js-textfield'><input
		class='mdl-textfield__input'type='text' value='$dim_comm_fb' name='N_dim_comm_fb' size=40 maxlength=40 /><label
		class='mdl-textfield__label' for='sample2'>Inserisci...</label></div></td><td>Numero massimo di caratteri dei commenti Facebook.</td></tr>";
		
		echo "<tr><td colspan='3'>
        <input type='hidden' name='verifiche_config' value='2' />
		<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored' type='submit' value='Salva le modifiche' />
		</td></tr></form></table>";
	} # fine else
	
} # fine if ($_SESSION valido)
else header("location: logout.php?logout=2");
include("./footer.php");
?>