<?php

class Admin extends BaseModel {
    public $id, $name, $password;
    
    public function __construct($attributes){
		parent::__construct($attributes);
		//$this->validators = array('');
	}

    public static function authenticate($username, $password){
		$query = DB::connection()->prepare('SELECT * FROM Admin WHERE name = :username AND password = :password LIMIT 1;');
		$query->execute(array('username' => $username, 'password' => $password));
		$row = $query->fetch();

		if($row){
			$admin = new Admin(array(
				'id' => $row['id'],
				'name' => $row['name']
			));
			return $admin;
		}

		return null;

	}

    public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Admin WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();

		if($row){
			$admin = new Admin(array(
				'id' => $row['id'],
				'name' => $row['name']
			));
			return $admin;
		}

		return null;

	}
}