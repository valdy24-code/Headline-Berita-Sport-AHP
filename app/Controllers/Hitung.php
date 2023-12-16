<?php

namespace App\Controllers;
use App\Models\KriteriaModel;
use App\Models\AlternatifModel;
use App\Models\RelAlternatifModel;
use App\Models\RelKriteriaModel;
use App\Models\HitungModel;
use CodeIgniter\Model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Hitung extends BaseController
{
	
	protected $crips = array();
	protected $alternatif = array();
	protected $kriteria = array();
	protected $matriks = array();
	protected $normal = array();
	protected $hasil = array();
	protected $total = array();
	protected $rank = array();


	public function index()
	{
		$session = session();
		$session->setFlashdata('msg', 'Kriteria yang sama Wajib Bernilai 1');
		$data['title'] = 'Halaman Perhitungan';
		$data['ALTERNATIF'] = $this->get_alternatif();
		$data['KRITERIA'] = $this->get_kriteria();

        //AHP
		$data['rel_kriteria'] = $this->get_relkriteria();
		$data['total'] = $this->get_total_kolom($data['rel_kriteria']);
		$data['ahp_normal'] = $this->normalize($data['rel_kriteria'], $data['total']);
		$data['rata'] = $this->get_rata($data['ahp_normal']);
		$data['cm'] = $this->consistency_measure($data['rel_kriteria'], $data['rata']);

        //AHP ALTERNATIF
		$data['rel_alternatif'] = $this->get_relalternatif();
		$data['total_alternatif'] = $this->get_total_kolom_alternatif($data['rel_alternatif']);
		$data['ahp_normal_alternatif'] = $this->normalize_alternatif($data['rel_alternatif'], $data['total_alternatif']);
		$data['rata_alternatif'] = $this->get_rata_alternatif($data['ahp_normal_alternatif']);
		$data['rata_alternatif_cross'] = $this->rata_alternatif_cross($data['rata_alternatif']);
		$data['nilai'] = $this->mmult($data['rata_alternatif_cross'],$data['rata']);
		$data['rank'] = $this->get_rank($data['nilai']);

        //tabel nilai ratio index
		$data['nRI'] = array(
			1 => 0,
			2 => 0,
			3 => 0.58,
			4 => 0.9,
			5 => 1.12,
			6 => 1.24,
			7 => 1.32,
			8 => 1.41,
			9 => 1.46,
			10 => 1.49
		);
		
		echo view('hitung/view',$data);
	}

	private function rata_alternatif_cross($array)
	{
		$data = array();
		foreach ($array as $key => $value) {
			foreach ($value as $k => $v) {
				$data[$k][$key]=$v;
			}
		}
		return $data;
	}
	private function get_rank($array)
	{
		$data = $array;
		arsort($data);
		$no = 1;
		$new = array();
		foreach ($data as $key => $value) {
			$new[$key] = $no++;
		}
		return $new;
	}

	private function get_net_flow($leaving = array(), $entering = array())
	{
		$arr = array();
		foreach ($leaving as $key => $val) {
			$arr[$key] = $val - $entering[$key];
		}
		return $arr;
	}

	private function get_entering($matriks = array(), $total_kolom = array())
	{
		$arr = array();
		foreach ($matriks as $key => $val) {
			$arr[$key] = $total_kolom[$key] / (count($val) - 1);
		}
		return $arr;
	}

	private function get_leaving($matriks = array(), $total_baris = array())
	{
		$arr = array();
		foreach ($matriks as $key => $val) {
			$arr[$key] = $total_baris[$key] / (count($val) - 1);
		}
		return $arr;
	}

	private function get_total_baris($matriks = array())
	{
		$arr = array();
		foreach ($matriks as $key => $val) {
			$arr[$key] = 0;
			foreach ($val as $k => $v) {
				$arr[$key] += $v;
			}
		}
		return $arr;
	}

	private function get_total_kolom($matriks = array())
	{
		$arr = array();
		foreach ($matriks as $key => $val) {
			foreach ($val as $k => $v) {
				if (!isset($arr[$k]))
					$arr[$k] = 0;
				$arr[$k] += $v;
			}
		}
		return $arr;
	}

	private function get_matriks($komposisi = array(), $total_index_pref = array(), $ALTERNATIF)
	{
		$arr = array();
		foreach ($ALTERNATIF as $key => $val) {
			foreach ($ALTERNATIF as $k => $v) {
				$arr[$key][$k] = 0;
			}
		}

		foreach ($komposisi as $key => $val) {
			$arr[$val[0]][$val[1]] = $total_index_pref[$key];
		}
		return $arr;
	}

	private function get_normal($data = array(), $komposisi = array(), $KRITERIA)
	{
		$arr = array();
		foreach ($KRITERIA as $key => $val) {
			foreach ($komposisi as $k => $v) {
				$arr[$key][] = array($v[0], $v[1]);
			}
		}
		return $arr;
	}

	private function get_komposisi($ALTERNATIF)
	{
		$arr = array();
		$keys = array_keys($ALTERNATIF);

		foreach ($keys as $key) {
			foreach ($keys as $k) {
				if ($key != $k)
					$arr[$key][$k] = 1;
			}
		}

		$result = array();
		foreach ($arr as $key => $val) {
			foreach ($val as $k => $v) {
				$result[] = array($key, $k);
			}
		}

		return $result;
	}



	public function get_kriteria()
	{
		$kriteria = new KriteriaModel();
		$rows = $kriteria->findAll();
		foreach ($rows as $row) {
			$this->kriteria[$row['kode_kriteria']] = $row;
		}
		return $this->kriteria;
	}

	public function get_alternatif()
	{
		$alternatif = new AlternatifModel();
		$rows = $alternatif->findAll();
		foreach ($rows as $row) {
			$this->alternatif[$row['kode_alternatif']] = $row;
		}
		return $this->alternatif;
	}

	private function get_relkriteria()
	{
		
		
		$rel = new RelKriteriaModel();
		$rows = $rel->get_rel_all_kriteria();

		$data = array();
		foreach ($rows as $row) {
			$data[$row['ID1']][$row['ID2']]=$row['nilai'];
		}
		return $data;
	}

	function get_relalternatif()
	{
		$rel = new RelAlternatifModel();
		$rows = $rel->get_rel_all_alternatif();

		$data = array();
		foreach ($rows as $row) {
			$data[$row['kode_kriteria']][$row['kode1']][$row['kode2']]=$row['nilai'];
		}
		return $data;
	}


	function get_total_kolom_alternatif($matriks = array())
	{
		$total = array();
		foreach ($matriks as $key => $val) {

			foreach ($val as $k => $v) {
				foreach ($v as $ka => $va) {
					if (!isset($total[$key][$ka]))
						$total[$key][$ka] = 0;
					$total[$key][$ka] += $va;
				}

			}
		}
		return $total;
	}
	function normalize_alternatif($matriks = array(), $total = array())
	{

		foreach ($matriks as $key => $val) {
			foreach ($val as $k => $v) {
				foreach ($v as $ka => $va) {
					$matriks[$key][$k][$ka] = $matriks[$key][$k][$ka] / $total[$key][$ka];
				}
			}
		}
		return $matriks;
	}

	function normalize($matriks = array(), $total = array())
	{

		foreach ($matriks as $key => $val) {
			foreach ($val as $k => $v) {
				$matriks[$key][$k] = $matriks[$key][$k] / $total[$k];
			}
		}
		return $matriks;
	}
	function mmult($matriks = array(), $rata = array())
	{
		$data = array();

		$rata = array_values($rata);

		foreach ($matriks as $key => $val) {
			$no = 0;
			foreach ($val as $k => $v) {

				if (!isset($data[$key]))
					$data[$key] = 0;
				$data[$key] += $v * $rata[$no];
				$no++;
			}
		}

		return $data;
	}
	function consistency_measure($matriks, $rata)
	{
		$matriks = $this->mmult($matriks, $rata);
		foreach ($matriks as $key => $val) {
			$data[$key] = $val / $rata[$key];
		}
		return $data;
	}

	function get_rata($normal)
	{
		$rata = array();
		foreach ($normal as $key => $val) {
			$rata[$key] = array_sum($val) / count($val);
		}
		return $rata;
	}

	function get_rata_alternatif($normal)
	{
		$rata = array();
		foreach ($normal as $key => $val) {
			foreach ($val as $k => $v) {
				$rata[$key][$k] = array_sum($v) / count($v);
			}

		}
		return $rata;
	}

	function get_eigen_alternatif($kriteria=array()){
		$CI = &get_instance();
		$data = array();
		foreach($kriteria as $key => $value){
			$kode_kriteria = $key;
			$matriks = get_relalternatif($kode_kriteria);
			$total = get_total_kolom($matriks);
			$normal = normalize($matriks, $total);
			$rata = get_rata($normal);
			$data[$kode_kriteria] = $rata;                
		}
		$new = array();
		foreach($data as $key => $value){
			foreach($value as $k => $v){
				$new[$k][$key] = $v;
			}
		}
		return $new;
	}


}