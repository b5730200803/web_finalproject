<!DOCTYPE html>
<?php
	$HomeID = $_POST["NameID"];
	$mlab_json = file_get_contents('https://api.mlab.com/api/1/databases/line-chatbot-db/collections/house?apiKey=lSi8ib1187-rZW76qIsz3WxEgOgHrrty&q={"id":"'.$HomeID.'"}');
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
      margin-bottom: 50px;
      border-radius: 0;
	  background: linear-gradient(90deg,RoyalBlue,DeepSkyBlue);
	  border: 0px;
	  padding:15px; 
    }
 
     .jumbotron {
      margin-bottom: 0;
    }
   
  
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  	#front{
  		
  		height: 200px; 
  	}
 
	  

  </style>
  	
   
</head>
<body>

<div class="jumbotron" >
  <div class="container text-center">
    <img src="img/ydosrcjyfrwospuioljt.png" style="width: 50% ; height: auto;">
    <h2>การควบคุมการเปิดปิดไฟผ่านทางไลน์แชทบอท</h2>      
    <p>Remote Lighting Control via LINE Chatbot</p>
  </div>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" style="padding: 10px;">
     
      <ul class="nav navbar-nav navbar-right">
     
        <form class="form-inline" action="/action_page.php">
		  <div class="form-group" style="margin-left:10px;">
		  	<input type="radio" name="NameHouse">
			<label >ชื่อบ้าน: </label>
			<input type="text" class="form-control" >
		  </div>
		  <div class="form-group" style="margin-left:10px;">
		    <input type="radio" name="Nameid">
			<label >หมายเลขบ้าน:</label>
			<input type="text" class="form-control" >
		  </div>
		  <button type="submit" class="btn btn-default">ค้นหา</button>
		</form>
      </ul>
      
    </div>
  </div>
</nav>

<div class="container">    
  <div class="row">
   
	<?php
		$count_room = count($mlab_data[0]->source);
		echo '
		<div class="col-sm-12">
			<div class="panel panel-success">
				<div class="panel-heading ">รายละเอียด </div>
				<div class="panel-body">
					หมายเลขบ้าน : '.$mlab_data[0]->id.' <br>
					ชื่อบ้าน : '.$mlab_data[0]->name.'<br>
					รหัสบ้าน : '.$mlab_data[0]->password.'<br>
					จำนวนห้อง : '.$count_room.'
				</div>
			</div>
		</div>';
	 
	?>
  </div>
</div>


<br>


<div class="container"> 
	<div class="row">
		<div class="col-sm-12" id="front">
			<div class="row">
				<div class="col-sm-4">
					<img src="img/tree.png" class="img-responsive" style="width:100px; margin:0px; float: left; " alt="Image" >
					<img src="img/tree.png" class="img-responsive" style="width:100px; margin:0px; float: left; " alt="Image" >
					<img src="img/tree.png" class="img-responsive" style="width:100px; margin:0px; float: left; " alt="Image" >
					<img src="img/tree.png" class="img-responsive" style="width:100px; margin:0px; float: left; " alt="Image" >
				</div>
				<div class="col-sm-4">
					<div class="row">
						<div class="col-sm-12">
							<img src="img/car.png" class="img-responsive" style="width:300px; height: auto; margin:0px;" alt="Image" >
						</div>
						<div class="col-sm-12"></div>
					</div>
				</div>
				<div class="col-sm-4">
					<img src="img/tree.png" class="img-responsive" style="width:100px; margin:0px; float: right; " alt="Image" >
					<img src="img/tree.png" class="img-responsive" style="width:100px; margin:0px; float: right; " alt="Image" >
					<img src="img/tree.png" class="img-responsive" style="width:100px; margin:0px; float: right; " alt="Image" >
					<img src="img/tree.png" class="img-responsive" style="width:100px; margin:0px; float: right; " alt="Image" >
				
				</div>
			</div>
		</div>
	</div>

	<div class="row">
	
	</div>
	



<footer class="container-fluid text-center">
 
</footer>

</body>
</html>
