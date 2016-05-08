<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords, ValidatesRequests;

    /**
     * Create a new password controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @Get("password/email")
     * @return \Illuminate\Http\Response
     */
    public function getEmail()
    {
        return view('auth.forgot-password');
    }

    /**
     * @Post("password/email")
     * @param Request $request
     * @return Response
     */
    public function emailPost(Request $request)
    {
        return $this->postEmail($request);
    }

    /**
     * Display the password reset view for the given token.
     *
     * @Get("password/reset/{token}")
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function getReset($token = null)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }

        return view('auth.reset-password')->with('token', $token);
    }

    /**
     * @Post("password/reset")
     * @param Request $request
     * @return Response
     */
    public function resetPost(Request $request)
    {
        return $this->postReset($request);
    }

    /**
     * Get the response for after a successful password reset.
     *
     * @param  string  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getResetSuccessResponse($response)
    {
        \Flash::success(trans($response));

        return redirect(getHomeLink());
    }
}
