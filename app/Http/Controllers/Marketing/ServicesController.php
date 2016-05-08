<?php
namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;

/**
 * Class MarketingController
 * @package App\Http\Controllers
 */
class ServicesController extends Controller {

    /**
     * @Get("/services/{slug}", as="service")
     */
    public function service($slug)
    {
        $views = [
            'service1' => 'marketing/service1',
            'service2' => 'marketing/service2',
        ];

        if (!isset($views[$slug])) {
            abort(404);
        }

        return view($views[$slug]);
    }


}