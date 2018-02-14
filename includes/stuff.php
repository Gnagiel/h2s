<div id="team">
<?php
 /**
 * \file          /includes/stuff.php
 * \author    Guillaume Nagiel
 * \version   1.0
 * \date       26 Janvier 2018
 * \brief       Menu de gestion du stuff.
 *
 * \details    Ce fichier est le menu de gestion du stuff, il permet de gérer toutes les fonctionnalités concernant le stuff.
 */
 
 /**
* \code{.php}
*/
foreach ($perso as $persos)
{			
	$stuff1 = $managerStuff->get($persos->stuff_1());
	$stuff2 = $managerStuff->get($persos->stuff_2());
	$stuff3 = $managerStuff->get($persos->stuff_3());
	?>		
	<div class="affiche_stuff">
		<div class="stuff_menu">
			<a href="./includes/stuff_modal.php?id_stuff=<?=$stuff1->id_stuff()?>&id_perso=<?=$persos->id_perso()?>" class="manual-ajax" >
				<div class="stuff_test" style="background-image: url('./images/stuff/<?=$stuff1->nom();?>.jpg');background-size: 100%;">
					<?=$stuff1->nom()?><br />
					lvl : <span class="stuff<?=$stuff1->id_stuff()?>"><?=$stuff1->niveau()?></span>
				</div>		
			</a>
			<a href="./includes/stuff_modal.php?id_stuff=<?=$stuff2->id_stuff()?>&id_perso=<?=$persos->id_perso()?>" class="manual-ajax" >
				<div class="stuff_test" style="background-image: url('./images/stuff/<?=$stuff2->nom();?>.jpg');background-size: 100%;">
					<?=$stuff2->nom()?><br />	
					lvl : <span class="stuff<?=$stuff2->id_stuff()?>"><?=$stuff2->niveau()?></span>		
				</div>
			</a>			
		</div>
		<div class="perso_menu" id="<?=$persos->nom();?><?=$persos->id_perso();?>">				
	    <?= htmlspecialchars($persos->nom()).' (Niv'.htmlspecialchars($persos->niveau()).')' ?><br /><br />
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
	  </div>
		<div class="stuff_menu">
			<a href="./includes/stuff_modal.php?id_stuff=<?=$stuff3->id_stuff()?>&id_perso=<?=$persos->id_perso()?>" class="manual-ajax" >
				<div class="stuff_test" style="background-image: url('./images/stuff/<?=$stuff3->nom();?>.jpg');background-size: 100%;">
					<?=$stuff3->nom()?><br />	
					lvl : <span class="stuff<?=$stuff3->id_stuff()?>"><?=$stuff3->niveau()?></span>		
				</div>
			</a>		
			<div class="stuff_test">
				
			</div>			
		</div>
	</div>	  	 
	   
	<?php
}
?>
</div>
<br /><br /><br /><br />
<div class="list_cheat">
<?php	
foreach ($perso as $persos)
	{
	?>
	<a class="choix_stuff" href="#<?=$persos->nom();?><?=$persos->id_perso();?>">  		
		<div class='list_cheat_perso'>
			<?= htmlspecialchars($persos->nom());?><br />
				<span>PV </span><?= htmlspecialchars($persos->pv());?><br />
				<span>ATT </span><?= htmlspecialchars($persos->att());?><br /><br />
			
		</div> 
	</a> 	
	<?php
	//var_dump($persos);
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
			
			// Open modal in AJAX callback
			$('.manual-ajax').click(function(event) {
			  event.preventDefault();
			  
			  $.get(this.href, function(html) {
			    $(html).appendTo('body').modal();
			    
					$(".btn_up").click(function(){ 
						p = $(this).val();
						$.ajax({ 
							type: "POST", 
							url: "./ajax/gestion_stuff.php", 
							data: $("#stuff_up"+p).serialize(),
							success: function(json){
									json = $.parseJSON(json); 
									id = ".stuff"+json[0].id;
	              	$(id).html(json[0].niveau);
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
	              	$("#argent").html(json[0].argent);
	           	              	
									$(".modal").append(json);							
							} 
						});  					
					}); 		    
			  });
			});						
			
		});
	</script>	
