<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Comment;
use App\Models\Status;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // status
        $this->seedStatus('published');
        $this->seedStatus('draft');
        $this->seedStatus('withdrawn');

        // comment
        Comment::factory(20)->create();
    }

    protected function seedStatus($name){
        Status::create([
            'name' => $name
        ]);
    }
}