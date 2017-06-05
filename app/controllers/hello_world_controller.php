<?php

class HelloWorldController extends BaseController{

	public static function index(){

		View::make('home.html');
	}

	public static function login(){
		View::make('login/login.html');
	}

	public static function sandbox(){
    	$tikka = Sport::find(1);
    	$sports = Sport::all();
    	Kint::dump($sports);
    	Kint::dump($tikka);
	}
}
