<?php

class Results extends BaseModel{
	public $id, $name, $description, $createdon;
	
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
		$query = DB::connection()->prepare('SELECT * FROM Results WHERE player_id = :id');
		$query->execute(array('id' => $id));
		$row = $query->fetchAll();

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

	public static function findAllBySport($id){
		$query = DB::connection()->prepare('SELECT * FROM Results WHERE sport_id = :id');
		$query->execute(array('id' => $id));
		$row = $query->fetchAll();

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
	

}
