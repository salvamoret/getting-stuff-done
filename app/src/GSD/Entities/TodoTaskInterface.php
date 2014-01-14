<?php namespace GSD\Entities;

// File: app/src/GSD/Entities/TodoTaskInterface.php

interface TodoTaskInterface {
     /**
      * Has the task been completed?
      * @return boolean
      */
     public function isCompleted();

     /**
      * What's the description of the task
      * @return string
      */
     public function description();

     /**
      * When is the task due?
      * @return mixed Either null if no due date set, or a Carbon object
      */
     public function dateDue();

     /**
      * When was the task completed?
      * @return mixed Either null if not completed, or a Carbon object
      */
     public function dateCompleted();

     /**
      * Is the task a Next Action?
      * @return boolean
      */
     public function isNextAction();
}
