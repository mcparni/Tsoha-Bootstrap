<?php

class PlayerController extends BaseController {

	public static function players(){
		$players = Player::all();
		View::make('players/players.html', array('players' => $players ));
	}
	public static function player($id){
		$player = Player::find($id);
		$results = Results::findAllByPlayer($id);	
		View::make('players/player.html', array('player' => $player, 'results'=>$results));
	}
	public static function editPlayer($id){
		$player = Player::find($id);
		if(self::check_logged_in())
			View::make('players/edit.html', array('player' => $player));
		else
			Redirect::to('/login', array('error' => 'Sinun täytyy ensiksi kirjautua sisään.'));

	}
	
	public static function new(){
		if(self::check_logged_in())
			View::make('players/new.html');
		else
			Redirect::to('/login', array('error' => 'Sinun täytyy ensiksi kirjautua sisään.'));
		
	}
	public static function remove($id) {
		
	    $params = $_POST;
		$player = new Player(array(
			'id' => $id
	    ));

		$player->remove();
		Redirect::to('/players', array('message' => 'Pelaaja poistettu'));
	}

	public static function update($id) {
		
	    $params = $_POST;

		$attributes = array(
			'id' => $id,
    		'name' => $params['name'],
	    	'description' => $params['description']
  		);

		$player = new Player($attributes);

		$errors = $player->errors();

		if(count($errors) === 0) {
			$player->update();
			Redirect::to('/players/' . $player->id, array('message' => 'Pelaajaa ' . $player->name . ' muokattu'));
		} else {
			View::make('players/edit.html', array('errors'=>$errors, 'player' => $attributes));
			
		}

		
	}

	public static function store() {
		  
	    $params = $_POST;

		$attributes = array(
    		'name' => $params['name'],
	    	'description' => $params['description']
  		);
	    
		$player = new Player($attributes);
		$errors = $player->errors();

		if(count($errors) === 0) {
			$player->save();
			Redirect::to('/players/' . $player->id, array('message' => 'Pelaaja on lisätty'));
		} else {
			View::make('players/new.html', array('errors' => $errors, 'attributes' => $attributes));
		}
		

	}
	
   
}
