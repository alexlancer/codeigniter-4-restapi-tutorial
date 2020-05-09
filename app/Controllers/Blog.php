<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Blog extends ResourceController
{
	protected $modelName = 'App\Models\BlogModel';
	protected $format = 'json';

	public function index(){
		$posts = $this->model->findAll();
		return $this->respond($posts);
	}

	public function create(){
		helper(['form']);

		$rules = [
			'title' => 'required|min_length[6]',
			'description' => 'required',
			'featured_image' => 'uploaded[featured_image]|max_size[featured_image, 1024]|is_image[featured_image]'
		];

		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{

			//Get the file
			$file = $this->request->getFile('featured_image');
			if(! $file->isValid())
				return $this->fail($file->getErrorString());

			$file->move('./assets/uploads');

			$data = [
				'post_title' => $this->request->getVar('title'),
				'post_description' => $this->request->getVar('description'),
				'post_featured_image' => $file->getName()
			];

			$post_id = $this->model->insert($data);
			$data['post_id'] = $post_id;
			return $this->respondCreated($data);
		}
	}

	public function show($id = null){
		$data = $this->model->find($id);
		return $this->respond($data);
	}

	public function update($id = null){
		helper(['form', 'array']);

		$rules = [
			'title' => 'required|min_length[6]',
			'description' => 'required',
		];


		$fileName = dot_array_search('featured_image.name', $_FILES);

		if($fileName != ''){
			$img = ['featured_images' => 'uploaded[featured_image]|max_size[featured_image, 1024]|is_image[featured_image]'];
			$rules = array_merge($rules, $img);
		}



		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{
			//$input = $this->request->getRawInput();



			$data = [
				'post_id' => $id,
				'post_title' => $this->request->getVar('title'),
				'post_description' => $this->request->getVar('description'),
			];

			if($fileName != ''){

				$file = $this->request->getFile('featured_image');
				if(! $file->isValid())
					return $this->fail($file->getErrorString());

				$file->move('./assets/uploads');
				$data['post_featured_image'] = $file->getName();
			}

			$this->model->save($data);
			return $this->respond($data);
		}

	}

	public function delete($id = null){
		$data = $this->model->find($id);
		if($data){
			$this->model->delete($id);
			return $this->respondDeleted($data);
		}else{
			return $this->failNotFound('Item not found');
		}
	}



	//--------------------------------------------------------------------

}
