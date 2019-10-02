<html lang="en">
<?php include_once 'classes/StudentManagement.php';
$st=new StudentManagement();
if(isset($_GET['del']))
{
    $result=$st->deleteStudent($_GET['del'],'student');
    if($result)
       echo " <script>alert('Student Busy In seating deallocate first');</script>";
    echo '<script>window.location.replace("studentList.php")</script>';
}
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Smart Assistent</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">


    <!-- Morris Charts CSS -->
    <link href="vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include_once 'includes/navbar.php'?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Student List</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-----New Row---->
            <a href="addStudent.php" class="btn btn-primary">Student Item</a>
            <br><br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Student List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Student Name.</th>
                                    <th>Father Name</th>
                                    <th>Roll No</th>
                                    <th>Program</th>
                                    <th>Section</th>
                                    <th>Semester</th>
                                    <th>Operation</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $letter=$st->getAllRecords('student');
                                    if($letter)
                                    {
                                        while ($getAll=$letter->fetch_assoc())
                                        {
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $getAll['name']; ?></td>
                                    <td><?php echo $getAll['fatherName']; ?></td>
                                    <td><?php echo $getAll['rollNo']; ?></td>
                                    <td><?php echo $getAll['program']; ?></td>
                                    <td><?php echo $getAll['section']; ?></td>
                                    <td><?php echo "Semeter ".$getAll['semester']; ?></td>
                                    <td><a class="btn btn-primary" href="updateStudent.php?edit=<?php echo $getAll['id']; ?>">Edit</a> <a class="btn btn-danger" onclick="return confirm('Are you sour to delete!')" href="studentList.php?del=<?php echo $getAll['id'];?>">Delete</a></td>
                                </tr>
                                <?php }} ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="vendor/raphael/raphael.min.js"></script>
    <script src="vendor/morrisjs/morris.min.js"></script>
    <script src="data/morris-data.js"></script>

    <!-- DataTables JavaScript -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>
</body>

</html>
