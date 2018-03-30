<?php
/*! \mainpage Accueil de la documentation
 * \section desc Description :
 * Jeu en construction. Jeu de cartes à collectionner, constitution d'un deck, combats PVE et PVP automatiques.\n
 * \section desc Lien :
 * \html <a href="../../index.php">Lien vers le jeu</a>
 * \section inclusion Arbre d'inclusion des fichiers php :
 * \html <img src="../../doc/monGraphe.svg"/>
 * \section BDD Schéma BDD :
 * \html <img src="../../sql/model.png"/>
 */

/**
 * \file          Index.php
 * \author    Guillaume Nagiel
 * \version   1.0
 * \date       26 Janvier 2018
 * \brief       Page d'index du jeu.
 * \details    Ce fichier est la base du jeu.
 * \todo  Il reste à implémenter les scripts de combats PVE et PVP.
 */

 	/**
 	 * \fn chargerClass($class)
	 * \brief       Charger les class à la demande
	 * \details    Permet de charger les class uniquement si elles sont utilisées via la fonction spl_autoload_register('chargerClass'). (cf #$classe)
	 * \param    $class         Class à instancier.
	 * \return    Rien.
	 */


function chargerClass($class)
{
  require './class/'.$class.'.php';
}

spl_autoload_register('chargerClass');
session_start();
/**
* \code{.php}
*/
if (isset($_GET['deconnexion']))
{
  session_destroy();
  header("location:index.php");
}

include("./includes/identifiant.php");
include("./includes/Function_Jeu.php");

?>
<!doctype html>
<html lang='fr'>
	<head>
    <title>Heroes Smash Storm</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script   src="https://code.jquery.com/jquery-1.9.1.js"   integrity="sha256-e9gNBsAcA0DBuRWbm0oZfbiCyhjLrI6bmqAl5o+ZjUA="   crossorigin="anonymous"></script>
    <!--<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
		<script type="text/javascript" src="http://www.google.com/jsapi"></script>
		<script type="text/javascript">
    	google.load('jquery','1.9.1');
    </script>-->
    <link href="./bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" media="screen" type="text/css" href="./style/style.css" />
	  <script src="./JS/highlight/highlight.pack.js" type="text/javascript" charset="utf-8"></script>
	  <script type="text/javascript" charset="utf-8"> hljs.initHighlightingOnLoad(); </script>
	  <link rel="stylesheet" href="./JS/highlight/github.css" type="text/css" media="screen" />
    <meta charset="utf-8" />
  </head>

  <body>
  <div id="main_page">
  <?php
  if (isset($message)) // On a un message à afficher ?
  {
    echo '<p>', $message, '</p>'; // Si oui, on l'affiche
  }
  if (isset($user)) // Si on utilise un user (nouveau ou pas).
  {
	?>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php"><?=$user->pseudo();?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=cheat">Cheat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=team">Team</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=stuff">Amélioration de l'équipement</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=up_perso">Amélioration des personnages</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=Combat">Combat PVE</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=combatPVP">Combat PVP</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./doc/html/index.html">Documentation</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?deconnexion=1">Déconnexion</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="flex">
		<div id="head">
			<?php
			$perso = $manager->getList($user);
			echo '<h5 id="or">Or : '.$user->or_().'</h5>';
			echo '<h5 id="argent">Argent : '.$user->argent().'</h5>';
			?>
		</div>
	</div>
	<?php

	if (isset($_GET["action"])) {
		switch ($_GET["action"]) {

			// EDITION DU MENU CHEAT
			case 'cheat':
				?>
				<script src="./JS/add_perso.js"></script>
				<script src="./JS/sup_perso.js"></script>
				<?php
				include("./includes/cheat.php");
			break;

			// EDITION DU MENU D'EQUIPE
			case 'team':
				?>
				<script src="./JS/team.js"></script>
				<?php
				include("./includes/team.php");
			break;

			// EDITION DU MENU D'EQUIPEMENT
			case 'stuff':
				include("./includes/stuff.php");
			break;

			// EDITION DU MENU DES PERSONNAGES
			case 'up_perso':
				include("./includes/up_perso.php");
			break;

			// COMBAT
			case 'combat':

			break;

			// CHOIX PVP
			case 'choix':
			break;

			// COMBAT PVP
			case 'combatPVP':
			break;

			default :

				break;
		}
	}
	else
	{
		if (file_exists($_SESSION['user']->pseudo().".txt")) {
			//unlink($_SESSION['user']->pseudo().".txt");
		}

		$_SESSION['tr'] = 0;
		$_SESSION['tour'] = 0;
		?>
			<ul id="bouton_menu">
				  <li><a href="index.php?action=cheat" class="root" >Cheat</a></li>
				  <li><a href="index.php?action=team" class="root" >Team</a></li>
				  <li><a href="index.php?action=stuff" class="root" >Amélioration de l'équipement</a></li>
				  <li><a href="index.php?action=up_perso" class="root" >Amélioration des personnages</a></li>
				  <li><a href="index.php?action=Combat" class="root" >Combat PVE</a></li>
				  <li><a href="index.php?action=combatPVP" class="root" >Combat PVP</a></li>
			</ul>

		<?php
	}
}
else // Si on veut utiliser ou créer un user.
{
?>
  <form action="index.php" method="POST" class="form">
    <div class="input-group input-group-lg">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-lg">Pseudo et mot de passe</span>
      </div>
      <input type="text" class="form-control" aria-label="Nom utilisateur" name="nom" maxlength="50" aria-describedby="inputGroup-sizing-sm">
      <input type="password" name="mdp" maxlength="50" autocomplete="off" class="form-control" aria-label="Mdp" aria-describedby="inputGroup-sizing-sm">
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="submit" value="Utiliser cet user" name="user">Se connecter</button>
        <button class="btn btn-outline-secondary" type="submit" value="Créer cet user" name="creeruser">Créer</button>
      </div>
    </div>
  </form>
<?php
}
?>
  <script>
  $(document).ready(function () {
    var listItems = $('.navbar ul li');

    $.each(listItems, function (key, litem) {
        var aElement = $(this).children(litem)[0];

        if(aElement == document.URL) {
            $(litem).addClass('active');
        }
    });
  });
  </script>
	</div>

  <script src="./bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>
