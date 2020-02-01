<?php

$img = $_GET['img_link'];

$mysqli = new mysqli('localhost', 'root', 'root', 'the-wall') or die ('Error connecting');
$query = "SELECT _like, _dislike FROM likes WHERE post_img = '$img'";


$rawResult = $mysqli->query($query);
$arr = $rawResult->fetch_assoc();

$likes = $arr['_like'];
$dislike = $arr['_dislike'];


if(isset($_GET['like'])){
 $likes = $arr['_like'] +1;   
}else{
    $dislike = $arr['_dislike'] +1;
}


echo $likes;
echo $dislike;


$query2 = "UPDATE likes SET _like= ?, _dislike = ? WHERE post_img = ?";
$stmt2 = $mysqli->prepare($query2) or die ('2');
$stmt2->bind_param('iis', $likes, $dislike, $img) or die ('Error bind param');
$stmt2->execute() or die ('Error inserting comment in database');
$stmt2->close();
header("location: post.php?img=$img");

?>