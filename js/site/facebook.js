var sessionData = {profile:'',session:'', scope:'none'};
var _postWaiting = null;

function BasicPermissions(){
	console.log("BasicPermissions  : ");
	
	FB.login(function(response) {
		if (response.authResponse || response.session) {
    		sessionData.scope = "basic";
 		   	onAuthorizationSuccess(response);
 	   } else {
 		   sessionData.scope = "none";
 		   onAuthorizationFailed();
 	   }
    });
}

//Get extended permissions and do something with it
function ExtendedPermissions() {
	console.log("ExtendedPermissions  : ");
	
    FB.login( function(response){
    	if (response.authResponse || response.session){
    		sessionData.scope = "extended";
 		   	onAuthorizationSuccess(response);
    	} else {
    		onAuthorizationFailed();
    	}
    }, {scope:'publish_stream, user_photos, user_likes'});
}

// Post to user's wall using facebook javascript api
function WallPost(pLink, pTitle, pDescription, pImage, pCaption, _from, _to){
	console.log("WallPost  : ");
	
	var postParams = {
		from: 			_from,
		method: 		'feed',
		display: 		'dialog',
		name: 			pTitle,
		link: 			pLink,
		picture: 		pImage,
		caption: 		pCaption,
		description: 	pDescription
	};
	
	if(_to != undefined){
		postParams.to = _to;
		
		if(scope != "extended"){
			_postWaiting = postParams;
			ExtendedPermissions();
			return;
		}
	}
	
	FB.ui(postParams , function(response) {
		if (response && response.post_id) {
			onPostToWallSuccess(response.post_id);
		} else {
			onPostToWallFailed();
		}
	});
}

function onPostToWallSuccess(_postId){
	console.log("onPostToWallSuccess  : ");
	//tell flash we have posted
	thisMovie("flash_movie").onPostToWallSuccess(_postId);
}

function onPostToWallFailed(){
	console.log("onPostToWallFailed  : ");
	//tell flash we have failed
	thisMovie("flash_movie").onPostToWallFailed();
}

function onAuthorizationSuccess(_response){
	console.log("onAuthorizationSuccess  : ");
	$('#permissions').hide();
	
	if( _response.session == undefined ){
		sessionData.session = _response.authResponse;
	}else{
		sessionData.session = _response.session;
	}
	
	var access_token;
	if( sessionData.session.accessToken == undefined ){
		access_token = sessionData.session.access_token;
	}else{
		access_token = sessionData.session.accessToken;
	}
	
	console.log("		-- token : " + access_token);
	
	//tell flash we are good to go
	thisMovie("flash_movie").onAuthorizationSuccess(access_token);
}

function onAuthorizationFailed(){	
	console.log("onAuthorizationFailed  : ");
	//tell flash we have failed
	thisMovie("flash_movie").onAuthorizationFailed();
}

function onLoginFailed(){
	console.log("onLoginFailed  : ");
	//tell flash login failed
	thisMovie("flash_movie").onLoginFailed();
}

function thisMovie(movieName) {
   if (navigator.appName.indexOf("Microsoft") != -1) {
       return window[movieName];
   } else {
       return document[movieName];
   }
}

// Resize the facebook iframe to match the height of the div #page
function SetFrame(){
	var h = $("header").height() + environment.height + $("footer").height() + 110;
	log(h);
	FB.Canvas.setSize({ width: environment.width, height: h });
}


function scrollToTop(){
	$(document).scrollTop(0);
	FB.Canvas.scrollTo(0,0);
}

function getSessionData(){
	return sessionData.session;
}

function getAuthorization($scope){	
	log("getAuthorization  : ", $scope);
	// Get facebook session info called from Flash
	FB.getLoginStatus(function(response) {
        if (response.session || response.authResponse) {
        	if($scope == "extended"){
        		if(sessionData.scope != $scope){
        			ExtendedPermissions();
        			return;
        		}
        	} else if($scope == "basic"){
        		if(sessionData.scope != $scope){
        			BasicPermissions();
        			return;
        		}
        	}
        	
        	onAuthorizationSuccess(response);
        } else {
        	if($scope == "extended"){
        		ExtendedPermissions();
        	} else { 
        		BasicPermissions();
        	}
        }
    });
}

function getCurrentScope(){
	return session.scope;
}

function checkForAuthToken(){	
	FB.getLoginStatus(function(response) {
		//console.log("checkForAuthToken  : " + response.status + " ::: " + response.authResponse.accessToken);
		
		if (response.status === 'connected') {
			onAuthorizationSuccess(response);
		} 
	 });
}