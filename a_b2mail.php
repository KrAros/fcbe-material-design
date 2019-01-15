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
$includes = get_included_files();

if($includes[0] == __FILE__) include("./header.php");

if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] >= 3) {
#	if ($_SESSION['permessi'] == 5) require ("./a_menu.php");
#	elseif ($_SESSION['permessi'] <= 4) require ("./menu.php");

	// Which directory/files to backup ( directory should have trailing slash )
	$configBackup = array('./dati/');

	// which directories to skip while backup
	$configSkip   = array('./dati/copia/','./dati/cache/');

	// Put backups in which directory
	$configBackupDir = './dati/copia/';

	// Databses you wish to backup , can be many ( tables array if contains table names only those tables will be backed up )
	// $configBackupDB[] = array('server'=>'localhost','username'=>'root','password'=>'','database'=>'databasename','tables'=>array());

	$zip2mail = "NO";
	set_time_limit(0);
	ini_set("memory_limit","-1");

	$backupName = "backup-".date('d-m-y_H-i-s').'.zip';

	$createZip = new createZip;

	if (isset($configBackup) && is_array($configBackup) && count($configBackup)>0){

		// Lets backup any files or folders if any

		foreach ($configBackup as $dir)    {
			$basename = basename($dir);

			// dir basename
			if (is_file($dir))        {
				$fileContents = file_get_contents($dir);
				$createZip->addFile($fileContents,$basename);
			}
			else        {

				$createZip->addDirectory($basename."/");

				$files = directoryToArray($dir,true);

				$files = array_reverse($files);

				foreach ($files as $file)            {

					$zipPath = explode($dir,$file);
					$zipPath = $zipPath[1];

					// skip any if required

					$skip =  false;
					foreach ($configSkip as $skipObject)                {
						if (strpos($file,$skipObject) === 0)                    {
							$skip = true;
							break;
						}
					}

					if ($skip) {
						continue;
					}


					if (is_dir($file))                {
						$createZip->addDirectory($basename."/".$zipPath);
					}
					else                {
						$fileContents = file_get_contents($file);
						$createZip->addFile($fileContents,$basename."/".$zipPath);
					}
				}
			}
		}
	}

	$fileName = $configBackupDir.$backupName;
	$fd = fopen ($fileName, "wb");
	fwrite ($fd, $createZip -> getZippedfile());
	fclose ($fd);
	echo "Creato set di backup <b>$fileName</b><br />";

	// Dump done now lets email the user
	if ($zip2mail == "SI" AND isset($email_mittente) AND !empty($email_mittente)) {
		mailAttachment($fileName,$email_mittente,'noreply@localhost','Backup Script','noreply@localhost','Backup - '.$backupName,"Backup file is attached");
	}
} # fine if ($_SESSION == "SI")
else echo"<meta http-equiv='refresh' content='0; url=logout.php'>";
if($includes[0] == __FILE__) require ("./footer.php");
?>