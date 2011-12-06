<?php


class Default_Model_PatientFile extends Zend_Db_Table {

    protected $_name = 'PATIENTFILE';
    
    public function findAllPatientFiles() {
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from('PATIENTFILE', 'PATIENTFILE.*'); 
        $select->join('PATIENT', 'PATIENT.PatientId = PATIENTFILE.PatientId', array("PLName" => "PATIENT.LName", "PFName" => "PATIENT.FName"));
        $select->join('USER', 'USER.UserId = PATIENTFILE.DoctorId');
        $select->order(array('DateOfVisit DESC'));
        
       
        return $this->fetchAll($select);
    }
    
    public function findPatientFileWithName($lname, $fname) {
        
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from('PATIENTFILE', 'PATIENTFILE.*'); 
        $select->join('PATIENT', 'PATIENT.PatientId = PATIENTFILE.PatientId', array("PLName" => "PATIENT.LName", "PFName" => "PATIENT.FName"));
        $select->join('USER', 'USER.UserId = PATIENTFILE.DoctorId');
        $select->order(array('DateOfVisit DESC'));
        
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
    
    public function findAPatientFile($PatientId, $DoctorId, $Date) {
        $select = $this->select();
        $select->where('PatientId = ? ', $PatientId);
        $select->where('DoctorId = ? ', $DoctorId);
        $select->where('DateOfVisit = ? ', $Date);
        return $this->fetchRow($select);
    }
    
    public function editAPatientFile($PatientId, $DoctorId, $oldDate, $Date, $Length, $Type, $Desc, $Notes) {
        $this->update(array('DateOfVisit'=> $Date, "LenghtOfVisit" => $Length, 
            "TypeOfVisit" => $Type, "Description" => $Desc,
             "DoctorNotes" => $Notes ), "PatientId = ".$PatientId." And DoctorId = ".$DoctorId." And DateOfVisit = '".$oldDate."'");
    }
    
    public function createAPatientFile($PatientId, $DoctorId, $Date, $Length, $Type, $Desc, $Notes) {
        $row = $this->createRow();
        $row->PatientId = $PatientId;
        $row->DoctorId = $DoctorId;
        $row->DateOfVisit = $Date;
        $row->LenghtOfVisit = $Length;
        $row->TypeOfVisit = $Type;
        $row->Description = $Desc;
        $row->DoctorNotes = $Notes;
        $row->save();
    }
    
}

?>
