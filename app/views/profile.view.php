<?php $this->view('includes/header',$data); ?>

	<div class="p-4 text-center"><h3>Uživatelský profil</h3></div>
	<div class="row p-4 justify-content-center">

		<?php if(!empty($row)):?>
			<div class="col-md-6 text-center bg-light">


				<table class="table table-striped table-hover text-start">
						<tr><th>Uživatelské ID</th><td><?=$row->id?></td></tr>
						<tr><th>Uživatelské jméno</th><td><?=esc($row->username)?></td></tr>
						<tr><th>Email</th><td><?=esc($row->email)?></td></tr>
						<tr><th>Role</th><td><?=esc($row->role)?></td></tr>
						<tr><th>Datum vytvoření profilu</th><td><?=get_date($row->date_created)?></td></tr>
				</table>
 
				<br>

				<?php if($ses->is_logged_in() && $ses->user('id') == $row->id):?>
					<a href="<?=ROOT?>/profile/edit/<?=$row->id?>">
						Upravit Profil
					</a>
					|
					<a href="<?=ROOT?>/profile/delete/<?=$row->id?>">
						Odstranit Profil
					</a>
				<?php endif?>
			</div>
		<?php else:?>
			<div class="p-2 text-center">Omlouváme se. Funkcionalita nebyla správcem dodělána!</div>
		<?php endif?>
		
	</div>
<?php $this->view('includes/footer',$data); ?>