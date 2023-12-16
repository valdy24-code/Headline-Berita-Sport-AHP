<?php

namespace App\Controllers;

class Home extends BaseController
{
	
	public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        $data['title'] ='Halaman Dashboard';
    	if(!$this->session->has('isLogin')){
            return redirect()->to(base_url().'login/view');
        }else{
            return view('welcome_message',$data);
        }
        
    }
}
