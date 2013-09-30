<?php 
$baseUrl = base_url(); 
if($isOK): 
?>

<!doctype html>
<!--[if lt IE 7]> <html class=" ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class=" ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class=" admin" lang="en"> <!--<![endif]-->
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Instagram Photos :: <?= ENVIRONMENT; ?> :: <?= base_url(); ?></title>
	  <link rel="stylesheet" href="<?= $baseUrl; ?>/css/style.css">
	<script type="text/javascript">
	var ored 			= {};
	ored.flagUrl		= '<?= $baseUrl; ?>/admin/flag';
	</script>
	</head>
	<body >
<div id="view-content">
	<header>
		<h1>Chevy Sonic Gallery Admin</h1>

	</header>
	<div id="tags_container">
	<?php 	
	foreach($images as $i): 
		$tid = $i->tid;
?>
<div class="gallery-img">
<p>
	<a href="<?= "/gallery/$i->tid"; ?>" target="_blank"><img src="<?= "$baseUrl/images/gallery/thumb/$i->tid.jpg"; ?>" alt=""/> </a>
	<br />
	<?php	
			echo "Image Id: $i->img_id ";
			echo "flag: $i->flag <br />";
			echo "<button id='flag_$i->img_id' value='Flag for Removal' data-Tid='$i->tid' data-Id='$i->img_id' data-Flag=1 class='flag-btn" . ($i->flag==1 ? " hide" : "")."'>Flag For Removal</button>"; 
			echo "<button id='unflag_$i->img_id' value='Un-Flag' data-Tid='$i->tid' data-Id='$i->img_id' data-Flag=0 class='flag-btn" . ($i->flag==0 ? " hide" : "")."'>Un-Flag</button>"; 
	?>
	</p>		
</div>
<?php endforeach;?>
	</div>
</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.min.js"><\/script>')</script>
	<script src="<?= $baseUrl; ?>/js/libs/plugins.js"></script>
	<script src="<?= $baseUrl; ?>/js/site/admin.js"></script>
	</body></html>
<?php else : echo "No Access"; endif; ?>