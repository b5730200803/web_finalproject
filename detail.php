<!DOCTYPE html>
<?php
	$mlab_path="https://api.mlab.com/api/1/databases/line-chatbot-db/collections/";
	$HomeID = $_POST["NameID"];
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
	      background-image: url(img/blue.jpg);
	      padding-top:0px; 
	    }
	    fontHead{
	    	font-size: 39px;
	    }
	    #textHead{
	    	padding-top:100px;
	    }
	    td{
    			 padding: 10px;
    	}
		th{
    			text-align: center;
    	}
		

	  	@media only screen and (max-width: 900px) {
			#ImageLogo{
				width: 80%;
				height: auto;
				
			}
			#textHead{
				padding-top:10px; 
			}
			img {display:block;margin:0 auto};
			td{
    			 padding: 10px;
    		}
    		th{
    			text-align: center;
    		}
		
	  	}
	  </style>
	  	
	   
	</head>
<body>

<div class="jumbotron" >
	<div class="container ">
		<div class="row">
			
			<div class="col-lg-4" style="padding:20px;">
				<img id="ImageLogo" src="img/EN-limites-chatbot.png" width="120%" height="auto">
			</div>
			<div id="textHead" class="col-lg-8" >
				<fontHead>การควบคุมการเปิดปิดไฟผ่านทางไลน์แชทบอท</fontHead>
				<p>Remote Lighting Control via LINE Chatbot</p>
			</div>
		</div>
	</div>
</div>


<div style="padding: 50px;">
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
						จำนวนห้อง : '.$count_room.'<br>
						สมาชิกภายในบ้าน

						<table >
							<thead>
								<tr>';

								$UserAll = mlab_house_show_userid($houseId);
								foreach ($UserAll as $User) {
									$mlab_userdetail = show_user_line($accesstoken,$User);
									echo "<th><img src='".$mlab_userdetail->pictureUrl."' width='70x' style='border-radius:100%' /></th>";
								}

								


								echo '</tr>


							</thead>

							<tbody>
								<tr>';

								$UserAllName = mlab_house_show_userid($houseId);
								foreach ($UserAllName as $User) {
									$mlab_userdetail = show_user_line($accesstoken,$User);
									echo "<td>".$mlab_userdetail->displayName."</td>";
								}

						  echo '</tr>
						  	</tbody>
						</table>

					</div>
				</div>
			</div>';
		 
		?>
	  </div>
	</div>


	<br>


	<div class="container" > 
		<div class="row">
			
			<?php

				foreach ($mlab_data[0]->source as $light) {
					echo '<div class="col-sm-4" style="margin-bottom:20px;">
							<div class="panel panel-info " style="margin:0px;">
								<div class="panel-heading">'.$light->name.'</div>
								<div class="panel-body text-center">';
									if($light->status == "on" ){
										echo '<img src="img/light-open.png"  style="width:100px" alt="Image">';
									}
									else{
										echo '<img src="img/light-close.png"  style="width:100px" alt="Image">';
									}
						  
						  echo '</div>
								<div class="panel-footer">
									';
									echo 'หมายเหตุ  ';
									if($light->permission=="true"){
										echo '<font color="green"> อนุญาติให้ลบหลอดไฟ </font>';	
									}
									else{
										echo '<font color="red"> ไม่อนุญาติให้ลบหลอดไฟ </font>';	
									}
									echo'
									</div>
								</div> 
						</div>';	
				}

			?>
			
		</div>	
	</div>
</div>





</body>
</html>
