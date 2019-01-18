// function to reorder
$(document).ready(function(){
	// check users files and update with most recent version
	$(".version_check").on('click',function(e) {
		//$(".loading").show();
		var uid = $(this).attr("id");
		var info = "&vcheck=1";
		$.ajax({
		   beforeSend: function(){
			   $(".loading").html('<br><img src="./dati/update/loader.gif" width="16" height="16" />');
		   },
		   type: "POST",
		   url: "./dati/update/version_check.php",
		   data: info,
		   dataType: "json",
		   success: function(data){
			   // clear loading information
			   $(".loading").html("");
			   // check for version verification
			   if(data.version != 0){
				   var uInfo = "&vnum="+data.version;
			    	$.ajax({
					   beforeSend: function(){
						   $(".loading").html('<br><img src="./dati/update/loader.gif" width="16" height="16" />');
					   },
					   type: "POST",
					   url: "./dati/update/update-functions.php",
					   data: uInfo,
					   dataType: "json",
					   success: function(data){
						   // check for version verification
			  			   if(data.copy != 0){ 
						   	   if(data.unzip == 1){ 
							       // clear loading information
						   		   $(".version_check").html("");
							       // successful update
						   	   	   $(".loading").html("Aggiornamento completato con successo.");
							   }else{
								   // error during update/unzip   
								   $(".loading").html("<br>Sorry, there was an error with the update.");
							   }
						   }
					   },
					   error: function() {
						   // error
						   $(".loading").html('<br>There was an error updating your files.');
					   }
					});
			   }else{
				    // user has the latest version already installed
					$(".version_check").html("");   
					$(".loading").html("Hai installato l'ultima versione.");   
			   }
		   },
		   error: function() {
			   // error
			   $(".loading").html('<br>There was an error checking your latest version.');
		   }
		});
	});
});