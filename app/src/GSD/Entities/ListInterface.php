<?php namespace GSD\Entities;

// File: app/src/GSD/Entities/ListInterface.php

interface ListInterface {

    // List attributes ----------------------

    /**
     * Get the id
     * @return integer The id
     */
    public function id();

    /**
     * Is the list archived?
     * @return boolean
     */
    public function isArchived();

    /**
     * Is the list dirty?
     * @return boolean
     */
    public function isDirty();

    /**
     * Return a list atribute
     * @param string $name The attribute id|archived|subtitle|title
     * @return mixed The attribute value
     * @throws InvalidArgumentException If $name is invalid
     */
    public function get($name);

    /**
     * Set a list attribute
     * @param string $name The attribute id|archived|subtitle|title
     * @param mixed $value The attribute value
     * @return ListInterface For method chaining
     * @throws InvalidArgumentException If $name is invalid
     */
    public function set($name, $value);

    /**
     * Return the title (alias for get('title'))
     * @return string
     */
    public function title();

    // List operations ----------------------

    /**
     * Archive the list. This make the list only available from the archive.
     * @return ListInterface For method chaining
     */
    public function archive();

    /**
     * Save the task list
     * @return ListInterface For method chaining
     */
    public function save();

    // Tasks operations -----------------------------

    /**
     * Add a new task to the collection
     * @param string|TaskInterface $task Either a TaskInterface or a string we
     *                                   can construct one from
     * @return ListInterface For method chaining
     */
    public function taskAdd($task);

    /**
     * Return number of tasks
     * @return integer
     */
    public function taskCount();

    /**
     * Return a task
     * @param integer $index The index of the task
     * @return TaskInterface The task
     * @throws OutOfBoundsException If $index outside range
     */
    public function task($index);

    /**
     * Return a task attribute
     * @param integer $index Task index #
     * @param string $name Attribute name
     * @return mixed The attribute value
     * @throws OutOfBoundsException If $index is outside range
     * @throws InvalidArgumentException If $name is invalid
     */
    public function taskGet($index, $name);

    /**
     * Return all tasks as an array
     * @return array All the TaskInterface objects
     */
    public function tasks();

    /**
     * Set a task attribute
     * @param integer $index Task index #
     * @param string $name Attribute name
     * @param mixed $value Attribute value
     * @return ListInterface For method chaining
     * @throws OutOfBoundsException If $index outside range
     * @throws InvalidArgumentException If $name is invalid
     */
    public function taskSet($index, $name, $value);

    /**
     * Remove the specified task
     * @param integer $index Tasl index #
     * @return $this For method chaining
     * @throws OutOfBoundsException If $index outside range
     */
    public function taskRemove($index);
}
