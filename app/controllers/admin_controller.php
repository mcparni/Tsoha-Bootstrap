<?php

class AdminController extends BaseController {
    public static function login(){
		View::make('login/login.html');
	}
    public static function logout(){
        $_SESSION['admin'] = null;
        Redirect::to('/', array('message' => 'Olet kirjautunut ulos'));
    }

    public static function editAdmin($id){
		$admin = Admin::find($id);
		$admin_controls = self::check_logged_in();
		if($admin_controls)
			View::make('admin/edit.html', array('admin' => $admin));
		else
			Redirect::to('/login', array('error' => 'Sinun täytyy ensiksi kirjautua sisään.'));

	}

    public static function update($id) {
		
	    $params = $_POST;
        $oldAdmin = Admin::find($id);
        $validator_case = 0;

        if(strlen($params['n_password_1']) > 0 || strlen($params['n_password_2']) > 0) {
            $validator_case = 1;
        }

        if($params['name'] != $oldAdmin->name) {
            $validator_case = 2;
        }

		$attributes = array(
			'id' => $id,
    		'name' => $params['name'],
            'password' => $params['password'],
	    	'n_password_1' => $params['n_password_1'],
            'n_password_2' => $params['n_password_2'],
            'oldname' => $oldAdmin->name,
            'oldpassword' => $oldAdmin->password,
            'validator_case' => $validator_case
  		);

		$admin = new Admin($attributes);
		$errors = $admin->errors();

		if($validator_case == 0) {
            View::make('admin/edit.html', array('errors'=>$errors, 'message' => 'Mitään ei muutettu' ,  'admin' => $attributes));
		} else if(count($errors) === 0) {
			View::make('admin/edit.html', array('errors'=>$errors, 'message' => 'Tiedot päivitetty', 'admin' => $attributes));            
		} else {
            View::make('admin/edit.html', array('errors'=>$errors, 'admin' => $attributes));
        }
		
	}

    public static function handleLogin(){

        $params = $_POST;

        $admin = Admin::authenticate($params['username'], $params['password']);

        if(!$admin) {
            View::make('login/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['admin'] = $admin->id;
            Redirect::to('/', array('message' => 'Olet nyt kirjautuneena sisään.'));
        }
  
	}

}