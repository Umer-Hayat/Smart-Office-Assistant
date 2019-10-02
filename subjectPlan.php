<?php
include_once 'classes/database.php';

$db=new Database();
$badge=$_POST['badge'];
$query="select DISTINCT section from student where badgeId='$badge' AND subjectStatus='0'";
$result=$db->select($query);



$data=array();

if($result) {

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
        $section = $row['section'];
        $query1 = "select *  from student where  badgeId='$badge' AND section='$section' AND subject='0'";
        $result1 = $db->select($query1);
        $count = mysqli_num_rows($result1);
        $data[]['tcount'] = $count;
    }

}else
{
    $data[0]['section']="No Student";
}

 echo json_encode($data);



?>
