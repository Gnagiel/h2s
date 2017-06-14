<?php
	try
	{
	  $db = new PDO('mysql:host=localhost;dbname=h2s', 'root', ''); // Tentative de connexion.
	  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}

	catch (PDOException $e) // On attrape les exceptions PDOException.
	{
	  echo 'La connexion a échoué.<br />';
	  echo 'Informations : [', $e->getCode(), '] ', $e->getMessage(); // On affiche le n° de l'erreur ainsi que le message.
	}
?>