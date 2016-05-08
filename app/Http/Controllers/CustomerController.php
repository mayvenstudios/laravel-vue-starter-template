<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

/**
 * @Middleware("customer")
 * Class MarketingController
 * @package App\Http\Controllers
 */
class CustomerController extends Controller {

    /**
     * @Get("/dashboard", as="customer.dashboard")
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        return view('customer.dashboard');
    }
}