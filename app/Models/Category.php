<?php
namespace App\Models;

use App\Common\Utility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends AppModel
{
    use SoftDeletes;
	
	protected $table = 'categories';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

    public function subcategory()
    {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    public static function getTree(){
        $categories = self::where("id","!=",1)->get();
        $result = array();
        if(!empty($categories)){
            Utility::rercusive($categories->toArray(),$result);
        }
        return $result;
    }


    /**
     * Get the article
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany('App\Models\Article');
    }

}
