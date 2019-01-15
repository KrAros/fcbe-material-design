<?php
	# Rimuovere i crediti &egrave; considerata dalla comunità open-source un delitto contro la comunità stessa.
	$start_clock = explode(" " ,$clock[0]);
	$start_time = $start_clock[1] + $start_clock[2];
	$total_time=0;
	$clock[] = "Fine " . microtime();
	foreach($clock as $single_clock) {
		$single_clock_arr = explode(" " ,$single_clock);
		$single_time=$single_clock_arr[1] + $single_clock_arr[2] - $start_time;
		$start_time = $start_time + $single_time;
		$total_time = $total_time + $single_time;
		$total_time = round ($total_time, 3);
	}
?>

<footer class="page-footer indigo" style="margin-top:-15px">
	<div class="container">
		<div class="row">
			<div class="col l6 s12">
                <h5 class="white-text">Fantacalcio Smash</h5>
                <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
			</div>
			<div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
					<li><a class="grey-text text-lighten-3" href="licenza.php">Licenza GNU/GPL</a></li>
					<li><a class="grey-text text-lighten-3" href="#!">fantacalciosmash.netsons.org</a></li>
					<li><a class="grey-text text-lighten-3" href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a></li>
					<li><a class="grey-text text-lighten-3" href="http://validator.w3.org/check?uri=referer">XHTML</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="footer-copyright">
		<div class="container">
            <p class="grey-text text-lighten-4 left">&copy; 2019 Simone Gentile <?php if ($vvm) echo "- Versione: $vvm"; ?></p>
            <p class="grey-text text-lighten-4 right">Pagina generata in <?php echo $total_time ?> secondi.</p>
		</div>
	</div>
</footer>


<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="js/materialize.min.js"></script>

</body>
</html>