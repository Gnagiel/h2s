<?php
function chargerClasse($classe)
{
  require '../class/'.$classe . '.php';
}

spl_autoload_register('chargerClasse');

session_start();

include("../includes/identifiant.php");

$manager = new PersonnagesManager($db);
$perso = $manager->get($_POST["btn_valid"]);

foreach ($_SESSION['tab_perso'] as $id)
{	

	$persos = $manager->get($id);

	$perso->recevoirXP($persos->xp());

	$manager->update($perso);		
	
	$manager->delete($persos);
}

unset($perso);
$perso = $manager->get($_POST["btn_valid"]);


$entry = array(
	'result' => 'lvl Up',
	'niveau' => utf8_encode($perso->niveau()),
	'id_perso' => utf8_encode($perso->id_perso()),
	'type' => utf8_encode($perso->types()),
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
	'perso_soi' => utf8_encode($perso->soi()),
	'tab' => $_SESSION['tab_perso']
);

	$json[0] = $entry;
	echo json_encode($json);

unset($_SESSION['tab_perso']);
?>