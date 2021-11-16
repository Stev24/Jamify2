<?php

session_start();
$emailOK = true;

if (isset($_POST['register'])) {
    // 1. Connect to my DB
    $conn = mysqli_connect('localhost', 'root', '', 'jamify');
    $query = "SELECT * FROM users WHERE mail = '" . $_POST['mail'] . "'";

    // 2. Execute the query
    $results = mysqli_query($conn, $query);

    // Check if toy exists in DB
    if (mysqli_num_rows($results) == 0) {
        
        echo 'No user with this email.';
        $emailOK = true;

        $fName = $_POST['firstName'];
        $lName = $_POST['lastName'];
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        $query2 = "INSERT INTO users (first_name, last_name, mail, password) VALUES ('$fName', '$lName' , '$mail', '$password')";
        mysqli_query($conn, $query2);


        $query3 = "SELECT id FROM users WHERE mail = '$mail'";
        $results3 = mysqli_query($conn, $query3);
        $userid = mysqli_fetch_assoc($results3);

        $_SESSION['mail'] = $mail;
        $_SESSION['id'] = $userid['id'];
     
        header("Location:account.php");

        //unset($_GET);
    } else {
        // Retrieve data about user
        $user = mysqli_fetch_assoc($results);
        //echo "Email already in use!";
        $emailOK = false;
        //$_GET = $toy;
        //$_SESSION['currentToyId'] = $_GET['id'];
    }
} else {
    session_destroy();
}


?>





<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="global.css" />
    <link rel="stylesheet" href="register.css" />
    <title>Jamify</title>
</head>

<body>
    <?php include_once('header.php') ?>
    <div class="registerContainer">
        <h2>Register</h2>
        <form action="register.php" method="post">

            <input type="text" id="firstName" name="firstName" placeholder="First Name"><br><br>
            <input type="text" id="lastName" name="lastName" placeholder="Last Name"><br><br>

            <?php if(!$emailOK) { echo "<p style='color:red'> Email already in use.</p>"; } ?>
            <input type="email" id="mail" name="mail" placeholder="Email"><br><br>
            <input type="password" id="password" name="password" placeholder="Password"><br><br>

            <input type="submit" name="register" value="Register">
        </form>
    </div>
    <?php include_once('navbar.php') ?>
</body>

</html>