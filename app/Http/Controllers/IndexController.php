<?php
namespace App\Http\Controllers;

use App\Common\Utility;
use App\Http\Requests;
use App\Models\Match;
use App\Models\Note;
use App\Models\Slider;

use Illuminate\Http\Request;

/**
 * Class IndexController
 * @package App\Http\Controllers
 */
class IndexController extends AppController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $sliders = Slider::language()->get();
        $notes = Note::language()->get();

        $topToday = Match::topToday();
        $topWeek = Match::topWeek();
		return view('index.index',[
            'sliders' => $sliders,
            'notes' => $notes,
            'topToday' => $topToday,
            'topWeek' => $topWeek,
        ]);
    }
}