<!-- Database connection -->

<?php
$db = mysqli_connect('127.0.0.1','cms_www','7QMzcSgF2svJMcTk','sports_online');

if(mysqli_connect_error()){
  echo 'Database connection failed, check the error: ' . mysqli_connect_error();
  die();
}


//Create a constante
//Defines a constante (BASEURL) and setting it to SportsOnline
define('BASEURL', '/SportsOnline/');
