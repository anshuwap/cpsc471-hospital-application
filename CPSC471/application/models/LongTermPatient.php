<?php

class Default_Model_LongTermPatient extends Zend_Db_Table {

    protected $_name = 'LONGTERMPATIENT';

    public function findLongTermPatient($id) {
        /** find a User thanks to his id */
        return $this->fetchRow("PatientId = ".$id);
    }
    
    public function changeMealPlan($PatientId, $MealId) {
        $this->update(array('MealID'=> $MealId), "PatientId = ".$PatientId);
    }
}

?>
