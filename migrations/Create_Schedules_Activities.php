<?php

Class Create_Schedules_Activities
{
	
	public function up()
	{
		Schema::builder()->create('schedule_activities', function($table)
		{
			$table->increments('id');
			$table->integer('schedule_id')->unsigned();
			$table->string('label');
			$table->string('day');
			$table->integer('hours');
			$table->text('times')->nullable();
			$table->timestamps();

			$table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::builder()->drop('schedule_activities');
	}
}
