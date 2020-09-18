<?php namespace VojtaSvoboda\UserAccessLog\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation as ValidationTrait;

class Settings extends Model
{
    use ValidationTrait;

    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'vojtasvoboda_useraccesslog_settings';

    public $settingsFields = 'fields.yaml';

    public $rules = [
        'show_access_log_listing' => 'boolean',
    ];

    public $attributeNames = [
        'show_access_log_listing' => 'Show access log listing',
    ];

    public function initSettingsData()
    {
        $this->show_access_log_listing = false;
    }
}
