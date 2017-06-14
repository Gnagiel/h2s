<?php
echo '<div id="team">';

foreach ($perso as $persos)

{		
	
$stuff1 = $managerStuff->get($persos->stuff_1());
$stuff2 = $managerStuff->get($persos->stuff_2());
$stuff3 = $managerStuff->get($persos->stuff_3());
?>		
<div class="affiche_stuff">
	<div class="stuff_menu">
		<div class="stuff_test" style="background-image: url('./images/stuff/<?=$stuff1->nom();?>.jpg');background-size: 100%;">
			<?=$stuff1->nom()?><br />
			lvl : <?=$stuff1->niveau()?>
		</div>		
		<div class="stuff_test" style="background-image: url('./images/stuff/<?=$stuff2->nom();?>.jpg');background-size: 100%;">
			<?=$stuff2->nom()?><br />	
			lvl : <?=$stuff2->niveau()?>		
		</div>			
	</div>
	<div class="perso_menu" id="<?=$persos->nom();?><?=$persos->id_perso();?>">				
    <?= htmlspecialchars($persos->nom()).' (Niv'.htmlspecialchars($persos->niveau()).')' ?><br /><br />
		<br />
    <div class="sous_menu">
      <div>
	      <div class="perso_sous_menu"><span>PV</span><?= htmlspecialchars($persos->pv()) ?><br /></div>
	      <div class="perso_sous_menu"><span>DEF</span><?= htmlspecialchars($persos->def()) ?><br /></div>
	      <div class="perso_sous_menu"><span>Pen</span><?= htmlspecialchars($persos->pen()) ?><br /></div>
	      <div class="perso_sous_menu"><span>PRE</span><?= htmlspecialchars($persos->pre()) ?><br /></div>
	      <div class="perso_sous_menu"><span>CRIT</span><?= htmlspecialchars($persos->crit()) ?><br /></div>
	      <div class="perso_sous_menu"><span>SOI</span><?= htmlspecialchars($persos->soi()) ?><br /></div>	      	      
      </div>
      <div>
	      <div class="perso_sous_menu"><span>ATT</span><?= htmlspecialchars($persos->att()) ?><br /></div>
	      <div class="perso_sous_menu"><span>VIT</span><?= htmlspecialchars($persos->vit()) ?><br /></div>
	      <div class="perso_sous_menu"><span>Arm</span><?= htmlspecialchars($persos->arm()) ?><br /></div>
	      <div class="perso_sous_menu"><span>ESQ</span><?= htmlspecialchars($persos->esc()) ?><br /></div>
	      <div class="perso_sous_menu"><span>TEN</span><?= htmlspecialchars($persos->ten()) ?><br /></div>      	      
      </div>	
    </div>      
  </div>
	<div class="stuff_menu">
		<div class="stuff_test" style="background-image: url('./images/stuff/<?=$stuff3->nom();?>.jpg');background-size: 100%;">
			<?=$stuff3->nom()?><br />	
			lvl : <?=$stuff3->niveau()?>		
		</div>		
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
		});
	</script>	