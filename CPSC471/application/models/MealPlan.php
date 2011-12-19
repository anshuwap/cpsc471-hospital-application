<?php

class Default_Model_MealPlan extends Zend_Db_Table {

    protected $_name = 'mealplan';

    public function mealPlans() {
        return $this->fetchAll();
    }
    
    public function findMealPlan($MealId) {
        return $this->fetchRow('MealId = ' . $MealId );
    }
    
    public function editMealPlan($MealId, $Type, $Sunday, $Monday, $Tuesday, $Wednesday, $Thursday, $Friday, $Saturday) {
        $this->update(array('Type'=> $Type, "Sunday" => $Sunday, 
            "Monday" => $Monday, "Tuesday" => $Tuesday, "Wednesday" => $Wednesday, "Thursday" => $Thursday, "Friday" => $Friday, "Saturday" => $Saturday )
              , "MealId = ".$MealId);
    }
    
    public function createMealPlan($Type, $Sunday, $Monday, $Tuesday, $Wednesday, $Thursday, $Friday, $Saturday) {
        $result = $this->fetchrow("1","MealId desc");
        $id = $result->MealId + 1;
        
        $row = $this->createRow();
        $row->MealId = $id;
        $row->Type= $Type;
        $row->Sunday = $Sunday;
        $row->Monday = $Monday;
        $row->Tuesday = $Tuesday;
        $row->Wednesday = $Wednesday;
        $row->Thursday = $Thursday;
        $row->Friday = $Friday;
        $row->Saturday = $Saturday;
        $row->save();
    }
    
    public function deleteMealPlan($mealid) {
        $where = 'MealId = ' . $mealid;
        $this->delete($where);
    }
    
}

?>
