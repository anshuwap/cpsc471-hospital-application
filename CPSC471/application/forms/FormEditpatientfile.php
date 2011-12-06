<?php

class FormEditpatientfile extends Zend_Form {

    public function __construct($patientname = null, $doctorname = null, $dateofvisit = null, $lengthofvisit = null,
             $typeofvisit = null, $description = null, $note = null, $options = null) {
        parent::__construct($options);
        $this->setName('editpatientfile');

        $patient = new Zend_Form_Element_Text('patient');
        $patient->setLabel('Patient Name :');
        $patient->setValue($patientname);
        $patient->disabled = 'disabled';
        
        $doctor = new Zend_Form_Element_Text('doctor');
        $doctor->setLabel('Doctor Name :');
        $doctor->setValue($doctorname);
        $doctor->disabled = 'disabled';
        
        $date = new Zend_Form_Element_Text('date');
        $date ->setLabel('Date Of Visit :');
        $date->setrequired(true);
        $date->setValue($dateofvisit);
        $date->addValidator('Date', 'YYYY-MM-DD',array('messages' => 'The format of the date is YYYY-MM-DD'));

        $length = new Zend_Form_Element_Text('length');
        $length->setLabel('Length Of Visit :');
        $length->setRequired(true);
        $length->setValue($lengthofvisit);
        
        $type = new Zend_Form_Element_Text('type');
        $type->setLabel('Type Of Visit :');
        $type->setRequired(true);
        $type->setValue($typeofvisit);
        
        $desc = new Zend_Form_Element_Textarea('desc');
        $desc->setLabel('Description :');
        $desc->setRequired(true);
        $desc->setValue($description);
        
        $notes = new Zend_Form_Element_Textarea('notes');
        $notes->setLabel('Doctor\'s Notes:');
        $notes->setRequired(true);
        $notes->setValue($note);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Edit');
        $this->addElements(array($patient, $doctor, $date, $length, $type, $desc, $notes, $submit));
        
    }
}

?>
