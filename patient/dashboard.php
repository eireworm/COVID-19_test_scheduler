<?php 
session_start(); 

// handle button click events and users that are not logged in
if(isset($_POST['logout_bttn']) || !isset($_SESSION['patientName'])) 
{
    session_destroy();
    header("Location: ./login.php"); 
    exit();
}

else if (isset($_POST['scheduler_start_bttn']))
{
    $_SESSION['current_question'] = 0;
}

else if (isset($_POST['scheduler_next_bttn']))
{
    $_SESSION['current_question'] += 1;

    // handle q1 update form data
    $ini_array = parse_ini_file('C:\\config.ini');
    $cipher = $ini_array["cipher"];
    $key = $ini_array["key"];

    if(isset($_POST['email']) && $_POST['email'] != "")
    {
        include '../db.inc.php'; 

        $escaped_email = $con -> real_escape_string($_POST['email']);
        $encrypted_email = openssl_encrypt($escaped_email, $cipher, $key, OPENSSL_RAW_DATA, $_SESSION['patientIV']);

        // create and execute sql query to insert new patient
        $sql = 'UPDATE `Patients` SET `email` = "' . bin2hex($encrypted_email) . '" WHERE patientID = ' . $_SESSION['patientID'] . ';';

        if (!$con->query($sql) === TRUE) {
            die('Error updating email: ' . $con->error);
        }
        mysqli_close($con);

        $_SESSION['patientEmail'] = $escaped_email;
    }

    if(isset($_POST['phone-number']) && $_POST['phone-number'] != "")
    {
        include '../db.inc.php'; 

        $escaped_phone = $con -> real_escape_string($_POST['phone-number']);

        // create and execute sql query to insert new patient
        $sql = 'UPDATE `Patients` SET `phoneNumber` = "' . $escaped_phone . '" WHERE patientID = ' . $_SESSION['patientID'] . ';';

        if (!$con->query($sql) === TRUE) {
            die('Error updating phone: ' . $con->error);
        }
        mysqli_close($con);

        $_SESSION['patientPhone'] = $_POST['phone-number'];
    }

    // save q2 response
    if(isset($_POST['q2_radio']))
    {
        $_SESSION['q2_radio'] = $_POST['q2_radio'];
    }

    // save q3 response
    if(isset($_POST['q3_radio']))
    {
        $_SESSION['q3_radio'] = $_POST['q3_radio'];
    }
}
else if (isset($_POST['scheduler_back_bttn']))
{
    $_SESSION['current_question'] -= 1;
}
else if (isset($_POST['scheduler_finish_bttn']))
{
    // Schedule a test and assign it to the patient
    include 'scheduleTests.php';
    addDateForTestRegistrations();

    $_SESSION['current_question'] += 1;
}
else if (isset($_POST['nav_view_results'])) 
{
    $_SESSION['current_question'] = 5;
}
else 
{
    $_SESSION['current_question'] = -1;
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
    </head>
    <body>
        <article id="nav_panel">
            <img src="../covid_img.png" height="75" width="75" style="margin: 15px calc(50% - 38px);"/>
            <p>COVID-19 PCR Test Scheduler</p>
            <br>
            <br>
            <p>
                <form method="post"> 
                    <button type="submit" class="nav_bttn" name="nav_main_dashboard"><strong>&#8702; Dashboard</strong></button>
                </form>
            </p>
            <br>
            <br>
            <p>
                <form method="post"> 
                    <button type="submit" class="nav_bttn" name="scheduler_start_bttn"><strong>&#8702; Schedule a test</strong></button>
                </form>
            </p>
            <br>
            <br>
            <p> 
                <form method="post"> 
                    <button type="submit" class="nav_bttn" name="nav_view_results"><strong>&#8702; View test results</strong></button>
                </form>
            </p>
            <p style="position: absolute; bottom: 0; margin-bottom: 15px; left: 15px; font-weight: normal;">Copr. &copy; 2021 <a href="https://eireworm.github.io">Anthony Byrne</a></p>
        </article>

        <article id="display_panel">
            <div>
                <?php echo "<h1 id=\"title\">$_SESSION[patientName] - Dashboard</h1>" ?>
                <form method="post" id="logout_form"> 
                    <button type="submit" class="bttn" name="logout_bttn"><strong>Log out</strong></button>
                </form>
                <br>
                <br>

                <hr>

                <br>
                <br>

                <?php 
                // switch case decides what panel to print to the document
                switch ($_SESSION['current_question'])
                {
                    case 0:
                        include './q.php';
                        break;
                    case 1:
                        include './q1.php'; 
                        break;
                    case 2:
                        include './q2.php'; 
                        break;
                    case 3:
                        include './q3.php'; 
                        break;
                    case 4:
                        include './q4.php'; 
                        break;
                    case 5:
                        include './view_results_panel.php'; 
                        break;
                    default:
                        include './main_display_panel.php';
                }
                ?>
            </div>
        </article>
    </body>
</html>