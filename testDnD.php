<!DOCTYPE html>
<html>
	<head>
    <title>testDnD</title>
		<style>
		[draggable] {
		    -moz-user-select: none;
		    -khtml-user-select: none;
		    -webkit-user-select: none;
		    user-select: none;
		}
		 
		#liste li {
		    margin:4px;
		    width:75px;
		    border: 1px solid #000;
		    border-radius:2px;
		    cursor: move;
		    text-align:center;
		    padding:2px;
		    box-shadow: 1px 1px 12px #555;
		    background-color:white;
		    list-style-type:none;
		}	
		</style>    
    <link rel="stylesheet" media="screen" type="text/css" href="./style/style.css" />
		<script type="text/javascript" src="http://www.google.com/jsapi"></script>
		<script type="text/javascript">
    	google.load('jquery','1');
    </script>
    <meta charset="utf-8" />
  </head>
  <body>
		<ul id="liste">
		  <li draggable="true">A</li>
		  <li draggable="true">B</li>
		  <li draggable="true">C</li>
		  <li draggable="true">D</li>
		</ul>  	
  </body>
</html>
<script>
	// ajoute la propriété pour le drop et le transfert de données
	$.event.props.push('dataTransfer');
	 
	$(document).ready(function() {
	    var i, $this, $log = $('#log');
	 
	    $('#liste li').on({
	        // on commence le drag
	        dragstart: function(e) {
	            $this = $(this);
	 
	            i = $this.index();
	            $this.css('opacity', '0.5');
	 
	            // on garde le texte en mémoire (A, B, C ou D)
	            e.dataTransfer.setData('text', $this.text());
	        },
	        // on passe sur un élément draggable
	        dragenter: function(e) {
	            // on augmente la taille pour montrer le draggable
	            $(this).animate({
	                width: '90px'
	            }, 'fast');
	 
	            e.preventDefault();
	        },
	        // on quitte un élément draggable
	        dragleave: function() {
	            // on remet la taille par défaut
	            $(this).animate({
	                width: '75px'
	            }, 'fast');
	        },
	        // déclenché tant qu on a pas lâché l élément
	        dragover: function(e) {
	            e.preventDefault();
	        },
	        // on lâche l élément
	        drop: function(e) {
	            // si l élément sur lequel on drop n'est pas l'élément de départ
	            if (i !== $(this).index()) {
	                // on récupère le texte initial
	                var data = e.dataTransfer.getData('text');
	 
	                // on log
	                $log.html(data + ' > ' + $(this).text()).fadeIn('slow').delay(1000).fadeOut();
	 
	                // on met le nouveau texte à la place de l ancien et inversement
	                $this.text($(this).text());
	                $(this).text(data);
	            }
	 
	            // on remet la taille par défaut
	            $(this).animate({
	                width: '75px'
	            }, 'fast');
	        },
	        // fin du drag (même sans drop)
	        dragend: function() {
	            $(this).css('opacity', '1');
	        },
	        // au clic sur un élément
	        click: function() {
	            alert($(this).text());
	        }
	    });
	});	
</script>	    




