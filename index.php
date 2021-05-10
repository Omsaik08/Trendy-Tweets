<!--https://trendytweets.000webhostapp.com/ -->

<?php
require_once('TwitterAPIExchange.php');
 

$settings = array(
    'oauth_access_token' => "1077953992766803968-wzLjW2vfjbhY8aF8AFccknUiQzKQRy",
    'oauth_access_token_secret' => "juQpkWe4fqkpfRrjrByK9LPC16sx5Nv2U17AD7Uta8IQL",
    'consumer_key' => "ZFou3JUNOGAgb5AAEgYrI572L",
    'consumer_secret' => "VUaO0PbkMtNw1LeFWPKO5dz5bY3F4l1uDgRNXCj1WEPoIaBua2"
);
$url = "https://api.twitter.com/1.1/trends/place.json";

$requestMethod = "GET";

$getfield = "?id=23424848";

$twitter = new TwitterAPIExchange($settings);
	
$cdata= $twitter->setGetfield($getfield)
		->buildOauth($url, $requestMethod)
        ->performRequest();

$json = json_encode(array('data' => $cdata));

$x=file_put_contents("output.json", $json);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
	body{
		background-image: url('160824.jpg');
	}
table{
	background-color: white;
	align-content: center;
	border: 1px solid #F0F8FF;
	border-radius: 2px;
}
h2,p{
	color: white;
}
div.container{
	width: 50%;
	height: 490px;
	overflow-x: hidden;
	overflow-y: auto;
	text-align:justify;
}
</style>
<body>

<center>
	<h2 >Top 50 Trending Topics!</h2>
  <p> Developed By Omsai Kalekar</p>	
<div class="container">
  <table class="table table-hover">
    <thead bgcolor="#00bfff" >
      <tr>
        <th style="position: sticky;">Sr No.</th>
        <th style="position: sticky;">Topic Name</th>
        <th style="position: sticky;">Total Tweets</th>
      </tr>
    </thead>
    <tbody bgcolor="#F0F8FF">
  	  	<?php
  	  	 $str = file_get_contents("output.json");
			$json = json_decode($str, true);
	 		for ($i = 0; $i <50; $i++) 
	 		{
        		$d=json_decode($json["data"],true);
	 			echo "<tr>";
        		echo "<td>".($i+1)."</td>";
        		if($d[0]["trends"][$i]["name"][0]=="#")
        		{
        		echo "<td>".$d[0]["trends"][$i]["name"]."</td>";
        		}
        		else{
        			echo "<td>#".$d[0]["trends"][$i]["name"]."</td>";	
        		}	
        		if($d[0]["trends"][$i]["tweet_volume"]=="")
        		{
        		echo "<td>--</td>";
        		}
        		else{
        		echo "<td>".$d[0]["trends"][$i]["tweet_volume"]."</td>";	
        		}

      			echo "</tr>";
			}
		?>
    </tbody>
  </table>
</div>
</center>
</body>
</html>


