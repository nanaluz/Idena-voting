<?php
session_start();
include(dirname(__FILE__)."/../common/_public.php");
header('Content-Type: application/json');


if(isset($_GET['user'])){
  $username = $conn->real_escape_string($_GET['user']);
}else{
  $username = '';
}


$sql1 = "SELECT `lastseen` FROM `accounts` WHERE  `username`= '".$username."' LIMIT 1;";
$result_acct = $conn->query($sql1);
if ($result_acct->num_rows > 0) {
    // output data of each row
        while($row = $result_acct->fetch_assoc()) {
        if($row['lastseen']=='0'){
            $lastseen = ' - ';
        } else {
            $lastseen = date('Y-m-d H:i', strtotime($row['lastseen']));
        }
    }
    echo '{"lastseen":"'.$lastseen.'"}';
}else{
  echo '{"lastseen":" - "}';
}
?>
