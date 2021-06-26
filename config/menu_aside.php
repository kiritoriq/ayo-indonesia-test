<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'role' => ['1','2'],
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => 'dashboard',
            'new-tab' => false,
        ],

        // Custom
        [
            'section' => 'Main Menu',
            'role' => ['1','2'],
        ],
        [
            'title' => 'Laporan',
            'icon' => 'media/svg/icons/Communication/Mail.svg',
            'bullet' => 'dot',
            'root' => true,
            'role' => ['1','2'],
            'submenu' => [
                [
                    'title' => 'Input Laporan',
                    'bullet' => 'dot',
                    'page' => 'laporan',
                    'role' => ['1','2'],
                ],

            ],
        ],
        [
            'section' => 'Admin',
            'role' => ['1'],
        ],
        [
            'title' => 'Data User',
            'root' => true,
            'icon' => 'media/svg/icons/General/User.svg',
            'page' => 'user',
            'new-tab' => false,
            'role' => ['1'],
        ],
    ]

];
