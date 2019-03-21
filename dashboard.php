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

    if (!isset($_SESSION["UID"]) || $_SESSION["UID"]=="") {
        header("Location: portal.php");
    }

    include 'conn.php';

    $sql = 'SELECT `UID`, `Fname`, `Lname`, `Email`, `Image`, `Addr`, `Contact`, `AltContact`, `DOB` FROM `users` WHERE UID="'.$_SESSION["UID"].'"';
    $data = mysqli_query($conn, $sql) or die("Unable to connect to server.");
    $row = mysqli_fetch_assoc($data);

    mysqli_close($conn);
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
                        <a href="jobprovider_home.php" class="nav-link nav-link-portal"><span class="fa fa-sticky-note pr-2"></span>Posts</a>
                    </li>
                    <li class="nav-item nav-item-portal">
                        <a href="jobseeker_home.php" class="nav-link nav-link-portal"><span class="fa fa-address-card pr-2"></span>JobSeeker</a>
                    </li>
    
                    <li class="nav-item nav-item-portal">
                        <a href="dashboard.php" class="nav-link nav-link-portal"><span class="fa fa-address-card pr-2"></span>My Account</a>
                    </li>
                    <li class="nav-item nav-item-portal">
                        <a href="logout.php" class="nav-link nav-link-portal"><span class="fa fa-address-card pr-2"></span>Log Out</a>
                    </li>
                        
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
            <h1>My Profile</h1>
    </section>

<section class="Profile">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm">
                <div><img class=".img-fluid" style="max-width: 100%; height: auto; padding-top: 30px;" src="<?php echo $row['Image'].".jpg";?>" alt="Profile Image"></div>
                <div align="center" style="padding-right: 6vw; padding-top: 40px;">
                    <b><?php  echo $row["Fname"]." ".$row["Lname"];?></b>
                </div>
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

        <div class="row align-items-center">
            <div class="col-sm">
                
            </div>
            <div class="col-sm container">
                <div class="col">
                    <div class="row-sm">
                        <div class="col-sm" style="width: 30vw;"><b>Your Submissions: </b></div>
                        <table width="100%" cellpadding="2" border="2">
                            <tr>
                                <th align='center'>Profile ID</th>
                                <th align='center'>Title</th>
                                <th align='center'>Finder's Profile</th>
                                <th align='center'>Skills</th>
                                <th align='center'>Location</th>
                                <th align='center'>Duration</th>
                                <th align='center'>Date</th>
                            </tr>
                        <?php
                            include 'conn.php';
                            $sql = "SELECT * from profile where UID_Finder=".$_SESSION['UID'];
                            $data_profile = mysqli_query($conn, $sql) or die("Couldn't fetch data.");
                            while ($row_profile = mysqli_fetch_assoc($data_profile)) {
                                echo
                                "<tr><form action='' method=POST>
                                <td align='center'>".$row_profile["PID"]."</td>             
                                <td align='center'>".$row_profile["Title"]."</td>
                                <td align='center'>".$row_profile["UID_Finder"]."</td>
                                <td align='center'>".$row_profile["Skills"]."</td>
                                <td align='center'>".$row_profile["Location"]."</td>
                                <td align='center'>".$row_profile["Duration"]."</td>
                                <td align='center'>".$row_profile["DateAvail"]."</td>
                                </form></tr>";
                            }
                        ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm">

            </div>
        </div>

        <div class="row align-items-center" style="padding-top: 5vh;">
            <div class="col-sm">
                
            </div>
            <div class="col-sm container">
                <div class="col">
                    <div class="row-sm">
                        <div class="col-sm" style="width: 30vw;"><b>People who seeked you out: </b></div>
                        <table width="100%" cellpadding="2" border="2">
                            <tr>
                                <th align='center'>Profile ID</th>
                                <th align='center'>Title</th>
                                <th align='center'>Finder's Profile</th>
                                <th align='center'>Skills</th>
                                <th align='center'>Location</th>
                                <th align='center'>Duration</th>
                                <th align='center'>Date</th>
                            </tr>
                        <?php
                            include 'conn.php';
                            $sql = "SELECT * from profile where PID in (SELECT PID from profileapplications WHERE UID=".$_SESSION['UID'].")";
                            $data_profile = mysqli_query($conn, $sql);
                            while ($row_profile = mysqli_fetch_assoc($data_profile)) {
                                echo
                                "<tr><form action='' method=POST>
                                <td align='center'>".$row_profile["PID"]."</td>             
                                <td align='center'>".$row_profile["Title"]."</td>
                                <td align='center'>".$row_profile["UID_Finder"]."</td>
                                <td align='center'>".$row_profile["Skills"]."</td>
                                <td align='center'>".$row_profile["Location"]."</td>
                                <td align='center'>".$row_profile["Duration"]."</td>
                                <td align='center'>".$row_profile["DateAvail"]."</td>
                                </form></tr>";
                            }
                        ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm">

            </div>
        </div>

        <div class="row align-items-center" style="padding-top: 5vh;">
            <div class="col-sm">
                
            </div>
            <div class="col-sm container">
                <div class="col">
                    <div class="row-sm">
                        <div class="col-sm" style="width: 30vw"><b>Your Jobs: </b></div>
                        <table width="100%" cellpadding="2" border="2">
                            <tr>
                                <th align='center'>Job ID</th>
                                <th align='center'>Title</th>
                                <th align='center'>Job Provider</th>
                                <th align='center'>Skills</th>
                                <th align='center'>Location</th>
                                <th align='center'>Duration</th>
                                <th align='center'>Date</th>
                            </tr>
                        <?php
                            $sql = "SELECT * from job where UID_Provider=".$_SESSION['UID'] or die("Unable to fetch data.");
                            $data_app = mysqli_query($conn, $sql);
                            while ($row_app = mysqli_fetch_assoc($data_app)) {
                                echo
                                "<tr><form action='' method=POST>
                                <td align='center'>".$row_app["JID"]."</td>             
                                <td align='center'>".$row_app["Title"]."</td>
                                <td align='center'>".$row_app["UID_Provider"]."</td>
                                <td align='center'>".$row_app["Skills"]."</td>
                                <td align='center'>".$row_app["Location"]."</td>
                                <td align='center'>".$row_app["Duration"]."</td>
                                <td align='center'>".$row_app["DateReq"]."</td>
                                </form></tr>";
                            }
                        ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm">

            </div>
        </div>

        <div class="row align-items-center" style="padding-top: 5vh;">
            <div class="col-sm">
                
            </div>
            <div class="col-sm container">
                <div class="col">
                    <div class="row-sm">
                        <div class="col-sm" style="width: 30vw"><b>Your Job Applications: </b></div>
                        <table width="100%" cellpadding="2" border="2">
                            <tr>
                                <th align='center'>Job ID</th>
                                <th align='center'>Title</th>
                                <th align='center'>Job Provider</th>
                                <th align='center'>Skills</th>
                                <th align='center'>Location</th>
                                <th align='center'>Duration</th>
                                <th align='center'>Date</th>
                            </tr>
                        <?php
                            $sql = "SELECT * from job where JID in (SELECT JID from jobapplications WHERE UID=".$_SESSION['UID'].")";
                            $data_app = mysqli_query($conn, $sql) or die("Unable to fetch data");
                            while ($row_app = mysqli_fetch_assoc($data_app)) {
                                echo
                                "<tr><form action='' method=POST>
                                <td align='center'>".$row_app["JID"]."</td>             
                                <td align='center'>".$row_app["Title"]."</td>
                                <td align='center'>".$row_app["UID_Provider"]."</td>
                                <td align='center'>".$row_app["Skills"]."</td>
                                <td align='center'>".$row_app["Location"]."</td>
                                <td align='center'>".$row_app["Duration"]."</td>
                                <td align='center'>".$row_app["DateReq"]."</td>
                                </form></tr>";
                            }
                            mysqli_close($conn);
                        ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm">

            </div>
        </div>
    </div>
</section>

    
      

 <script src="js/jquery.min.js"></script>
 <script src="js/popper.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
</body>
</html>
