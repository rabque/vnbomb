<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Common\Utility;
use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\Article;

/**
 * @property \App\Models\Article Article

 */

class ArticlesController extends Controller
{
	public $show_action = true;
	public $view_col = 'name';
	public $listing_cols = ['id', 'name','image',  'slug', 'cate_id','sort', 'status'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Articles', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Articles', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Articles.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Articles');

		if(Module::hasAccess($module->id)) {


			$categories = Category::getTree();
			return View('la.articles.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module,
				'categories' => AppHelper::printTree($categories)
			]);
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for creating a new article.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		if(Module::hasAccess("Articles", "create")) {
			$module = Module::get('Articles');
			return view('la.articles.create', [
				'module' => $module,
				'view_col' => $this->view_col,
			]);
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Store a newly created article in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Articles", "create")) {
		
			$rules = Module::validateRules("Articles", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}


			$insert_id = Module::insert("Articles", $request);
			if(!empty($request->input("cate_id"))){
				$cate_id = $request->input("cate_id");
				$article = Article::find($insert_id);
				foreach($cate_id as $cate){
					$article->categories()->attach($cate);
				}
			}
			return redirect()->route(config('laraadmin.adminRoute') . '.articles.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified article.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Articles", "view")) {
			
			$article = Article::find($id);
			if(isset($article->id)) {
				$module = Module::get('Articles');
				$module->row = $article;
				
				return view('la.articles.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('article', $article);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("article"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified article.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Articles", "edit")) {			
			$article = Article::find($id);
			if(isset($article->id)) {	
				$module = Module::get('Articles');
				
				$module->row = $article;
				
				return view('la.articles.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('article', $article);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("article"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified article in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Articles", "edit")) {
			
			$rules = Module::validateRules("Articles", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Articles", $request, $id);
			if(!empty($request->input("cate_id"))){

				$cate_id = $request->input("cate_id");
				$article = Article::find($insert_id);
				$article->categories()->detach();
				foreach($cate_id as $cate){
					$article->categories()->attach($cate);
				}
			}
			return redirect()->route(config('laraadmin.adminRoute') . '.articles.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified article from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Articles", "delete")) {
			$article = Article::find($id);
			$article->delete();
			$article->categories()->detach();
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.articles.index');
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
		$values = DB::table('articles')
						->select($this->listing_cols)
						->whereNull('deleted_at');
		$this->listing_cols[0] = "id";
		$out = Datatables::of($values);
		if ($keyword = $request->get('search')['value']) {
			// override users.name global search
			$keyword = Utility::removeScripts($keyword);
			$out->filterColumn('articles.name', 'where', 'like', "$keyword%");
		}
		if ($cate_id = $request->get('category')) {
			$cate_id = Utility::getInt($cate_id);
			$out->whereRaw("articles.cate_id REGEXP  '[$cate_id]'");
		}

		if ($keyword = $request->get('keyword')) {
			$keyword = Utility::removeScripts($keyword);
			$out->where('articles.name', 'like', "$keyword%");
		}
		$out = 	$out->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Articles');
		
		for($i=0; $i < count($data->data); $i++) {
			$id=0;
			for ($j=0; $j < count($this->listing_cols); $j++) {
				if($j==0){
					$id=$data->data[$i][$j];
				}
				$col = $this->listing_cols[$j];
				$data->data[$i][$j] = strip_tags($data->data[$i][$j]);

				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@") && $col == "cate_id") {
					$tmpJson = json_decode($data->data[$i][$j],true);
					if(!empty($tmpJson)){
						$tmpCate = "";
						foreach($tmpJson as $v){
							$tmpCate .= "<div class='label label-danger'>".ModuleFields::getFieldValue($fields_popup[$col], $v)."</div>";
						}
						$data->data[$i][$j] = $tmpCate;
					}else{
						$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
					}
				}

				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/articles/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
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



				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("Articles", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/articles/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Articles", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.articles.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
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
