<?php
namespace App\Models;

use App\Common\Utility;
use Illuminate\Database\Eloquent\Model;
use SEO;
use Illuminate\Database\Eloquent\Builder;
class AppModel extends Model
{
    public static function boot()
    {
        parent::boot();

        // registering a callback to be executed upon the creation of an activity AR
        static::creating(function($activity) {
            self::processAtributes($activity);
        });

        static::updating(function($activity) {
           self::processAtributes($activity);
        });
        /*static::addGlobalScope('lang', function (Builder $builder)  {
            $language = (\Session::exists("locate"))?\Session::get("locate"):"en";
            $builder->where('lang', $language);
        });*/


    }


    /**
     * Scope a query to only include language users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLanguage($query)
    {
        $language = (\Session::exists("locate_value"))?\Session::get("locate_value"):1;
        return $query->where('lang', $language);
    }

    protected static function processAtributes(&$activity){
        $table = $activity->getTable();
        $arrImg = array("image","logo","favicon");
        foreach($arrImg as $col){
            if(\Schema::hasColumn($table,$col)){
                $activity->{$col} = str_replace(array(url("/")),"",$activity->{$col});
                $activity->{$col} = str_replace("/uploads","uploads",$activity->{$col});
                $activity->{$col} = preg_replace('/([^:])(\/{2,})/', '$1/', $activity->{$col});
            }
        }
        if(\Schema::hasColumn($table,'slug') && \Schema::hasColumn($table,'name')){
            $activity->slug = \Str::slug($activity->name);
        }
    }


    public function getSlug($slug = ""){
        if(empty($slug)) return false;

        $table = array("articles","categories");
        $i=0;
        $bind = array();
        $sql = "";

        foreach($table as $value){
           $sql .= "Select module_id,'$value' as tableName,metaTitle,metaDes,metaKey from $value where slug = ?";

           $i++;
            if($i < count($table)){
                $sql .= " UNION ALL ";
            }

            $bind[] = $slug;
        }
        $data = \DB::selectOne($sql,$bind);
        if(!empty($data)){
            SEO::setTitle($data->metaTitle);
            SEO::setDescription($data->metaDes);
            SEO::opengraph()->setUrl(url($slug.config("constants.PREFIX_URL")));
            SEO::opengraph()->addProperty('type', 'articles');
        }
        return $data;
    }

    public function setSeoDefault(){
        $configs = Setting::first();

        if(!empty($configs)){
            SEO::setTitle($configs->metaTitle);
            SEO::setDescription($configs->metaDes);
            SEO::opengraph()->setUrl(url("/"));
            SEO::opengraph()->addProperty('type', 'articles');
        }
    }

}
