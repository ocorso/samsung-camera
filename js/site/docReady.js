	/* Author: Owen Corso	*/

//*******************************************************************************
//*** DOC Ready ***
//*******************************************************************************
var shareController	= {};
var trackingController = {};
trackingController.track 	= function($cat, $action){
	log("track: category:"+ $cat+ ", action: "+$action);
							//category
	_gaq.push(['_trackEvent', $cat, $action]);
};
shareController.shareOpts = {
		maxWidth	: 1024,
		maxHeight	: 600,
		fitToView	: false,
		width		: '90%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
		afterClose	: onFancyBoxClose,
		type		: "iframe"
	};
function redirectToAuth($url){	
	log("redirect: "+$url);
	window.top.location 	= $url;
}
function openShareWindow ($url, $tid, $whichAPI){
	log("openShareWindow: "+$url);
	$.fancybox.open({href:$url}, shareController.shareOpts);
	ored.flash 					= thisMovie("flash_movie");
	if($tid) ored.tid			= $tid;
	if($whichAPI) shareController.whichAPI = $whichAPI;
};
function onFancyBoxClose ($e){
	log("pbStatus: "+shareController.status);

	if(typeof ored != 'undefined') ored.flash.shareCallback(shareController.whichAPI, shareController.status);
};

jQuery(function($) {

	log("doc is ready, yo");

	if (typeof ored !='undefined'){ 
		ored.flashReady();
log("parent = "+parent);
	}
	
	$(".fancybox").fancybox({
		maxWidth	: 1024,
		maxHeight	: 600,
		fitToView	: false,
		width		: '90%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	} );
	
	$(".share-fancybox").fancybox(shareController.shareOpts );
	
	
});//end doc ready