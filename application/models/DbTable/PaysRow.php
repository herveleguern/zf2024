<?php
class Application_Model_DbTable_PaysRow extends Zend_Db_Table_Row_Abstract{
    
    public function getVilles(){
        $lesVilles=  $this->findDependentRowset('Application_Model_DbTable_Ville','FKpays');
        return $lesVilles;
    }
}
    
?>