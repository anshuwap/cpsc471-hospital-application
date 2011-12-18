<?php

class Default_Model_Doctor extends Zend_Db_Table {

    protected $_name = 'doctor';

    public function findDoctor($id) {
        /** find a User thanks to his id */
        return $this->fetchRow('DoctorId = ' . $id );
    }

}

?>
