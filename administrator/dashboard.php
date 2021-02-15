<?php 
session_start(); 

// if not logged in or logging out
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
    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }

        #logout_bttn {
            cursor: pointer;
            border-radius: 3px;
            font-size: 1rem;
            color: white;
            background-color: #9370DB;
            border-color: transparent;
            border-bottom: 5px solid #715aa1;
            padding: 15px 15px;
        }
    </style>
</head>
<body>
    <?php echo "<h1>$_SESSION[adminName] - Dashboard</h1>" ?>
    <hr>
    <br>
    <form method="post"> 
        <button type="submit" id="logout_bttn" name="logout_bttn"><strong>Log out</strong></button>
    </form>
</body>
</html>