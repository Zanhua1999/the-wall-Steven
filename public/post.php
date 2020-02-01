<?php
    $img = $_GET['img'];


    echo '<img style="width:800px" src="' . $img . '" /><br>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="comment_style.css">
    <title>Foto's</title>
</head>
<body>
    <div>
        <?php

$mysqli = new mysqli('localhost', 'root', 'root', 'the-wall') or die ('Error connecting');
$query = "SELECT content FROM comment WHERE link = '$img'";
$stmt = $mysqli->prepare($query) or die ('3');
$stmt->bind_result($content) or die ('binding result');
$stmt->execute() or die ('Error excecuting');

        while ($succes = $stmt->fetch()) {
            echo '<div id="text">' . 'Comment: ' . $content . '</div>' . '<br>';
        
        }
        ?>
        </div>
    
    <?php

$query6 = "SELECT _like, _dislike FROM likes WHERE post_img = '$img'";
$stmt2 = $mysqli->prepare($query6) or die ('4');
$stmt2->bind_result($likes, $dislikes) or die ('binding result');
$stmt2->execute() or die ('Error excecuting');

    ?>

    
    <div id="con">
<form method="post" action="comment.php" enctype="multipart/form-data">
<label><br><textarea name="content" rows="8" cols="80" maxlength="200"></textarea></label><br><br>
<input type="submit" name="submit_comment" value="Send"/>
<input type="hidden" name="image" value="<?php echo $img;?>"/>
</form>
</div>



<h3>
<?php 
while ($succes = $stmt2->fetch()) {
    echo $likes . ' Likes ';
    echo $dislikes . ' Dislikes';

}
?>


</h3>
<form method="get" action="process_like.php">
<input type="submit" name="like" value="like">
<input type="submit" name="dislike" value="dislike">
<input type="hidden" name="img_link" value="<?php echo $img;?>">
<input type="button" name="Submit" value="Terug naar de Home page" onclick ="location.href='main.php'"/>
</form>

</body>
</html>
