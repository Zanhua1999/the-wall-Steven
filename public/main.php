<?php

$mysqli = new mysqli('localhost', 'root', 'root', 'the-wall') or die ('Error connecting');

$query = "SELECT image_id, location, title, description FROM images ORDER BY image_id DESC";
$stmt = $mysqli->prepare($query) or die ('Error preparing');
$stmt->bind_result($image_id, $location, $title, $description) or die ('binding result');
$stmt->execute() or die ('Error excecuting');

if(isset($_GET["style"])){
    $Style = $_GET["style"];
}   else {
    $Style = "bigBoi";
}

?>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<script src="https://kit.fontawesome.com/231d0d22c1.js" crossorigin="anonymous"></script>
<link href='https://fonts.googleapis.com/css?family=IBM Plex Mono' rel='stylesheet'>
<link rel="stylesheet" href="<?php echo $Style . ".css" ?>">
<style>
    body {
        font-family: 'IBM Plex Mono';
    }
</style>
</head>
<body>
<div id="page" style="width: 100%; height:100%; position:absolute;">    
<div id="particles-js"></div>
    <div id="top_bar"><div id="title"><a style="color: white; text-decoration:none;" href="main.php">theWall<i class="fas fa-user-secret" id="title_icon"></i></a></div>
        <button id="upload_button" value="upload">upload</button>
    </div>
    <div id="function_bar">
        <div id="select_sorting" >
            <button id="new_to_old" class="sorting_button" type="button" onclick="sortingNewToOld()">new to old</button>
            <button id="old_to_new" class="sorting_button" type="button" onclick="sortingOldToNew()">old to new</button>
        </div>
        <div id="select_layout" >
        <form method="GET" >
            <input id="boring" class="layout_button" type="submit" name="style" onclick="mobileLayout();" value="mobile"/>
            <input id="cool" class="layout_button" type="submit" link="bigBoi.php" name="style" onclick="bigBoiLayout();" value="bigBoi"/>
        </form>
        </div>
    <!-- <div id="select_layout" >
    <form method="GET" >
       <input id="day" class="layout_button" type="button" onclick="dayLayout()" value="day"></input>
       <input id="night" class="layout_button" type="button" onclick="nightLayout()" value="night"></input>
    </form>
    </div> -->
                                
        <form method="post" action="process_upload.php" enctype="multipart/form-data" name="uploadForm" onsubmit="return validateForm()" id="up">
            <label>
                <div id="text_box"><h id="select_file">select file<h/></div>
                <input type="file" style="display: none" name="uploaded_image">
                <!-- <input id="link_input" name="youtube_link"> -->
            </label>
            <label>Name:</label>
            <input class="text_input" name="title"/>
            <label>Some hahaha:</label>
            <input class="text_input" name="description"/>
            <input id="send_button" type="submit" name="submit_image" value="send"/>
            <i class="fas fa-file-upload" id="upload_icon"></i>
        </form>
    </div>    
    <div id="all">
        <div id="content_bar">
            <div id="content">
    <?php   
             while ($succes = $stmt->fetch()) {                  
    ?>
    <div class='post_frame' id='<?php echo $location ?>' onclick="haveBetterLook('<?php echo $location ?>')">
        <img class='pic_frame' src="<?php echo $location ?>">
        <div class='title_frame'><?php echo $title?>
        <div class='script_frame'><?php echo $description?></div></div>
        <!-- <div class='stat_frame'><h id="stats"><form action="like.php">
                <input type="submit" class="bit_vote" name="upbit" value="upBit"style="background-image: url('upbit.jpg');">
                <input type="submit" class="bit_vote" name="downbit" value="downBit"style="background-image: url('downbit.jpg');">
            </form><h></div> -->
    </div>
    <?php   
         }
    ?>
    
    </div>
    
            </div>
            <?php   
             while ($succes = $stmt->fetch()) {             
 ?>
            <div class="big_boi_content" id="<?php echo $location ?>" style="display:flex;">
            <div style="display: flex; width: 100%; height: auto; margin-bottom: 10px;">
            <img class='big_boi' src="<?php echo $location ?>">
            </div>
        
            <input class="comment_input" minlength="1" maxlength="150" placeholder="comments here" name="title"/>
            
            <ul class='comments'>
                <li class="comment">wauw een comment</li>
            </ul>
        </div>
        </div>
        <?php
             }
?>
    </div>
    </div>
    <script src="<?php echo $Style . '.js' ?>"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script>
            particlesJS.load('particles-js', 'particles.json', function(){
            console.log('particles.json loaded...');
            });
    </script>
    <script type="text/javascript">
function bigBoiLayout() {
    document.getElementById("cool").style.display = "none";
    document.getElementById("boring").style.display = "block";
}

function mobileLayout() {
    document.getElementById("cool").style.display = "block";
    document.getElementById("boring").style.display = "none";
}

function linkOrNah(){
    var bool = "<?php echo $Style ?>";
    if(bool === "mobile"){
    window.location.assign('post.php?img=<?php echo $location; ?>');
}
    else {
        haveBetterLook();
    }
}
document.getElementById("<?php echo $location ?>").addEventListener("click", linkOrNah);

document.getElementById("<?php echo $location ?>").addEventListener("click", haveBetterLook);
    </script>
    <script>
function haveBetterLook(id) {
    console.log(id);
    document.getElementById(id).style.display = "flex";
    document.getElementById(id).style.animationName = "bigBoiFlex";
    document.getElementById(id).style.animationDuration = "0.8s";
}
    </script>
    </body>
</html>
