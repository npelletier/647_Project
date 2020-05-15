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
    <?php
         $mysqli = new mysqli("mysql.eecs.ku.edu", "nathanpelletier", "ooRao3En", "nathanpelletier");

        /* check connection */
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }


            session_start();

            $playername = $_SESSION['playername'];
            $charname = $_SESSION['charname'];
    ?>
    <nav>
        <div class="navwrapper">
            <div><a href="Dashboard.php">Dashboard</a></div>
            <div><a href="character.php">View Character</a></div>
            <div><a href="#">Edit Character</a></div>
            <div class="logout"><a href="index.php">logout</a></div>
        </div>
    </nav>
    <div id="wrapper">
        <div class="section">
            <h1>Current Invetory</h1>
            <p>Click items to remove from inventory</p>
            <span class="vBreak"></span>
            <?php
               $query = "SELECT * FROM `HAS` WHERE character_name ='$charname' and player_name = '$playername'";
                if($result = $mysqli->query($query)){
                    while($row = $result->fetch_assoc()){
                        echo "<div class ='container clickable' onclick='addtoRemoveList(this)'><h3 class='centered_text'>".$row['item_name']."</h3><p class = 'centered_text amount'>".$row['amount']."</p></div>";
                    }
                }else{
                    echo "Error";
                }
            ?>
        </div>
        <div class="section">
            <h1>Avilable Items</h1>
            <p>Click items to add to inventory</p>
            <span class="vBreak"></span>
            <?php
               $query = "SELECT * FROM `ITEM`";
                if($result = $mysqli->query($query)){
                    while($row = $result->fetch_assoc()){
                        echo "<div class ='container clickable' onclick='addtoAddList(this)'><h3 class='centered_text'>".$row['name']."</h3><p class = 'centered_text amount'> ".$row['cost']."</p></div>";
                    }
                }else{
                    echo "Error";
                }
            ?>

        </div>
        <div class="section checkout">
            <h1>Changes</h1>
            <form action="updateInventory.php" method="post">
                <div id="add">
                <h2>Add Items</h2>
                </div>
                <div id="remove">
                <h2>Remove Items</h2>
                </div>
            <input type="submit" value="Submit">
            </form>
        </div>
    </div>
    <?php
    session_start();
    $mysqli->close();
    ?>
    <script src="script.js"></script>
</body>
</html>
