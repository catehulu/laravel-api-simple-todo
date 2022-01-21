<?php

namespace App\Service;

use App\Repository\CategoryRepository;
use App\Repository\TaskRepository;

class TaskService extends BaseService
{
    public function createTask(array $task)
    {
        $status = (new TaskRepository)->createFromArray($task);
        if ($status) {
            return [
                'error' => 1
            ];
        }

        return [
            'error' => 0
        ];;
    }

    public function deleteTask(array $task)
    {
        $status = (new TaskRepository)->deleteTaskById($task['id']);
        if ($status) {
            return [
                'error' => 1
            ];
        }

        return [
            'error' => 0
        ];;
    }

    public function updateTask(array $task)
    {
        $status = (new TaskRepository)->updateFromArray($task);
        if ($status) {
            return [
                'error' => 1
            ];
        }

        return [
            'error' => 0
        ];;
    }

    public function getAllTask()
    {
        return (new TaskRepository)->getAllTask();
    }

    public function getUnfinishedTask()
    {
        return (new TaskRepository)->getUnfinishedTask();
    }

    public function getPriorityTask()
    {
        $priorityTask = [];
        $allTask = (new TaskRepository)->getAllTask();
        foreach ($allTask as $task) {
            $priorityTask[$task->priority][] = $task;
        }

        ksort($priorityTask);
        return $priorityTask;
    }

    public function getGroupTask()
    {
        $groupedTask = [];
        $allCategory = (new CategoryRepository)->getAllCategory();
        $uncategorizedTask = (new TaskRepository)->getTaskByCategoryId();
        $groupedTask['Uncategorized'][] = $uncategorizedTask;
        foreach ($allCategory as $category) {
            $categorizedTask = (new TaskRepository)->getTaskByCategoryId($category->id);
            $groupedTask[$category->detail][] = $categorizedTask;
        }
    
        return $groupedTask;
    }
}
