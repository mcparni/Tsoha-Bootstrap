<?php

class Player extends BaseModel{
	public $id, $name, $description, $createdon;
	
	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){
	    $query = DB::connection()->prepare('SELECT * FROM Player');
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
		$query = DB::connection()->prepare('SELECT * FROM Player WHERE id = :id LIMIT 1');
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
	

}