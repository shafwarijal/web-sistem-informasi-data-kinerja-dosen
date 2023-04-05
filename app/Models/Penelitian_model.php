<?php

namespace App\Models;

use CodeIgniter\Model;

class Penelitian_model extends Model
{
	protected $table = 'penelitian';
	protected $primaryKey = 'id_penelitian';
	protected $returnType = 'array';
	protected $useTimestamp = true;
	protected $allowedFields = ['nidn_ketua',  'judul_penelitian', 'nama_skema', 'jumlah_dana', 'tahun_penelitian', 'bidang_penelitian', 'bidang_penelitian_lain', 'tujuan_sosial_ekonomi', 'tujuan_sosial_ekonomi_lain'];
}
