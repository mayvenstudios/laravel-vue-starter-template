<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

/**
 * @todo add teams stuff or cleanup commented code
 * @Middleware("guest", except={"getLogout"})
 * Class AuthController
 * @package CMV\Http\Controllers\Auth
 */
class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers;

    /**
     * The URI for the login route.
     *
     * @var string
     */
    protected $loginPath = '/login';

    /**
     * Create a new authentication controller instance.
     */
    public function __construct() { }

    /**
     * Show the application login form.
     *
     * @Get("login", as="auth.login")
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * Send the post-authentication response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, Authenticatable $user)
    {
        return redirect()->intended($this->redirectPath());
    }

    /**
     * Show the application registration form.
     *
     * @Get("register", as="user.register")
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getRegister(Request $request)
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @Post("register")
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'terms' => 'required|accepted',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        return redirect(getHomeLink());
    }

    /**
     * Log the user out of the application.
     *
     * @Get("logout")
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getLogout(Request $request)
    {
        $request->session()->flush();

        Auth::logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    /**
     * @Post("login")
     * @param Request $request
     * @return Response
     */
    public function loginPost(Request $request)
    {
        return $this->postLogin($request);
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        return getHomeLink();
    }
}
