<?php

namespace App\Controllers;
use App\Models\AlternatifModel;
use App\Models\KriteriaModel;
use App\Models\RelAlternatifModel;
use CodeIgniter\Model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Rel_alternatif extends BaseController
{
	

	public function index()
	{
		$data['title'] = 'Halaman Data Alternatif';
		$kriteria = new KriteriaModel();
		$data['rows_kriteria'] = $kriteria->findAll();
		$alternatif = new AlternatifModel();
		$data['rows_alternatif'] = $alternatif->findAll();
		$data['nilai'] = $this->get_nilai_option();
		if(empty($_GET['kode_kriteria'])){
			$data['rel_alternatif'] = array();
		}else{
			$data['rel_alternatif'] = $this->get_rel_alternatif($_GET['kode_kriteria']);
		}
		echo view('rel_alternatif/view',$data);
	}

	public function get_rel_alternatif($kode){
		$rel = new RelAlternatifModel();
		$rows = $rel->get_rel_alternatif($kode);

		$data = array();
		foreach ($rows as $row) {
			$data[$row['kode1']][$row['kode2']]=$row['nilai'];
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

	public function update($id)
	{
		$session = session();
		if($this->request->getPost('kode1')!=$this->request->getPost('kode2')){
			$dwl = new RelAlternatifModel();
			$row = $dwl->get_nilai_rel($this->request->getPost('kode1'),$this->request->getPost('kode2'),$id);
			$row1 = $dwl->get_nilai_rel($this->request->getPost('kode2'),$this->request->getPost('kode1'),$id);
			$data_insert = new RelAlternatifModel();
			$data_insert->update($row['0']['ID'], [
				"nilai" => $this->request->getPost('nilai')
			]);
			$balik = 1/$this->request->getPost('nilai');
			$data_insert->update($row1['0']['ID'], [
				"nilai" => $balik
			]);
			return redirect()->to(base_url().'rel_alternatif/view?kode_kriteria='.$id);
		}else{
			$session->setFlashdata('msg', 'Alternatif yang sama Wajib Bernilai 1');
			return redirect()->to(base_url().'rel_alternatif/view?kode_kriteria='.$id);
		}



	}
}