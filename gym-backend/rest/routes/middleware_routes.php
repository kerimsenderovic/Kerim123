<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::route('/*', function() {
    // Exclude the /program route from authentication
    if (strpos(Flight::request()->url, '/auth/login') === 0 || strpos(Flight::request()->url, '/program') === 0 ||
    strpos(Flight::request()->url, '/members') === 0
    ) {
        return TRUE;
    } else {
        try {
            $token = Flight::request()->getHeader("Authentication");
            if (!$token)
                Flight::halt(401, "Missing authentication header");

            $decoded_token = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));

            Flight::set('user', $decoded_token->user);
            Flight::set('jwt_token', $token);
            return TRUE;
        } catch (\Exception $e) {
            Flight::halt(401, $e->getMessage());
        }
    }
});

Flight::map('error', function($e){
    // We want to log every error that happens
    file_put_contents('logs.txt', $e . PHP_EOL, FILE_APPEND | LOCK_EX);

    // Ensure the status code is valid
    $statusCode = $e->getCode();
    if ($statusCode < 100 || $statusCode > 599) {
        $statusCode = 500; // Internal Server Error as a fallback
    }
    
    Flight::halt($statusCode, $e->getMessage());
    Flight::stop();
});