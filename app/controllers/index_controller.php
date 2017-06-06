<?php

class IndexController extends BaseController {

    public static function index(){
		View::make('home.html');
	}

}