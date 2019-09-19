<?php

return [
    'db' => [
        'default' => [
            'driver' => 'pgsql',
            'host' => '127.0.0.1',
            'user' => 'postgres',
            'password' => '123',
            'dbname' => 'phpVDB'
        ],
        'phpUnitTest' => [
            'driver' => 'pgsql',
            'host' => '127.0.0.1',
            'user' => 'postgres',
            'password' => '',
            'dbname' => 'phpUnitTest'
        ],
        'lotusData' => [
            'driver' => 'pgsql',
            'host' => 'netcmdb.rs.ru',
            'user' => 'lotus',
            'password' => 'LoTus1208',
            'dbname' => 'LotusData'
        ],
        'cdr' => [
            'driver' => 'pgsql',
            'host' => '10.30.10.244',
            'user' => 'cdr',
            'password' => '123456',
            'dbname' => 'cdr'
        ],
        'cucmsHDS' => [
            'driver' => 'sqlserver',
            'host' => 'vm-ccphonedb02.rs.ru',
            'user' => 'saratovreport',
            'password' => 'saratov07*',
            'dbname' => 'RSB_HDS'
        ],
        'hds559' => [
            'host' => 'vm-ccphonedb02.rs.ru',
            'database' => 'RSB_HDS',
            'user' => 'saratovreport',
            'password' => 'saratov07*',
            'table' => 'Saratov_AgentLogOut',
        ],
        'hds558' => [
            'host' => 'vm-kdphonedb01.rs.ru',
            'database' => 'RSBKD_HDS',
            'user' => 'saratovreport',
            'password' => 'saratov07*',
            'table' => 'Saratov_AgentLogOut',
        ]
    ],
    'axl' => [
        'username' => 'netcmdbAXL',
        'password' => 'Dth.dAXL71',
    ],
    'ssh' => [
        'login' => 'net-cmdb',
        'password' => '36q#QzmC',
    ],
    'appParams' => [
        'maxAge' => 73,
    ]
];
