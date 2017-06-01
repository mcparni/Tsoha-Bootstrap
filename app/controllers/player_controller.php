<?php

class PlayerController extends BaseController{


	public static function urheilijat(){
		$players = Player::all();
		View::make('urheilijat.html', array('players' => $players));
	}
	public static function urheilija($id){
		$player = Player::find($id);
		View::make('urheilija.html', array('player' => $player));
	}
   
}
