<?php namespace VojtaSvoboda\UserAccessLog\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Log Back-end Controller
 */
class Log extends Controller
{
    public $implement = [
        'Backend.Behaviors.ListController',
    ];

    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('RainLab.User', 'user', 'access_log');
    }
}
