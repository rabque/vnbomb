<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class PlayerAffiliate extends AppModel
{
    use SoftDeletes;

    protected $table = 'player_affiliates';

    protected $hidden = [

    ];

    protected $guarded = [];

    protected $dates = ['deleted_at'];


    public static function saveAffiliate($match,$affiliate){
        if(empty($match) || empty($affiliate)) return false;
        $setting_games = Setting_Game::find(1);
        $data = new PlayerAffiliate();
        $data->player_id = $match->player_id;
        $data->match_id  = $match->id;
        $data->player_affiliate_id  = $affiliate->player_id;
        $data->affiliate_id  = $affiliate->id;

        $amount = ($match->stake*$setting_games->affiliate)/100;
        $data->amount  = $amount;
        $insert = $data->save();

        return $insert;
    }

}
