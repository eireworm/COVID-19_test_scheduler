<?php
$ini_array = parse_ini_file('C:\\config.ini');
$testSlotID = (int) $ini_array["testSlotID"];
$testSlotID += 1;
$pattern = '/testSlotID=[0-9]*$/i';
$replacement = "testSlotID=" . $testSlotID;
$contents = (string) file_get_contents('C:\\config.ini');
$newTXT = (string )preg_replace($pattern, $replacement, $contents);
$phpfiletoedit = fopen('C:\\config.ini', "w");
echo $phpfiletoedit . "<br>";
echo fwrite($phpfiletoedit, $newTXT );
?>