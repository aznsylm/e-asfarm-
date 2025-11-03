<?php

namespace Config;

use CodeIgniter\Events\Events;
use CodeIgniter\Framework\Events\FrameworkEvents;
use CodeIgniter\Shield\Events\LoginEvent;

/*
 * --------------------------------------------------------------------
 * Application Events
 * --------------------------------------------------------------------
 * Events allow you to tap into the execution of the program without
 * modifying or extending core files. This file provides a central
 * location to define your events, though they can always be added
 * at run-time, also, if needed.
 *
 * You create code that can execute by subscribing to events with
 * the 'on()' method. This accepts any form of callable, including
 * Closures, that will be executed when the event is triggered.
 *
 * Example:
 *      Events::on('create', [$myInstance, 'myMethod']);
 */

Events::on('pre_system', static function () {
    if (ENVIRONMENT !== 'testing') {
        if (ini_get('zlib.output_compression')) {
            throw FrameworkEvents::forEnabledZlibOutputCompression();
        }

        while (ob_get_level() > 0) {
            ob_end_flush();
        }

        ob_start(static fn ($buffer) => $buffer);
    }

    /*
     * --------------------------------------------------------------------
     * Debug Toolbar Listeners.
     * --------------------------------------------------------------------
     * If you delete, they will no longer be collected.
     */
    if (CI_DEBUG && ! is_cli()) {
        Events::on('DBQuery', 'CodeIgniter\Debug\Toolbar\Collectors\Database::collect');
        Events::on('log', 'CodeIgniter\Debug\Toolbar\Collectors\Logs::collect');
    }
});

// Store user role in session after login
Events::on('login', static function ($user) {
    if ($user) {
        $userModel = new \App\Models\UserModel();
        $userData = $userModel->find($user->id);
        if ($userData) {
            session()->set('role', $userData['role'] ?? 'pengguna');
            session()->set('username', $userData['username'] ?? '');
        }
    }
});