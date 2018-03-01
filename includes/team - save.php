  	<form method="post" class="add_team" action="?action=team">
  	<div class="pref">
  		<h3>Première ligne</h3>
	    <div id="preferance1" >
				<p><span style="font-style:italic;">+</span></p>
				<div id="choix1">
					<input type="hidden" class="input_change" name="choix[]" value="<?=$manager->get_id_team(1, $user->id_user());?>" />
				</div>
	    </div>
	    <div id="preferance2" >
				<p><span style="font-style:italic;">+</span></p>
				<div id="choix2">
					<input type="hidden" class="input_change" name="choix[]" value="<?=$manager->get_id_team(2, $user->id_user());?>" />
				</div>
	    </div>
	    <div id="preferance3" >
				<p><span style="font-style:italic;">+</span></p>
				<div id="choix3">
					<input type="hidden" class="input_change" name="choix[]" value="<?=$manager->get_id_team(3, $user->id_user());?>" />
				</div>
	    </div>  
	  </div>  
  	<div class="pref">
  		<h3>Seconde ligne</h3>
	    <div id="preferance4" >
				<p><span style="font-style:italic;">+</span></p>
				<div id="choix4">
					<input type="hidden" class="input_change" name="choix[]" value="<?=$manager->get_id_team(4, $user->id_user());?>" />
				</div>
	    </div>
	    <div id="preferance5" >
				<p><span style="font-style:italic;">+</span></p>
				<div id="choix5">
					<input type="hidden" class="input_change" name="choix[]" value="<?=$manager->get_id_team(5, $user->id_user());?>" />
				</div>
	    </div>
	    <div id="preferance6" >
				<p><span style="font-style:italic;">+</span></p>
				<div id="choix6">
					<input type="hidden" class="input_change" name="choix[]" value="<?=$manager->get_id_team(6, $user->id_user());?>" />
				</div>
	    </div>  
	  </div> 	        
	    <p>Reset</p>
	    <button id="res"><span class="ui-icon ui-icon-trash" ></span></button><br />
	    <input type="submit" value="Choisir"/>
    
    </form>  	
  	<div id="persos">
  	<?php
		foreach ($perso as $persos)
		{		
  	?>	
	 		<div class="drag" id="<?=$persos->nom();?>" data-id="<?=$persos->id_perso();?>">
			  <p><?=$persos->nom();?></p>
			</div> 	
  	<?php	
  	}  	
  	?>
  	</div>

    <script>
    	$("#res").click(function(){
    		$('#choix1 p').html('');
    		$('#choix2 p').html('');
    		$('#choix3 p').html('');
    		$('#choix4 p').html('');
    		$('#choix5 p').html('');
    		$('#choix6 p').html('');   		
    		$('.input_change').val('');
    		$('.drag').css("display", "block");
    		$(".drag").draggable({revert:true});

			  		
				$('#preferance1').droppable({
				    accept : '.drag', // je n'accepte que le bloc ayant "drag" pour classerevert:true,
				});	 
   		  $('#preferance1').css("background-color", "white");    
   		  $('#preferance1').css("color", "black");  
   		  				
				$('#preferance2').droppable({
				    accept : '.drag', // je n'accepte que le bloc ayant "drag" pour classerevert:true,
				});	
   		  $('#preferance2').css("background-color", "white");    
   		  $('#preferance2').css("color", "black"); 	
   		  			
				$('#preferance3').droppable({
				    accept : '.drag', // je n'accepte que le bloc ayant "drag" pour classerevert:true,
				});		
   		  $('#preferance3').css("background-color", "white");    
   		  $('#preferance3').css("color", "black"); 											   		

				$('#preferance4').droppable({
				    accept : '.drag', // je n'accepte que le bloc ayant "drag" pour classerevert:true,
				});		
   		  $('#preferance4').css("background-color", "white");    
   		  $('#preferance4').css("color", "black"); 	

				$('#preferance5').droppable({
				    accept : '.drag', // je n'accepte que le bloc ayant "drag" pour classerevert:true,
				});		
   		  $('#preferance5').css("background-color", "white");    
   		  $('#preferance5').css("color", "black"); 	

				$('#preferance6').droppable({
				    accept : '.drag', // je n'accepte que le bloc ayant "drag" pour classerevert:true,
				});		
   		  $('#preferance6').css("background-color", "white");    
   		  $('#preferance6').css("color", "black"); 	   		  
			});

    </script>
		<script>
				
			$('.drag').draggable({revert:true});	
			
			$('#preferance1').droppable({
			    accept : '.drag', // je n'accepte que le bloc ayant "drag" pour classerevert:true,		    
			    drop : function(event, ui){	
			    		var current = ui.draggable; // on récupère l'élément étant déplacé
			    		var id = current.attr('id');
			    		var identifiant = current.attr('data-id');
			        $('#choix1').append(id);
			        $('#choix1 .input_change').val(identifiant).trigger("change");
         		  
         		  $('#preferance1').css("background-color", "cornflowerblue");    
         		  $('#preferance1').css("color", "white");  			        
			       
			        current.fadeOut(function(){ // nouvelles fonction de callback, qui s'exécutera une fois l'effet terminé

			        });			       
			        			     	    			    	
			        $('#preferance1').droppable({			        	
			        	accept : ''
			        });
			    }
			});		
			
			$('#preferance2').droppable({
			    accept : '.drag', // je n'accepte que le bloc ayant "drag" pour classerevert:true,
			    helper:"clone",
			    activeClass: 'hover',
			    hoverClass: 'active',			    
			    drop : function(event, ui){	
			    		var current = ui.draggable; // on récupère l'élément étant déplacé
			    		var id = current.attr('id');
			    		var identifiant = current.attr('data-id');
			        $('#choix2').append(id);
			        $('#choix2 .input_change').val(identifiant).trigger("change");

         		  $('#preferance2').css("background-color", "cornflowerblue");    
         		  $('#preferance2').css("color", "white");  			
         		  			        
			        current.fadeOut("slow",function(){ // nouvelles fonction de callback, qui s'exécutera une fois l'effet terminé
	           		           
			        });			       
			        			     	    			    	
			        $('#preferance2').droppable({			        	
			        	accept : ''
			        });
			    }
			});	
			
			$('#preferance3').droppable({
			    accept : '.drag', // je n'accepte que le bloc ayant "drag" pour classerevert:true,		    
			    drop : function(event, ui){	
			    		var current = ui.draggable; // on récupère l'élément étant déplacé
			    		var id = current.attr('id');
			    		var identifiant = current.attr('data-id');
			        $('#choix3').append(id);
			        $('#choix3 .input_change').val(identifiant).trigger("change");

         		  $('#preferance3').css("background-color", "cornflowerblue");    
         		  $('#preferance3').css("color", "white");  			
         		  		        
			        current.fadeOut(function(){ // nouvelles fonction de callback, qui s'exécutera une fois l'effet terminé
	           		           
			        });			       
			        			     	    			    	
			        $('#preferance3').droppable({			        	
			        	accept : ''
			        });
			    }
			});

			$('#preferance4').droppable({
			    accept : '.drag', // je n'accepte que le bloc ayant "drag" pour classerevert:true,		    
			    drop : function(event, ui){	
			    		var current = ui.draggable; // on récupère l'élément étant déplacé
			    		var id = current.attr('id');
			    		var identifiant = current.attr('data-id');
			        $('#choix4').append(id);
			        $('#choix4 .input_change').val(identifiant).trigger("change");

         		  $('#preferance4').css("background-color", "cornflowerblue");    
         		  $('#preferance4').css("color", "white");  			
         		  		        
			        current.fadeOut(function(){ // nouvelles fonction de callback, qui s'exécutera une fois l'effet terminé
	           		           
			        });			       
			        			     	    			    	
			        $('#preferance4').droppable({			        	
			        	accept : ''
			        });
			    }
			});	

			$('#preferance5').droppable({
			    accept : '.drag', // je n'accepte que le bloc ayant "drag" pour classerevert:true,		    
			    drop : function(event, ui){	
			    		var current = ui.draggable; // on récupère l'élément étant déplacé
			    		var id = current.attr('id');
			    		var identifiant = current.attr('data-id');
			        $('#choix5').append(id);
			        $('#choix5 .input_change').val(identifiant).trigger("change");

         		  $('#preferance5').css("background-color", "cornflowerblue");    
         		  $('#preferance5').css("color", "white");  			
         		  		        
			        current.fadeOut(function(){ // nouvelles fonction de callback, qui s'exécutera une fois l'effet terminé
	           		           
			        });			       
			        			     	    			    	
			        $('#preferance5').droppable({			        	
			        	accept : ''
			        });
			    }
			});	

			$('#preferance6').droppable({
			    accept : '.drag', // je n'accepte que le bloc ayant "drag" pour classerevert:true,		    
			    drop : function(event, ui){	
			    		var current = ui.draggable; // on récupère l'élément étant déplacé
			    		var id = current.attr('id');
			    		var identifiant = current.attr('data-id');
			        $('#choix6').append(id);
			        $('#choix6 .input_change').val(identifiant).trigger("change");

         		  $('#preferance6').css("background-color", "cornflowerblue");    
         		  $('#preferance6').css("color", "white");  			
         		  		        
			        current.fadeOut(function(){ // nouvelles fonction de callback, qui s'exécutera une fois l'effet terminé
	           		           
			        });			       
			        			     	    			    	
			        $('#preferance6').droppable({			        	
			      	accept : ''
			        });
			    }
			});	
		</script> 	