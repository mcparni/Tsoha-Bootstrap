<?php

class ResultsController extends BaseController{


	public static function results(){
		$results = Results::allByTitle();
		$admin_controls = self::check_logged_in();
		View::make('results/results.html', array('results' => $results, 'admin_controls' => $admin_controls));
	}

	public static function editResult($id){
		$result = Results::find($id);
		$players = Player::all();
		$sports = Sport::all();
		$admin_controls = self::check_logged_in();
		if($admin_controls)
			View::make('results/edit.html', array('result' => $result,'sports' => $sports, 'players' => $players));
		else
			Redirect::to('/login', array('error' => 'Sinun täytyy ensiksi kirjautua sisään.'));

	}
	
	public static function new(){
		$admin_controls = self::check_logged_in();
		$players = Player::all();
		$sports = Sport::all();
		if($admin_controls)
			View::make('results/new.html', array('sports' => $sports, 'players' => $players, 'admin_controls' => $admin_controls));
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
			View::make('results/edit.html', array('errors'=>$errors, 'results' => $attributes));
			
		}

		
	}

	public static function store() {
		  
	    $params = $_POST;

		$attributes = array(
    		'player_id' => $params['player_id'],
	    	'sport_id' => $params['sport_id'],
			'result' => $params['result']
  		);
	    
		$result = new Results($attributes);
		$errors = $result->errors();

		if(count($errors) === 0) {
			$result->save();
			Redirect::to('/sports/' . $result->sport_id, array('message' => 'Tulos on lisätty'));
		} else {
			View::make('results/new.html', array('errors' => $errors, 'attributes' => $attributes));
		}
		

	}
   
}
