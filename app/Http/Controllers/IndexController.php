<?php
namespace App\Http\Controllers;

use App\Http\Requests;
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
        $sliders = Slider::all();
        $notes = Note::all();
		return view('index.index',[
            'sliders' => $sliders,
            'notes' => $notes,
        ]);
    }
}