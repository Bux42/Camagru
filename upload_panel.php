<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Camagru - Upload</title>
    <link href="css/styles.css" rel="stylesheet">
</head>

<body onload="initCamera();">
    <?php
    include "top_menu.php";
    ?>
    <div class="main">
        <?php
        if (!isset($_SESSION["user"])) {
            include "login_required.php";
        } else {
            if (isset($_GET["upload_mode"]) && $_GET["upload_mode"] === "file") {
                include "upload_file_panel_view.php";
            } else {
                include "upload_panel_view.php";
            }
        }
        ?>
    </div>
    <?php
    include "footer.php";
    ?>
</body>
<script>
var overlayId = -1;
function draw(ev) {
    console.log(ev);
    var ctx = document.getElementById('canvas').getContext('2d'),
        img = new Image(),
        f = document.getElementById("uploadimage").files[0],
        url = window.URL || window.webkitURL,
        src = url.createObjectURL(f);

    img.src = src;
    img.onload = function() {
        ctx.drawImage(img, 0, 0);
        url.revokeObjectURL(src);
    }
}

document.getElementById("uploadimage").addEventListener("change", draw, false)
function takePicture() {
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var video = document.getElementById('videoElement');
    context.drawImage(video, 0, 0, 500, 375);
    document.getElementById("formImage").value = canvas.toDataURL('image/png');
    document.getElementById("overlay_id").value = overlayId;
    //console.log(canvas.toDataURL());
    document.forms[0].submit();
}
function takePictureFile() {
    var canvas = document.getElementById('canvas');
    document.getElementById("formImage").value = canvas.toDataURL('image/png');
    document.getElementById("overlay_id").value = overlayId;
    //console.log(canvas.toDataURL());
    document.forms[0].submit();
}
function selectImage(img) {
    document.getElementById("takePictureButton").disabled = false;
    document.getElementById("image_overlay").src = img.src;
    overlayId = img.id;
}
function initCamera() {
    var video = document.querySelector("#videoElement");



    if (video != null && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function (stream) {
                video.srcObject = stream;
            })
            .catch(function (error) {
                document.getElementById("camera_error").innerHTML = error;
            });
    }
}
</script>
</html>