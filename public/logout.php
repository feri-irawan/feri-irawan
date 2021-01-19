<?php 

session_start();
session_destroy();
setcookie('ingat', '', time()-3600);
header('location: login.php?pesan=logout');

 ?>