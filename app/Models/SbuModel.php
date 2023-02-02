<?php

namespace App\Models;

use CodeIgniter\Model;

class SbuModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'sbu';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['akta', 'npwp_perusahaan', 'nomor_induk', 'ktp_pengurus', 'npwp_pengurus', 'foto', 'skk', 'ktp_tenaga_kerja', 'npwp_tenaga_kerja', 'ijazah_tenaga_kerja', 'akuntan', 'pengajuan_id'];
}
