<?php namespace GSD\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Todo;

class ListAllCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'gsd:listall';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Lists all todo lists (and possibly tasks).';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$archived = $this->option( 'archived' );
		$title = 'Listing all ';
		if ( $archived )
		{
			$title .= 'archived ';
		}
		$title .= 'lists';
		$this->info( $title );

		$lists = Todo::allLists( $archived );
		print_r( $lists );
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			// array( 'example', InputArgument::REQUIRED, 'An example argument.' ),
		 );
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array( 'archived', 'a', InputOption::VALUE_NONE, 'use archived lists?' ),
		 );
	}

}
