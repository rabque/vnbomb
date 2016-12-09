<?php

namespace App\Models;

use App\Common\Utility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webpatser\Uuid\Uuid as UuidWeb;
use Illuminate\Cookie\CookieJar;

class Player extends AppModel
{
	use SoftDeletes;

	protected $table = 'players';

	protected $hidden = [

	];

	protected $guarded = [];

	protected $dates = ['deleted_at'];


	public function savePlayer($input){
		$username = (!empty($input["username"]))?Utility::removeScripts($input["username"]):Utility::generateRandomString();
		$password = (!empty($input["password"]))?Utility::removeScripts($input["password"]):"";
		$uuid = Utility::removeScripts($input["uuid"]);
		try{
			// create user if not exist
			$player = Player::where("uuid",$input["uuid"])->get()->first();
			\DB::beginTransaction();
			if(empty($player)){

				$sessionid = sha1($username.$uuid);
				cookie('sessionid',$sessionid,null,null,null,true,false);
				$player = new Player();
				$player->username = $username;
				//	$player->password = \Hash::make($password);
				$player->uuid = $uuid;
				$player->sessionid = $sessionid;

				$player->save();
				$player->isNew = true;
			}else{
				$update = [];
				if((!empty($input["password"])) && $password != $player->password){
					$update["password"] = \Hash::make($password);
				}
				if((!empty($input["username"])) && $username != $player->username){
					$update["username"] = $username;
				}
				if(!empty($update)){
					self::where("id",$player->id)->update($update);
				}
				$player->isNew = false;
				/*$sessionid = sha1($player->username.$player->uuid);
				\Cookie::queue('sessionid',$sessionid,null,"/games",null,true,false);*/
			}
			\Session::set("players",$player);
			\DB::commit();
			return $player;
		}catch(\Exception $e){
			\DB::rollback();
			throw new \Exception($e->getMessage(). $e->getFile(). $e->getLine(),500);
		}
	}

	public static function getPlayer($uuid,$field = "uuid"){
		if(empty($uuid)) return false;
		$player = Player::where($field,$uuid)->get()->first();
		if(empty($player)){
			throw new \Exception("Invalid data");
		}
		if($player->amount == 0){
			self::where("id",$player->id)->update(["type"=>1]);
			$player->type = 1;
		}else{
			$player->type = 2;
		}
		return $player;
	}

	public static function updatePlayer($input,$uuid, $player = null){
		if(empty($input["username"]) && empty($input["password"])) return false;
		$username = (!empty($input["username"]))?Utility::removeScripts($input["username"]):"";
		$password = (!empty($input["password"]))?Utility::removeScripts($input["password"]):"";
		try{

			// create user if not exist
			$player = (!empty($player))?$player:Player::where("uuid",$uuid)->get()->first();

			\DB::beginTransaction();
			if(!empty($player)){
				$update = [];
				if((!empty($input["password"])) && $password != $player->password){
					$update["password"] = \Hash::make($password);
				}
				if((!empty($input["username"])) && $username != $player->username){
					$update["username"] = $username;
				}
				if(!empty($update)){
					$return = self::where("id",$player->id)->update($update);
				}
			}
			\DB::commit();
			return $return;
		}catch(\Exception $e){
			\DB::rollback();
			throw new \Exception($e->getMessage(),500);
		}
	}

}
