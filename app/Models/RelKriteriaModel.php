<?php

namespace App\Models;

use CodeIgniter\Model;

class RelKriteriaModel extends Model
{
    protected $table      = 'tb_rel_kriteria';
    protected $primaryKey = 'ID';

    // protected $useAutoIncrement = true;
    // protected $allowedFields = ['asik'];
     protected $allowedFields = ['ID1','ID2','nilai'];

     public function get_rel_kriteria($kode1,$kode2){
     	return $this->db->table('tb_rel_kriteria')
		->where('tb_rel_kriteria.ID1',$kode1)
		->where('tb_rel_kriteria.ID2',$kode2)
		->get()->getResultArray();
     }

      public function get_rel_all_kriteria(){
     	return $this->db->table('tb_rel_kriteria')
		->get()->getResultArray();
     }
}