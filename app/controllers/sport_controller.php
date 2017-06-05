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
   
}
