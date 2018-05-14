<?php
/**
 * \file          modif_team.php
 * \author    Guillaume Nagiel
 * \version   1.0
 * \date       26 Janvier 2018
 * \brief       Menu cheat de la team.
 *
 * \details    Ce fichier est le menu cheat de la team, ce menu permet de cheater afin de tester toutes les fonctionnalités concernant votre équipe.
 */

/**
* \code{.php}
*/
?>
<div>
	<div class="list_cheat">
	<?php
	$tab = $manager->getListCheat();

	foreach ($tab as $persos)
	{
	?>

		<div class='list_cheat_perso'>
			<?= htmlspecialchars($persos->nom());?><br />
			<span>PV </span><?= htmlspecialchars($persos->pv());?><br />
			<span>ATT </span><?= htmlspecialchars($persos->att());?><br /><br />
			<form class="add_perso" method="POST" action="index.php?action=cheat">
				<input type="hidden" name="id_user" value="<?=$user->id_user();?>" />
				<input type="hidden" name="id_perso" value="<?=$persos->id_persos();?>" />
				<input type="submit" value="+" />
			</form>
		</div>

<?php
//var_dump($persos);
//$manager->add($persos, $user);
}
?>
</div>

<br /><br /><br /><br />

<div class="container-fluid mtb-margin-top">
	<div class="row">
		<div class="col-md-12">
			Liste de vos personnages
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?php
			/*How many records you want to show in a single page.*/
			$limit = 4;
			/*How may adjacent page links should be shown on each side of the current page link.*/
			$adjacents = 2;
			/*Get total number of records */
			$total_rows = count($perso);
			/*Get the total number of pages.*/
			$total_pages = ceil($total_rows / $limit);


			if(isset($_GET['page']) && $_GET['page'] != "") {
				$page = $_GET['page'];
				$offset = $limit * ($page-1);
			} else {
				$page = 1;
				$offset = 0;
			}
			?>
			<div class="list_cheat">
			<?php
			$perso = $manager->getListPage($user, $offset, $limit);
			foreach ($perso as $persos)
			{
			?>

				<div class="perso_menu">
			    <?= htmlspecialchars($persos->nom()).' (Niv'.htmlspecialchars($persos->niveau()).')' ?><br /><br />
				  <form class="sup_perso" method="POST" action="index.php?action=cheat">
						<input type="hidden" name="id_perso" value="<?=$persos->id_perso();?>" />
						<input type="submit" value="-" />
					</form><br />
			    <div class="sous_menu">
			      <div>
				      <div class="perso_sous_menu"><span>PV</span><?= htmlspecialchars($persos->pv()) ?><br /></div>
				      <div class="perso_sous_menu"><span>DEF</span><?= htmlspecialchars($persos->def()) ?><br /></div>
				      <div class="perso_sous_menu"><span>Pen</span><?= htmlspecialchars($persos->pen()) ?><br /></div>
				      <div class="perso_sous_menu"><span>PRE</span><?= htmlspecialchars($persos->pre()) ?><br /></div>
				      <div class="perso_sous_menu"><span>CRIT</span><?= htmlspecialchars($persos->crit()) ?><br /></div>
				      <div class="perso_sous_menu"><span>SOI</span><?= htmlspecialchars($persos->soi()) ?><br /></div>
			      </div>
			      <div>
				      <div class="perso_sous_menu"><span>ATT</span><?= htmlspecialchars($persos->att()) ?><br /></div>
				      <div class="perso_sous_menu"><span>VIT</span><?= htmlspecialchars($persos->vit()) ?><br /></div>
				      <div class="perso_sous_menu"><span>Arm</span><?= htmlspecialchars($persos->arm()) ?><br /></div>
				      <div class="perso_sous_menu"><span>ESQ</span><?= htmlspecialchars($persos->esc()) ?><br /></div>
				      <div class="perso_sous_menu"><span>TEN</span><?= htmlspecialchars($persos->ten()) ?><br /></div>
			      </div>
			    </div>
			  </div>
			<?php
			}
			?>
		</div><br />
			<?php

			//Checking if the adjacent plus current page number is less than the total page number.
			//If small then page link start showing from page 1 to upto last page.
			if($total_pages <= (1+($adjacents * 2))) {
				$start = 1;
				$end   = $total_pages;
			} else {
				if(($page - $adjacents) > 1) {				   //Checking if the current page minus adjacent is greateer than one.
					if(($page + $adjacents) < $total_pages) {  //Checking if current page plus adjacents is less than total pages.
						$start = ($page - $adjacents);         //If true, then we will substract and add adjacent from and to the current page number
						$end   = ($page + $adjacents);         //to get the range of the page numbers which will be display in the pagination.
					} else {								   //If current page plus adjacents is greater than total pages.
						$start = ($total_pages - (1+($adjacents*2)));  //then the page range will start from total pages minus 1+($adjacents*2)
						$end   = $total_pages;						   //and the end will be the last page number that is total pages number.
					}
				} else {									   //If the current page minus adjacent is less than one.
					$start = 1;                                //then start will be start from page number 1
					$end   = (1+($adjacents * 2));             //and end will be the (1+($adjacents * 2)).
				}
			}
			//If you want to display all page links in the pagination then
			//uncomment the following two lines
			//and comment out the whole if condition just above it.
			/*$start = 1;
			$end = $total_pages;*/
			?>

			<?php if($total_pages > 1) { ?>
				<ul class="pagination pagination-sm justify-content-center">
					<!-- Link of the first page -->
					<li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
						<a class='page-link' href='index.php?action=cheat&page=1'>&lt;&lt;</a>
					</li>
					<!-- Link of the previous page -->
					<li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
						<a class='page-link' href='index.php?action=cheat&page=<?php ($page>1 ? print($page-1) : print 1)?>'>&lt;</a>
					</li>
					<!-- Links of the pages with page number -->
					<?php for($i=$start; $i<=$end; $i++) { ?>
					<li class='page-item <?php ($i == $page ? print 'active' : '')?>'>
						<a class='page-link' href='index.php?action=cheat&page=<?php echo $i;?>'><?php echo $i;?></a>
					</li>
					<?php } ?>
					<!-- Link of the next page -->
					<li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
						<a class='page-link' href='index.php?action=cheat&page=<?php ($page < $total_pages ? print($page+1) : print $total_pages)?>'>&gt;</a>
					</li>
					<!-- Link of the last page -->
					<li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
						<a class='page-link' href='index.php?action=cheat&page=<?php echo $total_pages;?>'>&gt;&gt;</a>
					</li>
				</ul>
			<?php } ?>
		</div>
	</div>
</div>
</div>
