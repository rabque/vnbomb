<?php
/**
 * Created by PhpStorm.
 * User: hungln
 * Date: 10/30/16
 * Time: 2:46 AM
 */

namespace App\Models;


use Dwij\Laraadmin\Models\Module;
use Illuminate\Support\Facades\DB;

class AppModules extends Module
{

    /**
     * Get Module Access for role and access type
     * Module::hasAccess($module_id, $access_type, $user_id);
     **/
    public static function hasAccessModule($module_id, $access_type = "view", $user_id = 0) {
        $roles = array();

        if(is_string($module_id)) {
            $module = Module::get($module_id);
            $module_id = $module->id;
        }

        if($access_type == null || $access_type == "") {
            $access_type = "view";
        }

        if($user_id) {
            $user = \App\User::find($user_id);
            if(isset($user->id)) {
                $roles = $user->roles();
            }
        } else {
            $roles = \Auth::user()->roles();
        }
        foreach ($roles->get() as $role) {
            $module_perm = DB::table('role_module')->where('role_id', $role->id)->where('module_id', $module_id)->first();
            if(isset($module_perm->id)) {
                if(isset($module_perm->{"acc_".$access_type}) && $module_perm->{"acc_".$access_type} == 1) {
                    return true;
                }
            }
        }
        return false;
    }
}