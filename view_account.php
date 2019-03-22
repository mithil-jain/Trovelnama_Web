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

        $sql = 'SELECT `UID`, `Fname`, `Lname`, `Email`, `Image`, `Contact` FROM `users` WHERE UID='.$_GET["id"];
        echo "$sql";
        $data = mysqli_query($conn, $sql) or die("Unable to connect to server.");
        $row = mysqli_fetch_assoc($data);

        if ($row["UID"] == "") {
            header("Location: portal.php");
        }

        mysqli_close($conn);
    }

    else {
        header("Location: portal.php");
    }

    include 'session.php';

    $GLOBALS['error'] = '';
    if (isset($_POST["LoginSubmit"])) {
        include 'login.php';
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
                        <a href="jobprovider_home.php" class="nav-link nav-link-portal"><span class="fa fa-address-card pr-2"></span>JobProvider</a>
                    </li>
                    <li class="nav-item nav-item-portal">
                        <a href="jobseeker_home.php" class="nav-link nav-link-portal"><span class="fa fa-address-card pr-2"></span>JobSeeker</a>
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
    <section class="text-center py-3" style="margin-top:70px;
        -webkit-box-shadow: 0px 4px 9px 6px rgba(0,0,0,0.3);
        -moz-box-shadow: 0px 4px 9px 6px rgba(0,0,0,0.3);
        box-shadow: 0px 4px 9px 6px rgba(0,0,0,0.3);
         ">
            <h1><?php  echo $row["Fname"]." ".$row["Lname"];?></h1>
    </section>

<section class="Profile">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm">
                <div><img class=".img-fluid" style="max-width: 100%; height: auto; padding-top: 30px;" src="<?php echo $row['Image'].".jpg";?>" alt="Profile Image"></div>
            </div>
            <div class="col-sm container">
                <div class="col">
                    <div class="row-sm">
                        <div class="row al">
                            <div class="col-sm">Email: </div>
                            <div class="col-sm"><?php echo $row["Email"];?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm">Contact: </div>
                            <div class="col-sm"><?php echo $row["Contact"];?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm">
            </div>
        </div>
    </div>
</section>


<!-- Login Modal -->
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
