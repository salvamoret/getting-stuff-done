<?php
// File: app/tests/GSD/Entities/TodoListTest.php

class TodoListTest extends TestCase
{
    public function setup()
    {
        App::bind('GSD\Repositories\RepositoryInterface', function()
        {
            return Mockery::mock('GSD\Repositories\RepositoryInterface');
        });
        App::bind('GSD\Entities\TaskCollectionInterface', function()
        {
            return Mockery::mock('GSD\Entities\TaskCollectionInterface');
        });
    }

    public function testBoundToInterface()
    {
        $obj = App::make('GSD\Entities\ListInterface');
        $this->assertInstanceOf('GSD\Entities\TodoList', $obj);
    }
}
