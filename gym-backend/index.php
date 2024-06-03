<?php
require 'vendor/autoload.php';
require 'rest/routes/middleware_routes.php';
require 'rest/routes/member_routes.php';
require 'rest/routes/comment_routes.php';
require 'rest/routes/program_routes.php';
require 'rest/routes/trainers_routes.php';
require 'rest/routes/training_routes.php';
require 'rest/routes/auth_routes.php';

Flight::start();
