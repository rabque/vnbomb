<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Common\Utility;
use App\Http\Controllers\Controller;
use App\Models\AppModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\Match;

class MatchController extends Controller
{
	public $show_action = false;
	public $view_col = 'game_hash';
	public $listing_cols = ['id','game_hash', 'player_id', 'bet','stake', 'num_mines', 'gametype'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Match', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Match', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Match.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Match');
		
		if(Module::hasAccess($module->id)) {
			return View('la.match.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}


	/**
	 * Display the specified match.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Match", "view")) {
			
			$match = Match::find($id);
			if(isset($match->id)) {
				$module = Module::get('Match');
				$match->bet = Utility::formatNumber($match->bet);
				$match->betNumber = Utility::formatNumber($match->betNumber);
				$match->next = Utility::formatNumber($match->next);
				$match->default_stake = Utility::formatNumber($match->default_stake);
				$match->stake = Utility::formatNumber($match->stake);

				$module->row = $match;
				return view('la.match.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('match', $match);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("match"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified match in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Match", "edit")) {
			
			$rules = Module::validateRules("Match", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Match", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.match.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified match from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Match", "delete")) {
			Match::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.match.index');
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
		$values = DB::table('match')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Match');
		
		for($i=0; $i < count($data->data); $i++) {
		$id = 0;
			for ($j=0; $j < count($this->listing_cols); $j++) {
			    if($j==0){
                    $id=$data->data[$i][$j];
                }
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = AppModel::getFieldValue($fields_popup[$col], $data->data[$i][$j],"username");
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/match/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}


				if(in_array($col,array("bet","betNumber","next","default_stake","stake"))){
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
				if(Module::hasAccess("Match", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/match/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Match", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.match.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
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
