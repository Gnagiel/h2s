/**
 * \file          sup_perso.js
 * \author    Guillaume Nagiel
 * \version   1.0
 * \date       5 Mars 2018
 * \brief       Ajax pour la suppression de personnage.
 * \details    Ce fichier js sert à supprimer un personnage du deck via une requete Ajax.
 */

 /**
  * \fn auto_load()
  * \brief       Chargement automatique.
  * \details    Permet de recharger automatiquement la page de gestion de l'équipe.
  */
function auto_load(){
 $.ajax({
   url: 'index.php?action=cheat',
   cache: false,
   success: function(data){
      $("#main_page").html(data);
   }
 });
}
$( document ).ready(function() {
  $(".sup_perso").submit(function() {
  	s = $(this).serialize();
  	$.ajax({
  		type: "POST",
  		data: s,
  		url: 'ajax/sup_perso.php',
  		success: function(retour){
  			auto_load();
  		}
  	});
  	return false;
  });
});
