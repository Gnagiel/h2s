function auto_load(idU){
  $.ajax({
    url: "index/combat?idUser="+idU+"",
    cache: false,
    success: function(data){
       $("html").load(data);
    }
  });
}

$(document).ready(function(){

    $(".submitf").click(function(){
  		 var cible = $("#idCible").val();
  		 var attaquant = $("#id1").val();
  		 var idUser = $("#idUser").val();
			s = $("#formId").serialize();
        $.ajax({
            url: './ajax/attaque.php',
            type: "POST",
            data: s,
            success: function(json) {

                //setTimeout("auto_load(idUser)",1*1000);

                if (json.result == 'frapper')
                {
                  $("#progress-bar"+json.id).attr('aria-valuenow', json.pv);
									//$("#resultat").html("<p>Vous avez frappé !</p>");

									$("#"+cible).fadeTo('fast', 0.75);

									$("#"+cible).animate({
					        	height: '100px'
					        });

                  var pv = Number(json.pv);
    							var pv_max = Number($("#progress-bar"+json.id).attr("aria-valuemax"));
    							//alert(xp + " " + xp_min + " " +  xp_max);
    							var level = 0;
    							level = pv / pv_max;
    							level = level * 100;
                  $("#progress-bar"+json.id).width(level+'%');
                  // var pv = json.pv /
                  // $("#progress-bar"+json.id).style();
									// $("#"+cible)
									// 	.rotate({ startDeg:0, endDeg:25, easing:'ease-out', duration:0.2 })
									// 	.rotate({ startDeg:25, endDeg:-15, easing:'ease-out', duration:0.2 })
									// 	.rotate({ startDeg:-15, endDeg:0, easing:'ease-out', duration:0.2 });

									// $('#son').get(0).play();

									// $("#"+json.id+"Degat").html("<p>"+json[0].persoForce+"</p>");
									// $("#"+json.id+"Degat").css("color", "red");
									// $("#"+json.id+"Degat").animate({"top":"-15px"},2500);
									// $("#"+json.id+"Degat").fadeTo('slow', 0.1);


									// $("#"+attaquant).fadeTo('fast', 0.75);
									// $("#"+attaquant).animate({
					        // 	height: '100px'
					        // });

									//setTimeout("auto_load('idUser')",1*1000);
   							}
                // else if (json[0].result == 'soigner') {
                // 	$('#son2').get(0).play();
                //   $("#resultat").html("<p>Vous avez soigné !</p>");
                //
                //
								// 	$("#"+json[0].id+"Degat").fadeOut( "slow", function() {
								// 		$("#"+json[0].id+"Degat").html("<p>"+json[0].persoInte+"</p>");
								// 		$("#"+json[0].id+"Degat").css("color", "green");
								// 		$("#"+json[0].id+"Degat").animate({"top":"-15px"},2500);
								//   });
                //
								// 	$("#"+attaquant).fadeTo('fast', 0.75);
								// 	$("#"+attaquant).animate({
					      //   	height: '100px'
					      //   });
					      //   //setTimeout("auto_load('idUser')",1*1000);
                // }
                // else if (json[0].result == 'endormir') {
								// 	$("#resultat").html("<p>Vous avez ensorcelé !</p>");
                //
								// 	$("#"+cible).fadeTo('fast', 0.75);
                //
								// 	$("#"+cible).animate({
					      //   	height: '100px'
					      //   });
                //
								// 	$("#"+cible)
								// 		.rotate({ startDeg:0, endDeg:25, easing:'ease-out', duration:0.2 })
								// 		.rotate({ startDeg:25, endDeg:-15, easing:'ease-out', duration:0.2 })
								// 		.rotate({ startDeg:-15, endDeg:0, easing:'ease-out', duration:0.2 });
                //
								// 	$('#son').get(0).play();
                //
								// 	$("#"+attaquant).fadeTo('fast', 0.75);
								// 	$("#"+attaquant).animate({
					      //   	height: '100px'
					      //   });
					      //   //setTimeout("auto_load('idUser')",1*1000);
   							// }
                else if (json.result == 'Pas possible') {
                  //$("#resultat").html("<p>Pourquoi vous frappez-vous ??? ...</p>");
                  //setTimeout("auto_load('idUser')",1*1000);
                }
                else if (json.result == 'Tué') {
									//$("#resultat").html("<p>Vous avez tué !</p>");

							    //$('#son').get(0).play();
                  $("#progress-bar"+json.id).width('0%');
                  $("#card"+json.id+" img").attr('src', "./images/perso/rip.jpg");

									// $("#"+json[0].id+"Degat").html("<p>"+json[0].persoForce+"</p>");
									// $("#"+json[0].id+"Degat").css("color", "red");
									// $("#"+json[0].id+"Degat").animate({"top":"-15px"},2500);
									// $("#"+json[0].id+"Degat").fadeTo('slow', 0.1);

									// $("#"+attaquant).fadeTo('fast', 0.75);
									// $("#"+attaquant).animate({
					        // 	height: '100px'
					        // });
					        //setTimeout("auto_load('idUser')",1*1000);
                }
                // else {
                // 	//$("#resultat").html(data);
                // 	//setTimeout("auto_load('idUser')",1*1000);
                // }

            }
        });
    });

});
