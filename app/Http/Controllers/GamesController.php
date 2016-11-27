<?php
namespace App\Http\Controllers;
use App\Common\Utility;
use App\Models\Article;
use App\Models\Match;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use SEO;

/**
 * Class ArticlesController
 * @package App\Http\Controllers
 */
class GamesController extends AppController
{
    public $request;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct();
    }



    public function index($slug = "")
    {
        if(empty($this->request->get("uuid"))){
            throw new \Exception("Page not found",404);
        }
        $uuid = $this->request->get("uuid");
        if($uuid != $this->uuid){
            throw new \Exception("Page not found",404);
        }
        $player = new Player();
        $newPlayer = $player->savePlayer(["uuid"=>$this->uuid]);
        $sessionid = $this->request->cookie('sessionid');
        $lookPlayer = false;
        $cookie= "";
        if($sessionid != $newPlayer->sessionid && $newPlayer->isNew == false && !empty($newPlayer->password)){
            $lookPlayer = true;
        }else{
            $cookie = cookie('sessionid',$newPlayer->sessionid,null,null,null,false,false);;
        }

        SEO::setTitle("Games");
        SEO::setDescription("Games");
        SEO::opengraph()->setUrl(url("/games"));
        SEO::opengraph()->addProperty('type', 'articles');

        if($lookPlayer == false){
            $view = view('games.index',[
                "player"    => $newPlayer,
                "lookPlayer"    => $lookPlayer
            ]);
            return \Response::make($view)->withCookie($cookie);
        }else{
            return response()->view('games.login');
        }


    }

    public function play(Request $request){

        $betAmount = (!empty($request->input("betAmount")))?$request->input("betAmount"):30;
        $numberOfMine = (!empty($request->input("numberOfMine")))?$request->input("numberOfMine"):1;
        $numberOfMine = preg_replace("/[^0-9]+/i","",$numberOfMine);

        return view('games.play',[
            "betAmount" => $betAmount,
            "numberOfMine" => $numberOfMine
        ]);
    }

    public function share(Request $request){
        $id = Utility::getInt($request->id);
        $random = Utility::removeScripts($request->random);
        $match = Match::with(["players","matchclick"])->where("id",$id)
                        ->where("random_string",$random)
                        ->get()->first();
        if(empty($match)){
            \App::abort(404);
        }
        $matchClick = array_column($match->matchclick->toArray(),"guess");
        $bomb = json_decode($match->minePositions,true);
        $dataMatch = array();
        foreach($matchClick as $item){
            $dataMatch[$item] = true;
        }
        foreach($bomb as $b){
            $dataMatch[$b] = false;
        }
        SEO::setTitle("Games :: ".$match->players->username);
        SEO::setDescription("Games :: ".$match->players->username);
        SEO::opengraph()->setUrl(url("/games/share/$id,$random"));
        SEO::opengraph()->addProperty('type', 'articles');
        return view('games.share',[
            "match" => $match,
            "dataMatch" => $dataMatch
        ]);

    }

    public function login(Request $request){


        $requestParams = ['password','secret'];
        $input = $request->only($requestParams);
        if(!isset($input["secret"]) || empty($input["secret"])){
            throw new \Exception("Invalid data",500);
        }

        $input["secret"] = Utility::removeScripts($input["secret"]);
        $player = new Player();
        $player = $player->getPlayer($input["secret"]);
        $error = "";

        if(!empty($player->password)){
            if(\Hash::check($input["password"], $player->password) == false){
                $error = trans("website.invalid_password");
            }else{
                $sessionid = sha1($player->username.$player->uuid);
               $cookie = cookie('sessionid',$sessionid,null,null,null,false,false);
               return redirect("/games?uuid=".$input["secret"])->withCookie($cookie);
            }
        }else{
            return redirect("/games?uuid=".$input["secret"]);
        }

        return view('games.login',[
            "error" => $error,
        ]);

    }


}