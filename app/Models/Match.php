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
		$betAmount = $input["bet"];
		try{
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
					$match->next = $betAmount * ($points["point"][1]/100);
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

	public function getMatchbyHash($hash = ""){
		return self::select('id','game_hash','secret','bet','stake','next','betNumber','gametype','num_mines')->where("game_hash",$hash)->get()->first();
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
