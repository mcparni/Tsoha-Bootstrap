<?php

class HelloWorldController extends BaseController{

	public static function index(){

		View::make('home.html');
	}

	public static function kirjaudu(){
		View::make('kirjaudu.html');
	}

	public static function sandbox(){
    	$tikka = Sport::find(1);
    	$sports = Sport::all();
    	Kint::dump($sports);
    	Kint::dump($tikka);
	}
}
