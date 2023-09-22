<?php
session_start(); // Start the session

if (!isset($_SESSION['username'])) {
    // Redirect users who are not logged in to the login page
    header("Location: login.php");
    exit();
}

$songsDirectory = 'songs/';
$songs = scandir($songsDirectory);
shuffle($songs);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Player</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
        <h3>Your Music Collection</h3>
        <div id="audio-container">
            <h3 id="current-song-title">No song selected</h3>
            <audio id="audio-player" controls>
                <source src="" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
        <div id="controls-container">
            <button id="shuffle-button">Shuffle</button>
            <button id="previous-button">Previous</button>
            <button id="next-button">Next</button>
        </div>
        <div class="search">
            <input type="text" id="search-input" placeholder="Search songs...">
            <button onclick="search-button">Search</button>
        </div>
<ul id="song-list">
    <?php
    foreach ($songs as $song) {
        if ($song !== '.' && $song !== '..') {
            $songPath = $songsDirectory . $song; // Full path to the song
            echo '<li><a href="' . $songPath . '" onclick="playSong(\'' . $songPath . '\', \'' . $song . '\'); return false;" data-song-url="' . $songPath . '" data-song-title="' . $song . '">' . $song . '</a></li>';
        }
    }
    ?>
</ul>

        <h3>Your Favorites</h3>
        <ul id="favorites-list">
            <!-- Display favorites here -->
        </ul>
        <p><a href="logout.php">Logout</a></p>
    </div>
    <script src="js/script.js"></script>
</body>
</html>

