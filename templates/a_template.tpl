{* Layout principale *}
		
<div class="container" style="width: 85%;margin-top: -10px;">
	<div class="card-panel">
		<div class="row">
		
		{* Colonna di sinistra, la chiusura è inclusa nel file stesso *}
		
		{include file="a_widget.tpl"}
		
		{* Colonna centrale *}
		
		<div class='col m9'>
		
			{* Breadcrumbs *}
		
			<div class='row'>
				<div class='col m12'>
					<ol class='breadcrumbs indigo'>
						<li class='breadcrumbs-item'><a class='white-text' href='./mercato.php'>Dashboard</a></li>
						<li class='breadcrumbs-item grey-text text-lighten-1'>Listone calciatori</li>
					</ol>
				</div>
			</div>
		
			{* Prima Card inserita nella colonna centrale *}	
		
			<div class='row'>
				<div class='col m12'>
					<div class='card'>
						<div class='card-content'>
							<span class='card-title'>{$TitoloPagina}<span style='font-size: 13px;'> - {$Sottotitolo}</span></span>
							<hr>
								<div class='row'>
									<div class='col m12'>