<?php
	$large		= base_url()."images/gallery/large/$image->tid.jpg";
	$thumb		= base_url()."images/gallery/thumb/$image->tid.jpg";
	$createdAt	= date("F j, Y", strtotime($image->created_at));
	$url		= $cdn."gallery/redirect/".$image->tid;
?>
<html>
    <title>The Samsung SMART Gallery Experience</title>
    <meta property="og:title" content="The Samsung SMART Gallery Experience"/>
    <meta property="og:type" content="product"/>
    <meta property="og:url" content="<?= $url; ?>"/>
    <meta property="og:image" content="<?= $large; ?>"/>
    <meta property="og:site_name" content="Samsung Camera USA"/>
    <meta property="fb:admins" content="1110939581"/>
    <meta property="og:description" content="Discover the power behind Samsung's SMART camera lineup. Enter the SMART Camera Experience now."/>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.9.0/build/reset-fonts-grids/reset-fonts-grids.css">
<style type="text/css">
.left{ float:left;}
.right{ float:right;}
.fix{ overflow:hidden;}
img{ display:block;}
h1{
	margin: 0 auto;
	width: 600px;
	font-size: 167%;
	padding-bottom: 15px;
	text-align: left;
}
li{
	color: #666666;
	font-family: sans-serif;
	text-align: left;
}
ul{
	float: left;	
	list-style: none;		
}

.blue{
	color: #18539d;
}
#photo_container{
	margin: 0 auto;
	width: 600px;
}
#info{
	width: 600px;
	margin: 0 auto;
	padding-top: 12px;
	clear:both;
}
#author_taken{
	padding-left: 15px;
}
#filter_camera{
	padding-left: 70px;
}
.arrow{
	width: 23px;
	height: 41px;
	background-image: url("../images/gallery/arrow.png");	
	cursor: pointer;
	margin-top: 167px;
	display:none;
}

#prev_arrow{
	float: left;	
	background-position: -23px 0;	
}
#next_arrow{
	float: right;
}
.fb-like{
	width: 600px;
	margin: 0 auto;
	padding-top: 10px;
}
</style>
<script src="<?= $cdn; ?>js/libs/plugins.js"></script>
<?php if(isset($isRedirect)): 

	$appData	= urlencode (json_encode(array('tid'=>$image->tid)));
	$redirect	= INSTALLED_PAGE_URL."?app_data=$appData";
	
	?>
<script type="text/javascript">
log("redirect: <?= $redirect; ?>");
document.location = "<?= $redirect; ?>";
</script>
<?php endif; ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
	log("<?= $cdn; ?> "+ document.location);
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?= $appId; ?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<body>
<div id="container">
	<h1 class="blue">Samsung SMART Camera Experience Gallery Detail</h1>
	<div id="prev_arrow" class="arrow"></div>
    <div id="photo_container">
		<img width="600" height="380" src="<?= $large; ?>" />
    </div>
    <div id="next_arrow" class="arrow"></div>
	<div class="fb-like" data-href="<?= $url; ?>" data-send="true" data-width="600" data-show-faces="false" data-layout="button_count"></div>
	<div id="info">
		<img class="left" width="55" height="55" src="<?= $image->profile_pic; ?>"/>
		<ul id="author_taken">
			<li>Photo by:</li>
			<li class="blue"><?= $image->full_name; ?></li>
			<li>Taken:</li>
			<li class="blue"><?= $createdAt; ?></li>
		</ul>
		<ul id="filter_camera">
			<li>Filter Used:</li>
			<li class="blue"><?= $image->filter; ?></li>
			<li>Camera Used:</li>
			<li class="blue"><?= strtoupper($image->camera); ?></li>
		</ul>
	</div>
</div>
</body>
</html>