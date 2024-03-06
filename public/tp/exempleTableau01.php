<?php
require_once '../autoloader.php';

$lesSuperHeros=array(
    'Spiderman','Batman', 'Wonderwoman','Hellboy','IronMan',
    'Biloute','Blackpower','Volverine','CaptainAmerica','HumanTorch','Robin'
    );

$view=new Zend_View();
$view->lesSuperHeros=$lesSuperHeros;
$view->addScriptPath('.');
echo $view->render('exempleTableau01vue.php');

?>