<?php

namespace App\Models;

use CodeIgniter\Model;

class SubKlasifikasiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'sub_klasifikasi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_kbli', 'judul_kbli','kode_sub', 'ruang_lingkup','skala_usaha','tingkat_resiko'];
}
