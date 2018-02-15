<?php
/**
 * \file          /includes/up_perso.php
 * \author    Guillaume Nagiel
 * \version   1.0
 * \date       26 Janvier 2018
 * \brief       Menu d'amélioreration des personnages.
 *
 * \details    Ce menu permet d'améliorer ses personnages, en sacrifiant des persos inutiles.
 */

/**
* \code{.php}
*/ 
echo '<div id="team">';

foreach ($perso as $persos)
{	
	?>		
	<div class="affiche_stuff">		
		<div class="perso_menu" id="<?=$persos->nom();?><?=$persos->id_perso();?>">	
			<a href="./includes/up_perso_modal.php?id_perso=<?=$persos->id_perso()?>" class="manual-ajax" >			
	    <?= htmlspecialchars($persos->nom());?> (Niv <span id="lvl<?=$persos->id_perso();?>" ><?=htmlspecialchars($persos->niveau());?></span>)<br /><br />
			<br />
	    <div class="sous_menu">
	      <div>
		      <div class="perso_sous_menu"><span>PV</span><span class="pv<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->pv()) ?></span><br /></div>
		      <div class="perso_sous_menu"><span>DEF</span><span class="def<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->def()) ?></span><br /></div>
		      <div class="perso_sous_menu"><span>Pen</span><span class="pen<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->pen()) ?></span><br /></div>
		      <div class="perso_sous_menu"><span>PRE</span><span class="pre<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->pre()) ?></span><br /></div>
		      <div class="perso_sous_menu"><span>CRIT</span><span class="crit<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->crit()) ?></span><br /></div>
		      <div class="perso_sous_menu"><span>SOI</span><span class="soi<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->soi()) ?></span><br /></div>	      	      
	      </div>
	      <div>
		      <div class="perso_sous_menu"><span>ATT</span><span class="att<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->att()) ?></span><br /></div>
		      <div class="perso_sous_menu"><span>VIT</span><span class="vit<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->vit()) ?></span><br /></div>
		      <div class="perso_sous_menu"><span>Arm</span><span class="arm<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->arm()) ?></span><br /></div>
		      <div class="perso_sous_menu"><span>ESQ</span><span class="esq<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->esc()) ?></span><br /></div>
		      <div class="perso_sous_menu"><span>TEN</span><span class="ten<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->ten()) ?></span><br /></div>      	      
	      </div>	
	    </div>  
	    </a> 
	    Reset <button class="btn_sup"><span class="ui-icon ui-icon-trash" ></span></button><br />
	    <button type="submit" class="btn_valid" name="btn_valid" value="<?=$persos->id_perso()?>">Choisir</button>
	    <form id="form_up<?=$persos->id_perso();?>"> 		
		 		<input type="hidden" class="id_perso_up" name="id_perso_up" value="<?=$persos->id_perso()?>" />
			  
			</form>    
	  </div>

	</div>	  	 
	   
	<?php
}
?>
	  <div id="session_tab">
	  <?php
	  if (isset($_SESSION['tab_perso'])) {
	  	var_dump($_SESSION['tab_perso']);
	  }
	  ?>
	  </div>
</div>
<br /><br /><br /><br />
<div class="list_cheat">
<?php	
foreach ($perso as $persos)
	{
	?>
	<a class="choix_stuff" id="choix<?=$persos->id_perso();?>" href="#<?=$persos->nom();?><?=$persos->id_perso();?>">  		
		<div class='list_cheat_perso'>
			<?= htmlspecialchars($persos->nom());?><br />
				<span>PV </span><?= htmlspecialchars($persos->pv());?><br />
				<span>ATT </span><?= htmlspecialchars($persos->att());?><br /><br />
			
		</div> 
	</a> 	
	<?php
	//var_dump($_SESSION['tab_perso']);
	//$manager->add($persos, $user);
}
?>
<?php
echo '</div>';
?>
	<script>
		$(document).ready(function(){	
			$(function(){
				$(".affiche_stuff").not(":first").hide();
				$(".choix_stuff").click(function(){
					var test = $(this).prop("hash");					
					$("#team .affiche_stuff").hide();					
					$(test).parent().show();
					return false;
				});
			});
			
			// Ouverture modal en AJAX pour selection des persos a sacrifier
			$('.manual-ajax').click(function(event) {
			  event.preventDefault();
			  
			  $.get(this.href, function(html) {
			    $(html).appendTo('body').modal();
			  
			  	// Selection des persos a sacrifier
					$(".tab_persos").submit(function(event){
						event.preventDefault();
						f = $(this).serialize();
						$.ajax({ 
							type: "POST", 
							url: "./ajax/gestion_perso.php", 
							data: f,
							success: function(json){
									$("#session_tab").html(json);	
									
									$.modal.close();																				
							} 
						});  					
					}); 												    
			  });
			});				
					
			// Validation du sacrifice
			$(".btn_valid").click(function(){ 
				p = $(this).val();
				$.ajax({ 
					type: "POST", 
					url: "./ajax/gestion_up_perso.php", 
					data: "btn_valid="+p,
					success: function(json){
							json = $.parseJSON(json);
							$("#lvl"+json[0].id_perso).html(json[0].niveau);
            	$(".pv"+json[0].id_perso).html(json[0].perso_pv);
            	$(".att"+json[0].id_perso).html(json[0].perso_att);
            	$(".def"+json[0].id_perso).html(json[0].perso_def);
            	$(".vit"+json[0].id_perso).html(json[0].perso_vit);
            	$(".pen"+json[0].id_perso).html(json[0].perso_pen);
            	$(".arm"+json[0].id_perso).html(json[0].perso_arm);
            	$(".pre"+json[0].id_perso).html(json[0].perso_pre);
            	$(".esc"+json[0].id_perso).html(json[0].perso_esc);
            	$(".crit"+json[0].id_perso).html(json[0].perso_crit);	
            	$(".ten"+json[0].id_perso).html(json[0].perso_ten);
            	$(".soi"+json[0].id_perso).html(json[0].perso_soi);							
							//alert(json);														
					} 
				});  					
			}); 	
			
			// Vidage du tableau des persos �acrifier
			$(".btn_sup").click(function(){ 
				$.ajax({ 
					url: "./ajax/gestion_sup_tab.php", 
					success: function(){
							$("#session_tab").html("");														
					} 
				});  					
			}); 			
		});
	</script>	
