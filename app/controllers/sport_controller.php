<?php

class SportController extends BaseController{


	public static function lajit(){
		$sports = Sport::all();
		View::make('lajit.html', array('sports' => $sports));
	}
	public static function laji($id){
		$sport = Sport::find($id);
		View::make('laji.html', array('sport' => $sport));
	}
   
}
