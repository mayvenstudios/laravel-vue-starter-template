<?php
namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;

/**
 * Class MarketingController
 * @package App\Http\Controllers
 */
class MarketingController extends Controller {

    /**
     * @Get("/", as="marketing.welcome")
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome()
    {
        return view('marketing/welcome');
    }

    /**
     * @Get("/about", as="marketing.about")
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('marketing/about');
    }

}