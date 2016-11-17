<?php

namespace App\Models;

use App\Common\Utility;
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
		//Check is click
		$isClick = self::where("matchID",$match["game_hash"])->where("guess",$click)->get()->first();
		if(!empty($isClick)) throw new \Exception("Invalid click data",500);

		$lastClick = self::where("matchID",$match["game_hash"])->get();
		try{
			\DB::beginTransaction();
			// create user if not exist
			$stake = $match["stake"];
			$lastNext = 1;
			$numberNext = 1;
			$numberLastNext = 0;
			if(!empty($lastClick)){
				foreach($lastClick as $value){
					//$stake = $stake + $value->stake;
					$numberLastNext = $numberLastNext + $value->next;
					$lastNext = $numberNext;
					$numberNext++;
				}
			}else{
				$numberNext = 2;
			}

			$next = Utility::calcNextPoint($match["default_stake"],$points["point"][$numberNext]);
			//$numberLastNext = (!empty($numberLastNext))?$numberLastNext:$next;
			$random_string = str_random(6);
			$matchClick = new MatchClick();
			$matchClick->matchID = $input["game_hash"];
			$matchClick->guess = $click;
			$matchClick->stake = $match["default_stake"] + $numberLastNext + $next;
			$matchClick->next = $next;
			$matchClick->change = Utility::calcNextPoint($match["default_stake"],$points["point"][$lastNext]);
			$matchClick->random_string = $random_string;

			$postionBomb = json_decode($match["minePositions"],true);
			$isWin = true;
			if(in_array($click,$postionBomb)){
				$matchClick->outcome = "bomb";
				$isWin = false;
			}else{
				$matchClick->outcome = "bitcoins";
			}
			$matchClick->save();
			$newmatchClick = $this->getMatchClick($matchClick->id,$isWin);

			$totalNext = $numberLastNext+$match["stake"]+$next;

			if($isWin == false){
				$newmatchClick["bombs"] = implode("-",$postionBomb);
				$newmatchClick["game_id"] = $match["id"];
				$secret = implode("-",$postionBomb) . "-" . $random_string;
				Match::where("game_hash",$match["game_hash"])->update(["secret_click"=>$secret,"status"=>1,"random_string" =>$random_string]);
				//
			}else{
				Match::where("game_hash",$match["game_hash"])->update(["stake"=>$totalNext]);
			}
			\DB::commit();
			return $newmatchClick;

		}catch(\Exception $e){
			\DB::rollback();
			throw new \Exception($e->getMessage(). $e->getFile(). $e->getLine(),500);
		}
	}

	public function getMatchClick($id,$usset = true){
		$data = self::select("guess","outcome","stake","next","change","random_string")->where("id",$id)->get()->first();
		if(!empty($data)){
			$data->next = Utility::formatBTC($data->next) ;
			$data->change = Utility::formatBTC($data->next) ;
			$data->stake = Utility::formatBTC($data->stake) ;
			if($usset == true){
				unset($data->game_id);
				unset($data->random_string);
			}
			$data = $data->toArray();
		}
		return $data;
	}

}
