//vyhledávání už jsem nestihl doimplementovat

<?php $this->view('includes/header',$data); ?>

	<div class="p-4"><h3>Search</h3></div>
	<div class="px-4">Searching for: <?=!empty($_GET['find']) ? $_GET['find'] : 'empty string'?></div>
	<div class="row p-4 justify-content-center">

		<?php if(!empty($rows)):?>
			<?php foreach($rows as $row):?>
				<?php $this->view('includes/photo-card',['row'=>$row,'image'=>$image])?>
			<?php endforeach?>
		<?php else:?>
			<div class="p-2 text-center">No images found!</div>
		<?php endif?>
		
	</div>
	<div>
		<?php $pager->display()?>
		
	</div>
<?php $this->view('includes/footer',$data); ?>