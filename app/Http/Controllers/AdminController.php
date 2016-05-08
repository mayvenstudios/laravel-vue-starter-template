<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

/**
 * Class MarketingController
 * @package App\Http\Controllers
 */
class CustomerController extends Controller {

    /**
     * @Get("/admin", as="admin.dashboard")
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}