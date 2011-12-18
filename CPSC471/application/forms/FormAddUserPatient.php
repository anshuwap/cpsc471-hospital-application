<?php
class FormAddUserPatient extends Zend_Form {

    public function __construct($options = null) {
        parent::__construct($options);
        $this->setName('adduserpatient');

		$pwd = new Zend_Form_Element_Text('pwd');
        $pwd->setLabel('Password :');
        $pwd->setRequired(true);
		$pwd->setValue("pass");

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
        

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Add');
        $this->addElements(array($pwd, $fname, $lname, $address, $phone, $pdoc, $submit));
        
    }

}
?>