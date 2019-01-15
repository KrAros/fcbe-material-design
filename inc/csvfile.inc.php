<?php //csvfile.inc.php (table-xs v1.91) - (C) by Jack (tR) (http://www.jtr.de/scripting/php)

class csvfile
/*
	The Data source is a CSV text file (comma separated values)

	All values are seperated by Doublequotes (") and commata (,)
	e.g: ("...","...","...")

	The first line contains the attributes (headings of the table)

*/
{

	// public class variables which can be modified
	var $name          = "";
	var $handle        = "";
	var $captions      = array();
	var $list_next_pos = 0;
	var $file_next_pos = 0;
	var $eol           = true;

/*

//--------------------------------------------------------------------------
//				I N T E R F A C E
//--------------------------------------------------------------------------

	// returns the captions of the table rows
	array get_captions( );

	// opens the data source
	boolean open( string mode );

	// closes the data source
	boolean close();

	// initializes the data source
	boolean init();

	// returns the number of table entries
	int entries();

	// returns an entry from the table
	get_entry( int pos, reference array rows );

	// returns the next entry from the table
	get_next_entry( reference array rows );

	// returns several successive table entries
	get_entrylist( int start, int stop, reference array entrylist );

	// appends an entry to the table
	append( array data );

	// looks for the first appearance of a date in the table
	find_entry( string data );

	// looks for the next appearance of a date in the table
	find_next_entry( string data );

	// changes an entry in the table
	change( int pos, array data );

	// removes an entry from the table
	delete( int pos )
	
	// inserts a (line-)entry to the table
	function insert ( int pos, array data )

	//returns true if reachs end of list
	eol()

*/


//--------------------------------------------------------------------------
//			Internal Help Functions
//--------------------------------------------------------------------------

	function clean_string( $str )
	// Task:    Removes all superflous seperators and characters from
	//          the string
	// Input:   $str   : a row, red from CSV-file, still containing artefacts 
	//                   of comma seperation 
	//
	// Output:  String without " (Double Quotes) at the begin and end
	//          (additionally all slash-coded chars will be decoded)
	{
		$str = trim( $str );
		$newlen = $strlen = strlen( $str );

		// Ignore quotes if string contains with
		if ( substr($str,0,1) == '"')
		{
			$start = 1;
			$newlen--;
		}
		else $start = 0;

		// ignore Quotes if string ends with
		if (substr( $str, $strlen-1, 1 ) == '"') { $newlen--; }

		// cut the "real" data from string !!!
		$str = substr( $str, $start, $newlen );

		$str = stripslashes( $str );	// decode slash-coded chars

		return $str;
	}


	function get_captions()
	// Task:   returns the captions of the table rows
	// Input:  none
	// Output: returns the table captions in $captions
	{
		// reads captions from the first line
		$file_get =  $this->handle;
		$line = fgets( $file_get , 61440 );
		$tokens = explode( '","' , $line );
		$keys = array_keys( $tokens );

		foreach ($keys as $key)
		{
			$this->captions[$key] = $this->clean_string( $tokens[$key] );
		}
	}


//--------------------------------------------------------------------------
//			I M P L E M E N T A T I O N
//--------------------------------------------------------------------------

	function open( $mode )
	// opens the data source
	{
		if ( ! $this->handle = fopen( $this->name, $mode ) )
		{
			return false;
		}
		else
		{
			// lock file if opened for write mode
			if ( preg_match( "/a|w|\+/", $mode ) )
			{ flock( $this->handle, LOCK_EX); }
			
			$this->eol = feof( $this->handle );
			return true;
		}
	}


	function close()
	// closes the data source
	{
		flock( $this->handle, LOCK_UN );
		return fclose( $this->handle );
	}

	function init()
	// initializes the data source
	{
		if ( $this->open( "a+" ) && $this->close() )
		{
			return true;
		}
		return false;

		$this->list_next_pos = 0;
		$this->file_next_pos = 0;
	}

	function entries()
	// Task:   returns the number of table entries
	//
	// Input:  none
	//
	// Output: number of entries
	{
		$num_entries = 0;
		$this->open( "r" );

		// read captions from first line
		$this->get_captions();

		// ... and count all following lines
		while ( $line = fgets( $this->handle, 61440 ) )
		{
			$num_entries++;
		}
		$this->close();
		return $num_entries;
	}


	function get_entry( $pos, &$rows )
	// Task:   returns an entry from the table
	//
	// Input:  $pos     = number of the line from where to fetch the data
	//
	// Output: $rows    = array containing the entries
	{
		$this->open( "r" );

		// read table headings from the first line
		$this->get_captions();

		// skip all entries before start position
		$i=0;
		while ( ($i < $pos) && ($line = fgets( $this->handle, 61440 )))
		{
	  		$i++;
		}
		$line = fgets( $this->handle, 61440 );

		// keep current position in memory for get_next_entry
		$this->file_next_pos = ftell( $this->handle );
		$this->list_next_pos = $pos + 1;

		if ( feof( $this->handle ) ) { $this->eol = true; }

		$this->close();

		$tokens = explode( '","' , $line );

		$keys = array_keys( $tokens );
		reset( $this->captions );

		foreach ($keys as $key)
		{
			$cap = current( $this->captions );
			$rows[$cap] = $this->clean_string( $tokens[$key] );
			next( $this->captions );
		}
	}

	function get_next_entry( &$rows )
	// Task:   returns the next entry from the table
	//
	// Output: $rows	= array containing the entries
	{
		$this->open( "r" );

		//set to entry following last get_entry
		fseek( $this->handle, $this->file_next_pos );

		if ( $line = fgets( $this->handle, 61440 ) )
		{ $this->list_next_pos++; }

		// keep current position in memory for get_next_entry
		$this->file_next_pos = ftell( $this->handle );

		if ( feof( $this->handle ) ) { $this->eol = true; }
		$this->close();

		$tokens = explode( '","' , $line );

		$keys = array_keys( $tokens );
		reset( $this->captions );

		foreach ($keys as $key)
		{
			$cap = current( $this->captions );
			$rows[$cap] = $this->clean_string( $tokens[$key] );
			next( $this->captions );
		}
	}


	function get_entrylist( $start, $stop, &$entrylist )
	// Task:   returns several successive table entries
	//
	// Input:  $start     = first entry to fetch
	//         $end       = last entry to fetch
	//
	// Output: $entrylist = two dimensional array containing the red lines/entries
	{
		$this->open( "r" );

		// Read table headings from the first line
		$this->get_captions();

		// Read all entries to the start position
		$i=0;
		while ( ($i < $start) && ($line = fgets( $this->handle, 61440 )))
		{
	  		$i++;
		}

		while ( ($i <= $stop) && ($line = fgets( $this->handle, 61440 )) )
		{
			$tokens = explode( '","' , $line );

			$keys = array_keys( $tokens );
			reset( $this->captions );

			foreach ($keys as $key)
			{
				$cap = current( $this->captions );
				$entrylist[$i][$cap] = $this->clean_string( $tokens[$key] );
				next( $this->captions );
			}

			$i++;
		}
		if ( feof( $this->handle ) ) { $this->eol = true; }
		$this->close();
	}


	function append( $data )
	// Task:  Appends an entry to the table
	//
	// Input: $data		= array with the data to save
	//
	{
		clearstatcache(); //...otherwise filesize stays constant!!!

		if ( filesize( $this->name ) == 0 )
		{
			$line = '';
			$this->open( "a+" );

			$keys = array_keys( $data );
			foreach ($keys as $key)
			{
				if (!empty( $line ))
				{
					$line .= ',';
				}
				$line .= '"' . $key. '"';
			}

			fputs( $this->handle, $line."\n" );
			$this->close();
		}

		$this->open( "r" );
		$this->get_captions();
		$this->close();

		$line = '';
		$this->open( "a+" );

		$values = array_values( $this->captions );

		foreach ($values as $val)
		{
			if (!empty( $line ))
			{
				$line .= ',';
			}
			$line .= '"' . $data[$val]. '"';
		}

		fputs( $this->handle, $line."\n" );
		$this->close();
	}


	function find_entry( $data )
	// Task:   Searches for the first appearance of a date in the table
	//
	// Input:  $data = array with columns to find
	//
	{
		$entry = 0;
		$this->open( "r" );
		$this->get_captions();

		// for each row in table
		while ( $line = fgets( $this->handle, 61440 ) )
		{
			unset( $tokens );
			unset( $row ); $row = array();
			
			// read line and transfer csv-values into array $row
			
			$tokens = explode( '","' , $line );

			$keys = array_keys( $tokens );
			reset( $this->captions );

			foreach ($keys as $key)
			{
				$cap = current( $this->captions );
				$row[$cap] = $this->clean_string( $tokens[$key] );

				next( $this->captions );
			}

			$equal = true;
			
			$keys = array_keys( $data );
			foreach ($keys as $key)
			{
				if ( $data[$key] != $row[$key] )
				{
					$equal = false;
					break;
				}	
			}

			if ( $equal )
			{
				break;
			}

			$entry++;
		}

		// keep current position in memory for get_next_entry
		$this->file_next_pos = ftell( $this->handle );

		if ( feof( $this->handle ) ) { $this->eol = true; }

		$this->close();
		$this->list_next_pos = $entry + 1;
		return $entry;
	}


	function find_next_entry( $data )
	// Task:   Searches for the next appearance of a date in the table
	//
	// Input:  $data 	= array with colums to find
	//
	{
		$ok = false;
		$entry = $this->list_next_pos;
		$this->open( "r" );

		//set to entry following last get_entry
		fseek( $this->handle, $this->file_next_pos );

		// for each row in table
		while ( $line = fgets( $this->handle, 61440 ) )
		{
			unset( $tokens );
			unset( $row ); $row = array();
			
			// read line and transfer csv-values into array $row
			
			$tokens = explode( '","' , $line );

			$keys = array_keys( $tokens );
			reset( $this->captions );

			foreach ($keys as $key)
			{
				$cap = current( $this->captions );
				$row[$cap] = $this->clean_string( $tokens[$key] );

				next( $this->captions );
			}

			$equal = true;
			
			$keys = array_keys( $data );
			foreach ($keys as $key)
			{
				if ( $data[$key] != $row[$key] )
				{
					$equal = false;
					break;
				}
			}

			if ( $equal )
			{
				break;
			}

			$entry++;
		}

		// keep current position in memory for get_next_entry
		$this->file_next_pos = ftell( $this->handle );
		$this->list_next_pos = $entry++;

		if ( feof( $this->handle ) ) { $this->eol = true; }

		$this->close();
		return $entry;
	}


	function change( $pos, $data )
	// Task:   Changes a line in the table
	//
	// Input:  $pos   = Position of the element
	//		   $data  = array containing the data to save
	//
	{
		$num_of_entries = $this->entries();

		if ( filesize( $this->name ) == 0 )
		{
			$this->append( $data );
		}

		$this->open( "r" );
		$this->get_captions();
		$this->close();

		// Komplette Datei zeilenweise einlesen
		$entrylist = file( $this->name );

		$newline = '';

		$values = array_values( $this->captions );
		foreach ($values as $val)
		{
			if (!empty( $newline ))
			{
				$newline .= ',';
			}
			$newline .= '"' . $data[$val]. '"';
		}
		$newline .= "\n";
		$entrylist[$pos+1]=$newline;

		$this->open( "w" );
		fwrite( $this->handle, ereg_replace( "\r", "", implode( "", $entrylist ) ) );

		$this->close();
	}


	function delete( $pos )
	// Task:  Removes a line from the table
	//
	// Input: $pos	= Position of the Element
	//
	{
		$num_of_entries = $this->entries();

		if ( filesize( $this->name ) != 0 )
		{

			// Komplette Datei zeilenweise einlesen
			$entrylist = file( $this->name );

			unset( $entrylist[$pos+1] );

			$this->open( "w" );
			fwrite( $this->handle, ereg_replace( "\r", "", implode( "", $entrylist ) ) );

			$this->close();
		}
	}


	function insert ( $pos, $data )
	// Task:  Removes a line from the table
	//
	// Input: $pos	= Position of the Element
	//
	{
		$num_of_entries = $this->entries();

		clearstatcache();
		if ( filesize( $this->name ) == 0 )
		{
			$this->append( $data );
		}
		else
		{
			$newline = '';

			$values = array_values( $this->captions );
			foreach ($values as $val)
			{
				if (!empty( $newline ))
				{
					$newline .= ',';
				}
				$newline .= '"' . $data[$val]. '"';
			}
			$newline .= "\n";

			$this->open( "r" );
			$this->get_captions();
			$this->close();
			
			$this->open( "r" );
			$captionline = fgets( $this->handle, 61440 );
			$entrylist = array();
			$entrylist[0] = $captionline;
			$pos++;
			
			// Datei bis zur Einfügeposition zeilenweise einlesen
			$i = 1;
			while ($i < $pos )
			{
				$entrylist[$i] = fgets( $this->handle, 61440 );
				$i++;
			}

			$entrylist[$i]=$newline;
			$i++;

			while ( $entrylist[$i] = fgets( $this->handle, 61440 ) )
			{
				$i++;
			}
			$this->close();

			$this->open( "w" );
			fwrite( $this->handle, ereg_replace( "\r", "", implode( "", $entrylist ) ) );
			$this->close();
		}
	}


	function eol()
	// Task:  Removes a line from the table
	// Input: $pos	= Position of the Element
	{
		return $this->eol;
	}
}

?>