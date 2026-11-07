<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCategoriesToTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Category;
use App\Models\Task;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Auth::user()->tasks;
        //$allTask = Task::select(['id', 'title', 'description', 'priority'])->get();
        return response()->json($tasks, 200);
    }



    #--------------------------------------------------------------------------
    public function getAllTasks()
    {
        $allTask = Task::select(['id', 'title', 'description', 'priority'])->get();
        return response()->json($allTask, 200);
    }

    #---------------------------------------------------------------------------
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $user_id = Auth::user()->id;
        $validatedData = $request->validated();
        $validatedData['user_id'] = $user_id;
        $task = Task::create($validatedData);
        return response()->json($task, 201);
    }

    #---------------------------------------------------------------------------
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, int $id)
    {
        $task = Task::findorFail($id);
        Gate::authorize('update', $task);
        $validatedData = $request->validated();
        $task->update($validatedData);
        return response()->json($task, 200);
    }

    #---------------------------------------------------------------------------
    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $task = Task::findorFail($id);
        Gate::authorize('view', $task);
        return response()->json($task, 200);
    }

    #---------------------------------------------------------------------------
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $task = Task::findOrFail($id);
            Gate::authorize('delete', $task);
            $task->delete();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Task not found',
                'error'   => $e->getMessage()
            ], 404);
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'You are not authorized to delete this task',
                'error'   => $e->getMessage()
            ], 404);
        } catch (QueryException $e) {
            // خطأ قيود العلاقات (مثلاً محاولة حذف سجل مرتبط بجداول أخرى)
            return response()->json([
                'message' => 'Cannot delete task due to related records',
                'error'   => $e->getMessage()
            ], 409);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    #---------------------------------------------------------------------------
    public function getTaskUser(int $id)
    {
        $task = Task::findorFail($id);
        Gate::authorize('view', $task);
        $user = $task->user;
        return response()->json($user, 200);
    }

    #---------------------------------------------------------------------------
    public function addCategoriesToTask(AddCategoriesToTaskRequest $request, int $taskID)
    {
        $task = Task::findorFail($taskID);
        Gate::authorize('update', $task);
        $task->categories()->syncWithoutDetaching($request->validated()['category_id']);
        return response()->json([
            'message' => 'Category attached successfully'
        ], 200);
    }

    #---------------------------------------------------------------------------
    public function getTaskCategories(int $taskId)
    {
        $task = Task::findorFail($taskId);
        Gate::authorize('view', $task);
        $categories = $task->categories;
        return response()->json($categories, 200);
    }

    #---------------------------------------------------------------------------
    public function getCategoriesTask(int $categoryId) // AI
    {
        $user_id = Auth::user()->id;
        $tasks = Category::findOrFail($categoryId)
            ->tasks()
            ->where('user_id', $user_id)
            ->get();
        return response()->json($tasks, 200);
    }

    #---------------------------------------------------------------------------
    public function addToFavorites(int $taskId)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        Task::findOrFail($taskId);

        $user->favoratesTasks()->syncWithoutDetaching($taskId);

        return response()->json([
            'message' => 'Task added to favorites successfully'
        ], 200);
    }

    #---------------------------------------------------------------------------
    public function removeFromFavorites(int $taskId)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        Task::findOrFail($taskId);

        $user->favoratesTasks()->detach($taskId);

        return response()->json([
            'message' => 'Task removed from favorites successfully'
        ], 200);
    }

    #---------------------------------------------------------------------------
    public function getFavoritesTasks()
    {
        /** @var \App\Models\User $user */

        $user = Auth::user();
        $Data = $user->favoratesTasks()->get();
        return response()->json($Data, 200);
    }

    #--------------------------------------------------------------------------
    public function getTasksByPriority(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $sortQuery = $request->query('sort', 'asc');
        if ($sortQuery == 'desc') {
            $sortDirection = 'DESC';
        } else {
            $sortDirection = 'ASC';
        }

        $tasks = $user->tasks()
            ->orderByRaw("FIELD(priority, 'low', 'medium', 'high') $sortDirection")
            ->get();

        return response()->json($tasks, 200);
    }


    #---------------------------------------------------------------------------
}
