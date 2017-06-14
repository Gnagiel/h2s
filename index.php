<?php
	function chargerClasse($classe)
	{
	  require './class/'.$classe . '.php';
	}
	
	spl_autoload_register('chargerClasse');

	session_start();
	
	include('./includes/eviterMessageAvertissement.php');	

	if (isset($_GET['deconnexion']))
	{
	  session_destroy();
	  header('Location: .');
	  exit();
	}

	include("./includes/identifiant.php");
	include("./includes/Function_Jeu.php");
	//include("./includes/Function_Attaque.php");

?>
<!DOCTYPE html>
<html>
	<head>
    <title>Heroes Smash Storm</title>
    <link rel="stylesheet" media="screen" type="text/css" href="./style/style.css" />
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
		<script type="text/javascript" src="http://www.google.com/jsapi"></script>
		<script type="text/javascript">
    	google.load('jquery','1');
    </script> 
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
	<div class="flex">		
		<div id="chargement">
			<img src="./images/charge.gif" id="charge" />
		</div>	
		<div id="head">	
			<?php
			echo '<h2>'.$user->pseudo().'</h2>';
			$perso = $manager->getList($user);
			?>
			<h2><a href="index.php" class="root" >Accueil</a></h2>
			<h2><a href="index.php?deconnexion=1" class="root" >Déconnexion</a></h2>
		</div>
	</div>
	<?php	
	//var_dump($perso);
	
	if (isset($_GET["action"])) {
		switch ($_GET["action"]) {
			
			/// EDITION DU MENU CHEAT
			case 'cheat':
				?>		
				<script src="./JS/add_perso.js"></script>
				<script src="./JS/sup_perso.js"></script>
				<?php			
				
				include("./includes/cheat.php");
			break;
			
			/// EDITION DU MENU D'EQUIPE
			case 'team':
				?>	
				<script src="./JS/team.js"></script>			
				<?php
				include("./includes/team.php");
			break;			

			/// EDITION DU MENU D'EQUIPEMENT
			case 'stuff':
				include("./includes/stuff.php");
			break;	
						
			/// COMBAT
			case 'combat':	
				?>
				<script src="./JS/attaquer.js"></script>
				<script src="./JS/soigner.js"></script>
				<script src="./JS/endormir.js"></script>
				<?php
				echo '<div id="combat_page" >';
				include("./includes/Function_Combat.php");
			break;	

			/// CHOIX PVP
			case 'choix':
				/*$retourUsers = $managerUser->getList($user->nom());
				echo '<div id="choix_adv">';
				if (empty($retourUsers))
				{
				  echo 'Personne à combattre !';
				}
				else
				{
			    foreach ($retourUsers as $unUser)
			    {
			    	if (($unUser->nom() != "IA") && !empty($unUser->perso_1()))
			    	{
				      echo '<div class="nom_adv"><a href="?combatPVP=x&idUser=', $unUser->id(), '"><h3>', htmlspecialchars($unUser->nom()), '</h3></a></br>'; 
				      $adv1 = $manager->get($unUser->perso_1());
							$adv2 = $manager->get($unUser->perso_2());
							$adv3 = $manager->get($unUser->perso_3());
							echo "Personnages :</br>";
				      echo '	'.htmlspecialchars($adv1->nom()). ', '. htmlspecialchars($adv1->type()).' de niveau '.$adv1->niveau() .'</a></br>'; 
				      echo '	'.htmlspecialchars($adv2->nom()). ', '. htmlspecialchars($adv2->type()).' de niveau '.$adv2->niveau() .'</a></br>';
				      echo '	'.htmlspecialchars($adv3->nom()). ', '. htmlspecialchars($adv3->type()).' de niveau '.$adv3->niveau() .'</a></br></div></br>';    
				    }
			    }
			  }
			  echo '</div>';*/
			break;
			
			/// COMBAT PVP
			case 'combatPVP':
				/*?>
				<script src="./JS/attaquerPVP.js"></script>
				<script src="./JS/soignerPVP.js"></script>
				<script src="./JS/endormirPVP.js"></script>
				<?php
				echo '<div id="combat_page" >';
				include("./includes/Function_CombatPVP.php");*/
			break;			
								
			default :

				break;	
		}
	}
	else
	{
		if (file_exists($_SESSION['user']->pseudo().".txt")) {
			unlink($_SESSION['user']->pseudo().".txt");
		}			
	
		$_SESSION['tr'] = 0;
		$_SESSION['tour'] = 0;
		?>
			<ul id="bouton_menu">
				  <li><a href="index.php?action=cheat" class="root" >Cheat</a></li>				  
				  <li><a href="index.php?action=team" class="root" >Team</a></li>
				  <li><a href="index.php?action=stuff" class="root" >Amélioration de l'équipement</a></li>
				  <li><a href="index.php?action=Combat" class="root" >Combat</a></li>
				  <li><a href="index.php?action=combatPVP" class="root" >CombatPVP</a></li>
			</ul>

		<?php			
	}
}
else // Si on veut utiliser ou créer un user.
{

?>
    <form action="index.php" method="POST" class="form">
      <p>
      	Nom utilisateur: <input type="text" name="nom" maxlength="50" /><br />
      	Mdp: <input type="password" name="mdp" maxlength="50" autocomplete="off"/><br />
        <input type="submit" value="Utiliser cet user" name="user" /><br />
        <input type="submit" value="Créer cet user" name="creeruser" /><br />
      </p>
    </form>
<?php
}
?>

	</div>
	<script>
	$(".root").click(function(){ 
		$.ajax({ 
			type: "POST", 
			url: $(this).attr("href"), 
			success: function(retour){ 
				$("body").empty().html(retour); 
			} 
		}); 
		return false; 
	}); 

	$.ajaxSetup({
		beforeSend: function() {
			$('#chargement').css('visibility', 'visible');
		},
		success: function(){
			$('#chargement').css('visibility', 'hidden');
		},
	});		
	</script>
	<script>
		$(document).ready(function(){			
			$(function(){
				$("#onglets .onglet").not(":first").hide();
				$("#onglets .onglet:first").addClass("actif");
				$("#onglets ul a").click(function(){
					$("#onglets ul a").parent("li").removeClass("actif");
					$("#onglets .onglet").hide();
					$(this.hash).show();
					$(this).blur().parent("li").addClass("actif");
					return false;
				});
			});
		});
	</script>		
  </body>
</html>
<?php
if (isset($user)) // Si on a créé un personnage, on le stocke dans une variable session afin d'économiser une requête SQL.
{
  $_SESSION['user'] = $user;
}

?>