<?php

return [
    'plugin' => [
        'name' => 'Benutzer-Zugriffsprotokoll',
        'description' => 'Zugriffsprotokoll der Frontend-Benutzer'
    ],
    'reportwidgets' => [
        'statistics' => [
            'label' => 'Zugriffsprotokoll-Statistiken',
            'title' => 'Widget-Titel',
            'title_default' => 'Zugriffstatistiken',
            'title_validation' => 'Der Titel wird benötigt',
        ],
        'chartline' => [
            'label' => 'Zugriffsprotokoll-Statistiken über Zeit',
            'title' => 'Widget-Titel',
            'title_default' => 'Zugriffstatistiken über Zeit per Benutzer',
            'title_validation' => 'Der Titel wird benötigt',
            'days_title' => 'Anzahl an Tagen, für die die Daten angezeigt werden sollen',
        ],
        'chartlineaggregated' => [
            'label' => 'Zugriffsprotokoll-Statistiken über Zeit kumuliert',
            'title' => 'Widget-Titel',
            'title_default' => 'Zugriffstatistiken über Zeit',
            'title_validation' => 'Der Titel wird benötigt',
            'days_title' => 'Anzahl an Tagen, für die die Daten angezeigt werden sollen',
        ],
        'registrations' => [
            'label' => 'Benutzer-Registrierungen',
            'title' => 'Widget-Titel',
            'title_default' => 'Neue Registrierungen',
            'title_validation' => 'Der Titel wird benötigt',
            'days_title' => 'Anzahl an Tagen, für die die Daten angezeigt werden sollen',
        ],
    ],
];