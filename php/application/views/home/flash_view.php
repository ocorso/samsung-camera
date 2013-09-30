	  <script type="text/javascript">
	  	var environment = {}; 
	  	var pageHost = ((document.location.protocol == "https:") ? "https://" :	"http://"); 
		var flashvars					= {};
		flashvars.baseUrl				= "<?= $cdn; ?>";
		flashvars.redirect				= "<?= base64_encode($loginUrl); ?>";
		flashvars.swfToLoad				= "<?= $cdn; ?>/swf/SamsungCamera.swf";
		
  		<?php if(count($appData) > 0 &&  isset($appData->tid)): ?>
  		flashvars.tid 			="<?= $appData->tid; ?>";
  		<?php endif; ?>
	  	var ored						= {};
	  	
	  	function configApp(){
	  		environment.domain 			= "<?= $_SERVER["HTTP_HOST"]; ?>";
	  		environment.baseUrl			= "<?= $cdn; ?>"
			environment.facebook_app_id = "<?= $appId; ?>";
			environment.swf 			= "<?= $cdn."swf/$swf"; ?>";
			environment.width			= 810;
			environment.height			= 687;//master app height
			log("env fb app id: "+environment.facebook_app_id);
		}
	
  	ored.flashReady		= function() {

  		log("flash is ready, yo");

  		configApp();

  		//flash
  	    var swfVersionStr 		= "10.0.0";
  	    var xiSwfUrlStr 		= "swf/playerProductInstall.swf";
  	    var params 				= {};
  	    params.quality 			= "high";
  	    params.bgcolor 			= "#ffffff";
  	    params.allowscriptaccess = "always";
  	    params.allowfullscreen 	= "true";
  	    params.wmode			= "transparent";
  	    var attributes 			= {};
  	    attributes.id 			= "flash_movie";
  	    attributes.name 		= "flash_movie";
  	    attributes.align 		= "middle";
  	    swfobject.embedSWF(
  	        environment.swf, "main", 
  	        environment.width, environment.height, 
  	        swfVersionStr, xiSwfUrlStr, 
  	        flashvars, params, attributes
  	     );
  	    
  	    //facebook
  	    var fbOpts 				= {};
  	    fbOpts.appId			= environment.facebook_app_id;
  	    fbOpts.status			= true;
  	    fbOpts.cookie			= true;
  	    fbOpts.xfbml			= true;
  		FB.init(fbOpts);
  		
  		//show the app
  		//$("#main").fadeIn();
  		
  		//set height of flash
  		SetFrame();
  		
  	};//end function

	ored.openPopup	= function ($url) {
		log("openPopup: "+$url);
		var opts 		= {};
		opts.href		= $url;
		opts.autoSize	= false;
		opts.height		= 580;
		opts.width		= 690;		
		$.fancybox(opts,{type: 'iframe'});
		
	};
	ored.redirectToAuth 	= function ($url){	
		log("redirect: "+$url);
		window.top.location 	= $url;
	}
</script>
    <div id="main" role="main">
		<p>
	        To view this page ensure that Adobe Flash Player version 
			10.0.0 or greater is installed. 
		</p>
		<script type="text/javascript"> 
			document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='" 
							+ pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" ); 
		</script>
    </div>

	 	<noscript>
            <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="810" height="environment.height" id="SamsungCamera">
                <param name="movie" value="swf/<?= $swf; ?>" />
                <param name="quality" value="high" />
                <param name="bgcolor" value="#FFFFFF" />
                <param name="allowScriptAccess" value="sameDomain" />
                <param name="allowFullScreen" value="true" />
                <!--[if !IE]>-->
                <object type="application/x-shockwave-flash" data="swf/<?= $swf; ?>" width="environment.height" height="800">
                    <param name="quality" value="high" />
                    <param name="bgcolor" value="#FFFFFF" />
                    <param name="allowScriptAccess" value="sameDomain" />
                    <param name="allowFullScreen" value="true" />
                <!--<![endif]-->
                <!--[if gte IE 6]>-->
                	<p> 
                		Either scripts and active content are not permitted to run or Adobe Flash Player version
                		10.0.0 or greater is not installed.
                	</p>
                <!--<![endif]-->
                    <a href="http://www.adobe.com/go/getflashplayer">
                        <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash Player" />
                    </a>
                <!--[if !IE]>-->
                </object>
                <!--<![endif]-->
            </object>
	    </noscript>		
