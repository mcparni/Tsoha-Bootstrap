<?php

class UserController extends BaseController {
    public static function login(){
		View::make('login/login.html');
	}

}