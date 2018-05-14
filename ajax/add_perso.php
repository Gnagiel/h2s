<?php	

function chargerClasse($classe)
{
  require '../class/'.$classe . '.php';
}

spl_autoload_register('chargerClasse');
session_start();

include("../includes/identifiant.php");

$manager = new PersonnagesManager($db); 	
$usermanager = new UserManager($db); 
$managerStuff = new StuffManager($db);

$perso = $manager->get_base_perso((int) $_POST['id_perso']);

$user = $usermanager->get((int) $_POST['id_user']);
if ($manager->add($perso, $user, $managerStuff))
{
	echo 'success';
}
?>