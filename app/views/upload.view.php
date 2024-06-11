<?php $this->view('includes/header',$data); ?>

	<div class="mx-auto col-md-4 bg-light shadow m-4 p-4 border ">
		<h3><?=$title?></h3>
		
		<?php if($mode == 'new' || (($mode == 'edit' || $mode == 'delete') && $row)):?>

			<?php if($mode == 'delete'):?>
				<div class="alert alert-danger text-center">Skutečně chcete danou fotografii Odstanit?!</div>
			<?php endif?>

			<form onsubmit="submitForm(event)" method="post" enctype="multipart/form-data">
				
				<input class="title form-control my-3" value="<?=old_value('title',$row->title ?? '')?>" name="title" placeHolder="Název fotografie">
				<div><small class="text-danger"><?=$photo->getError('title')?></small></div>

				<label class="d-block">

					<?php if($mode != 'delete'):?>
						<div>Lze nahávat maximálně 4 fotografie najednou.</div>
						<div class="input-group mb-3">
					  	<input multiple onchange="display_image(this.files)" name="image" type="file" class="images form-control" id="inputGroupFile02">
					  	<label class="input-group-text" for="inputGroupFile02">Vyberte Fotografie</label>
						</div>
						<div><small class="text-danger"><?=$photo->getError('image')?></small></div>
					<?php endif?>

					<div class="js-image-preview-holder text-center" style="cursor: pointer;">
						<img src="<?=get_image($row->image ?? '')?>" class="img-thumbnail m-1" style="max-width: 220px;">
					</div>
				</label>

				<div class="progress my-1 d-none">
					<div class="progress-bar" style="width:50%">Saving 50%</div>
				</div>
				<?php if($mode == 'delete'):?>
					<button class="btn btn-danger my-3">Delete</button>
				<?php else:?>
					<button class="btn btn-primary my-3">Save</button>
				<?php endif?>
			</form>
		<?php else:?>
			<div class="p-2 text-center">Image not found!</div>
		<?php endif?>

	</div>
	
	<script type="text/javascript">
		
		function display_image(files)
		{
			let holder = document.querySelector(".js-image-preview-holder");
			holder.innerHTML = "";
			for (var i = 0; i < files.length; i++) {
				
				let allowed = ['image/jpeg','image/jpg','image/png','image/webp'];
				if(!allowed.includes(files[i].type))
				{
					alert("File: "+ files[i].name +" not supported! The only file types supported are: " + allowed.toString().replaceAll("image/",""));
					continue;
				}

				let img = document.createElement('img');
				img.src = URL.createObjectURL(files[i]);
				img.setAttribute('class',"img-thumbnail m-1");
				img.setAttribute('style',"max-width:220px");

				holder.appendChild(img);
			}
		}

		var uploading = false;

		function submitForm(e)
		{
			e.preventDefault();
			if(uploading)
			{
				alert("Please wait for the upload to complete!");
				return;
			}

			uploading = true;

			let myform = new FormData();

			document.querySelector(".progress-bar").innerHTML = "0%";
			document.querySelector(".progress-bar").style.width = "0%";
			document.querySelector(".progress").classList.remove('d-none');

			myform.append('title',document.querySelector("form .title").value);
            let files = [];
            if (document.querySelectorAll("form .images").length > 0) {
                files = document.querySelector("form .images").files;
            }
			let allowed = ['image/jpeg','image/jpg','image/png','image/webp'];

			let z = 0;
			for (var i = 0; i < files.length; i++) {
				
				if(z > 4 || !allowed.includes(files[i].type))
				{
					continue;
				}

				let key = z > 0 ? z : '';
				z++;
				myform.append('image'+key,files[i]);
			}

			var xhr = new XMLHttpRequest();
			xhr.addEventListener('readystatechange',function(){

				if(xhr.readyState == 4)
				{
					uploading = false;
					if(xhr.responseText == '[]'){
						alert("Upload complete!");
						window.location.reload();
					}else{
						console.log(xhr.responseText);
					}
				}
			});

			xhr.upload.addEventListener('progress',function(e){

				let percent = Math.round((e.loaded / e.total) * 100);
				document.querySelector(".progress-bar").style.width = percent + '%';
				document.querySelector(".progress-bar").innerHTML = 'Saving ' + percent + '%';
			});
			
			xhr.open('post','',true);
			xhr.send(myform);
		}

	</script>
<?php $this->view('includes/footer',$data); ?>