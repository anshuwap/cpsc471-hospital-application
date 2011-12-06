<?php

class Default_Model_Alert extends Zend_Db_Table {

    protected $_name = 'ALERTS';
    
    public function findReceivedAlerts($userId) {
  
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from('ALERTS', 'ALERTS.*');
        $select->join('USER', 'USER.UserId = ALERTS.SenderId');
        $select->where('ALERTS.ReceiverId = ?', $userId);
        $select->order(array('DateA DESC', 'TimeA DESC'));
        return $this->fetchAll($select);
        
    }
    
    public function addAlert($senderId, $receiverId, $desc) {
        
        $row = $this->createRow();
        $row->SenderId = $senderId;
        $row->ReceiverId = $receiverId;
        $row->DateA = new Zend_Db_Expr('CURDATE()');
        $row->TimeA = new Zend_Db_Expr('CURTIME()');
        $row->Description = $desc;
        $row->save();
    }
    
}

?>
