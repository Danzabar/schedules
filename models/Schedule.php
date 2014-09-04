<?php

use Doctrine\Common\Collections\ArrayCollection;

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
