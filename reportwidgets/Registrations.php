<?php namespace VojtaSvoboda\UserAccessLog\ReportWidgets;

use App;
use ApplicationException;
use Carbon\Carbon;
use Exception;
use Backend\Classes\ReportWidgetBase;
use RainLab\User\Models\User;

/**
 * Registrations overview widget.
 *
 * @package namespace VojtaSvoboda\UserAccessLog\ReportWidgets
 */
class Registrations extends ReportWidgetBase
{
    /**
     * Renders the widget.
     */
    public function render()
    {
        try {
            $this->vars['registrations'] = $this->loadData();

        } catch (Exception $ex) {
            $this->vars['error'] = $ex->getMessage();
            $this->vars['registrations'] = [];
        }

        return $this->makePartial('widget');
    }

    public function defineProperties()
    {
        return [
            'title' => [
                'title' => 'vojtasvoboda.useraccesslog::lang.reportwidgets.registrations.title',
                'default' => 'New registrations',
                'type' => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'vojtasvoboda.useraccesslog::lang.reportwidgets.registrations.title_validation',
            ],
            'days' => [
                'title' => 'vojtasvoboda.useraccesslog::lang.reportwidgets.registrations.days_title',
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
        $items = User::where('created_at', '>=', Carbon::now()->subDays($days)->format('Y-m-d'))->get();

        // parse data
        $all = $this->sortItemsToDays($items);

        // we need at least two days, to display chart
        if (sizeof($all) == 1) {
            $day = reset($all);
            $date = Carbon::createFromFormat('Y-m-d', $day['date'])->subDays(1);
            $dateFormated = $date->format('Y-m-d');
            $all[$dateFormated] = [
                'timestamp' => $date->timestamp * 1000,
                'date' => $dateFormated,
                'count' => 0,
            ];
        }

        // count all
        $all_render = [];
        foreach ($all as $a) {
            $all_render[] = [$a['timestamp'], $a['count']];
        }

        return $all_render;
    }

    /**
     * Sort items by days.
     *
     * @param $items
     *
     * @return array
     */
    private function sortItemsToDays($items)
    {
        $all = [];

        foreach ($items as $item)
        {
            // date
            $timestamp = strtotime($item->created_at) * 1000;
            $day = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('Y-m-d');

            // init empty day
            if (!isset($all[$day])) {
                $all[$day] = [
                    'timestamp' => $timestamp,
                    'date' => $day,
                    'count' => 0,
                ];
            }

            // increase count
            $all[$day]['count']++;
        }

        return $all;
    }
}
