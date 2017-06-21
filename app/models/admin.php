<?php

class Admin extends BaseModel {
    public $id, $name, $password, $n_password_1, $n_password_2, $oldname, $oldpassword;
    
     /*
	 	public function __construct($attributes)

        $attributes["validator_case"] -muuttujan avulla viestitään mitä admin tietoa
        halutaan muuttaa ja sen perusteella käytetään eri validointifunktioita.

        $attributes["validator_case"] = 1 -- tallennetaan uusi salasana ja käyttäjätunnus
       	$attributes["validator_case"] = 2 -- tallennetaan pelkästään uusi käyttäjätunnus  

		Jos sitä ei ole asetettu, käytetään oletusvalidointia.   
    */	
	public function __construct($attributes){
		parent::__construct($attributes);
		$validators = array('validate_name','validate_name_max');

		if(array_key_exists ('validator_case' , $attributes )) {
			if($attributes["validator_case"] == 1) {
				array_push($validators, "validate_new_password_length", "validate_new_password2_length", "validate_new_password_match", "validate_old_password_match", "validate_new_password_max", "validate_new_password2_max");
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
	
	/*
	 	public function update($case)

        $case -muuttujan avulla viestitään mitä admin tietoa
        halutaan muuttaa ja sen perusteella käytetään eri tietokantakyselyä.

        $case = 1 -- tallennetaan uusi salasana ja samalla käyttäjätunnus
       	$case = 2 -- tallennetaan pelkästään uusi käyttäjätunnus  

		Jos sitä ei ole asetettu, käytetään oletusvalidointia.   
    */
	public function update($case) {
		$query;
		
		if($case == 1) {
			$query = DB::connection()->prepare('UPDATE Admin SET name=:name, password=:password WHERE id=:id RETURNING id');
		    $query->execute(array('password' => $this->n_password_1,'name' => $this->name, 'id' => $this->id ));
		}
		
		if($case == 2) {
			$query = DB::connection()->prepare('UPDATE Admin SET name=:name WHERE id=:id RETURNING id');
		    $query->execute(array('name' => $this->name, 'id' => $this->id ));
		}

		$row = $query->fetch();
		$this->id = $row['id'];
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

	/*
		Admin spesifit validaattorit
	*/

	public function validate_new_password_max()  {
		return $this->validate_string_max("Uusi salasana", $this->n_password_1, 50);
	}
    public function validate_new_password2_max() {
    	return $this->validate_string_max("Uusi salasana uudestaan", $this->n_password_2, 50);
    }
	public function validate_password_length() {
    	return $this->validate_string_length("Salasana" , $this->password, 8);
    }
    public function validate_new_password_length() {
		return $this->validate_string_length("Uusi salasana" , $this->n_password_1, 8);
    }

    public function validate_new_password2_length() {
    	return $this->validate_string_length("Uusi salasana uudestaan" , $this->n_password_2, 8);
    }

    public function validate_admin_name_change() {
		if($this->name != $this->oldname && $this->password != $this->oldpassword)
			return "Salasana ei täsmää.";
		else
			return null;
    }

    public function validate_new_password_match() {
        if($this->n_password_1 != $this->n_password_2)
          return "Uudet salasanat eivät täsmää.";
        else
          return null;

    }

    public function validate_old_password_match() {
        if($this->password != $this->oldpassword)
          return "Vanha salasana ei täsmää.";
        else
          return null;

    }
}