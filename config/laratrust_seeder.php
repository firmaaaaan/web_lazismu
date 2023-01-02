<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'administrator' => [
            'users' => 'c,r,u,d',
            'karyawans' => 'c,r,u,d',
            'rumah_sakits' => 'c,r,u,d',
            'donasis' => 'c,r,u,d',
            'penyalurans' => 'c,r,u,d',
            'program_donasis' => 'c,r,u,d',
            'zakats' => 'c,r,u,d',
            'permintaan_ambulans' => 'c,r,u,d',
        ],
        'pimpinan' => [
            'users' => 'r',
            'karyawans' => 'r',
            'rumah_sakits' => 'r',
            'donasis' => 'r',
            'penyalurans' => 'r',
            'program_donasis' => 'r',
            'zakats' => 'r',
            'permintaan_ambulans' => 'r',
        ],
        'petugas' => [
            'users' => 'u',
            'program_donasis' => 'u',
            'zakats' => 'u',
            'donasis' => 'u',
            'permintaan_ambulans' => 'u',
        ],
        'driver' => [
            'users' => 'r,u',
            'permintaan_ambulans' => 'r,u',
        ],
        'customer' => [
            'users' => 'c,r,u',
            'donasis' => 'c,r,u,d',
            'program_donasis' => 'c,r,u,d',
            'zakats' => 'c,r,u,d',
            'permintaan_ambulans' => 'c,r,u,d',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];