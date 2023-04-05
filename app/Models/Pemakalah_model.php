<?php

namespace App\Models;

use CodeIgniter\Model;

class Pemakalah_model extends Model
{
    protected $table = 'pemakalah';
    protected $primaryKey = 'id_pemakalah';
    protected $returnType = 'array';
    protected $useTimestamp = true;
    protected $allowedFields = ['nidn_pem', 'status_pemakalah', 'judul_makalah', 'nama_forum', 'institusi_penyelenggara', 'tgl_mulai_pelaksanaan', 'tgl_akhir_pelaksanaan', 'tempat_pelaksanaan', 'kd_sts_berkas_makalah', 'keterangan_invalid', 'tahun_pemakalah', 'tingkat'];
}
