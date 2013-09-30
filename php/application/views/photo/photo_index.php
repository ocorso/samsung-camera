<div id="addedit" class="dialog">
</div>

<a href="<?=base_url()?><?=$this->uri->segment(1);?>/csv" class="button" style="float:left; clear:right;">Export CSV</a>

<strong  style="float:left; clear:both;">Total Records: <?=$total_rows?></strong>
<style type="text/css">
	td{
		text-align: center;
	}
</style>
<table width="100%" border="1" cellpadding="16" style="float:left; clear:both;">
	<tr>
		<th></th>
		<th>Image ID</th>
		<th>Profile Pic</th>
		<th>Full Name</th>
		<th>User Id</th>
		<th>Filter</th>
		<th>Camera</th>
		<th>Created At</th>
		<th></th>
		<th></th>
	</tr>
	<?if(isset($records) && is_array($records) && count($records)>0):?>
		<?foreach($records as $record):?>
		<tr>
			<td style="text-align: left;"><img src="<?= base_url()."/images/gallery/thumb/".$record->tid. ".jpg"?>"/></td>
			<td><?=$record->tid?></td>
			<td><img src="<?=$record->profile_pic?>"/></td>
			<td><?=$record->full_name?></td>
			<td><?=$record->user_id?></td>
			<td><?=$record->filter?></td>
			<td><?=$record->camera?></td>
			<td><?=$record->created_at?></td>
			<td>
				<?=form_open($this->uri->segment(1).'/flag/'.$record->$pk)?>
				<? if( $record->flag == 0 ): ?>
					<input type="hidden" name="flag" value="1"/>
					<input type="submit" value="Flag" style="padding:4px; margin:4px;"/>
				<? else: ?>
					<input type="hidden" name="flag" value="0"/>
					<input type="submit" value="Un-Flag" style="background-color:#fcc; padding:4px; margin:4px;"/>
				<? endif; ?>
				<?=form_close()?>
				<?=form_open($this->uri->segment(1).'/feature/'.$record->$pk)?>
				<? if( $record->featured == 0 ): ?>
					<input type="hidden" name="featured" value="1"/>
					<input type="submit" value="Feature" style="padding:4px; margin:4px;"/>
				<? else: ?>
					<input type="hidden" name="featured" value="0"/>
					<input type="submit" value="Un-Feature" style="background-color:#fcc; padding:4px; margin:4px;"/>
				<? endif; ?>
				<?=form_close()?>
			</td>
			<td><a href='<?=base_url()?><?=$this->uri->segment(1);?>/delete/<?=$record->$pk?>'>Delete</a></td>
		</tr>
		<?endforeach?>
	<?else:?>
		<tr>
			<td colspan="3">There are currently no records.</td>
		</tr>
	<?endif?>
</table>