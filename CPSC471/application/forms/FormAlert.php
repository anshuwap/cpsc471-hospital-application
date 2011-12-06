<?php

class FormAlert extends Zend_Form {

    public function __construct($name =null ,$options = null) {
        parent::__construct($options);
        $this->setName('sendAlert');

        $receivername = new Zend_Form_Element_Text('to');
        $receivername->setLabel('To :');
        $receivername->setValue($name);
        $receivername->disabled = 'disabled';

        $desc = new Zend_Form_Element_Textarea('desc');
        $desc->setLabel('Message :');
        $desc->setRequired(true);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Send');
        $this->addElements(array($receivername, $desc, $submit));
        
    }
}

?>
