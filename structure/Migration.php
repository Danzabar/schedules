<?php namespace Schedules\Structure;

use Symfony\Component\Finder\Finder;

Class Migration
{
    /**
     *  The contents of migration.json config file, as an object.
     * 
     */
    protected $migrations;
    
    /**
     *  Previously ran migrations, taken from the migration table.
     * 
     */
    protected $exclusions;
     
    /**
     *  An instance of the Symfony Finder component
     * 
     */
    protected $finder;
    
    /**
     *  The directory in which migrations are stored. 
     *  This gets ROOT constant prepended to it.
     * 
     */
    public $dir = '/migrations/';
    
    public function __construct()
    {
        // Start the schema
        new Schema;      
        
        $this->finder = new Finder;
        
        $this->exclusions = [];
    }

	/**
	 * Installs migrations, adds the migration table to the database.
	 *
	 *
	 */
    public static function install()
    {
        Schema::builder()->create('migrations', function($table)
        {
           $table->increments('id');
           $table->string('file');
           $table->timestamp('ran_on'); 
        });        
    }

	/**
	 * Cycles through the files in the migrations directory and processes the ones that
	 * have no been previously ran.
	 *
	 */
    public function process($direction, $batch = NULL)
    {        
        $this->buildExclusions();
        
        $files = $this->finder->files()->in( dirname(__DIR__) . $this->dir);
		
		$files->sortByName();

		if(!empty($files))
        {
            foreach($files as $file)
            {            
				$this->$direction($file);
            }
        }
    }

	/**
	 * builds an array of previously ran migrations
	 *
	 */
    private function buildExclusions()
    {
        $data = $this->getMigrations(); 
				
		if(!empty($data))
        {
            foreach($data as $d)
            {
                $this->exclusions[] = $d['file'];
            }
        }
    }

	/**
	 * Uses symfonys finder and Robbo schema class to process the up
	 * function on a migration.
	 *
	 */
    private function up($file)
    {        
        // Check Exclusions
        if(!isset($this->exclusions) || !in_array($file->getFileName(), $this->exclusions))
        {
            require_once($file->getRealPath());
            
            $className = str_replace('.php', '', $file->getFileName());
            
            $class = new $className;
            
            $class->up();
            
          	$this->addMigration($file->getFileName()); 
        }
    }

	/**
	 * Uses symfonys finder and Robbo schema class to process the down
	 * function on a migration.
	 *
	 */
    private function down($file)
    {       
        // Check if they have a record in exclusions
        if(isset($this->exclusions) && in_array($file->getFileName(), $this->exclusions))
        {
            require_once($file->getRealPath());
            
            $className = str_replace('.php', '', $file->getFileName());
            
            $class = new $className;
            
            $class->down();
     	       
        	$this->deleteMigration($file->getFileName());   
        }
	}


	private function addMigration($name)
	{
		$query = "INSERT INTO migrations(`file`, `ran_on`) VALUES (:file, :ran_on)";
		Database::sql()->query($query, ['file' => $name, 'ran_on' => date('Y-m-d H:i:s')]);
	}

	private function deleteMigration($name)
	{
		$query = "DELETE FROM migrations WHERE file = :file";
		Database::sql()->query($query, ['file' => $name]);
	}

	private function getMigrations()
	{
		$query = "SELECT * FROM migrations";
		return Database::sql()->fetchAssoc($query);
	}
}
