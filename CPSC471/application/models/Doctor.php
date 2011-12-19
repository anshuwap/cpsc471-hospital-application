<?php

class Default_Model_Doctor extends Zend_Db_Table {

    protected $_name = 'doctor';

    public function findDoctor($id) {
        /** find a User thanks to his id */
        return $this->fetchRow('DoctorId = ' . $id );
    }
    
    public function findAllDoctor () {
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from('doctor', 'doctor.*'); 
        $select->join('user', 'user.UserId = doctor.DoctorId');    
        return $this->fetchAll($select);
    }

}

?>
