<?php
// Gestion des persos sauf healers

for ($j = 0; $j < count($teamA); $j++) {
	if ($jr[$i]->types() != "soigneur") {
		if ($teamA[$j]->id_perso() == $jr[$i]->id_perso()) {
			if ($jr[$i]->id_perso() == $perso1->id_perso()) {
	  		if ($teamB[0]->etat() == "good" && $teamB[0]->pv_fight() != null)
				{
					$id = $teamB[0]->id_perso();
				}
				else if ($teamB[1]->etat() == "good" && $teamB[1]->pv_fight() != null)
				{
					$id = $teamB[1]->id_perso();
				}
				else if ($teamB[2]->etat() == "good" && $teamB[2]->pv_fight() != null)
				{
					$id = $teamB[2]->id_perso();
				}
				else if ($teamB[3]->etat() == "good" && $teamB[3]->pv_fight() != null)
				{
					$id = $teamB[3]->id_perso();
				}
				else if ($teamB[4]->etat() == "good" && $teamB[4]->pv_fight() != null)
				{
					$id = $teamB[4]->id_perso();
				}
				else if ($teamB[5]->etat() == "good" && $teamB[5]->pv_fight() != null)
				{
					$id = $teamB[5]->id_perso();
				}
			}
			elseif ($jr[$i]->id_perso() == $perso2->id_perso()) {
	  		if ($teamB[1]->etat() == "good" && $teamB[1]->pv_fight() != null)
				{
					$id = $teamB[1]->id_perso();
				}
				else if ($teamB[0]->etat() == "good" && $teamB[0]->pv_fight() != null)
				{
					$id = $teamB[0]->id_perso();
				}
				else if ($teamB[2]->etat() == "good" && $teamB[2]->pv_fight() != null)
				{
					$id = $teamB[2]->id_perso();
				}
				else if ($teamB[4]->etat() == "good" && $teamB[4]->pv_fight() != null)
				{
					$id = $teamB[4]->id_perso();
				}
				else if ($teamB[3]->etat() == "good" && $teamB[3]->pv_fight() != null)
				{
					$id = $teamB[3]->id_perso();
				}
				else if ($teamB[5]->etat() == "good" && $teamB[5]->pv_fight() != null)
				{
					$id = $teamB[5]->id_perso();
				}
			}
			elseif ($jr[$i]->id_perso() == $perso3->id_perso()) {
	  		if ($teamB[2]->etat() == "good" && $teamB[2]->pv_fight() != null)
				{
					$id = $teamB[2]->id_perso();
				}
				else if ($teamB[1]->etat() == "good" && $teamB[1]->pv_fight() != null)
				{
					$id = $teamB[1]->id_perso();
				}
				else if ($teamB[0]->etat() == "good" && $teamB[0]->pv_fight() != null)
				{
					$id = $teamB[0]->id_perso();
				}
				else if ($teamB[5]->etat() == "good" && $teamB[5]->pv_fight() != null)
				{
					$id = $teamB[5]->id_perso();
				}
				else if ($teamB[4]->etat() == "good" && $teamB[4]->pv_fight() != null)
				{
					$id = $teamB[4]->id_perso();
				}
				else if ($teamB[3]->etat() == "good" && $teamB[3]->pv_fight() != null)
				{
					$id = $teamB[3]->id_perso();
				}
			}
			else if ($jr[$i]->id_perso() == $perso4->id_perso()) {
				if ($teamB[0]->etat() == "good" && $teamB[0]->pv_fight() != null)
				{
					$id = $teamB[0]->id_perso();
				}
				else if ($teamB[1]->etat() == "good" && $teamB[1]->pv_fight() != null)
				{
					$id = $teamB[1]->id_perso();
				}
				else if ($teamB[2]->etat() == "good" && $teamB[2]->pv_fight() != null)
				{
					$id = $teamB[2]->id_perso();
				}
				else if ($teamB[3]->etat() == "good" && $teamB[3]->pv_fight() != null)
				{
					$id = $teamB[3]->id_perso();
				}
				else if ($teamB[4]->etat() == "good" && $teamB[4]->pv_fight() != null)
				{
					$id = $teamB[4]->id_perso();
				}
				else if ($teamB[5]->etat() == "good" && $teamB[5]->pv_fight() != null)
				{
					$id = $teamB[5]->id_perso();
				}
			}
			elseif ($jr[$i]->id_perso() == $perso5->id_perso()) {
				if ($teamB[1]->etat() == "good" && $teamB[1]->pv_fight() != null)
				{
					$id = $teamB[1]->id_perso();
				}
				else if ($teamB[0]->etat() == "good" && $teamB[0]->pv_fight() != null)
				{
					$id = $teamB[0]->id_perso();
				}
				else if ($teamB[2]->etat() == "good" && $teamB[2]->pv_fight() != null)
				{
					$id = $teamB[2]->id_perso();
				}
				else if ($teamB[4]->etat() == "good" && $teamB[4]->pv_fight() != null)
				{
					$id = $teamB[4]->id_perso();
				}
				else if ($teamB[3]->etat() == "good" && $teamB[3]->pv_fight() != null)
				{
					$id = $teamB[3]->id_perso();
				}
				else if ($teamB[5]->etat() == "good" && $teamB[5]->pv_fight() != null)
				{
					$id = $teamB[5]->id_perso();
				}
			}
			elseif ($jr[$i]->id_perso() == $perso6->id_perso()) {
				if ($teamB[2]->etat() == "good" && $teamB[2]->pv_fight() != null)
				{
					$id = $teamB[2]->id_perso();
				}
				else if ($teamB[1]->etat() == "good" && $teamB[1]->pv_fight() != null)
				{
					$id = $teamB[1]->id_perso();
				}
				else if ($teamB[0]->etat() == "good" && $teamB[0]->pv_fight() != null)
				{
					$id = $teamB[0]->id_perso();
				}
				else if ($teamB[5]->etat() == "good" && $teamB[5]->pv_fight() != null)
				{
					$id = $teamB[5]->id_perso();
				}
				else if ($teamB[4]->etat() == "good" && $teamB[4]->pv_fight() != null)
				{
					$id = $teamB[4]->id_perso();
				}
				else if ($teamB[3]->etat() == "good" && $teamB[3]->pv_fight() != null)
				{
					$id = $teamB[3]->id_perso();
				}
			}
		}
		else {
			if ($jr[$i]->id_perso() == $adv1->id_perso()) {
	  		if ($teamA[0]->etat() == "good" && $teamA[0]->pv_fight() != null)
				{
					$id = $teamA[0]->id_perso();
				}
				else if ($teamA[1]->etat() == "good" && $teamA[1]->pv_fight() != null)
				{
					$id = $teamA[1]->id_perso();
				}
				else if ($teamA[2]->etat() == "good" && $teamA[2]->pv_fight() != null)
				{
					$id = $teamA[2]->id_perso();
				}
				else if ($teamA[3]->etat() == "good" && $teamA[3]->pv_fight() != null)
				{
					$id = $teamA[3]->id_perso();
				}
				else if ($teamA[4]->etat() == "good" && $teamA[4]->pv_fight() != null)
				{
					$id = $teamA[4]->id_perso();
				}
				else if ($teamA[5]->etat() == "good" && $teamA[5]->pv_fight() != null)
				{
					$id = $teamA[5]->id_perso();
				}
			}
			elseif ($jr[$i]->id_perso() == $adv2->id_perso()) {
	  		if ($teamA[1]->etat() == "good" && $teamA[1]->pv_fight() != null)
				{
					$id = $teamA[1]->id_perso();
				}
				else if ($teamA[0]->etat() == "good" && $teamA[0]->pv_fight() != null)
				{
					$id = $teamA[0]->id_perso();
				}
				else if ($teamA[2]->etat() == "good" && $teamA[2]->pv_fight() != null)
				{
					$id = $teamA[2]->id_perso();
				}
				else if ($teamA[4]->etat() == "good" && $teamA[4]->pv_fight() != null)
				{
					$id = $teamA[4]->id_perso();
				}
				else if ($teamA[3]->etat() == "good" && $teamA[3]->pv_fight() != null)
				{
					$id = $teamA[3]->id_perso();
				}
				else if ($teamA[5]->etat() == "good" && $teamA[5]->pv_fight() != null)
				{
					$id = $teamA[5]->id_perso();
				}
			}
			elseif ($jr[$i]->id_perso() == $adv3->id_perso()) {
	  		if ($teamA[2]->etat() == "good" && $teamA[2]->pv_fight() != null)
				{
					$id = $teamA[2]->id_perso();
				}
				else if ($teamA[1]->etat() == "good" && $teamA[1]->pv_fight() != null)
				{
					$id = $teamA[1]->id_perso();
				}
				else if ($teamA[0]->etat() == "good" && $teamA[0]->pv_fight() != null)
				{
					$id = $teamA[0]->id_perso();
				}
				else if ($teamA[5]->etat() == "good" && $teamA[5]->pv_fight() != null)
				{
					$id = $teamA[5]->id_perso();
				}
				else if ($teamA[4]->etat() == "good" && $teamA[4]->pv_fight() != null)
				{
					$id = $teamA[4]->id_perso();
				}
				else if ($teamA[3]->etat() == "good" && $teamA[3]->pv_fight() != null)
				{
					$id = $teamA[3]->id_perso();
				}
			}
			else if ($jr[$i]->id_perso() == $adv4->id_perso()) {
	  		if ($teamA[0]->etat() == "good" && $teamA[0]->pv_fight() != null)
				{
					$id = $teamA[0]->id_perso();
				}
				else if ($teamA[1]->etat() == "good" && $teamA[1]->pv_fight() != null)
				{
					$id = $teamA[1]->id_perso();
				}
				else if ($teamA[2]->etat() == "good" && $teamA[2]->pv_fight() != null)
				{
					$id = $teamA[2]->id_perso();
				}
				else if ($teamA[3]->etat() == "good" && $teamA[3]->pv_fight() != null)
				{
					$id = $teamA[3]->id_perso();
				}
				else if ($teamA[4]->etat() == "good" && $teamA[4]->pv_fight() != null)
				{
					$id = $teamA[4]->id_perso();
				}
				else if ($teamA[5]->etat() == "good" && $teamA[5]->pv_fight() != null)
				{
					$id = $teamA[5]->id_perso();
				}
			}
			elseif ($jr[$i]->id_perso() == $adv5->id_perso()) {
	  		if ($teamA[1]->etat() == "good" && $teamA[1]->pv_fight() != null)
				{
					$id = $teamA[1]->id_perso();
				}
				else if ($teamA[0]->etat() == "good" && $teamA[0]->pv_fight() != null)
				{
					$id = $teamA[0]->id_perso();
				}
				else if ($teamA[2]->etat() == "good" && $teamA[2]->pv_fight() != null)
				{
					$id = $teamA[2]->id_perso();
				}
				else if ($teamA[4]->etat() == "good" && $teamA[4]->pv_fight() != null)
				{
					$id = $teamA[4]->id_perso();
				}
				else if ($teamA[3]->etat() == "good" && $teamA[3]->pv_fight() != null)
				{
					$id = $teamA[3]->id_perso();
				}
				else if ($teamA[5]->etat() == "good" && $teamA[5]->pv_fight() != null)
				{
					$id = $teamA[5]->id_perso();
				}
			}
			elseif ($jr[$i]->id_perso() == $adv6->id_perso()) {
	  		if ($teamA[2]->etat() == "good" && $teamA[2]->pv_fight() != null)
				{
					$id = $teamA[2]->id_perso();
				}
				else if ($teamA[1]->etat() == "good" && $teamA[1]->pv_fight() != null)
				{
					$id = $teamA[1]->id_perso();
				}
				else if ($teamA[0]->etat() == "good" && $teamA[0]->pv_fight() != null)
				{
					$id = $teamA[0]->id_perso();
				}
				else if ($teamA[5]->etat() == "good" && $teamA[5]->pv_fight() != null)
				{
					$id = $teamA[5]->id_perso();
				}
				else if ($teamA[4]->etat() == "good" && $teamA[4]->pv_fight() != null)
				{
					$id = $teamA[4]->id_perso();
				}
				else if ($teamA[3]->etat() == "good" && $teamA[3]->pv_fight() != null)
				{
					$id = $teamA[3]->id_perso();
				}
			}
		}
	}
	// Gestion des healers
	else if ($jr[$i]->types() == "soigneur")
	{
		if ($teamA[$j]->id_perso() == $jr[$i]->id_perso())
		{
			$persoAsoigner = $teamA[$j];
			for ($x = 0; $x < count($teamA); $x++) {
				if ($teamA[$x]->etat() == "good" && $teamA[$x]->pv_fight() != null)
				{
					if ($persoAsoigner->pv_fight() > $teamA[$x]->pv_fight())
					{
						$persoAsoigner = $teamA[$x];
					}
				}
			}
			$id = $persoAsoigner->id_perso();
		}
		else {
			$persoAsoigner = $teamB[$j];
			for ($y = 0; $y < count($teamB); $y++)
			{
				if ($teamB[$y]->etat() == "good" && $teamB[$y]->pv_fight() != null)
				{
					if ($persoAsoigner->pv_fight() > $teamB[$y]->pv_fight())
					{
						$persoAsoigner = $teamB[$y];
					}
				}
			}
			$id = $persoAsoigner->id_perso();
		}
	}
}
?>
<form id="formId" method="GET">
	<input type="hidden" id="idUser" name="idUser" value="<?= $_GET['idUser'];?>"/>
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
		if ($("#type").val() == 'soigneur') {
			$("#submit")
				.attr("class","heal")
				.attr("name",'heal')
				.attr("value",'Soigner');
			$("#action").attr("value","soigner");
		}

		if ($("#atout").val() == 2) {
			alert('super coup');
		}
	});

	$( document ).ajaxStart(function() {
		$( "#charge" ).show();
	});

	$( document ).ajaxStop(function() {
		$( "#charge" ).hide();
	});

	function submitForm() {
	 $("#submit").click();
	}
	setTimeout("submitForm()",1*500);
</script>
