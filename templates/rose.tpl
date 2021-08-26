{config_load file="test.conf" section="configurazione_script"}
{config_load file="torneo_1.conf"}

{if $smarty.session.valido eq 'SI'}
    {include file="header.tpl" title=#titolo_sito#}
    {include file="template.tpl"}
	
	{* Tabella calciatori *}
	
	{foreach $UserTabella as $user}
		<div class='col m6'>
			<div class='card'>
				<span class='card-title white-text' style='background-color: #3f51b5;height:60px;padding: 14px 0 0 10px;'>    
					{$user.squadra}
					<p class='creditirimasti right indigo darken-4'>
						{$a->crediti_rimasti({$user.nick})}	
						<small>Crediti rimasti</small>
					</p>     
				</span>
				<div class='card-content'>
					<table class='sortable responsive-table highlight' style='width:100%' cellpadding='10' cellspacing='0' id='t1'>
						<thead>
							<tr>
								<th></th>
								<th>Calciatore</th>
								<th>Squadra</th>
								<th class='center'>Costo</th>
							</tr>
						</thead>
						{foreach $GiocatoriTabella as $giocatore}
							{if $giocatore.proprietario eq $user.nick}
								<tr>
									<td class='center'><b class='ruolo {$giocatore.backruolo}'>{$giocatore.ruolo}</b></td> 
									<td>{$giocatore.nome}</td>
									<td><img class='iconasquadra' src='./immagini/m_{$giocatore.squadra}.gif'><a href='tab_squadre.php?vedi_squadra={$giocatore.squadra}'>{$giocatore.squadra}</td>
									<td class='center'>{$giocatore.costo}</td>
								</tr>
							{/if}
						{/foreach}
					</table>
				</div>
				<div class='card-action'>
					<div class='row' style='margin: 0;'>
						<span class='left'>Presidente: <b>{$user.nick}</b></span>
						<span class='right'>Data iscrizione: {$user.reg_data}</span>
					</div>
				</div>
			</div>
		</div>
	{/foreach}
		
	<script type='text/javascript' src='./inc/js/ordina_tabella.js'></script> {* Script ordinamento tabella *}
		
{/if} 

{include file="footer.tpl"}
