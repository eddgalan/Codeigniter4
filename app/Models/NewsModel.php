<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table = 'news';
    protected $allowedFields = ['title', 'slug', 'body'];
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $validationRules = [];
    protected $useSoftDeletes = true;
    protected $allowCallbacks = true;
    protected $beforeInsert = ['generateSlug'];
    protected $beforeUpdate   = ['generateSlug'];

    public function generateSlug(Array $data)
    {
        $data['data']['slug'] = url_title($data['data']['title'], '-', true);
        return $data;
    }

    public function getNews($slug = false)
    {
        if ($slug === false) {
            return $this->findAll();
        }
        return $this->where(['slug' => $slug])->first();
    }

}