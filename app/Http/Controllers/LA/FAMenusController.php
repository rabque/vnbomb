<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FAMenu;
use App\Models\Language;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

use Dwij\Laraadmin\Models\Module;

class FAMenusController extends Controller
{

    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $position = (!empty($request->get("position")))?$request->get("position"):1;
        $language_value = (!empty($request->get("language")))?$request->get("language"):1;
        $modules = Module::whereIn("id",array(11,12))->get();
        $categories = Category::getTree();
        $menuItems = FAMenu::where("parent", 0)
                        ->where("position",$position)
                        ->where("lang",$language_value)
                        ->orderBy('hierarchy', 'asc')->get();

        $language = Language::all()->toArray();
        $language = (!empty($language))?array_column($language,"name","id"):[];
        $request->session()->put('lang_menu', $language_value);
        return View('la.famenus.index', [
            'menus' => $menuItems,
            'categories' => $categories,
            'modules'   => $modules,
            'position_value'   => $position,
            'language_value'   => $language_value,
            'language'  => $language
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = Input::get('name');
        $url = Input::get('url');
        $type = Input::get('type');
        $position = Input::get('position');
        $table = Input::get('table');
        $langmenu = $request->session()->get('lang_menu', 1);

        if($table == "module") {
            $module_id = Input::get('module_id');
            $module = Module::find($module_id);
            if(isset($module->id)) {
                $name = $module->name;
                $url = $module->name_db;
            } else {
                return response()->json([
                    "status" => "failure",
                    "message" => "Module does not exists"
                ], 200);
            }
        }
        $subCategory = array();
        if($table == "categories") {
            $module_id = Input::get('module_id');
            $category = Category::with('subcategory')->find(array("id"=>$module_id))->first();
            if(isset($category->id)) {
                $name = $category->name;
                $url = $category->slug. \Config::get("constants.PREFIX_URL");
                if(!empty($category->subcategory)){
                    $subCategory = $category->getRelations();
                    $subCategory = $subCategory["subcategory"];
                }
            } else {
                return response()->json([
                    "status" => "failure",
                    "message" => "Category does not exists"
                ], 200);
            }
        }

        $menuid = FAMenu::create([
            "name" => $name,
            "url" => $url,
            "type" => $type,
            "position" => $position,
            "parent" => 0,
            "lang"  => $langmenu
        ]);
        if(!empty($menuid) && !empty($subCategory)){
            foreach ($subCategory as $sub){
                if(!empty($sub->slug)){
                    FAMenu::create([
                        "name" => $sub->name,
                        "url" => $sub->slug,
                        "type" => $type,
                        "parent" => $menuid->id,
                        "lang"  => $langmenu
                    ]);
                }

            }
        }
        if($type == "module") {
            return response()->json([
                "status" => "success"
            ], 200);
        } else {
            return redirect(config('laraadmin.adminRoute').'/famenus?position='.$position.'&language='.$langmenu);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $ftypes = ModuleFieldTypes::getFTypes2();
        // $module = Module::find($id);
        // $module = Module::get($module->name);
        // return view('la.modules.show', [
        //     'no_header' => true,
        //     'no_padding' => "no-padding",
        //     'ftypes' => $ftypes
        // ])->with('module', $module);
    }

    /**
     * Update Custom FAMenu
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = Input::get('name');
        $url = Input::get('url');
        $type = Input::get('type');
        $langmenu = $request->session()->get('lang_menu', 1);

        $menu = FAMenu::find($id);
        $menu->name = $name;
        $menu->url = $url;
        $menu->lang = $langmenu;
        $menu->save();

        return redirect(config('laraadmin.adminRoute').'/famenus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $position = 1;
        $menu = FAMenu::find($id);
        $position = $menu->position;
        $menu->delete();
        $child = FAMenu::where(array("parent"=>$id))->get();
        $langmenu = \Session::get('lang_menu', 1);
        foreach ($child as $value){
            if(!empty($value->id)){
                FAMenu::find($value->id)->delete();
            }
        }
        // Redirecting to index() method for Listing
        return  redirect(config('laraadmin.adminRoute').'/famenus?position='.$position.'&language='.$langmenu);
    }

    /**
     * Update FAMenu Hierarchy
     *
     * @return \Illuminate\Http\Response
     */
    public function update_hierarchy()
    {
        $parents = Input::get('jsonData');
        $parent_id = 0;

        for ($i=0; $i < count($parents); $i++) {
            $this->apply_hierarchy($parents[$i], $i+1, $parent_id);
        }

        return $parents;
    }

    function apply_hierarchy($menuItem, $num, $parent_id)
    {
        // echo "apply_hierarchy: ".json_encode($menuItem)." - ".$num." - ".$parent_id."  <br><br>\n\n";
        $menu = FAMenu::find($menuItem['id']);
        $menu->parent = $parent_id;
        $menu->hierarchy = $num;
        $menu->save();

        if(isset($menuItem['children'])) {
            for ($i=0; $i < count($menuItem['children']); $i++) {
                $this->apply_hierarchy($menuItem['children'][$i], $i+1, $menuItem['id']);
            }
        }
    }
}
