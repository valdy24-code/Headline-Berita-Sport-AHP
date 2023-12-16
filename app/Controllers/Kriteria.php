<?php

namespace App\Controllers;
use App\Models\KriteriaModel;
use App\Models\AlternatifModel;
use App\Models\RelKriteriaModel;
use App\Models\RelAlternatifModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Kriteria extends BaseController
{
	public function index()
	{
		$data['title'] = 'Halaman Data Kriteria';
		$kriteria = new KriteriaModel();
		$data['rows'] = $kriteria->findAll();
		echo view('kriteria/view',$data);
	}

	public function add()
	{
		$data['title'] = 'Halaman Tambah Data Kriteria';

		$validation =  \Config\Services::validation();
		$validation->setRules(['nama'=>'required','kode'=>'required']);
		$isDataValid = $validation->withRequest($this->request)->run();

		
		
		if($isDataValid){
			$data_insert = new KriteriaModel();
			$data_insert->insert([
				"kode_kriteria" => $this->request->getPost('kode'),
				"nama_kriteria" => $this->request->getPost('nama')
			]);

			$alternatif = new AlternatifModel();
			$rows_val = $alternatif->findAll();
			foreach ($rows_val as $row) {
				foreach ($rows_val as $row1) {
					$data_insert = new RelAlternatifModel();
					$data_insert->insert([
						"kode1" => $row['kode_alternatif'],
						"kode2" => $row1['kode_alternatif'],
						"kode_kriteria" => $this->request->getPost('kode'),
						"nilai" => 1
					]);
					
					
				}
			}

			$kriteria = new KriteriaModel();
			$rows_val = $kriteria->findAll();
			foreach ($rows_val as $row) {
					$data_insert = new RelKriteriaModel();
					$data_insert->insert([
						"ID1" => $this->request->getPost('kode'),
						"ID2" => $row['kode_kriteria'],
						"nilai" => 1
					]);

					if($row['kode_kriteria']!=$this->request->getPost('kode')){
						$data_insert->insert([
							"ID1" => $row['kode_kriteria'],
							"ID2" => $this->request->getPost('kode'),
							"nilai" => 1
						]);
					}
			}


			return redirect('kriteria/view');
		}else{
			echo view('kriteria/add',$data);
		}
	}

	public function view_edit($id)
	{
		$data['title'] = 'Halaman Ubah Data Kriteria';
		$row = new KriteriaModel();
		$data['row'] = $row->where('kode_kriteria', $id)->first();

		return view('kriteria/edit', $data);
	}


	public function update($id)
	{
		$data['title'] = 'Halaman Ubah Data Kriteria';
		$row = new KriteriaModel();
		$data['row'] = $row->where('kode_kriteria', $id)->first();
		$validation =  \Config\Services::validation();
		$validation->setRules(['nama'=>'required','kode'=>'required']);
		$isDataValid = $validation->withRequest($this->request)->run();

		
		
		if($isDataValid){
			$data_insert = new KriteriaModel();
			$data_insert->update($id, [
				"kode_kriteria" => $this->request->getPost('kode'),
				"nama_kriteria" => $this->request->getPost('nama')
			]);
			return redirect('kriteria/view');
		}else{
			return view('kriteria/edit', $data);
		}

	}

	public function delete($id){
		$data_insert = new KriteriaModel();
		$data_insert->delete($id);
		$data_insert = new RelAlternatifModel();
		$data_insert->where('kode_kriteria', $id);
		$data_insert->delete();
		$data_insert = new RelKriteriaModel();
		$data_insert->where('ID1', $id);
		$data_insert->delete();
		$data_insert = new RelKriteriaModel();
		$data_insert->where('ID2', $id);
		$data_insert->delete();
		return redirect('kriteria/view');
	}


}