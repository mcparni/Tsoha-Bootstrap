<?php

class AdminController extends BaseController {
    public static function login(){
		View::make('login/login.html');
	}
    public static function logout(){
        $_SESSION['admin'] = null;
        Redirect::to('/', array('message' => 'Olet kirjautunut ulos'));
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