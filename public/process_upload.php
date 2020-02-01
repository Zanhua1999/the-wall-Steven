<?php
//echo 'Naam van de file: ' . $_FILES['uploaded_image'] ['name'] . '<br>';
//echo 'Grootte van de file in bytes: ' . $_FILES['uploaded_image'] ['size'] . '<br>';
//echo 'Tijdelijke opslaglocatie: ' . $_FILES['uploaded_image'] ['tmp_name'] . '<br>';

$temp_location = $_FILES ['uploaded_image'] ['tmp_name'];
$target_location = 'images/' . time() . $_FILES ['uploaded_image'] ['name'];

$images = array();

move_uploaded_file($temp_location, $target_location);


$title = $_POST['title'];
$description = $_POST['description'];

$like = 0;
$dislike = 0;

// array_push($images, $image);

$mysqli = new mysqli('localhost', 'root', 'root', 'the-wall') or die ('Error connecting');
$query = "INSERT INTO images VALUES (0,?,?,?)";
$stmt = $mysqli->prepare($query) or die ('Error preparing');
$stmt->bind_param('sss', $target_location, $title, $description) or die ('Error bind param');
$stmt->execute() or die ('Error inserting image in database');
$stmt->close();


$query2 = "SELECT * FROM likes";
$query3 = "INSERT INTO likes VALUES (0,?,?,?)";
$stmt2 = $mysqli->prepare($query3) or die ('Error preparing');
$stmt2->bind_param('iis', $like, $dislike,  $target_location) or die ('Error bind param');
$stmt2->execute() or die ('Error inserting comment in database');
$stmt2->close();
header('location: main.php');

?>