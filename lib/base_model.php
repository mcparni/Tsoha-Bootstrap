<?php

  class BaseModel{

	protected $validators;

	public function __construct($attributes = null){

	  foreach($attributes as $attribute => $value){

		if(property_exists($this, $attribute)){

		  $this->{$attribute} = $value;

		}
	  }
	}

	/*
		Yleiset validaattorit
	*/
	public function validate_player() {
		$player = Player::find((int) $this->player_id);
		if($player)
			return null;
		else
			return "Pelaajaa ei löydy";
	}

	public function validate_string_length($field, $string, $length) {
	  if(strlen($string) < $length)
		return $field . ' -kentän pituus täytyy olla vähintään '.$length.' merkkiä.';
	}

	public function validate_string_max($field, $string, $length) {
	  if(strlen($string) > $length)
		return $field . ' -kentän pituus saa olla enintään '.$length.' merkkiä.';
	}

	public function validate_ID($id) {
		if(!(is_numeric($id)))
		  return "Id virhe";
	}

	public function validate_name_max() {
		return $this->validate_string_max("Nimi", $this->name, 50);
	}
	public function validate_description_max() {
		return $this->validate_string_max("Kuvaus", $this->description, 500);
	}

	public function validate_description() {
		return $this->validate_string_length("Kuvaus", $this->description, 10);
	}

	public function validate_name() {
		return $this->validate_string_length("Nimi" , $this->name, 1);
	}

	public function validate_general_ID($id) {
		return $this->validate_ID($id);
	}

	public function errors(){
		$errors = array();
		foreach($this->validators as $validator){

			$error = $this->{$validator}();
			if($error)
				array_push($errors, $error);
		}
		return $errors;
	}

  }
