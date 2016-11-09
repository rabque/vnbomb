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


	public function saveMatch($input){
		$username = Utility::removeScripts($input["username"]);
		$password = Utility::removeScripts($input["password"]);
		$password = (empty($password))?$password:config("constants.DEFAULT_PASSWORD");
		$uuid = Utility::removeScripts($input["uuid"]);
		$clickMatch = Utility::removeScripts($input["clickMatch"]);


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
				$hash =UuidWeb::generate(5,$playerId,UuidWeb::NS_DNS);
				$match = $this->getMatchbyHash($hash);
				$matchId = "";
				if(empty($match)){
					$match = new Match();
					$match->matchID = Uuid::uuid();
					$match->playerID = $playerId;
					$match->betAmount = 0;
					$match->isPracticeMatch = 1;
					$match->minePositions = "";
					$match->secrectString = "";
					$match->hash = $hash;
					$match->clickHistory  = json_encode($clickMatch);
					$match->save();
					$matchId = $match->matchID;
				}else{
					$matchId = $match->matchID;
				}

				$MatchClick = new MatchClick();
				$MatchClick->matchID = $matchId;
				$MatchClick->clickHistory = json_encode($clickMatch);
				$MatchClick->save();
			}

			\DB::commit();
		}catch(\Exception $e){
			\DB::rollback();
			throw new \Exception($e->getMessage(),500);
		}
	}

	public function getMatchbyHash($hash = ""){
		return self::where("hash",$hash)->get()->first();
	}
}
