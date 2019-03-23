<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Seeker | Trovelnama</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">-->
<!--    <link rel="stylesheet" href="css/bold_font.css">-->
<!--    <link rel="stylesheet" href="css/style_portal.css">-->

    <link href="img/favicon.png" rel="icon">
<!--    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">-->
    <style>
        .cardshadow{
            box-shadow:2px 2px 5px black;
            transform:scale(1);
            transition:0.5s ease;
        }
        .cardshadow:hover{
            transform:scale(1.02);
        }
    </style>
</head>
<body id="seeker_home">


<?php
    session_start();

    include 'session.php';

    $GLOBALS['error'] = '';
    if (isset($_POST["LoginSubmit"])) {
        include 'login.php';
    }

    if (isset($_POST["PostSubmit"])) {
        include 'conn.php';

        $sql = "INSERT INTO `job`(`Title`, `UID_Provider`, `Skills`, `Location`, `DateReq`, `Duration`, `Description`, `Stipend`, `DatePosted`) VALUES (\"".$_POST["Title"]."\", ".$_SESSION['UID'].", \"".$_POST['Skills']."\", \"".$_POST['Location']."\", \"".$_POST['Date']."\", ".$_POST['Duration'].", \"".$_POST['Description']."\", \"".$_POST['Stipend']."\", \"".date('Y-m-d')."\")";
        $data = mysqli_query($conn, $sql) or die("Can't connect to server");

        header("Location: jobseeker_home.php");

        mysqli_close($conn);
    }
?>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top navbar-portal">
        <div class="container">
            <a href="index.php" class="navbar-brand"><img src="img/logo.png"></a>
<!--            <a href="index.php" class="navbar-brand">JobSeeker</a>-->
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
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
    <div class="p-4">
        <section class="text-success text-center mt-5 w-100">
            <h1>Available Jobs</h1>
        </section>
<!-- Posts -->

<section id="Posts">
    <div class="card-deck">
    <?php 
        include 'conn.php';

        $sql = "select * from job";
        $data = mysqli_query($conn, $sql) or die("Unable to connect");
        
        while ($row = mysqli_fetch_assoc($data)) {
            echo '<div class="cardshadow card bg-light text-center shadow-lg p-3 mt-5 rounded" style="max-width:33.33%" id="job_sequence">
                    <h4 class="text-uppercase font-weight-bold">'.$row["Title"].'</h5>
                    <h6>Skills Required:'.$row["Skills"].'</h6>
                    <h6>Location:'.$row["Location"].'</h6>
                    <h6>Duration:'.$row["Duration"].'</h6>
                    <h6>Stipped: Rs.'.$row["Stipend"].' </h6>
                    <a class="btn btn-primary w-50 ml-auto mr-auto" href="view_job.php?id='.$row["JID"].'" style="text-decoration: none; color: black;">View Details</a>
                </div>';
        }
    
        mysqli_close($conn);
    ?>
    </div>
    
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

<!-- Create Modal -->
    <div class="modal fade" id="CreatePost">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <form action="" method="POST">
                      <div class="modal-header bg-dark text-white">
                          <h6 class="modal-title">Create Post</h6>
                          <button class="close" data-dismiss="modal"><span>&times;</span></button>
                      </div>
                      <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="Title">Title</label>
                                <input name="Title" type="text" class="form-control" placeholder="Profile Title" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="Skills">Required Skills</label>
                                <input name="Skills" class="form-control" placeholder="Skills, seprated by (,)" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Location">Location</label>
                                <input name="Location" class="form-control" placeholder="Travelling Location" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="date form-group col-md-6">
                                <label for="Date">Required Date</label>
                                <input name="Date" type="date" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Duration">Duration</label>
                                <input name="Duration" class="form-control" placeholder="Travel Duration(in days)" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="Stipend">Stipend</label>
                                <input name="Stipend" type="number" class="form-control" placeholder="Stipend(in INR)" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="Description"> Job Description</label>
                                <input name="Description" type="text" class="form-control" placeholder="Describe job required(Optional)">
                            </div>
                            
                        </div>
                      </div>
                      <div class="modal-footer">
                          <button class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                          <button name="PostSubmit" class="btn btn-dark btn-sm">Submit</button>
                      </div>
                  </form>
                </div>
            </div>
    </div>
    
    <?php 
            if (isset($_SESSION['UID']) && $_SESSION['UID']!="") {
                echo '<div class="text-center"><a href="#home" class="btn btn-primary" data-toggle="modal" data-target="#CreatePost">Create New Post</a></div>';    
            }
    ?>
<!--
    <div class="card-deck">
                <div class="card bg-primary" id="job_sequence">
                    <h5>'.$row["Title"].'</h5>
                    <h6>Skills Required</h6>'.$row["Skills"].'
                    <h6>Location</h6>'.$row["Location"].'
                    <h6>Duration</h6>'.$row["Duration"].'
                    <h6>Stipped:</h6> Rs.'.$row["Stipend"].'
                    <a href="view_job.php?id='.$row["JID"].'" style="text-decoration: none; color: black;">View Details</a>
                </div>
    <div class="card bg-primary" id="job_sequence">
                    <h5>'.$row["Title"].'</h5>
                    <h6>Skills Required</h6>'.$row["Skills"].'
                    <h6>Location</h6>'.$row["Location"].'
                    <h6>Duration</h6>'.$row["Duration"].'
                    <h6>Stipped:</h6> Rs.'.$row["Stipend"].'
                    <a href="view_job.php?id='.$row["JID"].'" style="text-decoration: none; color: black;">View Details</a>
                </div>
                </div>-->
 <script src="js/jquery.min.js"></script>

 <script src="js/popper.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
</body>
</html>
