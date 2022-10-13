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

    'count_list' => 3,
    
    'path_parts' => pathinfo($_SERVER['SCRIPT_NAME']),
];

?>