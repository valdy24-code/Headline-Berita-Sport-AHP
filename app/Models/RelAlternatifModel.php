<?php

namespace App\Models;

use CodeIgniter\Model;

class RelAlternatifModel extends Model
{
    protected $table      = 'tb_rel_alternatif';
    protected $primaryKey = 'ID';

    // protected $useAutoIncrement = true;
    // protected $allowedFields = ['asik'];
     protected $allowedFields = ['kode1','kode2','kode_kriteria','nilai'];

     public function get_rel_alternatif($kode){
     	return $this->db->table('tb_rel_alternatif')
		->join('tb_kriteria','tb_kriteria.kode_kriteria=tb_rel_alternatif.kode_kriteria')
		->where('tb_kriteria.kode_kriteria',$kode)
		->get()->getResultArray();
     }

    

      public function get_rel_all_alternatif(){
        return $this->db->table('tb_rel_alternatif')
        ->join('tb_kriteria','tb_kriteria.kode_kriteria=tb_rel_alternatif.kode_kriteria')
        ->get()->getResultArray();
     }

     public function get_nilai_rel($kode1,$kode2,$kode_kriteria){
     	return $this->db->table('tb_rel_alternatif')
		->join('tb_kriteria','tb_kriteria.kode_kriteria=tb_rel_alternatif.kode_kriteria')
		->where('tb_kriteria.kode_kriteria',$kode_kriteria)
		->where('tb_rel_alternatif.kode1',$kode1)
		->where('tb_rel_alternatif.kode2',$kode2)
		->get()->getResultArray();
     }


}