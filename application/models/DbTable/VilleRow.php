<?php
class Application_Model_DbTable_VilleRow extends Zend_Db_Table_Row_Abstract{
    public function getNomPays(){
        $pays=  $this->findParentRow('Application_Model_DbTable_Pays','FKpays');
        return is_null($pays)?'N/A':$pays->nom;
    }
}
    
?>