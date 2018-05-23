<?php
	$HomeID = $_REQUEST["HomeID"];
	$mlab_json = file_get_contents('https://api.mlab.com/api/1/databases/line-chatbot-db/collections/house?apiKey=MxA4oPkYHK7tsSRM5EdaktbV6uiJzPsq&q={"id":"'.$HomeID.'"}');
	$mlab_data = json_decode($mlab_json);
	foreach ($mlab_data[0]->source as $light) {

		if($light->detail == "deleted"){
		  continue;
		}


		echo '<div class="col-md-4" style="margin-bottom:20px;">
		    <div class="card box-shadow bg-light text-dark">
			<div class="card-header">'.$light->name.'</div>
			<div class="card-body text-center">';
		
		if($light->status == "on" ){
		    echo '<img src="img/light-open.png"  style="width:100px" alt="Image">';
		}
		else{
			echo '<img src="img/light-close.png"  style="width:100px" alt="Image">';
		}
		    
		echo '</div><div class="card-footer text-muted">';
		echo 'หมายเหตุ  ';
		if($light->permission=="true"){
		    echo '<font color="green"> อนุญาติให้ลบหลอดไฟ </font>'; 
		}
		else{
			echo '<font color="red"> ไม่อนุญาติให้ลบหลอดไฟ </font>';  
		}
		echo'</div></div></div>';  
	}
?>