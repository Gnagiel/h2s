function auto_load(idU){
  $.ajax({
    url: "index/combat?idUser="+idU+"",
    cache: false,
    success: function(data){
       $("html").load(data);
    }
  });
}

function angleEtOrientation(x, y, xCible, yCible)
{
  var z = Math.tan(y - yCible, x - xCible)+Math.PI;
  return -z;
}
// jQuery.fn.extend({
//    findPos : function() {
//        obj = jQuery(this).get(0);
//        var curleft = obj.offsetLeft || 0;
//        var curtop = obj.offsetTop || 0;
//        while (obj = obj.offsetParent) {
//                 curleft += obj.offsetLeft
//                 curtop += obj.offsetTop
//        }
//        return {x:curleft,y:curtop};
//    }
// });

// Converts from degrees to radians.
Math.radians = function(degrees) {
  return degrees * Math.PI / 180;
};

// Converts from radians to degrees.
Math.degrees = function(radians) {
  return radians * 180 / Math.PI;
};

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

                //Calcul des distances des effets spéciaux

                var x_cible = $("#card"+cible).offset().left;
                var y_cible = $("#card"+cible).offset().top;

                var x_attaquant = $("#card"+attaquant).offset().left;
                var y_attaquant = $("#card"+attaquant).offset().top;

                var x = x_cible - x_attaquant;
                var y = y_cible - y_attaquant;
                var z = angleEtOrientation(x_attaquant, y_attaquant, x_cible, y_cible);
                z = Math.degrees(z);
                //alert(z);

                //Calcul des angles de pivot des effets spéciaux

                // var AB = x_cible - x_attaquant;
                // var AC = y_cible - y_attaquant;
                //
                // var BC = Math.hypot(AB, AC);
                //
                // var angleRad = AB / AC;
                // angleRad = Math.tan(angleRad);
                // var angleDeg = Math.degrees(angleRad);
                //
                // if (isNaN(angleDeg))
                // {
                //   angleDeg = 0;
                // }
                //alert('AB : '+AB+' px. AC : '+AC+' px. BC : '+BC+' px. Angle : '+angleRad+' rad et '+angleDeg+' rad');



                if (json.result == 'frapper')
                {
                  $("#blast"+attaquant).attr("hidden", false);


                  var anim = CSSAnimations.create({
                      '0%': { transform: 'translateX(0px) translateY(0px)' },
                      '100%': { transform: 'translateX('+x+'px) translateY('+y+'px)' }
                  });

                  $("#blast"+attaquant).css({ 'animation-name': anim.name,
                              'animation-duration': '0.5s' });

                  $("#blast"+attaquant).on('animationend', function() {
                      CSSAnimations.remove(anim.name);
                      $("#blast"+attaquant).attr("hidden", true);
                      $("#sprite"+cible).attr("hidden", false);

                      var anim_hit = CSSAnimations.get('play_hit');
                      var anim_hit2 = CSSAnimations.get('play_hit2');
                      $("#sprite"+cible).css({ 'animation-name': anim_hit.name,
                                  'animation-duration': '0.5s' });

                      $("#sprite"+cible).on('animationend', function() {
                          CSSAnimations.remove(anim_hit.name);
                          // $("#sprite"+cible).css({ 'animation-name': anim_hit2.name,
                          //             'animation-duration': '0.5s' });
                          //$("#sprite"+cible).attr("hidden", true);
                      });
                  });

                  $("#progress-bar"+json.id).attr('aria-valuenow', json.pv);
									//$("#resultat").html("<p>Vous avez frappé !</p>");
                  var pv = Number(json.pv);
    							var pv_max = Number($("#progress-bar"+json.id).attr("aria-valuemax"));
    							//alert(xp + " " + xp_min + " " +  xp_max);
    							var level = 0;
    							level = pv / pv_max;
    							level = level * 100;
                  $("#progress-bar"+json.id).width(level+'%');
   							}
                // else if (json.result == 'soigner') {
                // 	$('#son2').get(0).play();
                //   $("#resultat").html("<p>Vous avez soigné !</p>");
                // }
                // else if (json.result == 'endormir') {
								// 	$("#resultat").html("<p>Vous avez ensorcelé !</p>");
   							// }
                else if (json.result == 'Pas possible') {
                  //$("#resultat").html("<p>Pourquoi vous frappez-vous ??? ...</p>");
                }
                else if (json.result == 'Esquive') {
                  //$("#resultat").html("<p>Attaque esquivé</p>");
                }
                else if (json.result == 'Tué') {
                  $("#blast"+attaquant).attr("hidden", false);

                  var anim = CSSAnimations.create({
                      '0%': { transform: 'translateX(0px) translateY(0px)' },
                      '100%': { transform: 'translateX('+x+'px) translateY('+y+'px)' }
                  });

                  $("#blast"+attaquant).css({ 'animation-name': anim.name,
                              'animation-duration': '0.5s' });

                  $("#blast"+attaquant).on('animationend', function() {
                      CSSAnimations.remove(anim.name);
                      $("#blast"+attaquant).attr("hidden", true);

                      $("#sprite"+cible).attr("hidden", false);
                      var anim_hit = CSSAnimations.get('play_hit');
                      $("#sprite"+cible).css({ 'animation-name': anim_hit.name,
                                  'animation-duration': '0.5s' });
                      $("#sprite"+cible).on('animationend', function() {
                          CSSAnimations.remove(anim_hit.name);
                          $("#sprite"+cible).attr("hidden", true);

                          $("#progress-bar"+json.id).width('0%');
                          $("#card"+json.id+" img").attr('src', "./images/perso/rip.jpg");
                      });
                  });

									//$("#resultat").html("<p>Vous avez tué !</p>");

							    //$('#son').get(0).play();

                }
                //setTimeout("location.reload()",1*1000);
            }
        });
    });

});
