<?php
/**
 * \file          stuff_modal.php
 * \author    Guillaume Nagiel
 * \version   1.0
 * \date       26 Janvier 2018
 * \brief       Modal de gestion d'un équipement.
 *
 * \details    Ce fichier est un modal gérant les fonctionnalités d'un équipement en particulier. Il est appelé par le fichier stuff.php.
 */
 ?>
 <div class="modal">
<?php


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

	<div class="stuff_up"	>
		<?=$stuff->nom()?><br />
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
	</div>
<?=var_dump($stuff);?>
</div>
