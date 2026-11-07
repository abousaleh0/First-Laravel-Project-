<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response; // تأكد من وجود هذا في أعلى ملف الـ Policy

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): Response
    {
        if ($user->id === $task->user_id) {
            return Response::allow(); // مسموح
        } else {
            return Response::deny('Invalid Operation'); // ممنوع مع رسالة مخصصة
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): Response
    {
        if ($user->id === $task->user_id) {
            return Response::allow(); // مسموح
        } else {
            return Response::deny('Invalid Operation'); // ممنوع مع رسالة مخصصة
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): Response
    {
        if ($user->id === $task->user_id) {
            return Response::allow(); // مسموح
        } else {
            return Response::deny('Invalid Operation'); // ممنوع مع رسالة مخصصة
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Task $task): Response
    {
        if ($user->id === $task->user_id) {
            return Response::allow(); // مسموح
        } else {
            return Response::deny('Invalid Operation'); // ممنوع مع رسالة مخصصة
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Task $task): Response
    {
        if ($user->id === $task->user_id) {
            return Response::allow(); // مسموح
        } else {
            return Response::deny('Invalid Operation'); // ممنوع مع رسالة مخصصة
        }
    }
}
