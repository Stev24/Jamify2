<?php
session_start();
$value = 0;
//var_dump($_SESSION['favorites']);

if(isset($_POST['delete'])){
    unset($_SESSION['favorites'][$_POST['delete']]);
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
    <link rel="stylesheet" href="songs.css" />
    <title>Jamify songs page</title>
</head>

<body>

    <?php include_once('header.php') ?>

    <div class=songsContainer>
        <h3>Favorites Songs:</h3>
        <?php if (isset($_SESSION['favorites'])) {foreach ($_SESSION['favorites'] as $key => $song) { ?>
            <div class="card p-3 songsCard">
                <div style="display:flex; justify-content:space-between;">
                    <li> <?= $song ?> </li>
                    <form action="favorite.php" method="post">
                        <button type="submit" name="delete" value="<?= $value = $key; ?>" style="border-radius:50px;height:40px; width:40px;"><i class="bi bi-trash-fill"></i></button>
                    </form>
                </div>
            </div>
        <?php  } } else {
            echo "Please login first !";
        } ?>
    </div>

    <?php include_once('navbar.php') ?>
</body>

</html>