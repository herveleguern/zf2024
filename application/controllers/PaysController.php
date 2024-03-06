<?php

class PaysController extends Zend_Controller_Action {

    public function indexAction() {
        $lesPays = new Application_Model_DbTable_Pays();
        $this->view->lesPays = $lesPays->fetchAll();
    }

    public function villesAction() {
        $idPays = $this->_getParam('id',1); //$default=1 sous toute reserve...
        $lesPays = new Application_Model_DbTable_Pays();
        $unPays=$lesPays->find($idPays)->current();//object(Application_Model_DbTable_PaysRow)
        $lesVilles=$unPays->getVilles();
        $this->view->nomDuPays=$unPays->nom;
        $this->view->lesVilles=$lesVilles;
    }

}
?>

