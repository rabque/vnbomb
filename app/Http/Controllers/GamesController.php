<?php
namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Match;
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

    public function play(Request $request){

        $betAmount = (!empty($request->input("betAmount")))?$request->input("betAmount"):30;
        $numberOfMine = (!empty($request->input("numberOfMine")))?$request->input("numberOfMine"):1;
        $numberOfMine = preg_replace("/[^0-9]+/i","",$numberOfMine);

        return view('games.play',[
            "betAmount" => $betAmount,
            "numberOfMine" => $numberOfMine
        ]);
    }

}