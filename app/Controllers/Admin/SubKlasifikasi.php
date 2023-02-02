<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class SubKlasifikasi extends BaseController
{
    use ResponseTrait;
    protected $sub;
    public function __construct()
    {
        $this->sub = new \App\Models\SubKlasifikasiModel();
    }
    public function index($id = null)
    {
        return view('admin/sub_klasifikasi');
    }

    public function read($id = null)
    {
        $subKlasifikasi = $this->sub->where('klasifikasi_id', $id)->findAll();
        return $this->respond($subKlasifikasi);
    }

    public function readById($id = null)
    {
        $subKlasifikasi = $this->sub->first($id);
        return $this->respond($subKlasifikasi);
    }

    public function post()
    {
        $data = $this->request->getJSON();
        try {
            if ($this->sub->insert($data)) {
                $data->id = $this->sub->getInsertID();
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
            if ($this->sub->update($data->id, $data)) {
                return $this->respondUpdated(true);
            }
            throw new \Exception("Data gagal mengubah", 1);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
    public function deleted($id = null)
    {
        try {
            if ($this->sub->delete($id)) {
                return $this->respondDeleted(true);
            }
            throw new \Exception("Data gagal menghapus", 1);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
}
