<?php
namespace App\Http\Controllers;

use App\Common\Utility;
use App\Http\Requests;
use App\Models\FAMenu;
use App\Models\Setting;
use App\Models\Social;
use Webpatser\Uuid\Uuid as UuidWeb;
use Illuminate\Routing\Route;
use Session;
/**
 * Class AppController
 * @package App\Http\Controllers
 */
class AppController extends Controller
{
    public $uuid = "";
    public $cointrollerName='';
    public $actionName='';
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

        $configs = Setting::language()->get()->first();
        $menuTop = FAMenu::language()->where("position",1)->orderBy("hierarchy","ASC")->get();
        $menuFooter = FAMenu::language()->where("position",2)->orderBy("hierarchy","ASC")->get();
        $socials = Social::all();

        //unique cookie
        $ip = Utility::get_client_ip();
        $this->uuid = $uuid = sha1(UuidWeb::generate(5,$ip,UuidWeb::NS_DNS));
        Session::put("uuid",$uuid);
        \View::share("uuid", $uuid);
        \View::share("menuTop",$menuTop);
        \View::share("menuFooter",$menuFooter);
        \View::share("configs",$configs);
        \View::share("socials",$socials);
    }
}