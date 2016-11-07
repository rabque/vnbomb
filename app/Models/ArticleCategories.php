<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleCategories extends AppModel
{

	protected $table = 'article_categories';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	/**
	 *
	 * And Article is category
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
	public function categories(){
		return $this->belongsToMany('App\Models\Category');
	}

}
