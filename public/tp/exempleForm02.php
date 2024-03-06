<?php
require_once '../autoloader.php';

class FormInscription extends Zend_Form {

    public function init() {
        $pseudo = new Zend_Form_Element_Text('pseudo');
        $pseudo->setLabel('Pseudonyme: ');
        $adrIP = new Zend_Form_Element_Text('ip');
        $adrIP->setLabel('Adresse IP V4: ');
        $age = new Zend_Form_Element_Text('age');
        $age->setLabel('Age: ');
        $btEnvoyer = new Zend_Form_Element_Submit('btEnregistrer');
        $btEnvoyer->setLabel('Inscrire');
        $this->addElements(array($pseudo, $adrIP, $age, $btEnvoyer))
                ->setMethod('post')
                ->setAction('exempleForm02.php');
    }
}

$view = new Zend_View();
$form = new FormInscription();
if (!$_POST) {
    echo $form->render($view);
} else
if (!$form->isValid($_POST)) {
    echo $form->render($view);
} else {
    echo $form->render($view);  //optionnel
    var_dump($form->getValues());
}
?>

