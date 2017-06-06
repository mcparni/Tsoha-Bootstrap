<?php

class SandBoxController extends BaseController {
    public static function sandbox(){
    	//$tikka = Sport::find(1);
    	//$sports = Sport::all();
    	//Kint::dump($sports);
    	//Kint::dump($tikka);
		 $test = new Player(array(
			'name' => 'pla',
			'description' => 'tsest!'
		));
		$errors = $test->errors();

		Kint::dump($errors);
	}
}