<?php
class Application_Form_Login extends Zend_Form {

    public function init() {
        $userName = new Zend_Form_Element_Text('userName');
        $userName->setLabel('Nom: ')
                ->setRequired();
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Mot de passe:')
                ->setRequired();
        $btConnecter = new Zend_Form_Element_Submit('btConnecter');
        $btConnecter->setLabel('Se connecter');
        $this->addElements(array($userName, $password, $btConnecter));
    }
}
?>