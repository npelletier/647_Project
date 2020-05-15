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

        session_start();
        $playername = $_SESSION['playername'];
        $charname = $_SESSION['charname'];
        $_SESSION['edit'] = $_GET['edit'];

    ?>
    <nav>
        <div class="navwrapper">
            <div><a href="Dashboard.php">Dashboard</a></div>
            <div class="logout"><a href="index.php">logout</a></div>
        </div>
    </nav>
    <div id="wrapper">
        <form action="updateCharacter.php" method="post">
            <?php

                $query = "SELECT * FROM `CHARACTER` WHERE username = '$playername' and name = '$charname'";

                $username = $playername;
                $name = $charname;
                $class = "random";
                $alignment = "neutral";
                $xp = 0;
                $race = "human";
                $description = "description";
                $background = "background";
                $currenthp = 100;
                $maximumhp = 100;
                $speed = 20;

                $edit_mode = $_GET['edit'];
                if($edit_mode == 'true'){
                    if($result = $mysqli->query($query)){
                        $row = $result->fetch_assoc();
                        $username = $row['username'];
                        $name = $row['name'];
                        $class = $row['class'];
                        $alignment = $row['alignment'];
                        $xp = $row['xp'];
                        $race = $row['race'];
                        $description = $row['description'];
                        $background = $row['background'];
                        $currenthp = $row['currenthp'];
                        $maximumhp = $row['maximumhp'];
                        $speed = $row['speed'];
                    }
                }

                echo"
                    <label>User Name</label><br><input type='text' name='username' value='$username'><br>
                    <label>Character Name</label><br><input type='text' name='name' value='$name'><br>
                    <label>Class</label><br><input type='text' name='class' value='$class'><br>
                    <label>Alignment</label><br><input type='text' name='alignment' value='$alignment'><br>
                    <label>Experience</label><br><input type='text' name='xp' value='$xp'><br>
                    <label>Race</label><br><input type='text' name='race' value='$race'><br>
                    <label>Description</label><br><input type='text' name='description' value='$description'><br>
                    <label>Background</label><br><input type='text' name='background' value='$background'><br>
                    <label>Current HP</label><br><input type='text' name='currenthp' value='$currenthp'><br>
                    <label>Maximum HP</label><br><input type='text' name='maximumhp' value='$maximumhp'><br>
                    <label>Speed</label><br><input type='text' name='speed' value='$speed'><br>";

            ?>
            <input type='submit' value="Submit">
        </form>
    </div>
    <?php
    $mysqli->close();
    ?>
</body>
</html>
