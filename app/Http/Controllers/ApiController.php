<?php
namespace App\Http\Controllers;
use App\Common\Utility;
use App\Models\Match;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid as UuidWeb;
/**
 * Class ApiController
 * @package App\Http\Controllers
 */
class ApiController extends AppController
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

    public function match(Request $request)
    {

        $input = $request->only(['uuid','username', 'password','clickMatch']);
        $match = new Match();
        $match->saveMatch($input);

        return response()->json($input["clickMatch"]);
    }
}