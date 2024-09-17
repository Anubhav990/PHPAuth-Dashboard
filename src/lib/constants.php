<?php

return [
   'db' => [
        'name' => '',
        'password' => '',
        'host' => ''
   ],
   'paths' => [
        'logout' => '/Anubhavphpprac/src/controllers/logout.php',
        'signin' => '',
        'login' => '/Anubhavphpprac/src/views/auth/index.php',
        'CreateNewUser' => '/Anubhavphpprac/src/views/users/CreateNewUser.php',
        'Users' => '/Anubhavphprac/src/views/users/Users.php',
        'AccessDenied' => '/Anubhavphpprac/src/views/AccessDenied.php',
        'dashboard' => '/Anubhavphpprac/src/views/dashboard.php',
        'HasAccess' => '/Anubhavphpprac/src/middlewares/HasAccess.php',
   ],
];

// ...['paths']['index']