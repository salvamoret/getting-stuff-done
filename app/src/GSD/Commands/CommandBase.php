<?php namespace GSD\Commands;

use App;
use Config;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Todo;

class CommandBase extends Command
{
	protected $repository;
	protected $nameArgumentDescription = 'List name.';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->repository = App::make( 'GSD\Repositories\RepositoryInterface' );
	}

	/**
	 * Prompt the user for a list id
	 *
	 * @param  boolean $existing    Prompt for existing list or new list?
	 * @param  boolean $allowCancel Allow user to cancel
	 * @param  boolean $archived    Use archived list?
	 *
	 * @return mixed string list id or null if user cancels
	 */
	public function askForListId( $existing = true, $allowCancel = true, $archived = false )
	{
		if ( $existing )
		{
			$title = 'Choose which list to destroy:';
			$abort = 'cancel - do not destroy a list';
			$choices = Todo::allLists();
			if ( count( $choices ) == 0 )
			{
				throw new \RuntimeException( 'No lists to choose from' );
			}
			$result = pick_from_list( $this, $title, $choices, 0, $abort );
			if ( $result == -1 )
			{
				return null;
			}
			return $choices[$result - 1];
		}

		$prompt = 'Enter name of new list';
		if ( $allowCancel )
		{
			$prompt .= ' (enter to cancel)';
		}
		$prompt .= '?';
		while ( true )
		{
			if ( ! ( $result = $this->ask( $prompt ) ) )
			{
				if ( $allowCancel )
				{
					return null;
				}
				$this->outputErrorBox( 'You must enter something' );
			}
			elseif ( $this->repository->exists( $result, $archived ) )
			{
				$this->outputErrorBox( "You already have a list named '$result'" );
			}
			else
			{
				return $result;
			}
		}
	}

	/**
	 * Output an error box
	 *
	 * @param  string $message The message
	 */
	protected function outputErrorBox( $message )
	{
		$formatter = $this->getHelperSet()->get( 'formatter' );
		$block = $formatter->formatBlock( $message, 'error', true );
		$this->line( '' );
		$this->line( $block );
		$this->line( '' );
	}

	/**
	 * Get the console command arguments. Derivated classes could replace this
	 * method entirely, or merge its own arguments with these.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array( '+name', InputArgument::OPTIONAL, $this->nameArgumentDescription ),
		);
	}

	/**
	 * Get the console command options. Derived classes could replace this
	 * method entirely, or merge its own options with these.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array( 'listname', 'l', InputOption::VALUE_REQUIRED,
			"Source of list name, 'prompt' or 'default'" ),
		);
	}

	protected function getListId()
	{
		$archived = $this->input->hasOption( 'archived' ) and
					$this->option( 'archived' );
		$name = $this->argument( '+name' );
		$listnameOption = $this->option( 'listname' );
		if ( $name )
		{
			$name = substr( $name, 1 );
			if ( ! is_null( $listnameOption ) )
			{
				throw new \InvalidArgumentException(
					'Cannot specify +name and --listname together' );
			}
		}
		else
		{
			if ( is_null( $listnameOption ) )
			{
				$listnameOption = Config::get( 'app.gsd.noListPrompt' )
					? 'prompt' : 'config';
			}
			if ( $listnameOption == 'prompt' )
			{
				$name = $this->askForListId( true, true, $archived );
				if ( is_null( $name ) )
				{
					return null;
				}
			}
			else
			{
				$name = Config::get( 'app.gsd.defaultList' );
			}
		}

		// Throw error if list doesn't exist
		if ( ! $this->repository->exists( $name, $archived ) )
		{
			$archived = ( $archived ) ? '(archived) ' : '';
			throw new \InvalidArgumentException( "List $archived'$name' not found" );
		}
		return $name;
	}
}
