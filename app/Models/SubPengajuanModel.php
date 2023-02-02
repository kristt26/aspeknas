<?php

namespace App\Models;

use CodeIgniter\Model;

class SubPengajuanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'sub_pengajuan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['pengajuan_id', 'sub_klasifikasi_id'];
}
