<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdraw extends Model
{
    use SoftDeletes;
	
	protected $table = 'withdraws';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

	/**
	 *
	 * And Withdraw is category
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\belongsTo
	 */
	public function Player(){
		return $this->belongsTo('App\Models\Player',"player_id");
	}

}
