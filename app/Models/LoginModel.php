<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
	protected $table      = 'tb_admin';
	protected $primaryKey = 'id_admin';

    // protected $useAutoIncrement = true;
    // protected $allowedFields = ['asik'];
	protected $allowedFields = ['id_admin','username','password'];


	public function LoginAdmin($username,$password)
	{
		return $this->db->table('tb_admin')
		->where('username',$username)
		->where('password',$password)
		->get()->first();  
	}
}