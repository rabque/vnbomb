<?php
namespace App\Http\Controllers;
use App\Common\Utility;
use App\Models\Match;
use App\Models\Player;
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

    public function match(Request $request)
    {

        $input = $request->only(['uuid','username', 'password','clickMatch','betAmount','numberOfMine','token']);
        $match = new Match();
        $newMatch = $match->saveMatch($input);
        $data = array();
        if($newMatch->isPracticeMatch == 1){
            $data["success"] = true;
        }else{
            $data["success"] = false;
            $minePositions = json_decode($newMatch->minePositions,true);
            $minePositions = implode(",",$minePositions);
            $data["minePositions"] = $minePositions;
            $data["secrectString"] = $newMatch->secrectString;
            $data["hash"] = $newMatch->hash;
        }
        $mineClick = array();
        if(!empty($newMatch->matchclick)){
            foreach($newMatch->matchclick as $click){
                $position = json_decode($click->clickHistory,true);
                $position = (!empty($position))?"{$position['x']},{$position['y']}":"";
                $mineClick[] = array("point"=>$click->point,"position"=>$position);
            }
        }
        $data["click"] = $mineClick;
        $data["betAmount"] = $newMatch->betAmount;

        return response()->json($data);
    }



    public function newgame(Request $request){
        $requestParams = ['bd','bet','num_mines','player_hash'];
        $input = $request->only($requestParams);

        foreach($requestParams as $r){
            if(!isset($input[$r])){
                throw new \Exception("Invalid data",500);
            }
        }


        $player = (new Player())->getPlayer($input["player_hash"]);
        //save new game
        $match = new Match();
        $newMatch = $match->saveMatch($input,$player);
        if(!empty($newMatch)){
            $newMatch = $newMatch->toArray();
            $newMatch["status"] = "success";
        }
        return response()->json($newMatch);
    }

}