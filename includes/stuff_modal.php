<?php
/**
 * \file          stuff_modal.php
 * \author    Guillaume Nagiel
 * \version   1.0
 * \date       26 Janvier 2018
 * \brief       Modal de gestion d'un équipement.
 * \todo Implémenter la fonctionnalité pour up plusieurs niveaux
 * \details    Ce fichier est un modal gérant les fonctionnalités d'un équipement en particulier. Il est appelé par le fichier stuff.php.
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
	$managerStuff = new StuffManager($db);

	$stuff = $managerStuff->get($_GET["id_stuff"]);
	?>
<div class="modal fade">
	<div class="modal-dialog" role="document">
    <div class="modal-content">
			<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><?=$stuff->nom()?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
			<div class="modal-body">
				<div class="stuff_up">
					<img src="./images/stuff/<?=$stuff->nom();?>.jpg" class='img_stuff'/><br />
					<div class="sous_menu">
			      <div>
				      <div class="perso_sous_menu">lvl <span class="stuff<?=$stuff->id_stuff()?>"><?=$stuff->niveau()?></span><br /></div>
				    </div>
			      <div>
				      <div class="perso_sous_menu"><span>lvl</span><?=$stuff->niveau()?><br /></div>
				    </div>
					</div>
					<div class="sous_menu">
			      <div>
				      <div class="perso_sous_menu"><span>Cout</span><?=$stuff->cout()?><br /></div>
				    </div>
			      <div>
				      <div class="perso_sous_menu"><br /></div>
				    </div>
					</div>
					<div class="sous_menu">
			      <div>
			      	<form id="stuff_up<?=$_GET["id_stuff"];?>">
			      		<input type="hidden" name="id_stuff" class="id_stuff" value="<?=$_GET["id_stuff"];?>"/>
			      		<input type="hidden" name="id_perso" class="id_perso" value="<?=$_GET["id_perso"];?>"/>
			      	</form>
				      <div class="perso_sous_menu"><button type="submit" class="btn_up" name="btn_up" value="<?=$_GET["id_stuff"];?>">Améliorer</button><br /></div>
				    </div>
			      <div>
				      <div class="perso_sous_menu"><button type="submit" class="btn_up" name="btn_up_all" value="up_all">Tout améliorer</button><br /></div>

				    </div>
					</div>
					<?=var_dump($stuff);?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<!--<button type="button" class="btn btn-primary">Save changes</button>-->
			</div>
		</div>
	</div>
</div>
