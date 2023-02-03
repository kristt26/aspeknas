<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use Midtrans\Snap;

class Pengajuan extends BaseController
{
    use ResponseTrait;
    protected $midtrans;
    protected $pengajuan;
    protected $sub_pengajuan;
    protected $pembayaran;
    protected $sbu;
    protected $kta;
    protected $klasifikasi;
    protected $subKlasifikasi;
    protected $conn;
    protected $decode;
    public function __construct()
    {
        $this->pengajuan = new \App\Models\PengajuanModel();
        $this->sub_pengajuan = new \App\Models\SubPengajuanModel();
        $this->pembayaran = new \App\Models\PembayaranModel();
        $this->sbu = new \App\Models\SbuModel();
        $this->kta = new \App\Models\KtaModel();
        $this->klasifikasi = new \App\Models\KlasifikasiModel();
        $this->subKlasifikasi = new \App\Models\SubKlasifikasiModel();
        $this->midtrans = new Snap();
        \Midtrans\Config::$serverKey = "SB-Mid-server-0yZKfLleO5WlljNFyBhCC_ql";
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        $this->conn = \Config\Database::connect();
        $this->decode = new \App\Libraries\Decode();
    }

    public function index()
    {
        return view('pengajuan/index');
    }

    public function tambah()
    {
        return view('pengajuan/tambah');
    }

    public function read()
    {
        $pengajuan = $this->pengajuan->asObject()->select('pengajuan.*, perusahaan.perusahaan')
        ->join('user', 'user.id=pengajuan.user_id', 'LEFT')
        ->join('perusahaan', 'user.id=perusahaan.user_id', 'LEFT')
        ->where('user.id', session()->get('uid'))->findAll();
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

    public function get()
    {
        $klasifikasi = $this->klasifikasi->asObject()->findAll();
        foreach ($klasifikasi as $key => $value) {
            $value->subKlasifikasi = $this->subKlasifikasi->where('klasifikasi_id', $value->id)->findAll();
        }
        return $this->respond($klasifikasi);
    }



    public function readById($id = null)
    {
        // $klasifikasi = $this->pengajuan->first($iPengajuanModel();
        // $klasifikasi = $this->pengajuan->first($iPengajuanModel();
        // return $this->respond($klasifikasi);
    }

    public function post()
    {
        $data = $this->request->getJSON();
        try {
            $this->conn->transBegin();
            $this->pengajuan->insert(['user_id'=>session()->get('uid'), 'klasifikasi_id'=>$data->klasifikasi_id]);
            $data->id = $this->pengajuan->getInsertID();
            foreach ($data->subKlasifikasi as $key => $sub) {
                $this->sub_pengajuan->insert(['pengajuan_id'=>$data->id, 'sub_klasifikasi_id'=>$sub->id]);
                $sub->id = $this->sub_pengajuan->getInsertID();
            }
            $item = [
                'akte'=>$this->decode->decodebase64($data->persyaratan->akta->base64),
                'akuntan'=>$this->decode->decodebase64($data->persyaratan->akuntan->base64),
                'foto'=>$this->decode->decodebase64($data->persyaratan->foto->base64),
                'ktp_pengurus'=>$this->decode->decodebase64($data->persyaratan->ktp_pengurus->base64),
                'ktp_tenaga_kerja'=>$this->decode->decodebase64($data->persyaratan->ktp_tenaga_kerja->base64),
                'nomor_induk'=>$this->decode->decodebase64($data->persyaratan->nomor_induk->base64),
                'npwp_pengurus'=>$this->decode->decodebase64($data->persyaratan->npwp_pengurus->base64),
                'npwp_perusahaan'=>$this->decode->decodebase64($data->persyaratan->npwp_perusahaan->base64),
                'npwp_tenaga_kerja'=>$this->decode->decodebase64($data->persyaratan->npwp_tenaga_kerja->base64),
                'skk'=>$this->decode->decodebase64($data->persyaratan->skk->base64),
                'pengajuan_id'=>$data->id,
            ];
            $this->sbu->insert($item);
            $data->persyaratan->id = $this->sbu->getInsertID();
            if($this->conn->transStatus()){
                $this->conn->transCommit();
                return $this->respond($data);
            }
            throw new \Exception("Data gagal menyimpan", 1);
        } catch (\Throwable $th) {
            return  $this->fail($th->getMessage());
        }
    }
    public function put()
    {
        // $data = $this->request->getJSON();
        // try {
        //     if ($this->pengajuan->update($data->id, $data)PengajuanModel();
        //     if ($this->pengajuan->update($data->id, $data)PengajuanModel();
        //         return $this->respondUpdated(true);
        //     }
        //     throw new \Exception("Data gagal mengubah", 1);
        // } catch (\Throwable $th) {
        //     return $this->fail($th->getMessage());
        // }
    }
    public function deleted($id = null)
    {
        // try {
        //     if ($this->pengajuan->delete($id)PengajuanModel();
        //     if ($this->pengajuan->delete($id)PengajuanModel();
        //         return $this->respondDeleted(true);
        //     }
        //     throw new \Exception("Data gagal menghapus", 1);
        // } catch (\Throwable $th) {
        //     return $this->fail($th->getMessage());
        // }
    }
}
