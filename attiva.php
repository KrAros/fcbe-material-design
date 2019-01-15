<?php
##################################################################################
#    FANTACALCIOBAZAR EVOLUTION
#    Copyright (C) 2003-2009 by Antonello Onida and FCBE DevTeam
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
include("./header.php");
echo "<div class='contenuto'>
<div id='articoli'>
<div id='sinistra'>
<div class='articoli_s'>";
//Se esiste il file procede
$cancella=$_GET["cancella"];
$codice=$_GET["codice"];
if (file_exists($percorso_cartella_dati."/hash.php")){
	######################
	##Attivazione account
	if ($cancella=="NO" AND !empty($codice)){
		$utenti_att=file($percorso_cartella_dati."/hash.php");
		foreach($utenti_att as $chiave=>$valore){
			$valore=str_replace("\n","",$valore);
			$temporaneo=explode("<del>",$valore);
			if ($temporaneo[2]==$codice){
				$esistente=true;
				$fileo=file($percorso_cartella_dati."/utenti_".$temporaneo[1].".php");
				foreach ($fileo as $key=>$value){
					$nometemp=explode("<del>",str_replace("\n","",$value));
					if ($nometemp[0]==$temporaneo[0]){
						list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg,$onome,$ocognome) = explode("<del>",str_replace("\n","",$value));
						$Npermessi = "0";
						$stringa = "$outente<del>$opass<del>$Npermessi<del>$oemail<del>$ourl<del>$osquadra<del>$otorneo<del>$oserie<del>$ocitta<del>$ocrediti<del>$ovariazioni<del>$ocambi<del>$oreg<del>0<del>0<del>$onome<del>$ocognome<del>0<del>0<del>0<del>0<del>0<del>0<del>0<del>0\n";
						$fileo[$key] = $stringa;
						$nuovo_file = implode("",$fileo);
						$fp = fopen($percorso_cartella_dati."/utenti_".$temporaneo[1].".php", "wb+");
						flock($fp, LOCK_EX);
						fwrite($fp, $nuovo_file);
						flock($fp, LOCK_UN);
						fclose($fp);
						unset($fp);
						$oggetto = "Iscrizione Torneo Fantacalcio\n";

						$messaggio = "Benvenuto in $titolo_sito!
						La tua iscrizione dal torneo &egrave; stata accettata. <br /><br />
						Ecco i dati con cui puoi accedere. <br/><b>Importante: conserva o stampa questa mail per ogni futura eventuale esigenza.</b><br/>
						<b>Link al sito</b>: <a href='http://" .$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']). "'>http://" .$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']). "</a><br />
						<b>Torneo:</b> $odenom<br />
						<b>Pseudonimo:</b> $outente<br />
						<b>Password:</b> $temporaneo[3]<br />
						<b>Nome squadra:</b> $osquadra<br />
						<b>Email:</b> $oemail<br /><br /><br /><br />
						Leggi attentamente il regolamento di gioco e ogni messaggio che sar&agrave; pubblicato sul sito.<br /><br />
						Puoi connetterti e acquistare i tuoi calciatori, schierare la formazione e modificare alcuni tuoi dati nella pagina relativa alla squadra. <br /><br />
						Segui con attenzione le fasi di gioco, sarai guidato dai messaggi del Presidente di Lega, e potrai utilizzare la funzione di messaggistica per ogni ed eventuale comunicazione.<br /><br />
						Cordiali saluti!<br />$admin_nome<br /><br /><a href='http://" .$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']). "'>http://" .$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']). "</a><br /><br /><hr/>\n";

						$intestazioni  = "MIME-Version: 1.0\n";
						$intestazioni .= "Content-type: text/html; charset=iso-8859-1\n";
						#$intestazioni .= "X-Priority: 3\n";
						#$intestazioni .= "X-MSMail-Priority: Normal\n";
						#$intestazioni .= "X-Mailer: php\n";
						$intestazioni .= "From: $admin_nome <$email_mittente>\n" ;
						$intestazioni .= "Bcc: $admin_nome <$email_mittente>\n";

						$destinatario = "$outente <$oemail>\n";

						if(!@mail($destinatario,$oggetto,$messaggio,$intestazioni))
						{
							echo "ATTENZIONE! Il messaggio con i dati di accesso non &egrave; stato spedito. Puoi ignorare questo avviso";
						}
						$verbo="attivato";
						break;
					}
				}
				break;
			}
		}
		if (!$esistente) exit("</div></div></div><div style=\"text-align:center;\"><h2>UTENTE NON PRESENTE NEL DATABASE</h2><br/>Tra 5 secondi verrai redirezionato alla home</div><meta http-equiv=\"refresh\" content=\"5; url=index.php\"></div>");
		unset($utenti_att[$chiave]);
		$new_file=implode("",$utenti_att);
		$fp=fopen($percorso_cartella_dati."/hash.php","wb+");
		flock($fp,LOCK_EX);
		fwrite($fp,$new_file);
		flock($fp,LOCK_UN);
		fclose($fp);
		unset($fp);		
	}//fine if($cancella="NO")
	elseif($cancella=="SI" AND !empty($codice)){
		$utenti_att=file($percorso_cartella_dati."/hash.php");
		foreach($utenti_att as $chiave=>$valore){
			$valore=str_replace("\n","",$valore);
			$temporaneo=explode("<del>",$valore);
			if ($temporaneo[2]==$codice){
				$esistente=true;
				$fileo=file($percorso_cartella_dati."/utenti_".$temporaneo[1].".php");
				foreach ($fileo as $key=>$value){
					$nometemp=explode("<del>",str_replace("\n","",$value));
					if ($nometemp[0]==$temporaneo[0]){
						unset($fileo[$key]);
						$nuovo_file = implode("",$fileo);
						$fp = fopen($percorso_cartella_dati."/utenti_".$temporaneo[1].".php", "wb+");
						flock($fp, LOCK_EX);
						fwrite($fp, $nuovo_file);
						flock($fp, LOCK_UN);
						fclose($fp);
						unset($fp);
						$verbo="cancellato";
						break;
					}
				}
				break;
			}
		}
		if (!$esistente) exit("<div style=\"text-align:center;\"><br><h2>UTENTE NON PRESENTE NEL DATABASE</h2><br/>Tra 5 secondi verrai redirezionato alla home</div><meta http-equiv=\"refresh\" content=\"5; url=index.php\"></div>");
		unset($utenti_att[$chiave]);
		$new_file=implode("",$utenti_att);
		$fp=fopen($percorso_cartella_dati."/hash.php","wb+");
		flock($fp,LOCK_EX);
		fwrite($fp,$new_file);
		flock($fp,LOCK_UN);
		fclose($fp);
		unset($fp);	
	}
	else exit("</div></div></div><div style=\"text-align:center;\"><h2>UTENTE NON PRESENTE NEL DATABASE</h2><br/>Tra 5 secondi verrai redirezionato alla home</div><meta http-equiv=\"refresh\" content=\"5; url=index.php\"></div>");
}
else{
	exit("</div></div></div><div style=\"text-align:center;\"><h2>UTENTE NON PRESENTE NEL DATABASE</h2><br/>Tra 5 secondi verrai redirezionato alla home</div><meta http-equiv=\"refresh\" content=\"5; url=index.php\"></div>");
}//fine if(file_exists)
?>
</div></div></div>
<div align="center">
<h3>Il tuo utente &egrave; stato <?php echo $verbo;?> con successo<br/>Ora puoi accedere e modificare i tuoi dati.<br/>BUON DIVERTIMENTO</h3></td></tr>
</div>
</div>
<?php
include("./footer.php");
?>
<meta http-equiv="refresh" content="5; url=./index.php">