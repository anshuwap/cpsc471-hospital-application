<?php
class FormAddPatient extends Zend_Form {

    public function __construct($options = null) {
        parent::__construct($options);
        $this->setName('addpatient');

        $fname = new Zend_Form_Element_Text('fname');
        $fname->setLabel('First Name:');
        $fname->setrequired(true);

        $lname = new Zend_Form_Element_Text('lname');
        $lname->setLabel('Last Name :');
        $lname->setRequired(true);

		$address = new Zend_Form_Element_Text('address');
        $address->setLabel('Address:');

		$phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel('Phone:');
       
	   	$pdoc = new Zend_Form_Element_Text('pdoc');
        $pdoc->setLabel('Preferred Doctor:');
        
		
		$ptype = new Zend_Form_Element_Text('ptype');
        $ptype->setLabel('Patient Type:');
        $ptype->setRequired(true);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Add');
        $this->addElements(array($fname, $lname, $address, $phone, $pdoc, $ptype, $submit));
        
    }

}
?>