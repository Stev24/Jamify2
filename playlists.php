<?php

session_start();
if (isset($_SESSION['id'])) {
    //echo "you are logged in !";
    //var_dump($_SESSION);
    $session = true;

    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'jamify');
    
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $id = $_SESSION['id'];
        $time = date("Y/m/d");
        // Create playlist
        $query2 = "INSERT INTO playlists (title, creation_date, user_id) VALUES ('".$title."', '".$time."', $id)";
        mysqli_query($conn, $query2);
        unset($_POST['submit']);
    }
    // Ask for playlists information
    $query = "SELECT * FROM playlists WHERE user_id='" . $_SESSION['id'] . "'";
    $playlists = mysqli_query($conn, $query);
    //$playlists = mysqli_fetch_assoc($results);
    //var_dump($playlists);

} else {
    header("Location:login.php");
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
    <link rel="stylesheet" href="playlists.css" />
    <title>Jamify playlists page</title>
</head>

<body>
    <?php include_once('header.php') ?>

    <div class="playlistsContainer">
        <div class="section1">
            <h4>Create a playlist</h4>
            <form action="playlists.php" method="post">
                <input type="text"  name="title" placeholder="Name of the next playlist:"><br>
                <input type="submit" name="submit" value="Save">
            </form>
        </div>
        <br>
        <hr style="width:100%;">
        <div class="section2">
            <h4>
                Your playlists:
            </h4>
            
                <?php if ($playlists) {
                        foreach ($playlists as $playlist) { ?>
                            <div class="playlistsCard">
                                <h6>Title: <?= $playlist['title'] ?></h6>
                                <div>Date of Creation: <?= $playlist['creation_date'] ?></div>
                                <div>Songs: </div>
                                <?php 
                                    $querySongs = "SELECT * FROM songs INNER JOIN playlist_content ON songs.id = playlist_content.song_id  WHERE playlist_content.playlist_id = $playlist[id]";
                                    $songsFromPlaylist = mysqli_query($conn, $querySongs);
                                    foreach ($songsFromPlaylist as $song) { 
                                ?>
                                    <li> <?= $song['title'] ?> </li>

                                <?php } ?>
                            </div>
                     <?php       
                        }
                    } else echo "no playlist found !"; ?>
                
            
        </div>

    </div>

    <?php include_once('navbar.php') ?>

</body>

</html>