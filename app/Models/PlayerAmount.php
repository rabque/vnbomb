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


    public static function Deposit(Player $player){

        $playerAmount = new PlayerAmount();
        $playerAmount->player_id = $player->id;
        $playerAmount->object_id  = 0;
        $playerAmount->type  = 2;
        $playerAmount->amounts  = 1;
        $insert = $playerAmount->save();
        if($insert == true){
            Player::where("id",$player->id)->update(["type"=>2]);
        }
        return $insert;
    }

}
