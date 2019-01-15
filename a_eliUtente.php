<?php
##################################################################################
#    FANTACALCIOBAZAR EVOLUTION
#    Copyright (C) 2003-2008 by Antonello Onida
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

if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] >= 4) {
	if ($_SESSION['permessi'] == 4) require ("./menu.php");
	elseif ($_SESSION['permessi'] == 5) require ("./a_menu.php");
	
	if($del){
		if($procedi){
			if ($_SESSION['permessi'] == 4) $percorso_file = $percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php";
			elseif ($_SESSION['permessi'] == 5) $percorso_file = $percorso_cartella_dati."/utenti_".$itorneo.".php";
			
		
			$u=@file($percorso_file);
			unset($u[$del]);
			$u=implode("",$u);			
			$h=fopen($percorso_file,'w');
			fwrite($h,$u);
			fclose($h);

				if ($_SESSION['permessi'] == 4) {
				echo"<meta http-equiv='refresh' content='1; url=mercato.php?messgestutente=21'>";
				include("./footer.php");
				exit;
				}
				elseif ($_SESSION['permessi'] == 5 AND $gt == 1) {
				echo"<meta http-equiv='refresh' content='1; url=a_gestione_tornei.php?messgestutente=21&amp;itorneo=$itorneo&amp;opzione=1'>";
				include("./footer.php");
				exit;
				}
				elseif ($_SESSION['permessi'] == 5) {
				echo"<meta http-equiv='refresh' content='1; url=a_gestione_tornei.php?messgestutente=21&amp;itorneo=$itorneo'>";
				include("./footer.php");
				exit;
				}
			exit;
		}

		if ($_SESSION['permessi'] == 4) 
		echo "<div align='center'>
		SEI SICURO DI VOLER CANCELLARE QUESTO UTENTE?<br />
		($otid - $id - $percorso_file - $procedi)<br /><br />
		<a href='a_eliUtente.php?del=".$del."&amp;procedi=1'><font size='+3'><b>S I</b></font></a>&nbsp;&nbsp;&nbsp;O&nbsp;&nbsp;&nbsp;
		<a href='mercato.php?messgestutente=22'><font size='+3'><b>N O</b></font></a></div>";
		elseif ($_SESSION['permessi'] == 5) 
		echo "<div align='center'>
		SEI SICURO DI VOLER CANCELLARE QUESTO UTENTE?<br />
		($itorneo - $del)<br /><br />
		<a href='a_eliUtente.php?del=$del&amp;procedi=1&amp;itorneo=$itorneo&amp;gt=1&amp;oemail=$oemail'><font size='+3'><b>S I</b></font></a>&nbsp;&nbsp;&nbsp;O&nbsp;&nbsp;&nbsp;
		<a href='a_gestione_tornei.php?messgestutente=22&amp;itorneo=$itorneo'><font size='+3'><b>N O</b></font></a></div>";
	}
	else {
	?>
	<table bgcolor= "<?php echo "$sfondo_tab";?>"  cellpadding = "10" width = "100%" align = "center">
	<caption>Eliminazione utenti</caption>
	<tr>
			<td width = "40%" align=left>
				<?php
				if ($_SESSION['permessi'] == 4) $percorso_file = $percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php";
				elseif ($_SESSION['permessi'] == 5) $percorso_file = $percorso_cartella_dati."/utenti_".$itorneo.".php";
			$file = @file($percorso_file);
				$linee = count($file);
					for($linea = 1; $linea < $linee; $linea++){
						@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$linea]);
						$userStringa = "<a href ='a_eliUtente.php?del=".$linea."' class='user'>$outente</a><br/>";
						$stringa = $userStringa;
						$stringa .= "password (md5()): ". $opass. "<br/>";
						$stringa .= "permessi: ". $opermessi. "<br/>";
						$stringa .= "email: ". $oemail. "<br/>";
						$stringa .= "url: ". $ourl. "<br/>";
						$stringa .= "squadra: ". $osquadra. "<br/>";
						$stringa .= "torneo: ". $otorneo. "<br/>";
						$stringa .= "serie: ". $oserie. "<br/>";
						$stringa .= "citt&agrave;: ". $ocitta. "<br/>";
						$stringa .= "registrato dal: ". $oreg. "<br/><br/>";
						echo $stringa;
					}
				?>
			</td>
		</tr>
	</table>
	<?php
	}
}
else header("location: ./index.php?fallito=1");
include("./footer.php");
?>