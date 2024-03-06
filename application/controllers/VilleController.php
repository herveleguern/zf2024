<?php

class VilleController extends Zend_Controller_Action {

    // public function init() {
    //     if (!Zend_Auth::getInstance()->hasIdentity()) {
    //         $this->_helper->redirector->gotoUrl('auth/login');
    //     }
    // }

    public function modifierAction() {
        $form = new Application_Form_Ville();
//desactiver la modification de la PK
        $form->id->setLabel('Identifiant (non modifiable)');
        $form->id->setAttrib('readonly', 'true');
        $form->id->setAttrib('style', 'pointer-events: none');
//
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = $form->getValue('id');
                $nom = $form->getValue('nom');
                $langue = $form->getValue('langue');
                $lesVilles = new Application_Model_DbTable_Ville();
                $lesVilles->modifierVille($id, $nom, $langue);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 1);
            $lesVilles = new Application_Model_DbTable_Ville();
//préremplir-peupler le formulaire avec la ville sélectionnée
            $form->populate($lesVilles->obtenirVille($id));
        }
    }

    public function indexAction() {
        $lesVilles = new Application_Model_DbTable_Ville();
        $lesVillesParPage = new Zend_Paginator(new Zend_Paginator_Adapter_DbTableSelect($lesVilles->select()));
        $lesVillesParPage->setItemCountPerPage(10);
        $currentPage = isset($_GET['page']) ? (int) htmlentities($_GET['page']) : 1;
        $lesVillesParPage->setCurrentPageNumber($currentPage);
        $this->view->lesVilles = $lesVillesParPage;
    }

    public function ajouterAction() {
        $form = new Application_Form_Ville();
//ajout du controle de saisie unicite PK
        $idUnique = new Zend_Validate_Db_NoRecordExists(
                array('adapter' => Zend_Db_Table::getDefaultAdapter(),
            'table' => 'ville',
            'field' => 'id'));
        $idUnique->setMessage('Cet ID de ville existe deja');
        $form->id->addValidator($idUnique);
//
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = $form->getValue('id');
                $nom = $form->getValue('nom');
                $langue = $form->getValue('langue');
                $lesVilles = new Application_Model_DbTable_Ville();
                $lesVilles->ajouterVille($id, $nom, $langue);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function supprimerAction() {
        if ($this->getRequest()->isPost()) {
            $supprimer = $this->getRequest()->getPost('supprimer');
            if ($supprimer == 'Oui') {
                $id = $this->getRequest()->getPost('id');
                $lesVille = new Application_Model_DbTable_Ville();
                $lesVille->supprimerVille($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $lesVilles = new Application_Model_DbTable_Ville();
            $this->view->ville = $lesVilles->obtenirVille($id);
        }
    }

    public function listerAction() {
        $db = Zend_Db_Table::getDefaultAdapter();
        $query = "select langue,count(*) as nbVilles from ville group by langue"; //Ecrire la requête SQL personnalisée
        $lesLignes = $db->fetchAll($query); //n'est PAS un zend_db_select
        $this->view->lesLignes = $lesLignes;
    }

    public function lister2Action() {
        $db = Zend_Db_Table::getDefaultAdapter();
        $query = "select * from ville order by langue";
        $lesLignes = $db->fetchAll($query);
        $this->view->lesLignes = $lesLignes;
    }

    public function lister3Action() {
        $db = Zend_Db_Table::getDefaultAdapter();
        $query = "select langue,nom from ville";
        $lesLignes = $db->fetchAll($query);

        $lesLignes = $this->nbVillesParLangue($lesLignes);  
        $this->view->lesLignes = $lesLignes;
    }

//retourne un tableau associatif clé=>valeur 
//clé = nom de la langue
//valeur = nombre de villes parlant la langue
//parametre = le tableau de toutes les villes (langue,nom)
    private function nbVillesParLangue($lesLignes) {
        $nbVillesParLangue = array();
        foreach ($lesLignes as $uneLigne) {
            if (!array_key_exists($uneLigne['langue'], $nbVillesParLangue)) {
                $nbVillesParLangue[$uneLigne['langue']] = 1;
            } else {
                $nbVillesParLangue[$uneLigne['langue']]+=1;
            }
        }
        return $nbVillesParLangue;
    }

}
?>

