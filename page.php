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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>


  	@font-face {
    	font-family: myFirstFont;
    	src: url(font/4804_KwangMD_Pukluk/4804_KwangMD_Pukluk.ttf);
	}
	body{
		font-family: myFirstFont;
	}

    .navbar {
      margin-bottom: 0px;
      border-radius: 0;
	  background-color:rgba(255,255,255,0.00);
	  border: 0px;
	  padding:15px; 
    }
 
    .jumbotron {
      margin-bottom: 0px;
      background-image: url(img/blue.jpg);
      padding:0px; 
    }
    fontHead1{
    	font-size: 50px;
    	color:  #1F1209;
    }
    #textHead{
    	padding-top:10px;
    	padding-bottom: 30px; 
    	
    }
    fontHead2{
    	color:  #1F1209;
    	font-size: 30px;
    }
    #search_tab{
    	background-color: rgba(0,0,0,0.50);
    }
   	.navbar-inverse .navbar-collapse, .navbar-inverse .navbar-form{
  		border:0px;
  	}

  	.panel-heading, .btn-success{
  		font-size: 20px;
  	}
  

  	@media only screen and (max-width: 900px) {
		#ImageLogo{
			width: 80%;
			height: auto;
			
		}
		#textHead{
			padding:5px; 
		}
		 fontHead1{
    		font-size: 15px;
    		color:  #1F1209;
    	}

    	fontHead2{
    		color:  #1F1209;
    		font-size: 20px;
    	}

  	}
  
  </style>
   
</head>
<body>






<div class="jumbotron" >
	<div class="container ">
		<div id="textHead" class="col-lg-8" >
			<fontHead1><b>การควบคุมการเปิดปิดไฟผ่านทางไลน์แชทบอท</b></fontHead1><br>
			<fontHead2>Remote Lighting Control via LINE Chatbot</fontHead2>
		</div>

		
	</div>
</div>


<div style="padding: 50px;">  

	<div class="container">
	 	<nav class="navbar navbar-inverse ">
		  <div class="container-fluid">
		  	  <div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#Search">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>                        
			      </button>
	  
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


	  <?php 
	  		$count = 0;
		  	foreach($mlab_data as $mlab_obj) {

		  		if(!empty($query)){
		  			if($query!=$mlab_obj->name && $query!=$mlab_obj->password){
		  				continue;
		  			}

		  		}

			 	if($count%3==0)echo '<div class="row">';
			 	echo '<div class="col-sm-4"> 
			  	<div class="panel panel-success">
				<div class="panel-heading ">ชื่อบ้าน: '.$mlab_obj->name.' #'.$mlab_obj->id.'</div>
				<div class="panel-body"><img src="img/home-icon.png" class="img-responsive" style="width:100%" alt="Image"></div>
				<div class="panel-footer text-center">
					<form action="detail.php" method="post" target="_blank">
						<input type="hidden" name="NameID" value="'.$mlab_obj->id.'">
						<input   class="btn btn-success" name="btnSubmit" type="submit" value="รายละเอียด">
					</form>
				</div>
			  </div>
			</div>';
				if($count%3==2)echo '</div>';
				$count++;
			}
			if($count==0){
				echo '<div class="col-sm-3"></div>';
				echo '<div class="col-sm-6"><div class="panel panel-warning"><div class="panel-heading " style="text-align: center;"><font size="+1">การค้นหาของคุณ -'.$query.'- ไม่ตรงกับชื่อบ้านหรือรหัสบ้านใดๆ</font></div></div></div>';	
	  		}
	  ?>
	</div><br>
</div>




</body>
</html>
