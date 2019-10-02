<?php
$filepath=realpath(dirname(__FILE__)); 
include_once ($filepath.'/session.php');
include_once ($filepath.'/database.php');
include_once ($filepath.'/format.php');
class StudentManagement
{   private $db;
    private $fm;
	function __construct()
	{
		$this->db=new Database();
		$this->fm=new Format();
	}

    public function addStudent($name,$fname,$badge,$rollNo,$cnic,$mobile,$section,$program,$semester,$address)
    {
        $query4="select * from student_badge where id='$badge'";
        $result4=$this->db->select($query4);
        $badge4=$result4->fetch_assoc();
        $rollNo=$badge4['badge'].'-'.$rollNo;

        $query1="select * from student where rollNo='$rollNo'";
        $result1=$this->db->select($query1);
        $query2="select * from student where cnic='$cnic'";
        $result2=$this->db->select($query2);
        if($result1) {
            $msg = "Data Not Insert Roll No Already Exist...";
            return $msg;
        }else if($result2)
        {
            $msg = "Data Not Insert CNIC Already Exist...";
            return $msg;
        }else
        {
            $query = "INSERT INTO student(name,fatherName,rollNo,badgeId,cnic,phone,address,program,section,semester) VALUES('$name','$fname','$rollNo','$badge','$cnic','$mobile','$address','$program','$section','$semester')";
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "Data Inserted";
                return $msg;
            } else {
                $msg = "Data Not Inserted";
                return $msg;
            }
        }

    }

    public function updateStudent($name,$fname,$badge,$rollNo,$cnic,$mobile,$section,$program,$semester,$address,$id)
    {


        $query1="select * from student where rollNo='$rollNo'";
        $result1=$this->db->select($query1);
        $query2="select * from student where cnic='$cnic'";
        $result2=$this->db->select($query2);

        if($result1 && $result2)
        {
            $query = "update student set name='$name',fatherName='$fname',badgeId='$badge',phone='$mobile',address='$address',program='$program',section='$section',semester='$semester' where id='$id'";
            $result = $this->db->insert($query);
            $msg = "Roll No and cnic Already Exist... but other information updated";
            return $msg;
        }else if($result1) {
            $query = "update student set name='$name',fatherName='$fname',badgeId='$badge',cnic='$cnic',phone='$mobile',address='$address',program='$program',section='$section',semester='$semester' where id='$id'";
            $result = $this->db->insert($query);
            $msg = "Roll No Already Exist... but other information updated";
            return $msg;
        }else if($result2)
        {
            $query = "update student set name='$name',fatherName='$fname',rollNo='$rollNo',badgeId='$badge',phone='$mobile',address='$address',program='$program',section='$section',semester='$semester' where id='$id'";
            $result = $this->db->insert($query);
            $msg = "Data Not Insert CNIC Already Exist... but other information updated";
            return $msg;
        }else
        {
            $query4="select * from student_badge where id='$badge'";
            $result4=$this->db->select($query4);
            $badge4=$result4->fetch_assoc();
            $rollNo=$badge4['badge'].'-'.$rollNo;

            $query = "update student set name='$name',fatherName='$fname',rollNo='$rollNo',badgeId='$badge',cnic='$cnic',phone='$mobile',address='$address',program='$program',section='$section',semester='$semester' where id='$id'";
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "Data Inserted";
                return $msg;
            } else {
                $msg = "Data Not Inserted";
                return $msg;
            }
        }

    }

	public function addBadge($badge)
    {

        $query="INSERT INTO student_badge(badge) VALUES('$badge')";
        $result=$this->db->insert($query);
        if ($result) {
            $msg = "Data Inserted";
            return $msg;
        } else {
            $msg = "Data Not Inserted";
            return $msg;
        }

    }

    public function updateBadge($badge,$id)
    {
        $query = "update student_badge set badge='$badge' where id='$id'";
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


    public function deleteStudent($id,$table)
    {
        $querych = "select *  from student where id='$id' AND status='1'";
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

    public function addSubject($badge,$section,$sub)
    {
        $query="INSERT INTO subject_allot(badgeId,section,subject) VALUES('$badge','$section','$sub')";
        $result=$this->db->insert($query);
        return $result;
    }





}


?>