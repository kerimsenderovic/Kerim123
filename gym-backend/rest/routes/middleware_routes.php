<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Flight;

Flight::route('/*', function() {
    // Define public routes that don't require authentication
    $public_routes = ['/auth/login'];
    
    // Check if the request URL matches any public routes
    foreach ($public_routes as $route) {
        if (strpos(Flight::request()->url, $route) === 0) {
            return true;
        }
    }

    try {
        // Get the Authentication header
        $token = Flight::request()->getHeader("Authentication");
        if (!$token) {
            Flight::halt(401, "Missing authentication header");
        }

        // Decode the JWT token
        $decoded_token = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));

        // Set user and token in Flight globals for use in other routes
        Flight::set('user', $decoded_token->user);
        Flight::set('jwt_token', $token);
        return true;
    } catch (\Exception $e) {
        // Halt with 401 status and the exception message
        Flight::halt(401, $e->getMessage());
    }
});

?>