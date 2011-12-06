<?php

class Default_Model_Rent extends Zend_Db_Table {

    protected $_name = 'RENT';
    
    public function userRents($id) {
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from('RENT', 'RENT.*');
        $select->join('RENTAL', 'RENTAL.RentalId = RENT.RentalId');
        $select->where('LongTermID = ? ' ,$id)
               ->where('CURDATE() <= EndDate'); 
        return $this->fetchAll($select);
    } 
    
    public function addRent($RentalId, $PatientId, $BeginDate, $EndDate) {
        $row = $this->createRow();
        $row->RentalId = $RentalId;
        $row->LongTermID = $PatientId;
        $row->BeginDate = $BeginDate;
        $row->EndDate = $EndDate;
        $row->save();

    }
    
    public function rentIsPossible($RentalId, $BeginDate, $EndDate) {
        return $this->fetchAll(
                      $this -> select()
                    ->where('RentalId = ? ', $RentalId)
                    ->where(" ( BeginDate <= '$BeginDate' AND '$BeginDate' < EndDate ) 
                            OR  ( BeginDate < '$EndDate' AND '$EndDate' <= EndDate )
                            OR  ( BeginDate >= '$BeginDate' AND '$EndDate' >= EndDate )"));
    }

}

?>
