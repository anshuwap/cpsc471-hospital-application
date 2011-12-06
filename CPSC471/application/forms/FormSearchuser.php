<?php

class FormSearchuser extends Zend_Form {

    public function __construct($name =null ,$options = null) {
        parent::__construct($options);
        $this->setName('searchuser');

        $lname = new Zend_Form_Element_Text('LName');
        $lname->setLabel('Last Name:');

        $fname = new Zend_Form_Element_Text('FName');
        $fname->setLabel('First Name:');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Search');
        $this->addElements(array($lname, $fname, $submit));
        
    }
}

?>

