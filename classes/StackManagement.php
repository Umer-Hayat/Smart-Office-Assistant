<?php
$filepath=realpath(dirname(__FILE__)); 
include_once ($filepath.'/session.php');
include_once ($filepath.'/database.php');
include_once ($filepath.'/format.php');
class StackManagement
{   private $db;
    private $fm;
	function __construct()
	{
		$this->db=new Database();
		$this->fm=new Format();
	}

	public function addLetterReceived($date, $letterno,$fromwhomreceived,$subject,$filehead,$disposal)
    {
       // $date = new DateTime("now", new DateTimeZone('Asia/Karachi') );
       // $inTime = $date->format('H:i:s');
       // $entryInDate = $date->format('Y-m-d');

        $query="INSERT INTO letter_received(date,letterNo,fromWhomReceived,subject,filehead,disposal) VALUES('$date','$letterno','$fromwhomreceived','$subject','$filehead','$disposal')";
        $result=$this->db->insert($query);
        if ($result) {
            $msg = "Data Inserted";
            return $msg;
        } else {
            $msg = "Data Not Inserted";
            return $msg;
        }

    }
    public function addLetterDespatched($date, $nameAndAdress,$place,$subject)
    {

        $query="INSERT INTO letter_despatched(title,date,nameAndAddress,place,subject) VALUES('$date','$nameAndAdress','$place','$subject')";
        $result=$this->db->insert($query);
        if ($result) {
            $msg = "Data Inserted";
            return $msg;
        } else {
            $msg = "Data Not Inserted";
            return $msg;
        }

    }

    public function addStationaryReceipt($title,$date, $particulars,$voucher,$balance)
    {
        $query3="select * from stationary_list where id='$title'";
        $check3=$this->db->select($query3);
        $value3=$check3->fetch_assoc();
        $mytitle=$value3['title'];


        $query="INSERT INTO stationary_receipt(title,date,particulars,voucher,balance) VALUES('$mytitle','$date','$particulars','$voucher','$balance')";
        $result=$this->db->insert($query);
        if ($result) {
            $query1="select * from stationary_available where title='$title'";
            $check1=$this->db->select($query1);
            if($check1)
            {
                $value=$check1->fetch_assoc();
                $available=$balance+$value['available'];
                $query = "update stationary_available set available='$available' where title='$title'";
                $result = $this->db->update($query);

            }else
            {
                $query="INSERT INTO stationary_available(title,available) VALUES('$title','$balance')";
                $result=$this->db->insert($query);
            }

            $msg = "Data Inserted";
            return $msg;
        } else {
            $msg = "Data Not Inserted";
            return $msg;
        }


    }
    public function updateStationaryReceipt($title,$date, $particulars,$voucher,$balance,$id)
    {
        $query="update stationary_receipt set title='$title',date='$date',particulars='$particulars',voucher='$voucher',balance='$balance' where id='$id'";
        $result=$this->db->update($query);
        if ($result) {
            $msg = "Update Inserted";
            return $msg;
        } else {
            $msg = "Update Not Inserted";
            return $msg;
        }
    }

    public function updateStationaryIssue($title,$date, $particulars,$issue,$id)
    {
        $query="update stationary_issued set title='$title',date='$date',particulars='$particulars',issued='$issue' where id='$id'";
        $result=$this->db->update($query);
        if ($result) {
            $msg = "Update Inserted";
            return $msg;
        } else {
            $msg = "Update Not Inserted";
            return $msg;
        }
    }


    public function addStationary($title)
    {
        $query="INSERT INTO stationary_list(title) VALUES('$title')";
        $result=$this->db->insert($query);
        if ($result){
            $msg = "Data Inserted";
            return $msg;
        } else {
            $msg = "Data Not Inserted";
            return $msg;
        }
    }



    public function issue($id,$date, $issue,$quantity)
    {

        $queryf="select * from stationary_available where id='$id'";
        $checkf=$this->db->select($queryf);
        $valuef=$checkf->fetch_assoc();
        $title=$valuef['title'];

        $query1="select * from stationary_available where title='$title'";
        $check1=$this->db->select($query1);
        $value=$check1->fetch_assoc();
        $available=$value['available'];

        if($available<$quantity)
        {
            $msg = "Your Quantity exceeded from Available";
            return $msg;
        }else {
            $queryd="select * from stationary_list where id='$title'";
            $checkd=$this->db->select($queryd);
            $valued=$checkd->fetch_assoc();
            $titled=$valued['title'];


            $query = "INSERT INTO stationary_issued(title,issued,particulars,date) VALUES('$titled','$quantity','$issue','$date')";
            $result = $this->db->insert($query);
            if ($result) {
                $available=$available-$quantity;
                $query = "update stationary_available set available='$available' where id='$id'";
                $result = $this->db->update($query);

                $msg = "Data Inserted";
                return $msg;
            } else {
                $msg = "Data Not Inserted";
                return $msg;
            }
        }
    }


    public function updateLetterReceived($date, $letterno,$fromwhomreceived,$subject,$filehead,$disposal,$id)
    {
            $query = "update letter_received set date='$date',letterNo='$letterno',fromWhomReceived='$fromwhomreceived',subject='$subject',FileHead='$filehead',disposal='$disposal'  where id='$id'";
            $result = $this->db->update($query);
            if ($result) {
                $msg = "Data Updated";
                return $msg;
            } else {
                $msg = "Data Not Updated";
                return $msg;
            }


    }

    public function updateLetterDespatched($date, $nameAndAdress,$place,$subject,$id)
    {
        $query = "update letter_despatched set date='$date',nameAndAddress='$nameAndAdress',place='$place',subject='$subject' where id='$id'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "Data Updated";
            return $msg;
        } else {
            $msg = "Data Not Updated";
            return $msg;
        }


    }

    public function updateAvailableStationary($available,$id)
    {
        $query = "update stationary_available set available='$available' where id='$id'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "Data Updated";
            return $msg;
        } else {
            $msg = "Data Not Updated";
            return $msg;
        }


    }


    public function updateStationary($title,$id)
    {
        $query = "update stationary_list set title='$title' where id='$id'";
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



    public function deleteitem($id,$table)
    {
        $query="delete from $table where id='$id'";
        $result=$this->db->delete($query);
        return $result;
    }





}


?>