<?php

namespace App\Models;


use App\Common\Utility;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlayerAmount extends AppModel
{
   // use SoftDeletes;

    protected $table = 'player_amounts';

    protected $hidden = [

    ];

    protected $guarded = [];

    protected $dates = ['deleted_at'];


    public static function Deposit(Player $player){

        $playerAmount = new PlayerAmount();
        $playerAmount->player_id = $player->id;
        $playerAmount->object_id  = 0;
        $playerAmount->type  = 1;
        $playerAmount->amounts  = 1;

        $insert = $playerAmount->save();
        if($insert == true){
            Player::where("id",$player->id)->update([
                "type"=>2,
                "deposit"  => $player->deposit + 1
            ]);
        }
        return $insert;
    }

    public static function getTopPlayer($params = array()){
        $query = \DB::table("player_amounts")
            ->select(\DB::raw('SUM(player_amounts.amounts) as total_amount,count(player_amounts.id) as total_win,players.username'))
            ->join("players","players.id","=","player_amounts.player_id")
            ->where('player_amounts.type', 3);

            if(!empty($params["start_date"])){
                $query->whereDate("player_amounts.created_at",">=",$params["start_date"]);
            }

            if(!empty($params["end_date"])){
                $query->whereDate("player_amounts.created_at","<=",$params["end_date"]);
            }
           $result = $query->groupBy('player_amounts.player_id')
            ->orderBy("total_win","DESC")
            ->paginate(config("constants.NUMBER_PAGE"));
        return $result;
    }

    public static function getAllGame(){
        $now = Carbon::now()->format("Y-m-d");
        $last7day = Carbon::now()->subWeek(1)->format("Y-m-d");

        $result = self::whereRaw("(DATE_FORMAT(created_at,'%Y-%m-%d') between '$last7day' AND '$now')")
                        ->whereIn("type",[2,3,4])
                        ->get();
        return $result;
    }

    public static function getDataGame($params = array()){

        $query = \DB::table("player_amounts")
            ->select('player_amounts.*','players.username','match.game_hash')
            ->join("players","players.id","=","player_amounts.player_id")
            ->join("match","match.id","=","player_amounts.object_id")
            ->whereIn("player_amounts.type",[2,3,4]);

         if(!empty($params["start_date"])){
             $query->whereDate("player_amounts.created_at",">=",$params["start_date"]);
         }

        if(!empty($params["end_date"])){
            $query->whereDate("player_amounts.created_at","<=",$params["end_date"]);
        }
        if(!empty($params["player"])){
            $player = Utility::removeScripts($params["player"]);
            $query->where("players.username","LIKE","%$player%");
        }

        $result = $query->orderBy("player_amounts.id","DESC")
            ->paginate(config("constants.NUMBER_PAGE"));
        return $result;
    }

}
