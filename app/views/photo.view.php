<?php $this->view('includes/header',$data); ?>

	<div class="p-4 text-center"><h3>Detailní pohled na vybrané fotografie</h3></div>
	<div class="row p-4 justify-content-center">

		<?php if(!empty($row)):?>
			<div class="col-sm-12 text-center bg-light">
					<div class="card-header"><h4><?=esc($row->title)?></h4></div>
					<div class="card-header"><a href="<?=ROOT?>/profile/<?=$row->user_id?>"><i>By: <?=esc($row->username)?></i></a></div>
					<img src="<?=get_image($row->image)?>" class="img-thumbnail" style="sobject-fit: cover;widsth:250px;hseight:250px"  >
					<img src="<?=get_image($row->image1)?>" class="img-thumbnail" style="sobject-fit: cover;widsth:250px;hseight:250px"  >
					<img src="<?=get_image($row->image2)?>" class="img-thumbnail" style="sobject-fit: cover;widsth:250px;hseight:250px"  >
					<img src="<?=get_image($row->image3)?>" class="img-thumbnail" style="sobject-fit: cover;widsth:250px;hseight:250px"  >
				<br>

				<?php if($ses->is_logged_in() && $ses->user('id') == $row->user_id):?>
					<a href="<?=ROOT?>/upload/edit/<?=$row->id?>">
						Edit Image
					</a>
					|
					<a href="<?=ROOT?>/upload/delete/<?=$row->id?>">
						Delete Image
					</a>
				<?php endif?>
			</div>

			<div class="border p-2 mx-auto row bg-light" style="max-width:1000px">
				<h5>Comments</h5>

				<?php if($ses->is_logged_in()):?>
					<form id="myform" method="post" >
						<textarea name="comment" rows="3" class="js-comment-text form-control" placeholder="Write a comment" required></textarea>
						<button class="btn btn-primary my-2">Přidat Komentář</button>
						<input class="js-comment-id" type="hidden" name="comment_id" value="">
					</form>
				<?php endif?>
				
				<div class="js-comments my-3">
					
					<?php if(!empty($comments)):?>
					<?php foreach($comments as $com):?>
						<div class="single-comment row border-bottom py-1 my-1">
							<div class="col-sm-2 text-center">
								<img src="<?=get_image($com->user_row->image ?? '')?>" class="img-thumbnail rounded-circle" style="width:100%;max-width:100px">
								<div><?=$com->user_row->username ?? 'Unknown'?></div>
							</div>
							<div class="col-sm-10">
								<div class="text-muted"><?=get_date($com->date_created)?></div>
								<div><?=esc($com->comment)?></div>
								<br>
								<?php if($ses->is_logged_in() && $ses->user('id') == $com->user_id):?>
									<a onclick="comment.edit(<?=$com->id?>)" style="cursor: pointer;" class="text-primary">
										Upravit
									</a>
									|
									<a onclick="comment.delete(<?=$com->id?>)" style="cursor: pointer;" class="text-primary">
										Odstranit
									</a>
								<?php endif?>

							</div>
						</div>
					<?php endforeach?>
					<?php else:?>
						<div class="alert alert-success text-center">Nejsou zde žádné komentáře. Můžete přidat první komentář:</div>
					<?php endif?>

				</div>

				<?php $pager->display()?>
			</div>

		<?php else:?>
			<div class="p-2 text-center">Fotografie nenalezena!</div>
		<?php endif?>
		
	</div>
<?php $this->view('includes/footer',$data); ?>

<script>
	
	var comment = {

		commenting: false,
		comments: JSON.parse('<?=json_encode(is_array($comments) ? $comments : [])?>'),

		delete: function(comment_id)
		{
			if(!confirm("Skutečně chcete daný komentář odstanit?!"))
			{
				return;
			}

			let obj = {
				comment_id,
				data_type:'delete-comment'
			};

			comment.send_data(obj);

		},

		edit: function(comment_id)
		{
			let row_id = 0;
			let found = false;
			for (var i = 0; i < comment.comments.length; i++) {
				
				if(comment.comments[i].id == comment_id)
				{
					row_id = i;
					found = true;
					break;
				}
			}

			if(!found)
			{
				alert("Komentář nenalezen!");
				return;
			}

			document.querySelector("#myform .js-comment-text").value = comment.comments[i].comment;
			document.querySelector("#myform .js-comment-id").value = comment.comments[i].id;

			window.location.href = '<?=ROOT?>/photo/<?=$id ?? 0?>#myform';
			document.querySelector("#myform .js-comment-text").focus();

		},

		send_data: function(obj){

			if(comment.commenting)
				return;

			let xhr = new XMLHttpRequest();
			comment.commenting = true;

			xhr.addEventListener('readystatechange', function(){

				if(xhr.readyState == 4)
				{
					comment.commenting = false;
					alert("Komentář úspěšně odstaněn!");
					window.location.reload();
				}
			});

			let myform = new FormData();
			for(key in obj)
			{
				myform.append(key,obj[key]);
			}

			xhr.open('post','<?=ROOT?>/ajax');
			xhr.send(myform);
		},

	};

	console.log(comment.comments);
</script>