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

	public function saveMatch($input, Player $player){
		$numberOfMine =  $input["num_mines"];
		$betAmount =(string)$input["bet"];
		try{
			\DB::beginTransaction();
			// create user if not exist
			if(!empty($player)){
				$hash = sha1(UuidWeb::generate(5,$player->uuid.time(),UuidWeb::NS_DNS));
				$match = null;//$this->getMatchbyHash($hash);
				if(empty($match)){
					//Points
					$points = Point::getPointByGameType($numberOfMine);
					if(empty($points)){
						throw new \Exception("Invalid point game type",500);
					}


					$match = new Match();
					$match->game_hash = $hash;
					$match->playerID = $player->uuid;
					$match->bet = $betAmount;
					$match->betNumber = $betAmount;
					$match->gametype = "practice";
					$match->minePositions = $this->minePosition($numberOfMine);
					$match->secret = UuidWeb::generate(5,encrypt(Uuid::uuid()),UuidWeb::NS_DNS);
					$match->next = Utility::calcNextPoint($betAmount,$points["point"][1]);
					$match->stake = $betAmount;
					$match->num_mines = $numberOfMine;
					$match->save();
					$match = $this->getMatchbyHash($match->game_hash);
				}
			}
			\DB::commit();
		}catch(\Exception $e){
			\DB::rollback();
			throw new \Exception($e->getMessage(). $e->getFile(). $e->getLine(),500);
		}

		return $match;
	}

	public function getMatchbyHash($hash = "",$unsetMine = true){
		$data = self::select('id','game_hash','secret','bet','stake','next','betNumber','gametype','num_mines','minePositions','status','playerID')->where("game_hash",$hash)->get()->first();

		if(!empty($data)){
			$data->next = Utility::formatNumber($data->next) ;
			$data->bet = Utility::formatNumber($data->next) ;
			$data->stake = Utility::formatNumber($data->stake) ;
			$data->betNumber = Utility::formatNumber($data->betNumber) ;
			if($unsetMine == true){
				unset($data->minePositions);
			}
		}
		return $data;

	}

	public function minePosition($number = 1){
		$position = array();
		$range = range(1, 25);
		shuffle($range);
		foreach ($range as $value) {
			$position[$value] = $value;
		}
		$rand_keys = array_rand($position,$number);
		if(!is_array($rand_keys)) $rand_keys = array($rand_keys);
		$data = array();
		foreach($rand_keys as $value){
			if(!empty($position[$value])){
				$data[] = $position[$value];
				unset($position[$value]);
			}

		}
		return json_encode($data,true);
	}
}
