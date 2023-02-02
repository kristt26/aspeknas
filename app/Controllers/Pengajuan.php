<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Pengajuan extends BaseController
{
    use ResponseTrait;
    protected $pengajuan;
    protected $sub_pengajuan;
    protected $pembayaran;
    protected $sbu;
    protected $kta;
    public function __construct()
    {
        $this->pengajuan = new \App\Models\PengajuanModel();
        $this->sub_pengajuan = new \App\Models\SubPengajuanModel();
        $this->pembayaran = new \App\Models\PembayaranModel();
        $this->sbu = new \App\Models\SbuModel();
        $this->kta = new \App\Models\KtaModel();
    }

    public function index()
    {
        return view('pengajuan');
    }

    public function read()
    {
        $klasifikasi = $this->pengajuan->fPengajuanModel();
        $klasifikasi = $this->pengajuan->fPengajuanModel();
        return $this->respond($klasifikasi);
    }

    public function readById($id = null)
    {
        $klasifikasi = $this->pengajuan->first($iPengajuanModel();
        $klasifikasi = $this->pengajuan->first($iPengajuanModel();
        return $this->respond($klasifikasi);
    }

    public function post()
    {
        $data = $this->request->getJSON();
        try {
            if ($this->pengajuan->insert($data)PengajuanModel();
            if ($this->pengajuan->insert($data)PengajuanModel();
                $data->id = $this->pengajuan->gPengajuanModel();
                $data->id = $this->pengajuan->gPengajuanModel();
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
            if ($this->pengajuan->update($data->id, $data)PengajuanModel();
            if ($this->pengajuan->update($data->id, $data)PengajuanModel();
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
            if ($this->pengajuan->delete($id)PengajuanModel();
            if ($this->pengajuan->delete($id)PengajuanModel();
                return $this->respondDeleted(true);
            }
            throw new \Exception("Data gagal menghapus", 1);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
}
