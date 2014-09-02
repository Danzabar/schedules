<?php

Class Create_Schedule_Activities_Table
{
	
	public function up()
	{
		Schema::builder()->create('schedule_activities', function($table)
		{
			$table->increments('id');
			$table->integer('schedule_id')->unsigned();
			$table->string('label');
			$table->string('day');
			$table->text('times');
			$table->timestamps();

			$table->foreign('schedule_id')->references('id')->on('schedules')->onUpdate('cascade')->onDelete('cascade');	
		});	
	}

	public function down()
	{
		Schema::builder()->drop('schedule_activities');
	}
}
