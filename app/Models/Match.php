<?php

namespace App\Models;

use App\Common\Utility;
use Faker\Provider\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\HttpFoundation\Request;
use Webpatser\Uuid\Uuid as UuidWeb;

class Match extends Model
{
    use SoftDeletes;
	
	protected $table = 'match';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

	public function matchclick()
	{
		return $this->hasMany('App\Models\MatchClick', 'matchID', 'matchID');
	}

	public function saveMatch($input){
		$username = Utility::removeScripts($input["username"]);
		$password = Utility::removeScripts($input["password"]);
		$password = (empty($password))?$password:config("constants.DEFAULT_PASSWORD");
		$uuid = Utility::removeScripts($input["uuid"]);
		$clickMatch = Utility::removeScripts($input["clickMatch"]);
		$numberOfMine =  (int)Utility::removeScripts($input["numberOfMine"]);
		$betAmount = (int) Utility::removeScripts($input["betAmount"]);
		$token = Utility::removeScripts($input["token"]);
		$isWin = true;
		$matchId = 0;
		try{
			// create user if not exist
			$player = Player::where("uuid",$input["uuid"])->get()->first();
			\DB::beginTransaction();
			if(empty($player)){

				$player = new Player();
				$player->username = $username;
				$player->password = \Hash::make($password);
				$player->uuid = $uuid;
				$player->save();
				$playerId = $uuid;
			}else{
				$playerId = $player->uuid;
			}

			if(!empty($playerId)){
				$hash = UuidWeb::generate(5,$playerId.$token,UuidWeb::NS_DNS);
				$match = $this->getMatchbyHash($hash);
				$matchId = UuidWeb::generate(5,$token,UuidWeb::NS_DNS);;
				if(empty($match)){
					$match = new Match();
					$match->matchID = $matchId;
					$match->playerID = $playerId;
					$match->betAmount = (!empty($betAmount))?$betAmount:0;
					$match->isPracticeMatch = 1;
					$match->minePositions = $this->minePosition($numberOfMine);
					$match->secrectString = UuidWeb::generate(5,encrypt(Uuid::uuid()),UuidWeb::NS_DNS);
					$match->hash = $hash;
					$match->clickHistory  = json_encode($clickMatch);
					$match->save();
					$matchId = $match->matchID;
				}else{
					$matchId = $match->matchID;
					$minePositions = json_decode($match->minePositions,true);
					$click = "({$clickMatch['x']}x{$clickMatch['y']})";
					$isBomb = array_search($click,$minePositions);
					if($isBomb !== false){
						$isWin == false;
						self::where("matchID",$matchId)->update(array("isPracticeMatch"=>2));
					}
				}
				if($isWin == true){
					$exist = MatchClick::where("clickHistory",json_encode($clickMatch))
										->where("matchID",$matchId)->get()->first();
					if(empty($exist)){
						$MatchClick = new MatchClick();
						$MatchClick->matchID = $matchId;
						$MatchClick->clickHistory = json_encode($clickMatch);
						$MatchClick->save();
					}
				}

			}

			\DB::commit();
		}catch(\Exception $e){
			\DB::rollback();
			throw new \Exception($e->getMessage(). $e->getFile(). $e->getLine(),500);
		}
		$data = array();
		if(!empty($matchId)){
			$data = self::with("matchclick")->where("matchID",$matchId)->get()->first();
		}
		return $data;
	}

	public function getMatchbyHash($hash = ""){
		return self::where("hash",$hash)->get()->first();
	}

	public function minePosition($number = 1){
		$x = $y = array(0,1,2,3,4);
		$position = array();
		foreach($x as $k=>$v){
			foreach($y as $v2){
				$position[] = "($v"."x"."$v2)";
			}
		}

		shuffle($position);

		$rand_keys = array_rand($position,$number);
		if(!is_array($rand_keys)) $rand_keys = array($rand_keys);
		$data = array();
		foreach($rand_keys as $value){
			$data[] = $position[$value];
			unset($position[$value]);
		}
		return json_encode($data,true);
	}
}
