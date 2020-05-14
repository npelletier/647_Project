<?php

$removed_names = $_POST["remove"];
$removed_values = $_POST["removeValue"];
$add_names = $_POST["add"];
$add_values = $_POST["addValue"];

echo "Removing<br>";
for($i = 0; $i < count($removed_names); $i++){
    echo $i.": ".$removed_names[$i]." | ".$removed_values[$i]."<br>";
}

echo "Adding<br>";
for($i = 0; $i < count($add_names); $i++){
    echo $i.": ".$add_names[$i]." | ".$add_values[$i]."<br>";
}

?>