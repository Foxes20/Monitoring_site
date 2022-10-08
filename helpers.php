<?php

function getIp() {

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function getRequestPath() {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    return ltrim(str_replace('index.php', '', $path), '/');
}

function pagination($length, $page) {

    if ($length < 5) {
        foreach (range(1, $length) as $p) {
            echo '<a href = "?page=' .$p. '">' .$p. '</a>';
        }
    }
    if ($length > 4 && $page < 5) {
        foreach (range(1, 5) as $p) {
            echo '<a href = "?page=' .$p. '">' .$p. '</a>';
        }
    }
    if ($length - 5 < 5 && $page > 5) {
        foreach (range($length - 4, $length) as $p) {
            echo '<a href = "?page=' .$p. '">' .$p. '</a>';
        }
    }
    if ($length > 4 && $length - 5 < 5 && $page == 5) {
        foreach (range($page - 2, $length) as $p) {
            echo '<a href = "?page=' .$p. '">' .$p. '</a>';
        }
    }
    if ($length > 4 && $length - 5 > 5 && $page >= 5 && $page <= $length - 4) {
        foreach (range($page - 2, $length + 2) as $p) {
            echo '<a href = "?page=' .$p. '">' .$p. '</a>';
        }
    }
    if ($length > 4 && $length - 5 > 5 && $page > $length - 4) {
        foreach (range($length - 4, $length) as $p) {
            echo '<a href = "?page=' .$p. '">' .$p. '</a>';
        }
    }
}

function unregisteredUser()
{
    if (empty($_SESSION['auth'])) {
        header("Location: /show_registration_form");
        return false;
    }
    return true;
}
