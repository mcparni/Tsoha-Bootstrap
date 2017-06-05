<?php

class Sport extends BaseModel{
	public $id, $name, $description, $sort_order, $createdon;
	
	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){
	    $query = DB::connection()->prepare('SELECT * FROM Sports');
	    $query->execute();
	    $rows = $query->fetchAll();
	    $games = array();

	    foreach($rows as $row){
			$sports[] = new Sport(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'description' => $row['description'],
				'sort_order' => $row['sort_order'],
				'createdon' => $row['createdon']
			));
	    }

    	return $sports;
  	}
	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Sports WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();

		if($row){
			$sport = new Sport(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'description' => $row['description'],
				'sort_order' => $row['sort_order'],
				'createdon' => $row['createdon']
			));
			return $sport;
		}

		return null;

	}
	

}
