<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class PlayerAmount extends AppModel
{
    use SoftDeletes;

    protected $table = 'player_amounts';

    protected $hidden = [

    ];

    protected $guarded = [];

    protected $dates = ['deleted_at'];


    public static function Deposit($uuid = ""){
        if(empty($uuid)) return false;
        $player = (new Player())->getPlayer($uuid);
        if(empty($player)){
            throw new \Exception("invalid player",500);
        }
        $playerAmount = new PlayerAmount();
        $playerAmount->player_id = $player->id;
        $playerAmount->object_id  = 0;
        $playerAmount->type  = 2;
        $playerAmount->amounts  = 1;
        $insert = $playerAmount->save();
        if($insert == true){
            Player::where("uuid",$uuid)->update(["type"=>2]);
        }
        return $insert;
    }

}
