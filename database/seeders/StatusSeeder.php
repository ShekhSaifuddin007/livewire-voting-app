<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'names' => ['Open', 'Considering', 'In Progress', 'Implemented', 'Closed'],
            // 'classes' => ['bg-gray-200', 'bg-purple-500 text-white', 'bg-yellow-500 text-white', 'bg-green-500 text-white', 'bg-red-500 text-white']
        ];

        foreach ($statuses['names'] as $key => $status) {
            Status::create([
                'name' => $statuses['names'][$key],
                // 'classes' => $statuses['classes'][$key]
            ]);
        }
    }
}
