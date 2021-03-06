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
  <div class="header-container" style="text-align:center">
  </div>
  <div class="background-container" class="center-fit"></div>
  <form name="login" style="text-align:center" action="CreateUser.php" method="post">
    <br><br>New Username:<br>
    <input type="text" name="uname" id="uname" required><br>
    Name:<br>
    <input type="text" name="name" id="name" required><br>
    New Password:<br>
    <input type="password" name="pwd" id="pwd" required><br>
    Confirm Password:<br>
    <input type="password" name="pwd2" id="pwd2" required><br>
    <input type="submit" value="Create User">
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
        $name = $_POST["name"];
        $password = $_POST["pwd"];
        $pwdconfirm = $_POST["pwd2"];
        if (mysqli_num_rows($mysqli->query("SELECT * FROM PLAYER WHERE username = '$username'")) === 1)
        {
          echo "<br>That username is taken, please choose another.<br>";
        }
        else
        {
          if ($password === $pwdconfirm)
          {
            if($mysqli->query("INSERT INTO PLAYER(username, password, name) VALUES('$username', '$password', '$name')"))
            {
              session_start();
              $_SESSION['playername'] = $username;
              $mysqli->close();
              header("Location: Dashboard.php");
              exit();
            }
            else
            {
              echo "<br>An error occured.  Please refresh the page and try again.<br>";
            }
          }
          else
          {
            echo "<br>The two password fields must match!<br>";
          }
        }
    }
      ?>
  </form>
</body>
</html>
