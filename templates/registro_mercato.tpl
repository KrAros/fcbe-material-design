{config_load file="test.conf" section="configurazione_script"}
{config_load file="torneo_1.conf"}

{if $smarty.session.valido eq 'SI'}
    {include file="header.tpl" title=#titolo_sito#}
    {include file="template.tpl"}
		
	{* Form utenti iscriti al torneo *}

	<div class='row'>		
		<form action='registro_mercato.php' method='post'>
			<div class='input-field col m4 right'>
				<select name='manager' onchange='this.form.submit()' size='{$managers|@count}'>
					<option value='Tutti' {$managerseltutti}>Tutti</option>"; 
					{html_options values=$managers output=$managers selected=$managerselec}
				</select>
				<label>Filtra per utente</label>
			</div>
		</form>
	</div>
	
	{* Lista operazioni *}
	
	<div class='row'>
		<div class='col m12'>
			{$messmerc}
		</div>
	</div>
{/if} 

{include file="footer.tpl"}
