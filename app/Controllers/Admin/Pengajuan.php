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
    protected $klasifikasi;
    protected $subKlasifikasi;
    protected $conn;
    protected $decode;
    public function __construct() {
        $this->pengajuan = new \App\Models\PengajuanModel();
        $this->sub_pengajuan = new \App\Models\SubPengajuanModel();
        $this->pembayaran = new \App\Models\PembayaranModel();
        $this->sbu = new \App\Models\SbuModel();
        $this->kta = new \App\Models\KtaModel();
        $this->klasifikasi = new \App\Models\KlasifikasiModel();
        $this->subKlasifikasi = new \App\Models\SubKlasifikasiModel();
        $this->conn = \Config\Database::connect();
        $this->decode = new \App\Libraries\Decode();
    }
    public function index()
    {
        return view('admin/pengajuan');
    }

    public function read()
    {
        $pengajuan = $this->pengajuan->asObject()->select('pengajuan.*, perusahaan.perusahaan')
        ->join('user', 'user.id=pengajuan.user_id', 'LEFT')
        ->join('perusahaan', 'user.id=perusahaan.user_id', 'LEFT')
        ->findAll();
        foreach ($pengajuan as $key => $value) {
            $value->subPengajuan = $this->sub_pengajuan->where('pengajuan_id', $value->id)->findAll();
            $value->pembayaran = $this->pembayaran->where('pengajuan_id', $value->id)->first();
            $value->pembayaran['detail'] = unserialize($value->pembayaran['detail']);
            $value->persyaratan = $this->sbu->where('pengajuan_id', $value->id)->first();
        }
        $klasifikasi = $this->klasifikasi->asObject()->findAll();
        foreach ($klasifikasi as $key => $value) {
            $value->subKlasifikasi = $this->subKlasifikasi->where('klasifikasi_id', $value->id)->findAll();
        }
        $data = [
            'pengajuan' => $pengajuan,
            'klasifikasi' => $klasifikasi
        ];
        return $this->respond($data);
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
            if($this->pengajuan->update($data->id, ['status'=>$data->status])){
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
            if($this->klasifikasi->delete($id)){
                return $this->respondDeleted(true);
            }
            throw new \Exception("Data gagal menghapus", 1);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
}
