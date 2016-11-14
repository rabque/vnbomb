<?php

namespace App\Models;

use App\Common\Utility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use SoftDeletes;
	
	protected $table = 'players';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];


	public function savePlayer($input){
		$username = (!empty($input["username"]))?Utility::removeScripts($input["username"]):Utility::generateRandomString();
		$password = (!empty($input["password"]))?Utility::removeScripts($input["password"]):config("constants.DEFAULT_PASSWORD");
		$uuid = Utility::removeScripts($input["uuid"]);
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

			}
			\DB::commit();
			return $player;
		}catch(\Exception $e){
			\DB::rollback();
			throw new \Exception($e->getMessage(). $e->getFile(). $e->getLine(),500);
		}
	}

	public function getPlayer($uuid){
		if(empty($uuid)) return false;
		$player = Player::where("uuid",$uuid)->get()->first();
		if(empty($player)){
			throw new \Exception("Not found Player");
		}
		return $player;
	}

}
