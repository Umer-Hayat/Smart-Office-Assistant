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
    include_once 'classes/StackManagement.php';
    $st=new StackManagement();
    if (isset($_POST['addld']))
    {

        $title=$_POST['title'];
        $date=$_POST['date'];
        $particulars=$_POST['particulars'];
        $voucher=$_POST['voucher'];
        $balance=$_POST['balance'];
        $check = $st->addStationaryReceipt($title,$date, $particulars,$voucher,$balance);
    }

    ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Stationary Receipt</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-----New Row---->
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <b>Add Stationary Receipt</b>
                    </div>
                    <div class="panel-body">
                        <form role="form" class="col-lg-12" method="post" action="addStationaryReceipt.php">
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
                                <label>Title:</label>
                                <select class="form-control" required name="title">
                                    <option value=" ">Choose Type</option>
                                    <?php
                                    $letter=$st->getAllRecords('stationary_list');
                                    if($letter)
                                    {
                                    while ($getAll=$letter->fetch_assoc())
                                    {
                                    ?>
                                    <option value="<?php echo $getAll['id']; ?>"><?php echo $getAll['title']; ?></option>
                                    <?php }}?>
                                </select>
                            </div>
                                <div class="form-group">
                                    <label>Particulars:</label>
                                    <input class="form-control"  required type="text" name="particulars"  placeholder="Particulars" />
                                </div>
                                <div class="form-group">
                                    <label>Balance:</label>
                                    <input class="form-control"  required type="text" name="balance"  placeholder="Balance" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date:</label>
                                    <input class="form-control"  required type="date" name="date"  placeholder="Date" />
                                </div>
                                <div class="form-group">
                                    <label>Voucher:</label>
                                    <input class="form-control"  required type="text" name="voucher"  placeholder="Voucher" />
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
