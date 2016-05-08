<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rap2hpoutre\LaravelLogViewer\LaravelLogViewer;
use Input;
use View;

/**
 * @Middleware("mastermind")
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

    /**
     * @Get("/mastermind/logs", as="mastermind.logs")
     * @return mixed
     */
    public function logs(Request $request)
    {
        if ($l = $request->get('l')) {
            LaravelLogViewer::setFile(base64_decode($l));
        }

        $logs = LaravelLogViewer::all();

        return View::make('laravel-log-viewer::log', [
            'logs' => $logs,
            'files' => LaravelLogViewer::getFiles(true),
            'current_file' => LaravelLogViewer::getFileName()
        ]);
    }
}