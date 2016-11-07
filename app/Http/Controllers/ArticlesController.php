<?php
namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Class ArticlesController
 * @package App\Http\Controllers
 */
class ArticlesController extends AppController
{
    public $request;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct();
    }

    public function map($slug = "")
    {
        $table = $this->request->input("tableName");
        if($table == "articles"){
            return $this->detail($slug);
        }else{
            return $this->index($slug);
        }
    }

    public function index($slug = "")
    {


    }

    public function detail($slug = ""){
        $detail = Article::where("slug",$slug)->get()->first();
        return view('articles.detail',[
            'detail' => $detail
        ]);
    }
}