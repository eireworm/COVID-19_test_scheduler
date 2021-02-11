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

    // handle q1 form data
    if(isset($_POST['email']) && $_POST['email'] != "")
    {
        echo '<br><br>email = ' . $_POST['email'] . '<br><br>';
    }

    if(isset($_POST['phone-number']) && $_POST['phone-number'] != "")
    {
        echo '<br><br>phone-number = ' . $_POST['phone-number'] . '<br><br>';
    }
}
else if (isset($_POST['scheduler_back_bttn']))
{
    $_SESSION['current_question'] -= 1;
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

        .input_box_style 
        {
            margin-top: 5px;
            border: 1px solid black;
            height: 2.5rem;
            width: 200px;
            color: grey;
            font-size: 1.2rem;
            font-weight: bold;
            padding: 0 1rem;
        }

        .input_box_style:focus 
        {
            outline-color: #715aa1;
        }
    </style>
</head>
<body>
    <article id="nav_panel">
        <img src="covid_img.png" height="75" width="75" style="margin: 15px calc(50% - 38px);"/>
        <p>COVID-19 PCR Test Scheduler</p>
        <br>
        <br>
        <p>&#8702; Dashboard</p>
        <br>
        <br>
        <p>&#8702; Schedule a test</p>
        <br>
        <br>
        <p>&#8702; View test results</p>
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
            if ($_SESSION['current_question'] === 0)
            {
                include './q.php';
            } 
            else if($_SESSION['current_question'] === 1)
            {
                include './q1.php'; 
            }
            else 
            {
                include './main_display_panel.php';
            }
            ?>
        </div>
    </article>
    
</body>
</html>