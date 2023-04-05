<?php

namespace App\Models;

use CodeIgniter\Model;

class Jurnal_model extends Model
{
    protected $table = 'jurnal';
    protected $primaryKey = 'id_jurnal';
    protected $returnType = 'array';
    protected $useTimestamp = true;
    protected $allowedFields = ['judul_jurnal', 'nama_jurnal', 'nama_personil', 'issn', 'volume', 'nomor1', 'halaman_awal', 'halaman_akhir', 'url', 'tahun_jurnal', 'tingkat', 'status_akreditasi'];
}
