<?php
$filepath=realpath(dirname(__FILE__)); 
include_once ($filepath.'/session.php');
include_once ($filepath.'/database.php');
include_once ($filepath.'/format.php');
class Course
{   private $db;
    private $fm;
	function __construct()
	{
		$this->db=new Database();
		$this->fm=new Format();
	}

	public function addCourse($code,$title)
    {
        $query1="select * from course where course_code='$code'";
        $result1=$this->db->select($query1);
        if(!$result1) {
            $query = "INSERT INTO course(course_code,course_title) VALUES('$code','$title')";
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
            $msg = "Data Not Inserted Course Code Already Exits";
            return $msg;
        }
    }



    public function updateCourse($code,$title,$id)
    {
        $query = "update course set course_code='$code', course_title='$title' where id='$id'";
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



}


?>