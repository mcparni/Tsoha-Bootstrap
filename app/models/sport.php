<?php

class Sport extends BaseModel{
	public $id, $name, $description, $sort_order, $createdon;
	
	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_name', 'validate_description','validate_sport_sort','validate_name_max','validate_description_max');
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
	public function remove() {
		$query = DB::connection()->prepare('DELETE FROM Sports WHERE id=:id RETURNING id');
	    $query->execute(array('id' => $this->id));
	    $row = $query->fetch();
		$this->id = $row['id'];
	}
	
	public function update() {
		$query = DB::connection()->prepare('UPDATE Sports SET name=:name, description=:description, sort_order=:sort_order WHERE id=:id RETURNING id');
	    $query->execute(array('name' => $this->name, 'description' => $this->description,'sort_order'=> $this->sort_order, 'id' => $this->id ));
	    $row = $query->fetch();
		$this->id = $row['id'];
	}

	public function save() {
	    $query = DB::connection()->prepare('INSERT INTO Sports (name, description, sort_order, createdon) VALUES (:name, :description, :sort_order, NOW()) RETURNING id');
	    $query->execute(array('name' => $this->name, 'description' => $this->description,'sort_order'=> $this->sort_order));
	    $row = $query->fetch();
	    $this->id = $row['id'];
	}

	/*
		Sport spesifit validaattorit
	*/


	public function validate_sport_sort() {
    	$order = $this->sort_order;
    	$order = (int) $order;
    	if($order === 1 || $order === 0)
        	return null;
      	else
        	return "Väärä tulosjärjestys.";
    }
	

}
