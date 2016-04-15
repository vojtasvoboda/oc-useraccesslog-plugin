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
 * AccessLogChartLine overview widget.
 *
 * @package namespace VojtaSvoboda\UserAccessLog\ReportWidgets
 */
class AccessLogChartLine extends ReportWidgetBase
{
    /**
     * Renders the widget.
     */
    public function render()
    {
        try {
            $this->vars['all'] = $this->loadData()['all'];
            $this->vars['rows'] = $this->loadData()['user_rows'];
            $this->vars['users'] = $this->loadData()['users'];

        } catch (Exception $ex) {
            $this->vars['error'] = $ex->getMessage();
            $this->vars['all'] = 0;
            $this->vars['users'] = [];
            $this->vars['rows'] = [];
        }

        return $this->makePartial('widget');
    }

	public function defineProperties()
	{
		return [
			'title' => [
                'title' => 'vojtasvoboda.useraccesslog::lang.reportwidgets.chartline.title',
                'default' => 'vojtasvoboda.useraccesslog::lang.reportwidgets.chartline.title_default',
				'type' => 'string',
				'validationPattern' => '^.+$',
				'validationMessage' => 'vojtasvoboda.useraccesslog::lang.reportwidgets.chartline.title_validation',
			],
            'days' => [
                'title' => 'vojtasvoboda.useraccesslog::lang.reportwidgets.chartline.days_title',
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
        $users = [];
        $user_rows = [];
        foreach ($items as $item)
        {
            // user
            $user_id = $item->user_id ? $item->user_id : 0;
            $users[$user_id] = $user_id > 0 ? User::find($user_id) : $this->getDeletedFakeUser();

            // date
            $timestamp = strtotime($item->created_at) * 1000;
            $day = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('Y-m-d');

            if (isset($user_rows[$user_id][$day])) {
                $user_rows[$user_id][$day][1]++;
            } else {
                $user_rows[$user_id][$day] = [$timestamp, 1];
            }

            if (isset($all[$day])) {
                $all[$day][1]++;
            } else {
                $all[$day] = [$timestamp, 1];
            }
        }

        // transform user line to json
        foreach ($user_rows as $key => $user_row) {
            $rows = [];
            foreach($user_row as $row) {
                $rows[] = [
                    $row[0],
                    $row[1],
                ];
            }
            $user_rows[$key] = $rows;
        }

        // count all
        $all_render = [];
        foreach ($all as $a) {
            $all_render[] = [$a[0], $a[1]];
        }

        return [
            'all' => $all_render,
            'user_rows' => $user_rows,
            'users' => $users,
        ];
    }

    /**
     * Get fake User object for deleted users
     *
     * @return \stdClass
     */
    public function getDeletedFakeUser()
    {
        $user = new \stdClass();
        $user->username = 'Deleted users';
        $user->name = 'Deleted';

        return $user;
    }

}
