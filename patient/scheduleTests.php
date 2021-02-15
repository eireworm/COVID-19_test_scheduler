<?php

function addDateForTestRegistrations() {
    include '../db.inc.php'; 

    // get next available date and time
    $x = 0;
    $slotsRemaining = 0;
    $testSlotDate = "";
    $slotsRemaining = "";
    $nextSlot = "";
    while ($slotsRemaining == 0)
    {
        $sql = 'SELECT `Date`, `slotsRemaining`, `nextSlot` FROM `TestReservations` WHERE Date="' . 
            date('Y-m-d', strtotime(date('Y-m-d'). ' + ' . $x . ' days')) . '";';
        $result = $con->query($sql);
        
        if ($result->num_rows > 0) 
        {
            $row = $result->fetch_assoc();
            $testSlotDate = $row['Date'];
            $slotsRemaining = $row['slotsRemaining'];
            $nextSlot = $row['nextSlot'];
            if ($slotsRemaining == 0) 
            {
                $x++;
                continue;
            }
            else break;
        } 
        else 
        {
            $x++;
            continue;
        }
    }

    // map integer value to clock time
    $nextSlot = (int) $nextSlot;
    $_SESSION['testSlotTime'] = convertIntToTime($nextSlot);
    $_SESSION['testSlotDate'] = $testSlotDate;

    // update time slot with new time
    $nextSlot >= 1005 ? $slotsRemaining = 0 : $slotsRemaining = 1;
    $nextSlot += 15;
    $sql = "UPDATE TestReservations SET nextSlot=$nextSlot, slotsRemaining=$slotsRemaining WHERE Date=\"$testSlotDate\";";

    if (!$con->query($sql) === TRUE) {
        die('Error updating testreservations: ' . $con->error);
    }
    
    //update ini file
    $ini_array = parse_ini_file('C:\\config.ini');
    $testSlotID = (int) $ini_array["testSlotID"];
    $testSlotID += 1;
    $pattern = '/testSlotID=[0-9]*$/i';
    $replacement = "testSlotID=" . $testSlotID;
    $contents = file_get_contents('C:\\config.ini');
    $newTXT = preg_replace($pattern, $replacement, $contents);
    $phpfiletoedit = fopen('C:\\config.ini', "w");
    fwrite($phpfiletoedit, $newTXT);
    
    // Insert new reservation into testreservations table
    $nextSlot -= 15;
    $sql = "INSERT INTO testslot (testSlotID, Date, Time) VALUES ($testSlotID, \"$testSlotDate\", $nextSlot);";
    if (!$con->query($sql) === TRUE) {
        die('Error inserting new test slot: ' . $con->error);
    }
    mysqli_close($con);
}

// Map the integer time storage in database to digital time
function convertIntToTime($nextSlot) {
    $testSlotTime = "";
    switch ($nextSlot)
    {
        case 540:
            $testSlotTime = "9:00am";
            break;
        case 555:
            $testSlotTime = "9:15am";
            break;
        case 570:
            $testSlotTime = "9:30am";
            break;
        case 585:
            $testSlotTime = "9:45am";
            break;
        case 600:
            $testSlotTime = "10:00am";
            break;
        case 615:
            $testSlotTime = "10:15am";
            break;
        case 630:
            $testSlotTime = "10:30am";
            break;
        case 645:
            $testSlotTime = "10:45am";
            break;
        case 660:
            $testSlotTime = "11:00am";
            break;
        case 675:
            $testSlotTime = "11:15am";
            break;
        case 690:
            $testSlotTime = "11:30am";
            break;
        case 705:
            $testSlotTime = "11:45am";
            break;
        case 720:
            $testSlotTime = "12:00pm";
            break;
        case 735:
            $testSlotTime = "12:15pm";
            break;
        case 750:
            $testSlotTime = "12:30pm";
            break;
        case 765:
            $testSlotTime = "12:45pm";
            break;
        case 780:
            $testSlotTime = "1:00pm";
            break;
        case 795:
            $testSlotTime = "1:15pm";
            break;
        case 810:
            $testSlotTime = "1:30pm";
            break;
        case 825:
            $testSlotTime = "1:45pm";
            break;
        case 840:
            $testSlotTime = "2:00pm";
            break;
        case 855:
            $testSlotTime = "2:15pm";
            break;
        case 870:
            $testSlotTime = "2:30pm";
            break;
        case 885:
            $testSlotTime = "2:45pm";
            break;
        case 900:
            $testSlotTime = "3:00pm";
            break;
        case 915:
            $testSlotTime = "3:15pm";
            break;
        case 930:
            $testSlotTime = "3:30pm";
            break;
        case 945:
            $testSlotTime = "3:45pm";
            break;
        case 960:
            $testSlotTime = "4:00pm";
            break;
        case 975:
            $testSlotTime = "4:15pm";
            break;
        case 990:
            $testSlotTime = "4:30pm";
            break;
        case 1005:
            $testSlotTime = "4:45pm";
            break;
    }
    return $testSlotTime;
}

?>