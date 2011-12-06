<?php

class Default_Model_User extends Zend_Db_Table {

    protected $_name = 'USER';

    public function findUser($id) {
        /** find a User thanks to his id */
        return $this->fetchRow('UserId = ' . $id );
    }
    
    public function findAllUsers() {
        return $this->fetchAll();
    }

    public function findUserWithName($lname, $fname) {
        
        $select = $this->select();
        
        if ( $lname == null && $fname ==null ) {
            return $this->findAllUsers();
        } else if ( $lname == null ) {
            $select->where('FName = ? ' ,$fname);
            return $this->fetchAll($select);
        } else if ( $fname == null ) {
            $select->where('LName = ? ' ,$lname);
            return $this->fetchAll($select);
        } else { 
            $select->where('FName = ? ' ,$fname);
            $select->where('LName = ? ' ,$lname);
            return $this->fetchAll($select);
        }
    }
}

?>
