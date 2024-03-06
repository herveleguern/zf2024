<?php
require_once '../autoloader.php';

class FormInscription extends Zend_Form {

    public function init() {
        //controle de saisie avec les validateurs

        $alphabetEspace = new Zend_Validate_Alpha(TRUE);
        $alphabetEspace->setMessage("Saisir des caracteres alphabetiques et l'espace");

        $ip = new Zend_Validate_Ip();
        $ip->setMessage("Saisir une adresse IP valide");

        $ageTrancheValide = new Zend_Validate_Between(array('min' => 7, 'max' => 77, 'inclusive' => TRUE));
        $ageTrancheValide->setMessage("Saisir une valeur entre 7 et 77 ans");
        $ageNumerique = new Zend_Validate_Digits();
        $ageNumerique->setMessage("Saisir un nombre entier");

        //elements de formulaire
        $this->setName('Inscription');
        $pseudo = new Zend_Form_Element_Text('pseudo');
        $pseudo->setLabel('Pseudonyme: ')
                ->setRequired()
                ->addValidator($alphabetEspace);
        $adrIP = new Zend_Form_Element_Text('ip');
        $adrIP->setLabel('Adresse IP V4: ')
                ->setRequired()
                ->addValidator($ip);
        $age = new Zend_Form_Element_Text('age');
        $age->setLabel('Age: ')
                ->setRequired()
                ->addValidator($ageTrancheValide)
                ->addValidator($ageNumerique);
        $btEnvoyer = new Zend_Form_Element_Submit('btEnregistrer');
        $btEnvoyer->setLabel('Inscrire');

        $this->addElements(array($pseudo, $adrIP, $age, $btEnvoyer))
                ->setMethod('post')
                ->setAction('exempleForm03.php');
    }

}

$view = new Zend_View();
$form = new FormInscription();
if (!$_POST) {
// rendu du formulaire vierge
    echo $form->render($view);
} else
if (!$form->isValid($_POST)) {
// rendu du formulaire rempli , avec des erreurs
    echo $form->render($view);
} else {
// les données du formulaire sont valides, on les exploite
    echo $form->render($view);  //optionnel
    var_dump($form->getValues());
    
}
?>

