<?php
namespace App\Http\Controllers;

use SEO;

/**
 * Class AffiliateController
 * @package App\Http\Controllers
 */
class AffiliateController extends AppController
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

        SEO::setTitle("Affiliate program");
        SEO::setDescription("Affiliate program");
        SEO::opengraph()->setUrl(url("/affiliate"));
        SEO::opengraph()->addProperty('type', 'articles');
        return view('affiliate.index',[
        ]);
    }
}