<?php 
if(isset($_SESSION['q2_radio']) && isset($_POST['q3_radio']))
{
    if($_SESSION['q2_radio'] || $_POST['q3_radio'])
    {       
        echo "
        <h1 style=\"font-size: 2rem;\">Test no. $_SESSION[latestTestSlotID] on $_SESSION[testSlotDate] at $_SESSION[testSlotTime]</h1>
        <br>
        <p>The closest possible test we could schedule for you, $_SESSION[patientName], was on $_SESSION[testSlotDate] at $_SESSION[testSlotTime]. 
        Please show up 15 minutes early.</p>
        <br>
        <br>";
    }
    else
    {
        echo "
        <h1 style=\"font-size: 2rem;\">Seems you don't need a test</h1><br>
        <br>
        <p>Good news, $_SESSION[patientName]. We have decided that you don't need a test at this time! If you are experiencing COVID-19 symptoms, or have been
        a close contact of a person who has been diagnosed with COVID-19, please schedule the test again.</p>
        <br>
        <br>";
    }
}
?>

<form method="post">
    <button type="submit" class="bttn" style="margin-left:20px;" name="scheduler_next_bttn"><strong>Done</strong></button>
</form>