<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Common\Utility;
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

use App\Models\Player;

class PlayersController extends Controller
{
	public $show_action = false;
	public $view_col = 'username';
	public $listing_cols = ['id', 'username',  'uuid', 'sessionid', 'type', 'amount'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Players', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Players', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Players.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Players');
		
		if(Module::hasAccess($module->id)) {
			return View('la.players.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}


	/**
	 * Display the specified player.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Players", "view")) {

			$player = Player::find($id);
			if(isset($player->id)) {
				$module = Module::get('Players');
				$player->type =  ($player->type == 1)?"<label class='label label-default'>Free</label>":"<label class='label label-primary'>Bitcoin</label>";
				$player->amount = Utility::formatNumber($player->amount);
				$module->row = $player;

				return view('la.players.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('player', $player);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("player"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified player in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Players", "edit")) {
			
			$rules = Module::validateRules("Players", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Players", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.players.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified player from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Players", "delete")) {
			Player::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.players.index');
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
		$values = DB::table('players')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Players');
		
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
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/players/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				if($col == "type"){
                    $data->data[$i][$j] = ($data->data[$i][$j] == 1)?"<label class='label label-default'>Free</label>":"<label class='label label-primary'>Bitcoin</label>";
                }
				if($col == "amount"){
					$data->data[$i][$j] = Utility::formatNumber($data->data[$i][$j]);
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
				if(Module::hasAccess("Players", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/players/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Players", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.players.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
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
