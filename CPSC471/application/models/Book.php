<?php

class Default_Model_Book extends Zend_Db_Table {

    protected $_name = 'BOOK';
    
    public function findAll() {
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from('BOOK', 'BOOK.*');
        $select->join('RENTAL', 'RENTAL.RentalId = BOOK.RentalId');
        return $this->fetchAll($select);
        
        //Zend_Debug::dump($select->__toString());
    }
    
}

?>
