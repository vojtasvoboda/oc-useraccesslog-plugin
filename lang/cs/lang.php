<?php

return [
    'plugin' => [
        'name' => 'Logování přístupů',
        'description' => 'Logování přístupů front-end uživatelů'
    ],
    'reportwidgets' => [
        'statistics' => [
            'label' => 'Přehled přístupů do systému',
            'title' => 'Nadpis widgetu',
            'title_default' => 'Statistiky přístupů',
            'title_validation' => 'Nadpis widgetu je povinný',
        ],
        'chartlineaggregated' => [
            'label' => 'Přístupy v čase všech uživatelů',
            'title' => 'Nadpis widgetu',
            'title_default' => 'Statistiky přístupů všech',
            'title_validation' => 'Nadpis widgetu je povinný',
            'days_title' => 'Kolik dní zobrazit',
        ],
    ],
];