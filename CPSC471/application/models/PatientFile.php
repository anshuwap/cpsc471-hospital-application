<?php


class Default_Model_PatientFile extends Zend_Db_Table {

    protected $_name = 'patientfile';
    
    public function findAllPatientFiles() {
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from('patientfile', 'patientfile.*'); 
        $select->join('patient', 'patient.PatientId = patientfile.PatientId', array("PLName" => "patient.LName", "PFName" => "patient.FName"));
        $select->join('user', 'user.UserId = patientfile.DoctorId');
        $select->order(array('DateOfVisit DESC'));
        
       
        return $this->fetchAll($select);
    }
    
    public function findPatientFileWithName($lname, $fname) {

        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from('patientfile', 'patientfile.*');
        $select->join('patient', 'patient.PatientId = patientfile.PatientId', array("PLName" => "patient.LName", "PFName" => "patient.FName"));
        $select->join('user', 'user.UserId = patientfile.DoctorId');
        $select->order(array('DateOfVisit DESC'));

        if ($lname == null && $fname == null) {
            return $this->findAllPatientFiles();
        } else if ($lname == null) {
            $select->where('patient.FName = ? ', $fname);
            return $this->fetchAll($select);
        } else if ($fname == null) {
            $select->where('patient.LName = ? ', $lname);
            return $this->fetchAll($select);
        } else {
            $select->where('patient.FName = ? ', $fname);
            $select->where('patient.LName = ? ', $lname);
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
