<?php 

namespace Controller;

defined('ROOTPATH') OR exit('Access Denied!');
use \Model\Image;
use \Model\Comment;

/**
 * Photo class
 */
class Photo
{
	use MainController;

	public function index($id = null)
	{
		$photo = new \Model\Photo;
		$req = new \Core\Request;
		$data['ses'] = $ses = new \Core\Session;

		$query = "select c.id as category_id, c.title, p.*, u.username 
                    from photos p 
                    join users u on u.id = p.user_id
                    join categories c on c.id = p.category_id
                    where c.id = :id";
		$data['rows'] = $row = $photo->get_rows($query,['id'=>$id]);
		if($data['rows']){
			$data['title'] = ucfirst($data['rows'][0]->title);
            $data['categoryId'] = ucfirst($data['rows'][0]->category_id);
		}

		$comment = new Comment;
		if($req->posted() && $row && $ses->is_logged_in())
		{
			$post_data = $req->post();

			if($comment->validate($post_data))
			{
				//chec if this is an edit
				if(!empty($post_data['comment_id']))
				{
					$comment_row = $comment->first(['id'=>$post_data['comment_id'],'user_id'=>user('id')]);
					
					if($comment_row)
					{
						$post_data['date_updated'] = date("Y-m-d H:i:s");
						$comment->update($comment_row->id, $post_data);
					}
				}else{

					$post_data['user_id'] = user('id');
					$post_data['post_id'] = $id;
					$post_data['date_created'] = date("Y-m-d H:i:s");
					$comment->insert($post_data);
				}
				
				redirect('photo/'.$id);
			}

			$data['errors'] = $comment->errors;
			
		}

		$limit = 10;
		$data['pager'] = new \Core\Pager($limit);
		$offset = $data['pager']->offset;

		$comment->limit = $limit;
		$comment->offset = $offset;
		$comment->order_type = 'asc';

		$data['comments'] = $comment->where(['post_id'=>$id]);
		$data['comments'] = $comment->getUserDetails($data['comments']);

		$data['image'] = new Image;
		$data['id'] = $id;

		$this->view('photo',$data);
	}

}
