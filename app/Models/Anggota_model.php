<?php

namespace App\Models;

use CodeIgniter\Model;

class Anggota_model extends Model
{
    protected $table = 'anggota_penelitian';
    protected $primaryKey = 'id_ap';
    protected $returnType = 'array';
    protected $useTimestamp = true;
    protected $allowedFields = ['id_pen', 'nidn'];
}
