<?php

namespace App\Http\Controllers\LA;

use App\Common\Utility;
use App\Http\Controllers\Controller;
use App\Models\Match;
use App\Models\PlayerAmount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Illuminate\Support\Facades\View;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\Point;

class AnalyticsController extends Controller
{

    public function __construct() {
    }

    /**
     * Display a listing of the Points.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function top_play(Request $request){

        $alldate = $request->all();
        $params = array();
        if(!empty($alldate["start_date"])){
            $params["start_date"] = Utility::removeScripts($alldate["start_date"]);
        }
        if(!empty($alldate["end_date"])){
            $params["end_date"] = Utility::removeScripts($alldate["end_date"]);
        }


        $topPlayer =  PlayerAmount::getTopPlayer($params);



        $assign["topPlayer"] = $topPlayer;
        $assign["params"] = $params;
        return view('la.analytics.top_play', $assign);
    }

    public function top_match(Request $request){

        $alldate = $request->all();
        $params = array();
        if(!empty($alldate["start_date"])){
            $params["start_date"] = Utility::removeScripts($alldate["start_date"]);
        }
        if(!empty($alldate["end_date"])){
            $params["end_date"] = Utility::removeScripts($alldate["end_date"]);
        }
        $topWinMatch =  Match::getTopStake($params);

        $assign["topWinMatch"] = $topWinMatch;
        $assign["params"] = $params;
        return view('la.analytics.top_match', $assign);
    }


    public function proportion(Request $request){

        $alldate = $request->all();
        $params = array();

        $now = Carbon::now()->format("Y-m-d");
        $last7day = Carbon::now()->subWeek(1)->format("Y-m-d");


        if(!empty($alldate["start_date"])){
            $params["start_date"] = Utility::removeScripts($alldate["start_date"]);
        }else{
            $params["start_date"] = $last7day;
        }
        if(!empty($alldate["end_date"])){
            $params["end_date"] = Utility::removeScripts($alldate["end_date"]);
        }else{
            $params["end_date"] = $now;
        }

        if(!empty($alldate["player"])){
            $params["player"] = Utility::removeScripts($alldate["player"]);
        }


        $allGame = PlayerAmount::getDataGame($params);

        $assign["allGame"] = $allGame;
        $assign["params"] = $params;
        return view('la.analytics.proportion', $assign);
    }
}
