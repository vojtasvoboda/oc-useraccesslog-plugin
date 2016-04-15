<?php

namespace VojtaSvoboda\UserAccessLog;

use Event;
use VojtaSvoboda\UserAccessLog\Models\AccessLog;
use System\Classes\PluginBase;

/**
 * UserAccessLog Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * @var array Plugin dependencies
     */
    public $require = ['RainLab.User'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'vojtasvoboda.useraccesslog::lang.plugin.name',
            'description' => 'vojtasvoboda.useraccesslog::lang.plugin.description',
            'author' => 'Vojta Svoboda',
            'icon' => 'icon-user',
        ];
    }

    public function boot()
    {
        /**
         * Log user after login
         */
        Event::listen('rainlab.user.login', function ($user) {
            AccessLog::add($user);
        });
    }

    public function registerReportWidgets()
    {
        return [
            'VojtaSvoboda\UserAccessLog\ReportWidgets\AccessLogStatistics' => [
                'label' => 'vojtasvoboda.useraccesslog::lang.reportwidgets.statistics.label',
                'context' => 'dashboard'
            ],
            'VojtaSvoboda\UserAccessLog\ReportWidgets\AccessLogChartLine' => [
                'label'   => 'vojtasvoboda.useraccesslog::lang.reportwidgets.chartline.label',
                'context' => 'dashboard',
            ],
            'VojtaSvoboda\UserAccessLog\ReportWidgets\AccessLogChartLineAggregated' => [
                'label'   => 'vojtasvoboda.useraccesslog::lang.reportwidgets.chartlineaggregated.label',
                'context' => 'dashboard',
            ],
        ];
    }

}
