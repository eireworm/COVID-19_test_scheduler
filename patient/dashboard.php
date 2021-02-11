<?php 
session_start(); 

// if not logged in or logging out
if(isset($_POST['logout_bttn']) || !isset($_SESSION['patientName'])) 
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
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            overflow: hidden;
        }

        a
        {
            text-decoration: none;
            color: inherit;
        }

        .bttn {
            cursor: pointer;
            border-radius: 3px;
            font-size: 1rem;
            color: white;
            background-color: #9370DB;
            border-color: transparent;
            border-bottom: 5px solid #715aa1;
            padding: 15px 15px;
        }

        #nav_panel 
        {
            background-color: #715aa1;
            min-height: 100vh;
            min-height: 100vh;
            min-width: 15vw;
            max-width: 15vw;
            display: inline-block;
            float: left;
            color: white;
        }

        #nav_panel > p
        {
            text-align: center;
            font-weight: bold;
        }

        #display_panel 
        {
            display: inline-block;
            float: left;
            min-height: 100vh;
            min-height: 100vh;
            min-width: 85vw;
            max-width: 85vw;
        }

        #display_panel > div
        {
            margin: 0 auto;
            margin-top: 50px;
            width: 80%;
            font-size: 1.3rem;
        }

        #title 
        {
            font-size: 3rem;
            display: inline-block;
        }

        #logout_form 
        {
            display: inline-block;
            float: right;
        }
    </style>
</head>
<body>
    <article id="nav_panel">
        <br>
        <p>COVID-19 PCR Test Scheduler</p>
        <br>
        <br>
        <p>&#8702; Dashboard</p>
        <br>
        <br>
        <p>&#8702; Schedule a test</p>
        <p style="position: absolute; bottom: 0; margin-bottom: 15px; left: 15px; font-weight: normal;">Copyright &copy; Anthony Byrne</p>
    </article>

    <article id="display_panel">
        <?php 
        if (isset($_GET['p']))
        {
            if($_GET['p'] == 'q1')
            {
                include './q1.php'; 
            } 
            else
            {
                include './main_display_panel.php';
            }
        }
        else 
        {
            include './main_display_panel.php';
        }
        ?>
    </article>
    
</body>
</html>