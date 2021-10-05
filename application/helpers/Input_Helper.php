<?php
/**
*
*/
class Input_helper
{

	public static function postOrOr($index, $a = '', $b = '')
	{
		if(isset($_POST[$index]) && $_POST[$index]!='')
			return $_POST[$index];
		else if(isset($a))
			return $a;
		return $b;
	}
	public static function randomString($length){
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$char = '';
		for ($i=0; $i < $length; $i++) {
			$char.=$chars[rand(0, strlen($chars)-1)];
		}
		return $char;
	}
	public static function uploadImage($file, $dir){

		move_uploaded_file($file['tmp_name'], str_replace("system", "assets/upload/", BASEPATH)."/$dir/$file[name]");
	}
	

}
