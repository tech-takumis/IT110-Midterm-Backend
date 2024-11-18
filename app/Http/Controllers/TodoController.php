<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TodoController extends Controller
{

        public function getUserTask($userId)
        {
            $user = User::findOrFail($userId);
            $tasks = $user->todo;

            return response()->json($tasks);

        }

        public function store(Request $request)
        {
            try {
                $validated = $request->validate([
                    'title' => 'required|string|max:255',
                    'user_id' => 'required',
                    'completed' => 'boolean',
                ]);

                $todo = Todo::create($validated);
                return response()->json([
                    'task' => $todo,
                    'status' => 200
                ]);
            } catch (ValidationException $e) {
                return response()->json(['errors' => $e->errors()], 422);
            }
        }

        public function show(Todo $todo)
        {
            return response()->json($todo);
        }

        public function update(Request $request, Todo $todo)
        {
            try {
                $validated = $request->validate([
                    'title' => 'sometimes|required|string|max:255',
                    'description' => 'nullable|string',
                    'completed' => 'sometimes|boolean',
                ]);

                $todo->update($validated);
                return response()->json([
                    'task' => $todo
                ]);
            } catch (ValidationException $e) {
                return response()->json(['errors' => $e->errors()], 422);
            }
        }

        public function destroy(Todo $todo)
        {
            $todo->delete();
            return response()->json(null, 204);
        }
}
