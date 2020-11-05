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
        <div id="test">scroll to understand</div>
        <div id="wrapper" style="height: 800px; overflow: auto;">
        <div id="content"></div>
    </div>
    <?php
    include "footer.php";
    ?>
<script language="JavaScript">
    var index = -1;
    function loadImages() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var result = JSON.parse(this.responseText);
                index = result.index;
                console.log("NewIndex: " + index);
                var html = "";

                result.images.forEach(image => {
                    //console.log(image);
                    html += "<img src='" + image.base64_img + "'>";
                });
                console.log(html);
                document.getElementById("content").innerHTML += html;
            }
        };
        xhttp.open("GET", "get_home_images.php?index=" + index, true);
        console.log("GetIndex: " + index);
        xhttp.send();
    }
  // we will add this content, replace for anything you want to add
  var more = '<div style="height: 1000px; background: #EEE;"></div>';

  var wrapper = document.getElementById("wrapper");
  var content = document.getElementById("content");
  var test = document.getElementById("test");
  //content.innerHTML = more;

  function addEvent(obj,ev,fn) {
    if(obj.addEventListener) {
        obj.addEventListener(ev,fn,false);
    } 
    else if(obj.attachEvent) {
        obj.attachEvent("on"+ev,fn);
    }
  }

  function scroller() {
    test.innerHTML = wrapper.scrollTop+"+"+wrapper.offsetHeight+"+100>"+content.offsetHeight;
    if(wrapper.scrollTop+wrapper.offsetHeight + 100 > content.offsetHeight) {
      loadImages();
    }
  }

  addEvent(wrapper,"scroll",scroller);
</script>
</body>
</html>