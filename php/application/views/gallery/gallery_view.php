<?php foreach($records as $i):
	$thumb 		= base_url()."images/gallery/thumb/$i->tid.jpg";
	$large		= base_url()."images/gallery/large/$i->tid.jpg";
	$detail		= base_url()."gallery/$i->tid";
?>

<div>
	<div>
		<img src="<?= $thumb; ?>" width="253" height="253" />
	</div>
</div>
<?php endforeach; ?>

<div id="gallerynav">
	<?php if( $current_page > 0 ): ?>
		<?php $prevPage = $current_page - 1; ?>
		<a href="/gallery/index/<?=$prevPage?>">Previous</a>
	<?php endif; ?>
	
	<?php for($pgCt=0; $pgCt<$total_pages-1; $pgCt++): ?>
			<a href="/gallery/index/<?= $pgCt+1 ?>"><?= $pgCt+1 ?></a>
	<?php endfor; ?>
	
	<?php if( $current_page+1 < $total_pages ): ?>
		<?php $nextPage = $current_page + 1; ?>
		<a href="/gallery/index/<?=$nextPage?>" class="navbtn">Next</a>
	<?php endif; ?>
</div>
