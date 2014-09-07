<?php

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Validation;
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
	 * @Assert\NotBlank(message="The name field is required")
	 * @Assert\Length(
	 * 		min=2, 
	 * 		max=255,
	 * 		minMessage="The name must be atleast {{ limit }} characters long"
	 * 		maxMessage="The name must be no more than {{ limit  }} characters long"
	 * )
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

}
