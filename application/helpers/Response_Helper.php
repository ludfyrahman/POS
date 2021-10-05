<?php
/**
*
*/
class Response_helper
{

	public static function part($file)
	{
		include str_replace("system", "application/views/", BASEPATH) . "part/$file.php";
	}
	public static function toRupiah($string){
		return "Rp ".number_format($string);
	}
}
