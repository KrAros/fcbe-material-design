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

# Menu amministrazione
echo '<header class="demo-drawer-header">          
    <img src="./immagini/loghi/'.$_SESSION['utente'].'.jpg" class="demo-avatar">          
	<div class="demo-avatar-dropdown">            
		<span>
			'.$_SESSION['utente'].'
		</span>            
		<div class="mdl-layout-spacer"></div>            
		<button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" data-upgraded=",MaterialButton,MaterialRipple">         
			<i class="material-icons" role="presentation">arrow_drop_down</i>             
			<span class="visuallyhidden">Accounts</span>           
			<span class="mdl-button__ripple-container">
				<span class="mdl-ripple is-animating" style="width: 92.5097px; height: 92.5097px; transform: translate(-50%, -50%) translate(15px, 16px);"></span>
			</span>
		</button>           
		<div class="mdl-menu__container is-upgraded" style="right: 0px; top: 32px; width: 196.933px; height: 160px;">
			<div class="mdl-menu__outline mdl-menu--bottom-right" style="width: 196.933px; height: 160px;"></div>
			<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect mdl-js-ripple-effect--ignore-events" for="accbtn" data-upgraded=",MaterialMenu,MaterialRipple" style="clip: rect(0px, 196.933px, 0px, 196.933px);">              
				<li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1" data-upgraded=",MaterialRipple" style="">hello@example.com
					<span class="mdl-menu__item-ripple-container"><span class="mdl-ripple"></span></span></li>              
				<li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1" data-upgraded=",MaterialRipple" style="">info@example.com
					<span class="mdl-menu__item-ripple-container"><span class="mdl-ripple"></span></span></li>              
				<li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1" data-upgraded=",MaterialRipple" style="">
					<i class="material-icons">add</i>Add another account...
					<span class="mdl-menu__item-ripple-container"><span class="mdl-ripple"></span></span>
				</li>            
			</ul>
		</div>          
	</div>        
</header>';
if ($_SESSION['permessi'] == 5) {
	echo "<span class='mdl-layout-title'>GESTIONE</span>
	<nav class='demo-navigation mdl-navigation mdl-color--blue-grey-800'>
	<a class='mdl-navigation_link_menu' href='./a_gestione.php'><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Pannello iniziale</a>
	<a class='mdl-navigation_link_menu' href='./a_configura.php'><i class='mdl-color-text--blue-grey-400 material-icons'>settings</i>Configurazione</a>
	<a class='mdl-navigation_link_menu' href='./a_torneo.php'><i class='mdl-color-text--blue-grey-400 material-icons'>list</i>Gestione tornei</a>
	<a class='mdl-navigation_link_menu' href='./a_aggUtente.php'><i class='mdl-color-text--blue-grey-400 material-icons'>person_add</i>Aggiungi utenti</a>
	<a class='mdl-navigation_link_menu' href='./a_appUtente.php'><i class='mdl-color-text--blue-grey-400 material-icons'>check</i>Approvazione utenti</a>
	<a class='mdl-navigation_link_menu' href='./a_verifiche.php'><i class='mdl-color-text--blue-grey-400 material-icons'>verified_user</i>Verifiche strutturali</a>    </nav>	
	<span class='mdl-layout-title'>VOTI</span>	<nav class='demo-navigation mdl-navigation mdl-color--blue-grey-800'>
	<a class='mdl-navigation_link_menu' href='./a_upload.php'><i class='mdl-color-text--blue-grey-400 material-icons'>file_upload</i>Upload voti</a>
	<a class='mdl-navigation_link_menu' href='./a_invia_voti.php'><i class='mdl-color-text--blue-grey-400 material-icons'>send</i>Invia formazioni</a>
	<a class='mdl-navigation_link_menu' href='./a_invia_risultati.php'><i class='mdl-color-text--blue-grey-400 material-icons'>view_list</i>Invia risultati</a>    </nav>
	
	<span class='mdl-layout-title'>CONTENUTI</span>	<nav class='demo-navigation mdl-navigation mdl-color--blue-grey-800'>	<a class='mdl-navigation_link_menu' href='./a_sito.php'><i class='mdl-color-text--blue-grey-400 material-icons'>pages</i>Gestione CMS</a>
	<a class='mdl-navigation_link_menu' href='./a_testi.php'><i class='mdl-color-text--blue-grey-400 material-icons'>text_format</i>Gestione testi</a>	<a class='mdl-navigation_link_menu' href='./messaggi.php'><i class='mdl-color-text--blue-grey-400 material-icons'>message</i>Gestione messaggi</a>
	<a class='mdl-navigation_link_menu' href='./a_nlUtente.php'><i class='mdl-color-text--blue-grey-400 material-icons'>contact_mail</i>Newsletter a utenti</a>
	<a class='mdl-navigation_link_menu' href='./a_crea_sondaggio.php'><i class='mdl-color-text--blue-grey-400 material-icons'>poll</i>Sondaggi e votazioni</a>
	<a class='mdl-navigation_link_menu' href='javascript:void(0)' onclick='window.open(\"chat.php?utente=".$_SESSION['utente']."\",\"CHAT\",\"width=526,height=380,left=150,top=150,status=no,toolbar=no,menubar=no,location=no\");'><i class='mdl-color-text--blue-grey-400 material-icons'>chat</i>Chat</a>     </nav>
	<span class='mdl-layout-title'>OFFICINA</span>	<nav class='demo-navigation mdl-navigation mdl-color--blue-grey-800'>
	<a class='mdl-navigation_link_menu' href='./a_fm.php'><i class='mdl-color-text--blue-grey-400 material-icons'>create_new_folder</i>File manager</a>
	<a class='mdl-navigation_link_menu' href='./a_backup.php'><i class='mdl-color-text--blue-grey-400 material-icons'>backup</i>Backup dati</a>	<a class='mdl-navigation_link_menu' href='./a_b2mail.php'><i class='mdl-color-text--blue-grey-400 material-icons'>backup</i>Backup per mail</a>
	<a class='mdl-navigation_link_menu' href='./a_edita_file.php?mod_file=$percorso_cartella_dati/tornei.php'><i class='mdl-color-text--blue-grey-400 material-icons'>mode_edit</i>Modifica file tornei</a>	<a class='mdl-navigation_link_menu' href='./a_edita_file.php?mod_file=$percorso_cartella_dati/testi.php'><i class='mdl-color-text--blue-grey-400 material-icons'>text_fields</i>Modifica file testi</a>
	<a class='mdl-navigation_link_menu' href='./a_edita_file.php?mod_file=$percorso_cartella_dati/log.txt'><i class='mdl-color-text--blue-grey-400 material-icons'>account_circle</i>Modifica log accessi</a>
	<a class='mdl-navigation_link_menu' href='./a_edita_file.php?mod_file=immagini/style.css'><i class='mdl-color-text--blue-grey-400 material-icons'>style</i>Modifica style.css</a>
    </nav>";
}
?>