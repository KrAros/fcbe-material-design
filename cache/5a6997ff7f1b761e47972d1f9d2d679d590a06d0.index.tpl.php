<?php
/* Smarty version 3.1.33, created on 2019-10-08 18:04:08
  from 'C:\xampp\htdocs\fcbe-material-design\demo\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d9cb378d5be46_27519334',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '01613310eed58e98864b2e34e1749889d4f8f2c9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\fcbe-material-design\\demo\\templates\\index.tpl',
      1 => 1570545742,
      2 => 'file',
    ),
    '39fa1345dcaf5af5ba82ca7c9f3b596a17ccc9d0' => 
    array (
      0 => 'C:\\xampp\\htdocs\\fcbe-material-design\\demo\\templates\\header.tpl',
      1 => 1570549711,
      2 => 'file',
    ),
    '5e978f2b1cb736a589d928bf6f093a1e1537a26b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\fcbe-material-design\\demo\\templates\\footer.tpl',
      1 => 1570545742,
      2 => 'file',
    ),
  ),
  'cache_lifetime' => 120,
),true)) {
function content_5d9cb378d5be46_27519334 (Smarty_Internal_Template $_smarty_tpl) {
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" dir="ltr">
	<head>
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
		rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="../css/materialize.min.css"
		media="screen,projection" />
		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		
		<link type="text/css" rel="stylesheet" href="../immagini/tab.css"
		media="screen,projection" />
		<link type="text/css" rel="stylesheet" href="../css/extra.css"
		media="screen,projection" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Language" content="Italian" />
		<meta name="Author"
		content="Antonello Onida - http://fantacalciobazar.sssr.it" />
		<meta name="Description"
		content="FantacalcioBazar | Il migliore gestore di Fantacalcio on line" />
		<meta name="Keywords"
		content="fantacalciobazar, fantacalcio, semplice, completo, online" />
		<meta name="Robots" content="INDEX, FOLLOW" />
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/highcharts-more.js"></script>
		<script src="../inc/js/jquery-2.0.3.min.js"></script>
		<script src="../dati/update/update.js" type="text/javascript"></script>
		
		<title>foo</title>
		
	</head>
	<body>
		<div id="navbar" class="navbar-fixed">
			<nav class="indigo">
				<div class="nav-wrapper">
					<a href="../index.php" class="brand-logo" style="padding-left: 15px;">FCBE Revolution</a>
					
										
					<ul class="right hide-on-med-and-down">
						<li><a href="mercato.php"><i class="material-icons left">dashboard</i>Dashboard</a></li>
						<li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><i class="material-icons left">security</i>Gestione<i class="material-icons right">arrow_drop_down</i></a></li>
						
						<ul id="dropdown1" class="dropdown-content">
														<li><a href='./squadra.php'>Schiera formazione</a></li>
							<li><a href='./suggteam.php'>Team consigliato</a></li>
							<li><a href='./statistiche_rosa.php?vedi_squadra'>Statistiche rosa</a></li>
																												<li class="divider"></li>
							<li><a href='./calendario.php'>Calendario</a></li>
																					<li><a href='./rose.php' >Riepilogo rose</a></li>
							<li><a href='./statistiche.php?numgio=tutte&squadra_guarda=ATALANTA&anno_guarda=$cartella_remota'>Statistiche</a></li>
																											</ul>
						
						<li><a class="dropdown-trigger" href="#!" data-target="dropdown2"><i class="material-icons left">compare_arrows</i>Mercato<i class="material-icons right">arrow_drop_down</i></a></li>
						
						<ul id="dropdown2" class="dropdown-content">
							<li><a href="registro_mercato.php">Riepilogo acquisti</a></li>
							<li><a href="tab_calciatori.php?ruolo_guarda=tutti">Listone calciatori</a></li>
						</ul>
						
						<li><a class="dropdown-trigger" href="#!" data-target="dropdown3"><i class="material-icons left">star</i>Link Utili<i class="material-icons right">arrow_drop_down</i></a></li>
						
						<ul id="dropdown3" class="dropdown-content">
							<li><a href="televideo.php">Televideo</a></li>
							<li><a href="temporeale.php">Risultati temporeale</a></li>
							<li><a href="probform.php">Probabili formazioni</a></li>
							<li><a href="indisponibili.php">Indisponibili</a></li>
						</ul>
						
						<li><a class="dropdown-trigger" href="#!" data-target="dropdown4"><i class="material-icons left">account_circle</i>Test<i class="material-icons right">arrow_drop_down</i></a></li>
						
						
						<ul id="dropdown4" class="dropdown-content">
							<li><a href="a_modUtente.php">Modifica profilo</a></li>
							<li><a href="messaggi.php">Messaggi</a></li>
						</ul>
						
						<li><a href="logout.php"><i class="material-icons left">exit_to_app</i>Logout</a></li>
					</ul>
									</div>
			</nav>
		</div>																																																																						
<PRE>

    <b>                Title: FCBE Revolution
        </b>
    The current date and time is 2019-10-08 18:04:08

    The value of global assigned variable $SCRIPT_NAME is /fcbe-material-design/demo/index.php

    Example of accessing server environment variable SERVER_NAME: localhost

    The value of {$Name} is <b><?php echo $_smarty_tpl->tpl_vars['Name']->value;?>
</b>

variable modifier example of {$Name|upper}

<b><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['Name']->value, 'UTF-8');?>
</b>


An example of a section loop:

                        1 * John Doe
                                    2 * Mary Smith
                                    3 . James Johnson
                                    4 . Henry Case
                
    An example of section looped key values:

            phone: 1
        <br>

            fax: 2
        <br>

            cell: 3
        <br>
            phone: 555-4444
        <br>

            fax: 555-3333
        <br>

            cell: 760-1234
        <br>
        <p>

        testing strip tags
        <table border=0><tr><td><A HREF="/fcbe-material-design/demo/index.php"><font color="red">This is a test </font></A></td></tr></table>

</PRE>

This is an example of the html_select_date function:

<form>
    <select name="Date_Month">
<option value="01">gennaio</option>
<option value="02">febbraio</option>
<option value="03">marzo</option>
<option value="04">aprile</option>
<option value="05">maggio</option>
<option value="06">giugno</option>
<option value="07">luglio</option>
<option value="08">agosto</option>
<option value="09">settembre</option>
<option value="10" selected="selected">ottobre</option>
<option value="11">novembre</option>
<option value="12">dicembre</option>
</select>
<select name="Date_Day">
<option value="1">01</option>
<option value="2">02</option>
<option value="3">03</option>
<option value="4">04</option>
<option value="5">05</option>
<option value="6">06</option>
<option value="7">07</option>
<option value="8" selected="selected">08</option>
<option value="9">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>
<select name="Date_Year">
<option value="1998">1998</option>
<option value="1999">1999</option>
<option value="2000">2000</option>
<option value="2001">2001</option>
<option value="2002">2002</option>
<option value="2003">2003</option>
<option value="2004">2004</option>
<option value="2005">2005</option>
<option value="2006">2006</option>
<option value="2007">2007</option>
<option value="2008">2008</option>
<option value="2009">2009</option>
<option value="2010">2010</option>
</select>
</form>

This is an example of the html_select_time function:

<form>
    <select name="Time_Hour">
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06" selected="selected">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
</select>
<select name="Time_Minute">
<option value="00">00</option>
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04" selected="selected">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
<option value="32">32</option>
<option value="33">33</option>
<option value="34">34</option>
<option value="35">35</option>
<option value="36">36</option>
<option value="37">37</option>
<option value="38">38</option>
<option value="39">39</option>
<option value="40">40</option>
<option value="41">41</option>
<option value="42">42</option>
<option value="43">43</option>
<option value="44">44</option>
<option value="45">45</option>
<option value="46">46</option>
<option value="47">47</option>
<option value="48">48</option>
<option value="49">49</option>
<option value="50">50</option>
<option value="51">51</option>
<option value="52">52</option>
<option value="53">53</option>
<option value="54">54</option>
<option value="55">55</option>
<option value="56">56</option>
<option value="57">57</option>
<option value="58">58</option>
<option value="59">59</option>
</select>
<select name="Time_Second">
<option value="00">00</option>
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08" selected="selected">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
<option value="32">32</option>
<option value="33">33</option>
<option value="34">34</option>
<option value="35">35</option>
<option value="36">36</option>
<option value="37">37</option>
<option value="38">38</option>
<option value="39">39</option>
<option value="40">40</option>
<option value="41">41</option>
<option value="42">42</option>
<option value="43">43</option>
<option value="44">44</option>
<option value="45">45</option>
<option value="46">46</option>
<option value="47">47</option>
<option value="48">48</option>
<option value="49">49</option>
<option value="50">50</option>
<option value="51">51</option>
<option value="52">52</option>
<option value="53">53</option>
<option value="54">54</option>
<option value="55">55</option>
<option value="56">56</option>
<option value="57">57</option>
<option value="58">58</option>
<option value="59">59</option>
</select>
<select name="Time_Meridian">
<option value="am">AM</option>
<option value="pm" selected="selected">PM</option>
</select>
</form>

This is an example of the html_options function:

<form>
    <select name=states>
        <option value="NY">New York</option>
<option value="NE" selected="selected">Nebraska</option>
<option value="KS">Kansas</option>
<option value="IA">Iowa</option>
<option value="OK">Oklahoma</option>
<option value="TX">Texas</option>

    </select>
</form>

</BODY>
</HTML>
<?php }
}
