<?php
/**
 * \file          Function_Attaque.php
 * \author    Guillaume Nagiel
 * \version   1.0
 * \date       1 Mars 2018
 * \brief       Définit les fonctions d'un combat.
 *
 * \details    Ce fichier définit toutes les fonctions utilisées pour efectuer un combat.
 */
	if (isset($_GET['frapper'])) // Si on a cliqué sur un personnage pour le frapper.
	{
	  if (!isset($perso))
	  {
	    $message = 'Merci de créer un personnage ou de vous identifier.';
	  }

	  else
	  {
	    if (!$manager->exists((int) $_GET['frapper']))
	    {
	      $message = "Le personnage que vous voulez frapper n'existe pas !";
	    }

	    else
	    {
	      $persoAFrapper = $manager->get((int) $_GET['frapper']);
	      $retour = $perso->frapper($persoAFrapper, $perso); // On stocke dans $retour les éventuelles erreurs ou messages que renvoie la méthode frapper.

	      switch ($retour)
	      {
	        case Personnage::CEST_MOI :
	          $message = 'Mais... pourquoi voulez-vous vous frapper ???';
	          break;

	        case Personnage::PERSONNAGE_FRAPPE :
	          $message = 'Le personnage a bien été frappé !';

	          $manager->update($perso);
	          $manager->update($persoAFrapper);

	          break;

	        case Personnage::PERSONNAGE_TUE :
	          $message = 'Vous avez tué ce personnage !';

	          $manager->update($perso);
	          //$manager->delete($persoAFrapper);

	          break;

	        case Personnage::PERSO_ENDORMI :
	          $message = 'Vous êtes endormi, vous ne pouvez pas frapper de personnage !';
	          break;
	      }
	    }
	  }
	}

	elseif (isset($_GET['ensorceler']))
	{
	  if (!isset($perso))
	  {
	    $message = 'Merci de créer un personnage ou de vous identifier.';
	  }

	  else
	  {
	    // Il faut bien vérifier que le personnage est un magicien.
	    if ($perso->type() != 'magicien')
	    {
	      $message = 'Seuls les magiciens peuvent ensorceler des personnages !';
	    }

	    else
	    {
	      if (!$manager->exists((int) $_GET['ensorceler']))
	      {
	        $message = "Le personnage que vous voulez frapper n'existe pas !";
	      }

	      else
	      {
	        $persoAEnsorceler = $manager->get((int) $_GET['ensorceler']);
	        $retour = $perso->lancerUnSort($persoAEnsorceler);

	        switch ($retour)
	        {
	          case Personnage::CEST_MOI :
	            $message = 'Mais... pourquoi voulez-vous vous ensorceler ???';
	            break;

	          case Personnage::PERSONNAGE_ENSORCELE :
	            $message = 'Le personnage a bien été ensorcelé !';

	            $manager->update($perso);
	            $manager->update($persoAEnsorceler);

	            break;

	          case Personnage::PAS_DE_MAGIE :
	            $message = "Vous n'avez pas de magie !";
	            break;

	          case Personnage::PERSO_ENDORMI :
	            $message = 'Vous êtes endormi, vous ne pouvez pas lancer de sort !';
	            break;
	        }
	      }
	    }
	  }
	}

	elseif (isset($_GET['soigner']))
	{
	  if (!isset($perso))
	  {
	    $message = 'Merci de créer un personnage ou de vous identifier.';
	  }

	  else
	  {
	    // Il faut bien vérifier que le personnage est un magicien.
	    if ($perso->type() != 'monk')
	    {
	      $message = 'Seuls les monks peuvent soigner des personnages !';
	    }

	    else
	    {
	      if (!$manager->exists((int) $_GET['soigner']))
	      {
	        $message = "Le personnage que vous voulez soigner n'existe pas !";
	      }

	      else
	      {
	        $persoAEnsorceler = $manager->get((int) $_GET['soigner']);
	        $retour = $perso->lancerUnSoin($persoAEnsorceler);

	        switch ($retour)
	        {
	          case Personnage::PERSONNAGE_SOIGNE :
	            $message = 'Le personnage a bien été soigné !';

	            $manager->update($perso);
	            $manager->update($persoAEnsorceler);

	            break;

	          case Personnage::PAS_DE_MAGIE :
	            $message = "Vous n'avez pas de magie !";
	            break;

	          case Personnage::PERSO_ENDORMI :
	            $message = 'Vous êtes endormi, vous ne pouvez pas lancer de sort !';
	            break;

	          case Personnage::PERSO_FULL_LIFE :
	            $message = "Le personnage n'a plus besoin de soin !";
	            break;
	        }
	      }
	    }
	  }
	}
?>
