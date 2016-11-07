<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\FAMenu;
use App\Models\Setting;
use App\Models\Social;
/**
 * Class AppController
 * @package App\Http\Controllers
 */
class AppController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->getCommon();
    }

    public function getCommon(){
        $configs = Setting::first();
        $menuTop = FAMenu::where("position",1)->orderBy("hierarchy","ASC")->get();
        $menuFooter = FAMenu::where("position",2)->orderBy("hierarchy","ASC")->get();
        $socials = Social::all();
        \View::share("menuTop",$menuTop);
        \View::share("menuFooter",$menuFooter);
        \View::share("configs",$configs);
        \View::share("socials",$socials);
    }
}