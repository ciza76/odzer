<?php 

namespace Controller;

defined('ROOTPATH') OR exit('Access Denied!');

use \Model\Comment;
use \Model\Photo;
use \Model\Like;
use \Model\Image;

/**
 * home class
 */
class Home
{
	use MainController;

	public function index()
	{
		$data['title'] = "Home";

		$photo = new Photo;

		$photo->limit = 12;
		$data['rows'] = $photo->findAll();
		$data['image'] = new Image;
		$data['comment'] = new Comment;
		$data['like'] = new Like;

		$this->view('home',$data);
	}

}
