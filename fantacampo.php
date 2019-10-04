<?php
	// #################################################################################
	// FANTACALCIOBAZAR EVOLUTION
	// Copyright (C) 2003-2009 by Antonello Onida
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
	//
	// Parametri da passare in GET: $riduci - $riduci1 - $orientamento_campetto
	// #################################################################################
	session_start ();
	require_once ("./dati/dati_gen.php");
	require ("./inc/funzioni.php");
	
	foreach (getallheaders() as $name => $value) {
		header_remove($name);
	}
	
	ob_end_clean();
	
	if ($_SESSION ['utente'] == @$_GET ['iutente']) {
		
		$clock_fantacampo [] = "Inizio " . microtime ();
		
		if (isset ( $test ))
		unset ( $test );
		if (isset ( $_GET ['test'] ))
		$test = @$_GET ['test'];
		
		if (! isset ( $test ))
		header ( "Content-Type: image/jpeg;" );
		if (isset ( $test ))
		echo "<h2>MODALITA FANTACAMPO CHE FA IL TEST DEGLI OGGETTI</h2><br />";
		
		$controllo_id_gioc = 0;
		if (isset ( $_GET ['iutente'] )) {
			$iutente = @$_GET ['iutente'];
			if (isset ( $test ))
			echo "iutente: $iutente preso dal parametro<br />";
			} else {
			$iutente = @$_SESSION ['utente'];
			if (isset ( $test ))
			echo "iutente: $iutente preso dalla sessione<br />";
		}
		//
		if (isset ( $_GET ['id_gioc'] )) {
			$id_gioc = @$_GET ['id_gioc'];
			if (isset ( $test ))
			echo "id_gioc: $id_gioc preso dal parametro<br />";
			} else {
			$id_gioc = "";
			$controllo_id_gioc = 1;
			if (isset ( $test ))
			echo "Parametro id_gioc non presente<br />";
		}
		
		$ultima_giornata = @$_GET ['ultima_giornata'];
		$orientamento_campetto = @$_GET ['orientamento_campetto'];
		$riduci = @$_GET ['riduci'];
		$riduci1 = @$_GET ['riduci1'];
		$pagina = @$_GET ['pagina'];
		$nome_squadra = @$_GET ['nome_squadra'];
		$orientamento_campetto = @$_GET ['orientamento_campetto'];
		
		if (isset ( $test ))
		error_reporting ( E_ALL );
		
		// $m_estenzione = ".gif";
		// $gd_support = "GIF";
		$m_estenzione = ".png";
		$gd_support = "PNG";
		
		if ($riduci < 40)
		$riduci = 40;
		if ($riduci > 200)
		$riduci = 200;
		
		if ($orientamento_campetto == 1) {
			$campo2 = ImageCreateFromJpeg ( "./immagini/campo_r.jpg" );
			} else {
			$campo2 = ImageCreateFromPng ( "./immagini/campo.png" );
		}
		
		$lar_imm = imagesx ( $campo2 );
		$alt_imm = imagesy ( $campo2 );
		$campo = ImageCreateTrueColor ( $lar_imm * $riduci / 100, $alt_imm * $riduci / 100 );
		imagecopyresized ( $campo, $campo2, 0, 0, 0, 0, $lar_imm * $riduci / 100, $alt_imm * $riduci / 100, $lar_imm, $alt_imm );
		ImageDestroy ( $campo2 );
		$lar_imm1 = imagesx ( $campo );
		$alt_imm1 = imagesy ( $campo );
		
		$colore_testo = ImageColorAllocate ( $campo, 255, 255, 255 );
		$colore_testo_rosso = ImageColorAllocate ( $campo, 255, 0, 0 );
		$colore_testo_nero = ImageColorAllocate ( $campo, 0, 0, 0 );
		$colore_testo_grey = ImageColorAllocate ( $campo, 192, 192, 192 );
		
		if (isset ( $test ))
		echo "controllo_id_gioc $controllo_id_gioc<br />";
		
		if ($id_gioc == "" and $controllo_id_gioc == 1) {
			$dati_squadra = @file ( $percorso_cartella_dati . "/squadra_$iutente" );
			if (isset ( $dati_squadra [1] ))
			$titolari = explode ( ",", $dati_squadra [1] );
			else
			$titolari = array ();
			
			if (isset ( $test )) {
				echo "<b>Modalita senza parametro id_gioc.</b><br />";
				if (is_file ( $percorso_cartella_dati . "/squadra_$iutente" )) {
					echo "Uso file: $percorso_cartella_dati/squadra_$iutente<br />";
					if (isset ( $dati_squadra [1] ))
					echo "Dati titolari: " . $dati_squadra [1] . "<br />totale titolari: <b>" . count ( $titolari ) . "</b><br />";
					else
					echo "Dati titolari mancanti<br />";
					if (isset ( $dati_squadra [2] ))
					echo "Dati panchinari: " . $dati_squadra [2] . "<br />";
					else
					echo "Dati panchinari mancanti<br />";
				} else
				echo "Non trovato file: $percorso_cartella_dati/squadra_$iutente<br />";
			}
			} else {
			$titolari = explode ( ",", $id_gioc );
			if (isset ( $test ))
			echo "<b>Modalita parametro id_gioc:  $id_gioc</b><br />";
		}
		
		$num_titolari = count ( $titolari ) - 1;
		sort ( $titolari, SORT_NUMERIC );
		$cp = 0;
		$cd = 0;
		$cc = 0;
		$ca = 0;
		
		$titolari_1 = array ();
		
		for($num1 = 0; $num1 <= $num_titolari; $num1 ++) {
			$numero_titolare = $titolari [$num1];
			$numero_titolare = intval ( $numero_titolare );
			if ($numero_titolare >= 100 and $numero_titolare <= 199) {
				if ($cp == 0) {
					$cp ++;
					$titolari_1 [] = $numero_titolare;
				} elseif (isset ( $test ))
				echo "C'e' piu' di un portiere! <b>($numero_titolare)</b> <br />";
				} elseif ($numero_titolare >= 200 and $numero_titolare <= 499) {
				$cd ++;
				$titolari_1 [] = $numero_titolare;
				} elseif ($numero_titolare >= 500 and $numero_titolare <= 799) {
				$cc ++;
				$titolari_1 [] = $numero_titolare;
				} elseif ($numero_titolare >= 800 and $numero_titolare <= 999) {
				$ca ++;
				$titolari_1 [] = $numero_titolare;
			}
		} // fine for $num1
		unset ( $num1 );
		
		if (isset ( $test ) and ($cp + $cd + $cc + $ca) > 11)
		echo "Ci sono piu' di 11 giocatori! <br />";
		
		$titolari = $titolari_1;
		unset ( $titolari_1 );
		sort ( $titolari, SORT_NUMERIC );
		$num_titolari = count ( $titolari ) - 1;
		
		if (@$ultima_giornata == "")
		$ultima_giornata = ultima_giornata_giocata ();
		
		if (@$ultima_giornata >= 1 and file_exists ( $percorso_cartella_voti . "/voti$ultima_giornata.txt" )) {
			$cerca_valutazione = @file ( $percorso_cartella_voti . "/voti$ultima_giornata.txt" );
			if (isset ( $test ))
			echo "Uso file: $percorso_cartella_voti/voti$ultima_giornata.txt<br />";
			} else {
			$cerca_valutazione = @file ( "$percorso_cartella_dati/calciatori.txt" );
			sort ( $cerca_valutazione, SORT_NUMERIC );
			if (isset ( $test )) {
				if (is_file ( "$percorso_cartella_dati/calciatori.txt" ))
				echo "Uso file: $percorso_cartella_dati/calciatori.txt<br />";
				else
				echo "Non trovato file: $percorso_cartella_dati/calciatori.txt<br />";
			}
		}
		
		$num_calciatori = count ( $cerca_valutazione );
		if (isset ( $test ))
		echo "Righe <b>( $num_calciatori )</b> dati alla riceca del nome calciatore e maglia e ruolo<br />";
		$contatore = 1;
		$spazio_d = 1;
		$spazio_c = 1;
		$spazio_a = 1;
		$riga_dati_calciatori = - 1;
		
		for($num1 = 0; $num1 <= $num_titolari; $num1 ++) {
			$numero_titolare = @$titolari [$contatore - 1];
			$numero_titolare = intval ( $numero_titolare );
			//
			$riga_dati_calciatori = ricerca_binaria ( $cerca_valutazione, $num_calciatori, $numero_titolare );
			//
			if ($riga_dati_calciatori != - 1) {
				// calciatore trovato
				$maglia_calciatore = explode ( $separatore_campi_file_calciatori, $cerca_valutazione [$riga_dati_calciatori] );
				
				$mnumero = $maglia_calciatore [($num_colonna_numcalciatore_file_calciatori - 1)];
				$mnumero = trim ( $mnumero );
				
				if ($mnumero == $numero_titolare and $contatore <= 11) {
					$mnome = stripslashes ( $maglia_calciatore [($num_colonna_nome_file_calciatori - 1)] );
					
					$mnome = trim ( $mnome );
					
					$mnome = preg_replace ( "#\"#", "", $mnome );
					
					if (preg_match ( "#[a-z]#", $mnome, $array ))
					;
					
					$posizione = strpos ( $mnome, $array [0] );
					
					// i luigi problema nome corto
					$mnome = $mnome . " ";
					// f luigi
					
					$mnome1 = $mnome;
					
					$mnome = substr ( $mnome, 0, strpos ( $mnome, $array [0] ) - 2 );
					$mnome = trim ( $mnome );
					
					$mnome1 = substr ( $mnome1, strpos ( $mnome1, $array [0] ) - 1, strlen ( $mnome1 ) );
					$mnome1 = trim ( $mnome1 );
					
					$mruolo = $maglia_calciatore [($num_colonna_ruolo_file_calciatori - 1)];
					
					$mruolo = trim ( $mruolo );
					
					$msquadra = $maglia_calciatore [($num_colonna_squadra_file_calciatori - 1)];
					$msquadra = preg_replace ( "#\"#", "", $msquadra );
					$msquadra = trim ( $msquadra );
					$msquadra = str_replace ( ' ', '_', $msquadra );
					$msquadra = str_replace ( "'", "_", $msquadra );
					
					// $m_squadra = "./immagini/m_".strtolower($msquadra).".gif";
					// i luigi
					$m_squadra = "./immagini/foto/" . $mnumero . ".png";
					$m_team = "./immagini/lp_" . strtolower ( $msquadra ) . ".png";
					// $m_squadra = "./immagini/m_".strtolower($msquadra).$m_estenzione;
					// f luigi
					
					if (isset ( $test )) {
						if (is_file ( "$m_squadra" ))
						echo "$contatore Esiste file: $m_squadra per il giocatore " . $titolari [$contatore - 1] . " $mnome $mnome1 <img src='$m_squadra' /><br />";
						else
						echo "$contatore Non esiste file: $m_squadra MA GESTITO!  per il giocatore " . $titolari [$contatore - 1] . " $mnome $mnome1<br />";
					}
					
					if (isset ( $test ) and ! is_file ( "$m_squadra" )) {
						if (is_file ( "./immagini/m_" . "no_squadra" . $m_estenzione ))
						echo "$contatore Esiste file: ./immagini/m_no_squadra" . $m_estenzione . " per il giocatore " . $titolari [$contatore - 1] . " $mnome $mnome1 <img src='./immagini/m_no_squadra" . $m_estenzione . "' /><br />";
						else
						echo "$contatore Non esiste file: ./immagini/m_no_squadra" . $m_estenzione . " per il giocatore " . $titolari [$contatore - 1] . " $mnome $mnome1<br />";
					}
					
					if (! is_file ( "$m_squadra" ))
					$m_squadra = "./immagini/m_" . "no_squadra" . $m_estenzione;
					
					if ($gd_support == "GIF")
					$imm_calciatore = ImageCreateFromGif ( "$m_squadra" );
					else
					// Get new sizes
					list ( $width, $height ) = getimagesize ( $m_squadra );
					$newwidth = '70';
					$newheight = '70';
					
					// Load
					$thumb = imagecreatetruecolor ( $newwidth, $newheight );
					// start changes
					
					$background = imagecolorallocate ( $thumb, 255, 2, 2 );
					
					imagecolortransparent ( $thumb, $background );
					
					imagealphablending ( $thumb, false );
					
					imagesavealpha ( $thumb, true );
					
					// end changes
					$source = imagecreatefrompng ( $m_squadra );
					
					// Resize
					imagecopyresampled ( $thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height );
					
					// Output
					$imm_calciatore = $thumb;
					$imm_sqa = imagecreatefrompng ( $m_team );
					
					$lar_imm2 = imagesx ( $imm_calciatore );
					$alt_imm2 = imagesy ( $imm_calciatore );
					$lar_lg = imagesx ( $imm_sqa );
					$alt_lg = imagesy ( $imm_sqa );
					
					if ($orientamento_campetto == 0) {
						$alt_p = 1;
						
						if ($mruolo == "0") {
							$altezza = $alt_p;
							$larghezza = ($lar_imm1 - $lar_imm2) / 2;
							} elseif ($mruolo == "1") {
							$larghezza = $lar_imm1 - ($lar_imm2 * $cd);
							$larghezza = $larghezza / ($cd + 2);
							$larghezza = ($larghezza + $lar_imm2) * $spazio_d - $lar_imm2;
							$altezza = ($alt_imm1 - $alt_imm2) / 3.5 + $alt_p;
							$spazio_d ++;
							} elseif ($mruolo == "2") {
							$larghezza = $lar_imm1 - ($lar_imm2 * $cc);
							$larghezza = $larghezza / ($cc + 1);
							$larghezza = ($larghezza + $lar_imm2) * $spazio_c - $lar_imm2;
							$altezza = ($alt_imm1 - $alt_imm2) * 2 / 3.35 + $alt_p;
							$spazio_c ++;
							} elseif ($mruolo == "3") {
							$larghezza = $lar_imm1 - ($lar_imm2 * $ca);
							$larghezza = $larghezza / ($ca + 1);
							$larghezza = ($larghezza + $lar_imm2) * $spazio_a - $lar_imm2;
							$altezza = ($alt_imm1 - $alt_imm2) * 3 / 3.3 + $alt_p;
							$spazio_a ++;
						}
						
						ImageCopy ( $campo, $imm_sqa, $larghezza + 40, $altezza + 20, 0, 0, $lar_lg, $alt_lg );
						ImageCopy ( $campo, $imm_calciatore, $larghezza, $altezza, 0, 0, $lar_imm2, $alt_imm2 );
						$spaziatura = 2;
						$altezza_testo = $altezza + $alt_imm2 + $spaziatura;
						$larghezza1 = $larghezza - strlen ( $mnome1 ) + 25;
						ImageString ( $campo, 1, $larghezza1, $altezza_testo, $mnome, $colore_testo );
						ImageString ( $campo, 1, $larghezza1, $altezza_testo + 8, $mnome1, $colore_testo );
						$contatore ++;
						$larghezza = 0;
						
						} elseif ($orientamento_campetto == 1) {
						$alt_p = 17;
						
						if ($mruolo == "0") {
							$larghezza = $alt_p;
							$altezza = ($alt_imm1 - $alt_imm2) / 2;
							} elseif ($mruolo == "1") {
							$altezza = $alt_imm1 - ($alt_imm2 * $cd);
							$altezza = $altezza / ($cd + 1);
							$altezza = ($altezza + $alt_imm2) * $spazio_d - $alt_imm2;
							$larghezza = ($lar_imm1 - $lar_imm2) / 4 + $alt_p;
							$spazio_d ++;
							} elseif ($mruolo == "2") {
							$altezza = $alt_imm1 - ($alt_imm2 * $cc);
							$altezza = $altezza / ($cc + 1);
							$altezza = ($altezza + $alt_imm2) * $spazio_c - $alt_imm2;
							$larghezza = ($lar_imm1 - $lar_imm2) * 2 / 4 + $alt_p;
							$spazio_c ++;
							} elseif ($mruolo == "3") {
							$altezza = $alt_imm1 - ($alt_imm2 * $ca);
							$altezza = $altezza / ($ca + 1);
							$altezza = ($altezza + $alt_imm2) * $spazio_a - $alt_imm2;
							$larghezza = ($lar_imm1 - $lar_imm2) * 3 / 4 + $alt_p;
							$spazio_a ++;
						}
						
						ImageCopy ( $campo, $imm_calciatore, $larghezza, $altezza, 0, 0, $lar_imm2, $alt_imm2 );
						$spaziatura = 2;
						$altezza_testo = $altezza + $alt_imm2 + $spaziatura;
						$larghezza1 = $larghezza - strlen ( $mnome1 );
						ImageString ( $campo, 1, $larghezza1, $altezza_testo, $mnome, $colore_testo );
						ImageString ( $campo, 1, $larghezza1, $altezza_testo + 8, $mnome1, $colore_testo );
						$contatore ++;
						$larghezza = 0;
					} // elseif ($orientamento_campetto
					} elseif (($contatore > 11)) {
					
					if (isset ( $test ))
					echo "Ci sono piu' di 11 giocatori! esco dalla for <br />";
					break;
				}
				} elseif ($riga_dati_calciatori == - 1 and $contatore <= 11) {
				$m_squadra_no = "./immagini/m_" . "no_squadra" . $m_estenzione;
				
				if (isset ( $test )) {
					if (is_file ( "$m_squadra_no" ))
					echo "$contatore Esiste file $m_squadra_no per il giocatore " . $titolari [$contatore - 1] . " <img src='$m_squadra_no' /><br />";
					else
					echo "$contatore Non esiste file $m_squadra_no  per il giocatore  " . $titolari [$contatore - 1] . "<br />";
				}
				
				if ($gd_support == "GIF")
				$imm_calciatore = ImageCreateFromGif ( "$m_squadra_no" );
				else
				$imm_calciatore = ImageCreateFromPng ( "$m_squadra_no" );
				//
				$lar_imm2 = imagesx ( $imm_calciatore );
				$alt_imm2 = imagesy ( $imm_calciatore );
				//
				if ($orientamento_campetto == 0) {
					$alt_p = "12";
					//
					if (($numero_titolare >= 100) and ($numero_titolare <= 199)) {
						$altezza = $alt_p;
						$larghezza = ($lar_imm1 - $lar_imm2) / 2;
						} elseif ($numero_titolare >= 200 and $numero_titolare <= 499) {
						$larghezza = $lar_imm1 - ($lar_imm2 * $cd);
						$larghezza = $larghezza / ($cd + 1);
						$larghezza = ($larghezza + $lar_imm2) * $spazio_d - $lar_imm2;
						$altezza = ($alt_imm1 - $alt_imm2) / 4 + $alt_p;
						$spazio_d ++;
						} elseif ($numero_titolare >= 500 and $numero_titolare <= 799) {
						$larghezza = $lar_imm1 - ($lar_imm2 * $cc);
						$larghezza = $larghezza / ($cc + 1);
						$larghezza = ($larghezza + $lar_imm2) * $spazio_c - $lar_imm2;
						$altezza = ($alt_imm1 - $alt_imm2) * 2 / 4 + $alt_p;
						$spazio_c ++;
						} elseif ($numero_titolare >= 800 and $numero_titolare <= 999) {
						$larghezza = $lar_imm1 - ($lar_imm2 * $ca);
						$larghezza = $larghezza / ($ca + 1);
						$larghezza = ($larghezza + $lar_imm2) * $spazio_a - $lar_imm2;
						$altezza = ($alt_imm1 - $alt_imm2) * 3 / 4 + $alt_p;
						$spazio_a ++;
					}
					
					ImageCopy ( $campo, $imm_calciatore, $larghezza, $altezza, 0, 0, $lar_imm2, $alt_imm2 );
					$spaziatura = 2;
					$altezza_testo = $altezza + $alt_imm2 + $spaziatura;
					$larghezza1 = $larghezza - strlen ( " " . $titolari [$contatore - 1] );
					ImageString ( $campo, 1, $larghezza1, $altezza_testo, " " . $titolari [$contatore - 1], $colore_testo );
					// ImageString($campo,1,$larghezza1,$altezza_testo+8,$mnome1,$colore_testo);
					$contatore ++;
					$larghezza = 0;
					} elseif (@$orientamento_campetto == 1) {
					$alt_p = 17;
					//
					if (($numero_titolare >= 100) and ($numero_titolare <= 199)) {
						$larghezza = $alt_p;
						$altezza = ($alt_imm1 - $alt_imm2) / 2;
						} elseif ($numero_titolare >= 200 and $numero_titolare <= 499) {
						$altezza = $alt_imm1 - ($alt_imm2 * $cd);
						$altezza = $altezza / ($cd + 1);
						$altezza = ($altezza + $alt_imm2) * $spazio_d - $alt_imm2;
						$larghezza = ($lar_imm1 - $lar_imm2) / 4 + $alt_p;
						$spazio_d ++;
						} elseif ($numero_titolare >= 500 and $numero_titolare <= 799) {
						$altezza = $alt_imm1 - ($alt_imm2 * $cc);
						$altezza = $altezza / ($cc + 1);
						$altezza = ($altezza + $alt_imm2) * $spazio_c - $alt_imm2;
						$larghezza = ($lar_imm1 - $lar_imm2) * 2 / 4 + $alt_p;
						$spazio_c ++;
						} elseif ($numero_titolare >= 800 and $numero_titolare <= 999) {
						$altezza = $alt_imm1 - ($alt_imm2 * $ca);
						$altezza = $altezza / ($ca + 1);
						$altezza = ($altezza + $alt_imm2) * $spazio_a - $alt_imm2;
						$larghezza = ($lar_imm1 - $lar_imm2) * 3 / 4 + $alt_p;
						$spazio_a ++;
					}
					//
					ImageCopy ( $campo, $imm_calciatore, $larghezza, $altezza, 0, 0, $lar_imm2, $alt_imm2 );
					$spaziatura = 2;
					$altezza_testo = $altezza + $alt_imm2 + $spaziatura;
					$larghezza1 = $larghezza - strlen ( " " . $titolari [$contatore - 1] );
					ImageString ( $campo, 1, $larghezza1, $altezza_testo, " " . $titolari [$contatore - 1], $colore_testo );
					// ImageString($campo,1,$larghezza1,$altezza_testo+8,$mnome1,$colore_testo);
					$contatore ++;
					$larghezza = 0;
				} // elseif ($orientamento_campetto
				
				// f luigi gestione calciatore non trovato
			} // end-if condizione su "$riga_dati_calciatori"
		} // fine for
		
		$riga_testo = 20;
		// ImageString ( $campo, 1, 16, $riga_testo, "Modulo: $cd-$cc-$ca", $colore_testo );
		ImageString ( $campo, 1, 15, $riga_testo, "MODULO: $cd-$cc-$ca", $colore_testo_nero );
		
		if ((isset ( $_GET ['iutente'] ) and isset ( $_GET ['id_gioc'] ) and $iutente != "") or (! isset ( $_GET ['iutente'] ) and ! isset ( $_GET ['id_gioc'] ) and $iutente != "")) {
			$riga_testo += 10;
			ImageString ( $campo, 1, 15, $riga_testo, "Utente: $iutente", $colore_testo );
		}
		
		if ($nome_squadra != "") {
			$riga_testo += 10;
			ImageString ( $campo, 1, 15, $riga_testo, "Squadra: $nome_squadra", $colore_testo );
		}
		if ($ultima_giornata != "") {
			$riga_testo += 10;
			// ImageString ( $campo, 1, 16, $riga_testo, "Giornata: $ultima_giornata", $colore_testo );
			ImageString ( $campo, 1, 15, $riga_testo, "GIORNATA: $ultima_giornata", $colore_testo_nero );
		}
		
		if (($cp + $cd + $cc + $ca) < 11) {
			$riga_testo += 10;
			ImageString ( $campo, 5, 141, 10, "MANCANO DEI TITOLARI !", $colore_testo_rosso );
			ImageString ( $campo, 5, 140, 10, "MANCANO DEI TITOLARI !", $colore_testo_nero );
		}
		
		if ($riduci1) {
			if ($riduci1 < 40 or $riduci1 > 200)
			$riduci1 = 100;
			$lar_imm = imagesx ( $campo );
			$alt_imm = imagesy ( $campo );
			$campo1 = ImageCreateTrueColor ( $lar_imm * $riduci1 / 100, $alt_imm * $riduci1 / 100 );
			ImageCopyResized ( $campo1, $campo, 0, 0, 0, 0, $lar_imm * $riduci1 / 100, $alt_imm * $riduci1 / 100, $lar_imm, $alt_imm );
			ImageDestroy ( $campo );
			if (! isset ( $test )) {
				header ( "Pragma: no-cache" );
				header ( "Expires: 0" );
				header ( "Cache-Control: must-revalidate, post-check=0, pre-check=0;" );
				header ( "Cache-Control: public;" );
				header ( "Content-Description: File Transfer;" );
				header ( "Content-Type: image/png;" );
				header ( "Content-Disposition: filename=squadra_" . $nome_squadra . "_" . $iutente . "_gg_" . $ultima_giornata . ".jpg;" );
				imagepng ( $campo1 );
			}
			ImageDestroy ( $campo1 );
			} else {
			if (! isset ( $test )) {
				header ( "Pragma: no-cache" );
				header ( "Expires: 0" );
				header ( "Cache-Control: must-revalidate, post-check=0, pre-check=0;" );
				header ( "Cache-Control: public;" );
				header ( "Content-Description: File Transfer;" );
				header ( "Content-Type: image/png;" );
				header ( "Content-Disposition: filename=squadra_" . $nome_squadra . "_" . $iutente . "_gg_" . $ultima_giornata . ".jpg;" );
				imagepng ( $campo );
			}
			ImageDestroy ( $campo );
		}
		
		$clock_fantacampo [] = "fine " . microtime ();
		
		// ##############################################################################
		if (isset ( $test )) {
			$start_clock_fantacampo = explode ( " ", $clock_fantacampo [0] );
			$end_clock_fantacampo = explode ( " ", $clock_fantacampo [1] );
			$start_time_fantacampo = $start_clock_fantacampo [1] + $start_clock_fantacampo [2];
			unset ( $clock_fantacampo );
			unset ( $start_clock_fantacampo );
			$total_time_fantacampo = ($end_clock_fantacampo [1] + $end_clock_fantacampo [2]) - $start_time_fantacampo;
			unset ( $end_clock_fantacampo );
			$total_time_fantacampo = round ( $total_time_fantacampo, 3 );
			
			echo "<br /><b>Elaborata in $total_time_fantacampo secondi</b><br />";
			
			unset ( $total_time_fantacampo );
			
			echo "<br /><br />";
			echo "1 SERVER_NAME.PHP_SELF: http://" . @$_SERVER ['SERVER_NAME'] . @$_SERVER ['PHP_SELF'] . "<br />";
			echo "2 urlsito: " . @$_SESSION ['urlsito'] . "/fantacampo.php<br />";
			
			echo "<br />";
			
			echo "m_estenzione: $m_estenzione <br />
			gd_support: $gd_support<br />
			iutente: $iutente<br />
			id_gioc: $id_gioc<br />
			ultima_giornata: $ultima_giornata<br />
			orientamento_campetto: $orientamento_campetto<br />
			riduci: $riduci<br />
			riduci1: $riduci1<br />
			pagina: $pagina<br />
			nome_squadra: $nome_squadra<br />
			modulo: $cd-$cc-$ca<br>
			test: $test<br />";
			
			if (file_exists ( "./immagini/campo_r.jpg" ))
			echo "Esiste il file ./immagini/campo_r.jpg<br /><img src='./immagini/campo_r.jpg' /><br />";
			else
			echo "Non esiste il file ./immagini/campo_r.jpg<br />";
			if (file_exists ( "./immagini/campo.jpg" ))
			echo "Esiste il file ./immagini/campo.jpg<br /><img src='./immagini/campo.jpg' /><br />";
			else
			echo "Non esiste il file ./immagini/campo.jpg<br />";
			echo "<br />ULTERIORI VERIFICHE SQUADRE-IMMAGINI:<br />";
			if (file_exists ( "$percorso_cartella_dati/squadre.txt" ))
			echo "Esiste il file $percorso_cartella_dati/squadre.txt<br /><br />";
			else
			echo "Non esiste il file $percorso_cartella_dati/squadre.txt<br />";
			
			$team = @file ( $percorso_cartella_dati . "/squadre.txt" );
			$numteam = count ( $team );
			$creata = "";
			//
			for($num1 = 0; $num1 < $numteam; $num1 ++) {
				$msquadra = strtolower ( $team [$num1] );
				$file_input_imgm = "./immagini/t_" . trim ( strtolower ( $msquadra ) ) . $m_estenzione;
				
				if (file_exists ( $file_input_imgm ))
				echo "Esiste il file $file_input_imgm <img src='$file_input_imgm' /><br />";
				else
				echo "Non esiste il file $file_input_imgm <br />";
			}
			$msquadra = "no_squadra";
			$file_input_imgm = "./immagini/m_" . trim ( strtolower ( $msquadra ) ) . $m_estenzione;
			if (file_exists ( $file_input_imgm ))
			echo "Esiste il file $file_input_imgm <img src='$file_input_imgm' /><br />";
			else
			echo "Non esiste il file $file_input_imgm <br />";
			echo "<br /><br />";
			echo "<h2>Prova funzionamento</h2><img src='http://" . @$_SERVER ['SERVER_NAME'] . @$_SERVER ['PHP_SELF'] . "?id_gioc=$id_gioc&iutente=$iutente&ultima_giornata=$ultima_giornata&orientamento_campetto=$orientamento_campetto&riduci=$riduci&riduci1=$riduci1&pagina=$pagina&nome_squadra=$nome_squadra' border='0' align='center' alt='Squadra in campo $nome_squadra di $iutente' title='Squadra in campo $nome_squadra di $iutente' />";
			echo "<br /><br />";
		} // end if(isset($test))
	}
?>