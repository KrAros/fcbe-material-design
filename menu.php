<?php
// #################################################################################
// FANTACALCIOBAZAR EVOLUTION
// Copyright (C) 2003-2010 by Antonello Onida
//
// This program is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
// ver 1.10
// #################################################################################

// ##############################
//
// Menu
//
// ##############################
if ($menu_lato == "SI" and $_SESSION ['permessi'] <= 4 and $_SESSION ['valido'] == "SI") {
	$chiusura_giornata = ( int ) @file ( $percorso_cartella_dati . "/chiusura_giornata.txt" );
	$file = file ( $percorso_cartella_dati . "/utenti_" . $_SESSION ['torneo'] . ".php" );
	$linee = count ( $file );
	
	for($num1 = 1; $num1 < 40; $num1 ++) {
		if (strlen ( $num1 ) == 1)
			$num1 = "0" . $num1;
		if (@is_file ( $percorso_cartella_dati . "/giornata" . $num1 . "_" . $_SESSION ['torneo'] . "_" . $_SESSION ['serie'] ))
			$ultgio = $num1;
		else
			break;
	} // fine for $num1
	echo '<header class="demo-drawer-header">          	    
              <img src="./immagini/loghi/' . $_SESSION ['utente'] . '.jpg" class="demo-avatar">          		
              <div class="demo-avatar-dropdown">            			
                  <span>' . $_SESSION ['utente'] . '</span>            			
                  <div class="mdl-layout-spacer"></div>            			
                  <button id="accbtn5" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" data-upgraded=",MaterialButton,MaterialRipple">         				
                  <i class="material-icons" role="presentation">arrow_drop_down</i>             				
                  <span class="visuallyhidden">Accounts</span>           				
                  <span class="mdl-button__ripple-container">					
                      <span class="mdl-ripple is-animating" style="width: 92.5097px; height: 92.5097px; transform: translate(-50%, -50%) translate(15px, 16px);"></span>				
                  </span>			
                  </button>  

            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn5">
              <li class="mdl-menu__item"><a href="./a_modUtente.php"><i class="material-icons">account_circle</i>Modifica profilo</a></li>
              <li class="mdl-menu__item"><a href="./messaggi.php"><i class="material-icons">message</i>Messaggi</a></li>
            </ul>         			      	
            </header>';
	echo "<span class='mdl-layout-title'>GESTIONE</span>	
              <nav class='demo-navigation mdl-navigation mdl-color--blue-grey-800'>	    
                  <a class='mdl-navigation_link_menu' href='./mercato.php'><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Pannello iniziale</a>";
	if ($chiusura_giornata != 1) {
		echo "<a class='mdl-navigation_link_menu' href='./squadra.php'><i class='mdl-color-text--blue-grey-400 material-icons'>low_priority</i>Gestione squadra</a>
              <a class='mdl-navigation_link_menu' href='./formateam.php'><i class='mdl-color-text--blue-grey-400 material-icons'>show_chart</i>Forma squadra</a>";
		if ($mercato_libero == "SI" and $stato_mercato == "A") {
			echo "<a class='mdl-navigation_link_menu' href='./cambi.php' ><i class='mdl-color-text--blue-grey-400 material-icons'>compare_arrows</i>Cambi</a>";
		}
		if ($mercato_libero == "SI" and $stato_mercato == "A" and $trasferiti_ok == "SI") {
			echo "<a class='mdl-navigation_link_menu' href='./cambi_tra.php'><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Cambia Trasferiti</a>";
		}
	} elseif ($chiusura_giornata == 1) {
		echo "<a class='mdl-navigation_link_menu' href='./squadra1.php'><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Formazioni attuali</a>";
	}
	?>
<a class='mdl-navigation_link_menu' href="javascript:void(0)"
	onclick="window.open('chat.php?utente=<?php echo $_SESSION['utente']; ?>','CHAT','width=526,height=380,left=150,top=150,status=no,toolbar=no,menubar=no,location=no');"><i
	class='mdl-color-text--blue-grey-400 material-icons'>chat</i>Chat</a>
<?php
	if ($chiusura_giornata == 1)
		echo "<a class='mdl-navigation_link_menu' href='./registro_mercato.php' ><i class='mdl-color-text--blue-grey-400 material-icons'>list</i>Registro mercato</a>";
	
	for($num1 = 1; $num1 < 40; $num1 ++) {
		if ($campionato ["1-$num1"] == "S") {
			echo "<a class='mdl-navigation_link_menu' href='./calendario.php'><i class='mdl-color-text--blue-grey-400 material-icons'>date_range</i>Calendario partite</a>";
			break;
		}
	} // fine for $num1
	  
	// if ($mercato_libero == "NO" AND $stato_mercato != "I" AND $ultgio != 0) {
	if ($mercato_libero == "NO" or $ottipo_calcolo == "S") {
		if ($stato_mercato != "I")
			echo "<a class='mdl-navigation_link_menu' href='./classifica.php' ><i class='mdl-color-text--blue-grey-400 material-icons'>equalizer</i>Classifica</a>";
	}
	if ($mercato_libero == "SI" and $stato_mercato != "I" and $ultgio != 0) {
		echo "<a class='mdl-navigation_link_menu' href='./guarda_giornate.php' ><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Vedi tutti i voti</a>";
	}
	
	// #####
	
	if ($num_calciatori_scambiabili > 0 and $stato_mercato != "I" and $mercato_libero == "NO") {
		$scambi_proposti = @file ( $percorso_cartella_dati . "/scambi_" . $_SESSION ['torneo'] . "_" . $_SESSION ['serie'] . ".txt" );
		$num_scambi_proposti = count ( $scambi_proposti );
		for($num1 = 0; $num1 < $num_scambi_proposti; $num1 ++) {
			$dati_scambio = explode ( ",", $scambi_proposti [$num1] );
			if ($_SESSION ['utente'] == $dati_scambio [4]) {
				
				$tempo_off = $dati_scambio [7];
				$tempo_off = togli_acapo ( $tempo_off );
				$anno_off = substr ( $tempo_off, 0, 4 );
				$mese_off = substr ( $tempo_off, 4, 2 );
				$giorno_off = substr ( $tempo_off, 6, 2 );
				$ora_off = substr ( $tempo_off, 8, 2 );
				$minuto_off = substr ( $tempo_off, 10, 2 );
				$adesso = mktime ( date ( "H" ), date ( "i" ), 0, date ( "m" ), date ( "d" ), date ( "Y" ) );
				$sec_restanti = mktime ( $ora_off, $minuto_off, 0, $mese_off, $giorno_off, $anno_off ) - $adesso;
				if ($sec_restanti > 0)
					$richiesto = "SI";
			} // fine if ($_SESSION == $dati_scambio[4])
		} // fine for $num1
		
		if ($richiesto == "SI")
			echo "<a class='mdl-navigation_link_menu' href='./scambi_proposti.php'><i class='mdl-color-text--blue-grey-400 material-icons'>home</i><font class='evidenziato'><b>Scambio calciatori</b></font></a>";
		else
			echo "<a class='mdl-navigation_link_menu' href='./scambi_proposti.php' ><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Scambio calciatori</a>";
	} // fine if ($num_calciatori_scambiabili > 0)
	
	if ($stato_mercato != "I" and $stato_mercato != "B" and $mercato_libero == "NO")
		echo "<a class='mdl-navigation_link_menu' href='./mercato.php?vedi_operazioni=SI' ><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Situazione lega</a>$acapo";
	
	echo "</nav>";
	if ($_SESSION ['permessi'] == 4) {
		echo "<span class='mdl-layout-title'>PRESIDENZA DI LEGA</span>
    	<nav class='demo-navigation mdl-navigation mdl-color--blue-grey-800'>		    <a class='mdl-navigation_link_menu' href='./a_sito.php'><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Gestione news</a>
        	<a class='mdl-navigation_link_menu' href='./a_nlUtente.php'><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Messaggio verso utenti</a>
        	<a class='mdl-navigation_link_menu' href='./a_invia_voti.php'><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Invia formazioni</a>					<a class='mdl-navigation_link_menu' href='./a_invia_risultati.php'><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Invia risultati</a>
        	<a class='mdl-navigation_link_menu' href='./a_aggUtente.php'><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Aggiungi utente</a>
        	<a class='mdl-navigation_link_menu' href='./a_modUtente.php'><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Modifica utente</a>
        	<a class='mdl-navigation_link_menu' href='./a_appUtente.php'><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Approva utente</a>
        	<a class='mdl-navigation_link_menu' href='./a_eliUtente.php'><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Cancella utente</a>
        	<a class='mdl-navigation_link_menu' href='./a_crea_sondaggio.php'><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Sondaggi e votazioni</a>
        	<a class='mdl-navigation_link_menu' href='./squadra1.php'><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Situazione squadre</a>		</nav>";
	} // fine if($_SESSION['permessi'] == 4)
elseif ($_SESSION ['permessi'] == 3) {
		echo "<span class='mdl-layout-title'>SEGRETERIA DI LEGA</span>    	<nav class='demo-navigation mdl-navigation mdl-color--blue-grey-800'>
   	    	<a class='mdl-navigation_link_menu' href='./a_nlUtente.php' ><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Messaggio verso utenti</a>
   	    	<a class='mdl-navigation_link_menu' href='./a_invia_voti.php'><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Invia formazioni</a>					<a class='mdl-navigation_link_menu' href='./a_invia_risultati.php'><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Invia risultati</a>   	    	<a class='mdl-navigation_link_menu' href='./a_appUtente.php'><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Approva utente</a>
   		    <a class='mdl-navigation_link_menu' href='./a_crea_sondaggio.php'><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Sondaggi e votazioni</a>
   		    <a class='mdl-navigation_link_menu' href='./a_sito.php' ><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Gestione news</a>		</nav>";
	} // fine if($_SESSION['permessi'] == 3)
elseif ($_SESSION ['permessi'] == 2) {
		echo "<span class='mdl-layout-title'>REDATTORE DI LEGA</span>    	<nav class='demo-navigation mdl-navigation mdl-color--blue-grey-800'>
    	    <a class='mdl-navigation_link_menu' href='./a_sito.php' ><i class='mdl-color-text--blue-grey-400 material-icons'>home</i>Gestione news</a>		</nav>";
	} // fine if($_SESSION['permessi'] == 2)
	if ($stato_mercato != "I" and $stato_mercato != "B" and $chiusura_giornata == 1) {
		echo "<center><br/><form method='post' action='./squadra.php'><b>Visualizza squadra</b><br/>$acapo
	    <select name='nome_squadra' onchange='submit()'>$acapo
	    <option value='tutti'> di tutti</option>$acapo";
		
		for($num1 = 1; $num1 <= $linee; $num1 ++) {
			@list ( $outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg ) = explode ( "<del>", $file [$num1] );
			if ($_SESSION ['torneo'] == $otorneo and $_SESSION ['serie'] == $oserie) {
				if (! $osquadra)
					$osquadra = "di $outente";
				echo "<option value='$outente'>" . htmlentities ( $osquadra, ENT_QUOTES ) . "</option>$acapo";
			}
		} // fine for $num1
		
		echo "</select>$acapo<input type='submit' name='guarda_squadra' value='Vedi' /></form></center>$acapo";
	}
	
	if ($mostra_giornate_in_mercato == "SI" and $stato_mercato != "I" and $ultgio != 0) {
		$giormerc = "<center><br/><form method='post' action='guarda_giornata.php'>
	    <input type='submit' name='guarda_giornata' value='Vedi' /> giornata n. <select name='giornata' onchange='submit()'>$acapo";
		
		for($num1 = "01"; $num1 < 50; $num1 ++) {
			if (strlen ( $num1 ) == 1)
				$num1 = "0" . $num1;
			$controlla_giornata = "giornata$num1";
			if (@is_file ( $percorso_cartella_dati . "/giornata" . $num1 . "_" . $_SESSION ['torneo'] . "_" . $_SESSION ['serie'] ))
				$giormerc .= "<option value='$num1' selected='selected'>$num1</option>$acapo";
			else
				break;
		} // fine for $num1
		$giormerc .= "</select></form></center>$acapo";
	}
	
	echo "$giormerc";
	echo "</td></tr><br/><br/>$acapo";
	
	// ##################################
	// LINK UTILI
	//
	echo "<span class='mdl-layout-title'>LINK UTILI</span>    <nav class='demo-navigation mdl-navigation mdl-color--blue-grey-800'>
        <a class='mdl-navigation_link_menu' href='televideo.php' ><i class='mdl-color-text--blue-grey-400 material-icons'>tv</i>Televideo</a>
       	<a class='mdl-navigation_link_menu' href='temporeale.php' ><i class='mdl-color-text--blue-grey-400 material-icons'>scanner</i>Risultati temporeale</a>
       	<a class='mdl-navigation_link_menu' href='probform.php'><i class='mdl-color-text--blue-grey-400 material-icons'>info</i>Probabili formazioni</a>
        <a class='mdl-navigation_link_menu' href='indisponibili.php'><i class='mdl-color-text--blue-grey-400 material-icons'>block</i>Indisponibili</a>
    </nav>";
} // fine if ($menu_lato == "SI" AND $_SESSION['permessi'] == 0) {
  
//
  // FINE MENU OPZIONI
  // #####################################

?>