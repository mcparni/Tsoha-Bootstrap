<?php

class Player extends BaseModel{
	public $id, $name, $description, $createdon;
	
	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_name', 'validate_player_description','validate_name_max','validate_description_max');
	}

	public static function all(){
	    $query = DB::connection()->prepare('SELECT * FROM Players');
	    $query->execute();
	    $rows = $query->fetchAll();
	    $players = array();

	    foreach($rows as $row){
			$players[] = new Player(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'description' => $row['description'],
				'createdon' => $row['createdon']
			));
	    }

    	return $players;
  	}
	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Players WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();

		if($row){
			$player = new Player(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'description' => $row['description'],
				'createdon' => $row['createdon']
			));
			return $player;
		}

		return null;

	}

	public function remove() {
		$query = DB::connection()->prepare('DELETE FROM Players WHERE id=:id RETURNING id');
	    $query->execute(array('id' => $this->id));
	    $row = $query->fetch();
		$this->id = $row['id'];
	}
	
	public function update() {
		$query = DB::connection()->prepare('UPDATE Players SET name=:name, description=:description WHERE id=:id RETURNING id');
	    $query->execute(array('name' => $this->name, 'description' => $this->description, 'id' => $this->id ));
	    $row = $query->fetch();
		$this->id = $row['id'];
	}

	public function save() {
	    $query = DB::connection()->prepare('INSERT INTO Players (name, description, createdon) VALUES (:name, :description, NOW()) RETURNING id');
	    $query->execute(array('name' => $this->name, 'description' => $this->description));
	    $row = $query->fetch();
	    $this->id = $row['id'];
	}

	/*
		Player spesifit validaattorit
	*/

	public function validate_player_ID() {
		return $this->validate_ID($this->id);
	}
	public function validate_player_description() {
    	return $this->validate_string_length("Kuvaus", $this->description, 5);
    }

}
