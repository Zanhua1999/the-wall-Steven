<?php
$likes = $_GET['likes'];

$mysqli = new mysqli('localhost', 'root', 'root', 'the-wall') or die ('Error connecting');
$query = "SELECT * FROM images WHERE likes = '$likes'";
$stmt = $mysqli->prepare($query) or die ('Error preparing');
$stmt->bind_result($news) or die ('binding result');
$stmt->execute() or die ('Error excecuting');


?>