<?php
use Illuminate\Console\Command;

/**
 * Return TRUE if every arg is null.
 * @usage all_null( arg1, arg2, ... )
 * @return boolean
 */
function all_null()
{
    foreach ( func_get_args() as $arg )
    {
        if ( ! is_null( $arg ) )
        {
            return false;
        }
    }
    return true;
}

/**
 * Return TRUE if a value is between two other values
 *
 * @param  integer  $value     the value
 * @param  integer  $min       the min value
 * @param  integer  $max       the max value
 * @param  boolean $inclusive Inclusive min and max?
 *
 * @return boolean             If the value is between the min and the max
 */
function between( $value, $min, $max, $inclusive = true )
{
    if ( $inclusive )
    {
        return ( $value >= $min and $value <= $max );
    }
    return ( $value > $min and $value < $max );
}

/**
 * Present a list of choices to user, return choice
 *
 * @param  Command $command The command requesting input
 * @param  string  $title   The title of list
 * @param  array   $choices List of choices
 * @param  integer $default Default choice ( 1-array size )
 * @param  string  $abort   String to tag on end for aborting selection
 * @throws InvalidArgumentException If argument is invalid
 */
function pick_from_list( Command $command, $title, array $choices, $default = 0, $abort = null )
{
    if ( $abort )
    {
        $choices[] = $abort;
    }
    $numChoices = count( $choices );
    if ( ! $numChoices )
    {
        throw new \InvalidArgumentException( "Must have at least one choice" );
    }
    if ( $default > $numChoices || $default < 0 )
    {
        throw new \InvalidArgumentException( "Invalid value, default=$default" );
    }
    $question = "Please select 1 to $numChoices";
    if ( $default > 0 )
    {
        $question .= " ( default is $default )";
    }
    elseif ( $default < 0 )
    {
        $question .= " ( enter to abort )";
    }
    $question .= '?';
    while ( 1 )
    {
        $command->info( $title );
        for ( $i = 0; $i < $numChoices ; $i++ )
        {
            $command->line( ( $i + 1 ) . ". " . $choices[$i] );
        }
        $answer = $command->ask( $question );
        if ( $answer == '' )
        {
            $answer = $default;
        }
        if ( between( $answer, 1, $numChoices ) )
        {
            if ( $abort and $answer == $numChoices )
            {
                $answer = -1;
            }
            return ( int )$answer;
        }
    }
}
