<?php

require_once 'Twilio/autoload.php';
use Twilio\Rest\Client;

if(isset($_POST['btn']))
{

$sid = "ACde97d48a749e1275b92fe834e3ccc870";
$token = "19da7f4637c482dab592502ab517ea9e";

$client = new Client($sid, $token);
$no=$_POST['no'];
$msg=$_POST['msg'];
$tno=(explode(",",$no));

for ($i=0; $i < count($tno); $i++) 
{ 	
$call=$client->messages->create(
    $tno[$i],
   array(
        'from' => '+16473605998',
        'body' => "$msg"
    )
);

echo $call->sid." ".$i."<br>";
}


}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post" action="" style="text-align: center;"><br>
		<textarea rows="3" cols="30" name="msg" placeholder="Enter Msg"></textarea><br>
		<input type="test" name="no" placeholder="Enter No"><br><br>
						<br><br>
		<input type="submit" name="btn">
	</form>

</body>
</html>