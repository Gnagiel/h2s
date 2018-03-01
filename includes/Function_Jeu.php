
<?php
/**
 * \file          Function_Jeu.php
 * \author    Guillaume Nagiel
 * \version   1.0
 * \date       26 Janvier 2018
 * \brief       Définit les fonctions du jeu.
 *
 * \details    Ce fichier définit toutes les fonctions utilisées pour initialiser le jeu.
 */

function affichePerso($perso)
{
/**
 * \brief       Afficher un personnage
 * \details    Génère l'HTML permettant d'afficher un personnage du jeu. (cf #$perso)
 * \param    $perso         Perso à afficher.
 * \return    Un block HTML.
 */
	if ($perso->atout() == 2) {
		echo '<div class="perso2">';
	} else {
		echo '<div class="perso">';
	}
	if ($perso->timeEndormi() == 1) {
		echo '<span class="info">zZZZz</span><br />';
	}
	if ($perso->etat() == "good") {
		$image = $perso->type().'Mini.png';
	}
	else {
		$image = 'tombe.png';
	}
	echo '<span id="'.$perso->id().'Degat" class="spanDegat"></span>';
	echo '<a onClick="cible('.$perso->id().')">';
	echo '<img src="./images/'.$image.'" class="avatarC" id="'.$perso->id().'"/>';
	echo '</a><br />';
	echo 'Vie : '.htmlspecialchars($perso->vie()).'/'.htmlspecialchars($perso->vieMax()).'<br />';
	echo '</div>';
};

function fonctionComparaison($a, $b){
    return $a['vie'] > $b['vie'];
};


/**
* \code{.php}
*/
	$manager = new PersonnagesManager($db);
	$managerUser = new UserManager($db);
	$managerStuff = new StuffManager($db);
	
	if (isset($user)) // Si on a créé un personnage, on le stocke dans une variable session afin d'économiser une requête SQL.
	{
	  $_SESSION['user'] = $user;
	}
	elseif (isset($_SESSION['user'])) // Si la session perso existe, on restaure l'objet.
	{
	  $user = $_SESSION['user'];
	}
	elseif (isset($_POST['creeruser']) && isset($_POST['nom'])) // Si on a voulu créer un utilisateur.
	{
		$user = new User(['nom' => $_POST['nom'], 'mdp' => $_POST['mdp']]);

	  if (isset($user)) // Si le type du personnage est valide, on a crée un personnage.
	  {
	    if (!$user->nomValide())
	    {
	      $message = 'Le nom choisi est invalide.';
	      unset($user);
	    }
	    elseif ($managerUser->exists($user->nom()))
	    {
	      $message = 'Le nom est déja pris.';
	      unset($user);
	    }
	    else
	    {
	      $managerUser->add($user);
	      $_SESSION['user'] = $user;
	    }
	  }
	}
	elseif (isset($_POST['user']) && isset($_POST['nom'])) // Si on a voulu utiliser un utilisateur.
	{
	  if ($managerUser->exists($_POST['nom']) && $managerUser->verifMdp($_POST['nom'], $_POST['mdp'])) // Si celui-ci existe.
	  {

	    $user = $managerUser->get($_POST['nom']);
	    $_SESSION['user'] = $user;
			$managerUser->update($user);
	  }
    elseif (!$managerUser->verifMdp($_POST['nom'], $_POST['mdp']))
    {
      $message = 'Le mot de passe n\'est pas bon.';
    }
    else
    {
    	$message = 'L\'utilisateur n\'existe pas';
    }
	}


?>
