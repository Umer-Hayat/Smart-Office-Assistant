<!DOCTYPE html>
<html lang="en">

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

    <?php
    include_once 'classes/StudentManagement.php';
    $st=new StudentManagement();
    if (isset($_POST['addld']))
    {
        $name=$_POST['name'];
        $fname=$_POST['fname'];
        $badge=$_POST['badge'];
        $rollNo=$_POST['rollNo'];
        $cnic=$_POST['cnic'];
        $mobile=$_POST['mobileNo'];
        $section=$_POST['section'];
        $program=$_POST['program'];
        $semester=$_POST['semester'];
        $address=$_POST['address'];
        $check = $st->addStudent($name,$fname,$badge,$rollNo,$cnic,$mobile,$section,$program,$semester,$address);
    }

    ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Student</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-----New Row---->
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <b>Add Student</b>
                    </div>
                    <div class="panel-body">
                        <form role="form" class="col-lg-12" method="post" action="addStudent.php">
                                 <div class="row">
                                     <div style="color:red; text-align: center; font-size:16px;"><?php
                                         if (isset($_POST['addld'])) {
                                             echo "$check";
                                         }
                                         ?>
                                  </div>
                                 </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Student Name:</label>
                                    <input class="form-control"  required type="text" name="name"  placeholder="Student Name" />
                                </div>

                            <div class="form-group">
                                <label>Student Badge:</label>
                                <select class="form-control" required name="badge">
                                    <option value="">Choose Type</option>
                                    <?php
                                    $letter=$st->getAllRecords('student_badge');
                                    if($letter)
                                    {
                                    while ($getAll=$letter->fetch_assoc())
                                    {
                                    ?>
                                    <option value="<?php echo $getAll['id']; ?>"><?php echo $getAll['badge']; ?></option>
                                    <?php }}?>
                                </select>
                            </div>
                                <div class="form-group">
                                    <label>Cnic:</label>
                                    <input class="form-control"  required type="number" name="cnic"  placeholder="Enter Cnic" />
                                </div>

                                <div class="form-group">
                                    <label>Section:</label>
                                    <select class="form-control" required name="section">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Semeter:</label>
                                    <select class="form-control" required name="semester">
                                        <option value="1">Semester 1</option>
                                        <option value="2">Semester 2</option>
                                        <option value="3">Semester 3</option>
                                        <option value="4">Semester 4</option>
                                        <option value="5">Semester 5</option>
                                        <option value="6">Semester 6</option>
                                        <option value="7">Semester 7</option>
                                        <option value="8">Semester 8</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Father Name:</label>
                                    <input class="form-control"  required type="text" name="fname"  placeholder="Father Name" />
                                </div>
                                <div class="form-group">
                                    <label>Roll No:</label>
                                    <input class="form-control"  required type="text" name="rollNo"  placeholder="Enter Roll No. Like 01" />
                                </div>
                                <div class="form-group">
                                    <label>Mobile No:</label>
                                    <input class="form-control"  required type="number" name="mobileNo"  placeholder="Student Mobile No." />
                                </div>
                                <div class="form-group">
                                    <label>Program:</label>
                                    <select class="form-control" required name="program">
                                        <option value="BSCS">BSCS</option>
                                        <option value="M.sc (CS)">M.Sc (CS)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Address:</label>
                                    <textarea class="form-control"  required  name="address"  placeholder="Address"></textarea>
                                </div>

                            </div>
                            <div class="col-lg-8">
                            <button type="submit" name="addld" class="btn btn-primary"><i class="fa fa-sign-out fa-fw"></i> Add Item</button>
                            <button type="reset" class="btn btn-primary"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>

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

<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
