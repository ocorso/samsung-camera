<root>
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
		<more_info>
			<camera id="dv300f"><![CDATA[http://www.samsung.com/us/photography/dualview-dual-lcd]]></camera>
			<camera id= "wb150f"><![CDATA[http://www.samsung.com/us/photography/compact-long-zoom]]></camera>
		</more_info>
	</routes>
	<facebook>
		<app_id><?= $appId; ?></app_id>
		<app_secret><?= $secret; ?></app_secret>
		<title>Share your world the way you see it</title>
		<caption>Dual View Camera</caption>
		<description>Discover the power behind Samsung's SMART camera lineup. Enter the SMART Camera Experience now.</description>
		<badge><![CDATA[<?= $cdn; ?>images/logos/badge.jpg]]></badge>
	</facebook>
	<twitter>
		<![CDATA[Discover the power of the Samsung SMART Camera lineup. Enter the SMART Camera experience now <?= $shortUrl; ?>]]>
	</twitter>
	<album_name><?= SAMSUNG_ALBUM_NAME; ?></album_name>
</environment>

<main_navigation>
	<button value="page" id="home"><label><![CDATA[Home]]></label></button>
	<button value="page" id="dv300f"><label><![CDATA[Dual View]]></label></button>
	<button value="page" id="wb150f"><label><![CDATA[Long Zoom]]></label></button>
</main_navigation>	

<share_navigation>
	<button value="facebook" id="facebook"><label><![CDATA[FACEBOOK]]></label></button>
	<button value="twitter" id="twitter"><label><![CDATA[TWITTER]]></label></button>
	<button value="window" id="email"><label><![CDATA[EMAIL]]></label></button>
</share_navigation>

<pages>
	
	<!-- home page -->
	<page id="home" classname="HomePage">
		<heading><![CDATA[A camera for every point of view]]></heading>
		<description><![CDATA[Introducing a lineup of cameras so SMART that they will revolutionize the way you shoot, share and save your photos.  With built-in Wi-Fi, you can send photos to social networks and e-mail contacts - right from the camera. And with the camera's SMART filters, you can turn your snapshots into works of art. Experience the different angles of the Samsung SMART camera lineup, and find the one that's right for your story.]]></description>
		<navigation>
			<button value="page" id="dv300f"><label><![CDATA[Enter the Dual View Experience]]></label></button>
			<button value="page" id="wb150f"><label><![CDATA[The Long Zoom Experience]]></label></button>
		</navigation>	
	</page>
	<!-- Dual View Page-->
	<page id="dv300f" classname="DualViewPage">
		<heading><![CDATA[Get in the Shot.]]></heading>
		<description><![CDATA[Featuring a front LCD screen, the DV300F SMART Camera lets you frame yourself perfectly as you hold the camera at arms length. Switch on the camera below to enable your web cam and try it for yourself.]]></description>
		<navigation>
			<!--<button value="reset" id="retake"><label><![CDATA[Retake Photo]]></label></button>!-->
			<button value="page" id="filters"><label><![CDATA[SMART Filter]]></label></button>
			<button value="page" id="share"><label><![CDATA[Share]]></label></button>
			<!--<button value="window" id="save_to_gallery"><label><![CDATA[Save to Gallery]]></label></button>-->
		</navigation>	
	</page>
	
	<!-- Long Zoom Page -->
	<page id="wb150f" classname="LongZoomPage">
		<heading><![CDATA[Zoom in on the details.]]></heading>
		<description><![CDATA[Get up close and personal, even from far away with Samsung Long Zoom WiFi SMART cameras.]]></description>
		<navigation>
			<!--<button value="link" id="more_info"><label><![CDATA[Learn more about Long Zoom SMART cameras at Samsung.com]]></label></button>
			<button value="page" id="zoom"><label><![CDATA[Zoom]]></label></button>
			<button value="page" id="filters"><label><![CDATA[SMART Filter]]></label></button>
			<button value="page" id="share"><label><![CDATA[Share]]></label></button>
			<button value="window" id="save_to_gallery"><label><![CDATA[Save to Gallery]]></label></button>!-->
		</navigation>	
		<footer>
			<heading><![CDATA[WB150F 14 Megapixel Samsung SMART Camera:]]></heading>
			<description><![CDATA[Thin and light enough for your pocket, but packed with features, our long zoom cameras feature a 10x or greater optical zoom so you can always get your shot, even from a distance.]]></description>
		</footer>
	</page>
</pages>
<camera_screens>
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
		<heading><![CDATA[Social Sharing]]></heading>
		<description><![CDATA[Lorem ipsum dolor sit amet, dolor dignissim orci. Est posuere viverra, mi fusce, nam ac. Nibh diam morbi, in scelerisque, et in. Lorem proident, quisque dolor, nulla neque lobortis. Mollis lectus nulla.]]></description>
		<navigation>
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
		<navigation>
			<button value="button" id="send"><label><![CDATA[Submit]]></label></button>
		</navigation>
	</window>
	
	<!-- UPLOAD OPTIONS -->
	<window id="no_webcam_upload" classname="UploadImageWindow" close="true">
		<heading><![CDATA[No Webcam Detected.]]></heading>
		<description><![CDATA[No problem, you can still experience the power of the DV300F by uploading a photo. Please select from one of the alternate methods below.]]></description>
		<navigation>
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
	<window id="save_to_gallery" classname="ResponseWindow" close="true">
		<heading><![CDATA[Save To Gallery Confirmation]]></heading>
		<description><![CDATA[Your image has been added to the SMART Camera Experience Gallery.]]></description>
		<navigation>
			<button value="button" id="ok"><label><![CDATA[OK]]></label></button>
		</navigation>
	</window>
	<!-- EMAIL SENT CONFIRM -->
	<window id="email_sent" classname="ResponseWindow" close="true">
		<heading><![CDATA[Email has been sent.]]></heading>
		<description><![CDATA[Your email has been sent to your friend.]]></description>
		<navigation>
			<button value="button" id="ok"><label><![CDATA[OK]]></label></button>
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
</windows>
<tooltips>
	<tooltip id="wb150f" value="wb150f" width="103" height="35" direction="top" arrowPoint="75" xPos="45">
		<description color="blue"><![CDATA[Coming soon!]]></description>
	</tooltip>
	<tooltip id="turn_on" value="turn_on" width="220" height="48" direction="right" arrowPoint="15" xPos="116">
		<description color="blue"><![CDATA[Click to enable your web cam and take your own portrait.]]></description>
	</tooltip>
	<tooltip id="filters" value="DV_filters" width="600" height="105" direction="top" arrowPoint="180" xPos="-110">
		<heading><![CDATA[Express Yourself]]></heading>
		<description color="gray"><![CDATA[Samsung SMART filters let you enhance your photos, so the world can see what you see. Click on the filters below to experience the SMART Filter effect.]]></description>
		<navigation>
			<button value="tool" id="tool_share"><label><![CDATA[Share your story >]]></label></button>
		</navigation>
	</tooltip>
	<tooltip id="share" value="DV_share" width="600" height="105" direction="top" arrowPoint="320" xPos="-256">
		<heading><![CDATA[Share your story as it's unfolding.]]></heading>
		<description color="gray"><![CDATA[With the SMART camera's built-in WiFi, you can share your moments wherever you are. Click on your favorite social network below to start sharing.]]></description>
		<navigation>
			<button value="tool" id="tool_filters"><label><![CDATA[Apply a filter >]]></label></button>
		</navigation>
	</tooltip>
</tooltips>
</root>