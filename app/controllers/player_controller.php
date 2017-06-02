<?php

class PlayerController extends BaseController{

	public static function urheilijat(){
		$players = Player::all();
		View::make('urheilijat/urheilijat.html', array('players' => $players));
	}
	public static function urheilija($id){
		$player = Player::find($id);
		$results = Results::findAllByPlayer($id);
		View::make('urheilijat/urheilija.html', array('player' => $player, 'results'=>$results));
	}
	public static function editPlayer($id){
		$player = Player::find($id);
		View::make('urheilijat/edit.html', array('player' => $player));
	}
	public static function uusi(){
		View::make('urheilijat/uusi.html');
	}
	public static function remove($id) {
		
	    $params = $_POST;
		$player = new Player(array(
			'id' => $id
	    ));

		$player->remove();
		Redirect::to('/urheilijat', array('message' => 'Pelaaja poistettu'));
	}
	public static function update($id) {
		
	    $params = $_POST;
		$player = new Player(array(
			'id' => $id,	
	      	'name' => $params['name'],
	      	'description' => $params['description']
	    ));

		$player->update();
		Redirect::to('/urheilijat/' . $player->id, array('message' => 'Pelaajaa ' . $player->name . ' muokattu'));
	}

	public static function store() {
		  
	    $params = $_POST;
	    
		$player = new Player(array(
	      'name' => $params['name'],
	      'description' => $params['description']
	    ));

		$player->tallenna();
		Redirect::to('/urheilijat/' . $player->id, array('message' => 'Pelaaja on lisätty'));

	}
	
   
}
