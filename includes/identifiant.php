<?php
/**
 * \file          identifiant.php
 * \author    Guillaume Nagiel
 * \version   1.0
 * \date       29 Janvier 2018
 * \brief       Connexion PDO.
 *
 * \details    Ce fichier contient le code permettant d'instancier l'objet PDO afin de se connecter à la base de données.
 */
/**
* \code{.php}
*/
	try
	{
	  $db = new PDO('mysql:host=mysql-gnagiel.alwaysdata.net;dbname=gnagiel_h2s', 'gnagiel_sql', 'molo1982');
	  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}
	catch (PDOException $e)
	{
	  echo 'La connexion a échoué<br />';
	  echo 'Informations : [', $e->getCode(), '] ', $e->getMessage();
	}
?>
