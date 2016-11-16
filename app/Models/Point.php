<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Point extends Model
{
    use SoftDeletes;
	
	protected $table = 'points';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

	public static function getPointByGameType($type = 1){
		$points = self::where("game_type",$type)->get()->first();
		$data = [];
		if(!empty($points)){
			$data = $points->toArray();
			$data["point"] = json_decode($points["point"],true);
		}
		return $data;
	}
}
