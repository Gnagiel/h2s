<!-- <script>
	function attaquant(id1) {
		document.getElementById("id1").value = nom;
	}

	function cible(id) {
		document.getElementById("frapper").value = id;
		document.getElementById("endormir").value = id;
		document.getElementById("soigner").value = id;
		document.getElementById("idCible").value = id;
	}
</script> -->

<?php
function afficher_perso($perso, $teamA, $x, $y) {
	/**
	 * \brief       Afficher un personnage
	 * \details    Génère l'HTML permettant d'afficher un personnage du jeu. (cf #$perso)
	 * \param    $perso         Personnage à afficher.
	 * \return    Un block HTML.
	 */
	 if (isset($perso) && isset($teamA))
	 {
		 if ($perso->pv_fight() != null) {
			 $percent_pv = ($perso->pv_fight() / $perso->pv()) * 100;
		 }

		// if ($perso->atout() == 2) {
		// 	echo '<div class="perso2">';
		// } else {
		// 	echo '<div class="perso">';
		// }
		// if ($perso->timeEndormi() == 1) {
		// 	echo '<span class="info">zZZZz</span><br />';
		// }
		if (($perso->etat() != "kill") && ($perso->pv_fight() != null))
		{
			$nom = str_replace(' ', '_', $perso->nom());
		?>
		<div class="card border rounded center" id="card<?= $perso->id_perso();?>" style="width:150px;height:200px;padding:5px;" data-x="<?=$x?>" data-y="<?=$y?>">

			<img src="./images/perso/<?=$nom?><?= $perso->etoile();?>.jpg" class="avatarC" id="<?= $perso->id_perso();?>"/>
			<div class="card-body">
				<div class="col align-self-center">
					<?php
					if (in_array($perso, $teamA, true))
					{
						?>
						<img class="blast" id="blast<?=$perso->id_perso();?>" src="./images/effects/<?=$perso->type_blast();?>G.gif" style="{width:60px;margin:auto;}" hidden/>
						<?php
					}
					else
					{
						?>
						<img class="blast" id="blast<?=$perso->id_perso();?>" src="./images/effects/<?=$perso->type_blast();?>D.gif" style="{width:60px;margin:auto;}" hidden/>
						<?php
					}
					?>
				</div>
				<div class="sprite" id="sprite<?=$perso->id_perso();?>" hidden></div>
				<div class="progress">


					<div class="progress-bar" id="progress-bar<?=$perso->id_perso()?>"  role="progressbar" style="width:<?=$percent_pv;?>%" aria-valuenow="<?=$perso->pv_fight()?>" aria-valuemin="0" aria-valuemax="<?=$perso->pv()?>"></div>
				</div>
		  </div>
		</div>
		<?php
		}
		else
		{
			?>
			<div class="card" style="width:150px;height:200px;padding:5px;" data-x="<?=$x?>" data-y="<?=$y?>">

			</div>
			<?php
		}
	}
	else {
		?>
		<div class="card" style="width:150px;height:200px;padding:5px;" data-x="<?=$x?>" data-y="<?=$y?>">

		</div>
		<?php
	}

}

function verifEtat($tab, $i) {
	if ($i >= count($tab)) {
		$i = 1;
	}
	if (($tab[$i]->etat() == "kill") || ($tab[$i]->pv_fight() == null)) {
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
	$manager->update($perso1);
	$perso2->debut_combat();
	$manager->update($perso2);
	$perso3->debut_combat();
	$manager->update($perso3);
	$perso4->debut_combat();
	$manager->update($perso4);
	$perso5->debut_combat();
	$manager->update($perso5);
	$perso6->debut_combat();
	$manager->update($perso6);
	$adv1->debut_combat();
	$manager->update($adv1);
	$adv2->debut_combat();
	$manager->update($adv2);
	$adv3->debut_combat();
	$manager->update($adv3);
	$adv4->debut_combat();
	$manager->update($adv4);
	$adv5->debut_combat();
	$manager->update($adv5);
	$adv6->debut_combat();
	$manager->update($adv6);
  $f = fopen("./logs/".$_SESSION['user']->pseudo().".txt", "a+");
  $message = " ";
  fwrite($f,$message);
	fclose($f);
}
//var_dump($perso1);
if (($perso1->etat() == "kill") && ($perso2->etat() == "kill")
&& ($perso3->etat() == "kill") && ($perso4->etat() == "kill") &&
($perso5->etat() == "kill") && ($perso6->etat() == "kill")
||
($perso1->pv_fight() == null) && ($perso2->pv_fight() == null)
&& ($perso3->pv_fight() == null) && ($perso4->pv_fight() == null) &&
($perso5->pv_fight() == null) && ($perso6->pv_fight() == null)) {
	unlink("./logs/".$_SESSION['user']->pseudo().".txt");
	echo '<div class="fond">DEFAITE</ br>';
	echo '<form action="" method="GET">
  	<input type="submit" value="Retour" name="retour" />
	</form></div>';
}

else if (($adv1->etat() == "kill") && ($adv2->etat() == "kill")
&& ($adv3->etat() == "kill") && ($adv4->etat() == "kill") &&
($adv5->etat() == "kill") && ($adv6->etat() == "kill")
||
($adv1->pv_fight() == null) && ($adv2->pv_fight() == null)
&& ($adv3->pv_fight() == null) && ($adv4->pv_fight() == null) &&
($adv5->pv_fight() == null) && ($adv6->pv_fight() == null)) {
	unlink("./logs/".$_SESSION['user']->pseudo().".txt");
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
	$i = (int)$_SESSION['tr'] +1;

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

		echo $jr[$i]->atout();
		$manager->update($jr[$i]);
	}
	else {
		$i = 1;
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
		echo htmlspecialchars($_SESSION['user']->pseudo()).' VS bot. '.$i.'<br />';
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
			echo "<div class='emp_perso'>";
			afficher_perso($perso4, $teamA, -2, 0);
			echo "</div>";
			echo "<div class='emp_perso'>";
			afficher_perso($perso5, $teamA, -2, 1);
			echo "</div>";
			echo "<div class='emp_perso'>";
			afficher_perso($perso6, $teamA, -2, 2);
			echo "</div>";
			?>
		</div>
		<div class="line">
			<?php
			echo "<div class='emp_perso'>";
			afficher_perso($perso1, $teamA, -1, 0);
			echo "</div>";
			echo "<div class='emp_perso'>";
			afficher_perso($perso2, $teamA, -1, 1);
			echo "</div>";
			echo "<div class='emp_perso'>";
			afficher_perso($perso3, $teamA, -1, 2);
			echo "</div>";
			?>
	</div>
	</div>
	<div class="line">
		<?php
		echo "<div class='emp_perso'>";
		afficher_perso(@$a, @$b, 0, 0);
		echo "</div>";
		echo "<div class='emp_perso'>";
		afficher_perso(@$a, @$b, 0, 1);
		echo "</div>";
		echo "<div class='emp_perso'>";
		afficher_perso(@$a, @$b, 0, 2);
		echo "</div>";
		?>
</div>

	<div class="team">
		<div class="line">
			<?php
			echo "<div class='emp_perso'>";
			afficher_perso($adv1, $teamA, 1, 0);
			echo "</div>";
			echo "<div class='emp_perso'>";
			afficher_perso($adv2, $teamA, 1, 1);
			echo "</div>";
			echo "<div class='emp_perso'>";
			afficher_perso($adv3, $teamA, 1, 2);
			echo "</div>";
			?>
		</div>
		<div class="line">
			<?php
			echo "<div class='emp_perso'>";
			afficher_perso($adv4, $teamA, 2, 0);
			echo "</div>";
			echo "<div class='emp_perso'>";
			afficher_perso($adv5, $teamA, 2, 1);
			echo "</div>";
			echo "<div class='emp_perso'>";
			afficher_perso($adv6, $teamA, 2, 2);
			echo "</div>";
			?>
		</div>
	</div>
</div>
<div style="text-align:center" id="chargement">
	<?php
	include("./includes/Function_Gest_Jeu.php");
	?>
</div>
<?php
var_dump($_SESSION);
 ?>
<!-- <img id="blastG" src="./images/effects/blastG.gif"/> -->
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
			function couleur_perso(id) {
				if (id == $('input[name=id1]').val()) {
					if ($("#atout").val() == 3) {
						$('#card'+id).css("background-color","red");
					}
					else {
						$('#card'+id).css("background-color","blue");
					}
				}
				else if (id == $('input[name=idCible]').val()) {
					$('#card'+id).css("background-color","grey");
				}
			}

			couleur_perso($('input[name=id1]').val());
			couleur_perso($('input[name=idCible]').val());
		});
	</script>
<?php
}
?>
