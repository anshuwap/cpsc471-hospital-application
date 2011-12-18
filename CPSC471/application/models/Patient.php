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
	public function deletePatient($id)
	{
		$p = $this->findPatientWithId($id);
		$id = $p->PatientId;
		if(strcmp(strtolower($p->PatientType),"longterm") == 0)
		{	
			$table = new Default_Model_LongTermPatient();
			$where = $table->getAdapter()->quoteInto('PatientId= ?', $id);
 			$table->delete($where);
			
			$table = new Default_Model_User();
			$where = $table->getAdapter()->quoteInto('UserId= ?', $id);
 			$table->delete($where);
			
			
		}
		
		$where = $this->getAdapter()->quoteInto('PatientId= ?', $id);
		$this->delete($where);
	}
	public function editPatient($id, $fname, $lname, $address, $phone, $did, $type)
	{
		
		
		//todo:
		//here if the patient type is changed we need to account for it...
		//ie: if it was longterm, and now is short term, we should delete the long term user
		// if it was short term and now is long term we should add a long term user, but we need to make sure the PatientID and User Id are the same.
			//my idea is find the greatest userid and patientid, whichever is greater, add 1 and then make id's match
		try{
		
		$p = $this->findPatientWithId($id);

		$check = false;
		if(strcmp(strtolower($p->PatientType),"longterm") == 0 && strcmp(strtolower($type), "shortterm") == 0)
		{
			
			$table = new Default_Model_LongTermPatient();
			$where = $table->getAdapter()->quoteInto('PatientId= ?', $id);
 			$table->delete($where);
			
			$table = new Default_Model_User();
			$where = $table->getAdapter()->quoteInto('UserId= ?', $id);
 			$table->delete($where);
			
			
		}
		elseif(strcmp(strtolower($p->PatientType),"shortterm") == 0 && strcmp(strtolower($type), "longterm" == 0))
		{
			$table = new Default_Model_User;
			$lttable = new Default_Model_LongTermPatient;
			
			$result = $table->fetchrow("1","UserId desc");
			$id1 = $result->UserId + 1;
			
		
			$result2 = $this->fetchrow("1","PatientId desc");
			$id2 = $result2->PatientId + 1;
			
			$id = max($id1, $id2);
			
			
			$data1 = array(
			'UserId'		   => $id,
		    'FName'            => $fname,
		    'LName'            => $lname,
		    'Adress'	       => $address,
		    'PhoneNumber'	   => $phone,
		    'Pwd'              => "pass",
		    'UserType'         => "PATIENT"
			);
			
			
			$table->insert($data1);
			
			
		}
		elseif(strcmp(strtolower($type), "longterm") == 0)
		{
			$table = new Default_Model_User;
			
			
			$data1 = array(
		    'FName'            => $fname,
		    'LName'            => $lname,
		    'Adress'	       => $address,
		    'PhoneNumber'	   => $phone,
			);
			
			$where = $table->getAdapter()->quoteInto('UserId = ?', $id);
			$table->update($data1, $where);
		
		
			
			
		}
		
		
			$data = array(
				'PatientId'		   => $id,
			    'FName'            => $fname,
			    'LName'            => $lname,
			    'Adress'	       => $address,
			    'PhoneNumber'	   => $phone,
			    'PreferedDoctor'   => $did,
			    'PatientType'      => strtoupper($type)
				);
		
	
 
			$where = $this->getAdapter()->quoteInto('PatientId = ?', $id);
			 
			$this->update($data, $where);
			//return "good";
			}
		catch(Exception $e)
		{
			//return $e;
		}
	}
	
	public function addPatient($fname, $lname, $address, $phone, $did, $type)
	{
		$check = 0;
		if ($type == NULL || $type == "")
		{
			$type = "SHORTTERM";
			$check = 1;
		}
		
		$result2 = $this->fetchrow("1","PatientId desc");
		$id = $result2->PatientId + 1;
		$check = 2;
		if(strcmp(strtolower($type), "longterm") == 0)
		{
			try{
			$table = new Default_Model_User;
			$lttable = new Default_Model_LongTermPatient;
			
			$result = $table->fetchrow("1","UserId desc");
			$id1 = $result->UserId + 1;
			
			$id = max($id1, $id);
			
			
			$data1 = array(
			'UserId'		   => $id,
		    'FName'            => $fname,
		    'LName'            => $lname,
		    'Adress'	       => $address,
		    'PhoneNumber'	   => $phone,
		    'Pwd'              => "pass",
		    'UserType'         => "PATIENT"
			);
			
			
			$table->insert($data1);
			
			$ltdata = array(
			'PatientId'		=> $id,
			'MealId'		=> 1
			);
			$lttable->insert($ltdata);
			$check = 3;
			}
			catch(Exception $e)
			{
				$check = $e->getMessage();
			}
			
		}
		$data = array(
			'PatientId'		   => $id,
		    'FName'            => $fname,
		    'LName'            => $lname,
		    'Adress'	       => $address,
		    'PhoneNumber'	   => $phone,
		    'PreferedDoctor'   => $did,
		    'PatientType'      => strtoupper($type)
			);
 
			 
			$this->insert($data);
			
	}
}

?>
