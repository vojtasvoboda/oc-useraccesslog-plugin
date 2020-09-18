<?php namespace VojtaSvoboda\UserAccessLog;

use Backend;
use Event;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;
use VojtaSvoboda\UserAccessLog\Models\AccessLog;
use VojtaSvoboda\UserAccessLog\Models\Settings;

/**
 * UserAccessLog Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * @var array Plugin dependencies
     */
    public $require = [
        'RainLab.User',
    ];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'vojtasvoboda.useraccesslog::lang.plugin.name',
            'description' => 'vojtasvoboda.useraccesslog::lang.plugin.description',
            'author'      => 'Vojta Svoboda',
            'icon'        => 'icon-user',
            'homepage'    => 'https://github.com/vojtasvoboda/oc-useraccesslog-plugin'
        ];
    }

    public function boot()
    {
        // log user after login
        Event::listen('rainlab.user.login', function ($user) {
            AccessLog::add($user);
        });

        // extend users side-menu with User Access log
        if (!empty(Settings::get('show_access_log_listing', false))) {
            Event::listen('backend.menu.extendItems', function ($manager) {
                $manager->addSideMenuItem('RainLab.User', 'user', 'access_log', [
                    'label' => 'backend::lang.access_log.menu_label',
                    'url' => Backend::url('vojtasvoboda/useraccesslog/log'),
                    'icon' => 'icon-list',
                    'order' => 300,
                ]);
            });
        }
    }

    public function registerReportWidgets()
    {
        return [
            'VojtaSvoboda\UserAccessLog\ReportWidgets\AccessLogStatistics' => [
                'label'   => 'vojtasvoboda.useraccesslog::lang.reportwidgets.statistics.label',
                'context' => 'dashboard',
            ],
            'VojtaSvoboda\UserAccessLog\ReportWidgets\AccessLogChartLine' => [
                'label'   => 'vojtasvoboda.useraccesslog::lang.reportwidgets.chartline.label',
                'context' => 'dashboard',
            ],
            'VojtaSvoboda\UserAccessLog\ReportWidgets\AccessLogChartLineAggregated' => [
                'label'   => 'vojtasvoboda.useraccesslog::lang.reportwidgets.chartlineaggregated.label',
                'context' => 'dashboard',
            ],
            'VojtaSvoboda\UserAccessLog\ReportWidgets\Registrations' => [
                'label'   => 'vojtasvoboda.useraccesslog::lang.reportwidgets.registrations.label',
                'context' => 'dashboard',
            ],
        ];
    }

    public function registerSettings()
    {
        return [
            'config' => [
                'label' => 'vojtasvoboda.useraccesslog::lang.settings.label',
                'category' => SettingsManager::CATEGORY_USERS,
                'icon' => 'icon-cog',
                'description' => 'vojtasvoboda.useraccesslog::lang.settings.description',
                'class' => Settings::class,
                'permissions' => ['vojtasvoboda.useraccesslog.*'],
                'order' => 600,
            ]
        ];
    }
}
