<?php

class Default_Model_User extends Zend_Db_Table {

    protected $_name = 'USER';

    public function findUser($id) {
        /** find a User thanks to his id */
        return $this->fetchRow('UserId = ' . $id );
    }
    
    public function findAllUsers() {
        return $this->fetchAll();
    }

    public function findUserWithName($lname, $fname) {
        
        $select = $this->select();
        
        if ( $lname == null && $fname ==null ) {
            return $this->findAllUsers();
        } else if ( $lname == null ) {
            $select->where('FName = ? ' ,$fname);
            return $this->fetchAll($select);
        } else if ( $fname == null ) {
            $select->where('LName = ? ' ,$lname);
            return $this->fetchAll($select);
        } else { 
            $select->where('FName = ? ' ,$fname);
            $select->where('LName = ? ' ,$lname);
            return $this->fetchAll($select);
        }
    }
	public function addSecretary($pwd, $fname, $lname, $address, $phone, $section, $jobtitle)
	{
		$data = array(
			'Pwd'		   => $pwd,
		    'FName'            => $fname,
		    'LName'            => $lname,
		    'Adress'	       => $address,
		    'PhoneNumber'	   => $phone,
		    'UserType'      => "SECRETARY"
			);
		$key = $this->insert($data);
		
		$data2 = array(
			'SecretaryId' => $key,
			'Section'     => $section,
			'JobTitle'	  => $jobtitle
			);
		
		$table = new Default_Model_Secretary;
		$table->insert($data2);
						
	}
	public function addDoctor($pwd, $fname, $lname, $address, $phone, $section, $add_specialty)
	{
	
		$data = array(
			'Pwd'		   => $pwd,
		    'FName'            => $fname,
		    'LName'            => $lname,
		    'Adress'	       => $address,
		    'PhoneNumber'	   => $phone,
		    'UserType'      => "DOCTOR"
			);
		$key = $this->insert($data);
		
		
			$data2 = array(
				'DoctorId' => $key,
				'Section'  => $section,
				);
			
			$table = new Default_Model_Doctor;
			$table->insert($data2);
		
		
		if(strcmp($add_specialty,NULL) != 0)
		{
			$data3 = array(
			'DoctorId' 	  => $key,
			'Speciality'  => $add_specialty,
			);
		
			$table2 = new Default_Model_Specialty;
			$table2->insert($data3);
		}
		
	}
	public function addUserPatient($pwd, $fname, $lname, $address, $phone, $pdoc)
	{
		$data = array(
			'Pwd'		   => $pwd,
		    'FName'            => $fname,
		    'LName'            => $lname,
		    'Adress'	       => $address,
		    'PhoneNumber'	   => $phone,
		    'UserType'      => "PATIENT"
			);
		$key = $this->insert($data);
		$data2 = array(
			'PatientId'		   => $key,
		    'FName'            => $fname,
		    'LName'            => $lname,
		    'Adress'	       => $address,
		    'PhoneNumber'	   => $phone,
		    'PreferedDoctor'   => $did,
		    'PatientType'      => "LONGTERM"
			);
		
		$table = new Default_Model_Patient;
		$table->insert($data2);
						
	}
	public function findSecretaryWithId($userid)
	{
		//$this->fetchRow("UserId =".$userid);
		$select = $this->select()
        ->from(array('u' => 'USER'))
        ->join(array('s' => 'SECRETARY'), 's.SecretaryId = u.UserId')
        ->where('UserId = ? ' ,$userid);
		$select->setIntegrityCheck(false);
		
        return $this->fetchRow($select);
		
	}
	public function findDoctorWithId($userid)
	{
		$select = $this->select()
        ->from(array('u' => 'USER'))
        ->join(array('d' => 'DOCTOR'), 'd.DoctorId = u.UserId')
        ->where('UserId = ? ' ,$userid);
		$select->setIntegrityCheck(false);
		$one = $this->fetchRow($select);
		
		$select2 = $this->select()
		->from(array('s' => 'SPECIALITY'))
        ->where('DoctorId = ? ' ,$userid);
		$select2->setIntegrityCheck(false);
        $two = $this->fetchAll($select2);
        return array($one, $two);
	}
	public function findUserPatientWithId($userid)
	{
		$select = $this->select()
        ->from(array('u' => 'USER'))
        ->join(array('p' => 'PATIENT'), 'p.PatientId = u.UserId', array("PreferedDoctor"))
        ->where('UserId = ? ' ,$userid);
		$select->setIntegrityCheck(false);
		return $this->fetchRow($select);
	}
	public function editSecretary($userid, $pwd, $fname, $lname, $address, $phone, $section, $jobtitle)
	{
		
	}
	public function editDoctor($userid, $pwd, $fname, $lname, $address, $phone, $section, $del_specialty, $add_specialty)
	{
		
	}
	public function editUserPatient($userid, $pwd, $fname, $lname, $address, $phone, $pdoc)
	{
		
	}
	
}

?>
