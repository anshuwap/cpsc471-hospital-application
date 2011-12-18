<?php
class FormEditDoctor extends Zend_Form {

    public function __construct($userid, $u_fname, $u_lname, $u_address, $u_phone, $d_section, $d_specialty, $options = null) {
        parent::__construct($options);
		
        $this->setName('editdoctor');

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
        $section->setLabel('Section:');
		if ($d_section == "")
			$d_section = "N/A";
		$section->setValue($d_section);
		

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Edit');
		//$this->setAction($this->url(array('controller' => 'secretary',
                          // 'action' => 'editpatient', 'patientid' => $patientid)));
       
		$test = array();
        foreach($d_specialty as $s => $value){
			$test[$value->Speciality] = "Delete: " . $value->Speciality;
			}
		$d_spec = new Zend_Form_Element_MultiCheckbox('specialty', array(
       	'multiOptions' => $test
    	));	
		
		$d_spec->setLabel("Delete Specialties:");
		
		$a_spec = new Zend_Form_Element_Text('addspecialty');
        $a_spec->setLabel('Add A Specialty:');
		
		 $this->addElements(array($pwd, $fname, $lname, $address, $phone, $section, $a_spec, $d_spec, $submit));
	
		
		
    }

}
?>