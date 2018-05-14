<?php
/**
 * \file          /includes/up_perso.php
 * \author    Guillaume Nagiel
 * \version   1.0
 * \date       26 Janvier 2018
 * \brief       Menu d'amélioreration des personnages.
 * \todo Gérer les attribut du perso selon son niveau.
 * \todo Implémenter la fonction d'upgrade de qualité.
 * \details    Ce menu permet d'améliorer ses personnages, en sacrifiant des persos inutiles.
 */

/**
* \code{.php}
*/
echo '<div id="team">';
foreach ($perso as $persos)
{

	if ($persos->xp() != 0 && $persos->xp_max() != 0)
	{
		$level = (($persos->xp() - $persos->xp_min()) / ($persos->xp_max() - $persos->xp_min())) * 100;
	}
	else
	{
		$level = 0;
	}
	?>
	<div class="affiche_stuff">
		<div class="perso_menu" id="<?=$persos->nom();?><?=$persos->id_perso();?>">
			<a href="./includes/up_perso_modal.php?id_perso=<?=$persos->id_perso()?>" class="manual-ajax" >
	    <?= htmlspecialchars($persos->nom());?> (Niv <span id="lvl<?=$persos->id_perso();?>" ><?=htmlspecialchars($persos->niveau());?></span>)<br />
			<br />
			<div class="progress">
			  <div class="progress-bar" id="progress-bar<?=$persos->id_perso()?>" style="width: <?=$level?>%" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="<?=$persos->xp_max()?>"></div>
			</div>
			<br />
	    <div class="sous_menu">
	      <div>
		      <div class="perso_sous_menu"><span>PV</span><span class="pv<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->pv()) ?></span><br /></div>
		      <div class="perso_sous_menu"><span>DEF</span><span class="def<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->def()) ?></span><br /></div>
		      <div class="perso_sous_menu"><span>Pen</span><span class="pen<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->pen()) ?></span><br /></div>
		      <div class="perso_sous_menu"><span>PRE</span><span class="pre<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->pre()) ?></span><br /></div>
		      <div class="perso_sous_menu"><span>CRIT</span><span class="crit<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->crit()) ?></span><br /></div>
		      <div class="perso_sous_menu"><span>SOI</span><span class="soi<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->soi()) ?></span><br /></div>
	      </div>
	      <div>
		      <div class="perso_sous_menu"><span>ATT</span><span class="att<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->att()) ?></span><br /></div>
		      <div class="perso_sous_menu"><span>VIT</span><span class="vit<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->vit()) ?></span><br /></div>
		      <div class="perso_sous_menu"><span>Arm</span><span class="arm<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->arm()) ?></span><br /></div>
		      <div class="perso_sous_menu"><span>ESQ</span><span class="esq<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->esc()) ?></span><br /></div>
		      <div class="perso_sous_menu"><span>TEN</span><span class="ten<?=$persos->id_perso()?>"><?= htmlspecialchars($persos->ten()) ?></span><br /></div>
	      </div>
	    </div>
	    </a>
	    <button type="button" class="btn btn-secondary btn_sup">Reset</button>
	    <button type="button" class="btn btn-secondary btn_valid" name="btn_valid" value="<?=$persos->id_perso()?>">Choisir</button>

	  </div>
		<?php //var_dump($persos); ?>
	</div>

	<?php
}
?>
	  <div id="session_tab">
	  <?php
	  if (isset($_SESSION['tab_perso'])) {
	  	var_dump($_SESSION['tab_perso']);
	  }
	  ?>
	  </div>
</div>
<br /><br /><br /><br />
<div class="list_cheat">
<?php
foreach ($perso as $persos)
	{
	?>
	<a class="choix_stuff" id="choix<?=$persos->id_perso();?>" href="#<?=$persos->nom();?><?=$persos->id_perso();?>">
		<div class='list_cheat_perso'>
			<?= htmlspecialchars($persos->nom());?> (Niv <span id="lvl<?=$persos->id_perso();?>" ><?=htmlspecialchars($persos->niveau());?></span>)<br />
				<span>PV </span><?= htmlspecialchars($persos->pv());?><br />
				<span>ATT </span><?= htmlspecialchars($persos->att());?><br /><br />

		</div>
	</a>
	<?php
	//var_dump($_SESSION['tab_perso']);
	//$manager->add($persos, $user);
}
?>
<?php
echo '</div>';
?>
	<script>
		$(document).ready(function(){
			$(function(){
				$(".affiche_stuff").not(":first").hide();
				$(".choix_stuff").click(function(){
					var test = $(this).prop("hash");
					$("#team .affiche_stuff").hide();
					$(test).parent().show();
					return false;
				});
			});

			// Ouverture modal en AJAX pour selection des persos a sacrifier
			$('.manual-ajax').click(function(event) {
			  event.preventDefault();

			  $.get(this.href, function(html) {
			    $(html).appendTo('body').modal();
					// Selection des persos a sacrifier
					$(".btn_valid_up").click(function(event){
						//event.preventDefault();
						f = $("#tab_persos").serialize();
						$.ajax({
							type: "POST",
							url: "./ajax/gestion_perso.php",
							data: f,
							success: function(json){
									$("#session_tab").html(json);
									//$(".modal-backdrop show").hide();
									//$.modal.close();
							}
						});
					});
			  });
			});

			// Validation du sacrifice
			$(".btn_valid").click(function(){
				p = $(this).val();
				$.ajax({
					type: "POST",
					url: "./ajax/gestion_up_perso.php",
					data: "btn_valid="+p,
					success: function(json){
							json = $.parseJSON(json);
							$("#lvl"+json[0].id_perso).html(json[0].niveau);
							$(".pv"+json[0].id_perso).html(json[0].perso_pv);
							$(".att"+json[0].id_perso).html(json[0].perso_att);
							$(".def"+json[0].id_perso).html(json[0].perso_def);
							$(".vit"+json[0].id_perso).html(json[0].perso_vit);
							$(".pen"+json[0].id_perso).html(json[0].perso_pen);
							$(".arm"+json[0].id_perso).html(json[0].perso_arm);
							$(".pre"+json[0].id_perso).html(json[0].perso_pre);
							$(".esc"+json[0].id_perso).html(json[0].perso_esc);
							$(".crit"+json[0].id_perso).html(json[0].perso_crit);
							$(".ten"+json[0].id_perso).html(json[0].perso_ten);
							$(".soi"+json[0].id_perso).html(json[0].perso_soi);
							var xp = Number(json[0].xp);
							var xp_max = Number(json[0].xp_max);
							var xp_min = Number(json[0].xp_min);
							//alert(xp + " " + xp_min + " " +  xp_max);
							var level = 0;
							level = (xp - xp_min) / (xp_max - xp_min);
							level = level * 100;
							//alert(level);
							$("#progress-bar"+json[0].id_perso).width(level+"%");
							$("#session_tab").html("Upgrade effectué");
					}
				});
			});

			// Vidage du tableau des persos à sacrifier
			$(".btn_sup").click(function(){
				$.ajax({
					url: "./ajax/gestion_sup_tab.php",
					success: function(){
							$("#session_tab").html("");
					}
				});
			});
		});
	</script>
