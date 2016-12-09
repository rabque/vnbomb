<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Affiliate extends AppModel
{
	use SoftDeletes;

	protected $table = 'affiliates';

	protected $hidden = [

	];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

	public static function getAffiliateByCode($code){
		return self::where("code",$code)->get()->first();

	}

}
