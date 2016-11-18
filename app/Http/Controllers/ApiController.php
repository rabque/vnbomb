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
            $match = $match->toArray();
            if($match["status"] == 0){
                $player = (new Player())->getPlayer($match["playerID"]);
                $matchClick = new MatchClick();
                $clickdata = $matchClick->saveClick($input,$match);
                $bit = Utility::bcdiv_cust(Utility::formatNumber($clickdata["next"]) * config("constants.POINT_BIT_VIEW"),1);
                if(!empty($clickdata)){
                    $clickdata["status"] = "success";
                    if($clickdata["outcome"] == "bomb"){
                        $clickdata["message"] = "Game over! You hit a mine on tile <span>{$input['guess']}</span> and lost <span>$bit bits</span> ";
                    }else{

                        $clickdata["message"] = "You found <span>$bit bits</span> in tile {$input['guess']}";
                    }
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

    public function cashout(Request $request){
        $requestParams = ['game_hash'];
        $input = $request->only($requestParams);

        if(empty($input["game_hash"])){
            throw new \Exception("Invalid data",500);
        }
        $match = new Match();
        $match = $match->getMatchbyHash($input["game_hash"],false);
        if(empty($match)){
            throw new \Exception("Invalid game hash ",500);
        }
        $response = [];
        if($match->status != 2){
            $postionBomb = json_decode($match->minePositions,true);
            $random_string = str_random(6);
            $match->update(["status"=>2,"random_string" => $random_string]);
            $response["status"] =  "success";
            $response["win"] =  1;
            $stake =  Utility::convertToSatoshifromBTC($match->stake);
            $response["stake"]  = $stake;
            $response["mines"] =  implode("-",$postionBomb);
            $response["message"] =  "Cashed out $stake practice bits.";
            $response["game_id"] =  $match->id;
            $response["random_string"] =  $random_string;

        }else{
            $response["status"] =  "error";
            $response["message"] =  "Invalid cash out game ";
        }
        return response()->json($response);
    }

    public function getaddr(Request $request){

        $input = $request->only(['secret']);

        if(empty($input["secret"])){
            throw new \Exception("Invalid data",500);
        }

        $response["status"] =  "success";
        $response["address"] =  "19VcUAEk6tW6UFqK9PHxPEeLPFmFdJ4Mit";

        return response()->json($response);
    }
}