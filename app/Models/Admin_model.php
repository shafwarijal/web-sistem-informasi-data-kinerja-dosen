<?php

namespace App\Models;

use CodeIgniter\Model;

class Admin_model extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    protected $returnType    = 'array';
    protected $useTimestamp = true;
    protected $allowedFields = ['nama_admin', 'password', 'username'];
}
