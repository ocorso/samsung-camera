	  <link rel="stylesheet" href="<?= base_url(); ?>css/style.css">
	<h1>Sweepstakes Details and Form</h1>
	<div id='sweepstakes_main'>
		<img src="<?= base_url(); ?>/images/cameras/dv300/fpo-dv300.png" alt="Samsung DV300 Image" />
		<?php echo validation_errors(); ?>
		
		<?php echo form_open('form'); ?>
		
		<h5>First Name</h5>
		<input type="text" name="fname" value="" size="50" />
		
		<h5>Last Name</h5>
		<input type="text" name="lname" value="" size="50" />
		
		<h5>Phone Number</h5>
		<input type="text" name="phone" value="" size="50" />
		
		<h5>Email Address</h5>
		<input type="text" name="email" value="" size="50" />
		
		<div><input type="submit" value="Submit" /></div>
		
		</form>
	</div>
	<div id="sweepstakes_details">
	<h2>Camera Benefits.</h2>
		<ul>
			<li>Lorem ipsum dolor sit amet</li>
			<li>Lorem ipsum dolor sit amet</li>
			<li>Lorem ipsum dolor sit amet</li>
			<li>Lorem ipsum dolor sit amet</li>
		</ul>
		<h2>Sweepstakes Details:</h2>
		<p>Maecenas id libero metus. Nam bibendum velit purus, sit amet accumsan erat. Curabitur ultrices aliquet vulputate. Suspendisse potenti. Duis vel odio nibh, non molestie metus. Integer semper tincidunt placerat. Nulla facilisi. Vivamus sollicitudin eleifend libero ut placerat.</p>
	</div>