<?php

class Admin extends BaseModel {
    public $id, $name, $password, $n_password_1, $n_password_2, $oldname, $oldpassword;
    
    public function __construct($attributes){
		parent::__construct($attributes);
		$validators = array('validate_name');

		if(array_key_exists ('validator_case' , $attributes )) {
			if($attributes["validator_case"] == 1) {
				array_push($validators, "validate_new_password_length", "validate_new_password2_length", "validate_new_password_match", "validate_old_password_match");
			}
			if($attributes["validator_case"] == 2) {
				array_push($validators, "validate_admin_name_change");
			}
		}
		$this->validators = $validators;
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
				'name' => $row['name'],
				'password' => $row['password']
			));
			return $admin;
		}

		return null;

	}
}