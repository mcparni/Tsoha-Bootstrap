<?php

class ResultsController extends BaseController{


	public static function tulokset(){
		$results = Results::all();
		View::make('tulokset/tulokset.html', array('results' => $results));
	}
	public static function urheilijanTulokset($id){
		//$results = Result::findAllByPlayer($id);
		//View::make('tulokset.html', array('results' => $results));
	}

	public static function lajinTulokset($id){
		//$results = Result::findAllBySport($id);
		//View::make('tulokset.html', array('results' => $results));
	}
   
}
