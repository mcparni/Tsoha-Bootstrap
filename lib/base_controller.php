<?php

class BaseController {


	public static function get_user_logged_in(){
		if(isset($_SESSION['admin'])){
			$admin_id = $_SESSION['admin'];
			$admin = Admin::find($admin_id);
			return $admin;
		}
		return null;

	}

	public static function check_logged_in(){
		if(!isset($_SESSION['admin'])){
			return false;
    	} else {
			return true;
		}
	}

}
