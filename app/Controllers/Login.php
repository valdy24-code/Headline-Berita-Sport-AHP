<?php

namespace App\Controllers;
use App\Models\LoginModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Login extends BaseController
{
	public function __construct()
	{
		$this->session = session();
	}

	public function index()
	{
		$data['title'] = 'Halaman Login';
		echo view('login/login',$data);
	}


	public function cek_login(){

		$session = session();

		$validation =  \Config\Services::validation();
		$validation->setRules(['username'=>'required','password'=>'required']);
		$isDataValid = $validation->withRequest($this->request)->run();
		$data['title'] = 'Halaman Login';
		
		

		if($isDataValid){
			$username = $this->request->getPost('username');
			$password = $this->request->getPost('password');


				$login = new LoginModel();
				$row = $login->where('username', $username)->first();
				if($row){
					if($row['password']==$password){
						$session->set('isLogin',true);
						$session->set('username',$row['username']);
						return redirect()->to(base_url().'/');
					}else{
						$session->setFlashdata('msg', 'Password Salah !!!');
						echo view('login/login',$data);
					}


				}else{
					$session->setFlashdata('msg', 'Username Salah !!!');
					echo view('login/login',$data);
				}
			



		}else{
			$session->setFlashdata('msg', 'Username dan Password tidak boleh kosong');
			echo view('login/login',$data);
		}
	}

	public function logout()
	{
		$session = session();
		$session->destroy();
		return redirect()->to(base_url().'login/view');
	}



}