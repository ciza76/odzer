<?php $image = new \Model\Image;?>

<div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?=get_image($image->getThumbnail('assets/images/image1.jpg',1000,550))?>" class="d-block w-100" alt="..." style="height:550px;object-fit: cover;">
    </div>
    <div class="carousel-item">
      <img src="<?=get_image($image->getThumbnail('assets/images/new_image2.jpg',1000,550))?>" class="d-block w-100" alt="..." style="height:550px;object-fit: cover;">
    </div>
    <div class="carousel-item">
      <img src="<?=get_image($image->getThumbnail('assets/images/new_image3.jpg',1000,550))?>" class="d-block w-100" alt="..." style="height:550px;object-fit: cover;">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>