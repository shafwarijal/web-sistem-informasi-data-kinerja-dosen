<?php

namespace App\Models;

use CodeIgniter\Model;

class Hki_model extends Model
{
    protected $table = 'hki';
    protected $primaryKey = 'id_hki';
    protected $returnType = 'array';
    protected $useTimestamp = true;
    protected $allowedFields = ['nidn_hki', 'nama_lengkap', 'judul_hki', 'jenis_hki', 'no_pendaftaran', 'status_hki', 'no_hki', 'kd_sks_berkas_hki', 'tahun_hki', 'keterangan_invalid'];
}
