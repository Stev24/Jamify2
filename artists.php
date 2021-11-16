<?php

// 1. Connect to my DB
$conn = mysqli_connect('localhost', 'root', '', 'jamify');
$query = "SELECT * , COUNT(songs.title) FROM artists INNER JOIN songs ON artists.id = songs.artist_id GROUP BY artists.id;";
//$query2 = "SELECT COUNT(songs.id) FROM artists INNER JOIN songs ON artists.id = songs.artist_id";

// 2. Execute the query
$artists = mysqli_query($conn, $query);
//$results = mysqli_query($conn, $query2);

// Check if toy exists in DB
if (mysqli_num_rows($artists) == 0) {
    echo 'No Artists in the database.';
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
    <link rel="stylesheet" href="artists.css" />
    <title>Jamify</title>
</head>

<body>
    <?php include_once('header.php') ?>
    <div class="artistsContainer">
        <h2>Artists</h2>

        <?php foreach ($artists as $key => $artist) { ?>
            <div class="card p-3 artistCard">
                <h3><?php echo $artist['name'] ?></h3>
                <p><?php echo substr($artist['bio'], 0, 100)."..."; ?></p>
                <div><?php echo $artist['gender'] ?></div>
                <div>Number of songs : <?= $artist['COUNT(songs.title)'] ?></div>
            </div>
        <?php
        } ?>
    </div>
    <?php include_once('navbar.php') ?>
</body>

</html>