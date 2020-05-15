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
      if ($mysqli->connect_errno) {
          printf("Connect failed: %s\n", $mysqli->connect_error);
          exit();
      }

      session_start();
      $playername = $_SESSION['playername'];
  ?>

    <nav>
        <div class="navwrapper">
          <div><a href="Dashboard.php">Dashboard</a></div>
          <div><a href="editCharacter.php?edit=false">Create Character</a></div>
          <div class="logout"><a href="index.php">logout</a></div>
        </div>
    </nav>
    <div id="wrapper">
        <div class="section">
        <h1>All Characters</h1>
        <?php
            $sql = "SELECT character_name, class, SUM(cost*amount/100) AS wealth
FROM `HAS`, `ITEM`,`CHARACTER`
WHERE (item_name = 'Copper Piece' OR item_name = 'Gold Piece' OR item_name = 'Silver Piece' OR item_name = 'Electrum Piece' OR item_name = 'Platinum Piece')
AND HAS.player_name = '$playername'
AND item_name = ITEM.name
AND HAS.character_name = `CHARACTER`.name
AND HAS.player_name = `CHARACTER`.username
GROUP BY HAS.character_name;
";
            $results = $mysqli->query($sql);
            while($row = $results->fetch_assoc())
            {
              echo "<div class='container'><a href=\"character.php\" onClick=\"".'createCookie(\''.$row[character_name].'\')"'."><h2>$row[character_name]</h2><p>$row[class]</p><p>$row[wealth] Gold</p></a></div><br>";
            }

            /* close connection */
            $mysqli->close();
        ?>
    </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
