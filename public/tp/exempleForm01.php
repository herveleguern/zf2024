<?php

require_once '../autoloader.php';

class FormLogin extends Zend_Form {

    public function init() {
        //$this représente l'instance de FormLogin
        $this->setName('Formulaire de connexion');
        $login = new Zend_Form_Element_Text('login');
        $login->setLabel('Login: ')
                ->setRequired();
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password:')
                ->setRequired();
        $btEnvoyer = new Zend_Form_Element_Submit('btEnvoyer');
        $btEnvoyer->setLabel('Envoyer');

        $this->addElements(array($login, $password, $btEnvoyer))
                ->setMethod('post')
                ->setAction('exempleForm01.php');
    }

}

$view = new Zend_View();
$form = new FormLogin();
if (!$_POST) {
// rendu du formulaire vierge
    echo $form->render($view);
} else
if (!$form->isValid($_POST)) {
// rendu du formulaire rempli et erreurs
    echo $form->render($view);
} else {
// formulaire valide. données postées
    echo $form->render($view);
    //toutes (pluriel) les données que le formulaire poste
    var_dump($form->getValues()); 
    //traiter l'authentification : succes ou echec
    $login = $form->getValue('login');  //idem $login=$_POST['login'];
    $password = $form->getValue('password');  //idem $password=$_POST['password'];

    if ($login == 'lea' && $password == '123456') {
        var_dump("connexion : succes");
    } else {
        var_dump("connexion : echec");
    }

}
?>




