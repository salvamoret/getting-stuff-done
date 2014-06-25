<?php namespace GSD\Entities;

// File: app/src/GSD/Entities/TaskCollectionInterface.php

interface TaskCollectionInterface {

    /**
     * Add a new task to the collecion
     * @param string|TaskInterface $task Either a TaskInterface or a string
     *                                   we can construct one from.
     * @throws InvalidArgumentException If $task not string or TaskInterface
     */
    public function add( $task );

    /**
     * Return task based on index
     * @param integer $index 0 is first item in collection
     * @return TaskInterface The Todo Task
     * @throws OutOfBoundsException If $index outside range
     */
    public function get( $index );

    /**
     * Return array containing all tasks
     * @return array
     */
    public function getAll();

    /**
     * Remove the specified task
     * @param integer $index The task to remove
     * @throws OutOfBoundsException If $index outside range
     */
    public function remove( $index );
}
