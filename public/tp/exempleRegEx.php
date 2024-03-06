<?php
$chaine = "bonjour";
var_dump($contientMajuscule = preg_match('/[A-Z]/', $chaine));  //1 
var_dump($contientMinuscule = preg_match('/[a-z]/', $chaine));  //1
var_dump($contientChiffre = preg_match('/[0-9]/', $chaine));    //0
var_dump($estTelephone = preg_match('/^0[1-68]([-. ]?[0-9]{2}){4}$/', $chaine));    //0

var_dump($commenceParUneMajuscule = preg_match('/^[A-Z]{1}[a-z]{1,}$/', $chaine)); //ex Bonjour OK bonjourKO

var_dump($queDesMinuscules = preg_match('/^[a-z]+$/', $chaine)); 

?>


