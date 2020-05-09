<?php namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model{
  protected $table = 'blog';
  protected $primaryKey = 'post_id';
  protected $allowedFields = ['post_title','post_description','post_featured_image'];
}
