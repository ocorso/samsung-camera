jQuery(function($) {

			var val = "Day"+ored.day+"::"+ored.tag;
			log("doc is ready, like a boss: "+val);
			$('#tag_select').val(val);
			
			$('#tag_select').change(function($e){
				$("#loader").show();
				var d		= {};
				var valArr	= $(this).val().split("::");
				d.tag	 	= valArr[1];
				d.day		= valArr[0].replace("Day","");
				log(d);
				$('#display_day').text(d.tag);
				$.post(ored.photosUrl, d, ored.onChangeComplete);
				});

			$('#populate').click(function($e){
				$("#loader").show();
				$e.preventDefault();
				var d		= {};
				var valArr	= $('#tag_select').val().split("::");
				d.tag	 	= valArr[1];
				d.p			= "Gr@ndslam";
				log(d);
				$.post(ored.populateUrl, d, ored.onPopulateComplete);
				return false;
			});
			
			ored.setNumTagged();
			ored.addImageHandlers();	
		});


ored.setPhotoOfDay 	= function ($data){
	log("onPhotoOfDayComplete");
	
};
ored.setNumTagged	= function (){
	var numTaggedImgs	= $('.tag').length;
	var numUploaded		= $('.uploaded').length;
	
	log("numTags: "+numTaggedImgs);
	$("#total_tags_label").text(numTaggedImgs);
	$("#total_uploaded").text(numUploaded);
};
ored.onPopulateComplete	= function($data){
	log("onPopulateComplete"); 
	$('#tag_select').trigger('change');
};
ored.onChangeComplete = function($data){
	log("onChangeComplete: ");
	$("#loader").hide();
	$('#tags_container').html($data);
	ored.addImageHandlers();
	ored.setNumTagged();
};

ored.addImageHandlers	= function(){
	log("addImageHandlers");
	
	$('.flag-btn').click(function($e){
		var b 			= $(this);
		b.fadeOut();
		b.siblings('.flag-btn').show();
		var data 		= b.data();
		log(data);
		$.post(ored.flagUrl, data, function($d){ console.log("onFlagComplete");});
	});
	
	$('.photo-of-day').click(function($e){
		var b		= $(this);
		$('.photo-of-day').not(b).show();
		b.fadeOut();
		var d		= b.data();
		log(d);
		$.post(ored.photoOfDayUrl, d, ored.setPhotoOfDay);
	});
	
};
