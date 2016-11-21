<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Common\Utility;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\Category;

class CategoriesController extends AppController
{
	public $show_action = true;
	public $view_col = 'name';
	public $listing_cols = ['id',  'name', 'slug', 'parent_id', 'module_id','lang', 'sort','status'];
	
	public function __construct() {
		parent::__construct();
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Categories', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Categories', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Categories.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Categories');
		
		if(Module::hasAccess($module->id)) {

			$categories = Category::where("parent_id",1)->where("id","!=",1)->get();
			if(!empty($categories)){

				$categories = array_column($categories->toArray(),"name","id");
				$categories[0] = "";
				ksort($categories);
			}
			return View('la.categories.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module,
				'categories' => $categories
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new category.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created category in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Categories", "create")) {
		
			$rules = Module::validateRules("Categories", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Categories", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.categories.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified category.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Categories", "view")) {
			
			$category = Category::find($id);
			if(isset($category->id)) {
				$module = Module::get('Categories');
				$module->row = $category;
				
				return view('la.categories.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('category', $category);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("category"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified category.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Categories", "edit")) {			
			$category = Category::find($id);
			if(isset($category->id)) {	
				$module = Module::get('Categories');
				
				$module->row = $category;
				
				return view('la.categories.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('category', $category);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("category"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified category in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Categories", "edit")) {
			
			$rules = Module::validateRules("Categories", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Categories", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.categories.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified category from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Categories", "delete")) {
			Category::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.categories.index');
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
		$values = DB::table('categories')->select($this->listing_cols)->whereNull('deleted_at')->orderBy("id","DESC");

		$out = Datatables::of($values);

		// Global search function
		if ($keyword = $request->get('search')['value']) {
			// override users.name global search
			$keyword = Utility::removeScripts($keyword);
			$out->filterColumn('categories.name', 'where', 'like', "$keyword%");
		}
		if ($parent = $request->get('parent')) {
			$parent = Utility::getInt($parent);
			$out->where('categories.parent_id',  $parent);
		}

		if ($keyword = $request->get('keyword')) {
			$keyword = Utility::removeScripts($keyword);
			$out->where('categories.name', 'like', "$keyword%");
		}

		if ($lang = $request->get('lang')) {
			$lang = Utility::getInt($lang);
			$out->where('categories.lang',  $lang);
		}



		$out = $out->make();



		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Categories');
		
		for($i=0; $i < count($data->data); $i++) {
			$id=0;
			for ($j=0; $j < count($this->listing_cols); $j++) {
				if($j==0){
					$id=$data->data[$i][$j];
				}
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {

					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/categories/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}

				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@") && $col == "lang") {
					$lang = Language::getLangById($data->data[$i][$j]);
					if(!empty($lang)){
						$data->data[$i][$j] = $lang->name;
					}
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }

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
				if(Module::hasAccess("Categories", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/categories/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Categories", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.categories.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
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
