<?php

namespace App\Models;

use CodeIgniter\Model;

class Dosen_model extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'nidn';
    protected $returnType = 'array';
    protected $useTimestamp = true;
    protected $allowedFields = ['nidn', 'nama_dosen', 'nip', 'jekel', 'gelar', 'jabatan_akademik', 'program_studi', 'password'];
}

