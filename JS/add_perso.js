/**
 * \file          add_perso.js
 * \author    Guillaume Nagiel
 * \version   1.0
 * \date       26 Janvier 2018
 * \brief       Test.
 * \details    Ce fichier est la base du jeu.
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

$(document).ready(function(){

	$(".add_perso").submit(function() {
		s = $(this).serialize();
		$.ajax({
			type: "POST",
			data: s,
			url: 'ajax/add_perso.php',
			success: function(retour){
				$("#onglet_1").show();
				auto_load();
			}
		});
		return false;
	});

});
