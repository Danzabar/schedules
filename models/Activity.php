<?php

/**
 * @Entity
 * @Table(name="schedule_activities")
 */
Class Activity
{
	
	/**
	 * @Id @Column(type="integer")
	 * @GeneratedValue
	 */
	public $id;

	/**
	 * @Column(type="string")
	 */
	public $label;

	/**
	 * @Column(type="string")
	 */
	public $day;

	/**
	 * @Column(type="integer")
	 */
	public $hours;

	/**
	 * @Column(type="json_array", nullable=TRUE)
	 */
	public $times;

}
