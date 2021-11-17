<?php namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model{
    protected $table = 'posts';
    protected $primary = 'id';
    protected $allowedFields = ['title', 'slug', 'body' ];

    public function getPosts($slug = null){
        if(!$slug){
            return $this->findAll();
        }

        return $this->asArray()
                    ->where(['slug' => $slug])
                    ->first();
    }


    
//     function delete($id)
//   {
//     $this->db->where("id", $id);
//     $this->db->delete("posts");
//     return true;
//   }
    
} 