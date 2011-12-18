<?php
class FormEditUserPatient extends Zend_Form {

    public function __construct($patientid, $p_fname, $p_lname, $p_address, $p_phone, $p_pdoc, $options = null) {
        parent::__construct($options);
        $this->setName('edituserpatient');

		$pwd = new Zend_Form_Element_Text('pwd');
        $pwd->setLabel('Password :');
        $pwd->setRequired(true);

        $fname = new Zend_Form_Element_Text('fname');
        $fname->setLabel('First Name:');
		$fname->setValue($p_fname);
        $fname->setrequired(true);
		

        $lname = new Zend_Form_Element_Text('lname');
        $lname->setLabel('Last Name :');
		$lname->setValue($p_lname);
        $lname->setRequired(true);

		$address = new Zend_Form_Element_Text('address');
        $address->setLabel('Address:');
		if ($p_address == "")
			$p_address= "N/A";
		$address->setValue($p_address);

		$phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel('Phone:');
		if ($p_phone == "")
			$p_phone = "N/A";
		$phone->setValue($p_phone);
		
       
	   	$pdoc = new Zend_Form_Element_Text('pdoc');
        $pdoc->setLabel('Preferred Doctor:');
		if ($p_pdoc == "")
			$p_doc = "N/A";
		$pdoc->setValue($p_pdoc);
		
		

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Edit');
		//$this->setAction($this->url(array('controller' => 'secretary',
                          // 'action' => 'editpatient', 'patientid' => $patientid)));
        $this->addElements(array($pwd, $fname, $lname, $address, $phone, $pdoc, $submit));
        
    }

}
?>