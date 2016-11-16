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

use App\Models\Point;

class PointsController extends Controller
{
	public $show_action = true;
	public $view_col = 'point';
	public $listing_cols = ['id', 'game_type'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Points', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Points', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Points.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Points');
		
		if(Module::hasAccess($module->id)) {
			return View('la.points.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new point.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created point in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Points", "create")) {

			$points = $request->input("point");
			$pointData = array();
			if(!empty($points)){
				foreach($points as $key=>$point){
					if(Utility::checkInt($point,false) || $point > 100){
						$pointData[$key] = $point;
					}
				}
			}
			$pointData = json_encode($pointData);

			$request->merge(["point"=>$pointData]);


			$rules = Module::validateRules("Points", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Points", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.points.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified point.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Points", "view")) {
			
			$point = Point::find($id);
			if(isset($point->id)) {
				$module = Module::get('Points');
				$module->row = $point;
				
				return view('la.points.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('point', $point);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("point"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified point.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Points", "edit")) {			
			$point = Point::find($id);
			if(isset($point->id)) {	
				$module = Module::get('Points');
				
				$module->row = $point;
				
				return view('la.points.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('point', $point);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("point"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified point in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Points", "edit")) {
			$points = $request->input("point");
			$pointData = array();
			if(!empty($points)){
				foreach($points as $key=>$point){
					if(Utility::checkInt($point,false) || $point > 100){
						$pointData[$key] = $point;
					}
				}
			}
			$pointData = json_encode($pointData);

			$request->merge(["point"=>$pointData]);

			$rules = Module::validateRules("Points", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Points", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.points.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified point from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Points", "delete")) {
			Point::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.points.index');
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
		$values = DB::table('points')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Points');
		
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
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/points/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
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
				if(Module::hasAccess("Points", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/points/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Points", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.points.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
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
