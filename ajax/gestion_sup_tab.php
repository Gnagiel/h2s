<?php
session_start();

if (isset($_SESSION['tab_perso'])) {
	unset($_SESSION['tab_perso']);
}


?>