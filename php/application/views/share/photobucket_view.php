<h1>photobucket view</h1>
<?php	if (isset($isRedirect)): ?> 
		<h3>isRedirect</h3>
		<script>
			parent.shareController.whichAPI		= "photobucket";
			parent.shareController.status 		= "<?= $status; ?>";
			parent.$.fancybox.close();
		</script>
<?php endif; ?>