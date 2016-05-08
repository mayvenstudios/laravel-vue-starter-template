<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth, Hash;

/**
 * @Middleware("auth")
 * @Controller(prefix="api")
 * Class Users
 * @package App\Http\Controllers\Api
 */
class Users extends Controller {

    /**
     * @Get("users/me")
     */
    public function me()
    {
        return $this->respondWithData(Auth::user()->toArray());
    }

    /**
     * @Put("users/me/profile")
     * @param Request $request
     */
    public function updateMyProfile(Request $request)
    {
        $me = Auth::user();

        $this->validate($request, [
            'email' => 'required|unique:users,email,' . $me->id,
            'name' => 'required'
        ]);

        $me->email = $request->email;
        $me->name = $request->name;
        $me->save();

        return $this->me();
    }

    /**
     * @Put("users/me/password")
     * @param Request $request
     * @return mixed
     */
    public function updateMyPassword(Request $request)
    {
        $me = Auth::user();

        $this->validate($request, [
            'new_password' => 'required|min_length:6|confirmed',
            'current_password' => 'required'
        ]);

        if (!Hash::check($request->old_password, $me->password)) {
            return $this->respondWithError('Password check failed');
        }

        return $this->me();
    }

}