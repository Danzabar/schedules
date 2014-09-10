<?php

use Symfony\Component\Validator\Mapping\ClassMetadata;
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
	
	/**
	 * The validation rules for this model
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public static function rules(ClassMetaData $metadata)
	{
		$metadata->addPropertyConstraint('label', new Assert\NotBlank(['message' => 'The Exclusion name is required']));
		$metadata->addPropertyConstraint('label', new Assert\Length([
			'min'	=> 2,
			'max'	=> 255,
			'minMessage' => 'The Exclusion name must be atleast {{ limit }} characters long',
			'maxMessage' => 'The Exclusion name must be no more than {{ limit }} characters long'
		]));
		
		$metadata->addPropertyConstraint('day', new Assert\NotBlank(['message' => 'You must select a day for the exclusion']));
		$metadata->addPropertyConstraint('times', new Assert\NotBlank(['message' => 'Please specify the times for this exclusion']));	
	}
	
	/**
	 * Sets the relationship between schedule and exclusion
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
	 * Gets and returns the schedule relationship
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function schedules()
	{
		return $this->schedules;
	}

	/**
	 * Gets the value of id
	 *
	 * @return id
	 */
	public function getID()
	{
		return $this->id;
	}

	/**
	 * Sets the value of id
	 *
	 * @param id $id the exclusion id
	 *
	 * @return Exclusion
	 */
	public function setID($id)
	{
		$this->id = $id;
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
	 * @param label $label the name of the exclude
	 *
	 * @return Exclusion
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
	 * @param day $day the day of exclude
	 *
	 * @return Exclusion
	 */
	public function setDay($day)
	{
		$this->day = $day;
		return $this;
	}

	/**
	 * Gets the value of Times
	 *
	 * @return Times
	 */
	public function getTimes()
	{
		return $this->times;
	}

	/**
	 * Sets the value of Times
	 *
	 * @param Times $Times the time of the exclude
	 *
	 * @return Exclusion
	 */
	public function setTimes($times)
	{
		$this->times = $times;
		return $this;
	}
}
