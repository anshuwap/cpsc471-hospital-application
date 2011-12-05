<?php

class Default_Model_Dvd extends Zend_Db_Table {

    protected $_name = 'DVD';

    public function findAll() {
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from('DVD', 'DVD.*');
        $select->join('RENTAL', 'RENTAL.RentalId = DVD.RentalId');
        return $this->fetchAll($select);
    }    
}

?>
