<?php
    $pwOK = true;
    $userExists = true;
    $errorsExists = false;
    $session = false;

    session_start();

 if (isset($_POST['submitBtn'])) {
    // start the session before any HTML tag:
    
    $_SESSION['id'] = NULL;

    // Check if email OR password not empty
    $errors = array();
    //echo $_POST['mail'];

    // Check if email is empty
    if (empty($_POST['mail']))
        $errors['mail'] = 'Email is mandatory';

    if (empty($_POST['password']))
        $errors['password'] = 'Password is mandatory';

    // Check if users exists only if form OK
    if (count($errors) == 0) {

        $conn = mysqli_connect('localhost', 'root', '', 'jamify');

        // Easier for query
        $mail = filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL);

        $query = "SELECT *
            FROM users
            WHERE mail = '$mail'";

        $results = mysqli_query($conn, $query);

        // Check if user exists in DB
        if (mysqli_num_rows($results) == 0)
            $userExists = false;

        else {
            // Retrieve data about user
            $user = mysqli_fetch_assoc($results);

            if ($_POST['password'] == $user['password']) {
                // Remember log in : Save email in SESSION 
                echo 'Successfully log-in !';
                $_SESSION['mail'] = $_POST['mail'];
                
                $query2 = "SELECT id FROM users WHERE mail = '$mail'";

                $results2 = mysqli_query($conn, $query2);
                $userid = mysqli_fetch_assoc($results2);

                $_SESSION['id'] = $userid['id'];

                header("Location:account.php");
            } else
                $pwOK = false;
        }
    } else {
        // Display errors
        foreach ($errors as $errorMsg) {
            $errorsExists = true;
        }
    }
} else if (isset($_SESSION)) {
    session_destroy();
    $session = false;
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
    <link rel="stylesheet" href="login.css" />
    <title>Jamify</title>
</head>

<body>
    <?php include_once('header.php') ?>
    <div class="registerContainer">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <input type="email" id="mail" name="mail" placeholder="Email"><br><br>
            <?php if ($pwOK == false) {
                echo "<span style='color:red'>Password not matching.</span> <br>";
            }
            ?>
            <input type="password" id="password" name="password" placeholder="Password"><br><br>

            <input type="submit" name="submitBtn" value="Login">
            <a href="register.php"> <input type="button" value="Register"> </a>
            <?php if ($userExists == false) {
                echo "<br><span style='color:red'>No user registered with this email.</span> <br>";
            }
            ?>
            <?php if ($session == false) {
                echo "<br><span style='color:red'>You are logged out !</span> <br>";
            }
            ?>
            <?php if ($errorsExists == true) {
                foreach ($errors as $errorMsg) {
                    echo '<br><span style="color:red">' . $errorMsg . '<span>';
                }
            } ?>

        </form>
    </div>
    <?php include_once('navbar.php') ?>
</body>

</html>