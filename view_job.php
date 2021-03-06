<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Provider | Trovelnama</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bold_font.css">
    <link rel="stylesheet" href="css/style_portal.css">

    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

</head>

<body id="provider_home">
<?php
    session_start();

    if (isset($_GET["id"]) && $_GET["id"] !="") {
        include 'conn.php';

        $sql = "SELECT * from job where JID=".$_GET["id"];
        $data = mysqli_query($conn, $sql) or die("Unable to contact the server.");
        $row = mysqli_fetch_assoc($data);

        if ($row["JID"] == "") {
            header("Location: jobseeker_home.php");
        }

        mysqli_close($conn);
    }

    else {
        header("Location: jobseeker_home.php");
    }

    include 'session.php';

    $GLOBALS['error'] = '';
    if (isset($_POST["LoginSubmit"])) {
        include 'login.php';
    }

    if (isset($_POST["Apply"])) {
        include 'conn.php';

        $sql = "INSERT INTO `jobapplications`(`JID`, `UID`, `Date`) VALUES (".$row['JID'].", ".$_SESSION['UID'].",'".date('Y-m-d')."')";

        $data = mysqli_query($conn, $sql) or die("Unable to contact the server.");

        header("Location: view_job.php?id=".$_GET['id']);

        mysqli_close($conn);
    }

    if (isset($_POST["Done"])) {
        include 'conn.php';

        $sql = "INSERT INTO `historicdata`(`UID_Finder`, `UID_Provider`, `Title`, `Location`, `Date`, `Duration`, `Description`, `Stipend`, `Status`, `DatePosted`, `DateHired`) SELECT `UID_Finder`, `UID_Provider`, `Title`, `Location`, `DateReq`, `Duration`, `Description`, `Stipend`, `Status`, `DatePosted`, `DateHired` FROM `job` WHERE JID=".$_GET['id'];
        $data = mysqli_query($conn, $sql) or die("Server Unreachable");
        
        $sql = "DELETE FROM `job` WHERE JID=".$_GET['id']; 
        $data = mysqli_query($conn, $sql) or die("Server Unreachable");
        $sql = "DELETE FROM jobapplications where JID=".$_GET['id'];
        $data = mysqli_query($conn, $sql) or die("Server Unreachable");
        header("Location: jobseeker_home.php");

        mysqli_close($conn);
    }

    if (isset($_POST["Cancel"])) {
        
        include 'conn.php';

        $sql = "DELETE FROM `jobapplications` WHERE UID=".$_SESSION['UID']." and JID=".$_GET['id'];
        $data = mysqli_query($conn, $sql);

        header("Location: ".$_SERVER['REQUEST_URI']);

        mysqli_close($conn);
    }

    if (isset($_GET["accept"]) && $_GET["accept"]!="") {
        
        include 'conn.php';

        $sql = "UPDATE `job` SET `UID_Finder`=\"".$_GET['accept']."\", `Status`=1, DateHired=\"".date('Y-m-d')."\" WHERE JID=".$_GET['id'];
        $data = mysqli_query($conn, $sql);

        header("Location: view_job.php?id=".$_GET['id']);

        mysqli_close($conn);
    }
?>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top navbar-portal">
        <div class="container">
            <a href="index.php" class="navbar-brand"><img src="img/logo.png"></a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item nav-item-portal">
                        <a href="jobseeker_home.php" class="nav-link nav-link-portal"><span class="fa fa-address-card pr-2"></span>JobProvider</a>
                    </li>
                    <li class="nav-item nav-item-portal">
                        <a href="jobprovider_home.php" class="nav-link nav-link-portal"><span class="fa fa-address-card pr-2"></span>JobSeeker</a>
                    </li>
    
                    <?php
                        if(!isset($_SESSION["UID"]) || $_SESSION["UID"]=="") {
                            echo '<li class="nav-item nav-item-portal">
                                        <a href="#home" class="nav-link nav-link-portal" data-toggle="modal" data-target="#LoginModal"><span class="fa fa-sign-in pr-2"></span>Login</a>
                                    </li>
                                    <li class="nav-item nav-item-portal">
                                        <a href="register.php" class="nav-link nav-link-portal"><span class="fa fa-user pr-2"></span>Register</a>
                                    </li>';         
                        }

                        else {
                            echo '<li class="nav-item nav-item-portal">
                                        <a href="dashboard.php" class="nav-link nav-link-portal"><span class="fa fa-address-card pr-2"></span>My Account</a>
                                    </li>
                                    <li class="nav-item nav-item-portal">
                                        <a href="logout.php" class="nav-link nav-link-portal"><span class="fa fa-address-card pr-2"></span>Log Out</a>
                                    </li>';
                        }
                    ?>
                        
                </ul>
            </div>
        </div>
    </nav>


        <!-- Header -->
    <div class="p-4">
    <section class="text-success text-center mt-5 w-100">
        <h1 class="mt-2">Job: <?php echo $row["Title"]; ?></h1>
    </section>

<section class="Profile">
    <div class="container">
        <div class="col-sm" style="width: 30vw; padding-top: 30px;"></div>
            <table class="table w-75 text-center">
                <tr>
                    <th class="w-50">Job Provider</th>
                    <td><?php echo '<a href="view_account.php?id='.$row["UID_Provider"].'">'.$row["UID_Provider"].'</a>';?></td>
                </tr>
                <tr>
                    <th>Seeked by</th>
                    <td><?php echo '<a href="view_account.php?id='.$row["UID_Finder"].'">'.$row["UID_Finder"].'</a>';?></td> 
                </tr>
                <tr>
                    <th>Skills</th>
                    <td><?php echo $row["Skills"];?></td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td><?php echo $row["Location"];?></td>
                </tr>
                <tr>
                    <th>Date Start</th>
                    <td><?php echo $row["DateReq"];?></td>
                </tr>
                <tr>
                    <th>Duration</th>
                    <td><?php echo $row["Duration"];?></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><?php echo $row["Description"];?></td>
                </tr>
                <tr>
                    <th>Stipend</th>
                    <td><?php echo $row["Stipend"];?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?php echo $row["Status"];?></td>
                </tr>
                <tr>    
                    <th>Date Posted</th>
                    <td><?php echo $row["DatePosted"];?></td>
                </tr>
                <tr>
                    <th>Date Hired</th>
                    <td><?php echo $row["DateHired"];?></td>
                </tr>
            </table>
        </div>
        <?php 

            if (isset($_SESSION["UID"]) && $_SESSION["UID"]!="") {

                include 'conn.php';

                $sql = "select UID_Provider, UID_Finder, Status, DateReq, Duration from job where JID=".$_GET['id'];
                $data = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($data);

                if ($row['UID_Provider'] == $_SESSION['UID']) {

                    if ($row['Status'] == 1 && date('Y-m-d',strtotime('+'.$row["Duration"].' days',strtotime($row['DateReq']))) > date('Y-m-d') ) {
                        echo "Cannot remove post until duration period is over.";
                    }

                    else {
                        echo '<div class="col-sm">
                                    <form action="" method="POST">
                                        <button name="Done">Mark As Done</button>
                                    </form>
                                </div>';
                    }
                    $sql = "SELECT * FROM `users` WHERE UID IN (select UID from jobapplications where JID=".$_GET['id'].")";
                    $data = mysqli_query($conn, $sql) or die("Server Error");
                    while ($row_temp = mysqli_fetch_assoc($data)) {
                        echo '<br><a href="view_account.php?id='.$row_temp["UID"].'">'.$row_temp["Fname"].' '.$row_temp["Lname"].'</a>'; 
                                if ($row['UID_Finder']==$row_temp['UID']) {echo "Accepted";}
                                else if ($row['Status'] == 0) { echo '<a href="'.$_SERVER['REQUEST_URI'].'&accept='.$row_temp["UID"].'">Accept</a>';}
                    }

                }

                else {
                    
                    $sql = "select UID_Finder, Status from job where JID=".$_GET['id'];
                    $data_temp = mysqli_query($conn, $sql);
                    $row_temp = mysqli_fetch_assoc($data_temp);

                    if ($row_temp["Status"] == 1 && $row["UID_Finder"] == $_SESSION["UID"]) {
                        echo "Your application has been accepted.";
                    }

                    else {
                        $sql = "select count(*) as count from jobapplications where UID=".$_SESSION['UID']." and JID=".$_GET['id'];
                        $data = mysqli_query($conn, $sql) or die("Server Unreachable");

                        $temp = mysqli_fetch_assoc($data);

                        if ($temp["count"] > 0) {
                                echo '<div class="col-sm text-center">
                                        <span class="text-success mb-2">Applied Successfully.</span>
                                        <form action="" method="POST">
                                            <button class="btn btn-primary" name="Cancel">Cancel</button>
                                        </form>
                                    </div>';
                        }

                        else {
                            echo '<div class="col-sm text-center">
                                <form action="" method="POST">
                                    <button class="btn btn-primary" name="Apply">Apply</button>
                                </form>
                            </div>';
                        }   
                    }
                }
                mysqli_close($conn);
            }
         ?>
    </section>
    </div>


    
   <!-- User Modal -->

                    <div class="modal fade" id="LoginModal">
                        <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                        <form action="" method="POST">
                                            <div class="modal-header bg-dark text-white">
                                                    <h6 class="modal-title">Login</h6>
                                                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                            <input name="Email" id="email" type="text" class="form-control" name="email" placeholder="Email">
                                                    </div>
                                                <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                        <input name="Pass" id="password" type="password" class="form-control" name="password" placeholder="Password">
                                                    </div>
                                                    <div><?php echo $GLOBALS['error'];?></div>
                                            </div>
                                            <div class="modal-footer">
                                                    <button class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                    <button name="LoginSubmit" class="btn btn-dark btn-sm">Log In</button>
                                            </div>
                                    </form>
                                </div>
                        </div>
                </div>   

 <script src="js/jquery.min.js"></script>
 <script src="js/popper.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
</body>
</html>
