<?php
class Default_Model_Schedule extends Zend_Db_Table {

    protected $_name = 'schedule';

    public function ListDate($date) {

        return $this->fetchAll(
                $this->select()
                    ->where('DateS = ? ' ,$date));
    }

    //Trouve s'il y a une association
    public function  Allocation($DoctorId, $PatientId, $DateS, $Hour) {
        return $this->fetchrow(
                       $this -> select()
                    ->where('DoctorId = ? ', $DoctorId)   
                    ->where('PatientId = ? ', $PatientId)
                    ->where('DateS = ? ', $DateS)
                    ->where('BeginTime <= ? ', $Hour)
                    ->where('EndTime > ? ', $Hour));
    }
}
?>
