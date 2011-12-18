<?php
class FormEditSecretary extends Zend_Form {

    public function __construct($userid, $u_fname, $u_lname, $u_address, $u_phone, $s_section, $s_jobtitle, $options = null) {
        parent::__construct($options);
        $this->setName('editsecretary');
		

		$pwd = new Zend_Form_Element_Text('pwd');
        $pwd->setLabel('Password :');
    

		
		

        $fname = new Zend_Form_Element_Text('fname');
        $fname->setLabel('First Name:');
		$fname->setValue($u_fname);
        $fname->setrequired(true);

		
        $lname = new Zend_Form_Element_Text('lname');
        $lname->setLabel('Last Name :');
		$lname->setValue($u_lname);
        $lname->setRequired(true);

		$address = new Zend_Form_Element_Text('address');
        $address->setLabel('Address:');
		if ($u_address == "")
			$u_address= "N/A";
		$address->setValue($u_address);

		$phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel('Phone:');
		if ($u_phone == "")
			$u_phone = "N/A";
		$phone->setValue($u_phone);
		
       
	   	$section = new Zend_Form_Element_Text('section');
        $section->setLabel('Section');
		if ($s_section == "")
			$s_section = "N/A";
		$section->setValue($s_section);

		$jobtitle = new Zend_Form_Element_Text('jobtitle');
        $jobtitle->setLabel('Job Title');
		if ($s_jobtitle== "")
			$s_jobtitle = "N/A";
		$jobtitle->setValue($s_jobtitle);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Edit');
		//$this->setAction($this->url(array('controller' => 'secretary',
                          // 'action' => 'editpatient', 'patientid' => $patientid)));
        $this->addElements(array($pwd, $fname, $lname, $address, $phone, $section, $jobtitle, $submit));
        

    }

}
?>