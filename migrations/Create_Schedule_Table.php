<?php

Class Create_Schedule_Table
{
	
	public function up()
	{
		Schema::builder()->create('schedules', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->text('description');
			$table->text('generated');
			$table->timestamps();
		});
	}


	public function down()
	{
		Schema::builder()->drop('schedules');
	}

}
