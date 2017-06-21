<?php

class SportController extends BaseController{


	public static function sports(){
		$sports = Sport::all();
		View::make('sports/sports.html', array('sports' => $sports));
	}
	public static function sport($id){
		$sport = Sport::find($id);
		$results = Results::findAllBySport($id);
		View::make('sports/sport.html', array('sport' => $sport, 'results'=> $results));
	}

	public static function editSport($id){
		$sport = Sport::find($id);
		if(self::check_logged_in())
			View::make('sports/edit.html', array('sport' => $sport));
		else
			Redirect::to('/login', array('error' => 'Sinun täytyy ensiksi kirjautua sisään.'));

	}
	
	public static function new(){
		if(self::check_logged_in())
			View::make('sports/new.html');
		else
			Redirect::to('/login', array('error' => 'Sinun täytyy ensiksi kirjautua sisään.'));
		
	}
	public static function remove($id) {
		
	    $params = $_POST;
		$sport = new Sport(array(
			'id' => $id
	    ));

		$sport->remove();
		Redirect::to('/sports', array('message' => 'Laji poistettu'));
	}

	public static function update($id) {
		
	    $params = $_POST;

		$attributes = array(
			'id' => $id,
    		'name' => $params['name'],
	    	'description' => $params['description'],
			'sort_order' => $params['sort_order']
  		);

		$sport = new Sport($attributes);

		$errors = $sport->errors();

		if(count($errors) === 0) {
			$sport->update();
			Redirect::to('/sports/' . $sport->id, array('message' => 'Lajia ' . $sport->name . ' muokattu'));
		} else {
			View::make('sports/edit.html', array('errors'=>$errors, 'sport' => $attributes));
			
		}

		
	}

	public static function store() {
		  
	    $params = $_POST;

		$attributes = array(
    		'name' => $params['name'],
	    	'description' => $params['description'],
			'sort_order' => $params['sort_order']
  		);
	    
		$sport = new Sport($attributes);
		$errors = $sport->errors();

		if(count($errors) === 0) {
			$sport->save();
			Redirect::to('/sports/' . $sport->id, array('message' => 'Laji on lisätty'));
		} else {
			View::make('sports/new.html', array('errors' => $errors, 'attributes' => $attributes));
		}
		

	}
   
}
