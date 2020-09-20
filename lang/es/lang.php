<?php

return [
    'plugin' => [
        'name' => 'Registro de acceso de usuarios',
        'description' => 'Registro de acceso de usuarios de front-end'
    ],
    'reportwidgets' => [
        'statistics' => [
            'label' => 'Estadísticas del registro de acceso',
            'title' => 'Título del Widget',
            'title_default' => 'Estadísticas de acceso',
            'title_validation' => 'El título es requerído',
        ],
        'chartline' => [
            'label' => 'Estadísticas del registro de acceso en el tiempo',
            'title' => 'Título del Widget',
            'title_default' => 'Estadísticas de acceso en el tiempo por usuario',
            'title_validation' => 'El título es requerído',
            'days_title' => 'Numero de días para los que se muestran datos',
        ],
        'chartlineaggregated' => [
            'label' => 'Estadísticas del registro de acceso en el tiempo totales',
            'title' => 'Título del Widget',
            'title_default' => 'Estadísticas de acceso en el tiempo',
            'title_validation' => 'El título es requerído',
            'days_title' => 'Numero de días para los que se muestran datos',
        ],
        'registrations' => [
            'label' => 'Registro de usuarios',
            'title' => 'Título del Widget',
            'title_default' => 'Nuevos registros',
            'title_validation' => 'El título es requerído',
            'days_title' => 'Numero de días para los que se muestran datos',
        ],
    ],
    'settings' => [
        'label' => 'Configurar el registro de acceso',
        'description' => 'Configuración del registro de acceso',
        'show_acces_log_listing' => 'Mostrar el registro de acceso en el menú de usuario',
    ],
];
