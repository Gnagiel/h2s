<?php

header("Content-Type: application/json");

function chargerClasse($classe)
{
  require '../class/'.$classe . '.php';
}

spl_autoload_register('chargerClasse');
session_start();

include("../includes/identifiant.php");

$manager = new PersonnagesManager($db);
$perso = $manager->get((int) $_POST['id1']);

if ($_POST['action'] == "frapper") // Si on a cliqué sur un personnage pour le frapper.
{
  if (!isset($perso))
  {
    $message = 'Merci de créer un personnage ou de vous identifier.';
    echo "identifiez vous";
  }

  else
  {
    if (!$manager->exists((int) $_POST['idCible']))
    {
      $message = 'Le personnage que vous voulez frapper n\'existe pas !';
      echo $message;
    }

    else
    {
      $persoAFrapper = $manager->get((int) $_POST['idCible']);
      $retour = $perso->frapper($persoAFrapper, $perso); // On stocke dans $retour les éventuelles erreurs ou messages que renvoie la méthode frapper.

      switch ($retour)
      {
        case Personnage::CEST_MOI :
          $message = 'Mais... pourquoi voulez-vous vous frapper ???';
					$entry = array(
						'result' => 'Pas possible'
					);

					echo json_encode($entry);
        break;

        case Personnage::PERSONNAGE_FRAPPE :
          $message = '<p>'.$perso->nom().' a frappé '.$persoAFrapper->nom().' et lui a infligé '.$perso->att().' points de dégat</p>';
          $manager->update($perso);
          $manager->update($persoAFrapper);

          $f = fopen("../logs/".$_SESSION['user']->pseudo().".txt", "a+");
          fwrite($f,$message);
					fclose($f) ;
					$entry = array(
						'result' => 'frapper',
						'id' => utf8_encode($persoAFrapper->id_perso()),
						'pv' => utf8_encode($persoAFrapper->pv_fight())
					);

					echo json_encode($entry);
          break;

        case Personnage::PERSONNAGE_TUE :
          $message = '<p>'.$perso->nom().' a tué '.$persoAFrapper->nom().'</p>';
          $f = fopen("../logs/".$_SESSION['user']->pseudo().".txt", "a+");
          fwrite($f,$message);
					fclose($f) ;
          $manager->update($perso);
          $manager->update($persoAFrapper);
					$entry = array(
						'result' => 'Tué',
						'persoForce' => utf8_encode($perso->att()),
						'id' => utf8_encode($persoAFrapper->id_perso())
					);

					echo json_encode($entry);
        break;

        case Personnage::PERSO_ENDORMI :
          $message = 'Vous êtes endormi, vous ne pouvez pas frapper de personnage !';
        break;
      }
    }
  }
}

// elseif ($_POST['action'] == 'endormir')
// {
//   if (!isset($perso))
//   {
//     $message = 'Merci de créer un personnage ou de vous identifier.';
//   }
//
//   else
//   {
//     // Il faut bien vérifier que le personnage est un magicien.
//     if ($perso->type() != 'magicien')
//     {
//       $message = 'Seuls les magiciens peuvent ensorceler des personnages !';
//     }
//
//     else
//     {
//       if (!$manager->exists((int) $_POST['idCible']))
//       {
//         $message = 'Le personnage que vous voulez frapper n\'existe pas !';
//       }
//
//       else
//       {
//         $persoAEnsorceler = $manager->get((int) $_POST['idCible']);
//         $retour = $perso->lancerUnSort($persoAEnsorceler);
//
//         switch ($retour)
//         {
//           case Personnage::CEST_MOI :
//             $message = 'Mais... pourquoi voulez-vous vous ensorceler ???';
//             break;
//
//           case Personnage::PERSONNAGE_ENSORCELE :
// 						$message = '<p>'.$perso->nom().' a endormi '.$persoAEnsorceler->nom().' pendant 1 tour</p>';
// 	          $f = fopen($_SESSION['user']->nom().".txt", "a+");
// 	          fwrite($f,$message);
// 						fclose($f) ;
//             $manager->update($perso);
//             $manager->update($persoAEnsorceler);
// 						$entry = array(
// 							'result' => 'endormir',
// 							'id' => utf8_encode($persoAEnsorceler->id()),
// 							'vie' => utf8_encode($persoAEnsorceler->vie())
// 						);
//
// 						$json[] = $entry;
// 						echo json_encode($json);
// 	          break;
//
//           case Personnage::PAS_DE_MAGIE :
//             $message = 'Vous n\'avez pas de magie !';
//             break;
//
//           case Personnage::PERSO_ENDORMI :
//             $message = 'Vous êtes endormi, vous ne pouvez pas lancer de sort !';
//             break;
//         }
//       }
//     }
//   }
// }
//
// elseif ($_POST['action'] == 'soigner')
// {
//   if (!isset($perso))
//   {
//     $message = 'Merci de créer un personnage ou de vous identifier.';
//   }
//
//   else
//   {
//     // Il faut bien vérifier que le personnage est un magicien.
//     if ($perso->type() != 'monk')
//     {
//       $message = 'Seuls les monks peuvent soigner des personnages !';
//     }
//
//     else
//     {
//       if (!$manager->exists((int) $_POST['idCible']))
//       {
//         $message = 'Le personnage que vous voulez soigner n\'existe pas !';
//       }
//
//       else
//       {
//         $persoASoigner = $manager->get((int) $_POST['idCible']);
//         $retour = $perso->lancerUnSoin($persoASoigner);
//
//         switch ($retour)
//         {
//           case Personnage::PERSONNAGE_SOIGNE :
//             $message = '<p>'.$perso->nom().' a soigner '.$persoASoigner->nom().' et lui a rendu '.$perso->inte().' points de vie</p>';
// 	          $f = fopen($_SESSION['user']->nom().".txt", "a+");
// 	          fwrite($f,$message);
// 						fclose($f) ;
// 	          $manager->update($perso);
// 	          $manager->update($persoASoigner);
// 						$entry = array(
// 							'result' => 'soigner',
// 							'persoInte' => utf8_encode($perso->inte()),
// 							'id' => utf8_encode($persoASoigner->id()),
// 							'vie' => utf8_encode($persoASoigner->vie())
// 						);
//
// 						$json[] = $entry;
// 						echo json_encode($json);
// 	          break;
//
//           case Personnage::PAS_DE_MAGIE :
//             $message = 'Vous n\'avez pas de magie !';
//             break;
//
//           case Personnage::PERSO_ENDORMI :
//             $message = 'Vous êtes endormi, vous ne pouvez pas lancer de sort !';
//             break;
//
//           case Personnage::PERSO_FULL_LIFE :
//             $message = 'Le personnage n\'a plus besoin de soin !';
//             break;
//         }
//       }
//     }
//   }
// }
?>
