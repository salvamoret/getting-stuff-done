<?php namespace GSD\Repositories;

// File: app/src/GSD/Repositories/TodoRepositoryInterface.php

use GSD\Entities\TodoListInterface;

interface TodoRepositoryInterface {

    /**
     * Load a TodoList from it's id
     * @param string $id ID of the list
     * @return TodoListInterface The list
     * @throws InvalidArgumentException If $id not found
     */
    public function load($id);

    /**
     * Save a TodoList
     * @param string $id ID of the list
     * @param TodoListInterface $list The TODO List
     */
    public function save($id, TodoListInterface $list);
}
