<?php

class Application_Form_Ville extends Zend_Form {

    public function init() {
        $id = new Zend_Form_Element_Text('id');
        $id->setLabel('Identifiant')
                ->setRequired();
        $nom = new Zend_Form_Element_Text('nom');
        $nom->setLabel('Nom')
                ->setRequired();
        $langue = new Zend_Form_Element_Text('langue');
        $langue->setLabel('Langue')
                ->setRequired();

        $btEnvoyer = new Zend_Form_Element_Submit('envoyer');
        $this->addElements(array($id, $nom, $langue, $btEnvoyer));
    }

}

?>