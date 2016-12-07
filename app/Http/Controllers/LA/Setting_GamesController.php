<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\Setting_Game;

class Setting_GamesController extends Controller
{
	public $show_action = true;
	public $view_col = 'affiliate';
	public $listing_cols = ['id', 'affiliate', 'withdraw'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Setting_Games', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Setting_Games', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Setting_Games.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Setting_Games');
		
		if(Module::hasAccess($module->id)) {
			return View('la.setting_games.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new setting_game.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created setting_game in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Setting_Games", "create")) {
		
			$rules = Module::validateRules("Setting_Games", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Setting_Games", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.setting_games.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified setting_game.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Setting_Games", "view")) {
			
			$setting_game = Setting_Game::find($id);
			if(isset($setting_game->id)) {
				$module = Module::get('Setting_Games');
				$module->row = $setting_game;
				
				return view('la.setting_games.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('setting_game', $setting_game);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("setting_game"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified setting_game.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Setting_Games", "edit")) {			
			$setting_game = Setting_Game::find($id);
			if(isset($setting_game->id)) {	
				$module = Module::get('Setting_Games');
				
				$module->row = $setting_game;
				
				return view('la.setting_games.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('setting_game', $setting_game);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("setting_game"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified setting_game in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Setting_Games", "edit")) {
			
			$rules = Module::validateRules("Setting_Games", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Setting_Games", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.setting_games.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified setting_game from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Setting_Games", "delete")) {
			Setting_Game::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.setting_games.index');
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}
	
	/**
	 * Datatable Ajax fetch
	 *
	 * @return
	 */
	public function dtajax()
	{
		$values = DB::table('setting_games')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Setting_Games');
		
		for($i=0; $i < count($data->data); $i++) {
		$id = 0;
			for ($j=0; $j < count($this->listing_cols); $j++) {
			    if($j==0){
                    $id=$data->data[$i][$j];
                }
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/setting_games/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				if($col == "image"){
                    $data->data[$i][$j] =  AppHelper::thumbimg($data->data[$i][$j],array("html"=>true),array("link"=>array("class"=>"fancybox")));
                }
                if($col == "sort"){
                    $data->data[$i][$j] = "<input class=\"form-control input-sm\" placeholder=\"sort\" id='sort_numb_{$id}' name=\"sort_numb\" value='{$data->data[$i][$j]}'>
                                    <button class=\"btn btn-primary btn-sm \" type=\"button\" onclick=\"sort('{$id}','Article')\">Sort</button>";
                }
                if($col == "status"){
                    $status = ($data->data[$i][$j]==1)?2:1;
                    $icons = ($data->data[$i][$j]==1)?'<i class="fa fa-check" aria-hidden="true"></i>':'<i class="fa fa-times" aria-hidden="true"></i>';
                    $class = ($data->data[$i][$j]==1)?"btn-success":"btn-danger";

                    $data->data[$i][$j] =  "<a class=\"btn btn-primary btn-sm {$class}\" href=\"javascript:;\" onclick=\"updateFields('{$id}','{$status}','status','Article')\">{$icons}</a>";
                }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("Setting_Games", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/setting_games/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Setting_Games", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.setting_games.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
					$output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
					$output .= Form::close();
				}
				$data->data[$i][] = (string)$output;
			}
		}
		$out->setData($data);
		return $out;
	}
}
