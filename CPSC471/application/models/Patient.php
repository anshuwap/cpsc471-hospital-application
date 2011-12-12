<?php

class Default_Model_Patient extends Zend_Db_Table {

    protected $_name = 'PATIENT';
	protected $_sequence = true;

    public function findPatient($fname, $lname, $adress) {
        /** find a User thanks to his id */
        return $this->fetchRow("FName='".$fname. "' and LName='".$lname.
                "' and Adress= '".$adress."'");
    }
	public function findAllPatients()
	{
		return $this->fetchAll();
	}
    public function findPatientWithName($fname, $lname)
	{
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
    public function findPatientWithId($id) {
        return $this->fetchRow("PatientId =".$id);
        
    }
	public function editPatient($id, $fname, $lname, $address, $phone, $did, $type)
	{
		
		
		//todo:
		//here if the patient type is changed we need to account for it...
		//ie: if it was longterm, and now is short term, we should delete the long term user
		// if it was short term and now is long term we should add a long term user, but we need to make sure the PatientID and User Id are the same.
			//my idea is find the greatest userid and patientid, whichever is greater, add 1 and then make id's match
			
		/*
		$p = $this->findPatientWithId($id);
		
		if(strcmp(strtolower($p->PatientType),"longterm") && strcmp($type, "shortterm"))
		{
			
			$table = new Default_Model_LongTermPatient();
			$where = $table->getAdapter()->quoteInto('PatientId= ?', $id);
 			$table->delete($where);
			
			$table = new Default_Model_User();
			$where = $table->getAdapter()->quoteInto('UserId= ?', $id);
 			$table->delete($where);
			
			
		}
		elseif(strcmp(strtolower($p->PatientType),"shortterm") && strcmp($type, "longterm"))
		{
			$table = new Default_Model_User
		}
		 
		 */
		
		$data = array(
		    'FName'            => $fname,
		    'LName'            => $lname,
		    'Adress'	       => $address,
		    'PhoneNumber'	   => $phone,
		    'PreferedDoctor'   => $did,
		    'PatientType'      => $type
			);
 
			$where = $this->getAdapter()->quoteInto('PatientId = ?', $id);
			 
			$this->update($data, $where);
	}
	
	public function addPatient($fname, $lname, $address, $phone, $did, $type)
	{
		$data = array(
		    'FName'            => $fname,
		    'LName'            => $lname,
		    'Adress'	       => $address,
		    'PhoneNumber'	   => $phone,
		    'PreferedDoctor'   => $did,
		    'PatientType'      => $type
			);
 
			 
			$this->insert($data);
	}
}

?>
