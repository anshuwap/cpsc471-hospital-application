<?php

class Default_Model_Secretary extends Zend_Db_Table {

    protected $_name = 'secretary';
    
    public function findAll() {
        return $this->fetchAll();
        
        //Zend_Debug::dump($select->__toString());
    }
    
}

?>
