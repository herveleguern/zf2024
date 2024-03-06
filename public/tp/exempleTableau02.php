<?php
require_once '../autoloader.php';
$lesSuperHeros=array(
    'Spiderman','Batman', 'Wonderwoman','Hellboy','IronMan',
    'Biloute','Blackpower','Volverine','CaptainAmerica','HumanTorch','Robin'
    );

$view=new Zend_View();
//paginateur
$paginator=new Zend_Paginator(new Zend_Paginator_Adapter_Array($lesSuperHeros));
$nbItemsPerPage=5;
$paginator->setItemCountPerPage($nbItemsPerPage);
$currentPage=isset($_GET['page'])?(int)  htmlentities($_GET['page']):1;
$paginator->setCurrentPageNumber($currentPage);
//fin paginateur
$view->lesSuperHeros=$paginator;
$view->addScriptPath('.');
echo $view->render('exempleTableau02vueCorrige.php');

?>