<?php

class Results extends BaseModel{
	public $id, $result, $createdon, $sport_id, $player_id,$player_name, $sport_name;
	
	public function __construct($attributes){
		parent::__construct($attributes);
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
	

}
