<?php

class ResultsController extends BaseController{


	public static function results(){
		$results = Results::allByTitle();
		View::make('results/results.html', array('results' => $results));
	}

	public static function editResult($id){
		$attributes = Results::find($id);
		$players = Player::all();
		$sports = Sport::all();
		if(self::check_logged_in())
			View::make('results/edit.html', array('attributes' => $attributes,'sports' => $sports, 'players' => $players));
		else
			Redirect::to('/login', array('error' => 'Sinun täytyy ensiksi kirjautua sisään.'));

	}
	
	public static function new(){
		$players = Player::all();
		$sports = Sport::all();
		if(self::check_logged_in())
			View::make('results/new.html', array('sports' => $sports, 'players' => $players));
		else
			Redirect::to('/login', array('error' => 'Sinun täytyy ensiksi kirjautua sisään.'));
		
	}
	public static function remove($id) {
		
	    $params = $_POST;
		$result = new Results(array(
			'id' => $id
	    ));

		$result->remove();
		Redirect::to('/results', array('message' => 'Tulos poistettu'));
	}

	public static function update($id) {
		
	    $params = $_POST;

		$players = Player::all();
		$sports = Sport::all();

		$attributes = array(
			'id' => $id,
    		'player_id' => $params['player_id'],
	    	'sport_id' => $params['sport_id'],
			'result' => $params['result'],
			'createdon' => $params['createdon']
  		);

		$result = new Results($attributes);

		$errors = $result->errors();
		
		if(count($errors) === 0) {
			$result->update();
			Redirect::to('/sports/' . $result->sport_id, array('message' => 'Tulosta muokattu'));
		} else {
			View::make('results/edit.html', array('errors'=>$errors, 'attributes' => $attributes, 'sports' => $sports, 'players' => $players));
			
		}

		
	}

	public static function store() {
		  
	    $params = $_POST;

		$attributes = array(
    		'player_id' => $params['player_id'],
	    	'sport_id' => $params['sport_id'],
			'result' => $params['result']
  		);

		$players = Player::all();
		$sports = Sport::all();
	    
		$result = new Results($attributes);
		$errors = $result->errors();

		if(count($errors) === 0) {
			$result->save();
			Redirect::to('/sports/' . $result->sport_id, array('message' => 'Tulos on lisätty'));
		} else {
			View::make('results/new.html', array('errors' => $errors, 'attributes' => $attributes, 'sports' => $sports, 'players' => $players));
		}
		

	}
   
}
