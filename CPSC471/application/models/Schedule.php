<?php
class Default_Model_Schedule extends Zend_Db_Table {

    protected $_name = 'schedule';

    public function ListDate($date, $id) {

        return $this->fetchAll(
                $this->select()
                    ->where('DateS = ? ' ,$date)
                    ->where('DoctorId = ? ' ,$id));
    }
	public function ListDateAll($date) {

        return $this->fetchAll(
                $this->select()
                    ->where('DateS = ? ' ,$date));
    }
	public function findAllSchedules(){
		try{
		return $this->fetchAll(
                $this->select()
				->from(array('s' => "schedule"))
				->join(array('u' => 'user'), 'u.UserId = s.DoctorId', array("DFName" => "FName", "DLName"=>"LName"))
				->join(array('p' => 'patient'), 'p.PatientId = s.PatientId', array("PFName" => "FName", "PLName"=>"LName"))
				->join(array('r' => 'room'), 'r.RoomId = s.RoomId', array("Number", "Floor", "RoomType"))
				->order(array("s.DateS DESC", "s.BeginTime DESC"))
				->setIntegrityCheck(false));
		}
				catch(Exception $e)
				{
					return $e->getMessage();
				}
	}
	public function findSchedulesByPatient($fname, $lname)
	{
		if ($fname == NULL and $lname == NULL)
		{
			return $this->fetchAll(
                $this->select()
				->from(array('s' => "schedule"))
				->join(array('u' => 'user'), 'u.UserId = s.DoctorId', array("DFName" => "FName", "DLName"=>"LName"))
				->join(array('p' => 'patient'), 'p.PatientId = s.PatientId', array("PFName" => "FName", "PLName"=>"LName"))
				->join(array('r' => 'room'), 'r.RoomId = s.RoomId', array("Number", "Floor", "RoomType"))
				->order(array("s.DateS DESC", "s.BeginTime DESC"))
				->setIntegrityCheck(false));
		}
		elseif($fname == NULL)
        	{
        		
        		return $this->fetchAll(
                $this->select()
				->from(array('s' => "schedule"))
				->join(array('u' => 'user'), 'u.UserId = s.DoctorId', array("DFName" => "FName", "DLName"=>"LName"))
				->join(array('p' => 'patient'), 'p.PatientId = s.PatientId', array("PFName" => "FName", "PLName"=>"LName"))
				->join(array('r' => 'room'), 'r.RoomId = s.RoomId', array("Number", "Floor", "RoomType"))
				->where("p.LName = ?", $lname)
				->order(array("s.DateS DESC", "s.BeginTime DESC"))
				->setIntegrityCheck(false));
				
        	}	  
		elseif ($lname == NULL) 
		{
			return $this->fetchAll(
                $this->select()
				->from(array('s' => "schedule"))
				->join(array('u' => 'user'), 'u.UserId = s.DoctorId', array("DFName" => "FName", "DLName"=>"LName"))
				->join(array('p' => 'patient'), 'p.PatientId = s.PatientId', array("PFName" => "FName", "PLName"=>"LName"))
				->join(array('r' => 'room'), 'r.RoomId = s.RoomId', array("Number", "Floor", "RoomType"))
				->where("p.FName = ?", $fname)
				->order(array("s.DateS DESC", "s.BeginTime DESC"))
				->setIntegrityCheck(false));
		}
		else {
			return $this->fetchAll(
                $this->select()
				->from(array('s' => "schedule"))
				->join(array('u' => 'user'), 'u.UserId = s.DoctorId', array("DFName" => "FName", "DLName"=>"LName"))
				->join(array('p' => 'patient'), 'p.PatientId = s.PatientId', array("PFName" => "FName", "PLName"=>"LName"))
				->join(array('r' => 'room'), 'r.RoomId = s.RoomId', array("Number", "Floor", "RoomType"))
				->where("p.FName = ?", $fname)
				->where("p.LName = ?", $lname)
				->order(array("s.DateS DESC", "s.BeginTime DESC"))
				->setIntegrityCheck(false));
		}
        
	}
	public function deleteSchedule($sid)
	{
		
		$where = $this->getAdapter()->quoteInto('Sid= ?', $sid);
		$this->delete($where);
		
	}
    //Trouve s'il y a une association
    public function Allocation($DoctorId, $PatientId, $DateS, $Hour) {
        return $this->fetchrow(
                       $this -> select()
                    ->where('DoctorId = ? ', $DoctorId)   
                    ->where('PatientId = ? ', $PatientId)
                    ->where('DateS = ? ', $DateS)
                    ->where('BeginTime <= ? ', $Hour)
                    ->where('EndTime > ? ', $Hour));
    }
	
	public function Allocation2($DoctorId, $DateS, $Hour) {
        return $this->fetchrow(
                       $this -> select()
                    ->where('DoctorId = ? ', $DoctorId)   
                    ->where('DateS = ? ', $DateS)
                    ->where('BeginTime <= ? ', $Hour)
                    ->where('EndTime > ? ', $Hour));
    }
    
    
        public function findAAppointment($Sid) {
            
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from('schedule', 'schedule.*'); 
        $select->join('patient', 'patient.PatientId = schedule.PatientId', array("PLName" => "patient.LName", "PFName" => "patient.FName"));
        $select->join('user', 'user.UserId = schedule.DoctorId');
        $select->join('room', 'room.RoomId = schedule.RoomId');
        $select->where('Sid = ?', $Sid);      
       
        return $this->fetchRow($select);
    }
    
    public function findNext($DoctorId) {
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from('schedule', 'schedule.*');
        $select->where('DoctorId = ? ' ,$DoctorId);
        $select->where('DateS >= CURDATE()');
        $select->where('BeginTime >= CURTIME()');
        $select->order(array('DateS DESC', 'BeginTime DESC'));
        $select->limit(1);
        return $this->fetchrow($select);
    }
	public function addAppointment($did, $pid, $rid,  $date, $btime, $etime)
	{
		$data = array(
			'DoctorId'     => $did,
		    'PatientId'    => $pid,
		    'RoomId'       => $rid,
		    'DateS'	       => $date,
		    'BeginTime'	   => $btime,
		    'EndTime'      => $etime
			);
		$this->insert($data);
		
						
	}
}
?>
