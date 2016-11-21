<?php
namespace App\Models;



class Language extends AppModel
{

	
	protected $table = 'languages';



	public static function getLangById($id){
		if(empty($id)) return false;
		$lang = self::find($id);
		return $lang;
	}
}
