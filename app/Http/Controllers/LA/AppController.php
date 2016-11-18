<?php
/**
 * Created by PhpStorm.
 * User: hungln
 * Date: 10/30/16
 * Time: 11:53 PM
 */

namespace app\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\Language;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function __construct() {
        $lang = Language::get();
        $lang = array_column($lang->toArray(),"name","id");
        $lang[0] = "Language";
        ksort($lang);
        \View::share("languages", $lang);
    }
    public function sort(Request $request){
        if($request->isMethod("POST")){
            $id = $request->input("id");
            $sort = Utility::getInt($request->input("sort"));
            $Module = $request->input("module");

            $update = $Module::where(["id"=>$id])->update(["sort"=>$sort]);
            return response()->json([
                "id"=>$id,"sort"=>$sort
            ]);

        }else{
            throw new \Exception("Invalid method");
        }
    }

    public function updateFields(Request $request){

        if($request->isMethod("POST")){
            $id = $request->input("id");
            $status = Utility::getIntArr($request->input("status"),[1,2]);
            $fields = $request->input("fields");
            $Module = $request->input("module");

            $update = $Module::where(["id"=>$id])
                ->update([$fields=>$status]);

            $icons = '<i class="fa fa-times" aria-hidden="true"></i>';
            $class = 'btn-danger';
            if($update == true){
                if($status == 1){
                    $icons = '<i class="fa fa-check" aria-hidden="true"></i>';
                    $class = "btn-success";
                }
            }
            return response()->json([
                "success"=>$update,"icons"=>$icons,"class_name" => $class
            ]);

        }else{
            throw new \Exception("Invalid method");
        }

    }
}