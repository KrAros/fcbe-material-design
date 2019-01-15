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
	include("./controlla_pass.php");
	include("./header.php");
	
	if ($_SESSION['valido'] == "SI") 
	
	if ($stato_mercato == "I" OR $stato_mercato == "B" OR $stato_mercato == "R") echo "<h3>FASE INIZIALE: statistiche non disponibili!</h3>";
	
	$partite_giocate = 0;
	$somma_voti_tot = 0;
	$somma_voti_giornale = 0;
	$stringav="";
	$stringafv="";
	
	for ($num1 = 1; $num1 < 40 ; $num1++) {
		if (strlen($num1) == 1) $num1 = "0".$num1;
		
		if ($voti = @file("$percorso_cartella_voti/voti$num1.txt")) {
			$num_voti = count($voti);
			for ($num2 = 0 ; $num2 < $num_voti ; $num2++) {
				$dati_voto = explode($separatore_campi_file_voti, $voti[$num2]);
				$num_calciatore_voto = $dati_voto[($num_colonna_numcalciatore_file_voti-1)];
				$num_calciatore_voto = trim($num_calciatore_voto);
				
				if ($num_calciatore == $num_calciatore_voto) {
					$voto_tot = $dati_voto[($num_colonna_vototot_file_voti-1)];
					$voto_tot = trim($voto_tot);
					$voto_tot = str_replace(",",".",$voto_tot);
					
					$stringafv .= $dati_voto[7].",";
					$stringav .= $dati_voto[10].",";
					
					$voto_giornale = $dati_voto[($num_colonna_votogiornale_file_voti-1)];
					$voto_giornale = trim($voto_giornale);
					$voto_giornale = str_replace(",",".",$voto_giornale);
					if ($voto_tot != 0 or $voto_giornale != 0) {
						$partite_giocate++;
						$somma_voti_tot = $somma_voti_tot + $voto_tot;
						$somma_voti_giornale = $somma_voti_giornale + $voto_giornale;
					} # fine if ($voto_tot != 0 or $voto_giornale != 0)
					
					if ($statistiche == "SI" and $stato_mercato != "I") {
						$stat_codice = $dati_voto[($ncs_codice -1)];
						$stat_giornata = $dati_voto[($ncs_giornata -1)];
						$stat_nome = $dati_voto[($ncs_nome -1)];
						$stat_nome = preg_replace ( "/\"/", "",$stat_nome);
						$stat_squadra = $dati_voto[($ncs_squadra -1)];
						$stat_squadra = preg_replace ( "/\"/", "",$stat_squadra);
						$stat_attivo = $dati_voto[($ncs_attivo -1)];
						$stat_ruolo = $dati_voto[($ncs_ruolo -1)];
						$stat_presenza = $dati_voto[($ncs_presenza -1)]; $totpresenze = $totpresenze + $stat_presenza;
						$stat_votofc = $dati_voto[($ncs_votofc -1)]; $totvotfc = $totvotfc + $stat_votofc;
						$stat_mininf25 = $dati_voto[($ncs_mininf25 -1)]; $totmininf25 = $totmininf25 + $stat_mininf25;
						$stat_minsup25 = $dati_voto[($ncs_minsup25 -1)]; $totminsup25 = $totminsup25 + $stat_minsup25;
						$stat_voto = $dati_voto[($ncs_voto -1)]; $totvot = $totvot + $stat_voto;
						$stat_golsegnati = $dati_voto[($ncs_golsegnati -1)]; $totgol = $totgol + $stat_golsegnati;
						$stat_golsubiti = $dati_voto[($ncs_golsubiti -1)]; $totgolsub = $totgolsub + $stat_golsubiti;
						$stat_golvittoria = $dati_voto[($ncs_golvittoria -1)]; $totgolvit = $totgolvit + $stat_golvittoria;
						$stat_golpareggio = $dati_voto[($ncs_golpareggio -1)]; $totgolpar = $totgolpar + $stat_golpareggio;
						$stat_assist = $dati_voto[($ncs_assist -1)]; $totass = $totass + $stat_assist;
						$stat_ammonizione = $dati_voto[($ncs_ammonizione -1)]; $totamm = $totamm + $stat_ammonizione;
						$stat_espulsione = $dati_voto[($ncs_espulsione -1)]; $totesp = $totesp + $stat_espulsione;
						$stat_rigoretirato = $dati_voto[($ncs_rigoretirato -1)]; $totrigt = $totrigt + $stat_rigoretirato;
						$stat_rigoresubito = $dati_voto[($ncs_rigoresubito -1)]; $totrigs = $totrigs + $stat_rigoresubito;
						$stat_rigoreparato = $dati_voto[($ncs_rigoreparato -1)]; $totrigp = $totrigp + $stat_rigoreparato;
						$stat_rigoresbagliato = $dati_voto[($ncs_rigoresbagliato -1)]; $totrigsb = $totrigsb + $stat_rigoresbagliato;
						$stat_autogol = $dati_voto[($ncs_autogol -1)]; $totaut = $totaut + $stat_autogol;
						$stat_subentrato = $dati_voto[($ncs_entrato -1)];
						$stat_titolare = $dati_voto[($ncs_titolare -1)]; $tottit = $tottit + $stat_titolare;
						$stat_valore = $dati_voto[($ncs_valore -1)];
					}
					
					break;
				} # fine if ($num_calciatore == $num_calciatore_voto)
				$ultima_giornata = $num1;
			} # fine if ($voti = @file("$percorso_cartella_voti/voti$num1.txt"))
		} # fine for $num2
	} # fine for $num1
	
	if ($partite_giocate != 0) {
		$media_giornale = round(($somma_voti_giornale /$partite_giocate),2);
		$media_punti = round(($somma_voti_tot / $partite_giocate),2);
	} # fine if ($partite_giocate != 0)
	else {
		$media_giornale = 0;
		$media_punti = 0;
	} # fine else if ($partite_giocate != 0)
	
	
	if ($ultima_giornata != "") $calciatori = file("$prima_parte_pos_file_voti$ultima_giornata.txt");
	else $calciatori = file("$percorso_cartella_dati/calciatori.txt");
	$calciatori_iniziale = file("$percorso_cartella_dati/calciatori.txt");
	
	$num_calciatori = count($calciatori);
	for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
		$dati_calciatore = explode($separatore_campi_file_calciatori, $calciatori[$num1]);
		$numero = $dati_calciatore[($num_colonna_numcalciatore_file_calciatori-1)];
		$numero = trim($numero);
		if ($num_calciatore == $numero) {
			$nome = stripslashes($dati_calciatore[($num_colonna_nome_file_calciatori-1)]);
			$nome = trim($nome);
			$nome = preg_replace ( "/\"/", "",$nome);
			if ($num_colonna_squadra_file_calciatori != 0) {
				$xsquadra = $dati_calciatore[($num_colonna_squadra_file_calciatori-1)];
				$xsquadra = trim($xsquadra);
				$xsquadra = preg_replace ( "/\"/", "",$xsquadra);
			} # fine if ($num_colonna_squadra_file_calciatori != 0)
			$s_ruolo = $dati_calciatore[($num_colonna_ruolo_file_calciatori-1)];
			$s_ruolo = trim($s_ruolo);
			$ruolo = $s_ruolo;
			if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
			if ($s_ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
			if ($s_ruolo == $simbolo_portiere_file_calciatori){ $ruolo = "P"; $backruolo = "#ffb732";};
			if ($s_ruolo == $simbolo_difensore_file_calciatori){ $ruolo = "D"; $backruolo = "#00007f";}
			if ($s_ruolo == $simbolo_centrocampista_file_calciatori){ $ruolo = "C"; $backruolo = "#006600";}
			if ($s_ruolo == $simbolo_attaccante_file_calciatori){ $ruolo = "A"; $backruolo = "#cc0000";}
			###### Quotazione iniziale ######
			$valore_calciatore = explode($separatore_campi_file_calciatori, $calciatori_iniziale[$num1]);
			$quotazione_iniziale = $valore_calciatore[($num_colonna_valore_calciatori-1)];
			break;
		} # fine if ($num_calciatore == $numero)
	} # fine for $num1
	
	if ($statistiche == "SI" and $stato_mercato != "I") {
		if ($stat_attivo == 0) $mess = "<b><font color='darkred'>Trasferito</font></b>";
		else $mess = "<b><font color='darkgreen'>In attivit&agrave;</font></b>";
		
		if ($stat_ruolo == 0) $st_ruolo = "<span class='black-text text-darken-2' style='font-size: 36px;'>PORTIERE</span>";
		if ($stat_ruolo == 1) $st_ruolo = "<span class='white-text text-darken-2' style='font-size: 36px;'>DIFENSORE</span>";
		if ($stat_ruolo == 2) $st_ruolo = "<span class='white-text text-darken-2' style='font-size: 22px;top: 12px;position: relative;'>CENTROCAMPISTA</span>";
		if ($stat_ruolo == 3) $st_ruolo = "<span class='white-text text-darken-2' style='font-size: 32px;'>ATTACCANTE</span>";
		# if ($stat_ruolo == 3) $st_ruolo = "Fantasista";
			
			############################################################## OUTPUT ####
			
echo '<div class="container" style="width: 85%;margin-top: -10px;">
	<div class="card-panel">
    	<div class="row">';
			
			require ("./widget.php");
			echo'<div class="col m9">';
				echo"<div class='bread'><a href='./mercato.php'>Gestione</a> / <a href='./tab_squadre.php?vedi_squadra=".strtoupper($stat_squadra)."&escludi_controllo='>".ucfirst(strtolower($stat_squadra))."</a> / $nome</div><br>";
				tabella_squadre();
				echo "<br>";
			
				echo"
				<div class='card'>
				    <div class='card-content'>
				        <span class='card-title'>$nome<span style='font-size: 13px;'> - $mess</span></span>
			 	        <hr>
			  	        <div class='row'>
			  	            <div class='col m4 center-align'>
			   	               <div class='card'>
			   	                    <div class='card-content'>";
			                            if ($foto_calciatori == "SI"){
				                            if (@is_file("$foto_path$num_calciatore.png")) echo "<img src='$foto_path$num_calciatore.png' alt='$num_calciatore' class='shadow' />";
				                            else if (@is_file("$foto_path$num_calciatore.jpg")) echo "<img src='$foto_path$num_calciatore.jpg' alt='$num_calciatore' class='shadow' />";
				                            else if (@is_file("$foto_path$num_calciatore.gif"))echo "<img src='$foto_path$num_calciatore.gif' alt='$num_calciatore' class='shadow' />";
				                            else echo "<img src='immagini/nofoto.jpg' alt'Nessuna foto' class='shadow' />";
			                            }		
			    echo"
			                        </div>
					            </div>
				            </div>
			
			                <div class='col m4 center-align'>
			                    <div class='card'>
			                        <div class='card-content'>
			                            <img height='160'src='./immagini/$stat_squadra.png'>
					                </div>
				                </div>
			                </div>
			
    			            <div class='col m4'>
	    		                <div class='card center-align'>
		    	                    <div class='card-content' style='padding: 0;'>
			    
			                            <div style='background: $backruolo; padding:24px;height: 104px;'>$st_ruolo</div>
			
			                            <div class='quotazioni col m6 grey lighten-1'><span class='titoloquotazioni'><b>QUOTAZIONE<br>INIZIALE</b></span><div class='numeroquotazioni grey lighten-3'><span class='valorequotazione'>$quotazione_iniziale</span></div></div>";
					    				if ($quotazione_iniziale < $stat_valore) { echo "<div class='quotazioni col m6 green lighten-1'><span class='titoloquotazioni'><b>QUOTAZIONE<br>ATTUALE</b></span><div class='numeroquotazioni green darken-2'><span class='valorequotazioneok'>$stat_valore</span></div></div>"; }
	                                    else { echo "<div class='quotazioni col m6 red lighten-1'><span class='titoloquotazioni'><b>QUOTAZIONE<br>ATTUALE</b></span><div class='numeroquotazioni red darken-2'><span class='valorequotazioneok'>$stat_valore</span></div></div>"; }
			                            echo"
			
			                        </div>
				                </div>
			                </div>
			            </div>
					
    					<span class='card-title'>Statistiche <span style='font-size: 13px;'> - Giornata $ultima_giornata</span></span>
	    		        <hr>
		    			<div class='row'>
			                <div class='col m4'>
			                    <div class='card green lighten-2'>
			                        <div class='card-content' style='text-align: center;'>
						    		    <span class='black-text text-darken-2' style='font-size: 48px;'>$partite_giocate</span><br><span class='black-text text-darken-2'>PRESENZE</span>
							    	</div>
							    </div>
						    </div>
			                <div class='col m2'>
			                    <div class='card yellow lighten-2'>
			                        <div class='card-content' style='text-align: center;'>
    								    <span class='black-text text-darken-2' style='font-size: 48px;'>$totamm</span><br><span class='black-text text-darken-2'>AMMONIZIONI</span>
	    							</div>
		    					</div>
			    			</div>
			                <div class='col m2'>
			                    <div class='card red lighten-2'>
			                        <div class='card-content' style='text-align: center;'>
							    	    <span class='black-text text-darken-2' style='font-size: 48px;'>$totesp</span><br><span class='black-text text-darken-2'>ESPULSIONI</span>
								    </div>
							    </div>
						    </div>
			                <div class='col m2'>
    			                <div class='card blue lighten-2'>
	    		                    <div class='card-content' style='text-align: center;'>
		    						    <span class='black-text text-darken-2' style='font-size: 48px;'>";
			    						    if ( $ruolo == "P") { echo "$totgolsub"; } else echo "$totgol"; echo"</span><br><span class='black-text text-darken-2'>";
				    					    if ( $ruolo == "P") { echo "GOL SUBITI"; } else echo "GOL FATTI";
					    				echo "</span>
						    		</div>
							    </div>
						    </div>
			                <div class='col m2'>
    			                <div class='card teal lighten-2'>
	    		                    <div class='card-content' style='text-align: center;'>
		    						    <span class='black-text text-darken-2' style='font-size: 48px;'>$totass</span><br><span class='black-text text-darken-2'>ASSIST</span>
						    		</div>
							    </div>
						    </div>
					    </div>
					
    					<div class='row'>
	    		            <div class='col m4'>
		    	                <div class='card green lighten-3'>
			                        <div class='card-content' style='text-align: center;'>
				    				    <span class='black-text text-darken-2' style='font-size: 48px;'>";
	                                        if ( $ruolo == "P") { echo "$totrigp"; } else echo "$totrigt"; echo "</span><br><span class='black-text text-darken-2'>";
						    			    if ( $ruolo == "P") { echo "RIGORI PARATI"; } else echo "RIGORI SEGNATI";
							    		echo "</span>
								    </div>
							    </div>
						    </div>
			                <div class='col m4'>
    			                <div class='card yellow lighten-3'>
	    		                    <div class='card-content' style='text-align: center;'>
		    						    <span class='black-text text-darken-2' style='font-size: 48px;'>";
			    						    if ( $ruolo == "P") { echo "$totrigs"; } else echo "$totrigsb"; echo"</span><br><span class='black-text text-darken-2'>";
				    					    if ( $ruolo == "P") { echo "RIGORI SUBITI"; } else echo "RIGORI SBAGLIATI";
					    				echo "</span>
						    		</div>
							    </div>
						    </div>
    			            <div class='col m4'>
	    		                <div class='card red lighten-3'>
		    	                    <div class='card-content' style='text-align: center;'>
			    					    <span class='black-text text-darken-2' style='font-size: 48px;'>$totaut</span><br><span class='black-text text-darken-2'>AUTOGOL</span>
				    				</div>
					    		</div>
						    </div>
					    </div>
					
    					<span class='card-title'>Medie Voto e Fantavoto</span>
	    		        <hr>
		    			<div class='row'>
			                <div class='col m6'>
			                    <div class='card'>
			                        <div class='card-content' style='text-align: center;'>
						    		    <span class='black-text text-darken-2' style='font-size: 48px;'>$media_giornale</span><br><span class='black-text text-darken-2'>MEDIA VOTO</span>
							    	</div>
							    </div>
						    </div>
			                <div class='col m6'>
			                    <div class='card'>
			                        <div class='card-content' style='text-align: center;'>
								        <span class='black-text text-darken-2' style='font-size: 48px;'>$media_punti</span><br><span class='black-text text-darken-2'>MEDIA FANTAVOTO</span>
								    </div>
							    </div>
						    </div>
					    </div>
					
    					<div class='row'>
	    		            <div class='col m12'>
		    	                <div class='card'>
			                        <div class='card-content' style='text-align: center;'>";
				    				    echo'<canvas id="myChart" width="300" height="100"></canvas>
			                            <script>
			                                var ctx = document.getElementById("myChart").getContext("2d");
			                                var myChart = new Chart(ctx, {
			                                    type: "line",
			                                    data: {
			                                        labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38"],
			                                        datasets: [{
			                                            label: "Fantavoto",
			                                            data: ['.$stringafv.'],
    		    	                                    backgroundColor: "rgba(255,99,132,1)",
	    		                                        borderColor: "rgba(255,99,132,1)",
		    	                                        borderWidth: 1,
			                                            fill: false
			                                        },
			                                        {
			                                            label: "Voto",
			                                            data: ['.$stringav.'],
			                                            backgroundColor: "rgba(100, 149, 237)",
			                                            borderColor: "rgba(100, 149, 237)",
			                                            borderWidth: 1,
			                                            fill: false
			                                        }]
			                                    },
    			                                options: {
	    		                                    scales: {
		    	                                        yAxes: [{
			                                                ticks: {
			                                                    beginAtZero:true
			                                                }
			                                            }]
			                                        }
			                                    }
			                                });
			                            </script>';
								    echo"</div>
							    </div>
						    </div>
					    </div>		
			        </div>
			    </div>
		    </div>	
	    </div>
	</div>
</div>"; 
		    } # fine if ($statistiche == "SI")
		    else echo "Statistiche non attivate!";
		
		    if ($_SESSION['valido'] != "SI") {
			    echo "</div>
			    </div>
			    <div id='destra'>";
			    include("./menu_i.php");
			    echo "</div>";
		    }
		
		    include("./footer.php");
?>
