<?php

class Default_Model_Secretary extends Zend_Db_Table {

    protected $_name = 'secretary';
    
    public function findASecretary($id) {
        return $this->fetchRow('SecretaryId = ' . $id );
    }
    
}

?>
