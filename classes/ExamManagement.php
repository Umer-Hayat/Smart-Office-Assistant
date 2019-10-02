<?php
$filepath=realpath(dirname(__FILE__)); 
include_once ($filepath.'/session.php');
include_once ($filepath.'/database.php');
include_once ($filepath.'/format.php');

require_once 'Twilio/autoload.php';
use Twilio\Rest\Client;

class ExamManagement
{   private $db;
    private $fm;
	function __construct()
	{
		$this->db=new Database();
		$this->fm=new Format();
	}

	public function sendSMS($id)
    {
        $query="select * from seating_plan where id='$id'";
        $result=$this->db->select($query);
        $seat=$result->fetch_assoc();
        $roomId=$seat['roomId'];
        $badge=$seat['badgeId'];
        $teacher=$seat['teacher_id'];
        $section=$seat['section'];

        $query1="select * from rooms where id='$roomId'";
        $result1=$this->db->select($query1);
        $room=$result1->fetch_assoc();
        $roomNo=$room['roomNo'];

        $query3="select * from teacher where id='$teacher'";
        $result3=$this->db->select($query3);
        $teacher=$result3->fetch_assoc();
        $phone=$teacher['phone'];

        $no=$phone;

        $query2="select * from student where badgeId='$badge' AND section='$section' AND status='1'";
        $result2=$this->db->select($query2);
        while($student=$result2->fetch_assoc())
        {
            $no.=",".$student['phone'];
        }



        $msg="Exam Center Information Room NO:$roomNo";


        $sid = "ACde97d48a749e1275b92fe834e3ccc870";
        $token = "19da7f4637c482dab592502ab517ea9e";

        $client = new Client($sid, $token);


        $tno=(explode(",",$no));

        for ($i=0; $i < count($tno); $i++)
        {
            $call=$client->messages->create(
                $tno[$i],
                array(
                    'from' => '+164736059983123',
                    'body' => "$msg"
                )
            );

            echo $call->sid." ".$i."<br>";

            $query = "update seating_plan set sms='1' where id='$id'";
            $result = $this->db->update($query);

        }




    }

	public function addRoom($roomNo,$roomCapacity)
    {
        $query1="select * from rooms where roomNo='$roomNo'";
        $result1=$this->db->select($query1);

        if(!$result1) {
            $query = "INSERT INTO rooms(roomNo,roomCapacity) VALUES('$roomNo','$roomCapacity')";
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "Data Inserted";
                return $msg;
            } else {
                $msg = "Data Not Inserted";
                return $msg;
            }
        }else
        {
            $msg = "Data Not Inserted Room No Already Exits";
            return $msg;
        }
    }

    public function addPlan($roomNo,$badge,$section)
    {
        $querych = "select *  from student where badgeId='$badge' AND section='$section'";
        $resultch = $this->db->select($querych);
        $count = mysqli_num_rows($resultch);

        $myquery="select * from rooms where id='$roomNo'";
        $myresult=$this->db->select($myquery);
        $value = $myresult->fetch_assoc();
        $mycapacity=$value['roomCapacity'];


        if($count<$mycapacity)
        {
            $query = "INSERT INTO seating_plan(roomId,badgeId,section) VALUES('$roomNo','$badge','$section')";
            $result = $this->db->insert($query);
            if ($result) {
                $query1 = "update student set status='1' where badgeId='$badge' AND section='$section'";
                $result1 = $this->db->update($query1);
                $query2 = "update rooms set status='1',occupiedSpace='$count' where id='$roomNo'";
                $result2 = $this->db->update($query2);

                $msg = "Data Inserted";
                return $msg;
            } else {
                $msg = "Data Not Inserted";
                return $msg;
            }

        }
        else
        {
            $msg = "Student Exceeded To Room Capacity";
            return $msg;
        }
    }

    public function updateRoom($roomNo,$roomCapacity,$id)
    {
        $query = "update rooms set roomNo='$roomNo', roomCapacity='$roomCapacity' where id='$id'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "Data Updated";
            return $msg;
        } else {
            $msg = "Data Not Updated";
            return $msg;
        }
    }




    public function getAllRecords($table)
    {
        $query="select * from $table";
        $result=$this->db->select($query);
        return $result;
    }

    public function getAllRecord($id,$table)
    {
        $query="select * from $table where id='$id'";
        $result=$this->db->select($query);
        return $result;
    }

    public function getAllRecordByQuery($query)
    {
        $query="$query";
        $result=$this->db->select($query);
        return $result;
    }


    public function deleteitem($id,$table)
    {
        $query="delete from $table where id='$id'";
        $result=$this->db->delete($query);
        return $result;
    }



    public function delatePlan($id,$table)
    {
        $querych = "select *  from $table where id='$id'";
        $resultch = $this->db->select($querych);
        $value = $resultch->fetch_assoc();
         $badge=$value['badgeId'];
         $roomId=$value['roomId'];
         $teacherId=$value['teacher_id'];
         $section=$value['section'];

        $query1 = "update student set status='0' where badgeId='$badge' AND section='$section'";
        $result1 = $this->db->update($query1);
        $query2 = "update rooms set status='0',occupiedSpace='0' where id='$roomId'";
        $result2 = $this->db->update($query2);
            if($teacherId) {
                $query6 = "update teacher set status='0' where id='$teacherId'";
                $result6 = $this->db->update($query6);
            }

        $query="delete from $table where id='$id'";
        $result=$this->db->delete($query);


        return $result;
    }


    public function printPlan($id,$table)
    {
        $querych = "select *  from $table where id='$id'";
        $resultch = $this->db->select($querych);
        return $resultch;
    }

    public function deletePlan($id,$table)
    {
        $querych = "select *  from seating_plan where roomId='$id'";
        $resultch = $this->db->select($querych);
        if($resultch)
        {
            return false;
        }
        else
        {
            $query="delete from $table where id='$id'";
            $result=$this->db->delete($query);
            return $result;
        }
    }

    public function selectStudentsByBadgeSection($badge,$section)
    {
        $query1 = "select * from student where badgeId='$badge' AND section='$section' AND status='1'";
        $result1 = $this->db->select($query1);
        return $result1;
    }
    public function addSubject($badge,$section,$sub)
    {
        $query="INSERT INTO subject_allot(badgeId,section,subject) VALUES('$badge','$section','$sub')";
        $result=$this->db->insert($query);
        return $result;
    }

}


?>