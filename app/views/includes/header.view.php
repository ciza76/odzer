<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title ?? 'Unknown'?> | <?=APP_NAME?></title>
	<link rel="stylesheet" type="text/css" href="<?=ROOT?>/assets/css/bootstrap.min.css">
</head>
<body>
	<?php

		$ses = new \Core\Session;

	?>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <div class="container-fluid">
	    <a class="navbar-brand" href="<?=ROOT?>"><?=APP_NAME?></a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
	        <li class="nav-item">
	          <a class="nav-link active" aria-current="page" href="<?=ROOT?>">Home</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="<?=ROOT?>/photos">Fotky</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="<?=ROOT?>/upload">Nahrát Fotografie</a>
	        </li>
	        
	        <?php if($ses->is_logged_in()):?>
		        <li class="nav-item dropdown">
		          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
		            Hi, <?=$ses->user('username')?>
		          </a>
		          <ul class="dropdown-menu">
		            <li><a class="dropdown-item" href="<?=ROOT?>/profile">Profil</a></li>

                      <!--<?php if($ses->user('role') == 'admin'):?>
			            <li><a class="dropdown-item" href="<?=ROOT?>/admin">Admin</a></li>
			        <?php endif?>
			        -->
		            <li><hr class="dropdown-divider"></li>
		            <li><a class="dropdown-item" href="<?=ROOT?>/logout">Odhlásit</a></li>
		          </ul>
		        </li>
		    <?php else:?>
		    	<li class="nav-item">
		          <a class="nav-link" href="<?=ROOT?>/login">Login</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="<?=ROOT?>/signup">Signup</a>
		        </li>
		        
		    <?php endif?>
 
	      </ul>
            <!--
                <form action="<?=ROOT?>/search" method="get" class="d-flex" role="search">
                <input name="find" value="<?=$_GET['find'] ?? ''?>" class="form-control me-2" type="search" placeholder="Search photos" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                -->


	    </div>
	  </div>
	</nav>
