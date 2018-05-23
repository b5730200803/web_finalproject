<?php
	$HomeID = $_REQUEST["HomeID"];
  	$mlab_path="https://api.mlab.com/api/1/databases/line-chatbot-db/collections/";
  	$mlab_json = file_get_contents('https://api.mlab.com/api/1/databases/line-chatbot-db/collections/house?apiKey=MxA4oPkYHK7tsSRM5EdaktbV6uiJzPsq&q={"id":"'.$HomeID.'"}');
  	$mlab_data = json_decode($mlab_json);


  	$accesstoken = "z3jt/2q0mCFXVvwjx0fBKCn3TgHC2VfasMU+7v9pkPckOgxl2HjWKG75ZSYJEm4wXh9C1K0g8CPObNqtQ8Ni+lmDN95xq/nONV27ue6Xg79zs4SrJr0ESdPPCTqV3Zgf+arO+HY0AsbVfCuLlJRB9AdB04t89/1O/w1cDnyilFU=";
  	$mlab_apikey="MxA4oPkYHK7tsSRM5EdaktbV6uiJzPsq";
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