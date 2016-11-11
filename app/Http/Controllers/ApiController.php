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
}