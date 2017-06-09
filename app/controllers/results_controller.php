<?php

class ResultsController extends BaseController{


	public static function results(){
		$results = Results::allByTitle();
		View::make('results/results.html', array('results' => $results));
	}
	public static function resultsByPlayer($id){
		//$results = Result::findAllByPlayer($id);
		//View::make('results.html', array('results' => $results));
	}

	public static function resultsBySport($id){
		//$results = Result::findAllBySport($id);
		//View::make('results.html', array('results' => $results));
	}
   
}
