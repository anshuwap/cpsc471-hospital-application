<?php

class Default_Model_Alert extends Zend_Db_Table {

    protected $_name = 'alerts';
    
    public function findReceivedAlerts($userId) {
  
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from('alerts', 'alerts.*');
        $select->join('user', 'user.UserId = alerts.SenderId');
        $select->where('alerts.ReceiverId = ?', $userId);
        $select->order(array('DateA DESC', 'TimeA DESC'));
        return $this->fetchAll($select);
        
    }
    
        public function findLastReceivedAlerts($userId) {
  
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from('alerts', 'alerts.*');
        $select->join('user', 'user.UserId = alerts.SenderId');
        $select->where('alerts.ReceiverId = ?', $userId);
        $select->order(array('DateA DESC', 'TimeA DESC'));
        $select->limit(1);
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
    
    public function deleteAlert($senderId, $receiverId, $time) {
        $where = 'SenderId = ' . $senderId. ' and ReceiverId = '. $receiverId .
                ' and TimeA = \''. $time.'\'';
        $this->delete($where);
    }
    
}

?>
