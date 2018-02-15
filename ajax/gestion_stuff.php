<?php
function chargerClasse($classe)
{
  require '../class/'.$classe . '.php';
}

spl_autoload_register('chargerClasse');

session_start();

include("../includes/identifiant.php");

$manager = new PersonnagesManager($db);
$managerUser = new UserManager($db);
$managerStuff = new StuffManager($db);
$stuff = $managerStuff->get($_POST["id_stuff"]);
$tab = $managerStuff->get_niveau_sup($stuff->niveau());
$perso = $manager->get($_POST["id_perso"]);
if ($stuff->cout() <= $_SESSION['user']->argent()) {
	$stuff->lvlUp($_SESSION['user'], $tab);
	
	$_SESSION['user']->payer_argent($stuff->cout());
	$managerStuff->update($stuff);
	$managerUser->update($_SESSION['user']);
	
	$entry = array(
		'result' => 'lvl Up',
		'niveau' => utf8_encode($stuff->niveau()),
		'id' => utf8_encode($stuff->id_stuff()),
		'argent' => utf8_encode($_SESSION['user']->argent()),
		'id_perso' => utf8_encode($_POST["id_perso"]),
		'pv' => utf8_encode($stuff->atr_2()),
		'att' => utf8_encode($stuff->atr_1()),
		'def' => utf8_encode($stuff->atr_1()),
		'type' => utf8_encode($stuff->types()),
		'perso_pv' => utf8_encode($perso->pv()),
		'perso_att' => utf8_encode($perso->att()),
		'perso_def' => utf8_encode($perso->def()),
		'perso_vit' => utf8_encode($perso->vit()),
		'perso_pen' => utf8_encode($perso->pen()),
		'perso_arm' => utf8_encode($perso->arm()),
		'perso_pre' => utf8_encode($perso->pre()),
		'perso_esc' => utf8_encode($perso->esc()),
		'perso_crit' => utf8_encode($perso->crit()),
		'perso_ten' => utf8_encode($perso->ten()),
		'perso_soi' => utf8_encode($perso->soi())
	);
	
	$_SESSION['user']->payer_argent($stuff->cout());

	$json[0] = $entry;
	echo json_encode($json);
	//echo json_encode($perso);	
}
else
{
	echo "Pas assez d'argent";
}




?>