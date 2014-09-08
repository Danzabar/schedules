<?php

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Entity
 * @Table(name="schedules")
 */
Class Schedule
{
	/**
	 * @Id @Column(type="integer")
	 * @GeneratedValue
	 */
	public $id;
	
	/**
	 * @Column(type="string", unique=TRUE)
	 */
	public $name;

	/**
	 * @Column(type="text", nullable=TRUE)
	 */
	public $description;

	/**
	 * @Column(type="json_array", nullable=TRUE)
	 */
	public $generated;

	/**
	 * @Column(type="datetime")
	 */
	public $updated_at;

	/**
	 * @OneToMany(targetEntity="Exclusion", mappedBy="schedules", fetch="EXTRA_LAZY")
	 */
	private $excludes;

	/**
	 * @OneToMany(targetEntity="Activity", mappedBy="schedules", fetch="EXTRA_LAZY")
	 */
	private $activities;


	public function __construct()
	{
		$this->excludes = new ArrayCollection();

		$this->activities = new ArrayCollection();
	}

	/**
	 * Validation Rules
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public static function rules(ClassMetaData $metadata)
	{
		$metadata->addPropertyConstraint('name', new Assert\NotBlank(['message' => 'The Name field is required']));
		$metadata->addPropertyConstraint('name', new Assert\Length([
			'min'	=> 2,
			'max'	=> 255,
			'minMessage' => 'The name field must be atleast {{ limit }} characters long',
			'maxMessage' => 'The name field must be no more than {{ limit }} characters long'
		]));
			
	}

	/**
	 * Relationships
	 */
	public function excludes()
	{
		return $this->excludes;
	}

	public function activities()
	{
		return $this->activities;
	}
	
	/**
	 * Gets the value of name
	 *
	 * @return name
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Sets the value of name
	 *
	 * @param name $name the name of the schedule
	 *
	 * @return namer
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}	
	
	/**
	 * Gets the value of Description
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Sets the value of Description
	 *
	 * @param string $Description the description of the schedule
	 *
	 * @return string
	 */
	public function setDescription($description)
	{
		$this->description = $description;
		return $this;
	}

	/**
	 * Gets the value of Generated
	 *
	 * @return string
	 */
	public function getGenerated()
	{
		return $this->generated;
	}

	/**
	 * Sets the value of Generated
	 *
	 * @param string $Generated 
	 *
	 * @return Schedule	
	 */
	public function setGenerated(Array $generated)
	{
		$this->generated = $generated;
		return $this;
	}
	
	/**
	 * Gets the value of updated_at
	 *
	 * @return updated_at
	 */
	public function getUpdatedAt()
	{
		return $this->updated_at;
	}

	/**
	 * Sets the value of updated_at
	 *
	 * @param updated_at $updated_at description
	 *
	 * @return Schedule
	 */
	public function setUpdatedAt($updated_at)
	{
		$this->updated_at = new DateTime($updated_at);
		return $this;
	}
}
