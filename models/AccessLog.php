<?php

namespace VojtaSvoboda\UserAccessLog\Models;

use Model;
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
		'user' => ['RainLab\User\Models\User']
	];

	/**
	 * Creates a log record
	 *
	 * @param \RainLab\User\Models\User $user Front-end user
	 *
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
