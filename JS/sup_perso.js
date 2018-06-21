/**
 * \file          sup_perso.js
 * \author    Guillaume Nagiel
 * \version   1.0
 * \date       5 Mars 2018
 * \brief       Ajax pour la suppression de personnage.
 * \details    Ce fichier js sert à supprimer un personnage du deck via une requete Ajax.
 */

$( document ).ready(function() {
  $(".sup_perso").submit(function() {
  	s = $(this).serialize();
  	$.ajax({
  		type: "POST",
  		data: s,
  		url: 'ajax/sup_perso.php',
  		success: function(retour){
  			location.reload();
  		}
  	});
  	return false;
  });
});
