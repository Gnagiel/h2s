<?php
/**
 * \file          cheat.php
 * \author    Guillaume Nagiel
 * \version   1.0
 * \date       26 Janvier 2018
 * \brief       Menu cheat du jeu.
 *
 * \details    Ce fichier est le menu cheat du jeu, ce menu permet de cheater afin de tester toutes les fonctionnalités du jeu.
 */
?>
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-team-tab" data-toggle="tab" href="#nav-team" role="tab" aria-controls="nav-team" aria-selected="true">Modif Team</a>
    <a class="nav-item nav-link" id="nav-perso-tab" data-toggle="tab" href="#nav-perso" role="tab" aria-controls="nav-perso" aria-selected="false">Modif Perso</a>
    <a class="nav-item nav-link" id="nav-stuff-tab" data-toggle="tab" href="#nav-stuff" role="tab" aria-controls="nav-stuff" aria-selected="false">Gestion stuff</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-team" role="tabpanel" aria-labelledby="nav-team-tab">
		<?php
		include("./includes/cheat/modif_team.php");
		?>
	</div>
  <div class="tab-pane fade" id="nav-perso" role="tabpanel" aria-labelledby="nav-perso-tab">
		<p>En construction...</p>
	</div>
  <div class="tab-pane fade" id="nav-stuff" role="tabpanel" aria-labelledby="nav-stuff-tab">
		<?php
		include("./includes/cheat/modif_stuff.php");
		?>
	</div>
</div>
