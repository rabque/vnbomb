<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends AppModel
{
    use SoftDeletes;
	
	protected $table = 'articles';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];


	/**
	 *
	 * And Article is category
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
	public function categories(){
		return $this->belongsToMany('App\Models\Category')->withTimestamps();
	}

}
