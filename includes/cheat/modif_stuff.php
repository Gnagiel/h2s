<?php
echo '<div id="team">';

foreach ($perso as $persos)

{		
?>		
<div class="affiche_stuff">
	<div class="perso_menu" id="<?=$persos->nom();?><?=$persos->id_perso();?>">				
    <?= htmlspecialchars($persos->nom()).' (Niv'.htmlspecialchars($persos->niveau()).')' ?><br /><br />
<!--	  <form class="" method="POST" action="index.php?action=cheat">
			<input type="hidden" name="id_perso" value="<?=$persos->id_perso();?>" />
			<input type="submit" value="-" />
		</form>--><br />
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
	<div class='list_cheat_perso'>
		<a href="#<?=$persos->nom();?><?=$persos->id_perso();?>"><?= htmlspecialchars($persos->nom());?><br /></a>
		<span>PV </span><?= htmlspecialchars($persos->pv());?><br />
		<span>ATT </span><?= htmlspecialchars($persos->att());?><br /><br />
		<form class="add_perso" method="POST" action="index.php?action=cheat">
			<input type="hidden" name="id_user" value="<?=$user->id_user();?>" /> 
			<input type="hidden" name="id_perso" value="<?=$persos->id_persos();?>" />
			<input type="submit" value="voir" />
		</form>
	</div>  	
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
				$(".list_cheat .list_cheat_perso a").click(function(){
					var test = $(this).prop("hash");
					$("#team .affiche_stuff").hide();
					$(test).parent().show();
					return false;
				});
			});
		});
	</script>	