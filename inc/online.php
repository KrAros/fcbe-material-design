<?php
##################################################################################
#    FANTACALCIOBAZAR EVOLUTION
#    Copyright (C) 2003 - 2009 by Antonello Onida
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
#
##################################################################################

#=================================================================
#= LETTURA FILE LOG
#=================================================================
function ReadLog($file)
{
	$handle = @fopen($file,"r");
	@flock($handle,LOCK_SH);
	$LoggedUsers = @fread($handle,filesize($file));
	@flock($handle,LOCK_UN);
	@fclose($handle);
	$LoggedUsers = trim($LoggedUsers);
	$LoggedUsers = substr($LoggedUsers,0,-3);
	$LoggedUsers = explode("[x]",$LoggedUsers);
	return $LoggedUsers;
}

# CONFIGURAZIONE ONLINE E LOG

$Expire = "100";
$Display = "Utenti connessi: [utenti] ([nomi])<br />\n";
$AutoMonitor = "1";
$MaxFileSize = "100";
$AutoCorrect = "";
$Online_name_users = "";

#= CODICE PHP =#

$file = $_REQUEST['file'];

if (!isset($Expire)) $Expire = 30;

if (isset($file)) $file = "$file";
else $file = "./dati/c_ol.log";

if (!file_exists($file)) @fopen($file,"wb+");

$Online = 0;
$Interval = mktime() - $Expire;
$MaxFileSize = $MaxFileSize * 1000;

$NewUser = mktime()."|".$_SERVER['REMOTE_ADDR']."|".$_SESSION['utente']."[x]";

#=================================================================
#= SOVRASCRIVE NUOVE INFO DELL'UTENTE
#=================================================================
if (filesize($file) > $MaxFileSize and $AutoMonitor == "1")
{
	$LoggedUsers = ReadLog($file);
	$conta=count($LoggedUsers);

	for ($x=0;$x<$conta;$x++)
	{
		if ($Interval <= trim(substr($LoggedUsers[$x],0,10)))
		$SavedUsers .= $LoggedUsers[$x]."\r\n";
	}
	$SavedUsers .= $NewUser;

	$handle = @fopen($file,"w");
	@flock($handle,LOCK_EX);
	@fwrite($handle,$SavedUsers."\r\n");
	@flock($handle,LOCK_UN);
	@fclose($handle);
}
# LOGGA INFO UTENTI NEL FILE
else
{
	$handle = @fopen($file,"a");
	@flock($handle,LOCK_EX);
	@fwrite($handle,$NewUser."\r\n");
	@flock($handle,LOCK_UN);
	@fclose($handle);
}

$LoggedUsers = ReadLog($file);

# CONTA GLI UTENTI ONLINE
$cuo = count($LoggedUsers);
for ($x = 0; $x < $cuo; $x++)
{
	$UserInfo = explode("|",$LoggedUsers[$x]);
	if (isset($CheckUsers)) // VERIFICA NEL FILE SE CI SONO UTENTI DOPPI
	{
		if ($Interval <= trim($UserInfo[0]) and ( !stristr($CheckUsers,trim($UserInfo[1])."*") or !stristr($CheckUsersName,trim($UserInfo[2])."*") ))
		{
			if (!stristr($CheckUsers,trim($UserInfo[1])."*"))     $CheckUsers     .= $UserInfo[1]."*";
			if (!stristr($CheckUsersName,trim($UserInfo[2])."*")) $CheckUsersName .= $UserInfo[2]."*";
			$Online++;
			if ($Online > 1 and strlen(trim($Online_name_users))>0) $Online_name_users .= " - ";
			$Online_name_users .= $UserInfo[2];
		}
	}
	else
	{
		$CheckUsers     .= $_SERVER['REMOTE_ADDR']."*";
		$CheckUsersName .= $_SESSION['utente']."*";
		$Online++;
		if ($Online > 1 and strlen(trim($Online_name_users))>0) $Online_name_users .=" - ";
		$Online_name_users .= $_SESSION['utente'];
	}
}

#=================================================================
#= VISUALIZZAZIONE MESSAGGIO
#=================================================================
$Display = str_replace("[utenti]",$Online,$Display);
$Online_name_users = trim($Online_name_users);
$Display = str_replace("[nomi]",$Online_name_users,$Display);

	if ($Online == 1 and $AutoCorrect == "1") {
	$Display = preg_replace("!s([^[:alpha:]])!","$1",$Display);
	$Display = str_replace("Ci sono","C'&egrave;",$Display);
	}

$Display = str_replace("()","",$Display);
$Display = str_replace($admin_user,$admin_nome,$Display);
//
echo $Display;
?>