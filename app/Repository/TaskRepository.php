<?php

namespace App\Repository;

use App\Models\Task;

class TaskRepository extends BaseRepository
{
    public function createFromArray(array $task)
    {
        try {
            $newTask = new Task();
            $newTask->detail = $task['detail'];
            $newTask->priority = $task['priority'];
            $newTask->category_id = null;
            $newTask->status_id = 1;
            $newTask->date = $task['date'];

            $newTask->save();
            return 0;
        } catch (\Throwable $th) {
            return 1;
        }
    }

    public function deleteTaskById(string $taskId)
    {
        try {
            $task = Task::find($taskId);
            if ($task) {
                $task->delete();
            }
            return 0;
        } catch (\Throwable $th) {
            return 1;
        }
    }

    public function updateFromArray(array $task)
    {
        try {
            $newTask = Task::find($task['id']);
            $newTask->detail = $task['detail'] ?? $newTask->detail;
            $newTask->priority = $task['priority'] ?? $newTask->priority;
            $newTask->category_id = $task['category_id'] ?? $newTask->category_id;
            $newTask->status_id = $task['status_id'] ??  $newTask->status_id;
            $newTask->date = $task['date'] ?? $newTask->date;

            $newTask->save();
            return 0;
        } catch (\Throwable $th) {
            return 1;
        }
    }

    public function getAllTask()
    {
        return Task::all() ?? [];
    }

    public function getTaskByCategoryId(?string $categoryId = null)
    {
        return Task::where('category_id',$categoryId)->get() ?? [];
    }

    public function getUnfinishedTask()
    {
        return Task::where('status_id','!=',2)->get() ?? [];
    }
}
