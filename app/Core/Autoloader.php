<?php

class Autoloader {
    public static function register() {
        spl_autoload_register(function ($class) {
            // Convertit App\Core\Database => BASE_PATH/app/Core/Database.php
            $relative = str_replace('App\\', 'app/', $class);
            $relative = str_replace('\\', '/', $relative);
            $file = BASE_PATH . '/' . $relative . '.php';
            if (file_exists($file)) {
                require_once $file;
            }
        });
    }
}
