<!DOCTYPE html>

<?php
  $mlab_apikey="lSi8ib1187-rZW76qIsz3WxEgOgHrrty";
  $mlab_path="https://api.mlab.com/api/1/databases/line-chatbot-db/collections/";

  $query = (!empty($_GET["q"]))?$_GET["q"]:"";
  $mlab_json = file_get_contents($GLOBALS["mlab_path"]."house?apiKey=".$GLOBALS["mlab_apikey"]);
  $mlab_data = json_decode($mlab_json);
?>




<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Web Line ChatBot</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/album/album.css" rel="stylesheet">
  </head>

  <body>

    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">About</h4>
              <p class="text-muted">สวัสดี</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">Contact</h4>
              <ul class="list-unstyled">
                <li><a href="https://getbootstrap.com/docs/4.0/examples/album/#" class="text-white">Follow on Twitter</a></li>
                <li><a href="https://getbootstrap.com/docs/4.0/examples/album/#" class="text-white">Like on Facebook</a></li>
                <li><a href="https://getbootstrap.com/docs/4.0/examples/album/#" class="text-white">Email me</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="https://getbootstrap.com/docs/4.0/examples/album/#" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
            <strong>Remote Lighting Control via LINE Chatbot</strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">น้องตะวัน</h1>
          <p class="lead text-muted">การควบคุมการเปิดปิดไฟผ่านทางไลน์แชทบอท</p>
          <p>
            <?php if(!empty($query)){
              echo "<div class=\"navbar-form navbar-left\">
              <div class=\"navbar-form\">
                คำค้นหา <b>".$query."</b>
              </div>
            </div>";
          }
            ?>

            <form class="navbar-form navbar-right" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="GET">
              <div class="form-group">
                <input type="text" size="35" class="form-control text-center" placeholder="กรอกชื่อบ้านหรือรหัสบ้าน 6 ตัว" name="q" >
              </div>
              <button type="submit" class="btn btn-default" width="100%">ค้นหา</button>
            </form>
          </p>
        </div>
      </section>

      <div class="album py-5 bg-light">
        <div class="container">

          <div class="row">






            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="https://reg2.src.ku.ac.th/picnisit/5730200811.jpg" data-holder-rendered="true">
                <div class="card-body">
                  <p class="card-text"><strong>บ้านแม่แพร</strong>
                    <br/>จำนวนสมาชิก : 2 คน<br/>จำนวนห้อง : 7 ห้อง<br/></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">ดูรายละเอียด</button>
                    </div>
                    <small class="text-muted">ใช้งานล่าสุด 9 นาทีที่แล้ว</small>
                  </div>
                </div>
              </div>
            </div>

            
           

           

          </div>
        </div>
      </div>

    </main>

    <footer class="text-muted">
      
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="https://getbootstrap.com/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://getbootstrap.com/assets/js/vendor/popper.min.js"></script>
    <script src="https://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    <script src="https://getbootstrap.com/assets/js/vendor/holder.min.js"></script>
  

