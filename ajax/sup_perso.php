<?php	

function chargerClasse($classe)
{
  require '../class/'.$classe . '.php';
}

spl_autoload_register('chargerClasse');
session_start();

include("../includes/identifiant.php");

$manager = new PersonnagesManager($db); 

$perso = $manager->get((int) $_POST['id_perso']);

if ($manager->delete($perso))
{
	echo 'success';
}
?>