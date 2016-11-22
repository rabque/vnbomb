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
		return $this->hasMany('App\Models\MatchClick', 'game_hash', 'game_hash');
	}

	public function players()
	{
		return $this->belongsTo('App\Models\Player', 'playerID','uuid');
	}


	public function saveMatch($input, Player $player){
		$numberOfMine =  $input["num_mines"];
		$betAmount = $input["bet"];
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
					$match->default_stake = $betAmount;

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
		$data = self::select('id','game_hash','secret','bet','stake','next','betNumber','gametype','num_mines','minePositions','status','playerID','default_stake')->where("game_hash",$hash)->get()->first();

		if(!empty($data)){
			$data->next = Utility::formatBTC($data->next) ;
			$data->bet = Utility::formatBTC($data->bet) ;

			$data->stake = Utility::formatBTC($data->stake) ;
			$data->betNumber = Utility::formatBTC($data->betNumber) ;
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

	public static function liveGame(){
		$data = Match::with("players")
						->with("matchclick")
						->limit(10)
						->orderBy("match.id","DESC")
						->get();
		$live = array();
		if(!empty($data)){
			foreach($data as $value){
				$profit = $value->stake - $value->bet;
				$relations = $value->getRelations();
				$matchClick = array();
				$boms = json_decode($value->minePositions,true) ;
				if(!empty($relations['matchclick'])){
					$relations['matchclick'] = $relations['matchclick']->toArray();
					$relations['matchclick'] = array_column($relations['matchclick'],"guess");
					foreach(range(1,25) as $numb){
						$matchClick[$numb] = 0;
						if(in_array($numb,$relations['matchclick'])){
							$matchClick[$numb] = 1;
						}
						if(in_array($numb,$boms)){
							$matchClick[$numb] = 2;
						}
					}
				}
				$label = config("constants.LABEL");

				$live[] = array(
					"name" => $relations['players']->username,
					"bet" => Utility::formatNumber($value->bet),
					"win" => Utility::formatNumber($value->stake),
					"profit" =>  Utility::formatNumber($profit),
					"hash" => $value->game_hash,
					"secret" => $value->secret,
					"match_click" => Utility::builHtmlClick($matchClick),
					"label" =>$label[array_rand(range(0,5))]
				);
			}
		}
		return $live;
	}

	public static function topToday($limit = 5){
		$data = Match::with("players")
			->select(\DB::raw("SUM(match.bet) as amount_bet"),\DB::raw("SUM(match.stake) as amount_won"),\DB::raw("COUNT(match.playerID) as total_win"),"playerID")
			->groupBy("match.playerID")
			->limit($limit)
			->orderBy("match.id","DESC")
			->get();
		$live = array();
		if(!empty($data)){
			$numberFormat = new \NumberFormatter("it-IT", \NumberFormatter::DECIMAL);
			foreach($data as $value){
				$relations = $value->getRelations();
				$label = config("constants.LABEL");
				$live[] = array(
					"name" => $relations['players']->username,
					"amount_bet" => Utility::formatNumber($value->amount_bet),
					"amount_won" => Utility::formatNumber($value->amount_won),
					"total_win" => $numberFormat->format($value->total_win),
					"label" =>$label[array_rand(range(0,5))]
				);
			}
		}
		return $live;
	}

	public static function topWeek($limit = 10){
		$startdate = date('Y-m-d', strtotime('last Monday'));
		$enddate = date('Y-m-d', strtotime('next Sunday'));


		$data = Match::with("players")
			->with("matchclick")
			->whereBetween(\DB::raw("DATE_FORMAT(match.created_at,'%Y-%m-%d')"),array($startdate,$enddate))
			->limit($limit)
			->orderBy("match.id","DESC")
			->get();
		$topWeek = array();
		if(!empty($data)){
			$numberFormat = new \NumberFormatter("it-IT", \NumberFormatter::DECIMAL);
			foreach($data as $value){
				$relations = $value->getRelations();
				$matchClick = array();
				$click = array();
				$next = 0;
				$boms = json_decode($value->minePositions,true) ;
				if(!empty($relations['matchclick'])){
					$matchClick = $relations['matchclick']->toArray();
					foreach($matchClick as $item){
						$next = $next + $item["next"];
					}
					$next = Utility::formatNumber($next);

					$relations['matchclick'] = $relations['matchclick']->toArray();
					$relations['matchclick'] = array_column($relations['matchclick'],"guess");
					foreach(range(1,25) as $numb){
						$click[$numb] = 0;
						if(in_array($numb,$relations['matchclick'])){
							$click[$numb] = 1;
						}
						if(in_array($numb,$boms)){
							$click[$numb] = 2;
						}
					}

				}

				$label = config("constants.LABEL");
				$stake = Utility::formatNumber($value->stake);
				$bet = Utility::formatNumber($value->bet);

				$winx = ($stake>$bet)?$value->stake/$value->bet:0;
				$topWeek[] = array(
					"name" => $relations['players']->username,
					"bet" => Utility::formatNumber($value->bet),
					"stake" => Utility::formatNumber($value->stake),
					"winx" => $numberFormat->format($winx),
					"next" => $next,
					"match_click" => Utility::builHtmlClick($click),
					"label" =>$label[array_rand(range(0,5))]
				);
			}
		}
		return $topWeek;
	}




}
