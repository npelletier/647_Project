<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<title>D&D 5e Character Manager</title>
<meta name="description" content="">
<meta name="author" content="Travis Hull">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.css">
<!--[if lt IE 9]>
<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="centered_text">
  <?php
    session_start();
    $_SESSION['playername'] = '';
    $_SESSION['charname'] = '';
    $_SESSION['username'] = '';
   ?>
  <div class="header-container" style="text-align:center">
    <h1>Welcome to the Dungeons and the Dragons!</h1>
  </div>
  <div class="background-container" class="center-fit"></div>
  <form name="login" style="text-align:center" action="index.php" method="post">
    <br><br>Username:<br>
    <input type="text" name="uname" id="uname" required><br>
    Password:<br>
    <input type="password" name="pwd" id="pwd" required><br>
    <input type="submit" value="Sign In">
      <?php
      if (isset($_POST["uname"]))
      {
        $mysqli = new mysqli("mysql.eecs.ku.edu", "nathanpelletier", "ooRao3En", "nathanpelletier");

        /* check connection */
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }

        $username = $_POST["uname"];
        $password = $_POST["pwd"];
        $sql = "SELECT * FROM PLAYER WHERE username = '$username' AND password = '$password'";
        $result = $mysqli->query($sql);
        if(mysqli_num_rows($result) === 1)
        {
          $row = $result->fetch_assoc();
          $_SESSION['username'] = $row['name'];
          $_SESSION['playername'] = $username;
          $mysqli->close();
          header("Location: Dashboard.php");
          exit();
        }
        else
        {
          echo "<br>Invalid login attempt, please try again.<br>";
        }
    }
      ?>
  </form>
  <a class='button' href="CreateUser.php"> New User </a>
</body>
</html>
