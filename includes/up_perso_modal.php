<?php
/**
 * \file          /includes/up_perso_modal.php
 * \author    Guillaume Nagiel
 * \version   1.0
 * \date       26 Janvier 2018
 * \brief       Modal permettant la selection des personnages à sacrifier pour en up un autre.
 *
 * \details    Ce modal permet la selection des personnages à sacrifier pour en up un autre. Il est appelé par le fichier up_perso.php.
 */

 /**
* \code{.php}
*/
function chargerClasse($classe)
{
  require '../class/'.$classe . '.php';
}

spl_autoload_register('chargerClasse');

session_start();

include("identifiant.php");

$manager = new PersonnagesManager($db);
$perso = $manager->get($_GET["id_perso"]);
$persos = $manager->getList_up($_SESSION['user'], $perso);
?>
<div class="modal fade">
	<div class="modal-dialog" role="document">
    <div class="modal-content">
			<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Qui sacrifiez-vous ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
			<div class="modal-body">
		  	<form action="index.php" id="tab_persos" method="POST">
		  		<?php
		  		foreach ($persos as $persos)
		  			{
		  			?>
		  			<input type="checkbox" name="tab[]" value="<?=$persos->id_perso();?>" />
		  				<div class='list_cheat_perso' style="background-image: url('./images/perso/<?=$persos->nom();?><?=$persos->etoile();?>.jpg');background-repeat: no-repeat;background-size: 30%;">
		  					<?= htmlspecialchars($persos->nom());?> lvl <?= htmlspecialchars($persos->niveau());?><br />
		  						<span>PV </span><?= htmlspecialchars($persos->pv());?><br />
		  						<span>ATT </span><?= htmlspecialchars($persos->att());?><br /><br />
		  				</div>
		  			<?php
		  			}
		  		?>
					<button type="button" class="btn btn-primary btn_valid_up" name="btn_valid_up" value="<?=$perso->id_perso()?>">Sacrifier</button>
		  	</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
	  </div>
	</div>
</div>
