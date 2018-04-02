<!DOCTYPE html>

<?php
  $HomeID = $_POST["NameID"];
  if(empty($HomeID)){
    header('Location: test.php');
    return ;
  }
  $mlab_path="https://api.mlab.com/api/1/databases/line-chatbot-db/collections/";
  $mlab_json = file_get_contents('https://api.mlab.com/api/1/databases/line-chatbot-db/collections/house?apiKey=lSi8ib1187-rZW76qIsz3WxEgOgHrrty&q={"id":"'.$HomeID.'"}');
  $mlab_data = json_decode($mlab_json);


  $accesstoken = "z3jt/2q0mCFXVvwjx0fBKCn3TgHC2VfasMU+7v9pkPckOgxl2HjWKG75ZSYJEm4wXh9C1K0g8CPObNqtQ8Ni+lmDN95xq/nONV27ue6Xg79zs4SrJr0ESdPPCTqV3Zgf+arO+HY0AsbVfCuLlJRB9AdB04t89/1O/w1cDnyilFU=";
            $mlab_apikey="lSi8ib1187-rZW76qIsz3WxEgOgHrrty";
            $houseId = $mlab_data[0]->id;

  function mlab_house_show_userid($houseId){
      $mlab_json = file_get_contents($GLOBALS['mlab_path'].'user?apiKey='.$GLOBALS['mlab_apikey'].'&q={"houseid":"'.$houseId.'"}');
      $mlab_data = json_decode($mlab_json);
      $UserAll = array();
    foreach ($mlab_data as $user) {
      array_push($UserAll,$user->user);
    }
    return $UserAll;
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


  function show_user_line($accesstoken,$userId){
    $sent = curl_init();
    $url = "https://api.line.me/v2/bot/profile/".$userId;
    curl_setopt($sent,CURLOPT_URL,$url);
    curl_setopt($sent,CURLOPT_CUSTOMREQUEST,"GET");
    
    $arrayheader = array();
    $arrayheader[] = "Content-Type: application/json";
    $arrayheader[] = "Authorization: Bearer {$accesstoken}"; //Beaver --> Bearer 
    curl_setopt($sent,CURLOPT_HTTPHEADER,$arrayheader);
    curl_setopt($sent,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($sent,CURLOPT_FOLLOWLOCATION,1);
    curl_setopt($sent, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($sent);
    curl_close($sent);
    return json_decode($result);
  }

?>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Web Chatbot Line</title>

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






    <div class="container">    
      <div class="row">
        <?php
          $count_room =  mlab_house_count_room($mlab_data[0]->id);
          echo '
          <div class="col-md-12" style="margin-top:50px; margin-bottom:50px;">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">รายละเอียด</h4>
                <b  class="card-text" >หมายเลขบ้าน</b> : '.$mlab_data[0]->id.' <br>
                <b  class="card-text">ชื่อบ้าน</b> : '.$mlab_data[0]->name.'<br>
                <b  class="card-text">รหัสบ้าน</b> : '.$mlab_data[0]->password.'<br>
                <b  class="card-text">จำนวนห้อง</b> : '.$count_room.'<br>
                <b  class="card-text">สมาชิกภายในบ้าน</b><br>
                <div class="row" style="margin-top:10px;">';

                      $UserAll = mlab_house_show_userid($houseId);
                      foreach ($UserAll as $User) {
                        echo "<div class=\"col-2 text-center align-items-center\" stlye=\"padding:0px;\">";
                        $mlab_userdetail = show_user_line($accesstoken,$User);
                        echo "<img src='".$mlab_userdetail->pictureUrl."' width='70x' style='border-radius:100%' /><br>";
                        echo "".$mlab_userdetail->displayName."";
                        echo "</div>";
                      }

                    echo '
                </div>
              </div>
            </div>
          </div>';
        ?>
      </div>
  </div>


      <div class="album py-5 bg-light">
        <div class="container">
          <div class="row" id="getRoom">
          </div>
          <script>
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
            <?php echo"setInterval(getRoomFunction(\"".$HomeID."\"), 3000);"; ?>
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
    <script>window.jQuery || document.write('<script src="https://getbootstrap.com/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://getbootstrap.com/assets/js/vendor/popper.min.js"></script>
    <script src="https://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    <script src="https://getbootstrap.com/assets/js/vendor/holder.min.js"></script>
  

