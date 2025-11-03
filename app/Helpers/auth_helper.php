<?php

if (!function_exists('is_logged_in')) {
    function is_logged_in()
    {
        return session()->get('logged_in') === true;
    }
}

if (!function_exists('current_user')) {
    function current_user()
    {
        if (!is_logged_in()) {
            return null;
        }
        
        return (object) [
            'id' => session()->get('user_id'),
            'username' => session()->get('username'),
            'email' => session()->get('email'),
            'role' => session()->get('role')
        ];
    }
}

if (!function_exists('user_role')) {
    function user_role()
    {
        return session()->get('role');
    }
}

if (!function_exists('has_role')) {
    function has_role($role)
    {
        return session()->get('role') === $role;
    }
}

if (!function_exists('require_login')) {
    function require_login()
    {
        if (!is_logged_in()) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }
        return null;
    }
}