<?php
namespace App\Http\Controllers;
use App\Common\Utility;
use App\Models\Match;
use App\Models\MatchClick;
use App\Models\Player;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid as UuidWeb;
/**
 * Class ApiController
 * @package App\Http\Controllers
 */
class ApiController extends AppController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function newgame(Request $request){
        $requestParams = ['bd','bet','num_mines','player_hash'];
        $input = $request->only($requestParams);

        foreach($requestParams as $r){
            if(!isset($input[$r])){
                throw new \Exception("Invalid data",500);
            }
        }
        if(Utility::checkFloat($input["bet"],false) == false){
            $newMatch["status"] = "error";
            $newMatch["message"] = "Invalid bet value";
        }else if($input["bet"] > 1.000000){
            $newMatch["status"] = "error";
            $newMatch["message"] = "The maximum bet is 1,000,000 bits.";
        }else{
            $player = (new Player())->getPlayer($input["player_hash"]);
            //save new game
            $match = new Match();
            $newMatch = $match->saveMatch($input,$player);
            if(!empty($newMatch)){
                $newMatch = $newMatch->toArray();
                $newMatch["status"] = "success";
            }
        }
        return response()->json($newMatch);
    }

    public function checkboard(Request $request){
        $requestParams = ['game_hash','guess','v04'];
        $input = $request->only($requestParams);

        foreach($requestParams as $r){
            if(!isset($input[$r])){
                throw new \Exception("Invalid data",500);
            }
        }
        $clickdata = array();
        if(Utility::checkFloat($input["guess"],false) ){

            //save new game
            $match = new Match();
            $match = $match->getMatchbyHash($input["game_hash"],false);
            if(empty($match)){
                throw new \Exception("Invalid game hash ",500);
            }
            if($match["status"] == 0){
                $player = (new Player())->getPlayer($match["playerID"]);
                $match = $match->toArray();

                $matchClick = new MatchClick();
                $clickdata = $matchClick->saveClick($input,$match);
                if(!empty($clickdata)){
                    $clickdata["status"] = "success";
                    $bit = Utility::formatNumber($clickdata["next"]);
                    $clickdata["message"] = "You found <span>$bit bits</span> in tile {$input['guess']}";
                }
            }else{
                $clickdata["status"] = "error";
                $clickdata["message"] = "You cannot make any more guesses. This game is already over";
            }


        }else{
            $clickdata["status"] = "error";
            $clickdata["message"] = "Invalid click value";
        }

        return response()->json($clickdata);
    }

}