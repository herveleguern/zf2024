<h1>Liste des SuperHeros</h1>
<?php
echo '<table border="1">';
foreach ($this->lesSuperHeros as $unSuperHeros) {
    echo '<tr><td>'.$unSuperHeros.'</td></tr>';
}
echo '</table>';
//bandeau de navigation
$pages=$this->lesSuperHeros->getPages();
foreach ($pages->pagesInRange as $page) {
    echo "<a href=?page=$page>$page</a>&nbsp;|&nbsp;";
}
var_dump($pages);//pour analyser le paginateur
?>

