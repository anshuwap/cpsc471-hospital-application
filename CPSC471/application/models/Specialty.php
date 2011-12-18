<?php

class Default_Model_Specialty extends Zend_Db_Table {

    protected $_name = 'speciality';
    protected $_primary = 'DoctorId';
    
    public function findAll() {
        return $this->fetchAll();
        
        //Zend_Debug::dump($select->__toString());
    }
    
     public function findAllForADoctor($DoctorId) {
        return $this->fetchAll('DoctorId = ' . $DoctorId );      
    }
    
}

?>
