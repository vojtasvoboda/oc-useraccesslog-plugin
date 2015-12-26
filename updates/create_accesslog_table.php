<?php

namespace VojtaSvoboda\UserAccessLog\Updates;

use Schema;
use Illuminate\Support\Facades\DB;
use October\Rain\Database\Updates\Migration;

class CreateAccessLogTable extends Migration
{

	public function up()
	{
		Schema::create('user_access_log', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');

			$table->integer('user_id')->unsigned()->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

			$table->string('ip_address')->nullable();

			$table->timestamps();
		});
	}

	public function down()
	{
		DB::statement("SET foreign_key_checks = 0");
		Schema::table('user_access_log', function($table)
		{
			$table->dropForeign('user_access_log_user_id_foreign');
		});
		Schema::dropIfExists('user_access_log');
		DB::statement("SET foreign_key_checks = 1");
	}

}
