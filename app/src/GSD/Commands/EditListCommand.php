<?php namespace GSD\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Todo;

class EditListCommand extends CommandBase
{
	protected $name = 'gsd:editlist';
	protected $description = "Edit a list's title or subtitle.";
	protected $nameArgumentDescription = 'List name to edit.';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$name = $this->getListId();
		var_dump( $name );
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array_merge( parent::getOptions(), array(
			array( 'title', 't', InputOption::VALUE_REQUIRED, 'Title of list.', null ),
			array( 'subtitle', 's', InputOption::VALUE_REQUIRED, 'Subtitle of list.', null ),
		) );
	}

}
