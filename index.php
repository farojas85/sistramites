<?php
require 'vendor/autoload.php';
require_once 'app/constantes.php';
require_once 'routes/app.php';

use App\Controllers\Login;
$user = new Login();
