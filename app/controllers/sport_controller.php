<?php

class SportController extends BaseController{


	public static function lajit(){
		$sports = Sport::all();
		View::make('lajit/lajit.html', array('sports' => $sports));
	}
	public static function laji($id){
		$sport = Sport::find($id);
		$results = Results::findAllBySport($id);
		View::make('lajit/laji.html', array('sport' => $sport, 'results'=> $results));
	}
   
}
