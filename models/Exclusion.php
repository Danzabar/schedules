<?php

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

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
	 * @Assert\NotBlank(message="The label field is required")
	 * @Assert\Length(
	 *		min=2,
	 *		max=255,
	 *		minMessage="The label field must be atleast {{ limit }} characters long",
	 *		maxMessage="The label field must be no more than {{ limit }} characters long"
	 * )
	 */
	public $label;
	
	/**
	 * @Column(type="string")
	 * @Assert\NotBlank(message="You must specify a valid day.")
	 * @Assert\Choice(
	 *		choices = {"Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday", "Everyday", "Weekend", "Weekday"}.
	 *		message = "Please select a valid day"	
	 * )
	 */
	public $day;

	/**
	 * @Column(type="json_array")
	 * @Assert\NotBlank(message="Please select a valid start and end time")
	 */
	public $times;
	
	/**
	 * @ManyToOne(targetEntity="Schedule", inversedBy="exclusions") 
	 */
	private $schedules;
}
