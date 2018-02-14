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
<div id="onglets">
	<ul>
		<li class="actif"><a href="#onglet_1">Modif Team</a></li>
		<li><a href="#onglet_2">Modif Perso</a></li>
		<li><a href="#onglet_3">Gestion stuff</a></li>
	</ul>
	<div class="onglet" id="onglet_1">
		<?php
		include("./includes/cheat/modif_team.php");
		?>
	</div> 
	<div class="onglet" id="onglet_2">
		<p>En construction...</p>
	</div>
	<div class="onglet" id="onglet_3">
		<?php
		include("./includes/cheat/modif_stuff.php");
		?>
	</div>
</div>




