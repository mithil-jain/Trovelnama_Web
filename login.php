<?php

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
?>