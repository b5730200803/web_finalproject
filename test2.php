<!DOCTYPE html>
<?php
  $HomeID = $_POST["NameID"];
  if(empty($HomeID)){
    header('Location: test.php');
    return ;
  }
?>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Web Chatbot Line</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/album/album.css" rel="stylesheet">
  </head>

  <body>
    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">เกี่ยวกับ</h4>
              <p class="text-muted">เว็บไซต์นนี้เป็นแบบจำลองการส่งข้อมูลจากไลน์ มาแสดงผลการควบคุมเปืดปิดไฟผ่านทางแชทบอท</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">จัดทำโดย</h4>
              <ul class="list-unstyled">
                <li><font color="white">นางสาว ศุภากร ติระเดชยวัฒน์</font></li>
                <li><font color="white">นาย สหชัย ยวงพานิช</font></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="test.php" class="navbar-brand d-flex align-items-center">
            <strong><font color="#32CD32">น้องตะวัน</font></strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

    <main role="main">






    <div class="container">    
      <div class="row" id="getUser">
      </div>
      <script>
            var again2;
            function getUserFunction(str) {
                if (str.length == 0) { 
                    document.getElementById("getUser").innerHTML = "ขออภัยไม่สามารถ เชื่อมต่อฐานข้อมูลได้ ณ ตอนนี้";
                    return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("getUser").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "getuser.php?HomeID=" + str, true);
                    xmlhttp.send();
                }
            }
            function callbackuser(){
              <?php echo"again2 = setInterval(\"getUserFunction('".$HomeID."')\", 500);"; ?>
            }
            setTimeout("callbackuser()",500);
          </script>
  </div>


      <div class="album py-5 bg-light">
        <div class="container">
          <div class="row" id="getRoom">
          </div>
          <script>
            var again;
            function getRoomFunction(str) {
                if (str.length == 0) { 
                    document.getElementById("getRoom").innerHTML = "ขออภัยไม่สามารถ เชื่อมต่อฐานข้อมูลได้ ณ ตอนนี้";
                    return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("getRoom").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "getroom.php?HomeID=" + str, true);
                    xmlhttp.send();
                }
            }
            function callback(){
            <?php echo"again = setInterval(\"getRoomFunction('".$HomeID."')\", 500);"; ?>

            }
            setTimeout("callback()",500);
          </script>
        </div>
      </div>

    </main>

    <footer class="text-muted" style="background-color: #343a40;">
      
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/holder.min.js"></script>
  

