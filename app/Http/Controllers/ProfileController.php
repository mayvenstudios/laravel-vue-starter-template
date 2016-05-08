<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ProfileController extends Controller {

    /**
     * @Get("/settings", as="profile.settings")
     */
    public function settings()
    {
        return view('profile.settings');
    }

}