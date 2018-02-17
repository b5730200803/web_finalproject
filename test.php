<!DOCTYPE html>
  <?php
    $mlab_apikey="lSi8ib1187-rZW76qIsz3WxEgOgHrrty";
    $mlab_path="https://api.mlab.com/api/1/databases/line-chatbot-db/collections/";

    $query = (!empty($_GET["q"]))?$_GET["q"]:"";
    $mlab_json = file_get_contents($GLOBALS["mlab_path"]."house?apiKey=".$GLOBALS["mlab_apikey"]);
    $mlab_data = json_decode($mlab_json);
  ?>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>

      @font-face {
        font-family: myFirstFont;
        src: url(font/4804_KwangMD_Pukluk/4804_KwangMD_Pukluk.ttf);
      }
      body{
        font-family: myFirstFont;
      }
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#Search">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      น้องตะวัน
    </div>
    <div class="collapse navbar-collapse" id="Search">
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
                <input type="text" size="35" class="form-control" placeholder="กรอกชื่อบ้านหรือรหัสบ้าน 6 ตัว" name="q" value="<?php echo $query; ?>">
              </div>
              <button type="submit" class="btn btn-default">ค้นหา</button>
            </form>
        </div>
  </div>
</nav>

<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">BLACK FRIDAY DEAL</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-danger">
        <div class="panel-heading">BLACK FRIDAY DEAL</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-success">
        <div class="panel-heading">BLACK FRIDAY DEAL</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
      </div>
    </div>
  </div>
</div><br>



<footer class="container-fluid text-center">
  <p>Online Store Copyright</p>  
  <form class="form-inline">Get deals:
    <input type="email" class="form-control" size="50" placeholder="Email Address">
    <button type="button" class="btn btn-danger">Sign Up</button>
  </form>
</footer>

</body>
</html>
