<?php

class FormCreatepatientfile extends Zend_Form {

    public function __construct($options = null) {
        parent::__construct($options);
        $this->setName('createpatientfile');

        $patient = new Zend_Form_Element_Text('patient');
        $patient->setLabel('Patient Id :');
        $patient->setrequired(true);
        
        $day = new Zend_Date(null, Zend_Date::ISO_8601);
        $date = new Zend_Form_Element_Text('date');
        $date ->setLabel('Date Of Visit :');
        $date->setrequired(true);
        $date->setValue($day->toString('YYYY-MM-dd'));
        $date->addValidator('Date', 'YYYY-MM-DD',array('messages' => 'The format of the date is YYYY-MM-DD'));

        $length = new Zend_Form_Element_Text('length');
        $length->setLabel('Length Of Visit :');
        $length->setRequired(true);
        
        $type = new Zend_Form_Element_Text('type');
        $type->setLabel('Type Of Visit :');
        $type->setRequired(true);
        
        $desc = new Zend_Form_Element_Textarea('desc');
        $desc->setLabel('Description :');
        $desc->setRequired(true);
        
        $notes = new Zend_Form_Element_Textarea('notes');
        $notes->setLabel('Doctor\'s Notes:');
        $notes->setRequired(true);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Edit');
        $this->addElements(array($patient, $date, $length, $type, $desc, $notes, $submit));
        
    }
}

?>
