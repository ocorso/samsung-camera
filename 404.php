<?php
$url= 'http://'.$_SERVER['SERVER_NAME']."/xml/config.xml";

$ch = curl_init( $url );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_POST, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/x-www-form-urlencoded' ));
$response1 = curl_exec($ch);   

curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/xml' ));
$response2 = curl_exec($ch);
?>
<html>
	<head>
		<style>
            * { font-family: arial;	font-size: 11px;}
            textarea { width:100%; height: 600px; }
            table { width:100%; }
            td { width:45%; }
        </style>
	</head>
	<body>
		<table><tr><td>
			POST to <b><?php echo $url; ?></b> with Content-Type: application/x-www-form-urlencoded<br/>
			<textarea><?php echo $response1;?></textarea>
		</td><td>
			POST to <b><?php echo $url; ?></b> with Content-Type: application/xml<br/>
			<textarea><?php echo $response2;?></textarea>
		</tr></table>
	</body>
</html>