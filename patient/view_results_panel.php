<style>
#table-container
{
    height: 350px;
    overflow-x: hidden; 
    overflow-y: auto;
}

.tdstyle
{
    padding-left: 100px;
    padding-bottom: 20px;
    text-align: center;
}
</style>

<h1 style="font-size: 2rem;">Past test results</h1>
<br>
<article id="table-container">
<?php
include '../db.inc.php'; 
$sql = "SELECT testSlotID, result, iv FROM PastTestResults WHERE patientID=$_SESSION[patientID]";
$result = $con->query($sql);
mysqli_close($con);

include 'scheduleTests.php';

if ($result->num_rows > 0) 
{
    echo "<table><tr><th class='tdstyle'>Date</th><th class='tdstyle'>Time</th><th class='tdstyle'>Result</th></tr>";
    while($row = $result->fetch_assoc()) {
        $testSlotID = $row['testSlotID'];
        $testResults = $row['result'];
        $iv = hex2bin($row['iv']);
        //$unencrypted_content = openssl_decrypt($content, $cipher, $key, OPENSSL_RAW_DATA, $iv);

        include '../db.inc.php'; 
        $sql = "SELECT Date, Time FROM TestSlot WHERE testSlotID=$testSlotID";
        $testSlotResult = $con->query($sql);
        mysqli_close($con);

        if ($testSlotResult->num_rows > 0) 
        {
            while($testSlotRow = $testSlotResult->fetch_assoc()) {
                $testslotDate = $testSlotRow['Date'];
                $testslotTime = convertIntToTime($testSlotRow['Time']);

                //print table rows
                if ($testResults == 'P')
                {
                    echo "<tr><td class='tdstyle'>$testslotDate</td><td class='tdstyle'>$testslotTime</td><td class='tdstyle' style='color:red;'><strong>COVID detected</strong></td></tr>";
                }
                else if ($testResults == 'N')
                {
                    echo "<tr><td class='tdstyle'>$testslotDate</td><td class='tdstyle'>$testslotTime</td><td class='tdstyle' style='color:green;'><strong>COVID Not detected</strong></td></tr>";
                }
                else
                {
                    echo "<tr><td class='tdstyle'>$testslotDate</td><td class='tdstyle'>$testslotTime</td><td class='tdstyle' class='tdstyle'><em>PENDING</em></td></tr>";
                }
            }
        } 
    }
    echo '</table>';
} 
else {
    echo '<p>You have no tests!</p>';
}
?>
</article>