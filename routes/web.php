<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::auth();

Route::get('/', function(App\Models\AppModel $model)
{
    $model->setSeoDefault();
    $app = app();
    $class = 'App\Http\Controllers\IndexController';
    $controller = $app->make($class);
    return $controller->callAction('index', array());
});
$admin = config('laraadmin.adminRoute');
$notRoute = array($admin,"logout","login","games");
$pathName = explode("/",Request::getPathInfo());
$pathName = (!empty($pathName[1]))?$pathName[1]:0;
if (!in_array($pathName,$notRoute))
{
    Route::resource('articles', 'ArticleController');

    /* ================== Homepage ================== */


    Route::get('/{slug}', function(App\Models\AppModel $model,$slug) {
        $app = app();
        $slug = str_replace(config("constants.PREFIX_URL"),"",$slug);
        $route = $model->getSlug($slug);
        $method = "index";
        if(!empty($route->module_id)){
            $class = 'App\Http\Controllers\\'.$route->module_id.'Controller';
            $method = "map";
        }else{
            $clsName = studly_case($slug);
            $class = 'App\Http\Controllers\\'.$clsName.'Controller';
        }
        if(class_exists($class)){
            $controller = $app->make($class);
            Request::merge((array)$route);
            return $controller->callAction($method, array("slug"=>$slug));
        }else{
            App::abort(404,"Page not found");
        }
    })->where('slug', '[a-z0-9-.]+');
}
Route::get('games', "GamesController@index");
Route::get('games/share/{id}/{random}', "GamesController@share")->where(['id' => '[0-9]+', 'random' => '[a-zA-Z0-9]+']);
Route::post('games/login', "GamesController@login");

/* ================== Homepage + Admin Routes ================== */

Route::group(array('before' => 'auth'), function () {
    $admFileManage = Config::get("lfm.prefix");
    Route::get("/$admFileManage", '\Unisharp\Laravelfilemanager\controllers\LfmController@show');
    Route::post("/$admFileManage/upload", '\Unisharp\Laravelfilemanager\controllers\LfmController@upload');
    // list all lfm routes here...

});

Route::get('showImage/{w}/{h}/{src}', function ($w , $h = 0 , $src)
{
    $img_path = public_path().'/'.$src;
    if(empty($src) || !is_file($img_path)){
        $img_path = public_path().'/img/no-image.png';
    }
    $with = \Config::get("constants.IMG_WITH");
   // $height = \Config::get("constants.IMG_HEIGHT");
    if(empty($w)){
        $w = $with;
    }
    if(!empty($h)){
        $img = Image::make($img_path)->resize($w,$h);
    }else{
        $img = Image::make($img_path)->resize($w);
    }

    return $img->response('jpg');
})->where('src', '[A-Za-z0-9\/\.\-\_]+');

require __DIR__.'/admin_routes.php';