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
            <div><a href="Dashboard.html">Dashboard</a></div>
            <div class="logout"><a href="index.html">logout</a></div>
        </div>
    </nav>
    <div id="wrapper">
        <h1>All Characters</h1>
        <?php
            $sql = "SELECT name FROM `CHARACTER` WHERE username = '$playername'";
            $results = $mysqli->query($sql);
            while($row = $results->fetch_assoc())
            {
              echo "<div><a href=\"character.php\" onClick=\"".'createCookie(\''.$row[name].'\')"'."> $row[name] </a></div><br>";
            }

            /* close connection */
            $mysqli->close();
        ?>

    </div>
    <script src="script.js"></script>
</body>
</html>
