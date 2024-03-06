<h1>Liste des SuperHeros</h1>
<?php
echo '<table border="1">';
foreach ($this->lesSuperHeros as $unSuperHeros) {
    echo '<tr><td>'.$unSuperHeros.'</td></tr>';
}
echo '</table>';
?>