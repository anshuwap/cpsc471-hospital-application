<?php

class Default_Model_Book extends Zend_Db_Table {

    protected $_name = 'book';
    
    public function findAll() {
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from('book', 'book.*');
        $select->join('rental', 'rental.RentalId = book.RentalId');
        return $this->fetchAll($select);
        
        //Zend_Debug::dump($select->__toString());
    }
    
}

?>
