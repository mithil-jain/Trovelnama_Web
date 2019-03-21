<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Seeker | Trovelnama</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bold_font.css">
    <link rel="stylesheet" href="css/style_portal.css">

    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

</head>
<body id="seeker_home">


<?php
    session_start();
    $GLOBALS['error'] = '';
    if (isset($_POST["LoginSubmit"])) {
        echo "<script>$('#LoginModal').modal({backdrop:'static', keyboard:false});</script>";

        if (isset($_POST["Email"]) && isset($_POST["Pass"]) && $_POST["Email"]!="" && $_POST["Pass"]!="") {
            include 'conn.php';
            
            $sql = "select UID from users where Email=\"".$_POST["Email"]."\" and Pass=\"".$_POST["Pass"]."\"";
            $data = mysqli_query($conn, $sql) or die();
            $row = mysqli_fetch_assoc($data);

            if (isset($row['UID']) && $row['UID']!='') {
                $_SESSION["UID"] = $row["UID"];
                header("Location: portal.php");
            }

            else {
                $GLOBALS['error'] = 'Incorrect Email/ Password, please try again.';
            }

            mysqli_close($conn);
        }
    }
?>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top navbar-portal">
        <div class="container">
            <a href="index.php" class="navbar-brand"><img src="img/logo.png" /></img> JobSeeker</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item nav-item-portal">
                        <a href="jobseeker_home.php" class="nav-link nav-link-portal"><span class="fa fa-sticky-note pr-2"></span>Posts</a>
                    </li>
                    <li class="nav-item nav-item-portal">
                        <a href="jobprovider_home.php" class="nav-link nav-link-portal"><span class="fa fa-address-card pr-2"></span>JobProvider</a>
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
<section class="text-white text-center bg-dark py-3" style="margin-top:70px;">
    <h1>Available Jobs</h1>
</section>

<!-- Posts -->

<section id="Posts">
    <?php 
        include 'conn.php';

        $sql = "select * from job";
        $data = mysqli_query($conn, $sql) or die("Unable to connect");
        
        while ($row = mysqli_fetch_assoc($data)) {
            echo '<section class="bg-dark p-2" id="job_sequence">
                <div class="text-center job-title bg-light">
                    <h5 class="py-1">'.$row["Title"].'</h5>
                </div>

                <div class="row text-center py-2">
                    <div class="col-md-3">
                        <div class="container border text-white py-2">
                            <h6>Skills Required</h6><hr>'.$row["Skills"].'
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="container py-2 bg-light">
                            <h6>Location</h6> <hr> '.$row["Location"].'
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="container border text-white py-2">
                            <h6>Duration</h6> <hr>'.$row["Duration"].'
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="container bg-light">
                            <h6 class="pt-2">Stipped: Rs.'.$row["Stipend"].'</h6> <hr> <div class="btn btn-dark btn-sm mb-1">Apply</div>
                        </div>
                    </div>
                </div>
            </section>';
        }

        mysqli_close($conn);
    ?>
    
</section>


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
