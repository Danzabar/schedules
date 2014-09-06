<?php

/**
 * @Entity
 * @Table(name="schedule_exclusions")
 */
Class Exclusion
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
	 * @Column(type="json_array")
	 */
	public $times;
	
	/**
	 * @ManyToOne(targetEntity="Schedule", inversedBy="exclusions") 
	 */
	private $schedules;
}
