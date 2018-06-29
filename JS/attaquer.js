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
                var x_attaquant = $("#card"+attaquant).offset().left;
                var y_attaquant = $("#card"+attaquant).offset().top;

                var x_cible = $("#card"+cible).offset().left;
                var y_cible = $("#card"+cible).offset().top;

                //Calcul des distances des effets spéciaux

                var x = x_cible - x_attaquant;
                var y = y_cible - y_attaquant;

                if ((json.result == 'frapper') || (json.result == 'Tué') ||  (json.result == 'Esquive'))
                {
                  if (json.type_att == 'CAC') {
                    var moveY;
                    var moveX;

                    var cibleY = $("#card"+cible).data('y');
                    var cibleX = $("#card"+cible).data('x');
                    moveY = cibleY;
                    //alert(cibleY+" / "+cibleX);

                    var attaquantY = $("#card"+attaquant).data('y');
                    var attaquantX = $("#card"+attaquant).data('x');
                    //alert(attaquantY+" / "+attaquantX);

                    if (cibleX == -2)
                    {
                      moveX = -1;
                    }
                    else if (cibleX == -1 || cibleX == 1)
                    {
                      moveX = 0;
                    }
                    else if (cibleX == 2)
                    {
                      moveX = 1;
                    }

                    var depY;
                    var depX;

                    $(".card").each(function(){
                      if ($(this).data('y') == cibleY && $(this).data('x') == moveX)
                      {
                        depY = $(this).offset().top;
                        depX = $(this).offset().left;

                        deplacementX = depX - x_attaquant;
                        deplacementY = depY - y_attaquant;
                        // alert(depY+" / "+depX);
                      }
                    });

                    var deplacement = CSSAnimations.create({
                        '0%': { transform: 'translateX(0px) translateY(0px)' },
                        '100%': { transform: 'translateX('+deplacementX+'px) translateY('+deplacementY+'px)' }
                    });
                    $("#card"+attaquant).css({ 'animation-name': deplacement.name,
                                'animation-duration': '0.2s'
                    });
                    $("#card"+attaquant).on('animationend', function() {
                        CSSAnimations.remove(anim.name);
                        $("#blast"+attaquant).attr("hidden", true);
                        $("#card"+attaquant).offset({top:depY,left:depX})
                    });
                  }

                  var z = angleEtOrientation(x_attaquant, y_attaquant, x_cible, y_cible);

                  $("#blast"+attaquant).attr("hidden", false);

                  var x_attaquant = $("#card"+attaquant).offset().left;
                  var y_attaquant = $("#card"+attaquant).offset().top;

                  var anim = CSSAnimations.create({
                      '0%': { transform: 'translateX(0px) translateY(0px)' },
                      '100%': { transform: 'translateX('+x+'px) translateY('+y+'px)' }
                  });

                  $("#blast"+attaquant).css({ 'animation-name': anim.name,
                              'animation-duration': '0.5s' });

                  $("#blast"+attaquant).on('animationend', function() {
                      CSSAnimations.remove(anim.name);
                      $("#blast"+attaquant).attr("hidden", true);

                      switch (json.result) {
                        case 'frapper':
                          $("#sprite"+cible).attr("hidden", false);
                          var anim_hit = CSSAnimations.get('play_hit');

                          $("#sprite"+cible).css({ 'animation-name': anim_hit.name,
                                      'animation-duration': '0.5s' });

                          $("#sprite"+cible).on('animationend', function() {
                              CSSAnimations.remove(anim_hit.name);
                          });

                          var pv = Number(json.pv);
                          var pv_max = Number($("#progress-bar"+json.id).attr("aria-valuemax"));
                          var level = 0;
                          level = pv / pv_max;
                          level = level * 100;
                          $("#progress-bar"+json.id).width(level+'%');

                          break;
                        case 'Tué':
                          $("#sprite"+cible).attr("hidden", false);
                          var anim_hit = CSSAnimations.get('play_hit');
                          $("#sprite"+cible).css({ 'animation-name': anim_hit.name,
                                      'animation-duration': '0.5s' });
                          $("#sprite"+cible).on('animationend', function() {
                              CSSAnimations.remove(anim_hit.name);
                              $("#sprite"+cible).attr("hidden", true);

                              $("#card"+json.id).fadeOut("fast");
                          });
                          break;
                        case 'Esquive':
                          break;
                        default:
                      }
                  });
   							}
                else if (json.result == 'soigner') {
                	//$('#son2').get(0).play();
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
                  });

                  var pv = Number(json.pv);
    							var pv_max = Number($("#progress-bar"+json.id).attr("aria-valuemax"));
    							//alert(xp + " " + xp_min + " " +  xp_max);
    							var level = 0;
    							level = pv / pv_max;
    							level = level * 100;
                  $("#progress-bar"+json.id).width(level+'%');
                }
                // else if (json.result == 'endormir') {
								// 	$("#resultat").html("<p>Vous avez ensorcelé !</p>");
   							// }
                //setTimeout("location.reload()",1*1000);
            }
        });
    });

});
