<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Camagru - Home</title>
    <link href="css/styles.css" rel="stylesheet">
</head>

<body onload="loadImages();">
    <?php
    include "top_menu.php";
    ?>
    <div class="main">
        <div id="wrapper" style="height: 800px; overflow: auto;">
        <div id="content"></div>
    </div>
    <?php
    include "footer.php";
    ?>
<script language="JavaScript">
    var index = -1;
    var loadingIndex = -2;
    function loadImages() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var result = JSON.parse(this.responseText);
                index = result.index;
                var html = "";
                result.images.forEach(image => {
                    html += "<div class='img_holder'><img src='" + image.base64_img + "'></div>";
                });
                document.getElementById("content").innerHTML += html;
            }
        };
        if (loadingIndex != index) {
            loadingIndex = index;
            console.log("GetIndex: " + index);
            xhttp.open("GET", "get_home_images.php?index=" + index, true);
            xhttp.send();
        }
    }
  // we will add this content, replace for anything you want to add
  var wrapper = document.getElementById("wrapper");
  var content = document.getElementById("content");

  function addEvent(obj,ev,fn) {
    if(obj.addEventListener) {
        obj.addEventListener(ev,fn,false);
    } 
    else if(obj.attachEvent) {
        obj.attachEvent("on"+ev,fn);
    }
  }

  function scroller() {
    if(wrapper.scrollTop+wrapper.offsetHeight + 100 > content.offsetHeight) {
      loadImages();
    }
  }

  addEvent(wrapper,"scroll",scroller);
</script>
</body>
</html>