<?php
class Default_Model_Schedule extends Zend_Db_Table {

    protected $_name = 'schedule';

    public function ListDate($date, $id) {

        return $this->fetchAll(
                $this->select()
                    ->where('DateS = ? ' ,$date)
                    ->where('DoctorId = ? ' ,$id));
    }

    //Trouve s'il y a une association
    public function Allocation($DoctorId, $PatientId, $DateS, $Hour) {
        return $this->fetchrow(
                       $this -> select()
                    ->where('DoctorId = ? ', $DoctorId)   
                    ->where('PatientId = ? ', $PatientId)
                    ->where('DateS = ? ', $DateS)
                    ->where('BeginTime <= ? ', $Hour)
                    ->where('EndTime > ? ', $Hour));
    }
    
        public function findAAppointment($Sid) {
            
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from('schedule', 'schedule.*'); 
        $select->join('patient', 'patient.PatientId = schedule.PatientId', array("PLName" => "patient.LName", "PFName" => "patient.FName"));
        $select->join('user', 'user.UserId = schedule.DoctorId');
        $select->join('room', 'room.RoomId = schedule.RoomId');
        $select->where('Sid = ?', $Sid);      
       
        return $this->fetchRow($select);
    }
    
    public function findNext($DoctorId) {
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from('schedule', 'schedule.*');
        $select->where('DoctorId = ? ' ,$DoctorId);
        $select->where('DateS >= CURDATE()');
        $select->where('BeginTime >= CURTIME()');
        $select->order(array('DateS DESC', 'BeginTime DESC'));
        $select->limit(1);
        return $this->fetchrow($select);
    }
}
?>
