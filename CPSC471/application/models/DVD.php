<?php

class Default_Model_DVD extends Zend_Db_Table {

    protected $_name = 'dvd';

    public function findAll() {
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from('dvd', 'dvd.*');
        $select->join('rental', 'rental.RentalId = dvd.RentalId');
        return $this->fetchAll($select);
    }    
}

?>
