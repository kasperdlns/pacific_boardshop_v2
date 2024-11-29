<?php
session_start(); 
session_destroy(); 
$_SESSION = []; 

// verwijs naar login pagina
header("Location: login.php");
exit; // Zorg ervoor dat de scriptuitvoering stopt na de redirect
?>