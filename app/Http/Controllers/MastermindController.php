<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

/**
 * Class MarketingController
 * @package App\Http\Controllers
 */
class MastermindController extends Controller {

    /**
     * @Get("/mastermind", as="mastermind.dashboard")
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        return view('mastermind.dashboard');
    }
}