<?php
/**
 * \file          modif_team.php
 * \author    Guillaume Nagiel
 * \version   1.0
 * \date       26 Janvier 2018
 * \brief       Menu cheat de la team.
 *
 * \details    Ce fichier est le menu cheat de la team, ce menu permet de cheater afin de tester toutes les fonctionnalités concernant votre équipe.
 */

/**
* \code{.php}
*/
echo '<div id="team">';
foreach ($perso as $persos)
{
?>
	<div class="perso_menu">
    <?= htmlspecialchars($persos->nom()).' (Niv'.htmlspecialchars($persos->niveau()).')' ?><br /><br />
	  <form class="sup_perso" method="POST" action="index.php?action=cheat">
			<input type="hidden" name="id_perso" value="<?=$persos->id_perso();?>" />
			<input type="submit" value="-" />
		</form><br />
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
<?php
}
?>
</div>
<br /><br /><br /><br />
<div class="list_cheat">
<?php
$tab = $manager->getListCheat();

foreach ($tab as $persos)
{
?>
	<div class='list_cheat_perso'>
		<?= htmlspecialchars($persos->nom());?><br />
		<span>PV </span><?= htmlspecialchars($persos->pv());?><br />
		<span>ATT </span><?= htmlspecialchars($persos->att());?><br /><br />
		<form class="add_perso" method="POST" action="index.php?action=cheat">
			<input type="hidden" name="id_user" value="<?=$user->id_user();?>" />
			<input type="hidden" name="id_perso" value="<?=$persos->id_persos();?>" />
			<input type="submit" value="+" />
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
