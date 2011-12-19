<?php

class FormSearchRoom extends Zend_Form {

    public function __construct($name =null ,$options = null) {
        parent::__construct($options);
        $this->setName('searchroom');

        $room = new Zend_Form_Element_Text('Floor');
        $room->setLabel('Floor:');

      

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Search');
        $this->addElements(array($room, $submit));
        
    }
}

?>
