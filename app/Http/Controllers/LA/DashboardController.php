<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Affiliate;
use App\Models\Match;
use App\Models\Player;
use Illuminate\Http\Request;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        //Các tổng số
        $count_match = Match::countdata();
        $count_affiliate = Affiliate::countdata();
        $count_players = Player::countdata();



        $assign["count_match"] = $count_match;
        $assign["count_affiliate"] = $count_affiliate;
        $assign["count_players"] = $count_players;
        return View('la.dashboard',$assign);
    }
}