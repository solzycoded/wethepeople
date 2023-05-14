<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate();
        // Post::truncate();
        // Category::truncate();

        // Seeder\App\Models\

        // Seeder\App\Models\User::factory(10)->create();
        // User::factory(10)->create();
        // Category::factory(10)->create();
        // Post::factory(20)->create();
        Comment::factory(3)->create();

        // $personal = Category::create([
        //     'name' => 'Personal',
        //     'slug' => 'personal'
        // ]);

        // $family = Category::create([
        //     'name' => 'Family',
        //     'slug' => 'family'
        // ]);

        // $work = Category::create([
        //     'name' => 'Work',
        //     'slug' => 'work'
        // ]);

        // $work = Category::create([
        //     'name' => 'Movies',
        //     'slug' => 'movies'
        // ]);

        // $work = Category::create([
        //     'name' => 'Tvshows',
        //     'slug' => 'tvshows'
        // ]);

        // $work = Category::create([
        //     'name' => 'Entertainment',
        //     'slug' => 'entertainment'
        // ]);

        // $work = Category::create([
        //     'name' => 'Celebrity-Gist',
        //     'slug' => 'celebrity-gist'
        // ]);

        // $work = Category::create([
        //     'name' => 'Politics',
        //     'slug' => 'politics'
        // ]);

        // $user = User::create([
        //     'username' => 'solzy',
        //     'name' => 'Solomon Fidelis',
        //     'email' => 'solomonfidelis012@gmail.com',
        //     'email_verified_at' => '12/09/12 12:00:00',
        //     'password' => bcrypt('password')
        // ]);
        
        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $family->id,
        //     'title' => 'My Family Post',
        //     'slug' => 'first',
        //     'excerpt' => 'Lorem ipsum dolor sit amet',
        //     'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        // ]);

        // $user = User::create([
        //     'username' => 'abl',
        //     'name' => 'Idris Abdul',
        //     'email' => 'idrisabdul@gmail.com',
        //     'email_verified_at' => '12/09/12 12:00:00',
        //     'password' => bcrypt('password')
        // ]);
        
        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $work->id,
        //     'title' => 'My Work Post',
        //     'slug' => 'second',
        //     'excerpt' => 'Lorem ipsum dolor sit amet',
        //     'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        // ]);

        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $personal->id,
        //     'title' => 'My Personal Post',
        //     'slug' => 'third',
        //     'excerpt' => 'Lorem ipsum dolor sit amet',
        //     'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        // ]);
    }
}