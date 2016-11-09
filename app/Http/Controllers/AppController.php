<?php
namespace App\Http\Controllers;

use App\Common\Utility;
use App\Http\Requests;
use App\Models\FAMenu;
use App\Models\Setting;
use App\Models\Social;
use Faker\Provider\Uuid;
use Illuminate\Encryption\Encrypter;
use Webpatser\Uuid\Uuid as UuidWeb;
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

        //unique cookie
        $ip = Utility::get_client_ip();
        $uuid = UuidWeb::generate(5,$ip,UuidWeb::NS_DNS);
        \View::share("uuid_name", Utility::generateRandomString());
        \View::share("uuid", $uuid);
        \View::share("menuTop",$menuTop);
        \View::share("menuFooter",$menuFooter);
        \View::share("configs",$configs);
        \View::share("socials",$socials);
    }
}