{config_load file="test.conf" section="configurazione_script"}
{config_load file="torneo_1.conf"}

{if $smarty.session.valido eq 'SI'}
    {include file="header.tpl" title=#titolo_sito#}
    {include file="template.tpl"}

	{tabella_squadre()}
	
	{* Tabella calciatori *}
		
	<div class='row'>
		<div class='col m12 center'>
		
			{$vedi_giornate}
			
			<table class='highlight' width='100%' cellpadding='0' cellspacing='0' align='center'>
				
				{for $foo=1 to 38}
					<table class='center' width='100%' border='1' cellpadding='5' cellspacing='0'>
						<tr>
							<td class='testa' colspan='2'>Giornata {$numero_giornata}</td>
						</tr>
						
						{foreach $GiocatoriTabella as $giocatore}
						
						<tr>
							<td class='center'>
								<a href='giornate.php?opzione=2&amp;nome_squadra={$giocatore.squadra1}' class='user'>{$giocatore.squadra1}</a> 
								- 
								<a href='giornate.php?opzione=2&amp;nome_squadra={$giocatore.squadra2}' class='user'>{$giocatore.squadra2}</a>
							</td>
							<td align='center' width='15%'>
								{$giocatore.gol_casa} - {$giocatore.gol_fuori}
							</td>
						</tr>
						
						{/foreach}
						
					</table>
				{/for}
				
			</table>
		</div>
	</div>
		
	<script type='text/javascript' src='./inc/js/ordina_tabella.js'></script> {* Script ordinamento tabella *}
		
{/if} 

{include file="footer.tpl"}
