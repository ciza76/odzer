<?php 

namespace Controller;

defined('ROOTPATH') OR exit('Access Denied!');
use \Model\Photo;
use \Core\Request;
use \Core\Session;

/**
 * Upload class
 */
class Upload
{
	use MainController;

	public function index()
	{
		$data['title'] = "Upload photo";
		$data['mode'] = 'new';

		$req = new Request;
		$ses = new Session;
		$photo = new Photo;

		if(!$ses->is_logged_in()){

			message("Pro nahávání fotografií je nutné se přihlásit!");
			redirect('login');
		}

		if($req->posted())
		{
			$post_data = $req->post();
			if($photo->validate($post_data))
			{
                if(!$this->insertUpdateMultiple($post_data, $ses, $req, $photo)){
					$photo->errors['image'] = "An image is required";
				}
			}

			$data['errors'] = $photo->errors;

			echo json_encode($data['errors']);
			die;
		}

		$data['photo'] = $photo;
		$this->view('upload',$data);
	}

	public function edit($id = null)
	{
		$data['title'] = "Edit photo";
		$data['mode'] = 'edit';

		$req = new Request;
		$ses = new Session;
		$photo = new Photo;

		if(!$ses->is_logged_in()){

			message("Pro úpravu fotografií je nutné se přihlásit!");
			redirect('login');
		}

        // Get user ID and photo details

		$user_id = $ses->user('id');
		//$data['row'] = $row = $photo->first(['category_id'=>$id,'user_id'=>$user_id]);
        $qP = sprintf("select p.*, c.title from photos p left join categories c on c.id=p.category_id where p.category_id = %d && p.user_id = %d", $id, $user_id);
        $rows = $photo->query($qP);
        $data['row'] = $rows[0];

        // Check if the form is submitted and photo exists

		if($req->posted() && $rows)
		{
            $post_data = $req->post();
            // Validate the post data
			if($photo->validate($post_data))
			{
                if(!$this->insertUpdateMultiple($post_data, $ses, $req, $photo, (int)$id)){
                    $photo->errors['image'] = "An image is required";
                }
                redirect('photos');
			}

			$data['errors'] = $photo->errors;
		}

		$data['photo'] = $photo;

		$this->view('upload',$data);

	}


	public function delete($id = null)
	{
		$data['title'] = "Delete photo";
		$data['mode'] = 'delete';

		$req = new Request;
		$ses = new Session;
		$photo = new Photo;

        // Check if user is logged in
		if(!$ses->is_logged_in()){

			message("Pro smazávání fotografií je nutné se přihlásit!");
			redirect('login');
		}

        // Get user ID and photo details
		$user_id = $ses->user('id');
        $qP = sprintf("select p.*, c.title from photos p left join categories c on c.id=p.category_id where p.category_id = %d && p.user_id = %d", $id, $user_id);
        $rows = $photo->query($qP);
		$data['row'] = $rows[0];
        $data['title'] = ucfirst($data['row']->title);

        // Check if the form is submitted and photo exists
		if($req->posted() && $rows)
		{
            foreach($rows as $row) {
                $photo->delete($row->id);
                if(file_exists($row->image))
                    unlink($row->image);
            }
            $photo->query(sprintf("delete from categories where id = %d", $id));
			redirect('photos');
		}

		$data['photo'] = $photo;

		$this->view('upload',$data);

	}

    private function insertUpdateMultiple($post_data, $ses, $req, Photo $photo, $categoryId = null)
    {
        $post_data['date_created'] = date("Y-m-d H:i:s");
        $post_data['user_id'] = $ses->user('id');
        $post_data['image'] = [];

        $files = $req->files();
        $image_added = false;

        $folder = 'uploads/';
        if(!file_exists($folder))
        {
            mkdir($folder,0777,true);
            file_put_contents($folder.'index.php', "");
        }

        foreach ($files as $key => $file) {

            if(!empty($files[$key]['name']))
            {

                $allowed = ['image/jpeg','image/jpg','image/png','image/webp'];

                if(in_array($files[$key]['type'], $allowed))
                {
                    $image_added = true;
                    $postImage = $folder . time() . $files[$key]['name'];
                    move_uploaded_file($files[$key]['tmp_name'], $postImage);

                    $image = new \Model\Image;
                    $image->resize($postImage,1000);
                    $post_data['image'][] = $postImage;

                }

            }

        }
        $photo->insertUpdateMultiple($post_data, $categoryId);
        return $image_added;
    }



}
