<?php

return [

    'components' => [
        'backup_destination_list' => [],
        'backup_destination_status_list' => [],
    ],
            'table' => [
                'actions' => [
                    'delete' => 'Удалить',
                    'download' => 'Скачать',
                ],
                'fields' => [
                    'date' => 'Дата',
                    'disk' => 'Диск',
                    'path' => 'Путь',
                    'size' => 'Размер',
                ],
                'filters' => [
                    'disk' => 'Диск',
                ],
            ],
            'table' => [
                'fields' => [
                    'amount' => 'Количество',
                    'disk' => 'Диск',
                    'healthy' => 'Исправен',
                    'name' => 'Имя',
                    'newest' => 'Последний',
                    'used_storage' => 'Объём в хранилище',
                ],
            ],
    'pages' => [
        'backups' => [
            'actions' => [],
            'heading' => 'Резервные копии',
            'messages' => [],
            'modal' => [],
        ],
    ],
                'create_backup' => 'Создать резервную копию',
                'backup_delete_success' => 'Удаление этой резервной копии в фоновом режиме.',
                'backup_success' => 'Создание новой резервной копии в фоновом режиме.',
                'buttons' => [
                    'db_and_files' => 'База и файлы',
                    'only_db' => 'Только база',
                    'only_files' => 'Только файлы',
                ],
                'label' => 'Пожалуйста, выберите опцию',
            'navigation' => [
                'group' => 'Настройки',
                'label' => 'Резервные копии',
            ],

];
