<?php

class Default_Model_Room extends Zend_Db_Table {

    protected $_name = 'room';
    
    public function findAllRooms() {
        $select = $this->select();
        $select->setIntegrityCheck(false);
        return $this->fetchAll($select);
        
        //Zend_Debug::dump($select->__toString());
    }
	public function findRoomByFloor($floor)
	{
		$select = $this->select();
        $select->setIntegrityCheck(false);
		$select->where("Floor = ?", $floor);
        return $this->fetchAll($select);
	}
    public function findRoomById($id)
	{
		$select = $this->select();
        $select->setIntegrityCheck(false);
		$select->where("RoomId = ?", $id);
        return $this->fetchRow($select);
	}
}

?>