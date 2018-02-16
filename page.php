<!DOCTYPE html>
<?php
	$mlab_json = file_get_contents('https://api.mlab.com/api/1/databases/line-chatbot-db/collections/house?apiKey=lSi8ib1187-rZW76qIsz3WxEgOgHrrty');
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


    .navbar {
      margin-bottom: 0px;
      border-radius: 0;
	  background-color:rgba(255,255,255,0.00);
	  border: 0px;
	  padding:15px; 
    }
 
    .jumbotron {
      margin-bottom: 0px;
      background-color: #66CCFF;
      padding:0px; 
    }
    fontHead{
    	font-size: 30px;
    	color: #FFFFFF;
    }
    #textHead{
    	padding:50px;
    }

  	@media only screen and (max-width: 900px) {
		#ImageLogo{
			width: 80%;
			height: auto;
			
		}
		#textHead{
			padding:5px; 
		}
		img {display:block;margin:0 auto};
  	}
  
	  

  </style>
   
</head>
<body>

<div class="jumbotron" >
		<div class="row">
			<div id="textHead" class="col-lg-8" >
				<fontHead>การควบคุมการเปิดปิดไฟผ่านทางไลน์แชทบอท</fontHead>
				<p>Remote Lighting Control via LINE Chatbot</p>
			</div>
		</div>
	
</div>


<div style="background-color: #f2f2f2; padding: 50px;">  
	<div class="container">
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="collapse navbar-collapse" style="padding: 10px;">
	     
	      <ul class="nav navbar-nav navbar-right">
	     
	        <form class="form-inline" action="/action_page.php">
			  
			  <div class="form-group" style="margin-left:10px;">
			  	<input type="radio" name="NameHouse">
				<label >ชื่อบ้านหรือหมายเลขบ้าน:</label>
				<input type="text" class="form-control" >
			  </div>
			  <div class="form-group" style="margin-left:10px;">
			    <input type="radio" name="IdHouse">
				<label >รหัสบ้าน:</label>
				<input type="text" class="form-control" >
			  </div>
			  <button type="submit" class="btn btn-default">ค้นหา</button>
			
			</form>
	      </ul>
	      
	    </div>
	  </div>
	</nav>
	  <?php 
	  		$count = 0;
		  	foreach($mlab_data as $mlab_obj) {
			 if($count%3==0)echo '<div class="row">';
			 echo '<div class="col-sm-4"> 
			  <div class="panel panel-success">
				<div class="panel-heading ">ชื่อบ้าน: '.$mlab_obj->name.' #'.$mlab_obj->id.'</div>
				<div class="panel-body"><img src="img/home-icon.png" class="img-responsive" style="width:100%" alt="Image"></div>
				<div class="panel-footer text-center">
					<form action="detail.php" method="post">
						<input type="hidden" name="NameID" value="'.$mlab_obj->id.'">
						<input   class="btn btn-success" name="btnSubmit" type="submit" value="รายละเอียด">
					</form>
				</div>
			  </div>
			</div>';
			if($count%3==2)echo '</div>';
				$count++;
			}
		  	
	  ?>
	</div><br>
</div>




</body>
</html>
