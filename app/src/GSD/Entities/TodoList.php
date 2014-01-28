<?php namespace GSD\Entities;

// File: app/src/GSD/Entities/TodoList.php

use GSD\Repositories\RepositoryInterface;

class TodoList implements ListInterface
{
    protected $repository;
    protected $tasks;
    protected $attributes;

    /**
     * Inject the dependencies during construction
     * @param RepositoryInterface $repo The repository
     * @param TaskCollectionInterface $collection The task collection
     */
    public function __construct(RepositoryInterface $repo, TaskCollectionInterface $collection)
    {
        $this->repository = $repo;
        $this->tasks = $collection;
        $this->attributes = array();
    }

    // List attributes ----------------------------


    // List operations ----------------------------


    // Task operations ----------------------------


    // Not yet implemented ------------------------

    public function id()
    {
        throw new \Exception('not implemented');
    }

    public function isArchived()
    {
        throw new \Exception('not implemented');
    }

    public function isDirty()
    {
        throw new \Exception('not implemented');
    }

    public function get($name)
    {
        throw new \Exception('not implemented');
    }

    public function set($name, $value)
    {
        throw new \Exception('not implemented');
    }

    public function title()
    {
        throw new \Exception('not implemented');
    }

    public function archive()
    {
        throw new \Exception('not implemented');
    }

    public function load($id)
    {
        throw new \Exception('not implemented');
    }

    public function save()
    {
        throw new \Exception('not implemented');
    }

    public function taskAdd($task)
    {
        throw new \Exception('not implemented');
    }

    public function taskCount()
    {
        throw new \Exception('not implemented');
    }

    public function task($index)
    {
        throw new \Exception('not implemented');
    }

    public function taskGet($index, $name)
    {
        throw new \Exception('not implemented');
    }

    public function tasks()
    {
        throw new \Exception('not implemented');
    }

    public function taskSet($index, $name, $value)
    {
        throw new \Exception('not implemented');
    }

    public function taskRemove($index)
    {
        throw new \Exception('not implemented');
    }
}
