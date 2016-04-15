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
        'chartline' => [
            'label' => 'Přístupy v čase jednotlivců',
            'title' => 'Nadpis widgetu',
            'title_default' => 'Statistiky přístupů jednotlivců',
            'title_validation' => 'Nadpis widgetu je povinný',
            'days_title' => 'Kolik dní zobrazit',
        ],
        'chartlineaggregated' => [
            'label' => 'Přístupy v čase všech uživatelů',
            'title' => 'Nadpis widgetu',
            'title_default' => 'Statistiky přístupů všech',
            'title_validation' => 'Nadpis widgetu je povinný',
            'days_title' => 'Kolik dní zobrazit',
        ],
        'registrations' => [
            'label' => 'Registrace uživatelů v čase',
            'title' => 'Nadpis widgetu',
            'title_default' => 'Nové registrace',
            'title_validation' => 'Nadpis widgetu je povinný',
            'days_title' => 'Kolik dní zobrazit',
        ],
    ],
];