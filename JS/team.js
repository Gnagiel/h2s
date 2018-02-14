function auto_load(){
  $.ajax({
    url: 'index.php?action=team',
    cache: false,
    success: function(data){
       $("#main_page").html(data);
    } 
  });
}

$(document).ready(function(){
		$(".add_team").submit(function() {
				s = $(this).serialize();
				$.ajax({
					type: "POST",
					data: s,
					url: 'ajax/team.php',
					success: function(retour){
						auto_load();
					}
				});
				return false;
		});
});