<?php 
	$featuredCreatedAt =  date("F j, Y", strtotime($featured->created_at));
	$detail		= base_url()."gallery/$featured->tid";
	$thumb 		= base_url()."images/gallery/thumb/$featured->tid.jpg";
	$large		= base_url()."images/gallery/large/$featured->tid.jpg";
?>

<root>

<analytics>
	<!--home !-->
	<view id="top_nav" category="home" common="false">
		<item buttonid="home" trackid="top_nav_home"></item>
		<item buttonid="dv300f" trackid="top_nav_dualview"></item>
		<item buttonid="wb150f" trackid="top_nav_longzoom"></item>
		<item buttonid="gallery" trackid="top_nav_gallery"></item>
	</view>	
	<view id="home_enter" category="home" common="false">
		<item buttonid="dv300f" trackid="home_button_enter_dualview"></item>
		<item buttonid="wb150f" trackid="home_button_enter_longview"></item>
	</view>
	<view id="top_nav_share" category="home" common="false">
		<item buttonid="facebook" trackid="top_nav_share_fb"></item>
		<item buttonid="twitter" trackid="top_nav_share_twitter"></item>
		<item buttonid="email" trackid="top_nav_share_email"></item>
	</view>
	
	<!--dualview !-->
	<view id="dualview_button" category="dualview" common="false">
		<item buttonid="turn_on" trackid="dualview_button_switchon"></item>
		<item buttonid="takePhoto" trackid="dualview_take_a_photo"></item>
		<item buttonid="moreInfo" trackid="dualview_learnmore"></item>
		<item buttonid="filters" trackid="dualview_tab_smart_filter"></item>
		<item buttonid="share" trackid="dualview_tab_share"></item>
		<item buttonid="save_to_gallery" trackid="dualview_tab_save_to_gallery"></item>
	</view>
	<view id="dualview_next" category="dualview" common="false">
		<item buttonid="tool_share" trackid="dualview_next_tab"></item>
		<item buttonid="tool_save_to_gallery" trackid="dualview_next_tab"></item>
	</view>
	
	<!--longzoom!-->
	<view id="longzoom_button" category="longzoom" common="false">
		<item buttonid="choose_your_shot" trackid="longzoom_choose_your_shot"></item>
		<item buttonid="zoom" trackid="longzoom_tab_zoom"></item>
		<item buttonid="filters" trackid="longzoom_tab_smart_filter"></item>
		<item buttonid="share" trackid="longzoom_tab_share"></item>
		<item buttonid="save_to_gallery" trackid="longzoom_save_to_gallery"></item>
		<item buttonid="moreInfo" trackid="longzoom_learnmore"></item>
		<item buttonid="zoomIn" trackid="longzoom_zoom_plus"></item>
		<item buttonid="zoomOut" trackid="longzoom_zoom_minus"></item>
	</view>
	<view id="longzoom_next" category="longzoom" common="false">
		<item buttonid="tool_filters" trackid="longzoom_zoom_next"></item>
		<item buttonid="tool_share" trackid="longzoom_smart_filter_next"></item>
		<item buttonid="tool_save_to_gallery" trackid="longzoom_share_next"></item>
	</view>
	
	<!--choose photo!-->
	<view id="choose_your_shot" common="true">
		<item buttonid="facebook_images" trackid="choose_fb_photo"></item>
		<item buttonid="local_machine" trackid="upload_photo"></item>
	</view>
	
	<!--email !-->
	<view id="app_share_email" common="true">
		<item buttonid="close" trackid="app_share_email_close"></item>
		<item buttonid="send" trackid="app_share_email_submit"></item>
	</view>
	<view id="photoshare_email" common="true">
		<item buttonid="close" trackid="photoshare_email_close"></item>
		<item buttonid="send" trackid="photoshare_email_submit"></item>
	</view>

	<!--share page!-->
	<view id="share" common="true">
		<item buttonid="facebook" trackid="share_facebook"></item>
		<item buttonid="picasa" trackid="share_picasa"></item>
		<item buttonid="photobucket" trackid="share_photobucke"></item>
		<item buttonid="email" trackid="share_email"></item>
		<item buttonid="backBtn" trackid="share_back_button"></item>
	</view>
	
	<!--share gallery!-->
	<view id="share_gallery" common="true">
		<item buttonid="close" trackid="share_gallery_close"></item>
		<item buttonid="ok" trackid="share_gallery_continue"></item>
	</view>
	
	<view id="facebook_image" common="true">
		<item buttonid="facebook_loaded" trackid="fb_photos_loaded"></item>
		<item buttonid="facebook_chosen" trackid="fb_photo_chosen"></item>
		<item buttonid="close" trackid="fb_photos_close"></item>
	</view>
	
	<!--gallery!-->
	<view id="gallery" category="gallery" common="false">
		<item buttonid="gallery_view_all" trackid="gallery_view_all"></item>
		<item buttonid="sort_by" trackid="gallery_sort_by"></item>
	</view>		
</analytics>



<environment>
	<base_url><![CDATA[<?= base_url(); ?>]]></base_url>
	<routes>
		<share>
			<endpoint id="facebook"><![CDATA[share/facebook]]></endpoint>
			<endpoint id="picasa"><![CDATA[share/picasa]]></endpoint>
			<endpoint id="photobucket"><![CDATA[share/photobucket]]></endpoint>
			<endpoint id="email"><![CDATA[share/email]]></endpoint>
		</share>
		<upload><![CDATA[file/upload/]]></upload>
		<email><![CDATA[share/email/]]></email>
		<gallery>
			<page><![CDATA[gallery/page/]]></page>
			<filtered><![CDATA[gallery/filter/]]></filtered>
		</gallery>
		<more_info>
			<camera id="dv300f"><![CDATA[http://www.samsung.com/us/photography/dualview-dual-lcd]]></camera>
			<camera id= "wb150f"><![CDATA[http://www.samsung.com/us/photography/compact-long-zoom]]></camera>
		</more_info>
	</routes>
	<facebook>
		<redirect><![CDATA[<?= $cdn; ?>auth]]></redirect>
		<app_id><?= $appId; ?></app_id>
		<app_secret><?= $secret; ?></app_secret>
		<title>Share your world the way you see it</title>
		<link><?= INSTALLED_PAGE_URL; ?></link>
		<caption>Samsung SMART Cameras</caption>
		<description>Discover the power behind Samsung's SMART camera lineup. Enter the SMART Camera Experience now.</description>
		<badge><![CDATA[<?= $cdn; ?>images/logos/badge.jpg]]></badge>
	</facebook>
	<twitter>
		<![CDATA[Discover the power of the Samsung SMART Camera lineup. Enter the SMART Camera experience now <?= $shortUrl; ?>]]>
	</twitter>
	<album_name><?= SAMSUNG_ALBUM_NAME; ?></album_name>
	<gallery>
		<featured id="<?= $featured->tid; ?>" value="gallery_button">
				<label><![CDATA[<?= $featured->tid; ?>]]></label>
				<detail><?= $detail; ?></detail>
				<large><?= $large; ?></large>
				<thumb><?= $thumb; ?></thumb>
				<full_name><![CDATA[<?= $featured->full_name; ?>]]></full_name>
				<profile_pic><![CDATA[<?= $featured->profile_pic; ?>]]></profile_pic>
				<filter><![CDATA[<?= $featured->filter; ?>]]></filter>
				<camera><![CDATA[<?= $featured->camera; ?>]]></camera>
				<created_at><![CDATA[<?= $featuredCreatedAt; ?>]]></created_at>
		</featured>
		<total_images><?= $total_images; ?></total_images>
		<total_pages><?= $total_pages; ?></total_pages>
	</gallery>
</environment>


<main_navigation id="top_nav">
	<button value="page" id="home"><label><![CDATA[Home]]></label></button>
	<button value="page" id="dv300f"><label><![CDATA[Dual View]]></label></button>
	<button value="page" id="wb150f"><label><![CDATA[Long Zoom]]></label></button>
	<button value="page" id="gallery"><label><![CDATA[Gallery]]></label></button>
</main_navigation>	

<share_navigation id="top_nav_share">
	<button value="facebook" id="facebook"><label><![CDATA[FACEBOOK]]></label></button>
	<button value="twitter" id="twitter"><label><![CDATA[TWITTER]]></label></button>
	<button value="window" id="email"><label><![CDATA[EMAIL]]></label></button>
</share_navigation>

<pages>
	
	<!-- home page -->
	<page id="home" classname="HomePage">
		<heading><![CDATA[A camera for every point of view]]></heading>
		<description><![CDATA[Introducing a lineup of cameras so SMART that they will revolutionize the way you shoot, share and save your photos.  With built-in Wi-Fi, you can send photos to social networks and e-mail contacts - right from the camera. And with the camera's SMART filters, you can turn your snapshots into works of art. Experience the different angles of the Samsung SMART camera lineup, and find the one that's right for your story.]]></description>
		<navigation id="home_enter">
			<button value="page" id="dv300f"><label><![CDATA[Enter the Dual View Experience]]></label></button>
			<button value="page" id="wb150f"><label><![CDATA[The Long Zoom Experience]]></label></button>
		</navigation>	
	</page>
	<!-- Dual View Page-->
	<page id="dv300f" classname="DualViewPage">
		<heading><![CDATA[Get in the Shot.]]></heading>
		<description><![CDATA[Featuring a front LCD screen, the DV300F SMART Camera lets you frame yourself perfectly as you hold the camera at arms length. Switch on the camera below to enable your web cam and try it for yourself.]]></description>
		<navigation id="dualview_button">
			<!--<button value="reset" id="retake"><label><![CDATA[Retake Photo]]></label></button>!-->
			<button value="page" id="filters"><label><![CDATA[SMART Filter]]></label></button>
			<button value="page" id="share"><label><![CDATA[Share]]></label></button>
			<button value="page" id="save_to_gallery"><label><![CDATA[Save to Gallery]]></label></button>
		</navigation>	
	</page>
	
	<!-- Long Zoom Page -->
	<page id="wb150f" classname="LongZoomExperiencePage">
		<heading><![CDATA[Zoom in on the details.]]></heading>
		<description><![CDATA[Get up close and personal, even from far away with Samsung Long Zoom WiFi SMART cameras.]]></description>
		<navigation id="longzoom_button">
			<button value="page" id="zoom">
				<label><![CDATA[Zoom   ]]></label>
			</button>
			<button value="page" id="filters"><label><![CDATA[SMART Filter]]></label></button>
			<button value="page" id="share"><label><![CDATA[Share]]></label></button>
			<button value="page" id="save_to_gallery"><label><![CDATA[Save to Gallery]]></label></button>
		</navigation>	
		<footer>
			<heading><![CDATA[WB150F 14 Megapixel Samsung SMART Camera:]]></heading>
			<description><![CDATA[Thin and light enough for your pocket, but packed with features, our long zoom cameras feature a 10x or greater optical zoom so you can always get your shot, even from a distance.]]></description>
		</footer>
	</page>
	
	<!-- Gallery View All Page -->
	<page id="gallery_view_all" classname="GalleryPage">
		<heading><![CDATA[Samsung SMART Gallery]]></heading>
		<description><![CDATA[Sharing stories, as they're unfolding]]></description>
		<navigation>
			<button value="paginate" id="prev"><label><![CDATA[Prev]]></label></button>
			<button value="paginate" id="next"><label><![CDATA[Next]]></label></button>
		</navigation>	
		<pull_down>
			<button value="all" 		id="all"><label><![CDATA[All]]></label></button>
			<button value="dual_view" 	id="dual_view"><label><![CDATA[Dual View]]></label></button>
			<button value="long_zoom" 	id="long_zoom"><label><![CDATA[Long Zoom]]></label></button>
			<button value="friends" 	id="friends"><label><![CDATA[Friends]]></label></button>
			<button value="mine" 		id="mine"><label><![CDATA[Mine]]></label></button>
		</pull_down>	
	</page>
	<page id="gallery" classname="GalleryLandingPage">
		<heading><![CDATA[Samsung SMART Gallery]]></heading>
		<description><![CDATA[Sharing stories, as they're unfolding]]></description>
		<navigation>
			<button value="page" id="gallery_view_all"><label><![CDATA[View All]]></label></button>
		</navigation>	

	</page>
</pages>
<camera_screens>
	<page id="zoom" classname="camerascreens.ZoomPage"></page>
	<page id="save_to_gallery" classname="camerascreens.SaveToGalleryPage"></page>
	<!-- Filters page -->
	<page id="filters" classname="camerascreens.FiltersPage">
		<navigation>
			<button id="softfocus" value="yes"><label><![CDATA[Soft Focus]]></label></button>
			<button id="fisheye" value="no"><label><![CDATA[Fish-eye]]></label></button>
			<button id="oldfilm" value="no"><label><![CDATA[Old Film]]></label></button>
			<button id="halftone" value="no"><label><![CDATA[Half Tone Dot]]></label></button>
			<button id="classic" value="yes"><label><![CDATA[Classic]]></label></button>
			<button id="retro" value="yes"><label><![CDATA[Retro]]></label></button>
			<button id="zoomingshot" value="yes"><label><![CDATA[Zooming Shot]]></label></button>
			<button id="miniature" value="yes"><label><![CDATA[Miniature]]></label></button>
			<button id="vignetting" value="yes"><label><![CDATA[Vignetting]]></label></button>
			<button id="inkpainting" value="yes"><label><![CDATA[Ink Painting]]></label></button>
			<button id="oilpainting" value="yes"><label><![CDATA[Oil Painting]]></label></button>
			<button id="cartoon" value="yes"><label><![CDATA[Cartoon]]></label></button>
			<button id="crossfilter" value="no"><label><![CDATA[Cross Filter]]></label></button>
			<button id="sketch" value="no"><label><![CDATA[Sketch]]></label></button>	
		</navigation>
	</page>
	
	<!-- share page -->
	<page id="share" classname="camerascreens.SharePage">
		<heading><![CDATA[Share...]]></heading>
		<navigation id="share">
			<button id="facebook" value="screen"><label><![CDATA[Facebook]]></label></button>
			<button id="picasa" value="screen"><label><![CDATA[Picasa]]></label></button>
			<button id="photobucket" value="screen"><label><![CDATA[Photobucket]]></label></button>
			<button id="email" value="window"><label><![CDATA[Email]]></label></button>
		</navigation>
	</page>
	
	<!-- loading -->
	<page id="loading" classname="camerascreens.LoadingPage">
		<heading><![CDATA[Loading...]]></heading>
		<description><![CDATA[Please disable any popup blockers.]]></description>
		<navigation>
			<button id="cancel" value="reset"><label><![CDATA[Cancel]]></label></button>
		</navigation>
	</page>
	<!-- comments -->
	<page id="comments" classname="camerascreens.CommentsPage">
		<heading><![CDATA[Comment]]></heading>
		<navigation>
			<button id="send" value="send"><label><![CDATA[Send]]></label></button>
		</navigation>
	</page>
	<!-- login -->
	<page id="login" classname="camerascreens.LoginPage">
		<heading><![CDATA[Comment]]></heading>
		<navigation>
			<button id="login" value="login"><label><![CDATA[Login]]></label></button>
		</navigation>
	</page>

</camera_screens>
<windows>
<!-- GENERIC RESPONSE WINDOW -->
	<window id="response" classname="ResponseWindow" close="true">
		<heading><![CDATA[Thanks for sharing!]]></heading>
		<description><![CDATA[ ]]></description>
		<navigation>
			<button value="button" id="ok"><label><![CDATA[OK]]></label></button>
		</navigation>
	</window>
	
	<!-- EMAIL A FRIEND WINDOW -->
	<window id="email" classname="email.EmailPopupWindow" close="true">
		<heading><![CDATA[The SMART Camera Experience]]></heading>
		<description><![CDATA[Share your world the way you see it.]]></description>
		<email_form>
	<field required="yes" defaultText="Your name" label="" value="from_name" email="no" />
			<field required="yes" defaultText="Your email" label="" value="from_email" email="yes" />
			<field required="yes" defaultText="Friends name" label="" value="to_name" email="no" />
			<field required="yes" defaultText="Friends email" label="" value="to_email" email="yes" />
			<field required="no" defaultText="Subject line: Share your world the way you see it" label="" value="subject" email="no" />
			<field required="no" defaultText="Discover the power behind Samsung's SMART camera lineup. Enter the SMART Camera Experience now" label="" value="message" email="no" height="100" />
			<opt value="send_updates" id="opt"><label><![CDATA[Send me email updates]]></label></opt>
		</email_form>
		<navigation id="app_share_email">
			<button value="button" id="send"><label><![CDATA[Submit]]></label></button>
		</navigation>
	</window>
	
	<!-- UPLOAD OPTIONS -->
	<window id="no_webcam_upload" classname="UploadImageWindow" close="true">
		<heading><![CDATA[No Webcam Detected.]]></heading>
		<description><![CDATA[No problem, you can still experience the power of the DV300F by uploading a photo. Please select from one of the alternate methods below.]]></description>
		<navigation id="dualview_no_web">
			<button value="window" id="facebook_images"><label><![CDATA[Choose a Facebook Photo]]></label></button>
			<button value="local_machine" id="local_machine"><label><![CDATA[Upload a Photo]]></label></button>
		</navigation>
	</window>
	<window id="longzoom_upload" classname="UploadImageWindow" close="true">
		<heading><![CDATA[Choose your shot]]></heading>
		<description><![CDATA[Select an image from your Facebook gallery or upload a photo from your computer to experience the power of Long Zoom.]]></description>
		<navigation id="longzoom_choose_your_shot">
			<button value="window" id="facebook_images"><label><![CDATA[Choose a Facebook Photo]]></label></button>
			<button value="local_machine" id="local_machine"><label><![CDATA[Upload a Photo]]></label></button>
		</navigation>
	</window>
	<!-- FACEBOOK ALBUMS -->
	<window id="facebook_images" classname="FacebookImagesWindow" close="true">
		<heading><![CDATA[Click an album to browse photos]]></heading>
		<description><![CDATA[Your Albums]]></description>
		<navigation>
			<button value="back-to-album" id="back-to-album"><label><![CDATA[Back to Albums]]></label></button>
		</navigation>
		<album_images_screen>
			<heading><![CDATA[Choose an Image]]></heading>
			<description><![CDATA[Album Images]]></description>
		</album_images_screen>
	</window>

	<!-- SHARE WINDOW -->
	<window id="share" classname="SharePopupWindow" close="true">
		<heading><![CDATA[Share]]></heading>
		<description><![CDATA[Lorem ipsum dolor sit amet, dolor dignissim orci. Est posuere viverra, mi fusce, nam ac. Nibh diam morbi, in scelerisque, et in. Lorem proident, quisque dolor, nulla neque lobortis. Mollis lectus nulla.]]></description>
		<navigation>
			<button value="facebook" id="facebook"><label><![CDATA[Facebook]]></label></button>
			<button value="twitter" id="twitter"><label><![CDATA[Twitter]]></label></button>
			<button value="window" id="email"><label><![CDATA[Email]]></label></button>
		</navigation>
	</window>
	
	<!-- FACEBOOK POST SUCCESS -->
	<window id="facebook_post_success" classname="ResponseWindow" close="true">
		<heading><![CDATA[Thanks for sharing!]]></heading>
		<description><![CDATA[A link to the Samsung SMART Camera Experience was successfully shared on your Facebook timeline]]></description>
		<navigation>
			<button value="button" id="ok"><label><![CDATA[OK]]></label></button>
		</navigation>
	</window>
	
	
	<!-- FACEBOOK POST FAILED -->
	<window id="facebook_post_failed" classname="ResponseWindow" close="true">
		<heading><![CDATA[Sorry, something went wrong.]]></heading>
		<description><![CDATA[There was a problem posting your Samsung SMART Camera Experience to your Facebook timeline. Please try again later.]]></description>
		<navigation>
			<button value="button" id="ok"><label><![CDATA[OK]]></label></button>
		</navigation>
	</window>
	<!-- FACEBOOK AUTH FAILED -->
	<window id="auth_failed" classname="ResponseWindow" close="true">
		<heading><![CDATA[Sorry, something went wrong.]]></heading>
		<description><![CDATA[There was a problem loading your data. Please log in and try again.]]></description>
		<navigation>
			<button value="button" id="ok"><label><![CDATA[OK]]></label></button>
		</navigation>
	</window>
	<!-- FACEBOOK UPLOADED -->
	<window id="api_uploaded" classname="ResponseWindow" close="true">
		<heading><![CDATA[Congrats!]]></heading>
		<description><![CDATA[You've successfully uploaded to %%whichAPI%%.]]></description>
		<navigation>
			<button value="button" id="ok"><label><![CDATA[OK]]></label></button>
		</navigation>
	</window>
	<!-- SAVE TO GALLERY CONFIRM -->
	<window id="save_to_gallery" classname="SaveToGalleryWindow" close="true">
		<heading><![CDATA[Success!]]></heading>
		<description><![CDATA[Your image has been added to the SMART Camera Experience Gallery.]]></description>
		<navigation id="share_gallery">
			<button value="button" id="ok"><label><![CDATA[Take me to the Gallery]]></label></button>
		</navigation>
	</window>
	<!-- EMAIL SENT CONFIRM -->
	<window id="email_sent" classname="ResponseWindow" close="true">
		<heading><![CDATA[Email has been sent.]]></heading>
		<description><![CDATA[Your email has been sent to your friend.]]></description>
		<navigation>
			<button value="button" id="ok"><label><![CDATA[Take me to the Gallery]]></label></button>
		</navigation>
	</window>
	<!-- EMAIL SENT CONFIRM -->
	<window id="picasa_uploaded_failed" classname="ResponseWindow" close="true">
		<heading><![CDATA[Sorry, something went wrong.]]></heading>
		<description><![CDATA[There was a problem loading your Picasa data. Please log in and try again.]]></description>
		<navigation>
			<button value="button" id="ok"><label><![CDATA[OK]]></label></button>
		</navigation>
	</window>
	<!-- CONFIRM EXIT WINDOW -->
	<window id="confirm_exit" classname="ConfirmExitPopupWindow">
		<heading><![CDATA[Are you sure?]]></heading>
		<description><![CDATA[Lorem ipsum dolor sit amet, dolor dignissim orci. Est posuere viverra, mi fusce, nam ac. Nibh diam morbi, in scelerisque, et in. Lorem proident, quisque dolor, nulla neque lobortis. Mollis lectus nulla.]]></description>
		<navigation>
			<button value="button" id="cancel"><label><![CDATA[Cancel]]></label></button>
			<button value="button" id="ok" href="gallery/"><label><![CDATA[OK]]></label></button>
		</navigation>
	</window>
	<!-- GALLERY DETAIL -->
	<window id="gallery_detail" classname="GalleryDetailWindow">
		<heading><![CDATA[Baby]]></heading>
		<description><![CDATA[Viewing 1 of 300]]></description>
		<navigation>
			<button value="button" id="cancel"><label><![CDATA[Cancel]]></label></button>
			<button value="button" id="ok" href="gallery/"><label><![CDATA[OK]]></label></button>
		</navigation>
	</window>
</windows>
<tooltips>

	<tooltip id="turn_on" value="ui" pageId="dv300f" width="220" height="48" direction="right" arrowPoint="15" xPos="116">
		<description color="blue"><![CDATA[Click to enable your web cam and take your own portrait.]]></description>
	</tooltip>
	<tooltip id="choose_your_shot" value="ui" pageId="wb150f" width="253" height="60" direction="right" arrowPoint="25" xPos="180">
		<description color="blue"><![CDATA[Select an image from your Facebook gallery or your computer.]]></description>
	</tooltip>
	
	
	<!--duel view section-->
	<tooltip id="filters" value="nav" pageId="dv300f" width="504" height="105" direction="top" arrowPoint="107" xPos="-35">
		<heading><![CDATA[Express Yourself]]></heading>
		<description color="gray"><![CDATA[Samsung SMART filters let you enhance your photos, so the world can&#10;see what you see. Click on the filters below to experience the&#10;SMART Filter effect.]]></description>
		<navigation id="dualview_next">
			<button value="tool" id="tool_share"><label><![CDATA[Next >]]></label></button>
		</navigation>
	</tooltip>
	<tooltip id="share" value="nav" pageId="dv300f" width="504" height="105" direction="top" arrowPoint="244" xPos="-180">
		<heading><![CDATA[Share your story as it's unfolding.]]></heading>
		<description color="gray"><![CDATA[With the SMART camera's built-in WiFi, you can share your moments wherever you are. Click on your favorite social network below to&#10;start sharing.]]></description>
		<navigation id="dualview_next">
			<button value="tool" id="tool_save_to_gallery"><label><![CDATA[Next >]]></label></button>
		</navigation>
	</tooltip>
	<tooltip id="save_to_gallery" value="nav" pageId="dv300f" width="504" height="105" direction="top" arrowPoint="398" xPos="-317">
		<heading><![CDATA[Share Your Shot]]></heading>
		<description color="gray"><![CDATA[Add your photo to the Samsung SMART Gallery so that others can see the world the way you do.]]></description>
	</tooltip>
	
	<!--long zoom section-->
	<tooltip id="zoom" value="nav" pageId="wb150f" width="504" height="105" direction="top" arrowPoint="105" xPos="-32">
		<heading><![CDATA[The power of Zoom]]></heading>
		<description color="gray"><![CDATA[Long Zoom lets you focus on the details in life.  Use the Zoom button below to zoom into one of your own photos, and experience the power of the Samsung Long Zoom.]]></description>
		<navigation id="longzoom_next">
			<button value="tool" id="tool_filters"><label><![CDATA[Next >]]></label></button>
		</navigation>
	</tooltip>
	<tooltip id="filters" value="nav" pageId="wb150f" width="504" height="105" direction="top" arrowPoint="246" xPos="-172">
		<heading><![CDATA[Express Yourself]]></heading>
		<description color="gray"><![CDATA[Samsung SMART filters let you enhance your photos, so the world can&#10;see what you see. Click on the filters below to experience the&#10;SMART Filter effect.]]></description>
		<navigation id="longzoom_next">
			<button value="tool" id="tool_share"><label><![CDATA[Next >]]></label></button>
		</navigation>
	</tooltip>
	<tooltip id="share" value="nav" pageId="wb150f" width="504" height="105" direction="top" arrowPoint="388" xPos="-318">
		<heading><![CDATA[Share your story as it's unfolding.]]></heading>
		<description color="gray"><![CDATA[With the SMART camera's built-in WiFi, you can share your moments wherever you are. Click on your favorite social network below to&#10;start sharing.]]></description>
		<navigation id="longzoom_next">
			<button value="tool" id="tool_save_to_gallery"><label><![CDATA[Next >]]></label></button>
		</navigation>
	</tooltip>
	<tooltip id="save_to_gallery" pageId="wb150f" value="nav" width="504" height="105" direction="top" arrowPoint="535" xPos="-455">
		<heading><![CDATA[Share Your Shot]]></heading>
		<description color="gray"><![CDATA[Add your photo to the Samsung SMART Gallery so that others can see the world the way you do.]]></description>
	</tooltip>
</tooltips>
</root>