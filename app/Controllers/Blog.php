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

	//--------------------------------------------------------------------

}
