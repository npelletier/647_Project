<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<title>Edit Inventory</title>
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Oswald:wght@400;700&family=Roboto:ital,wght@0,700;1,400&display=swap" rel="stylesheet">
<!--[if lt IE 9]>
<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
    <div id="wrapper">
        <div class="section">
<?php
$mysqli = new mysqli("mysql.eecs.ku.edu", "nathanpelletier", "ooRao3En", "nathanpelletier");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
exit();
}

/* Session */
session_start();
$playername = $_SESSION['playername'];
$charname = $_SESSION['charname'];

$removed_names = $_POST["remove"];
$removed_values = $_POST["removeValue"];
$add_names = $_POST["add"];
$add_values = $_POST["addValue"];
$existingQuery = "SELECT item_name, amount FROM `HAS` WHERE player_name = '$playername' and character_name = '$charname'";

echo "<h1>Following changes were made to inventory...</h1>";

if(count($removed_names) > 0){
    for($i = 0; $i < count($removed_names); $i++){
        $query = "SELECT * FROM `HAS` WHERE player_name = '$playername' and character_name = '$charname' and item_name ='".$removed_names[$i]."'";
        if($result = $mysqli->query($query)){
            $row = $result->fetch_assoc();
            if($row['amount'] == $removed_values[$i]){
                /* Need to remove item from table */
                $update = "DELETE FROM `HAS` WHERE player_name = '$playername' and character_name = '$charname' and item_name ='".$removed_names[$i]."'";
                if($update_status = $mysqli->query($update)){
                    echo "<p>-".$removed_values[$i]." ".$removed_names[$i]." removed from database</p>";
                }else{
                    echo "Error in updating database<br>";
                }
            }else{
                /* Update Item value in table */
                $newAmount = $row['amount'] - $removed_values[$i];
                $update = "UPDATE `HAS` SET amount = $newAmount WHERE player_name = '$playername' and character_name = '$charname' and item_name ='".$removed_names[$i]."'";
                if($update_status = $mysqli->query($update)){
                    echo "<p>-".$removed_values[$i]." ".$removed_names[$i]." ".$row['amount']." -> ".$newAmount."</p> ";
                }else{
                    echo "Error in updating detabase<br>";
                }
            }
        }else{
            echo "Error<br>";
        }


    }
}


if(count($add_names) > 0){
    for($i = 0; $i < count($add_names); $i++){

        $query = "SELECT * FROM `HAS` WHERE player_name = '$playername' and character_name = '$charname' and item_name ='".$add_names[$i]."'";
        if($result = $mysqli->query($query)){
            $row = $result->fetch_assoc();
            if($row['amount'] == 0){
                /* Need to insert item into table */
                $update = "INSERT INTO HAS (player_name, character_name, item_name, amount, equipped) VALUES('$playername','$charname','$add_names[$i]','$add_values[$i]',0)";
                if($update_status = $mysqli->query($update)){
                    echo "+".$add_values[$i]." ".$add_names[$i]." inserted into database<br>";
                }else{
                    echo "Error in updating detabase<br>";
                }
            }else{
                /* Update Item value in table */
                $newAmount = $row['amount'] + $add_values[$i];
                $update = "UPDATE `HAS` SET amount = $newAmount WHERE player_name = '$playername' and character_name = '$charname' and item_name ='".$add_names[$i]."'";
                if($update_status = $mysqli->query($update)){
                    echo "+".$add_values[$i]." ".$add_names[$i]." ".$row['amount']." -> ".$newAmount."<br> ";
                }else{
                    echo "Error in updating detabase<br>";
                }

            }
        }else{
            echo "Error<br>";
        }
    }
}

echo "<br><a class='button' href='inventory.php'>Return</a>";


$mysqli->close();

?>
        </div>
    </div>

</body>
</html>
