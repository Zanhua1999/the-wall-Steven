<?php

$content = $_POST['content']; 
$img = $_POST['image'];



$mysqli = new mysqli('localhost', 'root', 'root', 'the-wall') or die ('Error connecting');
$query = "INSERT INTO comment VALUES (0,?,?)";
$stmt = $mysqli->prepare($query) or die ('Error preparing');
$stmt->bind_param('ss', $content, $img) or die ('Error bind param');
$stmt->execute() or die ('Error inserting comment in database');
$stmt->close();


header("location: post.php?img=$img");
?>