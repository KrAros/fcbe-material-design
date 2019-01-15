<?php
/************************************************************ GENERAL INFO ***\  
| DirPHP version 1.0                                                          |
| Created by Stuart Montgomery as a simple solution for                       |
| easy directory printing and uploading.                                      |
|*****************************************************************************|
| Copyright 2004 Stuart Montgomery                                            |
| Modificato nel 2009 da Antonello Onida                                      |
|                                                                             |
| GNU General Public License notice:                                          |
|                                                                             |
|   This program is free software; you can redistribute it and/or modify      |
|   it under the terms of the GNU General Public License as published by      |
|   the Free Software Foundation; either version 2 of the License, or         |
|   (at your option) any later version.                                       |
|                                                                             |
|   This program is distributed in the hope that it will be useful,           |
|   but WITHOUT ANY WARRANTY; without even the implied warranty of            |
|   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             |
|   GNU General Public License for more details.                              |
|                                                                             |
|   You should have received a copy of the GNU General Public License         |
|   along with this program; if not, write to the Free Software               |
|   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA |
|                                                                             |
\*****************************************************************************/

class DirPHP {

	var $version;
	var $settings;
	var $dir;
	var $use_dir;
	var $parent_dir;
	var $date_format;
	var $filetypes;
	var $protected_files;
	var $upload_form;
	var $msg;
	var $security;

	function DirPHP($date_format, $protected_files = "", $header = "", $footer = "", $filetypes = "", $time_limit = 300) {
		$this->load_defaults();
		$this->version = "1.1";
		$this->date_format = $date_format;
		if ($filetypes != "") $this->filetypes = array_merge($this->filetypes, $filetypes);
		$this->protected_files = $protected_files;
		$this->protected_files[] = array_pop(explode("/", $_SERVER['PHP_SELF']));
		$this->settings['header'] = $header;
		$this->settings['footer'] = $footer;
		$use_dir = $this->find_use_dir();
		error_reporting(E_ALL ^ E_NOTICE);  // Turn of annoying error notices  (comment-out line for debugging)
		$this->settings['time_limit'] = $time_limit;
		set_time_limit($this->settings['time_limit']);
		if (($use_dir == FALSE) || !is_dir("./" . $use_dir)) {
			$this->dir = opendir(".");
			$this->use_dir = "";
		} else {
			$this->dir = opendir($use_dir);
			$this->use_dir = $use_dir;
		}
		
		array_pop($dirtree = explode("/",$use_dir));
		$num_levels = count($dirtree) - 1;
		unset($dirtree[$num_levels]);
		$num_levels = count($dirtree) - 1;
		$this->parent_dir = "?dir=";
		for ($i = 0; $i < $num_levels; $i++) {
			$this->parent_dir .= $dirtree[$i]."/";
		}
		if ($this->parent_dir == "?dir=") $this->parent_dir = "";
	} // End of DirPHP function (class constructor)
	
	function handle_events() {
		// Authenticate user, if needed
		if ($this->security['authentication_on'] == 1 && $this->authenticate() == FALSE) {
			$this->display_header($this->settings['logo']);
			echo "<h2>Authentication required</h2>\n";
			echo "<form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"get\"><input type=\"password\" name=\"password\"><p><input type=\"submit\" value=\"Log In\"><input type=\"hidden\" name=\"query\" value=\"" . $_SERVER['QUERY_STRING'] . "\"></form>\n";
			$this->display_footer();
			exit;
		}
		
		// Log out
		if (isset($_GET['logout'])) 
			$this->authenticate(1);
		
		// Handle multiple variable occurances, if applicable
		if (isset($_GET['phpfile']) && isset($_GET['del'])) 
			unset($_GET['del']);
		if (isset($_FILES['file'], $_GET['del']) || isset($_FILES['file'], $_GET['phpfile']) || isset($_FILES['file'],$_GET['dir'])) 
			die("<p class=\"error_msg\">Operazioni simultanee non consentite!");
		
		// Handle normal events
		$this->display_header($this->settings['logo']);
		if (isset($_GET['del'])) {
			$this->delete_file($_GET['del']);
			$this->display_dir();
			$this->bottom_bar();
		} elseif (isset($_GET['phpfile'])) {
			if (!$this->php_source($_GET['phpfile'])) {
				$this->display_dir();
				$this->bottom_bar();
			}
		} elseif (isset($_GET['ren'])) {
			if (isset($_GET['newname'])) $this->rename_file($_GET['ren'], $_GET['newname']);
			$this->display_dir();
			if (isset($_GET['newname'])) {
				$this->bottom_bar();
			} else {
				$this->bottom_bar("default", 1);
			}
		} elseif (isset($_FILES['file'], $_POST['upload_dir'])) {
			$this->upload_file($_FILES['file']);
			$this->display_dir();
			$this->bottom_bar();
		} elseif (isset($_GET['edit'])) {
			echo $this->edit_file($_GET['edit']);
		} elseif (isset($_POST['edit'], $_POST['dir'])) {
			$this->edit_file($_POST['filename'], 1, $_POST['newfile']);
			$this->use_dir = $_POST['dir'];
			$this->display_dir();
			$this->bottom_bar();
		} else {
			$this->display_dir();
			$this->bottom_bar();
		}
		$this->display_footer();
	} // End of handle_events function
	
	function authenticate($logout = 0) {
		// Process logout
		if ($logout == 1) {
			setcookie("dirphp_auth", "0", time()-100);
			header("Location: " . $_SERVER['PHP_SELF']);
			exit;
		}
		// Authenticate user or set cookie if needed
		foreach($this->security['allowed_ips'] as $ip) {
			if ($_SERVER['REMOTE_ADDR'] == $ip) 
				return TRUE;
		} 
		if (isset($_COOKIE['dirphp_auth']) && $_COOKIE['dirphp_auth'] == $this->security['hash']) {
			return TRUE;
		} elseif (isset($_GET['password'])) {
			if (md5($_GET['password']) == $this->security['hash']) {
				$query = "";
				if ($_GET['query'] != "" && !eregi("password=", $_GET['query']))
					$query .= "?" . $_GET['query'];
				setcookie("dirphp_auth", $this->security['hash'], time()+3600);
				header("Location: " . $_SERVER['PHP_SELF'] . $query);
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	} // End of authenticate function
	
	function display_header($logo) {
		$self_path = parse_url("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
		$echo_path = str_replace("/", " / ", $self_path['host'] . $self_path['path']);
		if ($logo) $logo = "<img src=\"" . $logo . "\" align=\"absmiddle\" border=\"0\" alt=\"DirPHP\">";
		echo $this->settings['header'];
		$header  = "<p style='padding: 5px 5px 5px 5px;'><a href=\"" . $_SERVER['PHP_SELF'] . "\"><b>INIZIO FM</b></a> - " . $echo_path;
		// For php viewing the page
		if (isset($_GET['phpfile']) && is_file($_GET['phpfile']) && ( ( $this->settings['protected_files_php_view'] == 1 && $this->is_protected($_GET['phpfile']) ) || !$this->is_protected($_GET['phpfile']) ) && $this->settings['php_source_view'] == 1) {
			$header .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"font-style: italic; color: green\">Sorgente PHP:</span> <a href=\"" . $_GET['phpfile'] . "\">" . $_GET['phpfile'] . "</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"" . $_SERVER['PHP_SELF'];
			if (isset($_GET['dir']))
				$header .= "?dir=" . $_GET['dir'];
			$header .= "\"> &lt; Ritorno alla directory</a>";
		}
		echo "</p>";
		// For editing file page
		if (isset($_GET['edit']) && is_file($_GET['edit']) && !$this->is_protected($_GET['edit'])) {
			$header .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"font-style: italic; color: green\">Edita:</span> <a href=\"" . $_GET['edit'] . "\">" . $_GET['edit'] . "</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"" . $_SERVER['PHP_SELF'];
			if (isset($_GET['dir']))
				$header .= "?dir=" . $_GET['dir'];
			$header .= "\"> &lt; Ritorno alla directory</a>";
		}
		if (isset($_COOKIE['dirphp_auth']))
			$header .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href=\"?logout\">Logout</a>";
		$header .= "\n";
		echo $header;
	} // End of display_header function
	
	function display_footer() {
		echo $this->settings['footer'];
	}
	
	function find_use_dir() {
		if (isset($_GET['dir'])) $use_dir = $_GET['dir'];
		if (isset($_POST['dir'])) $use_dir = $_POST['dir'];
		if (isset($_POST['upload_dir'])) $use_dir = $_POST['upload_dir'];
		if (!isset($use_dir)) {
			$use_dir = FALSE;
		}
		if ((@strstr($use_dir, "../") || eregi("^/", $use_dir))&& $this->settings['allow_higher_level_access'] == 0) {
			$use_dir = str_replace("../", "", $use_dir);
			$use_dir = eregi_replace("^/", "", $use_dir);
			$this->msg = "Higher level directory access disallowed.";
		}
		return $use_dir;
	} // End of find_use_dir function
	
	function load_defaults() {
		$this->settings['upload_on'] = 1;
		$this->settings['delete_on'] = 1;
		$this->settings['rename_on'] = 1;
		$this->settings['edit_on'] = 1;
		$this->settings['php_source_view'] = 1;
		$this->settings['allow_php_uploads'] = 1;
		$this->settings['delete_confirm'] = 1;
		$this->settings['upload_overwrite_on'] = 0;
		$this->settings['protected_files_show'] = 0;
		$this->settings['protected_files_php_view'] = 1;
		$this->settings['allow_higher_level_access'] = 0;
		$this->settings['logo'] = "";
		$this->settings['upload_path'] = "./";
		
		// Security authentication settings
		$this->security['authentication_on'] = 0;
		$this->security['hash'] = md5("default");  // Should change this
		$this->security['allowed_ips'] = array();
		
		$this->filetypes = array(   // CSS Definitions for filetypes -- ALL EXTENSIONS LOWER CASE
			'.php' => 'php',
			'.php3' => 'php',
			'.jpg' => 'image',
			'.jpeg' => 'image',
			'.gif' => 'image',
			'.png' => 'image',
			'.psd' => 'image',
			'.tif' => 'image',
			'.tiff' => 'image',
			'.bmp' => 'image',
			'.fla' => 'flash',
			'.swf' => 'flash',
			'.gz' => 'compressed',
			'.zip' => 'compressed',
			'.rar' => 'compressed'
		);

	} // End of load_defaults function
	
	function set($setting, $value = 2) {
		if ($value == 2) {
			if ($this->settings[$setting] == 0) {
				$value = 1;
			} else {
				$value = 0;
			}
		}
		$this->settings[$setting] = $value;
	} // End of set_setting function

	function display_dir() {
		echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">\n";
		echo "<tr class=\"header\"><td class=\"file\" style=\"padding: 2px\">File</td><td width=\"90\" class=\"file-property\">Dimensioni</td><td width=\"78\" class=\"file-property\">Modifica</td><td width=\"84\" class=\"file-options\" style=\"border: 0px\">Opzioni</td></tr>\n";
		//  Show parent directory link, if applicable
		if ($this->use_dir != "") echo "<tr height=\"24\"><td colspan=\"3\" class=\"file\" align=\"center\"><a href=\"" .$_SERVER['PHP_SELF'] . $this->parent_dir . "\"><span class=\"dir-view\">^</span></a> <span class=\"error_msg\">" . $this->use_dir . "</span></td><td class=\"file-options\">&nbsp;</td></tr>"; 
		//  Show error message
		$this->show_msg();
		//  Begin directory read loop
		while (($file = readdir($this->dir)) != FALSE) {
			$filename = $file;  // $filename will be unedited, while $file will have $use_dir tacked onto the front of it
			$file = $this->use_dir . $file;
			if ($filename == "." || $filename == "..") continue;  // Ignore self and parent directory links (first two entries in each directory)
			if ( $this->settings['protected_files_show'] == 0 && $this->is_protected($file) ) continue; // Don't show protected files
			$fsize = $this->file_property("size", $file);
			$fmtime = $this->file_property("modified", $file);
			// Check if it's a directory or not
			if (is_dir($file)) {
				$dir_files[$filename] = "<tr><td class=\"file\"><a href=\"" . $_SERVER['PHP_SELF'] . "?dir=" . $file . "/\"><span class=\"dir-view\" title=\"Naviga la cartella\">></span></a> <a href=\"" . $file . "\"><span class=\"directory\">" . $filename . "/</span></a></td><td class=\"file\">&nbsp;</td><td class=\"file\">&nbsp;</td><td class=\"file-options\" height=\"18\">" . $this->show_options($file) . "</td></tr>\n";
			// Check if it's a php file			
			} elseif (($this->settings['php_source_view'] == 1) && ( (substr($file, -4, 4) == ".php") || (substr($file, -5, 5) == ".php3") ) ) { 
				if ($this->use_dir != "") {
					$non_dir_files[$filename] = "<tr><td class=\"file\"><a href=\"" . $_SERVER['PHP_SELF'] . "?phpfile=" . $file . "&dir=" . $this->use_dir . "\"><span class=\"php\">" . $filename . "</span></a></td><td class=\"file-property\">" . $fsize . "</td><td class=\"file-property\">" . $fmtime . "</td><td class=\"file-options\" height=\"18\">" . $this->show_options($file) . "</td></tr>\n";
				} else {
					$non_dir_files[$filename] = "<tr><td class=\"file\"><a href=\"" . $_SERVER['PHP_SELF'] . "?phpfile=" . $file . "\"><span class=\"php\">" . $filename . "</span></a></td><td class=\"file-property\">" . $fsize . "</td><td class=\"file-property\">" . $fmtime . "</td><td class=\"file-options\">" . $this->show_options($file) . "</td></tr>\n";
				}
			// If not a directory or php file, parse the filename for filetype color-coding
			} else {
				$file_lower = strtolower($file);
				foreach ($this->filetypes as $key => $value) {  // Loops thru entire $filetypes array 
					$keylen = strlen($key);
					if (substr($file_lower, -$keylen, $keylen) == $key) {
						$non_dir_files[$filename] = "<tr><td class=\"file\"><a href=\"" . $file . "\"><span class=\"" . $value . "\">" . $filename . "</span></a></td><td class=\"file-property\">" . $fsize . "</td><td class=\"file-property\">" . $fmtime . "</td><td class=\"file-options\">" . $this->show_options($file) . "</td></tr>\n";
						continue 2;
					}
				}
				$non_dir_files[$filename] = "<tr style=\"border-top: 1px solid #000000\"><td class=\"file\"><a href=\"" . $file . "\">" . $filename . "</a></td><td class=\"file-property\">" . $fsize . "</td><td class=\"file-property\">" . $fmtime . "</td><td class=\"file-options\">" . $this->show_options($file) . "</td></tr>\n";
			}
		}
		// Sort the arrays alphabetically and output them
		if (isset($dir_files)) {
			ksort($dir_files);
			foreach ($dir_files as $value) echo $value;
		}
		if (isset($non_dir_files)) {
			ksort($non_dir_files);
			foreach ($non_dir_files as $value) echo $value;
		}
		echo "</table>\n";
		closedir($this->dir);
	} // End of display_dir function
	
	function upload_file($file) {  /*DONE*/
		$upload_path = "" . $this->use_dir;
		if ($this->is_protected($file['name']) || ($this->settings['allow_php_uploads'] == 0 && ( (substr($file['name'], -4, 4) == ".php") || (substr($file['name'], -5, 5) == ".php3") ) ) ) {
			$this->msg = "IL file da caricare &egrave; protetto.";
		} elseif ($this->settings['upload_overwrite_on'] == 0 && file_exists("./" . $upload_path . $file['name'])) {
			$this->msg = "Un file con lo stesso nome &egrave; gi&agrave; presente. Rinominalo e riprova.";
		} else {
			if (move_uploaded_file($file['tmp_name'], "./" . $upload_path . $file['name'])) {
				$this->msg = "File <u>" . $file['name'] . "</u> caricato correttamente.";
			} else {
				$this->msg = "File <u>" . $file['name'] . "</u> non caricato.";
			}
		}
	} // End of upload_file function
	
	function delete_file($file) {
		if ($this->settings['delete_on'] == 0) {
			$this->msg = "La cancellazione dei files non &egrave; consentita a momento.";
		} elseif ($this->is_protected($file)) {
			$this->msg = "Il file da cancellare &egrave; protetto.";
		} elseif (@unlink($file)) {
			$this->msg = "File '" . $file . "' cancellato <u>correttamente</u>.";
		} elseif (is_dir($file) && @rmdir($file)) {
			$this->msg = "Directory '" . $file . "' cancellata <u>correttamente</u>.";	
		} else {
			if (is_file($file) || is_dir($file)) { 
				$this->msg = "File '" . $file . "' non cancellato."; 
			} else { 
				$this->msg = "File da cencellare non esistente."; 
			}
			return FALSE;
		}
	} // End of delete_file function
	
	function php_source($php_file) { 
		if ($this->settings['php_source_view'] == 0) {
			$this->msg = "Visione del codice sorgente PHP non consentita.";
			return FALSE;
		} elseif ($this->is_protected($php_file) && $this->settings['protected_files_php_view'] == 0) {
			$this->msg = "Visione del codice sorgente PHP protetta.";
			return FALSE;
		} elseif (is_file($php_file)) {
			echo "<p style=\"background-color: #DDDDDD; text-align: center; padding: 3px; font-weight: bold\">*** INIZIO PHP FILE ***</p>\n\n";
			echo highlight_file($php_file)."\n\n";
			echo "<!-- FINE PHP FILE -->\n";
			echo "<p style=\"background-color: #DDDDDD; text-align: center; padding: 3px; font-weight: bold\">*** FINE PHP FILE ***</p>\n";
			return TRUE;
		} else {
			$this->msg = "PHP File non esistente";
			return FALSE;
		}
	} // End of php_source function
	
	function edit_file($file, $change_file = 0, $newfile = 0) {
		if ($change_file == 1) {
			$fp = fopen($file, "w");
			$newfile = stripslashes($newfile);
			if (fwrite($fp, $newfile)) $this->msg = "File <u>" . $filename . "</u> modificato correttamente.";
			fclose($fp);
		} else {
			if (is_writable("./" . $file)) {
				$ret  = "<p><form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"POST\">\n";
				$ret .= "<textarea cols=\"100\" rows=\"30\" wrap=\"off\" name=\"newfile\">\n";

				$contents = file_get_contents($file);
				$contents = str_replace("&nbsp;", "&amp;nbsp;", $contents);  // <--- Check for non-breaking space characters and maintain them
				
				$ret .= $contents;
				$ret .= "\n</textarea>\n";
				$ret .= "<br /><br />Salva come: <br><input type=\"text\" name=\"filename\" value=\"" . $file . "\">";
				$ret .= "<input type=\"hidden\" name=\"edit\" value=\"true\">\n";
				$ret .= "<input type=\"hidden\" name=\"dir\" value=\"" . $this->use_dir . "\">\n";
				$ret .= "<input type=\"submit\" name=\"submit\" value=\"Salva modifiche\">\n";
				$ret .= "</form></p><br />\n";
			} else {
				$ret .= "<p>Impossibile editare il file: permesso vietato.</p>\n";
			}
			return $ret;
		}
	} // End of edit_file function
	
	function rename_file($old, $new) {
		if ($this->settings['rename_on'] == 0) {
			$this->msg = "Rinomina non consentito.";
		} elseif ($this->is_protected($old)) {
			$this->msg = "File protetto.";
		} elseif (@rename($old, $new)) {
			$this->msg = "File " . $old . " rinominato in <u>" . $new . "</u>.";
		} else {
			$this->msg = "Impossibile rinominare il file " . $old . ".";
		}
	} // End of rename_file function
	
	function show_options($file) {
		$prot = 0;
		if ($this->is_protected($file)) $prot = 1;

		// Delete option
		if ($prot == 0 && $this->settings['delete_on'] == 1) {
			$ret = "<a href=\"" . $_SERVER['PHP_SELF'] . "?del=" . $file . "\" title=\"Cancela " . $file . "\"";
			if ($this->settings['delete_confirm'] == 1) 
				$ret .= "onClick=\"javascript: return confirm('Cancella file " . $file . "?')\"";
			$ret .= ">C</a> : ";
		} else {
			$ret = "<span class=\"greyed-out\" title=\"Cancellazione file non consentita " . $file . "\">C</span>: ";
		}

		// Rename option
		if ($prot == 0 && $this->settings['rename_on'] == 1) {
			$ret .= "<a href=\"" . $_SERVER['PHP_SELF'] . "?ren=" . $file . "\" title=\"Rinomina " . $file . "\">R</a> : ";
		} else {
			$ret .= "<span class=\"greyed-out\" title=\"Impossibile rinominare il file " . $file . "\">R</span>: ";
		}
		
		// Edit option
		if (!is_dir($file)) {
			if ($prot == 0 && $this->settings['edit_on'] == 1) {
				$ret .= "<a href=\"" . $_SERVER['PHP_SELF'] . "?edit=" . $file;
				if ($this->use_dir != "") 
					$ret .= "&dir=" . $this->use_dir;
				$ret .= "\" title=\"Edita " . $file . "\">E</a> : ";
			} else {
				$ret .= "<span class=\"greyed-out\" title=\"Impossibile eitare il file " . $file . "\">E</span>: ";
			}
		}
		
		// View option
		$ret .= "<a href=\"" . $file . "\" title=\"Vedi " . $file . "\">V</a>";
		return $ret;
	} // End of show_options function
	
	function is_protected($file) { /*DONE*/
		$file_protected = FALSE;
		foreach ($this->protected_files as $value) {  // Evaluate file being uploaded for list of protected files
			if ($file == $value) $file_protected = TRUE;		
		}
		return $file_protected;
	} // End of is_protected function
	
	function file_property($property, $file) {
		if ($property == "size") {   // File size property
				$size = filesize($file);
			if ($size > 1024 && $size < 1048576) {
				$size = round($size / 1024, 2) . " KB";
			} elseif ($size > 1048576) {
				$size = round($size / 1048576, 1) . " MB";
			} elseif ($size > 1073741824) {
				$size = round($size / 1073741824, 1) . " GB";
			} else {
				$size = $size . " B";
			}
			return $size;
		} elseif ($property == "modified") {   // Last modified date of file
			$modtime = date($this->date_format, filemtime($file));
			$modtime .= "&nbsp;";
			return $modtime;
		}
	} // End of file_property function
		
	function bottom_bar($upload_form = "default", $delete = 0) {
		if ($upload_form != "default") {
			$this->upload_form = $upload_form;
		} else {
			$this->upload_form = "<p><div class=\"bottom_bar\">";
			$this->upload_form .= "<div style=\"position: relative; width: 70px; float: right; top: 2px; right: 4px; font-size: 10px; \"><strong>Opzioni</strong><br><u>C</u>ancella<br><u>R</u>inomina<br><u>E</u>dita<br><u>V</u>edi</div>";
			if ($delete == 1) {
				$this->upload_form .= "<form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"get\"><input type=\"hidden\" name=\"ren\" value=\"" . $_GET['ren'] . "\">";
				$this->upload_form .= "Rinomina file <u>" . $_GET['ren'] . "</u> as:<p><input type=\"text\" name=\"newname\" value=\"" . $_GET['ren'] . "\">";
				$this->upload_form .= "<p><input type=\"submit\">\n";
			} elseif (@is_writable("./" . $this->use_dir) && $this->settings['upload_on'] == 1) {
				$this->upload_form .= "<form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\" enctype=\"multipart/form-data\" name=\"form1\">\n";
				$this->upload_form .= "Carica un file in questa cartella:<br>\n";
				$this->upload_form .= "  <p><input type=\"file\" name=\"file\"/></p>\n";
				$this->upload_form .= "  <p><input type=\"submit\" name=\"submit\" value=\"Invia\" /></p>\n";
				$this->upload_form .= "  <input type=\"hidden\" name=\"upload_dir\" value=\"" . $this->use_dir . "\" />";
				$this->upload_form .= "</form>";
			} else {
				$this->upload_form .= "Impossibile caricare in questa cartella.";
			}
			$this->upload_form .= "</div>\n";
		}
		echo $this->upload_form;
	} // End of set_upload_form function
	
	function show_msg() {
		if (isset($this->msg)) 
			echo "<tr><td colspan=\"3\" class=\"file\" align=\"center\"><span class=\"error_msg\">" . $this->msg . "</span></td></td><td class=\"file-options\">&nbsp;</td></tr>";
	}

} // End of DirPHP class

?>