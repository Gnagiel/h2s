<?php	

function chargerClasse($classe)
{
  require '../class/'.$classe . '.php';
}

spl_autoload_register('chargerClasse');
session_start();

include("../includes/identifiant.php");

$manager = new PersonnagesManager($db); 	
if (isset($_POST['choix']))
{
	$manager->sup_team();
	$tab_team = $_POST['choix'];
	$i = 1;
  foreach ($tab_team as $perso)
  {
  	$manager->update_team($i, $perso);
  	$i++;
  }	
  echo 'success';
}

?>