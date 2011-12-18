<?php

class Default_Model_MealPlan extends Zend_Db_Table {

    protected $_name = 'mealplan';

    public function mealPlans() {
        return $this->fetchAll();
    }
    
    public function findMealPlan($MealId) {
        return $this->fetchRow('MealId = ' . $MealId );
    }
    
}

?>
