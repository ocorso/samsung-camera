<link rel="stylesheet" href="<?= $cdn; ?>css/style.css">
<link rel="stylesheet" href="<?= $cdn; ?>css/jquery.fancybox.css">

<h1>Share Stuff.</h1>
<?php 	if (isset($oauth_token) && isset($status) ) 	echo 	"<h2>HOLY SHIT: status: $status</h2>"; 
		else 						echo	"<h2>bummer</h2>"; 
?>
<a class="share-fancybox" data-fancybox-type="iframe" href="<?= $cdn; ?>share/picasa" title="Google Picasa">Picasa</a>
<a class="share-fancybox" data-fancybox-type="iframe" href="<?= $cdn; ?>share/photobucket" title="Photobucket">Photobucket</a>
<?php if (isset($error)) echo $error;?>
<?php

$usnData = array(
              	'name'        => 'username',
              	'id'          => 'username',
             	'maxlength'   => '100',
              	'size'        => '50'
            );
$pwdData = array(
              	'name'        => 'password',
              	'id'          => 'password',
             	'maxlength'   => '100',
              	'size'        => '50'
            );
$uploadData = array(
              	'name'        => 'imgToShare',
              	'id'          => 'imgToShare',
             	'maxlength'   => '100',
              	'size'        => '50'
            );
             
	echo form_open_multipart($cdn."share/picasa"); 
	echo form_label('Username:', 'username');
	echo form_input($usnData);
	?><br/><?php 
	echo form_label('Password:', 'password');
	echo form_input($pwdData);
	?><br/><?php 
	echo form_label('Choose an Image:', 'imgToShare');
	echo form_upload($uploadData);
	?><br/><?php 
	echo form_submit('pb_upload_submit', 'Upload to Photobucket');
	echo form_submit('ggl_upload_submit', 'Upload to Picasa');
 	echo form_close(); 
 	
 ?>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

  <!-- scripts concatenated and minified via ant build script-->
  <script src="<?= $cdn; ?>js/libs/jquery.fancybox.pack.js"></script>
  <script src="<?= $cdn; ?>js/libs/plugins.js"></script>
  <script src="<?= $cdn; ?>js/site/docReady.js"></script>