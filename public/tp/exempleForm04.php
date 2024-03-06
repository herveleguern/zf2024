<?php
require_once '../autoloader.php';

class FormVisiteur extends Zend_Form {

    public function init() {
        
//validateurs personnalisés
        $nonVide = new Zend_Validate_NotEmpty();
        $nonVide->setMessage("Champ obligatoire");
        //id : 1 alphabet minuscule suivi d’au plus 4 chiffres
        $formatId = new Zend_Validate_Regex('/^[a-z]{1}[0-9]{1,4}$/');
        $formatId->setMessage('1 alphabet minuscule suivi d\'au plus 4 chiffres');
        //pwd : que des minuscules, au moins 1 chiffre, au moins 1 alphabet
        $formatPwd = new Zend_Validate_Regex('((?=.*\d)(?=.*[a-z]).{4,})');
        $formatPwd->setMessage("au moins 4 caracteres, au moins 1 chiffre, au moins 1 minuscule");
        //nom et prenom : une majuscule suivie de minuscules
        $formatNommage=new Zend_Validate_Regex('/^[A-Z]{1}[a-z]{1,}$/');
        $formatNommage->setMessage('Une majuscule suivie de minuscules');
        //login : que des minuscules
        $queDesMinuscules=new Zend_Validate_Regex('/^[a-z]+$/');
        $queDesMinuscules->setMessage('Que des minuscules');
        
        $formatDate = new Zend_Validate_Date(); //array('format' => 'yyyy-mm-dd'))
        $formatDate->setMessage('format AAAA-MM-JJ');

        $id = new Zend_Form_Element_Text('id');
        $id->setLabel('Identifiant')
                ->setRequired(TRUE)
                ->addValidator($nonVide)
                ->addValidator($formatId);
        $nom = new Zend_Form_Element_Text('nom');
        $nom->setLabel('Nom')
                ->setRequired(TRUE)
                ->addValidator($nonVide)
                ->addValidator($formatNommage);
        $prenom = new Zend_Form_Element_Text('prenom');
        $prenom->setLabel('Prenom')
                ->setRequired(TRUE)
                ->addValidator($nonVide)
                ->addValidator($formatNommage);
        $login = new Zend_Form_Element_Text('login');
        $login->setLabel('Login')
                ->setRequired(TRUE)
                ->addValidator($nonVide)
                ->addValidator($queDesMinuscules);
        $mdp = new Zend_Form_Element_Text('mdp');
        $mdp->setLabel('Mot de passe')
                ->setRequired(TRUE)
                ->addValidator($nonVide)
                ->addValidator($formatPwd);
        $adresse = new Zend_Form_Element_Text('adresse');
        $adresse->setLabel('Adresse');
        $cp = new Zend_Form_Element_Text('cp');
        $cp->setLabel('Code postal');
        $ville = new Zend_Form_Element_Text('ville');
        $ville->setLabel('Ville');
        $datEmbauche = new Zend_Form_Element_Text('dateembauche');
        $datEmbauche->setLabel('Date d\'embauche,format AAAA-MM-JJ')
                ->addValidator($formatDate);

        $envoyer = new Zend_Form_Element_Submit('envoyer');

        $this->addElements(array($id, $nom, $prenom, $login, $mdp,
                    $adresse, $cp, $ville, $datEmbauche, $envoyer))
                ->setMethod('post')
                ->setAction('exempleForm04.php');
    }

}

$view = new Zend_View();
$form = new FormVisiteur();
/* un formulaire est itérable
var_dump($form->count());
$form->rewind();
while($form->valid()){
    var_dump($form->key());
    var_dump(get_class($form->current()));
    $form->next();
}
echo $form->render($view);
*/

if (!$_POST) {
    echo $form->render($view);
} else
if (!$form->isValid($_POST)) {
    echo $form->render($view);
} else {
    echo $form->render($view);
    var_dump($form->getValues()); 
}
?>