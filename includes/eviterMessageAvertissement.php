<?php
	// { D�but - Premi�re partie
	if(!empty($_POST) OR !empty($_FILES))
	{
	    $_SESSION['sauvegarde'] = $_POST ;
	    $_SESSION['sauvegardeFILES'] = $_FILES ;
	    
	    $fichierActuel = $_SERVER['PHP_SELF'] ;
	    if(!empty($_SERVER['QUERY_STRING']))
	    {
	        $fichierActuel .= '?' . $_SERVER['QUERY_STRING'] ;
	    }
	    
	    header('Location: ' . $fichierActuel);
	    exit;
	}
	// } Fin - Premi�re partie

	// { D�but - Seconde partie
	if(isset($_SESSION['sauvegarde']))
	{
	    $_POST = $_SESSION['sauvegarde'] ;
	    $_FILES = $_SESSION['sauvegardeFILES'] ;
	    
	    unset($_SESSION['sauvegarde'], $_SESSION['sauvegardeFILES']);
	}
	// } Fin - Seconde partie
?>