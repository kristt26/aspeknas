<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class User extends BaseController
{
    use ResponseTrait;
    protected $conn;
    protected $user;
    public function __construct() {
        $this->user = new \App\Models\UserModel();
        $this->conn = \Config\Database::connect();
    }
    public function index()
    {
        return view('admin/manajemen_user');
    }

    public function read()
    {
        $data = $this->user->select('user.username, perusahaan.*')->join('perusahaan', 'perusahaan.user_id=user.id', 'LEFT')->where('user.username != "Administrator"')->findAll();
        return $this->respond($data);
    }
    
    public function readById($id = null)
    {
        
    }

    public function post()
    {
        
    }
    public function put()
    {
        
    }
    public function deleted($id = null)
    {
        
    }
}
