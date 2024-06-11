<?php $this->view('includes/header',$data); ?>

<div class="mx-auto col-md-4 bg-light shadow m-4 p-4 border ">
	
	<?php if(message()):?>
		<div class="alert alert-success text-center"><?=message('',true)?></div>
	<?php endif?>

	<h1>Login</h1>
	<form method="post">
		
		<input class="my-3 form-control" value="<?=old_value('email')?>" name="email" placeHolder="Email">
		<div><small class="text-danger"><?=$user->getError('email')?></small></div>
		<input type="password" class="my-3 form-control" value="<?=old_value('password')?>" name="password" placeHolder="Password">
		<div><small class="text-danger"><?=$user->getError('password')?></small></div>
		<button class="my-3 btn btn-primary">Přihlásit se</button>
	</form>
</div>
<?php $this->view('includes/footer',$data); ?>