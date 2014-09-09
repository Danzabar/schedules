<?php

use Symfony\Component\Validator\Mapping\ClassMetadata;
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
	
	/**
	 * @ManyToOne(targetEntity="Schedule", inversedBy="activity")
	 */
	private $schedules;
	
	/**
	 * Returns the schedules collection
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function schedules()
	{
		return $this->schedules;
	}

	/**
	 * The validation rules for this model.
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public static function rules(ClassMetaData $metadata)
	{
		$metadata->addPropertyConstraint('label', new Assert\NotBlank(['message' => 'The Activity name is required']));
		$metadata->addPropertyConstraint('label', new Assert\Length([
			'min'	=> 2,
			'max'	=> 255,
			'minMessage' => 'The Activity name must be atleast {{ limit }} characters long',
			'maxMessage' => 'The Activity name must be no more than {{ limit }} characters long'
		]));
		
		$metadata->addGetterConstraint('optionSelected', new Assert\True([
			'message' => 'You must set either hours or explicit day/time option'
		]));
	}

	/**
	 * Checks whether there are either hours or day => times set
	 *
	 * @return Boolean
	 * @author Dan Cox
	 */
	public function isOptionSelected()
	{
		return ($this->hours > 0 || ($this->day != '' && $this->times != ''));
	}
	
	/**
	 * Sets the schedule_id attribute
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setSchedule($schedule)
	{
		$this->schedules = $schedule;
		return $this;
	}

	/**
	 * Gets the value of ID
	 *
	 * @return ID
	 */
	public function getID()
	{
		return $this->id;
	}

	/**
	 * Sets the value of ID
	 *
	 * @param ID $ID the activity id
	 *
	 * @return Activity
	 */
	public function setID($ID)
	{
		$this->id = $ID;
		return $this;
	}

	/**
	 * Gets the value of label
	 *
	 * @return label
	 */
	public function getLabel()
	{
		return $this->label;
	}

	/**
	 * Sets the value of label
	 *
	 * @param label $label the activity name
	 *
	 * @return Activity
	 */
	public function setLabel($label)
	{
		$this->label = $label;
		return $this;
	}

	/**
	 * Gets the value of day
	 *
	 * @return day
	 */
	public function getDay()
	{
		return $this->day;
	}

	/**
	 * Sets the value of day
	 *
	 * @param day $day the activity day
	 *
	 * @return Activity
	 */
	public function setDay($day)
	{
		$this->day = $day;
		return $this;
	}

	/**
	 * Gets the value of hours
	 *
	 * @return hours
	 */
	public function getHours()
	{
		return $this->hours;
	}

	/**
	 * Sets the value of hours
	 *
	 * @param hours $hours description
	 *
	 * @return Activity
	 */
	public function setHours($hours)
	{
		$this->hours = $hours;
		return $this;
	}

	/**
	 * Gets the value of Times
	 *
	 * @return Times
	 */
	public function getTimes()
	{
		return $this->time;
	}

	/**
	 * Sets the value of Times
	 *
	 * @param Times $Times the explicit times
	 *
	 * @return Activity
	 */
	public function setTimes($Times)
	{
		$this->time = $Times;
		return $this;
	}
}
