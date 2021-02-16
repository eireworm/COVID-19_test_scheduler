<?php 
session_start(); 

// handle button click events and users that are not logged in
if(isset($_POST['logout_bttn']) || !isset($_SESSION['adminName'])) 
{
    session_destroy();
    header("Location: ./login.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <title>Dashboard</title>
        <link rel="stylesheet" href="../style.css">
        <style>
            form 
            {
                width: 300px;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <article id="nav_panel">
            <img src="../covid_img.png" height="75" width="75" style="margin: 15px calc(50% - 38px);"/>
            <p>COVID-19 PCR Test Scheduler</p>
            <br>
            <br>
            <p>
                <form method="post"> 
                    <button type="submit" class="nav_bttn"><strong>&#8702; Dashboard</strong></button>
                </form>
            </p>
            <p style="position: absolute; bottom: 0; margin-bottom: 15px; left: 15px; font-weight: normal;">Copr. &copy; 2021 <a href="https://eireworm.github.io">Anthony Byrne</a></p>
        </article>

        <article id="display_panel">
            <div>
                <?php echo "<h1 id=\"title\">$_SESSION[adminName] - Dashboard</h1>" ?>
                <form method="post" id="logout_form"> 
                    <button type="submit" class="bttn" name="logout_bttn"><strong>Log out</strong></button>
                </form>
                <br>
                <br>

                <hr>

                <br>
                <br>

                <form method="post">
                    <?php
                        if (isset($_POST["testSlotID"]) && isset($_POST["covid_detection_radio"]))
                        {
                            if($_POST["covid_detection_radio"])
                            {
                                $sql = "UPDATE PastTestResults 
                                    SET result='P', adminID=$_SESSION[adminID] 
                                    WHERE testSlotID=$_POST[testSlotID];";
                                
                                echo "<h1 style='font-size: 1rem; margin-bottom: 10px;'>Patient result has been set to <strong style='color: red;'><em>DETECTED</em></strong></h1>";
                            }
                            else
                            {
                                $sql = "UPDATE PastTestResults 
                                    SET result='N', adminID=$_SESSION[adminID] 
                                    WHERE testSlotID=$_POST[testSlotID];";
                                
                                echo "<h1 style='font-size: 1rem; margin-bottom: 10px;'>Patient result has been set to <strong style='color: green;'><em>NOT DETECTED</em></strong></h1>";
                            }

                            // submit results
                            include '../db.inc.php'; 

                            if (!$con->query($sql) === TRUE) 
                            {
                                die('Error updating past test results: ' . $con->error);
                            }

                            mysqli_close($con);
                        }
                    ?>

                    <label for="patientID"><strong>Test slot ID</strong></label>
                    <br />
                    <input type="number" class="input_box_style" name="testSlotID" min="1" required>

                    <br />
                    <br />

                    <input type="radio" name="covid_detection_radio" value=1 style="height:1.2rem; width:1.2rem;" checked="checked">
                    <label for="covid_detection_radio" style="font-size:1.5rem; margin-left: 15px;">COVID detected</label>
                    
                    <br>
                    <br>

                    <input type="radio" name="covid_detection_radio" value=0 style="height:1.2rem; width:1.2rem;">
                    <label for="covid_detection_radio" style="font-size:1.5rem; margin-left: 15px;">COVID <strong>NOT</strong> detected</label>
                    
                    <br>
                    <br>

                    <button type="submit" class="bttn"><strong>Submit results</strong></button>
                </form>
            </div>
        </article>
    </body>
</html>