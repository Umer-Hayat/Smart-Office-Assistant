<?php
include_once "classes/session.php";
Session::checkSession();
?>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="dashboard.php">Smart Assistant Admin</a>
    </div>
    <ul class="nav navbar-top-links navbar-right">

        <!-- /.dropdown -->

        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="changepass.php"><i class="fa fa-user fa-fw"></i>Change Password</a>
                </li>
                <li class="divider"></li>
                <li><a href="?action=logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
                 <?php
                            if (isset($_GET['action']) && $_GET['action']=="logout") {
                                session::destroy();
                            }
                            ?>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search..." disabled>
                        <span class="input-group-btn">
                                <button class="btn btn-default" type="button" disabled>
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                    </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="##"><i class="fa fa-american-sign-language-interpreting" aria-hidden="true"></i> Stack Management<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="stationaryList.php">Stationary List</a>
                        </li>
                        <li>
                            <a href="stationaryAvailable.php">Stationary Available</a>
                        </li>
                        <li>
                            <a href="stationaryReceipt.php">Stationary Receipt</a>
                        </li>
                        <li>
                            <a href="stationaryIssued.php">Stationary Issued</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="##"><i class="fa fa-file" aria-hidden="true"></i> File Management<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        </li>
                        <li>
                            <a href="letterReceived.php">Letter Received</a>
                        </li>
                        <li>
                            <a href="letterDespatched.php">Letters Despatched</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="##"><i class="fa fa-user" aria-hidden="true"></i> Student Management<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="badgeList.php">student badge</a>
                            <a href="studentList.php">Student List</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="##"><i class="fa fa-book" aria-hidden="true"></i> Course Management<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="courseList.php">Course List</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="##"><i class="fa fa-file" aria-hidden="true"></i> Exam Management<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="roomList.php">Room List</a>
                        </li>
                        <li>
                            <a href="seatList.php">Seating Plan List</a>
                        </li>
                        <li>
                            <a href="subject.php">Subject List</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>