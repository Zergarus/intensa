<?php

namespace App;

class User
{
    public static function isLogin(): int
    {
        if (isset($_SESSION['user_id']) && $_SESSION['user_id']) {
            return $_SESSION['user_id'];
        } else {
            return false;
        }
    }
}