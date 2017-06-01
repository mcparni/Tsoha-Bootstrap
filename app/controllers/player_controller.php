<?php

class PlayerController extends BaseController{

	public static function urheilijat(){
		$players = Player::all();
		View::make('urheilijat/urheilijat.html', array('players' => $players));
	}
	public static function urheilija($id){
		$player = Player::find($id);
		View::make('urheilijat/urheilija.html', array('player' => $player));
	}
	public static function uusi(){
		View::make('urheilijat/uusi.html');
	}
	public static function prosessoi() {
		  
	    $params = $_POST;
	    $player = new Player(array(
	      'name' => $params['name'],
	      'description' => $params['description']
	    ));

	    $player->tallenna();

	    Redirect::to('/urheilijat/' . $player->id, array('message' => 'Pelaaja on lisätty'));
  
	}
	
   
}
