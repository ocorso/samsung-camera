<h2>Send Email</h2>
<?=form_open('email/sendmail')?>
<fieldset>
	<ul>
		<li>
			<label>To Name</label>
			<?=form_input(array('name'=>'toName', 
		                       'id'=>'toName',
		                       'value'=>'Matt'))?>
		</li>
		<li>
			<label>From Name</label>
			<?=form_input(array('name'=>'fromName', 
		                       'id'=>'fromName',
		                       'value'=>'Matthew'))?>
		</li>
		<li>
			<label>CC Sender</label>
			<?=form_input(array('name'=>'ccsender', 
		                       'id'=>'ccsender',
		                       'value'=>'1'))?>
		</li>
		<li>
			<label>Opt In</label>
			<?=form_input(array('name'=>'optin', 
		                       'id'=>'optin',
		                       'value'=>'1'))?>
		</li>
		<li>
			<input type="submit" value="Send" name="" class="button">
		</li>
	</ul>
	<ul>
		<li>
			<label>To Email</label>
			<?=form_input(array('name'=>'toEmail', 
		                       'id'=>'toEmail',
		                       'value'=>'mwilber@gmail.com'))?>
		</li>
		<li>
			<label>From Email</label>
			<?=form_input(array('name'=>'fromEmail', 
		                       'id'=>'fromEmail',
		                       'value'=>'matt@mwilber.com'))?>
		</li>
		<li>
			<label>Message</label>
			<?=form_input(array('name'=>'message', 
		                       'id'=>'message',
		                       'value'=>'this is a test message'))?>
		</li>
	</ul>
</fieldset>    
<?=form_close()?>