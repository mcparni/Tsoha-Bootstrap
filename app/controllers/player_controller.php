<?php

class PlayerController extends BaseController{

	public static function players(){
		$players = Player::all();
		View::make('players/players.html', array('players' => $players));
	}
	public static function player($id){
		$player = Player::find($id);
		$results = Results::findAllByPlayer($id);
		View::make('players/player.html', array('player' => $player, 'results'=>$results));
	}
	public static function editPlayer($id){
		$player = Player::find($id);
		View::make('players/edit.html', array('player' => $player));
	}
	public static function new(){
		View::make('players/new.html');
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
		$player = new Player(array(
			'id' => $id,	
	      	'name' => $params['name'],
	      	'description' => $params['description']
	    ));

		$player->update();
		Redirect::to('/players/' . $player->id, array('message' => 'Pelaajaa ' . $player->name . ' muokattu'));
	}

	public static function store() {
		  
	    $params = $_POST;
	    
		$player = new Player(array(
	      'name' => $params['name'],
	      'description' => $params['description']
	    ));

		$player->save();
		Redirect::to('/players/' . $player->id, array('message' => 'Pelaaja on lisätty'));

	}
	
   
}
