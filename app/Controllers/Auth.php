<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Auth extends BaseController
{
    use ResponseTrait;
    protected $user;
    protected $perusahaan;
    protected $conn;

    public function __construct()
    {
        $this->user = new \App\Models\UserModel();
        $this->perusahaan = new \App\Models\PerusahaanModel();
        $this->conn = \Config\Database::connect();
    }
    public function index()
    {
        return view('auth');
    }

    public function register()
    {
        return view('register');
    }

    public function daftar()
    {
        $data = $this->request->getJSON();
        try {
            $this->conn->transBegin();
            $this->user->insert(['username' => $data->username, 'password' => password_hash($data->password, PASSWORD_DEFAULT), 'role' => 'Pendaftar']);
            $data->user_id = $this->user->getInsertID();
            $this->perusahaan->insert($data);
            if ($this->conn->transStatus()) {
                $this->conn->transCommit();
                return $this->respondCreated(true);
            }
            throw new \Exception("Proses pendaftaran gagal", 1);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function login()
    {
        $data = $this->request->getJSON();
        $user = $this->user->where('username', $data->username)->first();
        if ($user) {
            if (password_verify($data->password, $user['password'])) {
                if ($user['role'] == "Admin") {
                    $dataSession = [
                        'uid' => $user->id,
                        'nama' => 'Administrator',
                        'username' => $user['username'],
                        'role' => $user['role'],
                        'isRole' => true
                    ];
                    session()->set($dataSession);
                    return $this->respond($dataSession);
                } else {
                    $perusahaan = $this->perusahaan->where('user_id', $user['id'])->first();
                    $dataSession = [
                        'uid' => $user['id'],
                        'perusahaan_id' => $perusahaan['id'],
                        'nama' => $perusahaan['perusahaan'],
                        'direktur' => $perusahaan['direktur'],
                        'kontak' => $perusahaan['kontak'],
                        'email' => $perusahaan['email'],
                        'username' => $user['username'],
                        'role' => $user['role'],
                        'isRole' => true
                    ];
                    session()->set($dataSession);
                    return $this->respond($dataSession);
                }
            } else {
                return $this->failUnauthorized("Password yang anda masukkan tidak sesuai");
            }
        } else {
            return $this->failNotFound("User tidak ditemukan");
        }
    }
}
