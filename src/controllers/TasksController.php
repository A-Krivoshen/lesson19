<?php

namespace controllers;

use models\Tasks\Task;
use models\Tasks\TaskTable;

class TasksController
{

    public function add()
    {
        $task = new Task;
        $task->addTask();
    }

    public function changeStatus()
    {
        $task = new Task;
        return json_encode($task->changeTaskStatus());
    }

    public function getLastTask()
    {
        $task = new Task;
        return json_encode($task->getLastTaskOfUser());
    }

    public function delete()
    {
        $task = new Task;
        $task->deleteTask();
    }

    public function editDescription()
    {
        $task = new Task;
        return json_encode($task->editTask());
    }

    public function sort($sortingType)
    {
        $table = new TaskTable;
        return json_encode($table->sortTable($sortingType));
    }

    public function changeAssignedUser($assignedUser)
    {
        $task = new Task;
        return json_encode($task->changeAssignedUser($assignedUser));
    }
}