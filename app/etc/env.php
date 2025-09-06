<?php
return [
    'backend' => [
        'frontName' => 'adminpanel'
    ],
    'remote_storage' => [
        'driver' => 'file'
    ],
    'cache' => [
        'graphql' => [
            'id_salt' => 'qAzp333a0Ij4jcA8KJewsynViRFrlSYv'
        ],
        'frontend' => [
            'default' => [
                'id_prefix' => '3b8_'
            ],
            'page_cache' => [
                'id_prefix' => '3b8_'
            ]
        ],
        'allow_parallel_generation' => false
    ],
    'config' => [
        'async' => 0
    ],
    'queue' => [
        'consumers_wait_for_messages' => 1
    ],
    'crypt' => [
        'key' => 'base64AlRKXadnkU/iGzsTbh5QmkQ46hl60+uAWbPFSqZcpyM='
    ],
    'db' => [
        'table_prefix' => '',
        'connection' => [
            'default' => [
                'host' => 'localhost',
                'dbname' => 'oldwebsite',
                'username' => 'adagiointeriors_dev',
                'password' => 'Adagio@7294#',
                'model' => 'mysql4',
                'engine' => 'innodb',
                'initStatements' => 'SET NAMES utf8;',
                'active' => '1',
                'driver_options' => [
                    1014 => false
                ]
            ]
        ]
    ],
    'csp' => [
        'report_only' => true,
        'enabled' => true
    ],
    'resource' => [
        'default_setup' => [
            'connection' => 'default'
        ]
    ],
    'x-frame-options' => 'SAMEORIGIN',
    'MAGE_MODE' => 'production',
    'session' => [
        'save' => 'files'
    ],
    'lock' => [
        'provider' => 'db'
    ],
    'directories' => [
        'document_root_is_pub' => true
    ],
    'cache_types' => [
        'config' => 1,
        'layout' => 1,
        'block_html' => 1,
        'collections' => 1,
        'reflection' => 1,
        'db_ddl' => 1,
        'compiled_config' => 1,
        'eav' => 1,
        'customer_notification' => 1,
        'config_integration' => 1,
        'config_integration_api' => 1,
        'graphql_query_resolver_result' => 1,
        'full_page' => 1,
        'config_webservice' => 1,
        'translate' => 1
    ],
    'downloadable_domains' => [
        'dev.adagiointeriors.com'
    ],
    'install' => [
        'date' => 'Sun, 22 Jun 2025 05:17:09 +0000'
    ],
    'search' => [
        'engine' => 'opensearch',
        'opensearch_server_hostname' => 'localhost',
        'opensearch_server_port' => '9200',
        'opensearch_index_prefix' => 'magento2',
        'opensearch_enable_auth' => '0',
        'opensearch_server_timeout' => '15'
    ]
];
