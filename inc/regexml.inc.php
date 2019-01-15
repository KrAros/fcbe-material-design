<?php
	
/*****************************************************
 *						     RegEXml	 				  *
 *							   by						  *
 *						    Stefano V.					  *
 *					   info@svsoftwares.org			  *
 *****************************************************/


class RegEXml {
	
	/**
	 * Apre un File
	 *
	 * Apre un File in Lettura e ne Restituisce il Contenuto.
	 *
	 * @author Stefano V. <info@svsoftwares.org>
	 *
	 * @param string $file Nome del File da Aprire
	 * @return string Contenuto del File
	 */
	
	function get_file($file)
	{
		// azzera la var
		$string = "";
		
		// apre il file in lettura
		$fd = @fopen($file, "r");
		
		// se  non si può aprire da errore
		if($fd!="") {
		#die("Impossibile Aprire il File");
		while (!feof ($fd)) { // legge fino alla fine
			// prende un chunk di 4096 bytes
			$buffer = fgets($fd, 4096);
			
			// aggiunge il chunk alla stringa
			$string.=$buffer;
		}
		
		// chiude il file
		fclose ($fd);
		
		// ritorna il valore
		return $string;}
	}
	
	/**
	 * Restituisce un elemento XML
	 *
	 * Restituisce un elemento XML da un file passato come parametro.
	 *
	 * @author Stefano V. <info@svsoftwares.org>
	 *
	 * @param string $tag Nome del Tag XML da cercare
	 * @param string $xml Nome del file XML da processare
	 * @return string Stringa contenente il valore del Tag XML
	 */
	function get_xml_tag($tag, $xml)
	{
	
		// se l'elemento non esiste, restituisce una stringa vuota
		if (!preg_match("#<$tag>|<$tag [^>]+>.*</$tag>#i", "", $xml)) {
			return "";
		}
	
		
		// in buff vengono tolti i tag di apertura e chiusura
		$buff = preg_replace("#.*(<$tag>|<$tag [^>]+>)#", "", $xml);
		$buff = preg_replace("#</".$tag.">.*#", "", $buff);
		
		// restituisce la stringa
		return $buff;
	}
	
	/**
	 * Restituisce l'array di un ramo di elementi XML
	 *
	 * Restituisce l'array di un ramo di elementi XML da un file passato come parametro.
	 *
	 * @author Stefano V. <info@svsoftwares.org>
	 *
	 * @param string $tag Nome del ramo di elementi XML da cercare
	 * @param string $xml Nome del file XML da processare
	 * @return array Array contenente il ramo di elementi XML
	 */
	function get_array_tag($tag, $xml)
	{
		// splitta per </tag>
		$buff = explode("</".$tag.">", $xml);
		
		// elimina l'ultimo
		array_splice ($buff, count($buff)-1);
		
		// svuota la var
		$buffelement = "";
		
		// crea un nuovo array
		$newbuff = array();
		
		// per ogni elemento in $buff
		foreach($buff as $buffelement){
			// mette i tag in newbuff
			$newbuff[] = preg_replace("#^.*(\<$tag\>|\<$tag [^>]+\>)#i","",ltrim($buffelement));
		}
		
		// restituisce l'array
		return $newbuff;
	}
	
	
	
	/**
	 * Restituisce l'attributo di un Tag
	 *
	 * Restituisce il contenuto dell'attributo di un tag
	 *
	 * @author Stefano V. <info@svsoftwares.org>
	 *
	 * @param string $tag Nome del ramo di elementi XML da cercare
	 * @param string $attrib Nome dell'attributo da cercare
	 * @param string $xml Nome del file XML da processare
	 * @return string Stringa contenente il contenuto dell'attributo
	 */
	function get_tag_attrib($tag, $attrib, $xml)
	{
		// pattern che ottiene  < - TAG - PROP='VAL' - >
		$diviso = preg_match("#.*(<)($tag) ([^>]+)(>)#i", $xml, $reqs);
		
		// ottiene solo la 3a parte
		$attributi = trim($reqs[3]);
		
		// pattern che ottiene: TESTO - $attrib - VAL - TESTO
		$attributo = preg_match("#(.*)($attrib=)(\"[^\"]+\"|'[^']+')(.*)#i",$attributi, $req);
		
		// prende solo la 2a e 3a parte trimmando
		$attributo = trim($req[2].$req[3]);
		
		// splitta per " o '
		$final = spliti("(\"|')",$attributo);
		
		// restituisce l'array 1
		return $final[1];
	}
	
	
	/**
	 * Restituisce un Array di Attributi
	 *
	 * Restituisce un Array contenente gli Attributi del Tag e i Relativi Valori
	 *
	 * @author Stefano V. <info@svsoftwares.org>
	 *
	 * @param string $tag Nome del ramo di elementi XML da cercare
	 * @param string $xml Nome del file XML da processare
	 * @return array Array contenente gli attributi del tag con relative proprietà
	 */
	function get_array_attrib($tag, $xml)
	{
		// pattern che ottiene tra <tag e >
		$diviso = preg_match("#.*<$tag([^>|^/>]+)(/>|>)#i", $xml, $reqs);
		
		// prende solo la prima occorrenza
		$attributi = trim($reqs[1]);
		
		// pattern che ottiene un array con tutti i: PROP = "VAL"
		$finale = preg_match_all("#([^=]+)=[\"|']([^\"|^']*)[\"|']#", $attributi, $arry);
		
		// conta il numero di elementi
		$ca = count($arry[1]);
		
		// per ogni elemento trovato
		for($i=0; $i<$ca; $i++)
		{
			// aggiunge all'array finale un array in coda formato da [PROP] => VAL
			$array_finale[$arry[1][$i]] = $arry[2][$i];
		}
		
		// restituisce il valore
		return $array_finale;
	}
	
}	
?>