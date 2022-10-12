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

    'path_parts' => pathinfo($_SERVER['SCRIPT_NAME']),
];

?>