<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Common\Utility;
use App\Helpers\AppHelper;
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

use App\Models\Slider;

class SlidersController extends AppController
{
	public $show_action = true;
	public $view_col = 'name';
	public $listing_cols = ['id',  'name', 'url', 'image','lang', 'sort','status'];
	
	public function __construct() {
		parent::__construct();
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Sliders', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Sliders', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Sliders.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Sliders');
		
		if(Module::hasAccess($module->id)) {
			return View('la.sliders.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new slider.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created slider in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Sliders", "create")) {
		
			$rules = Module::validateRules("Sliders", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Sliders", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.sliders.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified slider.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Sliders", "view")) {
			
			$slider = Slider::find($id);
			if(isset($slider->id)) {
				$module = Module::get('Sliders');
				$module->row = $slider;
				
				return view('la.sliders.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('slider', $slider);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("slider"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified slider.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Sliders", "edit")) {			
			$slider = Slider::find($id);
			if(isset($slider->id)) {	
				$module = Module::get('Sliders');
				
				$module->row = $slider;
				
				return view('la.sliders.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('slider', $slider);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("slider"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified slider in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Sliders", "edit")) {
			
			$rules = Module::validateRules("Sliders", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Sliders", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.sliders.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified slider from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Sliders", "delete")) {
			Slider::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.sliders.index');
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}
	
	/**
	 * Datatable Ajax fetch
	 *
	 * @return
	 */
	public function dtajax(Request $request)
	{


		$values = DB::table('sliders')
			->select($this->listing_cols)
			->whereNull('deleted_at');
		$this->listing_cols[0] = "id";
		$out = Datatables::of($values);
		if ($keyword = $request->get('search')['value']) {
			// override users.name global search
			$keyword = Utility::removeScripts($keyword);
			$out->filterColumn('sliders.name', 'where', 'like', "$keyword%");
		}


		if ($keyword = $request->get('keyword')) {
			$keyword = Utility::removeScripts($keyword);
			$out->where('sliders.name', 'like', "$keyword%");
		}

		if ($lang = $request->get('lang')) {
			$lang = Utility::getInt($lang);
			$out->where('sliders.lang',  $lang);
		}

		$out = 	$out->make();
		$data = $out->getData();
		$fields_popup = ModuleFields::getModuleFields('Sliders');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) {
				if($j==0){
					$id=$data->data[$i][$j];
				}
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/sliders/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}

				if($col == "image"){
					$data->data[$i][$j] =  AppHelper::thumbimg($data->data[$i][$j],array("html"=>true,"w"=>300,"h"=>100),array("link"=>array("class"=>"fancybox")));
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
				if(Module::hasAccess("Sliders", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/sliders/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Sliders", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.sliders.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
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
