<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $category = new Category();
        $category->name = 'TestCategory';
        $category->active = 1;
        $category->save();

        Book::factory(10)->create(['category_id' => $category->id]);
        News::factory(10)->create();
    }
}
