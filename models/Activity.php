<?php

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

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
	 * @Assert\NotBlank(message="The label field is required")
	 * @Assert\Length(
	 *		min=2,
	 *		max=255,
	 *		minMessage="The label field should be atleast {{ limit }} characters long",
	 *		maxMessage="The label field should be no more than {{ limit }} characters long"
	 * )
	 */
	public $label;

	/**
	 * @Column(type="string")
	 * @Assert\NotBlank(message="Please select a valid day/s")
	 * @Assert\Choice(
	 *		choices = {"Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday", "Everyday", "Weekday", "Weekend"},
	 *		message = "Please select a valid day/s"
	 * )
	 */
	public $day;

	/**
	 * @Column(type="integer")
	 * @Assert\NotBlank(message="Please specify the hours you would like to spend on this")
	 */
	public $hours;

	/**
	 * @Column(type="json_array", nullable=TRUE)
	 */
	public $times;
	
	/**
	 * @ManyToOne(targetEntity="Schedule", inversedBy="activity")
	 */
	private $schedules;
}
