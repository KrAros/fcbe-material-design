$(document).ready(function(){
	$('.modal').modal();
	$('.dropdown-trigger').dropdown();
});

$(document).ready(function(){
	/* CONFIG */
	/* set start (sY) and finish (fY) heights for the list items */
	sY = 24;
	fY = 375;
	/* end CONFIG */
	
	/* open first list item */
	animate (fY)
	
	$("#slide .top").click(function() {
		if (this.className.indexOf('clicked') == -1 ) {
			animate(sY)
			$('.clicked').removeClass('clicked');
			$(this).addClass('clicked');
			animate(fY)
		}
	});
	
	function animate(pY) {
		$('.clicked').animate({"height": pY + "px"}, 500);
	}
	
});

$(document).ready(function(){
	$('.tooltipped').tooltip();
});

$(document).ready(function() {
	$('input#input_text, textarea#textarea2').characterCounter();
});

$(document).ready(function(){
	$('select').formSelect();
});

$(document).ready(function() {
	$("#switch_portieri").change(function() {
		if($(this).is(":checked")) {
			$(".P").show(2000)
		}
		else {
			$(".P").hide("slow")
		}
		}),$("#switch_difensori").change(function() {
		if($(this).is(":checked")) {
			$(".D").show(2000)
		}
		else {
			$(".D").hide("slow")
		}
		}),$("#switch_centrocampisti").change(function() {
		if($(this).is(":checked")) {
			$(".C").show(2000)
		}
		else {
			$(".C").hide("slow")
		}
		}),$("#switch_attaccanti").change(function() {
		if($(this).is(":checked")) {
			$(".A").show(2000)
		}
		else {
			$(".A").hide("slow")
		}
	})
});

$(document).ready(function() {
	$("#search").on("keyup", function() {
		var value = $(this).val().toUpperCase();
		$("#t1 tr").each(function(index) {
			if (index !== 1) {
				
				$row = $(this);
				
				var id = $row.find("td:nth-child(2)").text();
				
				if (id.indexOf(value) !== 0) {
					$row.hide();
				}
				else {
					$row.show();
				}
			}
		});
	})
});

function selectChanged(ctrl) {
	var squadr = $("#squadr").val(); 
	var stg = $("#stg").val();  
	var numgio = $("#numgio").val(); 
	
	var val = './statistiche.php?numgio=' + numgio + '&ruolo_guarda=tutti&squadra_guarda=' + squadr + '&anno_guarda=' + stg + '';
	
	var frm = document.getElementById('form1');
	frm.action = val;
	
	document.getElementById('form1').submit();
}

$(document).ready(function(){
	$('.collapsible').collapsible();
});

$(document).ready(function(){
	$('.tooltipped').tooltip();
});