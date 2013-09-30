<div id="editmast">
	<strong>EDIT ITEM</strong>
	<h2><?=$record->photoUserName?></h2>
</div>
<? $hidden = array('ID' => $record->photoId); ?>
<?=form_open($this->uri->segment(1).'/edit/'.$record->photoId, '', $hidden)?>
<fieldset>
	<ul>
		<li>
			<label>User Name <span>(Required)</span></label>
			<?=form_input('photoUserName', set_value('photoUserName', $record->photoUserName))?>
			<?=form_error('photoUserName')?>
		</li>
		<li>
			<label>Full Name</label>
			<?=form_input('photoFullName', set_value('photoFullName', $record->photoFullName))?>
			<?=form_error('photoFullName')?>
		</li>
		<li>
			<label>Dog Name</label>
			<?=form_input('photoName', set_value('photoName', $record->photoName))?>
			<?=form_error('photoName')?>
		</li>
		<li>
			<label>Caption</label>
			<?=form_input('photoCaption', set_value('photoCaption', $record->photoCaption))?>
			<?=form_error('photoCaption')?>
		</li>
		<li>
			<input type="submit" value="Save" name="" class="button">
		</li>
	</ul>
	<ul>
		<li>
			<label>Instagram ID</label>
			<?=form_input('photoInstagramId', set_value('photoInstagramId', $record->photoInstagramId))?>
			<?=form_error('photoInstagramId')?>
		</li>
		<li>
			<label>Instagram Page</label>
			<?=form_input('photoInstagramPage', set_value('photoInstagramPage', $record->photoInstagramPage))?>
			<?=form_error('photoInstagramPage')?>
		</li>
		<li>
			<label>Photo Small</label>
			<?=form_input('photoInstagramSm', set_value('photoInstagramSm', $record->photoInstagramSm))?>
			<?=form_error('photoInstagramSm')?>
		</li>
		<li>
			<label>Photo Large</label>
			<?=form_input('photoInstagramLg', set_value('photoInstagramLg', $record->photoInstagramLg))?>
			<?=form_error('photoInstagramLg')?>
		</li>
		<li>
			<label>Profile Pic</label>
			<?=form_input('photoInstagramProfilePic', set_value('photoInstagramProfilePic', $record->photoInstagramProfilePic))?>
			<?=form_error('photoInstagramProfilePic')?>
		</li>
	</ul>
</fieldset>
<?=form_close()?>