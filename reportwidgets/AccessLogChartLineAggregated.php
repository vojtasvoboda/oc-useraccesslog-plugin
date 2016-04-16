<?php

namespace VojtaSvoboda\UserAccessLog\ReportWidgets;

use App;
use ApplicationException;
use Carbon\Carbon;
use Exception;
use Backend\Classes\ReportWidgetBase;
use VojtaSvoboda\UserAccessLog\Models\AccessLog;
use RainLab\User\Models\User;

/**
 * AccessLogChartLineAggregated overview widget.
 *
 * @package namespace VojtaSvoboda\UserAccessLog\ReportWidgets
 */
class AccessLogChartLineAggregated extends ReportWidgetBase
{
    /**
     * Renders the widget.
     */
    public function render()
    {
        try {
            $this->vars['all'] = $this->loadData();
        }
        catch (Exception $ex) {
            $this->vars['error'] = $ex->getMessage();
            $this->vars['all'] = '';
        }

        return $this->makePartial('widget');
    }

    /**
     * Define widget properties
     *
     * @return array
     */
	public function defineProperties()
	{
		return [
			'title' => [
				'title' => 'vojtasvoboda.useraccesslog::lang.reportwidgets.chartlineaggregated.title',
				'default' => 'Access statistics in time',
				'type' => 'string',
				'validationPattern' => '^.+$',
				'validationMessage' => 'vojtasvoboda.useraccesslog::lang.reportwidgets.chartlineaggregated.title_validation',
			],
            'days' => [
                'title' => 'vojtasvoboda.useraccesslog::lang.reportwidgets.chartlineaggregated.days_title',
                'default' => '30',
                'type' => 'string',
                'validationPattern' => '^[0-9]+$',
            ]
		];
	}

    protected function loadData()
    {
        $days = $this->property('days');
        if (!$days) {
            throw new ApplicationException('Invalid days value: ' . $days);
        }

        // all accesses for last month
        $items = AccessLog::where('created_at', '>=', Carbon::now()->subDays($days)->format('Y-m-d'))->get();

        // parse data
        $all = [];
        foreach ($items as $item)
        {
            // date
            $timestamp = strtotime($item->created_at) * 1000;
            $day = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('Y-m-d');

            if (isset($all[$day])) {
                $all[$day][1]++;
            } else {
                $all[$day] = [$timestamp, 1];
            }
        }

        // count accessess for each day
        $all_render = [];
        foreach ($all as $a) {
            $all_render[] = [$a[0], $a[1]];
        }

        return $all_render;
    }

}
