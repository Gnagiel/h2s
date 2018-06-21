/**
 * \file          add_perso.js
 * \author    Guillaume Nagiel
 * \version   1.0
 * \date       5 Mars 2018
 * \brief       Ajax pour l'ajout' de personnage.
 * \details    Ce fichier js sert à ajouter un personnage dans son deck via une requete Ajax.
 */

$( document ).ready(function() {
  $(".add_perso").submit(function(event) {
  	s = $(this).serialize();
  	$.ajax({
  		type: "POST",
  		data: s,
  		url: 'ajax/add_perso.php',
  		success: function(retour){
  			location.reload();
  		}
  	});
    return false;
  });
});
