<?php namespace VojtaSvoboda\UserAccessLog;

use System\Classes\PluginBase;
use Event;
use VojtaSvoboda\UserAccessLog\Models\AccessLog;

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
        /**
         * Log user after login
         */
        Event::listen('rainlab.user.login', function($user)
        {
            AccessLog::add($user);
        });
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
}
