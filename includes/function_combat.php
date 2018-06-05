<script>
	function attaquant(id1) {
		document.getElementById("id1").value = nom;
	}

	function cible(id) {
		document.getElementById("frapper").value = id;
		document.getElementById("endormir").value = id;
		document.getElementById("soigner").value = id;
		document.getElementById("idCible").value = id;
	}
</script>

<?php
function afficher_perso($perso) {
	if ($perso->etat() != "kill")
	{
	?>
	<div class="card border rounded" style="width:200px;padding:5px">
		<a onClick="cible('<?= $perso->id_perso();?>')"  style="margin: auto;">
			<img src="./images/perso/<?= $perso->nom();?>2.jpg" class="avatarC" id="<?= $perso->id_perso();?>"/>
		</a>
	  <div class="card-body">
			<div class="progress">
				<div class="progress-bar" id="progress-bar<?=$perso->id_perso()?>" style="width: <?=$perso->pv()?>%" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="<?=$perso->vieMax()?>"></div>
			</div>
	  </div>
	</div>
	<?php
	}
}

function verifEtat($tab, $i) {
	if ($tab[$i]->etat() == "kill") {
		return verifEtat($tab, $i+1);
	}
	return $i;
}
if ((isset($_GET["idUser"])) && (empty($userAdv)))
{
	$userAdv = $managerUser->get(intval($_GET["idUser"]));
}
else if (empty($_GET["idUser"]))
{
	$userAdv = $managerUser->get(intval($_SESSION['idAdv']));
}
$_SESSION['idAdv'] = $userAdv;

$perso1 = $manager->get_team(1, $user->id_user());
$perso2 = $manager->get_team(2, $user->id_user());
$perso3 = $manager->get_team(3, $user->id_user());
$perso4 = $manager->get_team(4, $user->id_user());
$perso5 = $manager->get_team(5, $user->id_user());
$perso6 = $manager->get_team(6, $user->id_user());
$adv1 = $manager->get_team(1, $userAdv->id_user());
$adv2 = $manager->get_team(2, $userAdv->id_user());
$adv3 = $manager->get_team(3, $userAdv->id_user());
$adv4 = $manager->get_team(4, $userAdv->id_user());
$adv5 = $manager->get_team(5, $userAdv->id_user());
$adv6 = $manager->get_team(6, $userAdv->id_user());

if ($_SESSION['tour'] == 0) {
	$perso1->debut_combat();
	$perso2->debut_combat();
	$perso3->debut_combat();
	$adv1->debut_combat();
	$adv2->debut_combat();
	$adv3->debut_combat();
	$adv4->debut_combat();
	$adv5->debut_combat();
	$adv6->debut_combat();
  $f = fopen("./logs/".$_SESSION['user']->pseudo().".txt", "a+");
  $message = " ";
  fwrite($f,$message);
	fclose($f);
}

if (($perso1->etat() == "kill") && ($perso2->etat() == "kill") && ($perso3->etat() == "kill")) {
	unlink($_SESSION['user']->pseudo().".txt");
	echo '<div class="fond">DEFAITE</ br>';
	echo '<form action="" method="GET">
  	<input type="submit" value="Retour" name="retour" />
	</form></div>';
}

else if (($adv1->etat() == "kill") && ($adv2->etat() == "kill") && ($adv3->etat() == "kill")) {
	unlink($_SESSION['user']->pseudo().".txt");
	echo '<div class="fond">VICTOIRE</ br>';
	echo '<form action="" method="GET">
  	<input type="submit" value="Retour" name="retour" />
	</form></div>';
}
else
{
///////////////////////////GESTION DES JOUEURS/////////////////////////////////////////////////////
  $jr = [
  	'',
  	$perso1,
		$adv1,
  	$perso2,
		$adv2,
  	$perso3,
  	$adv3,
		$perso4,
		$adv4,
  	$perso5,
		$adv5,
  	$perso6,
  	$adv6
  ];

	$teamA = [
  	$perso1,
  	$perso2,
  	$perso3,
		$perso4,
  	$perso5,
  	$perso6
  ];

	$teamB = [
  	$adv1,
  	$adv2,
  	$adv3,
  	$adv4,
  	$adv5,
  	$adv6
  ];
///////////////////////////GESTION DES TOURS/////////////////////////////////////////////////////

	$i = intval($_SESSION['tr']) +1;

	if ($i == count($jr)) {
		$i = 1;
	}

	$i = verifEtat($jr, $i);

	if (isset($jr[$i])) {
		if ($jr[$i]->timeEndormi() == 1) {
			$jr[$i]->reveil();
			$manager->update($jr[$i]);

			$message = '<p>'.$jr[$i]->nom().' passe son tour</p>';
	    $f = fopen($_SESSION['user']->pseudo().".txt", "a+");
	    fwrite($f,$message);
			fclose($f) ;

			$i++;

			if ($i == count($jr)) {
				$i = 1;
			}
		}
		$jr[$i]->incrementAtout();
		$manager->update($jr[$i]);
	}

	$_SESSION['tr'] = $i;

	if ($i >= (count($jr)-1)) {
		$_SESSION['tr'] = 0;
	}

	if ($i == 1) {
		$_SESSION['tour']++;
	}

?>
<div id="turn">
	<?php
		echo htmlspecialchars($_SESSION['user']->pseudo()).' VS bot<br />';
		echo 'Tour '.$_SESSION['tour'].'<br />';
		echo 'C\'est au tour de '.$jr[$i]->nom().'<br />';
	?>
	<div id="resultat">
	</div>
</div>
<div id="fight">
	<div class="team">
		<div class="line">
			<?php
			afficher_perso($perso4);

			afficher_perso($perso5);

			afficher_perso($perso6);
			?>
		</div>
		<div class="line">
			<?php
			afficher_perso($perso1);

			afficher_perso($perso2);

			afficher_perso($perso3);
			?>
	</div>
	</div>
	<div style="text-align:center" id="chargement">
		<img src="./images/charge.gif" id="charge" />
		<?php
		include("./includes/Function_Gest_Jeu.php");
		?>
	</div>

	<div class="team">
		<div class="line">
			<?php
			afficher_perso($adv1);

			afficher_perso($adv2);

			afficher_perso($adv3);
			?>
		</div>
		<div class="line">
			<?php
			afficher_perso($adv4);

			afficher_perso($adv5);

			afficher_perso($adv6);
			?>
		</div>
	</div>
</div>
<div id="log">
	<?php
	$f = fopen("./logs/".$_SESSION['user']->pseudo().".txt", "a+") ;
	if ($f) {
		$contenu = fgets($f, filesize("./logs/".$_SESSION['user']->pseudo().".txt"));
		echo $contenu;
	}
	fclose($f) ;
	?>
</div>
	<script>
		var textarea = document.getElementById('log');
		textarea.scrollTop = textarea.scrollHeight;
	</script>

	<script>

		$(document).ready(function() {

			if ($('input[name=id1]').val() == "<?= $perso1->id();?>") {
				$('#<?= $perso1->id();?>').fadeTo('fast', 1);
				$('#<?= $perso1->id();?>').animate({
        	height: '130px'
        });
			}
			if ($('input[name=idCible]').val() == "<?= $perso1->id();?>") {
				$('#<?= $perso1->id();?>').fadeTo('fast', 1);
				$('#<?= $perso1->id();?>').animate({
        	height: '130px'
        });
			}
			if ($('input[name=id1]').val() == "<?= $perso2->id();?>") {
				$('#<?= $perso2->id();?>').fadeTo('fast', 1);
				$('#<?= $perso2->id();?>').animate({
        	height: '130px'
        });
			}
			if ($('input[name=idCible]').val() == "<?= $perso2->id();?>") {
				$('#<?= $perso2->id();?>').fadeTo('fast', 1);
				$('#<?= $perso2->id();?>').animate({
        	height: '130px'
        });
			}
			if ($('input[name=id1]').val() == "<?= $perso3->id();?>") {
				$('#<?= $perso3->id();?>').fadeTo('fast', 1);
				$('#<?= $perso3->id();?>').animate({
        	height: '130px'
        });
			}
			if ($('input[name=idCible]').val() == "<?= $perso3->id();?>") {
				$('#<?= $perso3->id();?>').fadeTo('fast', 1);
				$('#<?= $perso3->id();?>').animate({
        	height: '130px'
        });
			}
			if ($('input[name=id1]').val() == "<?= $adv1->id();?>") {
				$('#<?= $adv1->id();?>').fadeTo('fast', 1);
				$('#<?= $adv1->id();?>').animate({
        	height: '130px'
        });
			}
			if ($('input[name=id1]').val() == "<?= $adv2->id();?>") {
				$('#<?= $adv2->id();?>').fadeTo('fast', 1);
				$('#<?= $adv2->id();?>').animate({
        	height: '130px'
        });
			}
			if ($('input[name=id1]').val() == "<?= $adv3->id();?>") {
				$('#<?= $adv3->id();?>').fadeTo('fast', 1);
				$('#<?= $adv3->id();?>').animate({
        	height: '130px'
        });
			}

			$('#<?= $perso1->id();?>').click(function() {
				$('#<?= $perso1->id();?>').fadeTo('fast', 1);
				$('#<?= $perso1->id();?>').animate({
        	height: '130px'
        });
			});
			$('#<?= $perso2->id();?>').click(function() {
				$('#<?= $perso2->id();?>').fadeTo('fast', 1);
				$('#<?= $perso2->id();?>').animate({
        	height: '130px'
        });
			});
			$('#<?= $perso3->id();?>').click(function() {
				$('#<?= $perso3->id();?>').fadeTo('fast', 1);
				$('#<?= $perso3->id();?>').animate({
        	height: '130px'
        });
			});

			$('#<?= $adv1->id();?>').click(function() {
				$('#<?= $adv1->id();?>').fadeTo('fast', 1);
				$('#<?= $adv1->id();?>').animate({
        	height: '130px'
        });
			});
			$('#<?= $adv2->id();?>').click(function() {
				$('#<?= $adv2->id();?>').fadeTo('fast', 1);
				$('#<?= $adv2->id();?>').animate({
        	height: '130px'
        });
			});
			$('#<?= $adv3->id();?>').click(function() {
				$('#<?= $adv3->id();?>').fadeTo('fast', 1);
				$('#<?= $adv3->id();?>').animate({
        	height: '130px'
        });
			});
		});

	</script>
<?php
}
var_dump($teamA);
var_dump($teamB);
?>