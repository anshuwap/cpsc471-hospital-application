<?php

class Default_Model_Patient extends Zend_Db_Table {

    protected $_name = 'PATIENT';

    public function findPatient($fname, $lname, $adress) {
        /** find a User thanks to his id */
        return $this->fetchRow("FName='".$fname. "' and LName='".$lname.
                "' and Adress= '".$adress."'");
    }
    
}

?>
