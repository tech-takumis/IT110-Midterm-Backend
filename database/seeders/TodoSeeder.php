<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $json = File::get(database_path('seeders/task.json'));
        $tasks = json_decode($json);

        foreach ($tasks as $task) {
            DB::table('todos')->insert([
                'title' => $task->title,
                'user_id' => $task->user_id,
                'description' => $task->description,
                'completed' => $task->completed,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
