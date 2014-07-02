<?php namespace GSD\Commands;

use App;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Todo;

class CommandBase extends Command
{

	protected $repository;

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
			if ( ! ( $result = $this->ask( $prompt ) ))
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

	protected function outputErrorBox( $message )
	{
		$formatter = $this->getHelperSet()->get( 'formatter' );
		$block = $formatter->formatBlock( $message, 'error', true );
		$this->line( '' );
		$this->line( $block );
		$this->line( '' );
	}
}
