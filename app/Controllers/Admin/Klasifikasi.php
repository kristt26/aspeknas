<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Klasifikasi extends BaseController
{
    use ResponseTrait;
    protected $klasifikasi;
    public function __construct() {
        $this->klasifikasi = new \App\Models\KlasifikasiModel();
    }
    public function index()
    {
        return view('admin/klasifikasi');
    }

    public function read()
    {
        $klasifikasi = $this->klasifikasi->findAll();
        return $this->respond($klasifikasi);
    }
    
    public function readById($id = null)
    {
        $klasifikasi = $this->klasifikasi->first($id);
        return $this->respond($klasifikasi);
    }

    public function post()
    {
        $data = $this->request->getJSON();
        try {
            if($this->klasifikasi->insert($data)){
                $data->id = $this->klasifikasi->getInsertID();
                return $this->respondCreated($data);
            }
            throw new \Exception("Data gagal menyimpan", 1);
            
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
    public function put()
    {
        $data = $this->request->getJSON();
        try {
            if($this->klasifikasi->update($data->id, $data)){
                return $this->respondUpdated(true);
            }
            throw new \Exception("Data gagal mengubah", 1);
            
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
    public function delete($id = null)
    {
        try {
            if($this->klasifikasi->delete($id)){
                return $this->respondDeleted(true);
            }
            throw new \Exception("Data gagal menghapus", 1);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
}
