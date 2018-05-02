<!DOCTYPE html>

<?php
  
  $mlab_apikey="lSi8ib1187-rZW76qIsz3WxEgOgHrrty";
  $mlab_path="https://api.mlab.com/api/1/databases/line-chatbot-db/collections/";

  $query = (!empty($_GET["q"]))?$_GET["q"]:"";
  $mlab_json = file_get_contents($GLOBALS["mlab_path"]."house?apiKey=".$GLOBALS["mlab_apikey"]);
  $mlab_data = json_decode($mlab_json);

  function mlab_house_count_member($houseId){
    $mlab_json = file_get_contents($GLOBALS['mlab_path'].'user?apiKey='.$GLOBALS['mlab_apikey'].'&q={"houseid":"'.$houseId.'"}');
    $mlab_data = json_decode($mlab_json);
    return count($mlab_data);
  }

  function mlab_house_count_room($houseId){
    $mlab_json = file_get_contents($GLOBALS["mlab_path"]."house?apiKey=".$GLOBALS["mlab_apikey"].'&q={"id":"'.$houseId.'"}');
    $mlab_data = json_decode($mlab_json);
    $countroom = 0;
    foreach($mlab_data[0]->source as $eachroom){
      if($eachroom->detail=="working")$countroom++;
    }
    return $countroom;
  }

?>



<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
          <a href="#" class="navbar-brand d-flex align-items-center">
            <strong><font color="#32CD32">น้องตะวัน</font></strong>
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
          <h1 class="jumbotron-heading">Remote Lighting Control via LINE Chatbot</h1>
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
                <input type="text" size="35" class="form-control text-center" placeholder="กรอกชื่อบ้านหรือรหัสบ้าน 6 ตัว" name="q"  value="<?php echo $query; ?>">
              </div>
              <button type="submit" class="btn btn-default" width="100%">ค้นหา</button>
            </form>
          </p>
        </div>
      </section>

      <div class="album py-5 bg-light">
        <div class="container">
          <div class="row">



          <?php 
          $count = 0;
          foreach($mlab_data as $mlab_obj) {

            if(!empty($query)){
              $findMatch = strpos($mlab_obj->name,$query);
              if($findMatch === false && $query!=$mlab_obj->password){
                continue;
              }

            }
            $countmember = mlab_house_count_member($mlab_obj->id);
            $countroom = mlab_house_count_room($mlab_obj->id);
            $laseuse = 9;
            $timmeunit = "นาที";
            echo '<div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" style="height: auto; width: 100%; display: block;" src="img/home-icon.png" data-holder-rendered="true">
                <div class="card-body">
                  <p class="card-text"><strong>'.$mlab_obj->name.'</strong>
                    <br/>รหัสบ้าน : '.$mlab_obj->password.'
                    <br/>จำนวนสมาชิก : '.$countmember.' คน<br/>จำนวนห้อง : '.$countroom.' ห้อง<br/></p>
                  <div class="d-flex justify-content-between align-items-center">
                  
                    <div class="btn-group">
                       <form action="test2.php" method="post" target="_blank">
                          <input type="hidden" name="NameID" value="'.$mlab_obj->id.'">
                          <input   class="btn btn-success" name="btnSubmit" type="submit" value="ดูรายละเอียด">
                      </form>
                    </div>
                    <!--<small class="text-muted">ใช้งานล่าสุด '.$lastuse.' '.$timeunit.'ที่แล้ว</small>-->
                  </div>
                </div>
              </div>
            </div>';
            $count++;
          }
          if($count==0){
            echo '<font size="+1" >การค้นหาของคุณ -'.$query.'- ไม่ตรงกับชื่อบ้านหรือรหัสบ้านใดๆ</font>';  
            }
          ?>

    

            
           

           

          </div>
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
  

