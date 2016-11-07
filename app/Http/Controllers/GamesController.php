<?php
namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;
use SEO;
/**
 * Class ArticlesController
 * @package App\Http\Controllers
 */
class GamesController extends AppController
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



    public function index($slug = "")
    {
        SEO::setTitle("Games");
        SEO::setDescription("Games");
        SEO::opengraph()->setUrl(url("/games"));
        SEO::opengraph()->addProperty('type', 'articles');
        return view('games.index',[
        ]);

    }

}