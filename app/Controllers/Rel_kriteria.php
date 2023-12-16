<?php

namespace App\Controllers;
use App\Models\KriteriaModel;
use App\Models\RelAlternatifModel;
use App\Models\RelKriteriaModel;
use CodeIgniter\Model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Rel_kriteria extends BaseController
{
	

	public function index()
	{
		$data['title'] = 'Halaman Data Kriteria';
		$kriteria = new KriteriaModel();
		$data['rows_kriteria'] = $kriteria->findAll();
		$data['nilai'] = $this->get_nilai_option();
		$data['rel_kriteria'] = $this->get_rel_kriteria();
		
		echo view('rel_kriteria/view',$data);
	}


	public function get_rel_kriteria(){
		$rel = new RelKriteriaModel();
		$rows = $rel->get_rel_all_kriteria();

		$data = array();
		foreach ($rows as $row) {
			$data[$row['ID1']][$row['ID2']]=$row['nilai'];
		}
		

		return $data;
	}




	public function get_nilai_option()
	{
		$a = "";
		$nilai = array(
			'1' => 'Sama penting dengan',
			'2' => 'Mendekati sedikit lebih penting dari',
			'3' => 'Sedikit lebih penting dari',
			'4' => 'Mendekati lebih penting dari',
			'5' => 'Lebih penting dari',
			'6' => 'Mendekati sangat penting dari',
			'7' => 'Sangat penting dari',
			'8' => 'Mendekati mutlak dari',
			'9' => 'Mutlak sangat penting dari',
		);
		foreach ($nilai as $key => $value) {
			$a .= "<option value='$key'>$key - $value</option>";
		}
		return $a;
	}

	public function update()
	{
		$session = session();
		if($this->request->getPost('kode1')!=$this->request->getPost('kode2')){
			$dwl = new RelKriteriaModel();
			$row = $dwl->get_rel_kriteria($this->request->getPost('kode1'),$this->request->getPost('kode2'));
			$row1 = $dwl->get_rel_kriteria($this->request->getPost('kode2'),$this->request->getPost('kode1'));
			$data_insert = new RelKriteriaModel();
			$data_insert->update($row['0']['ID'], [
				"nilai" => $this->request->getPost('nilai')
			]);
			$balik = 1/$this->request->getPost('nilai');
			$data_insert->update($row1['0']['ID'], [
				"nilai" => $balik
			]);
			return redirect()->to(base_url().'rel_kriteria/view');
		}else{
			$session->setFlashdata('msg', 'Kriteria yang sama Wajib Bernilai 1');
			return redirect()->to(base_url().'rel_kriteria/view');
		}



	}
}