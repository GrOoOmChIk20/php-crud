<?php

return[
    'name' => 'Web-interface', // Name application
    'copyright' => 'Copyright © '. date('Y') . '. Ilya Romanenko.',

    'components' => [

        'host' => 'localhost',  
        'userName' => 'root',
        'password' => '',
        'dataBase' => 'sibers',

    ],

    'salt' => '429fgk4gShh69vcmSJKe',
    
    'path_parts' => pathinfo($_SERVER['SCRIPT_NAME']),
];

?>