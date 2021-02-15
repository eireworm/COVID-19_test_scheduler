<h1 style="font-size: 2rem;">Past test results</h1>
<br>
<article>
<?php

include '../db.inc.php'; 
$sql = "SELECT testSlotID, result, iv FROM PastTestResults";
$result = $con->query($sql);
mysqli_close($con);

if ($result->num_rows > 0) 
{
    echo '<table><tr><th>TestSlotID</th><th>Result</th></tr>';
    while($row = $result->fetch_assoc()) {
        $testSlotID = $row['testSlotID'];
        $testResults = $row['result'];
        $iv = hex2bin($row['iv']);
        //$unencrypted_content = openssl_decrypt($content, $cipher, $key, OPENSSL_RAW_DATA, $iv);

        //print table
        if ($testResults == 'P')
        {
            echo "<tr><td>$testSlotID</td><td style='color:red;'><strong>COVID detected</strong></td></tr>";
        }
        else if ($testResults == 'N')
        {
            echo "<tr><td>$testSlotID</td><td style='color:green;'><strong>COVID Not detected</strong></td></tr>";
        }
        else
        {
            echo "<tr><td>$testSlotID</td><td><em>PENDING</em></td></tr>";
        }
    }
    echo '</table>';
} 
else {
    echo '<p>You have no tests!</p>';
}
?>
</article>