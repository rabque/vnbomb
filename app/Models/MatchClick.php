<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchClick extends Model
{
    use SoftDeletes;
	
	protected $table = 'match_click';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];


	public function saveClick($input,$match){
		$click = $input["guess"];
		//Points
		$points = Point::getPointByGameType($match["num_mines"]);
		if(empty($points)){
			throw new \Exception("Invalid point game type",500);
		}
		$lastClick = self::where("matchID",$match["game_hash"])->get();
		$stake = $match["stake"];
		$lastNext = 0;
		if(!empty($lastClick)){
			foreach($lastClick as $value){
				$stake = $stake + $value->stake;
				$lastNext = $value->next;
			}
		}
		$next = ($stake * ($points["point"][$click]/100));
		$stake = $stake + $next;
		$matchClick = new MatchClick();
		$matchClick->matchID = $input["game_hash"];
		$matchClick->guess = $click;
		$matchClick->stake = $stake;
		$matchClick->next = $next;
		$matchClick->change = $lastNext;
		$matchClick->outcome = "bitcoins";
		$id = $matchClick->save();
		$matchClick = self::select("guess","outcome","stake","next","change")->where("id",$id)->get()->first()->toArray();
		return $matchClick;

	}
}
