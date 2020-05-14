<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<title>D&D 5e Character Manager</title>
<link href="index.css"
      rel="stylesheet"
      type-"text/css"/>
<meta name="description" content="">
<meta name="author" content="Travis Hull">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.css">
<!--[if lt IE 9]>
<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
  <div class="header-container" style="text-align:center">
    <h1>Welcome to the Dungeons and the Dragons!</h1>
  </div>
  <div class="background-container" class="center-fit"></div>
  <form name="login" style="text-align:center" action="index.php" method="post">
    <br><br>Username:<br>
    <input type="text" name="uname" id="uname"><br>
    <br>Password:<br>
    <input type="password" name="pwd" id="pwd"><br>
    <button type="submit" name="Sign In"> Sign In </button>
    <select name="option">
      <?php
      $mysqli = new mysqli("mysql.eecs.ku.edu", "nathanpelletier", "ooRao3En", "nathanpelletier");

      /* check connection */
      if ($mysqli->connect_errno) {
          printf("Connect failed: %s\n", $authorize->connect_error);
          exit();
      }

      $query1 = "SELECT * FROM PLAYER WHERE username = '$username' AND password = '$password'";
      if($return = $mysqli->query($query1))
      {
        session_start();
        $_SESSION['username'] = $username;
      }
      ?>
      </select>
  </form>
</body>
</html>
