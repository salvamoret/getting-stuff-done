<?php namespace GSD\Entities;

// File: app/src/GSD/Entities/TodoListInterface.php

interface TodoListInterface {

    /**
     * Load the task list by id
     * @param integer $id The id of the list
     * @return TodoListInterface The list
     */
    public function load($id);

    /**
     * Save the task list
     */
    public function save();

    /**
     * Get the id
     * @return integer The id
     */
    public function id();

    /**
     * Is the list dirty?
     * @return boolean
     */
    public function isDirty();

    /**
     * Return a list atribute
     * @param string $name The attribute
     * @return string The attribute value
     */
    public function get($name);

    /**
     * Set a list attribute
     * @param string $name The attribute
     * @param string $value The attribute value
     */
    public function set($name, $value);

    /**
     * Return the title (alias for get('title'))
     * @return string
     */
    public function title();

    /**
     * Add a new task to the collection
     * @param TodoTaskInterface $task
     */
    public function addTask(TodoTaskInterface $task);

    /**
     * Return a task
     * @param integer $index The index of the task
     * @return TodoTaskInterface The task
     */
    public function getTask($index);

    /**
     * Return all tasks
     * @return TodoTaskCollectionInterface All tasks as an TodoTaskCollection
     */
    public function allTasks();

    /**
     * Remove the specified task
     */
    public function removeTask($index);
}
