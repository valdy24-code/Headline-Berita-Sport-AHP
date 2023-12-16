<?php

namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model
{
    protected $table      = 'tb_kriteria';
    protected $primaryKey = 'kode_kriteria';

    // protected $useAutoIncrement = true;
    // protected $allowedFields = ['asik'];
     protected $allowedFields = ['kode_kriteria','nama_kriteria'];
}