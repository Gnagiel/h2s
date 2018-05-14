/**
 * \file          team.js
 * \author    Guillaume Nagiel
 * \version   1.0
 * \date       5 Mars 2018
 * \brief       Ajax pour gestion de l'équipe.
 * \details    Ce fichier js sert à modifier l'état de l'équipe via une requete Ajax.
 */

/**
 * \fn auto_load()
 * \brief       Chargement automatique.
 * \details    Permet de recharger automatiquement la page de gestion de l'équipe.
 */
function auto_load(){
  $.ajax({
    url: 'index.php?action=team',
    cache: false,
    success: function(data){
       $("#main_page").html(data);
    }
  });
}
$( document ).ready(function() {
  $(".add_team").submit(function() {
  		s = $(this).serialize();
  		$.ajax({
  			type: "POST",
  			data: s,
  			url: 'ajax/team_ajax.php',
  			success: function(retour){
  				auto_load();
  			}
  		});
  		return false;
  });
});
