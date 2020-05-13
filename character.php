<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<title>Character</title>
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.css">
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

        $playername = "tacoTamales";
        $charname = "MiniPenguin";
    ?>
    <nav>
        <div class="navwrapper">
            <div><a href="Dashboard.html">Dashboard</a></div>
            <div class="logout"><a href="index.html">logout</a></div>
        </div>
    </nav>
    <div id="wrapper">
            <?php
                $query = "SELECT description FROM `CHARACTER` WHERE username = '$playername' and name = '$charname'";
    
                if($result = $mysqli->query($query)){
                    while($row = $result->fetch_assoc()){
                        echo "<h1>".$playername." | ".$charname."</h1><p> ".$row['description']."</p>";
                    }
                }else{
                    echo "Error";
                }
            ?>
        <div class="section">
            <h1>Equipped</h1>
            <?php
                $query = "SELECT * FROM `HAS` WHERE player_name = '$playername' and character_name = '$charname' and equipped = 1";
    
                if($result = $mysqli->query($query)){
                    while($row = $result->fetch_assoc()){
                        echo "<div class ='container'><h3 class='centered_text'>".$row['item_name']."</h3><p class = 'centered_text amount'> ".$row['amount']."</p></div>";
                    }
                }else{
                    echo "Error";
                }
            ?>
        </div>
        <div class="section">
            <h1>Inventory</h1>
            <?php
               $query = "SELECT * FROM `HAS` WHERE player_name = '$playername' and character_name = '$charname' and equipped = 0";
                if($result = $mysqli->query($query)){
                    while($row = $result->fetch_assoc()){
                        echo "<div class ='container'><h3 class='centered_text'>".$row['item_name']."</h3><p class = 'centered_text amount'> ".$row['amount']."</p></div>";
                    }
                }else{
                    echo "Error";
                }
            $mysqli->close();
            ?>
            
        </div>
    </div>
</body>
</html>