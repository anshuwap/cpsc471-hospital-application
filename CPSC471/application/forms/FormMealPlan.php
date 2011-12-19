<?php
class FormMealPlan extends Zend_Form {

    public function __construct($m = null, $options = null) {
        parent::__construct($options);
        $this->setName('mealplan');
        
        if ($m != null ) {

        $type = new Zend_Form_Element_Text('type');
        $type->setLabel('Type :');
        $type->setValue($m->Type);
        
        $sunday = new Zend_Form_Element_Text('sunday');
        $sunday->setLabel('Sunday :');
        $sunday->setValue($m->Sunday);
        
        $monday = new Zend_Form_Element_Text('monday');
        $monday->setLabel('Monday :');
        $monday->setValue($m->Monday);
        
        $tuesday = new Zend_Form_Element_Text('tuesday');
        $tuesday->setLabel('Tuesday :');
        $tuesday->setValue($m->Tuesday);
        
        $wednesday = new Zend_Form_Element_Text('wednesday');
        $wednesday->setLabel('Wednesday :');
        $wednesday->setValue($m->Wednesday);
        
        $thursday = new Zend_Form_Element_Text('thursday');
        $thursday->setLabel('Thursday :');
        $thursday->setValue($m->Thursday);
        
        $friday = new Zend_Form_Element_Text('friday');
        $friday->setLabel('Friday :');
        $friday->setValue($m->Friday);
        
        $saturday = new Zend_Form_Element_Text('saturday');
        $saturday->setLabel('Saturday :');
        $saturday->setValue($m->Saturday);
        
        } else {
            
        $type = new Zend_Form_Element_Text('type');
        $type->setLabel('Type :');
        
        $sunday = new Zend_Form_Element_Text('sunday');
        $sunday->setLabel('Sunday :');
        
        $monday = new Zend_Form_Element_Text('monday');
        $monday->setLabel('Monday :');
        
        $tuesday = new Zend_Form_Element_Text('tuesday');
        $tuesday->setLabel('Tuesday :');
        
        $wednesday = new Zend_Form_Element_Text('wednesday');
        $wednesday->setLabel('Wednesday :');
        
        $thursday = new Zend_Form_Element_Text('thursday');
        $thursday->setLabel('Thursday :');
        
        $friday = new Zend_Form_Element_Text('friday');
        $friday->setLabel('Friday :');
        
        $saturday = new Zend_Form_Element_Text('saturday');
        $saturday->setLabel('Saturday :');        
            
        }

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Edit');
        $this->addElements(array($type, $sunday, $monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $submit));
        
    }
}

?>
