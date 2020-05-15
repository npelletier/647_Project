<?php

session_start();
$curUser=$_SESSION['playername'];
$curChar=$_SESSION['charname'];

$username = $_POST['username'];
$name = $_POST['name'];
$class = $_POST['class'];
$alignment = $_POST['alignment'];
$xp = $_POST['xp'];
$race = $_POST['race'];
$description = $_POST['description'];
$background = $_POST['background'];
$currenthp = $_POST['currenthp'];
$maximumhp = $_POST['maximumhp'];
$speed = $_POST['speed'];

$mysqli = new mysqli("mysql.eecs.ku.edu", "nathanpelletier", "ooRao3En", "nathanpelletier");
/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}


if(($_SESSION['edit'])=='false'){
  $sql = "SELECT name FROM `CHARACTER` WHERE username = '$curUser'";
  $results = $mysqli->query($sql);
  while($row = $results->fetch_assoc()){
    if($name == $row['name']){
      $_SESSION['error'] = 'true';
      $mysqli->close();
      header("Location: Dashboard.php");
      exit();
    }
  }
  $sql = "INSERT INTO `CHARACTER`(`username`, `name`, `class`, `alignment`, `xp`, `race`, `description`, `background`, `currenthp`, `maximumhp`, `speed`) VALUES ('$username', '$name', '$class', '$alignment', $xp, '$race', '$description', '$background', $currenthp, $maximumhp, $speed)";
  $results = $mysqli->query($sql);
  if($results){
    $sql = "INSERT INTO `HAS`(`player_name`, `character_name`, `item_name`, `amount`, `equipped`) VALUES ('$username','$name','Copper Piece',100,0)";
    $results = $mysqli->query($sql);
    $mysqli->close();
    header("Location: Dashboard.php");
    exit();
  }
}
else{
  $sql = "UPDATE `CHARACTER` SET class='$class', alignment='$alignment', xp=$xp, race='$race', description='$description', background='$background', currenthp=$currenthp, maximumhp=$maximumhp, speed=$speed WHERE username='$curUser' AND name='$curChar'";
  $results = $mysqli->query($sql);
  if($results){
    $mysqli->close();
    header("Location: Dashboard.php");
    exit();
  }
}

?>
