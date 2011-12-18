<?php
class FormAddDoctor extends Zend_Form {

    public function __construct($options = null) {
        parent::__construct($options);
        $this->setName('adddoctor');

		$pwd = new Zend_Form_Element_Text('pwd');
        $pwd->setLabel('Password :');
        $pwd->setRequired(true);
		$pwd->setValue("pass");

        $fname = new Zend_Form_Element_Text('fname');
        $fname->setLabel('First Name:');
	
        $lname = new Zend_Form_Element_Text('lname');
        $lname->setLabel('Last Name :');

		$address = new Zend_Form_Element_Text('address');
        $address->setLabel('Address:');

		$phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel('Phone:');

		
	   	$section = new Zend_Form_Element_Text('section');
        $section->setLabel('Section');
	
		
		$a_spec = new Zend_Form_Element_Text('addspecialty');
        $a_spec->setLabel('Add A Specialty');
		

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Add');
		//$this->setAction($this->url(array('controller' => 'secretary',
                          // 'action' => 'editpatient', 'patientid' => $patientid)));
        $this->addElements(array($pwd, $fname, $lname, $address, $phone, $section, $a_spec, $submit));
        
    }

}
?>