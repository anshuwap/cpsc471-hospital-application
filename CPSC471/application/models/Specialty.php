<?php

class Default_Model_Specialty extends Zend_Db_Table {

    protected $_name = 'SPECIALITY';
    protected $_primary = 'DoctorId';
    
    public function findAll() {
        return $this->fetchAll();
        
        //Zend_Debug::dump($select->__toString());
    }
    
}

?>
