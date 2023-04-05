<?php

namespace App\Models;

use CodeIgniter\Model;

class Buku_Ajar_model extends Model
{
    protected $table = 'buku_ajar';
    protected $primaryKey = 'id_buku_ajar';
    protected $returnType = 'array';
    protected $useTimestamp = true;
    protected $allowedFields = ['nidn_buku_ajar', '	nama_lengkap', 'judul_buku_ajar', 'isbn', 'jumlah_halaman', 'penerbit', 'tahun_buku_ajar', 'keterangan_invalid'];
}
