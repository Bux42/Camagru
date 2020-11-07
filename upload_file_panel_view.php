<div id="camera_error">
</div>
<div id="container">
    <div class="box">
        <canvas id="canvas" width="500" height="375"></canvas>
    </div>
    <div class="box stack-top"><img id="image_overlay" src=""></div>
</div>
<div class="upload_error">
<?php
if (isset($_SESSION["upload_result"])) {
    echo $_SESSION["upload_result"];
    unset($_SESSION["upload_result"]);
}
?>
</div>
<div class="overlay_list">
    <?php
    include "get_image_list.php";
    foreach ($image_list as $img_overlay) {
        echo "<img title='".$img_overlay["name"]."' id='".$img_overlay["id"]."' class='img_overlay' style='cursor:pointer;' onclick='selectImage(this);' height=80 width=100 src='".$img_overlay["url"]."'>";
    }
    ?>
</div>
<div>
    <button id="takePictureButton" disabled onclick="takePictureFile();">Take Picture</button>
</div>
<div>
    <a href="/upload_panel.php">Camera mode</a>
</div>
<div>
    <input type='file' name='img'  id='uploadimage' />
</div>

<form action="/upload_picture.php" method="post">
    <input id="formImage" name="image" type="hidden">
    <input id="overlay_id" name="overlay_id" type="hidden">
</form>
<div class="user_images">
    <?php
    while (($query = $user_image_list_query->fetch())) {
        echo "<a href='/public_upload.php?img_id=".$query["id"]."'><img height=80 width=100  src='".$query["base64_img"]."'></a>";
    }
    ?>
</div>