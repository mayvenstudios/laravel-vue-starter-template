<?php
/**
 * Everything that has smth to do with JS
 */

/**
 * @return mixed|string|void
 */
function getAppUserObject()
{
    $user = Auth::user();

    $output = [
        'logged_in' => Auth::check(),
        'user_id' => Auth::check() ? $user->id : null,
        'mastermind' => isMastermind(),
        'prod' => isProduction(),
        'environment' => App::environment(),
        'email' => Auth::check() ? $user->email : null,
        'name' => Auth::check() ? $user->name : null
    ];

    return json_encode($output);
}