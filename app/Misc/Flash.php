<?php
namespace App\Misc;

use Session;

/**
 * our own custom flash, fairly straight forward
 * is rendered in layouts.common.footer.blade.php
 */
class Flash
{

    /**
     *
     */
    public static function killAllFlashes()
    {
        Session::pull('flash_message');
    }

    /**
     * @param $message
     */
    public static function success($message)
    {

        if (Session::has('flash_message'))
            $flash = Session::get('flash_message');
        else
            $flash = [];

        $flash[] = ['status' => 'success', 'message' => $message];
        Session::flash('flash_message', $flash);

    }

    /**
     * @param $message
     */
    public static function error($message)
    {
        if (Session::has('flash_message'))
            $flash = Session::get('flash_message');
        else
            $flash = [];

        $flash[] = ['status' => 'error', 'message' => $message];
        Session::flash('flash_message', $flash);

    }

    /**
     * @param $message
     */
    public static function warning($message)
    {
        if (Session::has('flash_message'))
            $flash = Session::get('flash_message');
        else
            $flash = [];

        $flash[] = ['status' => 'warning', 'message' => $message];
        Session::flash('flash_message', $flash);

    }

    /**
     * @param $message
     */
    public static function info($message)
    {
        if (Session::has('flash_message'))
            $flash = Session::get('flash_message');
        else
            $flash = [];

        $flash[] = ['status' => 'info', 'message' => $message];
        Session::flash('flash_message', $flash);

    }

}