<?php

namespace App\Controllers;
use App\Models\AlternatifModel;
use App\Models\KriteriaModel;
use App\Models\RelAlternatifModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Alternatif extends BaseController
{
	public function index()
	{
		$data['title'] = 'Halaman Data Alternatif';
		$Alternatif = new AlternatifModel();
		$data['rows'] = $Alternatif->findAll();
		echo view('alternatif/view',$data);
	}

	public function add()
	{
		$data['title'] = 'Halaman Tambah Data Alternatif';

		$validation =  \Config\Services::validation();
		$validation->setRules(['nama'=>'required','kode'=>'required']);
		$isDataValid = $validation->withRequest($this->request)->run();

		
		
		if($isDataValid){
			$data_insert = new AlternatifModel();
			$data_insert->insert([
				"kode_alternatif" => $this->request->getPost('kode'),
				"nama_alternatif" => $this->request->getPost('nama')
			]);

			$kriteria = new KriteriaModel();
			$rows_val = $kriteria->findAll();
			foreach ($rows_val as $row) {
				$alternatifrow = new AlternatifModel();
				$rows_all = $alternatifrow->findAll();
				foreach ($rows_all as $row_all) {
					$data_insert = new RelAlternatifModel();
					$data_insert->insert([
						"kode1" => $this->request->getPost('kode'),
						"kode2" => $row_all['kode_alternatif'],
						"kode_kriteria" => $row['kode_kriteria'],
						"nilai" => 1
					]);

					if($row_all['kode_alternatif']!=$this->request->getPost('kode')){
						$data_insert->insert([
							"kode1" => $row_all['kode_alternatif'],
							"kode2" => $this->request->getPost('kode'),
							"kode_kriteria" => $row['kode_kriteria'],
							"nilai" => 1
						]);
					}
				}
			}


			return redirect('alternatif/view');
		}else{
			echo view('alternatif/add',$data);
		}
	}

	public function view_edit($id)
	{
		$data['title'] = 'Halaman Ubah Data Alternatif';
		$row = new AlternatifModel();
		$data['row'] = $row->where('kode_alternatif', $id)->first();

		return view('alternatif/edit', $data);
	}


	public function update($id)
	{
		$data['title'] = 'Halaman Ubah Data Alternatif';
		$row = new AlternatifModel();
		$data['row'] = $row->where('id_alternatif', $id)->first();
		$validation =  \Config\Services::validation();
		$validation->setRules(['nama'=>'required','kode'=>'required']);
		$isDataValid = $validation->withRequest($this->request)->run();

		
		
		if($isDataValid){
			$data_insert = new AlternatifModel();
			$data_insert->update($id, [
				"kode_alternatif" => $this->request->getPost('kode'),
				"nama_alternatif" => $this->request->getPost('nama')
			]);
			return redirect('alternatif/view');
		}else{
			return view('alternatif/edit', $data);
		}

	}

	public function delete($id){
		$data_insert = new AlternatifModel();
		$data_insert->delete($id);
		$data_insert = new RelAlternatifModel();
		$data_insert->where('kode1', $id);
		$data_insert->delete();
		$data_insert->where('kode2', $id);
		$data_insert->delete();
		return redirect('alternatif/view');
	}


}