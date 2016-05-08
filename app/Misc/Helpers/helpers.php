<?php
/**
 * These are functions which can be easily reused
 * in another Laravel projects
 */

/**
 * @return string
 */
function ip()
{
    return Request::getClientIp();
}

/**
 * @return string path to envoy executable
 */
function envoy_path()
{
    return base_path() . '/vendor/bin/envoy';
}

/**
 * @return bool
 */
function isProduction()
{
    if (App::environment('production')) {
        return true;
    }

    return false;
}

/**
 * @param $email
 * @return bool
 */
function check_email($email)
{
    /** @var \Illuminate\Validation\Validator $validator */
    $validator = Validator::make(['email' => $email], [
        'email' => 'required|email'
    ]);

    return $validator->passes();
}

function html2text($html)
{
    $noBR = preg_replace('/<br[^\>]*>/', PHP_EOL, $html);
    return preg_replace('/(<.*?>)/', '', $noBR);
}

/**
 * array_get analogues for std
 *
 * @param $std
 * @param $path
 * @return null
 */
function std_get($std, $path)
{
    $breadcrumbs = explode('.', $path);
    $tmp = $std;

    foreach ($breadcrumbs as $crumb) {
        if (isset($tmp->$crumb)) {
            $tmp = $tmp->$crumb;
        } else {
            $tmp = null;
            break;
        }
    }

    return $tmp;
}

/**
 * @param $key
 * @param $contents
 * @param string $contentType
 * @return
 */
function s3_put_object($key, $contents, $contentType = 'text/plain')
{
    $s3 = AWS::createClient('S3');

    $params = [
        'Bucket' => Config::get('aws.bucket'),
        'Key' => $key,
        'content-type' => $contentType,
        'ACL' => 'public-read'
    ];

    if (is_array($contents)) {
        $params = array_merge($params, $contents);
    } else {
        $params['Body'] = $contents;
    }

    return $s3->putObject($params);
}

/**
 * @param $size
 * @param string $units
 * @return string
 */
function readableSize($size, $units = 'b')
{
    switch ($units) {
        case 'b':
            break;
        case 'kb':
            $size *= 1024;
            break;
        case 'mb':
            $size *= 1024 * 1024;
            break;
        case 'gb':
            $size *= 1024 * 1024 * 1024;
            break;
    }

    if ($size > (1024 * 1024 * 1024)) {
        return sprintf("%.02f GB", ($size / (1024 * 1024 * 1024)));
    }

    if ($size > 1024 * 1024) {
        return sprintf("%.02f MB", ($size / (1024 * 1024)));
    }

    return sprintf("%.02f KB", ($size / 1024));
}

/**
 * @param $count
 * @param $singular
 * @param $plural
 * @param bool $omitCount
 * @return string
 */
function wCount($count, $singular, $plural, $omitCount = false)
{
    if ($omitCount) {
        return $count == 1 ? $singular : $plural;
    }

    return $count == 1 ? "$count $singular" : "$count $plural";
}

/**
 * Generates random string
 *
 * @param int $length
 * @return string
 */
function random_str($length = 8)
{
    $possible = "abcdefghijklmnopqrstuvwxyz0123456789";

    return 'e' . substr(str_shuffle($possible), 0, $length - 1);
}

/**
 * @param $bool
 * @return string
 */
function yesNo($bool)
{
    return $bool ? 'Yes' : 'No';
}

/**
 * @param array $array
 * @param $column
 * @return array
 */
function std_column(array $array, $column)
{
    $res = [];
    foreach ($array as $item) {
        $res[] = $item->$column;
    }

    return $res;
}

/**
 * @param \Carbon\Carbon $date
 * @param $daysToAdd
 * @return \Carbon\Carbon
 */
function addBusinessDays(\Carbon\Carbon $date, $daysToAdd)
{
    $daysLeft = $daysToAdd;
    while ($daysLeft > 0) {
        $date->addDay();
        if (!$date->isWeekend()) {
            $daysLeft--;
        }
    }

    return $date;
}

/**
 * @param \Carbon\Carbon $firstDate
 * @param \Carbon\Carbon $secondDate
 * @return int
 */
function calculateNumberOfBusinessDaysBetween(\Carbon\Carbon $firstDate, \Carbon\Carbon $secondDate)
{
    $daysLeft = $firstDate->diffInDays($secondDate);

    $businessDays = 0;
    while ($daysLeft > 0) {
        if (!$firstDate->isWeekend()) {
            $businessDays++;
        }
        $firstDate->addDay();
        $daysLeft--;
    }
    return $businessDays;
}

/**
 * @param $email
 * @param string $default
 * @return string
 */
function getGravatarImage($email, $default = 'mm')
{
    $hash = md5(strtolower(trim($email)));
    return "https://www.gravatar.com/avatar/{$hash}?s=256&d={$default}";
}

/**
 * @param $s
 * @param bool $return
 * @return string
 */
function preprint($s, $return = false)
{
    $x = "<pre>";
    $x .= print_r($s, 1);
    $x .= "</pre>";
    if ($return) {
        return $x;
    } else {
        print $x;
    }
}

/**
 * @param array $classes
 * @return string
 */
function setBodyClassIfPjax(array $classes)
{
    if (!Request::pjax()) {
        return '';
    }

    $classes = implode(' ', $classes);

    return "
        <script>
            $('body').attr('class', '$classes')
        </script>
    ";
}

/**
 * @param $error
 */
function before_bugsnag_notify($error)
{

    if (Auth::check()) {
        $error->setMetaData([

            'user' => [
                'id' => Auth::id(),
                'email' => Auth::user()->email
            ]

        ]);
    }
}

/**
 * @param $path
 * @param string $active
 * @return string
 */
function set_active($path, $active = 'active')
{
    return Request::is($path) ? $active : '';
}

/**
 * @param $route_name
 * @param string $active
 * @return bool|string
 */
function set_active_from_route_name($route_name, $active = 'active')
{
    if (is_array($route_name)) {
        foreach ($route_name as $name) {
            if (Route::currentRouteName() == $name) {
                return $active;
            }
        }

        return false;
    }

    return Route::currentRouteName() == $route_name ? $active : '';
}

/**
 * @param $pathToCheck
 * @return bool
 */
function isRouteNameSpace($pathToCheck)
{
    return str_contains(Request::url(), $pathToCheck);
}

/**
 * @param $name
 * @return bool
 */
function isRoute($name)
{
    return Route::currentRouteName() == $name;
}
