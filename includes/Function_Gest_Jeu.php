<?php
// Gestion des persos sauf healers

for ($j = 0; $j < count($teamA); $j++) {
	if ($jr[$i]->types() != "monk") {
		if ($teamA[$j]->id_perso() == $jr[$i]->id_perso()) {
			if ($jr[$i]->id_perso() == $perso1->id_perso()) {
	  		if ($teamB[0]->etat() == "good")
				{
					$id = $teamB[0]->id_perso();
				}
				else if ($teamB[1]->etat() == "good")
				{
					$id = $teamB[1]->id_perso();
				}
				else if ($teamB[2]->etat() == "good")
				{
					$id = $teamB[2]->id_perso();
				}
			}
			elseif ($jr[$i]->id_perso() == $perso2->id_perso()) {
	  		if ($teamB[1]->etat() == "good")
				{
					$id = $teamB[1]->id_perso();
				}
				else if ($teamB[0]->etat() == "good")
				{
					$id = $teamB[0]->id_perso();
				}
				else if ($teamB[2]->etat() == "good")
				{
					$id = $teamB[2]->id_perso();
				}
			}
			elseif ($jr[$i]->id_perso() == $perso3->id_perso()) {
	  		if ($teamB[2]->etat() == "good")
				{
					$id = $teamB[2]->id_perso();
				}
				else if ($teamB[1]->etat() == "good")
				{
					$id = $teamB[1]->id_perso();
				}
				else if ($teamB[0]->etat() == "good")
				{
					$id = $teamB[0]->id_perso();
				}
			}
		}
		else {
			if ($jr[$i]->id_perso() == $adv1->id_perso()) {
	  		if ($teamA[0]->etat() == "good")
				{
					$id = $teamA[0]->id_perso();
				}
				else if ($teamA[1]->etat() == "good")
				{
					$id = $teamA[1]->id_perso();
				}
				else if ($teamA[2]->etat() == "good")
				{
					$id = $teamA[2]->id_perso();
				}
			}
			elseif ($jr[$i]->id_perso() == $adv2->id_perso()) {
	  		if ($teamA[1]->etat() == "good")
				{
					$id = $teamA[1]->id_perso();
				}
				else if ($teamA[0]->etat() == "good")
				{
					$id = $teamA[0]->id_perso();
				}
				else if ($teamA[2]->etat() == "good")
				{
					$id = $teamA[2]->id_perso();
				}
			}
			elseif ($jr[$i]->id_perso() == $adv3->id_perso()) {
	  		if ($teamA[2]->etat() == "good")
				{
					$id = $teamA[2]->id_perso();
				}
				else if ($teamA[1]->etat() == "good")
				{
					$id = $teamA[1]->id_perso();
				}
				else if ($teamA[0]->etat() == "good")
				{
					$id = $teamA[0]->id_perso();
				}
			}
		}
	}
	// Gestion des healers
	else if ($jr[$i]->type() == "monk"){
		$teamAsort = [];
		$teamBsort = [];
		if ($teamA[$j]->id_perso() == $jr[$i]->id_perso()) {
			for ($x = 0; $x < count($teamA); $x++) {
				if ($teamA[$x]->etat() == "good") {
					$pers = array(
		        'id_perso' => $teamA[$x]->id_perso(),
		        'vie' => $teamA[$x]->vie()
			  	);
					$teamAsort[count($teamAsort)] = $pers;
				}
			}
			usort($teamAsort, 'fonctionComparaison');
			$id = $teamAsort[0]['id_perso'];
		}
		else {
			for ($y = 0; $y < count($teamB); $y++) {
				if ($teamB[$y]->etat() == "good") {
					$pers = array(
		        'id_perso' => $teamB[$y]->id_perso(),
		        'vie' => $teamB[$y]->vie()
			  	);
					$teamBsort[count($teamBsort)] = $pers;
				}
			}
			usort($teamBsort, 'fonctionComparaison');
			$id = $teamBsort[0]['id_perso'];
		}
	}
}
?>
<form id="formId" method="GET">
	<input type="hidden" id="id" name="id" value="<?= $_SESSION['idAdv']->id_user();?>"/>
	<input type="hidden" id="user" name="user" value="<?= $user->id_user();?>"/>
	<input type="hidden" id="idCible" name="idCible" value="<?= $id;?>"/>
	<input type="hidden" id="action" name="action" value="frapper" />
	<input type="hidden" id="atout" name="atout" value="<?=$jr[$i]->atout();?>" />
	<input type="hidden" id="type" name="types" value="<?= $jr[$i]->types();?>"/>
	<input type="hidden" id="id1" name="id1" value="<?= $jr[$i]->id_perso();?>"/>
	<input type="button" class="submitf" name="submitf" id="submit" value="Frapper"/><br />
</form>

<script language="JavaScript" type="text/JavaScript">
	$(document).ready(function(){
		if ($("#type").val() == 'monk') {
				$("#submit")
					.attr("class","heal")
					.attr("name",'heal')
					.attr("value",'Soigner');

			$("#action").attr("value","soigner");
		}

		if ($("#atout").val() == 2) {
			if ($("#type").val() == 'magicien') {
				$("#submit")
					.attr("class","submite")
					.attr("name","submite")
					.attr("value",'Endormir');

				$("#action").attr("value","endormir");
			}
		}
	});

	function submitForm() {
	 $("#submit").click();
	}
	setTimeout("submitForm()",2*1000);
</script>
