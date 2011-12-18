<?php


class FormSearchDate extends Zend_Form {

       public function __construct($options = null) {
           
        parent::__construct($options);
        $this->setName('search_date');

        $Date = new Zend_Form_Element_Text('Date');
        $Date ->setLabel('Date :');
        $Date->setrequired(true);
        $Date->addValidator('Date', 'YYYY-MM-DD',array('messages' => 'The format of the date is YYYY-MM-DD'));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Search');
        $this->addElements(array($Date, $submit));
    }

}

?>
