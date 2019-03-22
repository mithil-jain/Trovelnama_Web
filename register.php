<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register | JobSeeker</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bold_font.css">
    <link rel="stylesheet" href="css/style_portal.css">

    <!-- <link rel="stylesheet" href="css/register.css"> -->

    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

	
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body id="seeker">

<?php
	session_start();

	if (isset($_SESSION['UID']) && $_SESSION['UID']!='') {
		header("Location: dashboard.php");
	}

	$GLOBALS['flag'] = 0;
	
	function PopMsg($msg, $ret) {
		$GLOBALS['message'] = $msg;
		$GLOBALS['flag'] = $ret;
		echo "<script type='text/javascript'>
				$(document).ready(function(){
					$('#RegSuccess').modal('show');
				});
			</script>";
	}

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
				header("Location: dashboard.php");
			}

			else {
				$GLOBALS['error'] = 'Incorrect Email/ Password, please try again.';
			}

			mysqli_close($conn);
		}
	}
	
    if (isset($_POST["submit"])) {
        include 'conn.php';
        if (!isset($_POST["AltContact"]) || $_POST["AltContact"] == "") {

        	$_POST["AltContact"] = "NULL";
        }
        $sql = "INSERT INTO `users`(`Fname`, `Lname`, `Email`, `Pass`, `Addr`, `Contact`, `AltContact`, `DOB`, `DateReg`) VALUES (\"".$_POST['Fname']."\", \"".$_POST['Lname']."\", \"".$_POST['Email']."\", \"".$_POST['Pass']."\", \"".$_POST['Addr']."\", ".$_POST['Contact'].", ".$_POST['AltContact'].", \"".$_POST['DOB']."\", \"".date('Y-m-d')."\")";

        $data = mysqli_query($conn, $sql) or PopMsg("The Email-Id or Contact is already registered. Kindly login or try with different Email/Contact.", 1);

        if ($GLOBALS['flag'] == 0) {
    	    PopMsg("Successfully Registered!<br>Auto redirect in 5 sec...", 0);
	    	header("refresh:5; url=http://localhost/TrovelNama_web/dashboard.php");
        }
    	mysqli_close($conn);
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
                    <a href="#home" class="nav-link nav-link-portal" data-toggle="modal" data-target="#LoginModal"><span class="fa fa-sign-in pr-2"></span>Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<!-- Registeration Form -->

<section id="jobseeker-register">
    <div class="container text-white bg">
        <div class="row">
            <div class="col-md-1">
                
            </div>
            <div class="col-md-10">
                <div class="container-fluid">
                    <form class="register_form" method="POST" action="">
                        <h3 class="text-center">Register as <span id="font_change">JobSeeker</span></h3>
                        <hr style="background-color: #fff;">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name">First Name</label>
                                <input name="Fname" type="text" class="form-control" placeholder="First Name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name">Last Name</label>
                                <input name="Lname" type="text" class="form-control" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email</label>
                                <input name="Email" type="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Password</label>
                                <input name="Pass" type="password" pattern="[a-z0-9].{8,}" title="A password should be of length greater than 8 and contain alphabets and digits" class="form-control" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input name="Addr" type="text" class="form-control"placeholder="1234 Main St" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="Contact">Contact</label>
                                <input name="Contact" type="tel" class="form-control" pattern=".{10,}" title="A phone number must contain exactly 10 digits" required placeholder="99XXXXXXX">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Contact"> Alternate Contact</label>
                                <input name="AltContact" type="tel" class="form-control" placeholder="99XXXXXXX">
                            </div>
                            <div class="date form-group col-md-4">
                                <label for="DOB">DOB</label>
                                <input name="DOB" type="date" class="form-control" required>
                            </div>
                        </div>
                        <button name="submit" type="submit" class="btn btn-dark btn-block mt-3">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Login Modal -->

 		<div class="modal fade" id="RegSuccess">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title"><?php echo $GLOBALS['message'];?></h6>
                        <button class="close" data-dismiss="modal"><span>&times;</span></button>
          	        </div>
          	        <div class="modal-footer">
                        <button class="btn btn-dark btn-sm"><a href="portal.php" style="color: white; text-decoration: none;">Go to portal</a></button>
					</div>
                </div>
            </div>
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
</body>
</html>
