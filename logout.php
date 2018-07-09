<?php
session_start();
session_unset(); 
session_destroy();
//echo '<script>window.open("backup.php", "_self").close(); top.close(); window.open("backup.php", "_self", ""); window.close();</script>';
header('location:index.php');
?>