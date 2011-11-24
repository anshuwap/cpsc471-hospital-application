<?php

class Default_Model_User extends Zend_Db_Table {

    protected $_name = 'USER';

    public function findUser($id) {
        /** find a User thanks to his id */
        return $this->fetchRow('UserId = ' . $id );
    }

}

?>
