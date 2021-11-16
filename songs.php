<?php
session_start();
// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'jamify');


if (isset($_POST['sortArtist'])) {
    if ($_SESSION['ascending'] == true) {
        $_SESSION['ascending'] = false;
    } else {
        $_SESSION['ascending'] = true;
    }
} else {
    $_SESSION['ascending'] = true;
}



if ($_SESSION['ascending'] != true) {

    // Ask for user's information
    $query = "SELECT songs.*, artists.name FROM songs inner join artists on songs.artist_id = artists.id order by artists.name desc";
    $result = mysqli_query($conn, $query);
} else {
    $query = "SELECT songs.*, artists.name FROM songs inner join artists on songs.artist_id = artists.id order by artists.name asc";

    $result = mysqli_query($conn, $query);
}

if (isset($_SESSION['id'])) {
// Ask for playlists
$temp = $_SESSION['id'];

$query2 = "SELECT * FROM playlists WHERE playlists.user_id = $temp";
$result2 = mysqli_query($conn, $query2);
$playlists = mysqli_fetch_all($result2, MYSQLI_ASSOC);
}

if (isset($_POST['add'])) {
    $temp2 = $_SESSION['id'];

    $errors = array();

    // Insert only if no errors
    if (empty($errors)) {

        $plId = $_POST['playlistId'];
        $songId = $_POST['songId'];

        $query3 = "INSERT INTO playlist_content(playlist_id, song_id) VALUES('$plId', '$songId')";

        $result3 = mysqli_query($conn, $query3);
    } else {
        foreach ($errors as $errorMsg) {
            echo "<span style='color:red'>$errorMsg</span>";
        }
    }
} else {
    $result3 = [];
}



if(isset($_POST['love']) && isset($_SESSION['favorites'])) {
    array_push($_SESSION['favorites'], $_POST['love']);
} else if (!isset($_SESSION['favorites'])) {
    $_SESSION['favorites'] = array();
}

//var_dump($_SESSION['favorites']);

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
        <form action="" method="POST">
            <div class="d-flex justify-content-end p-2">
                <input class="btn btn-primary" type="submit" name="sortArtist" value="Sort by artist">
            </div>
        </form>
        <?php foreach ($result as $song) { ?>
            <div class="card p-3 songsCard">
                <div style="display:flex; justify-content:space-between;">
                    <div> Title: <?= $song['title'] ?> </div>
                    <form action="songs.php" method="post">
                        <button type="submit" name="love" value="<?= $song['title'] ?>" style="border-radius:50px;height:40px; width:40px;"><i class="bi bi-suit-heart-fill"></i></button>
                    </form>
                </div>
                <span> Release Date: <?= $song['release_date'] ?></span>
                <span> Artist Name: <?= $song['name'] ?></span>
                
                <?php if(isset($_SESSION['id'])) { ?>
                    <form action="songs.php" style="display:flex;flex-direction:column;" action="songs.php" method="POST">
                        <input hidden value="<?= $song['id']?>" name="songId">
                        <label for="playlist">Add to a playlist:</label>
                        <div style="display:flex;flex-direction:row;">
                            <select name="playlistId" style="width:100%">
                                <?php foreach ($playlists as $playlist) { ?>
                                <option value="<?= $playlist['id'] ?>"><?= $playlist['title'] ?></option>
                                <?php  } ?>
                            </select>
        
                            <input type="submit" name="add" value="Add">
                        </div>
                        
                    </form>
                <?php } ?>
            </div>

        <?php  } ?>
    </div>

    <?php include_once('navbar.php') ?>
</body>

</html>