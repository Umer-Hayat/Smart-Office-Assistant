<?php
include_once ('classes/ExamManagement.php');
$st=new ExamManagement();
$id=$_GET['print'];
if ($_GET['print']==NULL ) {
    echo "<script>window.location='seatList.php'</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Seating Plan</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border:1px solid black;
        }
        @import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700);

        body{
            font-family: 'Source Sans Pro';
        }

        .container{
            width: 400px;
            margin: 0 auto;
        }

        a.print{
            text-decoration: none;
            display: inline-block;
            width: 75px;
            margin: 20px auto;
            background: #dc143c;
            background: linear-gradient(#e3647e, #DC143C);
            text-align: center;
            color: #fff;
            padding: 3px 6px;
            border-radius: 3px;
            border: 1px solid #e3647e;
        }

        i.fa.fa-print{
            margin-right: 5px;
        }
    </style>
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<div style="text-align: center">
    <input id="printpagebutton" type="button" value="Print Report"  onclick="printpage()"/>
    <?php
    $resultch=$st->printPlan($id,'seating_plan');
    $value = $resultch->fetch_assoc();
    $badge=$value['badgeId'];
    $roomId=$value['roomId'];
    $section=$value['section'];

    $room=$st->getAllRecord($roomId,'rooms');
    $room=$room->fetch_assoc();


    ?>
<h2>Students Seating Plan</h2>
    <h2>Room No: <?php echo $room['roomNo']; ?></h2>
    <h2>Section: <?php echo $section; ?></h2>
    <?php if($value['teacher_id']!=0)
    {

        $tt=$st->getAllRecord($value['teacher_id'],'teacher');
        $t=$tt->fetch_assoc();
        ?>
    <h2>Invigilator: <?php echo $t['name']; ?></h2>
    <?php } ?>
</div>
<table>

    <tr>
        <th>Sr.</th>
        <th>Student Name</th>
        <th>Student Roll No.</th>
    </tr>
    <?php


    $student=$st->selectStudentsByBadgeSection($badge,$section);
    $i=1;
    while ($students=$student->fetch_assoc())
    {

    ?>
    <tr>
        <td><?php echo $i ; ?></td>
        <td><?php echo $students['name']; ?></td>
        <td><?php echo $students['rollNo']; ?></td>

    </tr
<?php $i++; } ?>
</table>

<script>
    function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden'
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        printButton.style.visibility = 'visible';
    }
</script>

</body>
</html>
