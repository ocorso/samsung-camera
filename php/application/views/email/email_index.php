<div id="addedit" class="dialog">
</div>

<a href="<?=base_url()?><?=$this->uri->segment(1);?>/add" class="button" style="float:left; margin-right:5px;">Send Email</a>
<a href="<?=base_url()?><?=$this->uri->segment(1);?>/csv" class="button" style="float:left; clear:right;">Export CSV</a>

<?if($this->session->flashdata('flashError')):?>
<div class='flashError'>
	Error! <?=$this->session->flashdata('flashError')?>
</div>
<?endif?>

<?if($this->session->flashdata('flashConfirm')):?>
<div class='flashConfirm'>
	Success! <?=$this->session->flashdata('flashConfirm')?>
</div>
<?endif?>

<strong  style="float:left; clear:both;">Total Records: <?=$total_rows?></strong>

<table border="1" cellpadding="4" style="float:left; clear:both;">
	<tr>
		<th width="100">To Name</th>
		<th width="100">To Email</th>
		<th width="100">From Name</th>
		<th width="100">First Name</th>
		<th width="100">From Email</th>
		<th width="100">Card ID</th>
		<th width="100">Message</th>
		<th width="100">Opt In</th>
		<th width="100">Image</th>
		<!--<th width="100"></th>
		<th width="100"></th>-->
	</tr>
	<?if(isset($records) && is_array($records) && count($records)>0):?>
		<?foreach($records as $record):?>
		<tr>
			<td><?=$record->toName?></td>
			<td><?=$record->toEmail?></td>
			<td><?=$record->fromName?></td>
			<td><?=$record->fromFirstName?></td>
			<td><?=$record->fromEmail?></td>
			<td><?=$record->cardid?></td>
			<td><?=$record->message?></td>
			<td><?=$record->optin?></td>
			<td><a href='<?=base_url()?>uploads/<?=$record->imgFile?>' target="_blank"><?=$record->imgFile?></a></td>
			<!--<td><a href='<?=base_url()?><?=$this->uri->segment(1);?>/edit/html/<?=$record->$pk?>'>Edit</a></td>
			<td><a href='<?=base_url()?><?=$this->uri->segment(1);?>/delete/<?=$record->$pk?>'>Delete</a></td>-->
		</tr>
		<?endforeach?>
	<?else:?>
		<tr>
			<td colspan="3">There are currently no records.</td>
		</tr>
	<?endif?>
</table>