<?php

class SandBoxController extends BaseController {
    public static function sandbox(){
    	//$tikka = Sport::find(1);
    	//$sports = Sport::all();
    	//Kint::dump($sports);
    	//Kint::dump($tikka);
		/* $test = new Sport(array(
			'name' => 'plaasdasda',
			'description' => 'tsesdasdasdasdt!',
			'sort_order' => 1
		));
		$errors = $test->errors();*/

		/*$results = Results::allByTitle();

		if($results) {
			foreach($results as $section) {
				echo $section[0]->sport_name . "<br>";
				foreach($section as $result) {	
					echo $result->player_name . "\t" . $result->result . "<br>";
				}
			}
		}*/
		$result = new Results(array(
			'id' => 2
		));
		Kint::dump($result);
		$errors = $result->errors();
		Kint::dump($errors);
		$res = Results::find(1);
    	
    	Kint::dump($res);

  
	}
}