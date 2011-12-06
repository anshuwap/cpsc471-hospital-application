<?php


class Default_Model_PatientFile extends Zend_Db_Table {

    protected $_name = 'PATIENTFILE';
    
    public function findAllPatientFiles() {
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from('PATIENTFILE', 'PATIENTFILE.*'); 
        $select->join('PATIENT', 'PATIENT.PatientId = PATIENTFILE.PatientId', array("PLName" => "PATIENT.LName", "PFName" => "PATIENT.FName"));
        $select->join('USER', 'USER.UserId = PATIENTFILE.DoctorId');
        
       
        return $this->fetchAll($select);
    }
    
    public function findPatientFileWithName($lname, $fname) {
        
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from('PATIENTFILE', 'PATIENTFILE.*'); 
        $select->join('PATIENT', 'PATIENT.PatientId = PATIENTFILE.PatientId', array("PLName" => "PATIENT.LName", "PFName" => "PATIENT.FName"));
        $select->join('USER', 'USER.UserId = PATIENTFILE.DoctorId');
        
        if ( $lname == null && $fname ==null ) {
            return $this->findAllPatientFiles();
        } else if ( $lname == null ) {
            $select->where('PATIENT.FName = ? ' ,$fname);
            return $this->fetchAll($select);
        } else if ( $fname == null ) {
            $select->where('PATIENT.LName = ? ' ,$lname);
            return $this->fetchAll($select);
        } else { 
            $select->where('PATIENT.FName = ? ' ,$fname);
            $select->where('PATIENT.LName = ? ' ,$lname);
            return $this->fetchAll($select);
        }
    }
    
}

?>
