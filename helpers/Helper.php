<?php
ob_start();

function router($param)
{
    header("Location: " . $param);
}

function setSession($session_name, $value)
{
    $_SESSION[$session_name] = $value;
}

function getSession($session_name)
{
    if (isset($_SESSION[$session_name])) {
        return $_SESSION[$session_name];
    } else {
        return null;
    }
}

function request($param)
{
    return htmlspecialchars($_POST[$param]);
}

function setStore($name, $data, $reset = false)
{
    if (!isset($_SESSION['store-data'][$name])) {
        $_SESSION['store-data'][$name] = $data;
    }

    if ($reset) {
        $_SESSION['store-data'][$name] = $data;
    }
}

function getStore($name, $data)
{
    return $_SESSION['store-data'][$name][$data];
}

function destoryStore($name)
{
    unset($_SESSION['store-data'][$name]);
}

function updateStore($name, $data, $value)
{
    return $_SESSION['store-data'][$name][$data] = $value;
}

function getStoreData($name)
{
    return $_SESSION['store-data'][$name];
}

function timezone($is_all = true, $custom = false, $date = null, $option = null)
{
    date_default_timezone_set('Asia/Manila');
    if ($custom) {
        $timestamp = strtotime($date);
        return date($option, $timestamp);
    } else {
        $currentDateTime = date($is_all ? 'Y-m-d H:i:s' : 'Y-m-d');
        return $currentDateTime;
    }
}

function display($param)
{
    echo $param;
}

function generateID()
{
    return abs(hexdec(uniqid()));
}

function alert($message = "", $redirectUrl = "")
{
    echo "<script>";
    echo "alert('" . addslashes($message) . "');";
    if (!empty($redirectUrl)) {
        echo "window.location.href = '" . addslashes($redirectUrl) . "';";
    }
    echo "</script>";
}


function formatDate($dateString, $option)
{
    $date = new DateTime($dateString);

    $formattedDate = $date->format($option);
    // M jS g:ia

    echo $formattedDate;
}

function timeAgo($timestamp)
{
    date_default_timezone_set('Asia/Manila');
    $datetime = new DateTime($timestamp);
    $now = new DateTime();
    $interval = $now->diff($datetime);

    if ($interval->y > 0) {
        return $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
    } elseif ($interval->m > 0) {
        return $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
    } elseif ($interval->d > 0) {
        return $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
    } elseif ($interval->h > 0) {
        return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
    } elseif ($interval->i > 0) {
        return $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
    } else {
        return $interval->s . ' second' . ($interval->s > 1 ? 's' : '') . ' ago';
    }
}


