<?php
session_start();

include(dirname(__FILE__)."/../common/protected.php");
header('Content-Type: application/json');
if(empty($conn->real_escape_string($_POST['vip']))) {
  die('{"success":false}');
}
$sql = "SELECT * FROM `accounts` WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
$vip = $conn->real_escape_string($_POST['vip']);
if($vip == 1){
  $cost = 5;
}else{
  $cost = 1;
}

    if($row['credits'] < $cost){
      die('{"success":false}');
    }


  }}


  if(empty($conn->real_escape_string($_POST['desc']))) {
    die('{"success":false}');
  }
  if(empty($conn->real_escape_string($_POST['title']))) {
    die('{"success":false}');
  }
  if(empty($conn->real_escape_string($_POST['category']))) {
    die('{"success":false}');
  }
  if(empty($conn->real_escape_string($_POST['endtime']))) {
    die('{"success":false}');
  }

if(!empty($_SESSION["addr"]))
{

        if ($_POST['type'] == 'proposal'){
          $pdesc = $conn->real_escape_string($_POST['desc']);
          $title = $conn->real_escape_string($_POST['title']);
          $category = $conn->real_escape_string($_POST['category']);
          $option1 = $conn->real_escape_string($_POST['option1']);
          $option2 = $conn->real_escape_string($_POST['option2']);
          $amount = $conn->real_escape_string($_POST['amount']);
          $endtime = $conn->real_escape_string($_POST['endtime']);
           $fundaddr = $conn->real_escape_string($_POST['fundaddr']);
           $sql = "SELECT * FROM `proposals` WHERE `pdesc` = '".$pdesc."' OR `title` = '".$title."' LIMIT 1;";
           $result = $conn->query($sql);

           if ($result->num_rows > 0) {
           die('{"success":false}');
           }
          $sql = "INSERT INTO `proposals`( `pdesc`, `addr`, `option1`,`option2`,`endtime`,`amount`,`fundaddr`,`title`,`category`) VALUES ('".$pdesc."','".$_SESSION["addr"]."','".$option1."','".$option2."','".$endtime."','".$amount."','".$fundaddr."','".$title."','".$category."')";

          $result = $conn->query($sql);
          $sql = "UPDATE `accounts` SET `credits` = `credits`-".$cost." WHERE `accounts`.`addr` = '".$_SESSION["addr"]."';";
         $conn->query($sql);
          echo '{"success":true}';
        } else {
          echo '{"success":false}';
        }
} else {
    echo '{"success":false}';
}

?>
