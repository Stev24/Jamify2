<?php session_start() ?>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="global.css" />
    <title>Jamify account page</title>
</head>

<body>
    <?php include_once('header.php') ?>
    <div class="description">
        <?php

        // Log out must be first (otherwise, you will still display user's information)
//        if (isset($_POST['logoutBtn'])) {
//            session_destroy();
//            header('Location: login.php');
//        }
        /*
    Check if the user logged in before
    For this, check if(session['email']) exists
*/
        if (isset($_SESSION['mail'])) {
            // Ask for user's information
            $conn = mysqli_connect('localhost', 'root', '', 'jamify');
            $query = "SELECT * FROM users WHERE mail = '" . $_SESSION['mail'] . "'";
            $result = mysqli_query($conn, $query);
            $user = mysqli_fetch_assoc($result);

            echo 'Hello' . ' ' .  $user['first_name'] . ' ' .  $user['last_name'] . '! :)' . '<br>';
        } else {
            // redirect 
            header('Location: login.php');
        }

        ?>

        <table class="p-2">
            <tr><?php echo '<br> Firstname: ' . ' ' .  $user['first_name']  ?></tr>
            <tr><?php echo '<br> Lastname: ' . ' ' .  $user['last_name']  ?></tr>
            <tr><?php echo '<br> Your email is: ' . ' ' .  $user['mail']  ?></tr>
        </table>
        <br>
        <p>Welcome to Jamify. Jamify is the number one platform to listen to the newest hits in the world.</p>
    </div>
    
    <?php // echo '<a href="playlists.php"> <span class="p-4" style=color:blue>Click here to see your playlists</span></a>'; ?>

    <!--
    <form action="" method="POST">
        <div class="d-flex justify-content-end p-2">
            <input type="submit" class="btn btn-primary m-4" name="logoutBtn" value="Log out">
        </div>
    </form>-->

    <?php include_once('navbar.php') ?>


</body>

</html>