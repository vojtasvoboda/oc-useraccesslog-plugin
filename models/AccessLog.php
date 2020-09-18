<?php namespace VojtaSvoboda\UserAccessLog\Models;

use Model;
use RainLab\User\Models\User;
use Request;

/**
 * Model for logging access to the front-end
 */
class AccessLog extends Model
{
    /**
     * @var string The database table used by the model.
     */
    protected $table = 'user_access_log';

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'user' => [User::class],
    ];

    /**
     * Creates a log record.
     *
     * @param User $user Front-end user
     * @return self
     */
    public static function add($user)
    {
        $record = new static;
        $record->user = $user;
        $record->ip_address = Request::getClientIp();
        $record->save();

        return $record;
    }
}
