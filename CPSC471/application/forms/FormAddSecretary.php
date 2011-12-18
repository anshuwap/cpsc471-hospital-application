<?php
class FormAddSecretary extends Zend_Form {

    public function __construct($options = null) {
        parent::__construct($options);
        $this->setName('addsecretary');

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
		
		
       
	   	$section = new Zend_Form_Element_Text('section');
        $section->setLabel('Section');
		

		$jobtitle = new Zend_Form_Element_Text('jobtitle');
        $jobtitle->setLabel('Job Title');
		

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Add');
		//$this->setAction($this->url(array('controller' => 'secretary',
                          // 'action' => 'editpatient', 'patientid' => $patientid)));
        $this->addElements(array($pwd, $fname, $lname, $address, $phone, $section, $jobtitle, $submit));
        

    }

}
?>