<?php

return [
    'db' => [
        'default' => [
            'driver' => 'pgsql',
            'host' => '127.0.0.1',
            'user' => 'postgres',
            'password' => 'Postgres',
            'dbname' => 'phpVDB'
        ],
        'phpUnitTest' => [
            'driver' => 'pgsql',
            'host' => '127.0.0.1',
            'user' => 'postgres',
            'password' => 'Postgres',
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
        'pcData' => [
            'driver' => 'pgsql',
            'host' => 'SysInfo.rs.ru',
            'user' => 'SysInfoMac',
            'password' => 'k!vAknUsOuxD',
            'dbname' => 'SysInfo'
        ]
    ],
    'axl' => [
        'username' => 'netcmdbAXL',
        'password' => 'Dth.dAXL71',
    ],
    'snmp' => [
        'community' => 'RegionRS2005',
    ],
    'ssh' => [
        'login' => 'net-cmdb',
        'password' => '36q#QzmC',
    ],
    'appParams' => [
        'maxAge' => 73,
    ]
];
