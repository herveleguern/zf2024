<?php

class AuthController extends Zend_Controller_Action {

    public function loginAction() {
        $form = new Application_Form_Login();
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $userName = $form->getValue('userName');
                $userPwd = $form->getValue('password');
                $authAdapter = $this->getAuthAdapter();
                $authAdapter->setIdentity($userName)
                        ->setCredential($userPwd)
                        ->setCredentialTreatment('MD5(?)');
                //recuperation de l'instance qui gère l'authentification
                $auth = Zend_Auth::getInstance();
                //demande d'authentification
                $result = $auth->authenticate($authAdapter);
                if ($result->isValid()) {
                    $identity = $authAdapter->getResultRowObject();
                    //$identity est un objet stdClass, propriétés publiques id nom prenom login mdp
                    // Zend_Auth::getInstance()->getIdentity()->prenom fournit la propriété prenom
                    $authStorage = $auth->getStorage();
                    $authStorage->write($identity);
                    $this->_helper->redirector->gotoUrl('ville/index');
                } else {
                    $this->view->errorMessage = 'echec authentification';
                }
            }
        }
    }

    public function logoutAction() {
        Zend_Auth::getInstance()->clearIdentity();
    }

    private function getAuthAdapter() {
        $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
        $authAdapter->setTableName('compte')
                ->setIdentityColumn('login')
                ->setCredentialColumn('mdp');
        return $authAdapter;
    }

}

?>