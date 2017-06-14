<script>
	// ajoute la propriété pour le drop et le transfert de données
	$.event.props.push('dataTransfer');
	 
	$(document).ready(function() {
	    var i, $this, $log = $('#log');
	    
	    $('.drag').on({
	        // on commence le drag
	        dragstart: function(e) {
	            $this = $(this);
	 
	            d = $this.html();
	            $this.css('opacity', '0.5');
	 
	            // on garde le texte en mémoire (A, B, C ou D)
	            e.dataTransfer.setData('html', $this.text());
	        },
	        // on passe sur un élément draggable
	        dragenter: function(e) {
	            // on augmente la taille pour montrer le draggable
	            /*$(this).animate({
	                width: '90px'
	            }, 'fast');*/
	 
	            e.preventDefault();
	        },
	        // on quitte un élément draggable
	        dragleave: function() {

	        },
	        // déclenché tant qu on a pas lâché l élément
	        dragover: function(e) {
	            e.preventDefault();
	        },
	        // on lâche l élément
	        drop: function(e) {

	            // on met le nouvel element à la place de l ancien et inversement
	            $this.html($(this).html());
	            $(this).html(d);    
	            $('#choisir').trigger("click");          

	            e.preventDefault();	            
	        },
	        // fin du drag (même sans drop)
	        dragend: function() {
	            $(this).css('opacity', '1');            
	            //$('#choisir').trigger("click");
	            
	        },
	        // au clic sur un élément
	        click: function() {
	            alert($(this).index());
	        }
	    });
	});	
	
	$("#res").click(function(){
		$('.preferance .drag .text_cadre').html('+');		
		$('.preferance .drag .input_change').val('');
	  $('.preferance').css("background-color", "white");
	});	
</script>	 
<?php
function cadre_team($emp_team, $user, $manager) {	
	$tab = $manager->get_id_team($emp_team, $user->id_user());
	//var_dump($tab);
	if ($tab) {
		?>
    <div class="preferance" >
	 		<div class="drag" id="<?=$tab["nom"];?><?=$tab["id_perso"];?>" data-id="<?=$tab["id_perso"];?>" 
	 			style="position: relative;top:-11px;left:-11px;background-image: url('./images/perso/<?=$tab["nom"];?><?=$tab["etoile"];?>.jpg');background-size: 100%;" draggable="true" >
			  <p class="text_cadre"><?=$tab["nom"];?> <?=$tab["id_perso"];?></p>
			  <input type="hidden" class="input_change" name="choix[]" value="<?=$tab["id_perso"];?>" />
			</div> 			
    </div>  		
		<?php 
	}
	else {
		?>
    <div class="preferance" >
	 		<div class="drag" draggable="true" id="" data-id="" style="position: relative;top:-11px;left:-11px;" >
			  <p class="text_cadre">+</p>
			  <input type="hidden" class="input_change" name="choix[]" value="" />
			</div>		
    </div>  		
		<?php 
	}
}
?>
<form method="post" class="add_team" action="?action=team">
<div class="pref">
	<h3 style="width:200px;">Première ligne</h3>
	<?php
	for ($i=1 ; $i<=3; $i++) {
		echo cadre_team($i, $user, $manager);
	}
	?>	
</div>  
<div class="pref">
	<h3 style="width:200px;">Seconde ligne</h3>
	<?php
	for ($i=4 ; $i<=6; $i++) {
		echo cadre_team($i, $user, $manager);
	}
	?>
</div> 	        
  <p>Reset</p>
  <button id="res"><span class="ui-icon ui-icon-trash" ></span></button><br />
  <input type="submit" id="choisir" value="Choisir" style="visibility:hidden;"/>

</form>  	
<div id="persos">
<?php
foreach ($perso as $persos) {
	if ($persos->team() == 0) {	
		//var_dump($persos);	
  	?>	
	 		<div class="drag" id="<?=$persos->nom();?><?=$persos->id_perso();?>" data-id="<?=$persos->id_perso();?>" draggable="true"
	 			style="background-image: url('./images/perso/<?=$persos->nom();?><?=$persos->etoile();?>.jpg');background-size: 100%;">
			  <p><?=$persos->nom();?> <?=$persos->id_perso();?></p>
			  <input type="hidden" class="input_change" name="choix[]" value="<?=$persos->id_perso();?>" />
			</div> 	
  	<?php	
 	} 
} 	
?>
</div>

 