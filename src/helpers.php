<?php

use App\Core\Auth;
use App\Core\Redirect;
use App\Core\Request;
use App\Core\Session;
use App\Core\View;

/**
 * Render a view with the given parameters and layout.
 *
 * @param string $view
 * @param array $params
 * @param string $layout
 * @return string
 */
function view($view, $params = [], $layout = 'main')
{
    $view = new View();
    return $view->setLayout($layout)->render($view, $params);
}

/**
 * Render a component with the given parameters.
 *
 * @param string $component
 * @param array $params
 * @return string
 */
function component($component, $params = [])
{
    $view = new View();
    return $view->component($component, $params);
}

/**
 * Create a new Request instance.
 *
 * @return Request
 */
function request()
{
    return new Request();
}

/**
 * Create a new Redirect instance.
 *
 * @return Redirect
 */
function redirect()
{
    return new Redirect();
}

/**
 * Create a new Session instance.
 *
 * @return Session
 */
function session()
{
    return new Session();
}

/**
 * Generate the URL for the given path.
 *
 * @param string $path
 * @return string
 */
function url($path)
{
    return APP_URL . $path;
}

/**
 * Get the first error message for the given error key.
 *
 * @param string $error
 * @return string|false
 */
function error($error)
{
    $errors = session()->getFlash('errors') ?? [];
    if (isset($errors[$error][0])) {
        return $errors[$error][0];
    }

    return false;
}

/**
 * Get the old input value for the given key.
 *
 * @param string $key
 * @return mixed|null
 */
function old($key)
{
    $inputs = session()->getFlash('inputs') ?? [];
    if (isset($inputs[$key])) {
        return $inputs[$key];
    }
    return null;
}

/**
 * Create a new Auth instance.
 *
 * @return Auth
 */
function auth()
{
    return new Auth();
}

/**
 * Get the relative time ago from the given date.
 *
 * @param string $dateTime
 * @return string
 */
function timeAgo($dateTime)
{
    $timeAgo = strtotime($dateTime);
    $currentTime = time();
    $timeDifference = $currentTime - $timeAgo;

    $seconds = $timeDifference;
    $minutes = round($seconds / 60);
    $hours = round($seconds / 3600);
    $days = round($seconds / 86400);
    $weeks = round($seconds / 604800);
    $months = round($seconds / 2629440);
    $years = round($seconds / 31553280);

    if ($seconds <= 60) {
        return "$seconds seconds ago";
    } elseif ($minutes <= 60) {
        if ($minutes == 1) {
            return "1 minute ago";
        } else {
            return "$minutes minutes ago";
        }
    } elseif ($hours <= 24) {
        if ($hours == 1) {
            return "1 hour ago";
        } else {
            return "$hours hours ago";
        }
    } elseif ($days <= 7) {
        if ($days == 1) {
            return "1 day ago";
        } else {
            return "$days days ago";
        }
    } elseif ($weeks <= 4.3) {
        if ($weeks == 1) {
            return "1 week ago";
        } else {
            return "$weeks weeks ago";
        }
    } elseif ($months <= 12) {
        if ($months == 1) {
            return "1 month ago";
        } else {
            return "$months months ago";
        }
    } else {
        if ($years == 1) {
            return "1 year ago";
        } else {
            return "$years years ago";
        }
    }
}

/**
 * Format the given date using the specified format.
 *
 * @param string $date
 * @param string $format
 * @return string
 */
function formatDate($date, $format = 'F d, Y')
{
    return date($format, strtotime($date));
}
