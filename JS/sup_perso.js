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