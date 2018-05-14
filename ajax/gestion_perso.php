<?php
session_start();
if (isset($_SESSION['tab_perso'])) {
	unset($_SESSION['tab_perso']);
}
if (isset($_POST["tab"])) {
	$_SESSION['tab_perso'] = $_POST["tab"];	
}
else {
	$_SESSION['tab_perso'] = [];
}

echo json_encode($_SESSION['tab_perso']);	

?>