<?php

class Results extends BaseModel{
	public $id, $result, $createdon, $sport_id, $player_id,$player_name, $sport_name;
	
	public function __construct($attributes){
		// INSERT INTO Results (player_id, sport_id, result, createdon) VALUES (1,1,'38', NOW());
		parent::__construct($attributes);
		$this->validators = array('validate_player', 'validate_sport', 'validate_result');
	}

	public static function all(){
	    $query = DB::connection()->prepare('SELECT a.id, a.result, a.createdon, a.player_id, a.sport_id, b.name AS player_name, c.sort_order , c.name AS sport_name FROM Results a, Players b, Sports c WHERE a.player_id = b.id AND a.sport_id = c.id ORDER BY CASE c.sort_order = 1 WHEN TRUE THEN result END DESC, CASE c.sort_order = 1 WHEN FALSE THEN result END ASC');
	    $query->execute();
	    $rows = $query->fetchAll();
	    $results = array();


	    foreach($rows as $row){
			$results[] = new Results(array(
				'id' => $row['id'],
				'player_id' => $row['player_id'],
				'sport_id' => $row['sport_id'],
				'result' => $row['result'],
				'player_name' => $row['player_name'],
				'sport_name' => $row['sport_name'],
				'createdon' => $row['createdon']
			));
	    }
		
    	return $results;
  	}

	public static function allByTitle() {
		$results = self::all();
		$resultsByTitle = array();
		foreach($results as $result) {  
    		$resultsByTitle[$result->sport_name][] = $result;
		}
		return $resultsByTitle;
	}

	public static function findAllByPlayer($id){
		
		$query = DB::connection()->prepare('SELECT a.id, a.result, a.createdon, a.player_id, a.sport_id, b.name AS player_name, c.name AS sport_name FROM Results a, Players b, Sports c WHERE a.player_id = b.id AND a.sport_id = c.id AND b.id = :id');
		$query->execute(array('id' => $id));
		$rows = $query->fetchAll();

		foreach($rows as $row){
			$results[] = new Results(array(
				'id' => $row['id'],
				'player_id' => $row['player_id'],
				'sport_id' => $row['sport_id'],
				'result' => $row['result'],
				'player_name' => $row['player_name'],
				'sport_name' => $row['sport_name'],
				'createdon' => $row['createdon']
			));
	    }
		//Kint::trace();
  		//Kint::dump($rows);
		//Kint::dump($results);
		if(count($rows) == 0) {
			$results = null;
		}
		
		
	    return $results;
	}

	public static function find($id){
		$query = DB::connection()->prepare('SELECT a.id, a.result, a.createdon, a.player_id, a.sport_id, b.name AS player_name , c.name AS sport_name FROM Results a, Players b, Sports c WHERE a.player_id = b.id AND a.sport_id = c.id AND a.id = :id LIMIT 1');
		

		$query->execute(array('id' => $id));
		$row = $query->fetch();

		if($row){
			$result = new Results(array(
				'id' => $row['id'],
				'player_id' => $row['player_id'],
				'sport_id' => $row['sport_id'],
				'result' => $row['result'],
				'player_name' => $row['player_name'],
				'sport_name' => $row['sport_name'],
				'createdon' => $row['createdon']
			));
			return $result;
		}

		return null;

	}

	public static function findAllBySport($id){

		$query = DB::connection()->prepare('SELECT a.id, a.result, a.createdon, a.player_id, a.sport_id, b.name AS player_name, c.sort_order , c.name AS sport_name FROM Results a, Players b, Sports c WHERE a.player_id = b.id AND a.sport_id = c.id AND c.id = :id ORDER BY CASE c.sort_order = 1 WHEN TRUE THEN result END DESC, CASE c.sort_order = 1 WHEN FALSE THEN result END ASC');
		$query->execute(array('id' => $id));
		$rows = $query->fetchAll();

		foreach($rows as $row){
			$results[] = new Results(array(
				'id' => $row['id'],
				'player_id' => $row['player_id'],
				'sport_id' => $row['sport_id'],
				'result' => $row['result'],
				'player_name' => $row['player_name'],
				'sport_name' => $row['sport_name'],
				'createdon' => $row['createdon']
			));
	    }
	    if(count($rows) == 0) {
			$results = null;
		}
		
	    return $results;
	}

	public function remove() {
		$query = DB::connection()->prepare('DELETE FROM Results WHERE id=:id RETURNING id');
	    $query->execute(array('id' => $this->id));
	    $row = $query->fetch();
		$this->id = $row['id'];
	}
	
	public function update() {
		$query = DB::connection()->prepare('UPDATE Results SET player_id=:player_id, sport_id=:sport_id, result=:result, createdon=:createdon WHERE id=:id RETURNING id');
	    $query->execute(array('player_id' => $this->player_id, 'sport_id' => $this->sport_id, 'result' => $this->result, 'createdon' => $this->createdon, 'id' => $this->id ));
	    $row = $query->fetch();
		$this->id = $row['id'];
	}

	public function save() {
	    $query = DB::connection()->prepare('INSERT INTO Results (player_id, sport_id, result, createdon) VALUES (:player_id, :sport_id, :result, NOW()) RETURNING id');
	    $query->execute(array('player_id' => $this->player_id, 'sport_id' => $this->sport_id, 'result' => $this->result));
	    $row = $query->fetch();
	    $this->id = $row['id'];
	}
	

}
