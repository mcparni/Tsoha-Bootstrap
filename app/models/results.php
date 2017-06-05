<?php

class Results extends BaseModel{
	public $id, $result, $createdon, $sport_id, $player_id,$player_name, $sport_name;
	
	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){
	    $query = DB::connection()->prepare('SELECT * FROM Results');
	    $query->execute();
	    $rows = $query->fetchAll();
	    $results = array();


	    foreach($rows as $row){
			$results[] = new Results(array(
				'player_id' => $row['player_id'],
				'sport_id' => $row['sport_id'],
				'result' => $row['result'],
				'createdon' => $row['createdon']
			));
	    }
		
    	return $results;
  	}
	public static function findAllByPlayer($id){
		
		$query = DB::connection()->prepare('SELECT a.result, a.createdon, a.player_id, a.sport_id, b.name AS player_name, c.name AS sport_name FROM Results a, Players b, Sports c WHERE a.player_id = b.id AND a.sport_id = c.id AND b.id = :id');
		$query->execute(array('id' => $id));
		$rows = $query->fetchAll();

		foreach($rows as $row){
			$results[] = new Results(array(
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
		$query = DB::connection()->prepare('SELECT a.result, a.createdon, a.player_id, a.sport_id, b.name AS player_name, c.name AS sport_name FROM Results a, Players b, Sports c WHERE a.player_id = b.id AND a.sport_id = c.id AND c.id = :id');
		$query->execute(array('id' => $id));
		$rows = $query->fetchAll();

		foreach($rows as $row){
			$results[] = new Results(array(
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
