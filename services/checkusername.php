<?php
session_start();


include(dirname(__FILE__)."/../common/_protected.php");
header('Content-Type: application/json');

$sql1 = "SELECT `username` FROM `accounts` WHERE `address` = '".$_SESSION['addr']."' LIMIT 1;";
$result_acct = $conn->query($sql1);
if ($result_acct->num_rows > 0) {
    // output data of each row
        while($row = $result_acct->fetch_assoc()) {
        if($row['username']=='0'){
            $username = ' - ';
        } else {
            $username = $row['username'];
        }
    }
    echo '{"username":"'.$username.'"}';
}else{
  echo '{"username":" - "}';
}
?>
