<?php

return[
    'name' => 'Web-interface', // Name application
    'copyright' => 'Copyright © '. date('Y') . '. Ilya Romanenko.',

    'components' => [ // Include data base

        'host' => 'localhost',  
        'userName' => 'root',
        'password' => '',
        'dataBase' => 'sibers',

    ],

    'count_list' => 10, // How many entries to output per page
    
    'path_parts' => pathinfo($_SERVER['SCRIPT_NAME']),
];

?>