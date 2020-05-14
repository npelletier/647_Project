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

/* display inventory */
echo "Initial Inventory<br>";
if($existing = $mysqli->query($existingQuery)){
    while($row = $existing->fetch_assoc()){
        echo $row['item_name']." | ".$row['amount']."<br>";
    }
}else{
    echo "Error";
}

echo "<br>Removing...<br>";

if(count($removed_names) > 0){
    for($i = 0; $i < count($removed_names); $i++){
        $query = "SELECT * FROM `HAS` WHERE player_name = '$playername' and character_name = '$charname' and item_name ='".$removed_names[$i]."'";
        if($result = $mysqli->query($query)){
            $row = $result->fetch_assoc();
            if($row['amount'] == $removed_values[$i]){
                /* Need to remove item from table */
                $update = "DELETE FROM `HAS` WHERE player_name = '$playername' and character_name = '$charname' and item_name ='".$removed_names[$i]."'";
                if($update_status = $mysqli->query($update)){
                    echo "-".$removed_values[$i]." ".$removed_names[$i]." removed from database<br>";
                }else{
                    echo "Error in updating detabase<br>";
                }
            }else{
                /* Update Item value in table */
                $newAmount = $row['amount'] - $removed_values[$i];
                $update = "UPDATE `HAS` SET amount = $newAmount WHERE player_name = '$playername' and character_name = '$charname' and item_name ='".$removed_names[$i]."'";
                if($update_status = $mysqli->query($update)){
                    echo "-".$removed_values[$i]." ".$removed_names[$i]." ".$row['amount']." -> ".$newAmount."<br> ";
                }else{
                    echo "Error in updating detabase<br>";
                }
            }
        }else{
            echo "Error<br>";
        }


    }
}else{
    echo "Nothing removed<br>";
}


echo "<br>Adding...<br>";
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
}else{
    echo "Nothing added <br>";
}

$existingQuery = "SELECT * FROM `HAS` WHERE player_name = '$playername' and character_name = '$charname'";

/* display inventory */
echo "<br>Resulting Inventory<br>";
if($existing = $mysqli->query($existingQuery)){
    while($row = $existing->fetch_assoc()){
        echo $row['item_name']." | ".$row['amount']."<br>";
    }
}else{
    echo "Error";
}

echo "<br><a href='inventory.php'>Return</a>";


$mysqli->close();

?>
