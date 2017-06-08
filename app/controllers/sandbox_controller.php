<?php

class SandBoxController extends BaseController {
    public static function sandbox(){
    	//$tikka = Sport::find(1);
    	//$sports = Sport::all();
    	//Kint::dump($sports);
    	//Kint::dump($tikka);
		 $test = new Sport(array(
			'name' => 'plaasdasda',
			'description' => 'tsesdasdasdasdt!',
			'sort_order' => 1
		));
		$errors = $test->errors();

		Kint::dump($errors);
	}
}