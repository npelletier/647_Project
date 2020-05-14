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

        $playername = "tacoTamales";
        $charname = "MiniPenguin";
    ?>
    <nav>
        <div class="navwrapper">
            <div><a href="Dashboard.php">Dashboard</a></div>
            <div><a href="shop.php">Buy Equipment</a></div>
            <div><a href="#">Edit Character</a></div>
            <div class="logout"><a href="index.html">logout</a></div>
        </div>
    </nav>
    <div id="wrapper">
            <?php
                $query = "SELECT * FROM `CHARACTER` WHERE username = '$playername' and name = '$charname'";
    
                if($result = $mysqli->query($query)){
                    while($row = $result->fetch_assoc()){
                        echo 
                            "<p>Character Name</p><h1 class ='botMargin'>".$row['name']."</h1>".
                            "<p>Class</p><h1 class ='botMargin'>".$row['class']."</h1>".
                            "<p>Background</p><h1 class ='botMargin'>".$row['background']."</h1>".
                            "<p>Player Name</p><h1 class ='botMargin'>".$row['username']."</h1>".
                            "<p>Race</p><h1 class ='botMargin'>".$row['race']."</h1>".
                            "<p>Alignment</p><h1 class ='botMargin'>".$row['alignment']."</h1>".
                            "<p>Experience Points</p><h1 class ='botMargin'>".$row['xp']."</h1>".
                            "<p>Description</p><h1 class ='botMargin'>".$row['description']."</h1>".
                            "<p>HP</p><h1 class ='botMargin'>".$row['currenthp']."/".$row['maximumhp']."</h1>".
                            "<p>Speed</p><h1 class ='botMargin'>".$row['speed']."</h1>";
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
            ?>
            
        </div>
    </div>
    <?php
    session_start();
    $_SESSION['playername'] = $playername;
    $_SESSION['charname'] = $charname;
    $mysqli->close();
    ?>
</body>
</html>